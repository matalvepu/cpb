<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ForecastForAndroid extends CI_Controller {

    function test()
    {
        $this->load->model('forecast_model');
        
        $row = $this->forecast_model->getForecast(4);

        $tosend['Date']=$row->fdate;
             $tosend['Rainfall']=$row->rainfall;
             $tosend['Minimimum Temp']=$row->mintemp;
             $tosend['Maximum Temp']=$row->maxtemp;

             echo $tosend['Date'] . $tosend['Rainfall'] . $tosend['Minimimum Temp'] . $tosend['Maximum Temp'];

             echo "<br/>".$this->getClosestDivisionDid(23.7, 90.3);

//print_r($row);
    }
	public function index()
	{

             $json=$_SERVER['HTTP_JSON'];
             $data=json_decode($json);

             $this->load->model('forecast_model');
             
            //wdate,rainfall,mintemp,maxtemp,humidity

             $lat=$data->{'lat'};
             $long = $data->{'long'};

             $did = $this->getClosestDivisionDid($lat,$long);
             //echo "$lat $long $did";
             
             $row = $this->forecast_model->getForecast($did);
             //$id=$data->{'ID'};
            // if($row == NULL) echo "NULL";
             if($row != NULL)
             {
                 $tosend['Date']=$row->fdate;
                 $tosend['Rainfall']=$row->rainfall;
                 $tosend['Minimimum Temp']=$row->mintemp;
                 $tosend['Maximum Temp']=$row->maxtemp;
             }
            else
             {
                 $tosend['Date']=NULL;
                 $tosend['Rainfall']=NULL;
                 $tosend['Minimimum Temp']=NULL;
                 $tosend['Maximum Temp']=NULL;
             }
             
             print_r(json_encode($tosend));  
 
	}

        function getDistance($lat, $long, $newlat,$newlong)
        {
            return ((($lat-$newlat)*($lat-$newlat)) + (($long- $newlong)*($long- $newlong)));
        }

        function getClosestDivisionDid($lat,$long)
        {
            $this->load->model('division_model');

            $dids = $this->division_model->getDids();

            $closestDistance = -1;
            $closestDid = -1;
            foreach ($dids as $did)
            {
               $pos = $this->division_model->getLatLong($did);
               $newlat = $pos['lat'];
               $newlong = $pos['long'];

               $distance = $this->getDistance($lat, $long, $newlat, $newlong);

               if($closestDistance == -1)
               {
                    $closestDistance = $distance;
                    $closestDid = $did;
               }
               else if($distance < $closestDistance)
               {
                    $closestDistance = $distance;
                    $closestDid = $did;
               }
            }
            //print_r($stations);
            return $closestDid;
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */