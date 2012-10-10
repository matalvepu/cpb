
<div class="wrapper col6">
  <div id="footer">
      <?php   echo validation_errors();?>
      
          <div id="welcome_msg">

      <h2><br/> Mann Kendall Temperature Trend Test</h2>

<?php  

if(!isset($mkparametre))$mkparametre=NULL;

if(!isset($type))$type=NULL;

if(!isset($monthname))$monthname=NULL;

if(!isset($syear))$syear=NULL;

if(!isset($eyear))$eyear=NULL;


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
echo "Last Year:\n";
echo form_dropdown('lastyear', $options,"1970", 'style="width: 230px; height: 25px; background-color:#C0C0C0; font-size: 16px"');
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
<br/><br/><br/><br/>
<div id="message" style="font-family: sans-serif; font-size:18px; color:#900;">
<?php 
	if(isset($mkparametre))
	{
		echo "Menn-Kendall Trend Test Result of ".$type." of ".$monthname." on base daily data from ".$syear." to ".$eyear.": \n\n";
		echo "Menn-Kendall Statistics ,S : ".$mkparametre[0];
		?>
        <br/>
        <?php
		echo " variance of S, VAR(S) :".$mkparametre[1];
		?>
        <br/>
        <?php
		echo "Test Statistics ,Z : ".$mkparametre[2]."\n";
		?>
        <br/>
        <?php
		if($mkparametre[0]>250)
		{
			echo "Positive Trend is Dectected on ".$type. " of ".$monthname;
			
		}
		else if($mkparametre[0]<-250)
		{
			echo "Negative Trend is Dectected on ".$type. " of ".$monthname;
			
		}
		else
		 echo "No Trend is Dectected on ".$type. " of ".$monthname;
		 
		
	}
     ?>
     
     </div>
 </div>

        <br class="clear" />

  </div>
</div>

