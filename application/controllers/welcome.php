<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    function __construct()
	{
		parent::__construct();
		$this->init();
	}
        function init()
	{
                    if( $this->session->userdata('language') ==FALSE)
                     $this->session->set_userdata('language', 'bangla');
	}
	
	public function index()
	{
		$this->load->helper('nav_loader');
		
		/*
		$this->load->model('welcome_msg_model');
		$msg=$this->welcome_msg_model->getall();
		$data['firstname']=$msg['0']->firstname;
		$data['lastname']=$msg['0']->lastname;
		$data['designation']=$msg['0']->designation;
		$data['message']=$msg['0']->message;
		
		$data['images']=$this->welcome_msg_model->get_image();
				*/
		

                 if( $this->session->userdata('language')=='bangla')
                 {
                     $this->load->view('bng_segments/slideshow_head');
                     $logodata['title']="Bangladesh Agrometeorology Department";
                     $this->load->view('eng_segments/logo',$logodata);

                     $this->load->view('eng_segments/top_navigation',nav_load('bangla','welcome'));

                     $this->load->view('welcome_view');
                     $this->load->view('eng_segments/footer');
                 }
                 else
                 {
                     $this->load->view('eng_segments/slideshow_head');
                     $logodata['title']='Bangladesh Agrometeorology Department';
                     $this->load->view('eng_segments/logo',$logodata);

                     $this->load->view('eng_segments/top_navigation',nav_load('english','welcome'));

                     $this->load->view('welcome_view');
                     $this->load->view('eng_segments/footer');
                 }

                 


	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */