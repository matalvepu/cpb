
<div class="wrapper col6">
  <div id="footer">
      <?php   echo validation_errors();?>
      
          <div id="welcome_msg">

      <h2><br/>Weather Data !</h2>

<?php  



echo form_open_multipart('adminArea/addWeather/insert');

 

echo "Station Name:";
echo form_input('station_name',set_value('station_name'));


 echo form_label('Date', 'date');
 $data = array(
              'name'        => 'date',
              'id'          => 'datepicker',
                         );
echo form_input($data,set_value('date'));

echo "Rainfall (mm):";
echo form_input('rainfall',set_value('rainfall'));

echo "Minimum Temperature:";
echo form_input('mintemp',set_value('mintemp'));



echo "Maximum Temperature:";
echo form_input('maxtemp',set_value('maxtemp'));

echo "Humidity :";
echo form_input('humidity',set_value('humidity'));


echo form_submit('upload','Upload');
echo form_close();

?>


<br/><br/><br/>
 </div>

        <br class="clear" />

  </div>
</div>

