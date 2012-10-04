<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Suggestion extends CI_Controller
{
      var $viewData;
     function __construct()
	{
		parent::__construct();
		$this->init();
	}
        function init()
	{
                    if( $this->session->userdata('language') ==FALSE)
                     $this->session->set_userdata('language', 'bangla');
	}

        public function post()
        {
            
        }

        public function index()
        {
            $this->load->model('station_model');
            $this->viewData['options']=$this->station_model->getSidandName();
            $this->viewData['title'] = "কৃষি উপদেশ";
            $this->viewData['main']="";
            $this->viewData['count']=0;
            $this->viewData['crop']="";
            $this->viewData['cost']=NULL;
            $this->viewData['sell']=NULL;
            $this->viewData['revenue']=NULL;
            $this->viewData['quantity']=NULL;
            $this->viewData['msg']="আপনার জমির পরিমাণ এবং  সবচেয়ে কাছাকাছি এলাকার নাম নির্বাচন করুন । আমাদের সিস্টেম থেকে জেনে নিন আপনার জন্য উপযোগী ফসল কী হবে । আপনি আরও জানতে পারবেন সম্ভাব্য উৎপাদন, খরচ, বিক্রয়মূল্য এবং লাভ।<br/><br/>";

            $this->viewData['dropDownText']="এলাকা";
            $this->viewData['landSizeText']="আপনার জমির পরিমাণ";
            $this->viewData['submit']="উপদেশ দেখুন";

            if( $this->input->post('stations') != NULL )
            {
                $sid = $this->input->post('stations');
                $landSize =   $this->input->post('landSize');
                $this->suggest($sid, $landSize);
            }

            
             $this->load->helper('nav_loader');

                
                if( $this->session->userdata('language')=='bangla')
                 {

                     $this->viewData['quantityText']="সম্ভাব্য পরিমাণ (মণ)";
                     $this->viewData['costText']="সম্ভাব্য খরচ";
                     $this->viewData['sellText']="সম্ভাব্য বিক্রয় মূল্য";
                     $this->viewData['revenueText']="সম্ভাব্য লাভ";
                     $this->viewData['maxrevText']="সম্ভাব্য সর্বোচ্চ লাভ";


                     $this->load->view('eng_segments/normal_head');
                     $logodata['title']="বাংলাদেশ ক্লাইমেট পোর্টাল ";
                     $this->load->view('eng_segments/logo',$logodata);

                     $this->load->view('eng_segments/top_navigation',nav_load('bangla','agri_guggest'));

                     $this->load->view('AgricultureSuggestion/suggestionView',  $this->viewData);

                     $this->load->view('eng_segments/footer');
                 }
                 else
                 {
                                          $this->viewData['quantityText']="সম্ভাব্য পরিমাণ (মণ)";
                     $this->viewData['costText']="সম্ভাব্য খরচ";
                     $this->viewData['sellText']="সম্ভাব্য বিক্রয় মূল্য";
                     $this->viewData['revenueText']="সম্ভাব্য লাভ";
                     $this->viewData['maxrevText']="সম্ভাব্য সর্বোচ্চ লাভ";


                     $this->load->view('eng_segments/normal_head');
                     $logodata['title']='Climate Portal For Bangladesh';
                     $this->load->view('eng_segments/logo',$logodata);

                     $this->load->view('eng_segments/top_navigation',nav_load('english','agri_guggest'));

                     $this->load->view('AgricultureSuggestion/suggestionView',$data);

                     $this->load->view('eng_segments/footer');
                 }

        }

 public function suggest($sid,$landSize)
 {
      //echo date("Y-m-d");


      //Taking Current Date
      //$currentYear = date("Y");
      //$currentMonth = date("m");
      //$currentDate = date("d");

     
      //CALCULATING DATES WITHIN 15 DAYS      
      $syear = intval(date("Y",time()-7*24*3600));
      $smonth = intval(date("m",time()-7*24*3600));
      $sdate = intval(date("d",time()-7*24*3600));

      $eyear = intval(date("Y",time()+7*24*3600));
      $emonth = intval(date("m",time()+7*24*3600));
      $edate = intval(date("d",time()+7*24*3600));

      $this ->load->model('cultivationDataModel');
           $this ->load->model('cropModel');

           $surrogateIds=NULL;
      // WE NEED DATA FOR LAST 3 YEARS
      for($i=1;$i<=3;$i++)
      {
            //LOADING THE CULTIVATION DATAs WITHIN THAT PERIOD
            $temp = $this->cultivationDataModel->getSurrogateIds($syear-$i,$smonth,$sdate,$eyear-$i,$emonth,$edate,$sid);
            if($temp != NULL)
            foreach($temp AS $id)
            {
                $surrogateIds[]=$id;
            }
      }

     // echo "<br/> Surrogate Keys";
     // print_r($surrogateIds);

      // WE HAVE SURROGATE NEEDED FOR THAT REGION

      /*********************************/
      // ELIMINATE SOME IF NEEDED HERE

      // FOR NOW SELECTING EVERY CROP ON THAT TIME SPAN
      /*********************************/

$selectedCrops =NULL;
      // Get which crops are selected
       if($surrogateIds != NULL)
            $selectedCrops = $this->cultivationDataModel->getSelectedCropIds($surrogateIds);

     // echo "<br/> Selected Crops";
    //  print_r($selectedCrops);

       $found=false;
       if($selectedCrops != NULL)
      foreach ($selectedCrops AS $cropId)
      {
          $cultivationCostPerUnit = 0;
          $sellingPricePerUnit = 0;
          $maxRevenuePerUnit=0;
          $quantityPerUnitArea = 0;
          $count = 0;

          if($surrogateIds != NULL)
          foreach($surrogateIds AS $surrogateId)
          {

              if ($this->cultivationDataModel->getCropId($surrogateId) != $cropId) continue;

              
              $thisLandSize = $this->cultivationDataModel->getLandSize($surrogateId);
              $thisQuantity = $this->cultivationDataModel->getQuantity($surrogateId);
              $thisProductionCost = $this->cultivationDataModel->getProductionCost($surrogateId);
              $thisSellingPrice = $this->cultivationDataModel->getSellingPrice($surrogateId);

              $thisRevenue  = $thisSellingPrice - $thisProductionCost;

              if($thisRevenue<=0)
                  continue;

              $count++;
              
              $thisProductionCostPerUnit = $thisProductionCost/$thisQuantity;
              $thisSellingPricePerUnit = $thisSellingPrice/$thisQuantity;
              $thisQuantityPerUnitArea = (doubleval($thisQuantity))/$thisLandSize;

              //echo "<br/>QPA : $thisQuantityPerUnitArea";
              
              $thisRevenuePerUnit = $thisRevenue/$thisQuantity;

              
              if($thisRevenuePerUnit>$maxRevenuePerUnit)
                $maxRevenuePerUnit = $thisRevenuePerUnit;

              $cultivationCostPerUnit += $thisProductionCostPerUnit;
              $sellingPricePerUnit += $thisSellingPricePerUnit;
              $quantityPerUnitArea += $thisQuantityPerUnitArea;

              //echo "<br/> $surrogateId -> crop : $cropId land : $thisLandSize quantity : $thisQuantity cost : $thisProductionCost sellingPrice: $thisSellingPrice";

              
          }

          if($count>0)
          {
              $cultivationCostPerUnit /= $count;
              $sellingPricePerUnit /= $count;
              //echo "qpa sum : $quantityPerUnitArea<br/>";
              $quantityPerUnitArea /= $count;
              
              $revenuePerUnit = ($sellingPricePerUnit-$cultivationCostPerUnit);

              $probableQuantity = $quantityPerUnitArea * $landSize;
              $probableCost = $probableQuantity * $cultivationCostPerUnit;
              $probableSellPrice = $probableQuantity * $sellingPricePerUnit;
              $probableRevenue = $probableQuantity * $revenuePerUnit;
              $maxProbableRevinue = $maxRevenuePerUnit * $probableQuantity;

              if($this->session->userdata('language')=='bangla')
                     $cropName=$this->cropModel->getBanglaCropName($cropId);
              else
                     $cropName=$this->cropModel->getCropName($cropId);
              
              $this->viewData['count'] ++;
              $this->viewData['crop'][]=$cropName;
              $this->viewData['quantity'][]=$probableQuantity;
              $this->viewData['cost'][] = $probableCost;
              $this->viewData['sell'][]=$probableSellPrice;
              $this->viewData['revenue'][]=$probableRevenue;
              $this->viewData['maxrev'][]=$maxProbableRevinue;
              
              //$this->viewData['main'] .= "<br/>crop : $cropName quantity : $probableQuantity cost : $probableCost ,sell : $probableSellPrice, revenue : $probableRevenue ,max:  $maxProbableRevinue<br/>";
            $found = TRUE;
          }
          else
          {

         //     echo "IN ELSE". $this->viewData['error'];
              $this->viewData['error']= "দুঃখিত !! আপনার পরিস্তিতির সাথে সামঞ্জস্য পূর্ন কোনো ততথ্য পাওয়া যায় নি<br/>";
          }
          

          //echo "<br/>";
      }
      if($found==false)   $this->viewData['error']= "দুঃখিত !! আপনার পরিস্তিতির সাথে সামঞ্জস্য পূর্ন কোনো তথ্য পাওয়া যায় নি<br/>";
 }


}
?>

