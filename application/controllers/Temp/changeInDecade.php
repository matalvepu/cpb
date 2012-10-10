<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ChangeInDecade extends CI_Controller
{
     
	  public function index()
	  {

            $this->load->model('station_model');
			 
			 $data['stationName']=$this->station_model->getNames();
			 for($i=1950;$i<date('Y');$i++)
			 {
				 $options[$i]=$i;
			 }
			 $data['options']=$options;
			 
			
			
			
			 $this->load->view('eng_segments/normal_head');
			  $logodata['title']="বাংলাদেশ ক্লাইমেট পোর্টাল ";
			 $this->load->view('eng_segments/logo',$logodata);
		
			  $this->load->view('eng_segments/top_navigation',nav_load('bangla','analysis'));
		
			  $this->load->view('TempAnalysis/changeInDecadeForm',$data);
			
			   $this->load->view('eng_segments/footer');
			
		   
        }
		
		function showGraph()
		{
		  	 $sid=$this->input->post('station_name');
			 $syear=$this->input->post('startyear');
			 $eyear=$this->input->post('lastyear');
           
            $this->load->model('station_model');
            $stationName= $this->station_model->getName($sid);
			
			
			
			
		
           

            unset($min);
            unset($max);
            unset($phpArray);

            $phpArray[] = array("Month","Max Temp","Min Temp");
           
            for($month = 1; $month<=12; $month++)
            {
                $monthName = $this->getMonthString($month);
                
                $min = $this->avgTemp($sid,$month,$syear,$eyear,TRUE);
                $max = $this->avgTemp($sid, $month, $syear, $eyear, False);
				
            
				
                
                 $phpArray[] = array($monthName,$max,$min);
                 
           
            }

         
            $data['array'] = json_encode($phpArray,JSON_NUMERIC_CHECK);
            $data['title'] = "Change in temp ( °C/decade) in $stationName";
            $data['yAxistitle'] = " °C/decade";
			
			
			 for($i=1950;$i<date('Y');$i++)
			 {
				 $options[$i]=$i;
			 }
			 $data['options']=$options;
			 
			 $this->load->model('station_model');
			 
			 $data['stationName']=$this->station_model->getNames();
			 
			
			
			
			 $this->load->view('eng_segments/graph_header',$data);
			  $logodata['title']="বাংলাদেশ ক্লাইমেট পোর্টাল ";
			 $this->load->view('eng_segments/logo',$logodata);
		
			  $this->load->view('eng_segments/top_navigation',nav_load('bangla','analysis'));
		
			  $this->load->view('TempAnalysis/changeInDecadeForm',$data);
			
			   $this->load->view('eng_segments/footer');
			
			
			
			
			/* $this->load->view('eng_segments/graph_header',$data);
			  $logodata['title']="বাংলাদেশ ক্লাইমেট পোর্টাল ";
			 $this->load->view('eng_segments/logo',$logodata);
		
			  $this->load->view('eng_segments/top_navigation',nav_load('bangla','analysis'));
		
			  $this->load->view('TempAnalysis/lineDefault',$data);
			
			  $this->load->view('eng_segments/footer');*/
			          
          

			
		}
        function getMonthString($n)
        {
            $timestamp = mktime(0, 0, 0, $n, 1, 2005);

            return date("M", $timestamp);
        }

        public function avgTemp($sid,$month,$syear,$eyear,$min)
        {
            
            $this->load->model('weatherDataTemp');

            $oldValue = 0;
            $count = 0;
            $sum = 0;
            for($year = $syear ; $year <= $eyear ; $year+=10)
            {
                $lyear = $year + 9;
                if($lyear>$eyear)$lyear = $eyear;

                 
                    
                if($min==TRUE)
                    $newVal= $this->weatherDataTemp->avgMinTempBetwenYear($sid,$year,$lyear,$month);
                else
                    $newVal= $this->weatherDataTemp->avgMaxTempBetwenYear($sid,$year,$lyear,$month);

                if($oldValue != 0)
                {
                    $diff = ($newVal-$oldValue);
                    $sum +=$diff;
                    $count++;
                }

                $oldValue = $newVal;
            }
          

            return ($sum  / $count) ;

	}
	      
}

