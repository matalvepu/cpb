<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cluster extends CI_Controller
{
     var $invalidDtae=""; 
	 var $noData="";
	  public function index()
	  {

            $this->load->model('station_model');
			 
			 $data['stationName']=$this->station_model->getNames();
			
			 
			
		
			
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
		
			  $this->load->view('regressionLine_view',$data);
			
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
		   }
		   else {
		   
		     $this->invalidDtae="";
            $this->load->model('station_model');
            $stationName= $this->station_model->getName($sid);
			
			
			
            $title = "Cluster distribution from $syear to $eyear of months $month in $stationName";
			
			echo $title;
            $yAxistitle = "Cluster";

             
             $data['array'] = $this->clusterDistribution($stationName,$syear,$eyear,$month);
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
		
		
		
	       
        public function clusterDistribution($stationName,$syear,$eyear,$month)
        {
           
            $this->load->model('cluster5Model');

           $count=0;
				
		    $php_array[]= array("Year","Cluster");
			
			
            for($year = $syear ; $year <= $eyear ; $year++)
            {
               
                
                
                    $cluster = $this->cluster5Model->whichCluster($stationName,$month,$year);
					echo $cluster;
					if($cluster!=-1)
                    $php_array[] = array($year,$cluster);
					$count++;
                  
                   
               
            }
			
			
            return json_encode($php_array,JSON_NUMERIC_CHECK);
	}
		
		
}

