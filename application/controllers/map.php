<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends CI_Controller
{

 public function index()
 {
     $dida=array(2,4,5,6,7,8,9);
     $this->load->model('forecast_model');

     $color=array();

     foreach($dida as $did)
     {
        
         $row= $this->forecast_model->getRainfallForecast($did);
         $rainfall=$row->rainfall; echo $rainfall;
         
         
       
       if(floor($rainfall/50)==0)
           $color[]='#FF0000';
      else if(floor($rainfall/50)==1)
           $color[]='4B0082';
       else if(floor($rainfall/50)==2)
           $color[]='FFFFFF';
       else if(floor($rainfall/50)==3)
           $color[]='#FFFF00' ;
       else if(floor($rainfall/50)==4)
           $color[]='#7CFC00';
        else if(floor($rainfall/50)==5)
           $color[]='#7CFC00';
                  



       



     }
     
     $data['color']=$color;

     $this->load->view('showmap',$data);



    // $this->load->view('showmap');
}
}

