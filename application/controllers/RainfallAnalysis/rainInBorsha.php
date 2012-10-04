
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RainInBorsha extends CI_Controller
{
        public $error="";
        function __construct()
	{
		parent::__construct();
		$this->init();
             //   $this->$error="";
	}
        function init()
	{
                if( $this->session->userdata('language') ==FALSE)
                $this->session->set_userdata('language', 'english');
	}

    
	public function index()
	{

             $sid = 1;
             $startYear = 1970;
             $endYear = 2009;
             $type = 1;
             

             $stationName = "Dhaka";
             if($type==1)
             {
                 $data['array'] =  $this->prepareChart($sid,$startYear,$endYear,$type);
                 $data['title'] = "Rain in Monsoon (June 14 -> August 13) in $stationName";
             }

             else if($type==2)
             {
                 $data['array'] =  $this->prepareChart($sid,$startYear,$endYear,$type);
                 $data['title'] = "Rain in Monsoon (June 14 -> August 13) in $stationName -> CUMULATIVE";
             }

             else if($type==3)
             {
                 $data['array'] =  $this->prepareChart3($sid,$startYear,$endYear,$type);
                 $data['title'] = "Rain Difference in consecutive years in Borshakal (June 14 -> August 13) in $stationName";
             }

             $data['error'] = $this->error;
            //$this->load->view('rainfallAnalysis/rainInBorshaView',$data);

             $this->load->helper('nav_loader');


             if( $this->session->userdata('language')=='bangla')
             {
                 $this->load->view('eng_segments/normal_head');
                 $logodata['title']="বাংলাদেশ ক্লাইমেট পোর্টাল ";
                 $this->load->view('eng_segments/logo',$logodata);

                 $this->load->view('eng_segments/top_navigation',nav_load('bangla','welcome'));

                 $data['welcomeMsg'] = 'Climate Portal For Bangladesh';
                 $this->load->view('rainfallAnalysis/rainInBorshaView',$data);
                 $this->load->view('eng_segments/footer');
             }
             else
             {
                 $this->load->view('eng_segments/normal_head');
                 $logodata['title']='Climate Portal For Bangladesh';
                 $this->load->view('eng_segments/logo',$logodata);

                 $this->load->view('eng_segments/top_navigation',nav_load('english','welcome'));


                 $data['welcomeMsg'] = 'Climate Portal For Bangladesh';
                 $this->load->view('rainfallAnalysis/rainInBorshaView',$data);
                 $this->load->view('eng_segments/footer');
             }

           // echo $this->maxTemp(1, 1, 1953);
        }

        public function prepareChart3($sid,$startYear,$endYear,$type)
        {
            $this->error[]= "No data available of Dhaka in 1974.Skipped";

             $lastYear = $rain = $this->totalRain($sid, $startYear);

             $phpArray[] = array('Year','Rainfall');
             $thisYear=0;
             for($year = $startYear+1; $year<=$endYear; $year++)
             {
                 if($year==1974 && $sid==1) //DHAKA 1974 er data silo na
                     continue;

                 
                 $thisYear = $this->totalRain($sid, $year);

                 $diff = $thisYear - $lastYear;

                 $phpArray[] =  array(($year-1)." -> $year",$diff);

                 $lastYear = $thisYear;
             }

           //  print_r($phpArray);
            $js_array = json_encode($phpArray,JSON_NUMERIC_CHECK);

           // print_r($js_array);

            return $js_array;
	}

        public function prepareChart($sid,$startYear,$endYear,$type)
        {
            $this->error[]= "No data available of Dhaka in 1974.Skipped";

             
             $phpArray[] = array('Year','Rainfall');
             $rain=0;
             for($x = $startYear; $x<=$endYear; $x++)
             {
                 if($x==1974 && $sid==1) //DHAKA 1974 er data silo na
                     continue;

                 if($type==1)
                 {
                     $rain = $this->totalRain($sid, $x);
                     
                 }

                 else if($type==2)
                 {
                     $rain += $this->totalRain($sid, $x);
                   
                 }

                 else if($type==3)
                 {
                     $rain += $this->totalRain($sid, $x);
                     
                 }
                 //
                 //FOR CUMULATIVE RAIN 
                 //
                 

                // $minusOne = $this->totalMinusOne($sid, $x);
                 //$null = $this->totalNull($sid, $x);
                 //$rain += $minusOne;

                // if(($minusOne+$null) > 0)
                    // echo "In year $x .Data unavailable in ".($null+$minusOne)." days Null : $null and -1 : $minusOne<br/>";
                 //echo $this->totalRain($sid, $x)."<br/>";
                 $phpArray[] =  array($x,$rain);
             }

           //  print_r($phpArray);
            $js_array = json_encode($phpArray,JSON_NUMERIC_CHECK);

           // print_r($js_array);

            return $js_array;
	}
	
	public function totalRain($sid,$year)
	{
		$q = $this->db->query("SELECT SUM(rainfall) AS a FROM weatherdata WHERE sid = ? AND  `wdate` >=  '?-6-14' AND  `wdate` <=  '?-8-13'",array($sid,$year,$year));
		return $q->row()->a;
	}
        public function totalMinusOne($sid,$year)
	{
		$q = $this->db->query("SELECT COUNT(*) AS a FROM weatherdata WHERE sid = ? AND  `wdate` >=  '?-6-14' AND  `wdate` <=  '?-8-13' AND rainfall=-1",array($sid,$year,$year));
		return $q->row()->a;
	}
        public function totalNull($sid,$year)
	{
		$q = $this->db->query("SELECT COUNT(*) AS a FROM weatherdata WHERE sid = ? AND  `wdate` >=  '?-6-14' AND  `wdate` <=  '?-8-13' AND rainfall IS NULL",array($sid,$year,$year));
		return $q->row()->a;
	}
        
}

