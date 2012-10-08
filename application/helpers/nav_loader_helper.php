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
                     $navdata['analysis']="তুলনা";
                     $navdata['agri_suggest']= "কৃষি উপদেশ";
                     return $navdata;
    }
    else
    {
                     $navdata['current']=$current;
                     $navdata['home']="Home";
                     $navdata['forecast']="Forecast";
                     $navdata['temp_comparison']="Temperature Comparison";
                     $navdata['analysis']="Analysis";
                     $navdata['agri_suggest']= "Agricultural Suggestion";
                    return $navdata;
   
    }
               
}

?>
