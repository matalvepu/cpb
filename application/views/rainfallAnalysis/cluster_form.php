
<div class="wrapper col6">
  <div id="footer">
      <?php   echo validation_errors();?>
      
          <div id="welcome_msg">

      <h2><br/> Change in temp ( °C/decade) </h2>

<?php  



echo form_open_multipart('rainfallAnalysis/cluster/showGraph');
 

echo "Station Name:";
//echo form_input('station_name',set_value('station_name'));

echo form_dropdown('station_name', $stationName,0, 'style="width: 230px; height: 25px; background-color:#C0C0C0; font-size: 16px"');



?>
<br/>
<?php
$type=array('cluster3'=>"Cluster 3",'cluster5'=>"Cluster 5");

echo "Cluster Type:";
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
 for($i=1970;$i<date('Y');$i++)
 {
	 $year[$i]=$i;
 }
 
?>

<?php


echo "Start Year:";
echo form_dropdown('startyear', $year,2, 'style="width: 230px; height: 25px; background-color:#C0C0C0; font-size: 16px"');


?>
<br/>
<?php
echo "Last Year:\n";
echo form_dropdown('lastyear', $year,"2009", 'style="width: 230px; height: 25px; background-color:#C0C0C0; font-size: 16px"');


?>





<br/><br/>
<?
echo form_submit('upload','Find The Trend');
echo form_close();

?>

 <br/><br/><br/>
<div id="message" style="font-family: sans-serif; font-size:18px; color:#900;">
<?php 
	/*if($equation!=NULL | $equation != ""  )
	{
      echo $equation;
      echo $coefficient;
	}
	
	if($noData!=NULL | $noData!="" )
	  echo $noData;
	  
	 if($invalidDate!=NULL | $invalidDate!="")
	 echo $invalidDate;*/
     ?>
     
     </div>
 
 </div>
 <br/><br/><br/><br/>
 

 <div id="chart_div" style="width: 1000px; height: 1000px;" >

 </div>
 
 
    
        <br class="clear" />

  </div>
</div>

