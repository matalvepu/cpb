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

		
                 if( $this->session->userdata('language')=='bangla')
                 {
                     $this->load->view('eng_segments/normal_head');
                     $logodata['title']="বাংলাদেশ ক্লাইমেট পোর্টাল ";
                     $this->load->view('eng_segments/logo',$logodata);

                     $this->load->view('eng_segments/top_navigation',nav_load('bangla','welcome'));

                     $data['welcomeMsg'] = 'Climate Portal For Bangladesh';
                     $this->load->view('welcome_view',$data);
                     $this->load->view('eng_segments/footer');
                 }
                 else
                 {
                     $this->load->view('eng_segments/normal_head');
                     $logodata['title']='Climate Portal For Bangladesh';
                     $this->load->view('eng_segments/logo',$logodata);

                     $this->load->view('eng_segments/top_navigation',nav_load('english','welcome'));


                     $data['welcomeMsg'] = 'Climate Portal For Bangladesh';
                     $this->load->view('welcome_view',$data);
                     $this->load->view('eng_segments/footer');
                 }




	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */