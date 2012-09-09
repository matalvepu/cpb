<?php
class Weather_model  extends CI_Model
{
	
	
	
	function insertWeatherData()
	{
		 $name=$this->input->post('station_name');
	    $query="SELECT sid From station where name=?";
	    $q=$this->db->query($query,$name);
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{
				
				$data[]=$row;
				
				
			}
			
		 	
		}
		$sid=$data['0']->sid;
		//echo $sid;
		//echo $this->input->post('date');
		$date=substr($this->input->post('date'),6,4)."-".substr($this->input->post('date'),0,2)."-".substr($this->input->post('date'),3,2);
		//echo $date;
		
		
		$data = array(
		       'wdate' =>$date,
               'sid' =>$sid,
               'rainfall' => $this->input->post('rainfall'),
               'mintemp' => $this->input->post('mintemp'),
			   'maxtemp' => $this->input->post('maxtemp'),
			   'humidity' => $this->input->post('humidity')
			  
            );
			
	
			$this->db->insert('weatherdata', $data); 
		
	}
	
	
   function getWeatherData()
   {
	   $name=$this->input->post('station_name');
	    $query="SELECT sid From station where name=?";
	    $q=$this->db->query($query,$name);
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{
				
				$data[]=$row;
				
				
			}
			
		 	
		}else return;
		$sid=$data['0']->sid;
		$date=substr($this->input->post('date'),6,4)."-".substr($this->input->post('date'),0,2)."-".substr($this->input->post('date'),3,2);
		
	    $query="SELECT * From weatherdata where wdate=? and sid=?";
		$data1 = array(
		       'wdate' =>$date,
               'sid' =>$sid
			  
            );
			
	    $q=$this->db->query($query,$data1);
		
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{
				
				$data2[]=$row;
				
				
			}
			
		 	
		}else return;
		
		return $data2;
   }
   
   function deleteWeatherdata($data)
   { 
   
   		//echo $data['wdate'];
		//echo $data['sid'];
          $val = array(
		       'wdate' =>$data['wdate'],
               'sid' =>$data['sid']
			  
            );
	  $query = "DELETE from weatherdata where wdate=? and sid=?";
	 $this->db->query($query,$val);
	   
   }
   function updateWeatherData()
   {
	   
	   $date=substr($this->input->post('date'),6,4)."-".substr($this->input->post('date'),0,2)."-".substr($this->input->post('date'),3,2);
	   
	    $data = array(
		
				'wdate' =>$date,
               'sid' =>$this->input->post('sid'),
               'rainfall' => $this->input->post('rainfall'),
               'mintemp' => $this->input->post('mintemp'),
			   'maxtemp' => $this->input->post('maxtemp'),
			   'humidity' => $this->input->post('humidity')
	  			
			  
            );
			
		$this->db->where('sid',$this->input->post('sid'));
        $this->db->update('weatherdata', $data); 
	   
   }
}