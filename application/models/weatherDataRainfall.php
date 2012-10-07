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
}
