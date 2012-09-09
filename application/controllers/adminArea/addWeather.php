<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AddWeather extends CI_Controller
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
		
		$this->load->view('eng_segments/normal_head');
		$logodata['title']="Climate Portal Of Bangladesh";
		$this->load->view('eng_segments/logo',$logodata);
		$this->load->view('adminBodies/top_navigation');
		$this->load->view('adminBodies/addWeatherForm');
		$this->load->view('eng_segments/footer');
	
		
	}
	
	function insert()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('station_name','Station name required','trim|required');
		$this->form_validation->set_rules('date','Date required','trim|required');
		$this->form_validation->set_rules('rainfall','Rainfall required','trim|required');
		$this->form_validation->set_rules('mintemp','Minimum Temperature required','trim|required');
		$this->form_validation->set_rules('maxtemp','Maximum Temperature required','trim|required');
		$this->form_validation->set_rules('humidity','Humidity required','trim|required');
		
		if($this->form_validation->run()==False)
		{
			$this->load->view('eng_segments/normal_head');
			$logodata['title']="Climate Portal Of Bangladesh";
			$this->load->view('eng_segments/logo',$logodata);
			$this->load->view('adminBodies/top_navigation');
			$this->load->view('adminBodies/addWeatherForm');
			$this->load->view('eng_segments/footer');
		
			
		}
		else
		{
			
			$this->load->model('weather_model');
			if($this->input->post('upload'))
			{
			
			   $this->weather_model->insertWeatherData();
			}
			
			$data['msg']="****You successfully inserted the weather data****";
			$this->load->view('eng_segments/normal_head');
			
			
			$logodata['title']="Climate Portal Of Bangladesh";
			$this->load->view('eng_segments/logo',$logodata);				
			$this->load->view('adminBodies/top_navigation');
			$this->load->view('adminBodies/showMessage',$data);
			$this->load->view('eng_segments/footer');

		}
		
	}
}