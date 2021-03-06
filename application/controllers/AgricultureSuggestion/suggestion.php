<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Suggestion extends CI_Controller
{
    var $maxTempTolerance;
    var $minTempTolerance;
    var $viewData;
    var $rainfallTolerance ;
    var $debug=false;
    function __construct()
    {

        $this->maxTempTolerance = 10 ;
        $this->minTempTolerance = 10 ;
        $this->rainfallTolerance =  1000 ;
        parent::__construct();
        $this->init();
    }
    function init()
    {
        if( $this->session->userdata('language') ==FALSE)
        $this->session->set_userdata('language', 'bangla');
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
        $this->viewData['msg']="আপনার জমির পরিমাণ এবং  সবচেয়ে কাছাকাছি এলাকার নাম নির্বাচন করুন । আমাদের সিস্টেম থেকে জেনে নিন আপনার জন্য উপযোগী ফসল কী হবে । আপনি আরও জানতে পারবেন সম্ভাব্য উৎপাদন, খরচ, বিক্রয়মূল্য এবং লাভ।<br/><br/>";
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
                     $this->viewData['sellText']="সম্ভাব্য বিক্রয় মূল্য";
                     $this->viewData['revenueText']="সম্ভাব্য লাভ";
                     $this->viewData['maxrevText']="সম্ভাব্য সর্বোচ্চ লাভ";


                     $this->load->view('eng_segments/normal_head');
                     $logodata['title']="বাংলাদেশ ক্লাইমেট পোর্টাল ";
                     $this->load->view('eng_segments/logo',$logodata);

                     $this->load->view('eng_segments/top_navigation',nav_load('bangla','agri_suggest'));

                     $this->load->view('AgricultureSuggestion/suggestionView',  $this->viewData);

                     $this->load->view('eng_segments/footer');
                 }
                 else
                 {
                     $this->viewData['quantityText']="সম্ভাব্য পরিমাণ (মণ)";
                     $this->viewData['costText']="সম্ভাব্য খরচ";
                     $this->viewData['sellText']="সম্ভাব্য বিক্রয় মূল্য";
                     $this->viewData['revenueText']="সম্ভাব্য লাভ";
                     $this->viewData['maxrevText']="সম্ভাব্য সর্বোচ্চ লাভ";


                     $this->load->view('eng_segments/normal_head');
                     $logodata['title']='Climate Portal For Bangladesh';
                     $this->load->view('eng_segments/logo',$logodata);

                     $this->load->view('eng_segments/top_navigation',nav_load('english','agri_suggest'));

                     $this->load->view('AgricultureSuggestion/suggestionView',$this->viewData);

                     $this->load->view('eng_segments/footer');
                 }

        }

 public function getSurrogateIds($years,$syear,$smonth,$sdate,$eyear,$emonth,$edate,$sid)
 {
        $this ->load->model('cultivationDataModel');
        $surrogateIds=NULL;

        //echo '$years,$syear,$smonth,$sdate,$eyear,$emonth,$edate,$sid'."$years,$syear,$smonth,$sdate,$eyear,$emonth,$edate,$sid<br/>";
        for($i=1;$i<=$years;$i++)
        {
                //LOADING THE CULTIVATION DATAs WITHIN THAT PERIOD
                $temp = $this->cultivationDataModel->getSurrogateIdsGivenTimePeriod($syear-$i,$smonth,$sdate,$eyear-$i,$emonth,$edate);
                if($temp != NULL)
                {
                    foreach($temp AS $id)
                    {
                        $thisSid = $this->cultivationDataModel->getSid($id);
                        if($this->similarSoil($sid, $thisSid))
                            $surrogateIds[]=$id;
                    }

                }
        }

        if( $this->debug )
        {
            echo "<br/>SELECTED AT FIRST : ";
            print_r($surrogateIds);
        }
        return $surrogateIds;

 }

 function similarSoil($sid1,$sid2)
 {
            //SELECT typeId FROM soilInfo WHERE sid = 1
            $this->load->model('soilInfo');

            $type1 = $this->soilInfo->getSoilType($sid1);
            $type2 = $this->soilInfo->getSoilType($sid2);

            //echo "$sid1 Type : $type1 == $sid2 Type : $type2<br/><br/>";
            return $type1==$type2;
 }

 public function filterSurrogateIds($surrogateIds,$sid)
 {
     $filtered=NULL;
     if($surrogateIds!=NULL)
         foreach($surrogateIds as $surrogateId)
         {
                if($this->isCompatible($surrogateId, $sid))
                         $filtered[]=$surrogateId;
         }
     // print_r($filtered);

         if( $this->debug )
        {
            echo "<br/>FILTERED : ";
            print_r($filtered);
        }
         return $filtered;
 }

 public function isCompatible($surrogateId,$sid)
 {
   //  return true;
     $this ->load->model('cultivationDataModel');
     $this ->load->model('weatherDataTemp');
     $this->load->helper('sid_to_did');
     $this ->load->model('forecast_model');
     $this ->load->model('weatherDataRainfall');

     $startDate = $this->cultivationDataModel->getStartTime($surrogateId);
     $endDate = $this->cultivationDataModel->getHarvestTime($surrogateId);
     $sid = $this->cultivationDataModel->getSid($surrogateId);
     $did = sidToDid($sid);
     
     // NO data after 2009 , so load from previous data
     if($endDate>='2010-1-1')
     {
         //echo strtotime($startDate );
          $startDate = date("Y-m-d",strtotime($startDate ) - 3*365*24*3600);
          $endDate = date("Y-m-d",strtotime($endDate ) - 3*365*24*3600);
         //echo " YEEEE - $startDate<br/>";
     }

     /* CALCULATE THE DATE NEEDED FOR FORECAST -> CHANGE YEAR TO 2012*/
     $forecastStartDate = $this->convertToCurrentYear($startDate);
     $forecastEndDate  = $this->convertToCurrentYear($endDate);

        

     $avgMax = $this->weatherDataTemp->getAvgMaxTempBetweenDate($sid,$startDate,$endDate);
     $avgMaxForecast = $this->forecast_model->getAvgMaxTempForecastBetweenDate($did,$forecastStartDate,$forecastEndDate);

     //echo "<br/>$surrogateId  : max temp $avgMax -> $avgMaxForecast";
     
     if(abs($avgMax-$avgMaxForecast) > $this->maxTempTolerance)
             return false;
     
     $avgMin = $this->weatherDataTemp->getAvgMinTempBetweenDate($sid,$startDate,$endDate);
     $avgMinForecast = $this->forecast_model->getAvgMinTempForecastBetweenDate($did,$forecastStartDate,$forecastEndDate);

     if(abs($avgMin-$avgMinForecast) > $this->minTempTolerance)
             return false;

   

     $rainSum = $this->weatherDataRainfall->getRainfallSumBetweenDate($sid,$startDate,$endDate);

     if($rainSum!=NULL)
     {
        $rainForecastSum = $this->forecast_model->getRainfallForecastSumBetweenDate($did,$forecastStartDate,$forecastEndDate);
        //echo "<br/>$surrogateId ->( $startDate -> $endDate) in $sid max : $rainSum forecast avgMax :$rainForecastSum did :$did";

        if(abs($rainSum-$rainForecastSum) > $this->rainfallTolerance)
            return false;
     
     }
        
    //echo "<br/>$surrogateId ->( $startDate -> $endDate) in $sid max : $rainSum forecast avgMax :$rainForecastSum did :$did"; 
     return true;
 }

 public function convertToCurrentYear($date)
 {
     $time = strtotime($date);
     $year = date("Y",$time);
     $diff = date("Y")- $year;
     return date("Y-m-d",$time+$diff*365*24*3600);

 }
 public function suggest($sid,$landSize)
 {
      
      //CALCULATING DATES WITHIN 15 DAYS      
      $syear = intval(date("Y",time()-15*24*3600));
      $smonth = intval(date("m",time()-15*24*3600));
      $sdate = intval(date("d",time()-15*24*3600));

      $eyear = intval(date("Y",time()+15*24*3600));
      $emonth = intval(date("m",time()+15*24*3600));
      $edate = intval(date("d",time()+15*24*3600));

      $this ->load->model('cultivationDataModel');
      $this ->load->model('cropModel');


      // WE NEED DATA FOR LAST 3 YEARS
     $surrogateIds=$this->getSurrogateIds(3,$syear,$smonth,$sdate,$eyear,$emonth,$edate,$sid);


      // WE HAVE SURROGATE NEEDED FOR THAT REGION

      /*********************************/
      // ELIMINATE SOME IF NEEDED HERE


      $surrogateIds = $this->filterSurrogateIds($surrogateIds,$sid);

      /*********************************/

       $selectedCrops =NULL;
      // Get which crops are selected
       if($surrogateIds != NULL)
            $selectedCrops = $this->cultivationDataModel->getSelectedCropIds($surrogateIds);


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
              $this->viewData['error']= "দুঃখিত !! আপনার পরিস্তিতির সাথে সামঞ্জস্য পূর্ন কোনো ততথ্য পাওয়া যায় নি<br/>";
          }
          

          //echo "<br/>";
      }
      if($found==false)   $this->viewData['error']= "দুঃখিত !! আপনার পরিস্তিতির সাথে সামঞ্জস্য পূর্ন কোনো তথ্য পাওয়া যায় নি<br/>";

    
 }


}
?>

