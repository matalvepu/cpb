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

                     $navdata['agri_guggest']= "কৃষি উপদেশ";
					 $navdata['temp_change']= "তাপমাত্রার পরিবর্তন";

=======
                     $navdata['analysis']="তুলনা";
                     $navdata['agri_suggest']= "কৃষি উপদেশ";
>>>>>>> fe4fd242100849d3b894422ffe2d88fde34e8211
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
                     $navdata['agri_guggest']= "Agricultural Suggestion";
					 $navdata['temp_change']= "Change In Temperature";


                     return $navdata;
=======
                     $navdata['analysis']="Analysis";
                     $navdata['agri_suggest']= "Agricultural Suggestion";
                    return $navdata;
>>>>>>> fe4fd242100849d3b894422ffe2d88fde34e8211
    
        
    }
               
}

?>
