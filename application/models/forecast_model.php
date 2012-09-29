<?php
class Forecast_model  extends CI_Model
{
	
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