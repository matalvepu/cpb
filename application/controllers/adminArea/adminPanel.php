<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminPanel extends CI_Controller
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
              $logodata['title']="Climate Portal For Bangladesh";
                     $this->load->view('eng_segments/logo',$logodata);
                $this->load->view('adminBodies/top_navigation');
                $this->load->view('adminBodies/admin_panel_view');
                 
		      $this->load->view('eng_segments/footer');

        }

}
