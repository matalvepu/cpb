<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller
{

 

	public function index()
	{
            $this->load->model('station_model');


            $sid = $this->getClosestStation(21.5,92);

            echo "sid : $sid";
         }

        
}

?>
