<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MKTest extends CI_Controller
{
     
	public function index()
	{

        /*  $sid = 21;
            $syear=1948;
            $eyear = 2009;
	        $month=10;
            
            $this->load->model('station_model');
            $stationName= $this->station_model->getName($sid);
           
            echo $stationName;
           
             $this->avgMaxTemp($sid,$month,$syear,$eyear);*/
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
		
			  $this->load->view('TempAnalysis/mkTestForm',$data);
			
			   $this->load->view('eng_segments/footer');
			
	     
		
            
            
        }


		 function getInputFromUser()
		 {
			 
			 

			 $sid=$this->input->post('station_name');
			 $syear=$this->input->post('startyear');
			 $eyear=$this->input->post('lastyear');
			 $month=$this->input->post('month');
			 $this->load->model('station_model');
			 $kind=$this->input->post('kind');
			
			echo $sid."--".$syear."--".$eyear."--".$month."--".$kind."\n";
			 
			 if(strcmp($kind,"Max Temp")==0)
			 {
				 
				   $this->avgMaxTemp($sid,$month,$syear,$eyear);
				 
			 }
			 else 
			 
			  $this->avgMinTemp($sid,$month,$syear,$eyear); 
			
			
			
			 
			 
		
	
		 }
        public function avgMaxTemp($sid,$month,$syear,$eyear)
        {
            
            $this->load->model('weatherDataTemp');
			
			
			

           $array=array();
            for($year = $syear ; $year <= $eyear ; $year++)
            {
                $avgMax = number_format($this->weatherDataTemp->avgMaxTempMonthYear($sid,$month,$year),2);
                $array[] =$avgMax;
                
            }
			
	     	//print_r($array);
			
		
		  $this->MannKendalTest($array);
            
	   }
	   
	     public function avgMinTemp($sid,$month,$syear,$eyear)
        {
            
            $this->load->model('weatherDataTemp');
			
			
			

           $array=array();
            for($year = $syear ; $year <= $eyear ; $year++)
            {
                $avgMin = number_format($this->weatherDataTemp->avgMinTempMonthYear($sid,$month,$year),2);
                $array[] =array($avgMin);
                
            }
			
	     	//print_r($array);
		
		   $this->MannKendalTest($array);
            
	   }
	
	
	
	
	public function MannKendalTest($array)
	{
		
		$S=0;
		$Z=0;
		$varS=0;
		
		
		  // S ber korar code ***********
		    for($k=0;$k<sizeof($array)-1;$k++)
            {
				if($array[$k]!=NULL)
				{
					for($j=$k+1;$j<sizeof($array);$j++)
					{
						if(($array[$j]!=NULL))
						{
							
							
							if($array[$j]>$array[$k])
							{
								$S++;
								
								
							}
							elseif($array[$j]<$array[$k])
							{
								$S--;
							}
							
							
							
						}
					}
				}
				
				
				
				
            }
			//*************
			
			
			 //start  var(S) ber korar code ***********
			sort($array);
			
			$previous=$array[0];
			$count=0;
			$samevaluecount=array();
			
			for($i=1;$i<sizeof($array);$i++)
			{
				
				if($array[$i]==$previous)
				{
					$count++;
				}
				else
				{
					$previous=$array[$i];
					if($count>0)
					{
						$samevaluecount[]=$count;
					}
					$count=0;
					
				}
				
				
			}
			
			
			$sum_samevalue=0;
			
			for($i=0;$i<sizeof($samevaluecount);$i++)
			{
				$t_p=$samevaluecount[$i];
				$sum_samevalue+=$t_p*($t_p-1)*(2*$t_p+5);
			}
			
			$varS=((sizeof($array)*(sizeof($array)-1)*(2*sizeof($array)+5))-$sum_samevalue)/18;
			
			 // end var(s) ber korar code***********
			
			if($S>0)
			$Z=($S-1)/sqrt($varS);
			elseif($S==0)
			$Z=0;
			else
			$Z=($S+1)/sqrt($varS);
			
			$up=($Z-14.5)/sqrt($varS);
			
			$trend=exp(-($up*$up)/2)/(sqrt(2*3.1416)*sqrt($varS))*100;
			
			
			
			echo "MannKendall".$S;
			echo "---Var S".$varS;
			echo "----Z=".$Z;
			
			echo "----Trend:".$trend;
			
		
	}
}