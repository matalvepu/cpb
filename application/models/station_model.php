<?php
class Station_model  extends CI_Model
{

    function getSidandName()
    {
        $query="SELECT sid,name FROM station";
	$q=$this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                    $data[$row->sid]=$row->name;
            }
            //print_r($data);
            return $data;
        }
        else return;
    }
    
    function insertStation()
    {
         $data = array(
               'name' =>$this->input->post('station_name') ,
               'latitude' => $this->input->post('latitude'),
               'longitude' => $this->input->post('longitude')

            );
                        $this->db->insert('station', $data);

    }
	function  getName($sid)
	{
		   $q = $this->db->query("SELECT name FROM station WHERE sid = ?  ",$sid);
            return $q->row()->name;
	}
	
	function  getSid($name)
	{
		   $q = $this->db->query("SELECT sid FROM station WHERE name = ?  ",$name);
		 if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                    $data[]=$row->sid;
            }
            return $data;
        }
        else return;
           
	}
	
	function getNames()
	{
		$query="SELECT name,sid FROM station";
	   $q=$this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                    $data[$row->sid]=$row->name;
            }
            return $data;
        }
        else return;
	}
    function getSids()
    {
        $query="SELECT sid FROM station";
	$q=$this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                    $data[]=$row->sid;
            }
            return $data;
        }
        else return;
    }

    function getLatLong($sid)
    {
        $query="SELECT latitude, longitude FROM station WHERE sid = ?";
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