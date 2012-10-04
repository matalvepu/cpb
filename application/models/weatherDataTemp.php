<?php 

class WeatherDataTemp extends CI_Model
{
	 function avgMaxTempMonthYear($sid,$month,$year)
    {
        $q = $this->db->query("SELECT AVG( maxtemp ) AS a FROM weatherdata WHERE sid = ? AND MONTH( wdate ) = ? AND YEAR( wdate      ) = ?",array($sid,$month,$year));
        return $q->row()->a;
    }

    
}
