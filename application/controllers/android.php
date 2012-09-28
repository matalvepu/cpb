<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Android extends CI_Controller {

	public function index()
	{

             $json=$_SERVER['HTTP_JSON'];
             $data=json_decode($json);

             $this->load->model('weather_data');
             
            //wdate,rainfall,mintemp,maxtemp,humidity

             $lat=$data->{'lat'};
             $long = $data->{'long'};

             $sid = $this->getClosestStationSid($lat,$long);
             $row = $this->weather_data->getRecentData($sid);
             //$id=$data->{'ID'};
             
             $tosend['Date']=$row->wdate;
             $tosend['Rainfall']=$row->rainfall;
             $tosend['Minimimum Temp']=$row->mintemp;
             $tosend['Maximum Temp']=$row->maxtemp;
             $tosend['Humidity']=$row->humidity;

             print_r(json_encode($tosend));  
 
	}

        function getDistance($lat, $long, $newlat,$newlong)
        {
            return ((($lat-$newlat)*($lat-$newlat)) + (($long- $newlong)*($long- $newlong)));
        }

        function getClosestStationSid($lat,$long)
        {
            $this->load->model('station_model');

            $sids = $this->station_model->getSids();

            $closestDistance = -1;
            $closestSid = -1;
            foreach ($sids as $sid)
            {
               $pos = $this->station_model->getLatLong($sid);
               $newlat = $pos['lat'];
               $newlong = $pos['long'];

               $distance = $this->getDistance($lat, $long, $newlat, $newlong);

               if($closestDistance == -1)
               {
                    $closestDistance = $distance;
                    $closestSid = $sid;
               }
               else if($distance < $closestDistance)
               {
                    $closestDistance = $distance;
                    $closestSid = $sid;
               }
            }
            //print_r($stations);
            return $closestSid;
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */