<?php
class Division_model  extends CI_Model
{
   
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