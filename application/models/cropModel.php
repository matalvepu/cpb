<?php
class CropModel  extends CI_Model
{
        function getCropName($cropId)
        {
                   $q = "SELECT name FROM crop WHERE  cropId = ?";
                   $q = $this->db->query($q,$cropId);
                   $row = $q->row();
                   return $row->name;
        }

        function getBanglaCropName($cropId)
        {
                   $q = "SELECT banglaName FROM crop WHERE  cropId = ?";
                   $q = $this->db->query($q,$cropId);
                   $row = $q->row();
                   return $row->banglaName;
        }
		
		function getBanglaCropNames()
        {
                  $query="SELECT banglaName,cropid FROM crop";
			   $q=$this->db->query($query);
				if($q->num_rows()>0)
				{
					foreach($q->result() as $row)
					{
							$data[$row->cropid]=$row->banglaName;
					}
					return $data;
				}
				else return;
        }
}