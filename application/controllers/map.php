<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends CI_Controller
{

 public function index()
 {
     $dida=array(1,2,5,6,7,8,9);
     $this->load->model('forecast_model');

     $color=array();

     foreach($dida as $did)
     {
        
         $row= $this->forecast_model->getRainfallForecast($did);
         $rainfall=$row->rainfall;// echo $rainfall;
         
         
       
       if(floor($rainfall/50)==0)
           $color[]='#FF0000';
      else if(floor($rainfall/50)==1)
           $color[]='4B0082';
       else if(floor($rainfall/50)==2)
           $color[]='FFFFFF';
       else if(floor($rainfall/50)==3)
           $color[]='#00FF00' ;
       else if(floor($rainfall/50)==4)
           $color[]='#7CFC00';
        else if(floor($rainfall/50)==5)
           $color[]='#FF00FF';
                  



       



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

