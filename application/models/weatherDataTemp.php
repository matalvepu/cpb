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
		
		
		 function avgMinTempBetweenTwoDate($sid,$syear,$smonth,$sdate,$eyear,$emonth,$edate)
    {
        $q = $this->db->query("SELECT AVG(mintemp) AS a FROM weatherdata WHERE sid = ? AND wdate >=  '?-?-?' AND wdate <=      '?-?-?'",array($sid,$syear,$smonth,$sdate,$eyear,$emonth,$edate));
        return $q->row()->a;
    }

    function avgMaxTempBetweenTwoDate($sid,$syear,$smonth,$sdate,$eyear,$emonth,$edate)
    {
         $q = $this->db->query("SELECT AVG(maxtemp) AS a FROM weatherdata WHERE sid = ? AND wdate >=  '?-?-?' AND wdate <=  '?-?-?'",array($sid,$syear,$smonth,$sdate,$eyear,$emonth,$edate));
        return $q->row()->a;
    }

   function avgMinTempBetwenYear($sid,$syear,$eyear,$month)
    {
        $q = $this->db->query("SELECT AVG(mintemp) AS a FROM weatherdata WHERE sid = ? AND YEAR(wdate) >=? AND YEAR(wdate) <= ? AND MONTH(wdate) = ?",array($sid,$syear,$eyear,$month));
        return $q->row()->a;
    }

    function avgMaxTempBetwenYear($sid,$syear,$eyear,$month)
    {
        $q = $this->db->query("SELECT AVG(maxtemp) AS a FROM weatherdata WHERE sid = ? AND YEAR(wdate) >=? AND YEAR(wdate) <= ? AND MONTH(wdate) = ?",array($sid,$syear,$eyear,$month));
        return $q->row()->a;
    }



}
