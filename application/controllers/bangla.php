<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bangla extends CI_Controller
{

 public function index()
 {
      $this->session->set_userdata('language', 'bangla');
      redirect(base_url());
 }
}
?>

