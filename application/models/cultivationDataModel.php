<?php
class CultivationDataModel  extends CI_Model
{
    
    function getSurrogateIds($syear,$smonth,$sdate,$eyear,$emonth,$edate,$sid)
    {
        $query="SELECT surrogateId FROM cultivationdata WHERE  startTime BETWEEN '?-?-?' AND '?-?-?' AND sid = ?";

        $q=$this->db->query($query,array($syear,$smonth,$sdate,$eyear,$emonth,$edate,$sid));
        
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                    $data[]=$row->surrogateId;
             //       print_r($data);
            }
            return $data;
        }
        
        else {
           // echo "NULL";
            return;
        }
    }

    function getCropId($surrogateId)
    {
        $this->db->select('cropId');
        $this->db->where('surrogateId', $surrogateId);
        $q = $this->db->get('cultivationData');

        if($q->result() != NULL)
            return $q->row()->cropId;
        else
            return NULL;
    }

    function getQuantity($surrogateId)
    {
        $this->db->select('quantity');
        $this->db->where('surrogateId', $surrogateId);
        $q = $this->db->get('cultivationData');

        if($q->result() != NULL)
            return $q->row()->quantity;
        else
            return NULL;
    }
    function getProductionCost($surrogateId)
    {
        $this->db->select('productionCost');
        $this->db->where('surrogateId', $surrogateId);
        $q = $this->db->get('cultivationData');

        if($q->result() != NULL)
            return $q->row()->productionCost;
        else
            return NULL;
    }


    function getSellingPrice($surrogateId)
    {
        $this->db->select('sellingPrice');
        $this->db->where('surrogateId', $surrogateId);
        $q = $this->db->get('cultivationData');

        if($q->result() != NULL)
            return $q->row()->sellingPrice;
        else
            return NULL;
    }
    
    function getLandSize($surrogateId)
    {
        $this->db->select('landSize');
        $this->db->where('surrogateId', $surrogateId);
        $q = $this->db->get('cultivationData');

        if($q->result() != NULL)
            return $q->row()->landSize;
        else
            return NULL;
    }

    
    function getSelectedCropIds($surrogateIds)
    {
        
    //        $query="SELECT DISTINCT cropid FROM cultivationData WHERE surrogateId IN ?";

        $this->db->distinct();
        $this->db->select('cropId');
        $this->db->where_in('surrogateId', $surrogateIds);
        $q = $this->db->get('cultivationData');
        
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                    $data[]=$row->cropId;
               // print_r($data);
            }
            return $data;
        }

        else 
        {

           // echo "NULL";
            return;
        }
    }

    
}