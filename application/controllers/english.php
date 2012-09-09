<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class English extends CI_Controller
{

 public function index()
 {
      $this->session->set_userdata('language', 'english');
     //echo $this->session->userdata('language');
    
      redirect(base_url());
     /*
        if(isset($language))
         {
            $array_items = array('language' => '');
            $this->session->unset_userdata($array_items);
         }

                $data = array(
              'language' => "EN"
            );

            $this->session->set_userdata($data);
            redirect(base_url());


            
      *
      */
 }
}
?>

