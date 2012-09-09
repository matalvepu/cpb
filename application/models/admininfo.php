<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class AdminInfo  extends CI_Model
{
   
    private function process($str)
    {
         return sha1($str.$this->config->item('encryption_key'));
    }

    function validate($mail,$pass)
    {
                $this->db->select('id, name');
                $this->db->where('mail', $mail);
		$this->db->where('pass',  $this->process($pass));
		$query = $this->db->get('adminInfo');

		if($query->num_rows == 1)
		{
                       $row = $query->row();
                       return array('id' => $row->id, 'name' => $row->name);
     //                  print_r( array('id' => $row->id, 'name' => $row->name));
                       //echo $row->id;
                      // echo $row->name;
			//return true;

		}
                return FALSE;
                //echo "False";
    }
 
}



?>