<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class DeleteStation extends CI_Controller
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
		$data['header']='Delete Station';
		$this->load->view('eng_segments/normal_head');
		$logodata['title']="Climate Portal Of Bangladesh";
		$this->load->view('eng_segments/logo',$logodata);				
		$this->load->view('adminBodies/top_navigation');
		$this->load->view('adminBodies/selectStationForm',$data);
		$this->load->view('eng_segments/footer');
	}
	
	function deleteConfirm()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('station_name','Station name required','trim|required');
		
		if($this->form_validation->run()==False)
		{
			$data['select']="delete";
			$data['header']='Delete Station';
			$this->load->view('eng_segments/normal_head');
			$logodata['title']="Climate Portal Of Bangladesh";
			$this->load->view('eng_segments/logo',$logodata);				
			$this->load->view('adminBodies/top_navigation');
			$this->load->view('adminBodies/selectStationForm',$data);
			$this->load->view('eng_segments/footer');

			
		}
		else
		{
			
			$this->load->model('station_model');
			if($this->input->post('upload'))
			{
			
			   $msg['data']=$this->station_model->getStationData();
			   if($msg['data']==null)
			     {
				    $data['msg']="****This Data does not exist***";
					$this->showMessage($data);
				   }
				 else
				 {	
			  
				   $this->load->view('eng_segments/normal_head');
					$logodata['title']="Climate Portal Of Bangladesh";
					$this->load->view('eng_segments/logo',$logodata);				
					$this->load->view('adminBodies/top_navigation');
					$this->load->view('adminBodies/deleteStationConfirmForm',$msg);
					$this->load->view('eng_segments/footer');
				 }
			  
			}
			
			
		}
		// redirect('adminArea/addStation', 'refresh');
		
		
	}
	
	function delete()
	{
		 $sid=$this->uri->segment(4);
		
		$this->load->model('station_model');
		$this->station_model->deleteStation($sid);
		$data['msg']="****You successfully deleted the STATION****";
		$this->load->view('eng_segments/normal_head');
		
		
		$logodata['title']="Climate Portal Of Bangladesh";
		$this->load->view('eng_segments/logo',$logodata);				
		$this->load->view('adminBodies/top_navigation');
		$this->load->view('adminBodies/showMessage',$data);
		$this->load->view('eng_segments/footer');

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