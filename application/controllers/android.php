<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Android extends CI_Controller {

	public function index()
	{

        //$this->unit_test_getClosestStationSid();

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

        function unit_test_getRainfallForecast()
        {

            $testdata=array(1,2,5,6,7,8,9);

            $expected = array(30.000,70.000,110.000,160.000,210.000,80.000,180.000);

            $this->load->model('forecast_model');
            $this->load->model('division_model');

            
            foreach($testdata as $did)
            {

                $row = $this->forecast_model->getRainfallForecast($did);
                $output[]=round($row->rainfall,3);

                //echo "$row->rainfall,";
            }
            

            $this->load->library('unit_test');
            for($i=0;$i<7;$i++)
            {
                $codeOutput=$output[$i];
                $expectedvalue=$expected[$i];

                $divisionName = $this->division_model->getDivisionName($testdata[$i]);
                $divisionName = $divisionName->name;
                echo $this->unit->run($codeOutput,$expectedvalue, "Testing Serverside : getRainfallForecast for Division : $divisionName ");
            }
        }
        function unit_test_getRecentData()
        {

            $testdata=array(1,4,17,19,20);

            $expected=array(
                "0" => Array ("2012-10-01",22.000 ,25.000,36.000 ,70.000 ),
                "1" => Array ( "2012-10-01",30.000,26.000,34.000,72.0000 ),
                "2" => Array ( "2012-10-01",30.000,21.000,33.000,71.0000 ),
                "3" => Array ( "2009-12-31",NULL,15.000,27.700,NULL ),
                "4" => Array ( "2012-10-01",5.000,30.000,41.000,29.000 )
            );
            $this->load->model('weather_data');
            $original=array();

            foreach($testdata as $sid)
            {
                $row = $this->weather_data->getRecentData($sid);
                $original[]=array($row->wdate,$row->rainfall,$row->mintemp,$row->maxtemp,$row->humidity);
            }
			
            $this->load->library('unit_test');
            for($i=0;$i<5;$i++)
            {
                $test=$original[$i];
                $expectedvalue=$expected[$i];
                echo $this->unit->run($test,$expectedvalue, 'testing getRecent DAta');


           
            }
        }
        function getDistance($lat, $long, $newlat,$newlong)
        {
            return ((($lat-$newlat)*($lat-$newlat)) + (($long- $newlong)*($long- $newlong)));
        }

        function unit_test_getClosestStationSid()
        {
            $len=0;

            $test=array(
                    "dhaka"=>array(23.7,90.4),
                    "chittagong"=>array(22.29,91.8),
                     "Khulna"=>array(22.8,89.4),
					 "Sylhet"=>array(24.56,91.32),
					 "Rajshahi"=>array(24.20,88.1)

                    );

            $expected=array(1,4,21,17,20);

            
            $original=array();

           

           foreach ($test as $latlng) {
                   $len++;
                  $lat= $latlng[0];
                  $long=$latlng[1];

                  $sid=$this->getClosestStationSid($lat,$long);
                 
                  $original[]=intval($sid);
            }
           


           // print_r($expected);
           // print_r($original);
            $this->load->library('unit_test');
            for($i=0;$i<$len;$i++)
            {

               echo $this->unit->run($original[$i],$expected[$i], 'testing getClosest Station ID');
            }
            

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