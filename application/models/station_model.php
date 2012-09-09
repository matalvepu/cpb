<?php
class Station_model  extends CI_Model
{
   
 function insertStation()
 {
	
	 
	 $data = array(
               'name' =>$this->input->post('station_name') ,
               'latitude' => $this->input->post('latitude'),
               'longitude' => $this->input->post('longitude')
			  
            );
			$this->db->insert('station', $data); 
	 
 }
 
 function getStationData()
 {
	 $name=$this->input->post('station_name');
	 $query="SELECT * From station where name=?";
	  $q=$this->db->query($query,$name);
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{
				
				$data[]=$row;
				
				
			}
			
		 return $data;	
		}
		else return;
	 
 }
 function deleteStation($sid)
 {
	 
	 $query = "DELETE from station where sid=?";
	 $this->db->query($query,$sid);
	 
 }
 function updateStation()
 {
	  $data = array(
	  			'sid' =>$this->input->post('sid'),
               'name' =>$this->input->post('station_name') ,
               'latitude' => $this->input->post('latitude'),
               'longitude' => $this->input->post('longitude')
			  
            );
			
		$this->db->where('sid',$this->input->post('sid'));
        $this->db->update('station', $data); 
	 
	 
 }
 
}