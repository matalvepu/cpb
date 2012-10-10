<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class soilInfo  extends CI_Model
{

    function getSoilType($sid)
    {
        $this->db->select('typeId');
        $this->db->where('sid', $sid);
        $q = $this->db->get('soilInfo');

        if($q->result() != NULL)
            return $q->row()->typeId;
        else
            return NULL;
    }
 
}



?>