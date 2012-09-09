<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function nav_load($str,$current)
{
    if($str=="bangla")
    {
                     $navdata['current']=$current;
                     $navdata['home']="হোম";
                     $navdata['forecast']="পূর্বাভাস";
                     $navdata['temp_comparison']="তাপমাত্রা তুলনা";
                     return $navdata;
    }
    else
    {
                     $navdata['current']=$current;
                     $navdata['home']="Home";
                     $navdata['forecast']="Forecast";
                     $navdata['temp_comparison']="Temperature Comparison";
                     return $navdata;
    
        
    }
                     //$this->load->view('eng_segments/top_navigation',$navdata);
}

?>
