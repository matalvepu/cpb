<?php 

class WeatherDataTemp extends CI_Model
{
	function avgMaxTempMonthYear($sid,$month,$year)
        {
            $q = $this->db->query("SELECT AVG( maxtemp ) AS a FROM weatherdata WHERE sid = ? AND MONTH( wdate ) = ? AND YEAR( wdate      ) = ?",array($sid,$month,$year));
            return $q->row()->a;
        }

        function avgMinTempMonthYear($sid,$month,$year)
        {
            $q = $this->db->query("SELECT AVG( mintemp ) AS a FROM weatherdata WHERE sid = ? AND MONTH( wdate ) = ? AND YEAR( wdate      ) = ?",array($sid,$month,$year));
            return $q->row()->a;
        }

        function getAvgMaxTempBetweenDate($sid,$sdate,$edate)
        {
            $this->db->select_avg('maxTemp');
            $this->db->where('sid', $sid);
            $this->db->where('wdate >= ', $sdate);
            $this->db->where('wdate <= ', $edate);
            $q = $this->db->get('weatherdata');
            if($q->result() != NULL)
                return $q->row()->maxTemp;
            else
                return NULL;
        }

        function getAvgMinTempBetweenDate($sid,$sdate,$edate)
        {
            $this->db->select_avg('minTemp');
            $this->db->where('sid', $sid);
            $this->db->where('wdate >= ', $sdate);
            $this->db->where('wdate <= ', $edate);
            $q = $this->db->get('weatherdata');
            if($q->result() != NULL)
                return $q->row()->minTemp;
            else
                return NULL;
        }

}
