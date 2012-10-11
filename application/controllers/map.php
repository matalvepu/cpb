<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends CI_Controller
{

 public function index()
 {
     $dida=array(1,2,5,6,7,8,9);
     $this->load->model('forecast_model');

    // $color=array();

     foreach($dida as $did)
     {
        
         $rainfall= $this->forecast_model->getRainfallForecast($did);
        
         
         
       
       if($rainfall>=0 && $rainfall<=50)
           $color[$did]='#8EE5EE';
      else if($rainfall>=51 && $rainfall<=100)
           $color[$did]='#5F9EA0';
       else if($rainfall>=101 && $rainfall<=150)
           $color[$did]='#00EE00';
       else if($rainfall>=151 && $rainfall<=200)
	        $color[$did]='#00CD00';
	   else if($rainfall>=201 && $rainfall<=250)
           $color[$did]='#EE2C2C';
         else if($rainfall>=251 && $rainfall<=300)
           $color[$did]='#8B1A1A';
        else if($rainfall>=351 && $rainfall<=400)
           $color[$did]='#8B0000';
                  



       



     }
  
     $data['color']=$color;
	 
	
	 $this->load->view('eng_segments/normal_head');
      $logodata['title']="বাংলাদেশ ক্লাইমেট পোর্টাল ";
       $this->load->view('eng_segments/logo',$logodata);

    $this->load->view('eng_segments/top_navigation',nav_load('bangla','welcome'));

    $this->load->view('showmap',$data);
	
	$this->load->view('eng_segments/footer');



    // $this->load->view('showmap');
}
}

