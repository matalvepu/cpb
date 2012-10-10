<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cropinformation extends CI_Controller
{
     
	  public function index()
	  {
		  
		     $this->load->model('station_model');
			 
			 $data['stationName']=$this->station_model->getNames();

            $this->load->model('cropModel');
			 
			 $data['cropName']=$this->cropModel->getBanglaCropNames();
			
			
			
			
			 $this->load->view('eng_segments/normal_head');
			  $logodata['title']="বাংলাদেশ ক্লাইমেট পোর্টাল ";
			 $this->load->view('eng_segments/logo',$logodata);
		
			 // $this->load->view('eng_segments/top_navigation',nav_load('bangla','analysis'));
			    $this->load->view('adminBodies/top_navigation',nav_load('bangla','analysis'));
		
			  $this->load->view('adminBodies/cropinformation_view',$data);
			
			   $this->load->view('eng_segments/footer');
			
		   
        }
		
		
		function insertInformation()
		{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('station_name','Station name required','trim|required');
		$this->form_validation->set_rules('sdate','Date required','trim|required');
		$this->form_validation->set_rules('hdate','Date required','trim|required');
		
		$this->form_validation->set_rules('amount','Amount required','trim|required');
		$this->form_validation->set_rules('cost','Cost required','trim|required');
		$this->form_validation->set_rules('sellingprice','Selling price required','trim|required');
		
		if($this->form_validation->run()==False)
		{
			
		    $this->load->model('station_model');
			 
			 $data['stationName']=$this->station_model->getNames();

            $this->load->model('cropModel');
			 
			 $data['cropName']=$this->cropModel->getBanglaCropNames();
			
			
			
			
			 $this->load->view('eng_segments/normal_head');
			  $logodata['title']="বাংলাদেশ ক্লাইমেট পোর্টাল ";
			 $this->load->view('eng_segments/logo',$logodata);
		
			  
			  $this->load->view('adminBodies/top_navigation',nav_load('bangla','analysis'));
		
			  $this->load->view('adminBodies/cropinformation_view',$data);
			
			   $this->load->view('eng_segments/footer');
			
		}
		else
		{
			
			
			if($this->input->post('upload'))
			{
				
		$sdate=substr($this->input->post('sdate'),6,4)."-".substr($this->input->post('date'),0,2)."-".substr($this->input->post('date'),3,2);
		$hdate=substr($this->input->post('hdate'),6,4)."-".substr($this->input->post('date'),0,2)."-".substr($this->input->post('date'),3,2);
				$cultivationdata = array(
			   'surrogateId' => NULL,
               'sid' =>$this->input->post('station_name'),
			   'cropid'=>$this->input->post('crop_name'),
			   'startTime'=>$sdate,
			   'harvestTime'=>$hdate,
               'quantity' => $this->input->post('amount'),
               'productionCost' => $this->input->post('cost'),
			   'sellingPrice' => $this->input->post('sellingprice'),
			   'landSize' => $this->input->post('landspace')
			  
                 );
			
			$this->load->model('cultivationDataModel');
			
			  $this->cultivationDataModel->insertCultivationData($cultivationdata);
			}
			
			
			
			$data['msg']="****You have successfully inserted the cultivation data****";
			 $this->load->model('station_model');
			 
			 $data['stationName']=$this->station_model->getNames();

            $this->load->model('cropModel');
			 
			 $data['cropName']=$this->cropModel->getBanglaCropNames();
			
			
			
			
			 $this->load->view('eng_segments/normal_head');
			  $logodata['title']="বাংলাদেশ ক্লাইমেট পোর্টাল ";
			 $this->load->view('eng_segments/logo',$logodata);
		
			  
			  $this->load->view('adminBodies/top_navigation',nav_load('bangla','analysis'));
		
			  $this->load->view('adminBodies/cropinformation_view',$data);
			
			   $this->load->view('eng_segments/footer');
			
			/*$data['msg']="****You successfully inserted the cultivation data****";
			$this->load->view('eng_segments/normal_head');
			
			 $logodata['title']="বাংলাদেশ ক্লাইমেট পোর্টাল ";
			 $this->load->view('eng_segments/logo',$logodata);				
			
			  $this->load->view('adminBodies/top_navigation',nav_load('bangla','analysis'));
			$this->load->view('adminBodies/showMessage',$data);
			$this->load->view('eng_segments/footer');*/

		}
		
			
			
			
		}
		
}