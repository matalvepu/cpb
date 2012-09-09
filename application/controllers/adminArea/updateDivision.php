<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UpdateDivision extends CI_Controller
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
		$data['header']='Update Division';
		$this->load->view('eng_segments/normal_head');
		$logodata['title']="Climate Portal Of Bangladesh";
		$this->load->view('eng_segments/logo',$logodata);				
		$this->load->view('adminBodies/top_navigation');
		$this->load->view('adminBodies/selectDivision',$data);
		$this->load->view('eng_segments/footer');

		
		
	}
	
	function showUpdateForm()
	{
		
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('division_name','Division name required','trim|required');
		
		if($this->form_validation->run()==False)
		{
			$data['select']="update";
		    $data['header']='Update Division';
			
			$this->load->view('eng_segments/normal_head');
			$logodata['title']="Climate Portal Of Bangladesh";
			$this->load->view('eng_segments/logo',$logodata);				
			$this->load->view('adminBodies/top_navigation');
			$this->load->view('adminBodies/selectDivision',$data);
			$this->load->view('eng_segments/footer');

			
		}
		
		else 
		{
			
			$this->load->model('division_model');
			if($this->input->post('upload'))
			{
			
			   $msg['data']=$this->division_model->getDivisionData();
			   if($msg['data']==NULL)
			   {
				   $data['msg']="****This Division does not exist****";
					$this->showMessage($data);
			   }
			   else
			   {
			 
			    $this->load->view('eng_segments/normal_head');
				$logodata['title']="Climate Portal Of Bangladesh";
				$this->load->view('eng_segments/logo',$logodata);				
				$this->load->view('adminBodies/top_navigation');
				
			     $this->load->view('adminBodies/updateDivisionForm',$msg);
				$this->load->view('eng_segments/footer');
			   }
			  
			}
			
	    }
	
		
		
	}
	
	function update()
	{
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('division_name','Division required','trim|required');
		$this->form_validation->set_rules('latitude','latitude required','trim|required');
		$this->form_validation->set_rules('longitude','longitude required','trim|required');
		$this->form_validation->set_rules('did','','trim|required');
		if($this->form_validation->run()==False)
		{
			    $this->load->view('eng_segments/normal_head');
				$logodata['title']="Climate Portal Of Bangladesh";
				$this->load->view('eng_segments/logo',$logodata);				
				$this->load->view('adminBodies/top_navigation');
				
			    $this->load->view('adminBodies/updateDivisionForm');
				$this->load->view('eng_segments/footer');
					
		}
		
		else
		{
			$this->load->model('division_model');
			$this->division_model->updateDivision();
			$data['msg']="****You successfully updated the Division****";
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