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

                     $navdata['temp_change']= "তাপমাত্রার পরিবর্তন";

                     $navdata['analysis']="তুলনা";
                     $navdata['agri_suggest']= "কৃষি উপদেশ";
					 $navdata['regression']="রিগ্রেসন এনালাইসিস";
					  $navdata['cluster']="বৃষ্টিপাতের ক্লাসটারিং";
					  
					  $navdata['mk']="ম্যান কেনডাল";

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
					 $navdata['temp_change']= "Change In Temperature";
					 $navdata['regression']="Regression Analysis";
					 $navdata['cluster']="Rainfall Clustering";
					 
					  $navdata['mk']="Mann Kendall";


                     return $navdata;

   

    }
               
}

?>
