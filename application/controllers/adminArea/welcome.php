<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
   function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}
        function index()
        {
            $this->load->view('eng_segments/normal_head');
              $logodata['title']="Climate Portal For Bangladesh";
                     $this->load->view('eng_segments/logo',$logodata);
//$this->load->view('eng_segments/top_navigation');
            $this->load->view('adminBodies/login_view');
            $this->load->view('eng_segments/login_footer');
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

    function validate_credentials()
	{

             $this->load->library('form_validation');


             $this->form_validation->set_rules('mail', 'User Mail','trim|required');
             $this->form_validation->set_rules('pass', 'Password','trim|required');
             if ($this->form_validation->run() == FALSE)
            {
                     $this->index();
             }

             else
             {
                 $this->load->model('adminInfo');

                 $mail = $this->input->post('mail');
                 $pass = $this->input->post('pass');

                 
                  $success = $this->adminInfo->validate($mail,$pass);

					if($success != FALSE) // if the user's credentials validated...
					{
						$data = array(
						   'id' => $success['id'],
							'mail' => $mail,
							'name' =>  $success['name'],
							'is_logged_in' => true
						);
						
									$this->session->set_userdata($data);
									//print_r($data);
						redirect('adminArea/adminPanel');
					}
					else // incorrect id or password
					{
						$this->index();
					}

             }

	}

        function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}
}
