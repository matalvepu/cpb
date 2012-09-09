<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UpdateWeather extends CI_Controller
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
		$data['header']='Update Weather';
		$this->load->view('eng_segments/normal_head');
		$logodata['title']="Climate Portal Of Bangladesh";
		$this->load->view('eng_segments/logo',$logodata);				
		$this->load->view('adminBodies/top_navigation');
		$this->load->view('adminBodies/selectWeatherDataForm',$data);
		$this->load->view('eng_segments/footer');
	}
    function showUpdateForm()
	{
		
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('station_name','Station name required','trim|required');
		$this->form_validation->set_rules('date','Date required','trim|required');
		if($this->form_validation->run()==False)
		{
			$data['select']="update";
		    $data['header']='Update Station';
			
			$this->load->view('eng_segments/normal_head');
			$logodata['title']="Climate Portal Of Bangladesh";
			$this->load->view('eng_segments/logo',$logodata);				
			$this->load->view('adminBodies/top_navigation');
			$this->load->view('adminBodies/selectWeatherDataForm',$data);
			$this->load->view('eng_segments/footer');

			
		}
		
		else 
		{
			
			$this->load->model('weather_model');
			if($this->input->post('upload'))
			{
			
			   $msg['data']=$this->weather_model->getWeatherData();
			   if($msg['data']==null)
			     {
				    $data['msg']="****This Data does not exist***";
					$this->showMessage($data);
				   }
				 else
				 {
			   $msg['station_name']=$this->input->post('station_name');
			 
			    $this->load->view('eng_segments/normal_head');
				$logodata['title']="Climate Portal Of Bangladesh";
				$this->load->view('eng_segments/logo',$logodata);				
				$this->load->view('adminBodies/top_navigation');
				
			     $this->load->view('adminBodies/updateWeatherForm',$msg);
				$this->load->view('eng_segments/footer');
				 }
			  
			}
			
	    }
	}
	
	function update()
	{
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('station_name','Station name required','trim|required');
		$this->form_validation->set_rules('rainfall','Rainfall required','trim|required');
		$this->form_validation->set_rules('mintemp','Minimum Temperature required','trim|required');
		$this->form_validation->set_rules('sid','','trim|required');
		$this->form_validation->set_rules('maxtemp','Maximum temperature required','trim|required');
		$this->form_validation->set_rules('humidity','Humidity required','trim|required');
		$this->form_validation->set_rules('date','Date required','trim|required');
		
		
		if($this->form_validation->run()==False)
		{
			    $this->load->view('eng_segments/normal_head');
				$logodata['title']="Climate Portal Of Bangladesh";
				$this->load->view('eng_segments/logo',$logodata);				
				$this->load->view('adminBodies/top_navigation');
				
			    $this->load->view('adminBodies/updateWeatherForm');
				$this->load->view('eng_segments/footer');
					
		}
		
		else
		{
			$this->load->model('weather_model');
			$this->weather_model->updateWeatherData();
			$data['msg']="****You successfully updated the weather data****";
			$this->load->view('eng_segments/normal_head');
			
			
			$logodata['title']="Climate Portal Of Bangladesh";
			$this->load->view('eng_segments/logo',$logodata);				
			$this->load->view('adminBodies/top_navigation');
			$this->load->view('adminBodies/showMessage',$data);
			$this->load->view('eng_segments/footer');
			
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