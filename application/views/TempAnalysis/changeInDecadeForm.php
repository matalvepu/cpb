
<div class="wrapper col6">
  <div id="footer">
      <?php   echo validation_errors();?>
      
          <div id="welcome_msg">

      <h2><br/> Change in temp ( °C/decade) </h2>

<?php  



echo form_open_multipart('Temp/changeInDecade/showGraph');
 

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
echo form_dropdown('lastyear', $options,"1960", 'style="width: 230px; height: 25px; background-color:#C0C0C0; font-size: 16px"');

//style="width: 1000px; background-color:#C0C0C0; height: 800px;"
?>


<br/><br/>
<?
echo form_submit('upload','Find The Trend');
echo form_close();

?>
<br/><br/><br/><br/><br/><br/>
 </div>


 <div id="chart_div" style="width: 1000px; height: 600px;" ></div>
    
        <br class="clear" />

  </div>
</div>

