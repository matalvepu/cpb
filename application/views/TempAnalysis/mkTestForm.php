
<div class="wrapper col6">
  <div id="footer">
      <?php   echo validation_errors();?>
      
          <div id="welcome_msg">

      <h2><br/> Mann Kendall Temperature Trend Test</h2>

<?php  



echo form_open_multipart('Temp/mKTest/getInputFromUser');
 

echo "Station Name:";
//echo form_input('station_name',set_value('station_name'));

echo form_dropdown('station_name', $stationName,0, 'style="width: 230px; height: 25px; background-color:#C0C0C0; font-size: 16px"');



?>
<br/>
<?php


echo "Start Year:";
echo form_dropdown('startyear', $options,2, 'style="width: 230px; height: 25px; background-color:#C0C0C0; font-size: 16px"');


?>
<br/>
<?php
echo "Last Year:";
echo form_dropdown('lastyear', $options,"2009", 'style="width: 230px; height: 25px; background-color:#C0C0C0; font-size: 16px"');
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
$kind=array('Min Temp'=>"Min temp",'Max Temp'=>"Max temp");
echo "Select Temperature:";
echo form_dropdown('kind',$kind,0, 'style="width: 230px; height: 25px; background-color:#C0C0C0; font-size: 16px"');

?>
<br/><br/>
<?
echo form_submit('upload','Find The Trend');
echo form_close();

?>
<br/><br/><br/><br/><br/><br/>
 </div>

        <br class="clear" />

  </div>
</div>

