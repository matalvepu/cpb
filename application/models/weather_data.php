<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Weather_data extends CI_Model
{
    public function getRecentData($sid)
    {
        $q = "SELECT wdate,rainfall,mintemp,maxtemp,humidity FROM weatherdata WHERE wdate = (SELECT max(wdate) FROM weatherdata) AND sid = ?";
        $q = $this->db->query($q,$sid);
         $row = $q->row();

         return $row;
        
    }
}

?>
