<?php 

class WeatherDataRainfall extends CI_Model
{
        function getRainfallSumBetweenDate($sid,$sdate,$edate)
        {
            $this->db->select_sum('rainfall');
            $this->db->where('sid', $sid);
            $this->db->where('wdate >= ', $sdate);
            $this->db->where('wdate <= ', $edate);
            $q = $this->db->get('weatherdata');
            if($q->result() != NULL)
                return $q->row()->rainfall;
            else
                return NULL;
        }
		
   function avgRainfallBetweenTwoDate($sid,$syear,$smonth,$sdate,$eyear,$emonth,$edate)
    {
         $q = $this->db->query("SELECT AVG(rainfall) AS a FROM weatherdata WHERE sid = ? AND wdate >=  '?-?-?' AND wdate <=  '?-?-?'",array($sid,$syear,$smonth,$sdate,$eyear,$emonth,$edate));
        return $q->row()->a;
    }
	
	 function totalRainfallBetweenTwoDate($sid,$syear,$smonth,$sdate,$eyear,$emonth,$edate)
    {
         $q = $this->db->query("SELECT SUM(rainfall) AS a FROM weatherdata WHERE sid = ? AND wdate >=  '?-?-?' AND wdate <=  '?-?-?'",array($sid,$syear,$smonth,$sdate,$eyear,$emonth,$edate));
        return $q->row()->a;
    }
		
}
