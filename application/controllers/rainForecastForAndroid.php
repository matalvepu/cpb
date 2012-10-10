<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RainForecastForAndroid extends CI_Controller
{

    public function test()
    {
        $this->load->model('division_model');
        $this->load->model('forecast_model');

        $names = $this->division_model->getDivisionNames();

        foreach($names as $name)
        {
               $date= date("Y-m-d");
               $did        =  $this->division_model->getDidByName($name);
               $forecast = $this->forecast_model->getRainfallForecastOfDate($did,$date);  
               $tosend[$name]=$forecast;
               
               //             echo "$name - $did - $forecast<br/>";
        }


      //  print_r($tosend);
        
    }
    public function index()
	{


                           $this->load->model('division_model');
            $this->load->model('forecast_model');

            $names = $this->division_model->getDivisionNames();

            foreach($names as $name)
            {
                   $date= date("Y-m-d");
                   $did        =  $this->division_model->getDidByName($name);
                   $forecast = $this->forecast_model->getRainfallForecastOfDate($did,$date);
                   $tosend[$name]=$forecast;

                   //             echo "$name - $did - $forecast<br/>";
            }
                 print_r(json_encode($tosend));

	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */