<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MKTest extends CI_Controller
{
     
	public function index()
	{

            $sid = 1;
            $syear=1960;
            $eyear = 2009;
	        $month=12;
            
            $this->load->model('station_model');
            $stationName= $this->station_model->getName($sid);
           
            echo $stationName;
           
            $this->avgMaxTemp($sid,$month,$syear,$eyear);

            
            
        }

        public function avgMaxTemp($sid,$month,$syear,$eyear)
        {
            
            $this->load->model('weatherDataTemp');
			
			
			

           $array[] = array('Year','AvgMax');
            for($year = $syear ; $year <= $eyear ; $year++)
            {
                $avgMax = $this->weatherDataTemp->avgMaxTempMonthYear($sid,$month,$year);
                $array[] =array($year,$avgMax);
                //$phpArray[] = array("".$year,$avgMin,$avgMax);
            }

           print_r($array);
	}
}