<div class="wrapper col6">
  <div id="footer">
      <?php   echo validation_errors();?>
      
          <div id="welcome_msg">

      <h2><br/>Are you sure to delete this data??</h2>

<?php  
 echo "  Station Name:  ";
 echo $station_name; ?>
 <br/>
 <?php
 echo "  Date:  ";
 echo $data['0']->wdate;
?>
 <br/>
 <?php
 echo "  Rainfall:  ";
 echo $data['0']->rainfall;
?>

 <br/>
 <?php
 echo "  Minimum Temperature:  ";
 echo $data['0']->mintemp;
?>
 <br/>
 <?php
 echo "  Maximum Temperature:  ";
 echo $data['0']->maxtemp;
?>
 <br/>
 <?php
 echo "  Humidity:  ";
 echo $data['0']->humidity;
?>
<br/><br/>
<?php
$url1="adminArea/deleteWeather/delete/".$data['0']->sid."/".$data['0']->wdate;
$url2="adminArea/deleteWeather";
echo anchor($url1, 'Yes', 'title="Yes"');

echo anchor($url2, 'No', 'title="No"');

?>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
 </div>

        <br class="clear" />

  </div>
</div>

