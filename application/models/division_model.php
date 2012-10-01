<?php
class Division_model  extends CI_Model
{
    function getDivisionName($did)
        {
                   $q = "SELECT name FROM division WHERE  did = ?";
                   $q = $this->db->query($q,$did);
                   $row = $q->row();
                   return $row;
        }
    function getLatLong($sid)
    {
        $query="SELECT latitude, longitude FROM division WHERE did = ?";
	$q=$this->db->query($query,$sid);
        if($q->row() != NULL)
        {
            foreach($q->result() as $row)
            {
                    $data=array('lat' => $row->latitude,'long' => $row->longitude);
            }
            return $data;
        }
        else return;
    }

    function getDids()
    {
        $query="SELECT did FROM division";
	$q=$this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                    $data[]=$row->did;
            }
            return $data;
        }
        else return;
    }

   
 function insertDivision()
 {
	
	 
	 $data = array(
               'name' =>$this->input->post('division_name') ,
               'latitude' => $this->input->post('latitude'),
               'longitude' => $this->input->post('longitude')
			  
            );
			$this->db->insert('division', $data); 
	 
 }
 
 function getDivisionData()
 {
	 $name=$this->input->post('division_name');
	 $query="SELECT * From division where name=?";
	  $q=$this->db->query($query,$name);
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{
				
				$data[]=$row;
				
				
			}
			
		 return $data;	
		}
	 
 }
 function deleteDivision($did)
 {
	 
	 $query = "DELETE from division where did=?";
	 $this->db->query($query,$did);
	 
 }
 function updateDivision()
 {
	  $data = array(
	  			'did' =>$this->input->post('did'),
               'name' =>$this->input->post('division_name') ,
               'latitude' => $this->input->post('latitude'),
               'longitude' => $this->input->post('longitude')
			  
            );
			
		$this->db->where('did',$this->input->post('did'));
        $this->db->update('division', $data); 
	 
	 
 }
 
}