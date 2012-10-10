
<div class="wrapper col6">
  <div id="footer">
      <?php   echo validation_errors();?>
      
          <div id="welcome_msg">

      <h2><br/> Change in temp ( °C/decade) </h2>

<?php  



echo form_open_multipart('regressionLine/showRegression');
 

echo "Station Name:";
//echo form_input('station_name',set_value('station_name'));

echo form_dropdown('station_name', $stationName,0, 'style="width: 230px; height: 25px; background-color:#C0C0C0; font-size: 16px"');



?>
<br/>
<?php
$type=array('temp'=>"Temperature",'rain'=>"Rainfall");

echo "Data Type:";
echo form_dropdown('type',$type,2, 'style="width: 230px; height: 25px; background-color:#C0C0C0; font-size: 16px"');


?>

<br/>
<?php
$month=array( '1'=>"January",'2'=>"February",'3'=>'March','4'=>"April",'5'=>"May",'6'=>"June",
'7'=>"July",'8'=>"August",'9'=>"Sepetember",'10'=>"Octebor",'11'=>"November",'12'=>"December"

);
echo "Month:";
?>
<br/>
<?php
echo form_dropdown('month',$month,0, 'style="width: 230px; height: 25px; background-color:#C0C0C0; font-size: 16px"');
?>

<br/>
<?php
 for($i=1950;$i<date('Y');$i++)
 {
	 $year[$i]=$i;
 }
 
 for($i=1;$i<32;$i++)
 {
	 $day[$i]=$i;
 }
?>

<?php


echo "Start Year:";
echo form_dropdown('startyear', $year,2, 'style="width: 230px; height: 25px; background-color:#C0C0C0; font-size: 16px"');


?>
<br/>
<?php
echo "Last Year:";
echo form_dropdown('lastyear', $year,"1960", 'style="width: 230px; height: 25px; background-color:#C0C0C0; font-size: 16px"');


?>

<br/>
<?php


echo "Start Day:";
echo form_dropdown('startday', $day,1, 'style="width: 230px; height: 25px; background-color:#C0C0C0; font-size: 16px"');


?>


<br/>
<?php
echo "Last Day:\n";
echo form_dropdown('lastday', $day,31, 'style="width: 230px; height: 25px; background-color:#C0C0C0; font-size: 16px"');


?>


<br/><br/>
<?
echo form_submit('upload','Find The Trend');
echo form_close();

?>

 <br/><br/><br/>
<div id="message" style="font-family: sans-serif; font-size:18px; color:#900;">
<?php 
	if($equation!=NULL | $equation != ""  )
	{
      echo $equation;
      echo $coefficient;
	}
	
	if($noData!=NULL | $noData!="" )
	  echo $noData;
	  
	 if($invalidDate!=NULL | $invalidDate!="")
	 echo $invalidDate;
     ?>
     
     </div>
 
 </div>
 <br/><br/><br/><br/>
 

 <div id="chart_div" style="width: 1000px; height: 1000px;" >

 </div>
 
 
    
        <br class="clear" />

  </div>
</div>

