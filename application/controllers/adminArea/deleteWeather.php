<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class DeleteWeather extends CI_Controller
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
		$data['select']="delete";
		$data['header']='Select The Weather Data';
		$this->load->view('eng_segments/normal_head');
		$logodata['title']="Climate Portal Of Bangladesh";
		$this->load->view('eng_segments/logo',$logodata);				
		$this->load->view('adminBodies/top_navigation');
		$this->load->view('adminBodies/selectWeatherDataForm',$data);
		$this->load->view('eng_segments/footer');
	}
	
	function deleteConfirm()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('station_name','Station name required','trim|required');
		$this->form_validation->set_rules('date','Date required','trim|required');
		
		if($this->form_validation->run()==False)
		{
			$data['select']="delete";
			$data['header']='Select The Weather Data';
			$this->load->view('eng_segments/normal_head');
			$logodata['title']="Climate Portal Of Bangladesh";
			$this->load->view('eng_segments/logo',$logodata);				
			$this->load->view('adminBodies/top_navigation');
			$this->load->view('adminBodies/selectWeatherDataForm',$data);
			$this->load->view('eng_segments/footer');

			
		}
		else
		{
			
			
			if($this->input->post('upload'))
			{
			
			     
			    $this->load->model('weather_model');
				$msg['station_name']=$this->input->post('station_name');
				$msg['data']=$this->weather_model->getWeatherData();
				if($msg['data']==null)
			     {
				   $data['msg']="****This Data does not exist***";
					$this->showMessage($data);
				   }
				 else
				 {  
				
				
				//$this->weather_model->deleteWeatherData($data);
			  
						$this->load->view('eng_segments/normal_head');
						$logodata['title']="Climate Portal Of Bangladesh";
						$this->load->view('eng_segments/logo',$logodata);				
						$this->load->view('adminBodies/top_navigation');
						$this->load->view('adminBodies/deleteWeatherConfirmForm',$msg);
						$this->load->view('eng_segments/footer');
				 }
				//echo $msg;
			  
			}
			
			
		}
		// redirect('adminArea/addStation', 'refresh');
		
		
	}
	
	function delete()
	{
		 $data['sid']=$this->uri->segment(4);
		 $data['wdate']=$this->uri->segment(5);
		
		$this->load->model('weather_model');
		$this->weather_model->deleteWeatherData($data);
		
		
		
		$data['msg']="****You successfully deleted the data ";
		$this->showMessage($data);
		
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