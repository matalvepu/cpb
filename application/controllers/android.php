<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Android extends CI_Controller {

	public function index()
	{

             $json=$_SERVER['HTTP_JSON'];
             $data=json_decode($json);

             $this->load->model('weather_data');
             $row = $this->weather_data->getRecentData(1);
           //wdate,rainfall,mintemp,maxtemp,humidity

             $lat=$data->{'lat'};
             $long = $data->{'long'};
             //$id=$data->{'ID'};

             $tosend['Date']=$row->wdate;
             $tosend['Rainfall']=$row->rainfall;
             $tosend['Minimimum Temp']=$row->mintemp;
             $tosend['Maximum Temp']=$row->maxtemp;
             $tosend['Humidity']=$row->humidity;

             print_r(json_encode($tosend));  
 
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */