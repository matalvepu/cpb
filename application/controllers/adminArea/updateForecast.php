<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UpdateForecast extends CI_Controller
{
	
	 function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}
    function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
                    echo "YOU ARE NOT LOGGED IN !! PLEASE LOGIN IN!!";
                    redirect('adminArea', 'refresh');
		}
	}
	function index()
	{
		$data['select']="update";
		$data['header']='Update Forecast Data';
		$this->load->view('eng_segments/normal_head');
		$logodata['title']="Climate Portal Of Bangladesh";
		$this->load->view('eng_segments/logo',$logodata);				
		$this->load->view('adminBodies/top_navigation');
		$this->load->view('adminBodies/selectForecastDataForm',$data);
		$this->load->view('eng_segments/footer');
	}
    function showUpdateForm()
	{
		
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('division_name','Division name required','trim|required');
		$this->form_validation->set_rules('date','Date required','trim|required');
		if($this->form_validation->run()==False)
		{
			$data['select']="update";
		    $data['header']='Update Forecast Data';
			
			$this->load->view('eng_segments/normal_head');
			$logodata['title']="Climate Portal Of Bangladesh";
			$this->load->view('eng_segments/logo',$logodata);				
			$this->load->view('adminBodies/top_navigation');
			$this->load->view('adminBodies/selectForecastDataForm',$data);
			$this->load->view('eng_segments/footer');

			
		}
		
		else 
		{
			
			$this->load->model('forecast_model');
			if($this->input->post('upload'))
			{
			
			   $msg['data']=$this->forecast_model->getForecastData();
			   if($msg['data']==NULL)
			   {
				   $data['msg']="****This Data does not exist****";
			        $this->showMessage($data);
			   }
			   
			   else
			   {
			   
				   $msg['division_name']=$this->input->post('division_name');
				 
					$this->load->view('eng_segments/normal_head');
					$logodata['title']="Climate Portal Of Bangladesh";
					$this->load->view('eng_segments/logo',$logodata);				
					$this->load->view('adminBodies/top_navigation');
					
					 $this->load->view('adminBodies/updateForecastForm',$msg);
					$this->load->view('eng_segments/footer');
			   }
			  
			}
			
	    }
	}
	
	function update()
	{
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('division_name','Division name required','trim|required');
		$this->form_validation->set_rules('rainfall','Rainfall required','trim|required');
		$this->form_validation->set_rules('mintemp','Minimum Temperature required','trim|required');
		$this->form_validation->set_rules('did','','trim|required');
		$this->form_validation->set_rules('maxtemp','Maximum temperature required','trim|required');
		
		$this->form_validation->set_rules('date','Date required','trim|required');
		
		
		if($this->form_validation->run()==False)
		{
			    $this->load->view('eng_segments/normal_head');
				$logodata['title']="Climate Portal Of Bangladesh";
				$this->load->view('eng_segments/logo',$logodata);				
				$this->load->view('adminBodies/top_navigation');
				
			    $this->load->view('adminBodies/updateForecastForm');
				$this->load->view('eng_segments/footer');
					
		}
		
		else
		{
			$this->load->model('forecast_model');
			$this->forecast_model->updateForecastData();
			$data['msg']="****You have  successfully updated the forecast data****";
			$this->showMessage($data);
			
		}
		
		
		
	}
	
	function showMessage($data)
	{
		$this->load->view('eng_segments/normal_head');
			
			
			$logodata['title']="Climate Portal Of Bangladesh";
			$this->load->view('eng_segments/logo',$logodata);				
			$this->load->view('adminBodies/top_navigation');
			$this->load->view('adminBodies/showMessage',$data);
			$this->load->view('eng_segments/footer');
			
	}
	
}