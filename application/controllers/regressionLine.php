<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RegressionLine extends CI_Controller
{
     var $equation="";
	 var $coefficient="";
	 var $invalidDtae="";
	 var $noData="";
	 
	 
	public function index()
	{
		
            $this->load->model('station_model');
			 
			 $data['stationName']=$this->station_model->getNames();
			
			 ///for showing error message
			 $data['invalidDate']=$this->invalidDtae;
			 $data['noData']=$this->noData;
			  $data['equation']=$this->equation;
		     $data['coefficient']=$this->coefficient;
			//****
			
			 $this->load->view('eng_segments/normal_head');
			  $logodata['title']="বাংলাদেশ ক্লাইমেট পোর্টাল ";
			 $this->load->view('eng_segments/logo',$logodata);
		
			  $this->load->view('eng_segments/top_navigation',nav_load('bangla','analysis'));
		
			  $this->load->view('regressionLine_view',$data);
			
			   $this->load->view('eng_segments/footer');
			
         
           
        }
		
		function errorMessage()
		{
			
			 $this->load->model('station_model');
			 
			 $data['stationName']=$this->station_model->getNames();
		   
			 $data['invalidDate']=$this->invalidDtae;
			 $data['noData']=$this->noData;
			  $data['equation']=$this->equation;
		     $data['coefficient']=$this->coefficient;
			 
			 $this->load->view('eng_segments/normal_head',$data);
			  $logodata['title']="বাংলাদেশ ক্লাইমেট পোর্টাল ";
			 $this->load->view('eng_segments/logo',$logodata);
		
			  $this->load->view('eng_segments/top_navigation',nav_load('bangla','analysis'));
		
			  $this->load->view('regressionLine_view',$data);
			
			   $this->load->view('eng_segments/footer');
			
			
		}
		
		function showRegression()
		{
			
			 
			
			 $sid=intval($this->input->post('station_name'));
			 $syear=intval($this->input->post('startyear'));
			 $eyear=intval($this->input->post('lastyear'));
             $sday=intval($this->input->post('startday'));
			 $eday=intval($this->input->post('lastday'));
			 $type=$this->input->post('type');
			 $month=intval($this->input->post('month'));
			 
			
            if(($syear>$eyear)|($sday>$eday))//invalid date so error message
			{
				$this->invalidDtae="Date was Invalid";
				$this->errorMessage();
				
			}
			else
			{
				$this->invalidDtae="";
			
			 
			 
				$this->load->model('station_model');
				$stationName= $this->station_model->getName($sid);
				if($month==2 && $eday>28)
				$originalEday=cal_days_in_month(CAL_GREGORIAN, $month  , $syear);
				else if($eday>29)
				$originalEday=cal_days_in_month(CAL_GREGORIAN, $month  , $syear);
				else 
				 $originalEday=$eday;
				
				 $title = "Avg Min and Max temp on day $sday to $originalEday in month $month from $syear to $eyear in $stationName station";
				 
				  
				 if(!strcmp($type,"temp"))
					$yAxistitle = "Avg Min and Max temp ( ° Celsius)";
				 else
					  $yAxistitle = "Avg Rainfall(mm)";
					  
					//  echo "----".$yAxistitle;
				 
				
	
			if(!strcmp($type,"temp")) 
				$data['array'] =  $this->avgMinMaxTemp($sid,$sday,$eday,$month,$syear,$eyear);
			else
			   $data['array'] =  $this->avgRainfall($sid,$sday,$eday,$month,$syear,$eyear);
			  
			  $data['equation']=$this->equation;
			  $data['coefficient']=$this->coefficient;
				 $data['title'] = mysql_real_escape_string($title);
				 $data['yAxistitle'] = mysql_real_escape_string($yAxistitle);
				 $data['invalidDate']=$this->invalidDtae;
				 $data['noData']=$this->noData;
				 
				 
					//echo "var javascript_array = ". $js_array . ";\n";
			   // $this->load->view('TempAnalysis/lineDefault',$data);
			   // echo $this->maxTemp(1, 1, 1953);*/
			   
			   
			   $this->load->model('station_model');
				 
				 $data['stationName']=$this->station_model->getNames();
				
				 
			   if(!strcmp($this->noData,"") && !strcmp($this->invalidDtae,""))
			   {
				 $this->load->view('eng_segments/graph_header',$data);
				  $logodata['title']="বাংলাদেশ ক্লাইমেট পোর্টাল ";
				 $this->load->view('eng_segments/logo',$logodata);
			
				  $this->load->view('eng_segments/top_navigation',nav_load('bangla','analysis'));
			
				  $this->load->view('regressionLine_view',$data);
				
				   $this->load->view('eng_segments/footer');
			   }
			}
			
			
			
		}
    public function get_m($x_bar , $y_bar , $xy_bar , $x_sqr_bar )
    {

        $lob = ($x_bar * $y_bar) - $xy_bar ;
        $hor = ($x_bar * $x_bar) - $x_sqr_bar;

        return $lob/$hor;

    }

    public function get_b($x_bar , $y_bar , $m)
    {
        return ($y_bar - $m * $x_bar);
    }
       
        public function avgMinMaxTemp($sid,$sday,$eday,$month,$syear,$eyear)
        {
			
			$this->load->model('weatherDataTemp');
			
            $sdate = $sday;
			
            $edate = $eday;

            $count1=$count2=0;
            $x1=0;
            $x2=0;
            $y1=0;
            $y2=0;
            $xy1=0;
            $xy2=0;
            $x_sqr_1=0;
            $x_sqr_2=0;

           

            $phpArray[] = array("Year","Avg Mintemp (° Celsius)","Avg Min Temp Regression Line","Avg Maxtemp(° Celsius)","Avg Max Temp Regression Line");
            
            for($year = $syear ; $year <= $eyear ; $year++)
            {
                
                // if($which==2)
                //$edate=  cal_days_in_month(CAL_GREGORIAN, $month  , $year);
                 
                $avgMin = $this->weatherDataTemp->avgMinTempBetweenTwoDate($sid,$year,$month,$sdate,$year,$month,$edate);

              //  echo $avgMin." ";
                if($avgMin!=NULL | $avgMin!="")
                {
                   $x1 += $year;
                   $y1 += $avgMin;
                   $xy1 += ($x1*$y1) ;
                   $x_sqr_1 += ($x1*$x1);

                   $x1_array[$count1]=$year;
                   $y1_array[$count1]=$avgMin;
                   $count1++;
  
                }
                $avgMax = $this->weatherDataTemp->avgMaxTempBetweenTwoDate($sid,$year,$month,$sdate,$year,$month,$edate);
                if($avgMax!=NULL | $avgMin!="")
                {
                    $x2 += $year;
                   $y2 += $avgMax;
                   $xy2 += ($x2*$y2) ;
                   $x_sqr_2 += ($x2*$x2);
                   $y2_array[$count2]=$avgMax;
                   $count2++;

                   
                }

                //$phpArray[] = array("".$year,$avgMin,$avgMax);
            }
			
			if($count1==0 | $count2==0)//no data error message
			{
				$this->noData="No data exist during This span";
				$this->errorMessage();
				
			}
			else
			{
				$this->noData="";
			
			
				$x_bar = $x1 /$count1;
				$y1_bar = $y1 /$count1;
				$xy1_bar = $xy1 / $count1;
				$x_sqr_bar = $x_sqr_1/$count1;
	
				$y2_bar = $y2 / $count1;
				
				$xy2_bar = $xy2/ $count1;
				
	
				$m1 = $this->get_m($x_bar, $y1_bar, $xy1_bar, $x_sqr_bar);
				$b1 = $this->get_b($x_bar, $y1_bar, $m1);
	
				$m2 = $this->get_m($x_bar, $y2_bar, $xy2_bar, $x_sqr_bar);
				$b2 = $this->get_b($x_bar, $y2_bar, $m2);
	
				$this->equation= "REGRESSION LINE EQUATION FOR MINIMUM TEMPERATURE : y = $m1 x + $b1 <br/>REGRESSION LINE EQUATION FOR MAXIMUM TEMPERATURE: y = $m2 x + $b2 <br/>";
				$SE_y_bar_1 = 0;
				$SE_y_bar_2 = 0;
	
	
				$SE_y_1 = 0;
				$SE_y_2 = 0;
				for($x = 0;$x<$count1-1;$x++)
				{
					$SE_y_bar_1 += ($y1_array[$x] - $y1_bar)*($y1_array[$x] - $y1_bar);
					$SE_y_bar_2 += ($y2_array[$x] - $y2_bar)*($y2_array[$x] - $y2_bar);
	
					$y1_regLine = ($m1*$x1_array[$x] + $b1);
					$y2_regLine = ($m2*$x1_array[$x] + $b2);
	
					$SE_y_1  += ($y1_array[$x] - $y1_regLine)*($y1_array[$x] - $y1_regLine);
					$SE_y_2  += ($y2_array[$x] - $y2_regLine)*($y2_array[$x] - $y2_regLine);
	
					
					//$y1_array[$x],
					
					
					$phpArray[]=array("".$x1_array[$x],$y1_array[$x],$y1_regLine,$y2_array[$x],$y2_regLine);
				}
	
				$r_sqr_1 = (1-($SE_y_1/ $SE_y_bar_1))*100;
				$r_sqr_2 = (1-($SE_y_2/ $SE_y_bar_2))*100;
	
			   $this->coefficient= "CORRELATION COEFFICIENT  FOR MIN TEMP ,R<sup>2</sup> = $r_sqr_1 <br/> CORRELATION COEFFICIENT FOR MAX TEMP ,R<sup>2</sup> = $r_sqr_2<br/>";
					$js_array = json_encode($phpArray,JSON_NUMERIC_CHECK);
	
					return $js_array;
			}
			
	}
	
	function avgRainfall($sid,$sday,$eday,$month,$syear,$eyear)
	{
		
		$this->load->model('weatherDataRainfall');
		  if($syear<1970)
		     $syear=1970;
		 $sdate = $sday;
			
            $edate = $eday;

            $count1=0;
            $x1=0;
          
            $y1=0;
           
            $xy1=0;
            $x_sqr_1=0;
           

      

            $phpArray[] = array("Year","Avg Rainfall(mm)","Avg Rainfall Regression Line");
            
            for($year = $syear ; $year <= $eyear ; $year++)
            {
                
                // if($which==2)
                //$edate=  cal_days_in_month(CAL_GREGORIAN, $month  , $year);
                 
                $avgRain = $this->weatherDataRainfall->totalRainfallBetweenTwoDate($sid,$year,$month,$sdate,$year,$month,$edate);

              //  echo $avgMin." ";
                if($avgRain!=NULL | $avgRain!="")
                {
                   $x1 += $year;
                   $y1 += $avgRain;
                   $xy1 += ($x1*$y1) ;
                   $x_sqr_1 += ($x1*$x1);

                   $x1_array[$count1]=$year;
                   $y1_array[$count1]=$avgRain;
                   $count1++;
  
                }
               
              

                
            }
			
			if($count1==0 )//no data error message
			{
				$this->noData="No data exist during This span";
				$this->errorMessage();
				
			}
			else
			{
				$this->noData="";
				
	
				$x_bar = $x1 /$count1;
				$y1_bar = $y1 /$count1;
				$xy1_bar = $xy1 / $count1;
				$x_sqr_bar = $x_sqr_1/$count1;
	
			   
				
	
				$m1 = $this->get_m($x_bar, $y1_bar, $xy1_bar, $x_sqr_bar);
				$b1 = $this->get_b($x_bar, $y1_bar, $m1);
	
				
				$this->equation= "REGRESSION LINE EQUATION FOR RAINFALL : y = $m1 x + $b1 <br/>";
				$SE_y_bar_1 = 0;
			   
	
	
				$SE_y_1 = 0;
				
				for($x = 0;$x<$count1-1;$x++)
				{
					$SE_y_bar_1 += ($y1_array[$x] - $y1_bar)*($y1_array[$x] - $y1_bar);
				   
					$y1_regLine = ($m1*$x1_array[$x] + $b1);
				   
	
					$SE_y_1  += ($y1_array[$x] - $y1_regLine)*($y1_array[$x] - $y1_regLine);
				  
	
					
					
					
					
					$phpArray[]=array("".$x1_array[$x],$y1_array[$x],$y1_regLine);
				}
	
				$r_sqr_1 = (1-($SE_y_1/ $SE_y_bar_1))*100;
			   
	
			   $this->coefficient= "CORRELATION COEFFICIENT,R<sup>2</sup>= $r_sqr_1 <br/>";
					$js_array = json_encode($phpArray,JSON_NUMERIC_CHECK);
	
					return $js_array;
	
			}
		
	}
	
	
      
}

