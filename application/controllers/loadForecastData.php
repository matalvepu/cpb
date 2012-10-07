<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoadForecastData extends CI_Controller
{
	public function index()
	{
            $this->load->model('station_model');


            $sid = $this->getClosestStation(21.5,92);

            echo "sid : $sid";
         }

         public function test($did,$date)
         {
                
                $q = "SELECT * FROM forecast WHERE did = ? AND fdate = ?";
                $q = $this->db->query($q,array($did,$date));

                if($q->row() != NULL)
                {
                    return true;
                }
                else
                    return false;

         }

         public function getRandom($x)
         {
                $rand = rand((-1)*$x,$x);
                $rand/=100;

                return $rand;
         }
         public function load()
         {
                 set_time_limit(0);
                 $this->load->model('station_model');
                 $this->load->model('weather_data');

                 $dids=array(1,2,5,6,7,8,9);
                 $sids=array(4,1,17,32,20,26,21);

                 // BONDHO KORE RAKHLAM
                 for($i=0;$i<0;$i++)
                 //for($i=0;$i<7;$i++)
                    {
                                     $sid = $sids[$i];
                                     $did = $dids[$i];
                                     $nowTime  =  mktime(NULL,NULL,NULL,1,1,2012);
                                     $backTime  =  mktime(NULL,NULL,NULL,1,1,2009);
                                     $stopTime =  mktime(NULL,NULL,NULL,1,1,2013);
                                     $nowDate   =  date("Y-m-d",$nowTime);
                                     $backDate   = date("Y-m-d",$backTime);

                                     $stopDate = date("Y-m-d",$stopTime);
                                    while($nowDate != $stopDate)
                                     {
                                        echo "NowDate: $nowDate BackDate : $backDate<br/>";

                                        // FETCH WEATHER DATA
                                        $q = "SELECT maxtemp,mintemp,rainfall FROM weatherData WHERE sid = ? AND wdate = ?";
                                        $q = $this->db->query($q,array($sid,$backDate));
                                        if($q->row()!=NULL)
                                        {$maxtemp = $q->row()->maxtemp;
                                        $mintemp = $q->row()->mintemp;
                                        $rainfall = $q->row()->rainfall;
                                        }

                                        echo "$maxtemp $mintemp $rainfall<br/>";

                                        // CHANGE RANDOMLY
                                        $maxtemp += $this->getRandom(300);
                                        $mintemp += $this->getRandom(300);
                                        $rainfall += $this->getRandom(1000);
                                        if($rainfall<0)$rainfall=0;


                                        // ALREADY DATA ASE SKIP
                                        if($this->test($did, $nowDate)==FALSE)
                                        {
                                        //INSERT INTO FORECAST
                                        $q = "INSERT INTO forecast VALUES (?,?,?,?,?)";
                                        $q = $this->db->query($q,array($nowDate,$did,$mintemp,$maxtemp,$rainfall));
                                        }

                                        //INCREMENT NOW AND BACKDATE

                                        $nowTime += (24*3600) ;
                                     $backTime  += (24*3600);

                                     $nowDate   =  date("Y-m-d",$nowTime);
                                     $backDate   = date("Y-m-d",$backTime);


                                     }
                 
}
         }
}

?>
