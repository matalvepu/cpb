<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AddStation extends CI_Controller
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
		$this->load->view('adminBodies/addStationForm');
		$this->load->view('eng_segments/footer');

		
	}
	function insertStationInfo()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('station_name','Firstname required','trim|required');
		$this->form_validation->set_rules('latitude','latitude required','trim|required');
		$this->form_validation->set_rules('longitude','longitude required','trim|required');
		if($this->form_validation->run()==False)
		{
			$this->load->view('eng_segments/normal_head');
			$logodata['title']="Climate Portal Of Bangladesh";
			$this->load->view('eng_segments/logo',$logodata);				
			$this->load->view('adminBodies/top_navigation');
			$this->load->view('adminBodies/addStationForm');
			$this->load->view('eng_segments/footer');

			
		}
		else
		{
			
			$this->load->model('station_model');
			if($this->input->post('upload'))
			{
			
			   $this->station_model->insertStation();
			}
			
		}
		 redirect('adminArea/adminPanel', 'refresh');
		
	}
}