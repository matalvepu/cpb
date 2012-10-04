<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Suggestion extends CI_Controller
{

 public function index()
 {
      //echo date("Y-m-d");
     $sid = 20;
     $landSize = 10;

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

      echo "<br/> Surrogate Keys";
      print_r($surrogateIds);

      // WE HAVE SURROGATE NEEDED FOR THAT REGION

      /*********************************/
      // ELIMINATE SOME IF NEEDED HERE

      // FOR NOW SELECTING EVERY CROP ON THAT TIME SPAN
      /*********************************/


      // Get which crops are selected
      $selectedCrops = $this->cultivationDataModel->getSelectedCropIds($surrogateIds);

      echo "<br/> Selected Crops";
      print_r($selectedCrops);


      

      foreach ($selectedCrops AS $cropId)
      {
          $cultivationCostPerUnit = 0;
          $sellingPricePerUnit = 0;
          $maxRevenuePerUnit=0;
          $quantityPerUnitArea = 0;
          $count = 0;
          
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

              echo "<br/>crop : $cropId quantity : $probableQuantity cost : $probableCost ,sell : $probableSellPrice, revenue : $probableRevenue ,max:  $maxProbableRevinue<br/>";
          }
          else
          {
              echo "No suggestion found given Criteria<bd/>";
          }
          

          //echo "<br/>";
      }
 }
}
?>

