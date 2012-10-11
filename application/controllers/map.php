<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends CI_Controller
{

 public function index()
 {
     $dida=array(1,2,5,6,7,8,9);
     $this->load->model('forecast_model');

     $color=array();
//$color[]='#FF00FF';
     foreach($dida as $did)
     {
        
                       $date= date("Y-m-d");
               $rainfall = $this->forecast_model->getRainfallForecastOfDate($did,$date);   
			   //echo $rainfall."";
         
       
           
                  


			 if( $rainfall<50)
           $color[]='#8EE5EE';
      else if($rainfall<100)
           $color[]='#5F9EA0';
       else if( $rainfall<150)
           $color[]='#00EE00';
       else if( $rainfall<200)
	        $color[]='#00CD00';
	   else if( $rainfall<250)
           $color[]='#EE2C2C';
         else if($rainfall<300)
           $color[]='#8B1A1A';
        else 
           $color[]='#8B0000';
      
       



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

