<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cluster extends CI_Controller
{
     var $invalidDtae=""; 
	 var $noData="";
	 var $count;
	  public function index()
	  {

            $this->load->model('station_model');
			 
			 $data['stationName']=$this->station_model->getNames();
			
			 
			 $data['invalidDate']=$this->invalidDtae;
			 $data['noData']=$this->noData;
			  
		
			
			 $this->load->view('eng_segments/normal_head');
			  $logodata['title']="বাংলাদেশ ক্লাইমেট পোর্টাল ";
			 $this->load->view('eng_segments/logo',$logodata);
		
			  $this->load->view('eng_segments/top_navigation',nav_load('bangla','analysis'));
		
			  $this->load->view('rainfallAnalysis/cluster_form',$data);
			
			   $this->load->view('eng_segments/footer');
			
		   
        }
		
		function errorMessage()
		{
			
			 $this->load->model('station_model');
			 
			 $data['stationName']=$this->station_model->getNames();
		   
			 $data['invalidDate']=$this->invalidDtae;
			 $data['noData']=$this->noData;
			  
			 
			 $this->load->view('eng_segments/normal_head',$data);
			  $logodata['title']="বাংলাদেশ ক্লাইমেট পোর্টাল ";
			 $this->load->view('eng_segments/logo',$logodata);
		
			  $this->load->view('eng_segments/top_navigation',nav_load('bangla','analysis'));
		
			  $this->load->view('rainfallAnalysis/cluster_form',$data);
			
			   $this->load->view('eng_segments/footer');
			
			
		}
		function showGraph()
		{
		  	 $sid=intval($this->input->post('station_name'));
			 $syear=intval($this->input->post('startyear'));
			 $eyear=intval($this->input->post('lastyear'));
			 $type=$this->input->post('type');
			 $month=intval($this->input->post('month'));
			 
           
		   if($syear>$eyear)
		   {
			   $this->invalidDtae="In valide time span";
			   $this->errorMessage();
		   }
		   else {
		   
		     $this->invalidDtae="";
            $this->load->model('station_model');
            $stationName= $this->station_model->getName($sid);
			
			
			$monthname=$this->getMonthString($month);
			
			if(!strcmp($type,"cluster5"))
			{
                 $title = "Cluster distribution 5 from $syear to $eyear of months $monthname in $stationName";
			}
			else
			{
			   $title = "Cluster distribution 3 from $syear to $eyear of months $monthname in $stationName";
			}
			
			
			//echo $title;
            $yAxistitle = "Cluster";

             $data['invalidDate']=$this->invalidDtae;
			 $data['noData']=$this->noData;
             $data['array'] = $this->clusterDistribution($stationName,$syear,$eyear,$month,$type);
			 if($this->count==0)
			 {
				 $noData="No data available in this time span";
				 $this->errorMessage();
			 }
			 else
			 {
				 $data['title'] = mysql_real_escape_string($title);
				 $data['yAxistitle'] = mysql_real_escape_string($yAxistitle);
				
				
				
				  $this->load->model('station_model');
				 
				 $data['stationName']=$this->station_model->getNames();
				
				$this->load->view('eng_segments/graph_header',$data);
				  $logodata['title']="বাংলাদেশ ক্লাইমেট পোর্টাল ";
				 $this->load->view('eng_segments/logo',$logodata);
			
				  $this->load->view('eng_segments/top_navigation',nav_load('bangla','analysis'));
			
				  $this->load->view('rainfallAnalysis/cluster_form',$data);
				
				   $this->load->view('eng_segments/footer');
			 }
		   }
			
		
          
		}
		
		
		
	       
        public function clusterDistribution($stationName,$syear,$eyear,$month,$type)
        {
           if(!strcmp($type,"cluster5"))
            $this->load->model('cluster5Model');
			else
			 $this->load->model('cluster3Model');

           $this->count=0;
				
		    $php_array[]= array("Year","Cluster");
			
			
            for($year = $syear ; $year <= $eyear ; $year++)
            {
               
                
				
                  if(!strcmp($type,"cluster5"))
                    $cluster = $this->cluster5Model->whichCluster($stationName,$month,$year);
				 else
					$cluster = $this->cluster3Model->whichCluster($stationName,$month,$year);
					
					
					if($cluster!=-1)
                    $php_array[] = array($year,$cluster);
					$this->count++;
                  
                   
               
            }
			
			
            return json_encode($php_array,JSON_NUMERIC_CHECK);
	}
	
	function getMonthString($n)
	{
	  $timestamp = mktime(0, 0, 0, $n, 1, 2005);
	
	  return date("F", $timestamp);
	}
		
		
}

