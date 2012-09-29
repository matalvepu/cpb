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

        function unit_test_getRecentData()
        {

            $testdata=array(1,4,19);

            $expected=array(
                "0" => Array ("2009-12-31",0.000,13.000 ,23.500,Null  ),
                "1" => Array ( "2009-12-31",0.000,Null,Null,Null ),
                "2" => Array ( "2009-12-31",Null,15.000,27.700,Null )



            );
            $this->load->model('weather_data');
            $originial=array(
                        );

            foreach($testdata as $sid)
            {
               $row = $this->weather_data->getRecentData($sid);
             //$id=$data->{'ID'};

             $original[]=array($row->wdate,$row->rainfall,$row->mintemp,$row->maxtemp,$row->humidity);

            }
            $this->load->library('unit_test');
            for($i=0;$i<3;$i++)
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
                     "Barishal"=>array(21.1,91.5)

                    );

            $expected=array(1,4,19);

            
            $original=array();

           

           foreach ($test as $latlng) {
               $len++;
                  $lat= $latlng[0];
                  $long=$latlng[1];

                  $sid=$this->getClosestStationSid($lat,$long);
                 
                  $original[]=$sid;
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