<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Weather_data extends CI_Model
{
    public function getRecentData($sid)
    {
        $q = "SELECT wdate,rainfall,mintemp,maxtemp,humidity FROM weatherdata WHERE wdate = (SELECT max(wdate) FROM weatherdata WHERE sid = ? ) AND sid = ?";
        $q = $this->db->query($q,array($sid,$sid));
         $row = $q->row();

         return $row;
        
    }

    
}

?>
