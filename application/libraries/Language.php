<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language {

    public function checkLanguage()
    {
        //$this->load->library('session');
        if( $this->session->userdata('language') ==FALSE)
                     $this->session->set_userdata('language', 'bangla');
    }
}
?>
