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
<<<<<<< HEAD
                     $navdata['analysis']="তুলনা";
=======
                     $navdata['agri_guggest']= "কৃষি উপদেশ";
>>>>>>> e16f210b3e41b4f84b6d5216d9d178af697bef16
                     return $navdata;
    }
    else
    {
                     $navdata['current']=$current;
                     $navdata['home']="Home";
                     $navdata['forecast']="Forecast";
                     $navdata['temp_comparison']="Temperature Comparison";
<<<<<<< HEAD
					 $navdata['analysis']="Analysis";
=======
                     $navdata['agri_guggest']= "Agricultural Suggestion";

>>>>>>> e16f210b3e41b4f84b6d5216d9d178af697bef16
                     return $navdata;
    
        
    }
               
}

?>
