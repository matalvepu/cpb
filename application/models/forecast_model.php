<?php
class Forecast_model  extends CI_Model
{
        function getAvgMaxTempForecastBetweenDate($did,$sdate,$edate)
        {
                $this->db->select_avg('maxtemp');
                $this->db->where('did', $did);
                $this->db->where('fdate >= ', $sdate);
                $this->db->where('fdate <= ', $edate);
                $q = $this->db->get('forecast');
                if($q->result() != NULL)
                    return $q->row()->maxtemp;
                else
                    return NULL;
        }

        function getAvgMinTempForecastBetweenDate($did,$sdate,$edate)
        {
                $this->db->select_avg('mintemp');
                $this->db->where('did', $did);
                $this->db->where('fdate >= ', $sdate);
                $this->db->where('fdate <= ', $edate);
                $q = $this->db->get('forecast');
                if($q->result() != NULL)
                    return $q->row()->mintemp;
                else
                    return NULL;
        }

        function getRainfallForecastSumBetweenDate($did,$sdate,$edate)
        {
                $this->db->select_sum('rainfall');
                $this->db->where('did', $did);
                $this->db->where('fdate >= ', $sdate);
                $this->db->where('fdate <= ', $edate);
                $q = $this->db->get('forecast');
                if($q->result() != NULL)
                    return $q->row()->rainfall;
                else
                    return NULL;
        }
        
    	function getRainfallForecast($did)
        {
                    $date = date("Y-m-d");
                   $q = "SELECT rainfall FROM forecast WHERE fdate = ? AND did = ?";
                   $q = $this->db->query($q,array($date,$did));
                   $row = $q->row();
                   echo "$row->rainfall";
                   return $row;
        }

        function getRainfallForecastOfDate($did,$date)
        {
                   $q = "SELECT rainfall FROM forecast WHERE fdate = ? AND did = ?";
                   $q = $this->db->query($q,array($date,$did));
                   $row = $q->row();
                   return $row->rainfall;
        }


        function getForecastOfTomorrow($did)
        {
                    $date=date("Y-m-d",time());
                   $q = "SELECT fdate,rainfall,mintemp,maxtemp FROM forecast WHERE fdate = ? AND did = ?";
                   $q = $this->db->query($q,array($date,$did));
                   $row = $q->row();
                   return $row;
        }

	function getForecast($did)
        {
                   $q = "SELECT fdate,rainfall,mintemp,maxtemp FROM forecast WHERE fdate = (SELECT max(fdate) FROM forecast where did = ? ) AND did = ?";
                   $q = $this->db->query($q,array($did,$did));
                   $row = $q->row();
                   return $row;
        }
	
	function insertForecastData()
	{
		 $name=$this->input->post('division_name');
                 $query="SELECT did From division where name=?";
                $q=$this->db->query($query,$name);
                if($q->num_rows()>0)
                {
                        foreach($q->result() as $row)
                        {

                                $data[]=$row;


                        }
                }
                $did=$data['0']->did;
                //echo $sid;
                //echo $this->input->post('date');
                $date=substr($this->input->post('date'),6,4)."-".substr($this->input->post('date'),0,2)."-".substr($this->input->post('date'),3,2);
                //echo $date;

		
		$data = array(
		       'fdate' =>$date,
               'did' =>$did,
               'mintemp' => $this->input->post('mintemp'),
			   'maxtemp' => $this->input->post('maxtemp'),
			   'rainfall' => $this->input->post('rainfall')
			   
            );
			
	
			$this->db->insert('forecast', $data); 
		
	}
	
	
   function getForecastData()
   {
	   $name=$this->input->post('division_name');
	    $query="SELECT did From division where name=?";
	    $q=$this->db->query($query,$name);
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{
				
				$data[]=$row;
				
				
			}
			
		 	
		}
	    else return ;
		$did=$data['0']->did;
		$date=substr($this->input->post('date'),6,4)."-".substr($this->input->post('date'),0,2)."-".substr($this->input->post('date'),3,2);
		
	    $query="SELECT * From forecast where fdate=? and did=?";
		$data1 = array(
		       'fdate' =>$date,
               'did' =>$did
			  
            );
			
	    $q=$this->db->query($query,$data1);
		
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{
				
				$data2[]=$row;
				
				
			}
			
		 	
		}
		else return;
		return $data2;
   }
   
   function deleteForecastdata($data)
   { 
   
   		
          $val = array(
		       'fdate' =>$data['fdate'],
               'did' =>$data['did']
			  
            );
	  $query = "DELETE from forecast where fdate=? and did=?";
	 $this->db->query($query,$val);
	   
   }
   function updateForecastData()
   {
	   
	   $date=substr($this->input->post('date'),6,4)."-".substr($this->input->post('date'),0,2)."-".substr($this->input->post('date'),3,2);
	   
	    $data = array(
		
				'fdate' =>$date,
               'did' =>$this->input->post('did'),
               'mintemp' => $this->input->post('mintemp'),
			   'maxtemp' => $this->input->post('maxtemp'),
			   'rainfall' => $this->input->post('rainfall')
			   
			  
            );
			
		$this->db->where('did',$this->input->post('did'));
        $this->db->update('forecast', $data); 
	   
   }
}