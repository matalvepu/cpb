
<div class="wrapper col6">
  <div id="footer">
      <?php   echo validation_errors();
	 ?>
      
          <div id="welcome_msg">

      <h2><br/> Update !</h2>

<?php  


echo form_open_multipart('adminArea/updateWeather/update');

 if(!isset($data['0']->wdate))$data['0']->wdate=NULL;
if(!isset($data['0']->rainfall))$data['0']->rainfall=NULL;
if(!isset($data['0']->mintemp))$data['0']->mintemp=NULL;
if(!isset($data['0']->maxtemp))$data['0']->maxtemp=NULL;
if(!isset($data['0']->humidity))$data['0']->humidity=NULL;
if(!isset($station_name))$station_name=NULL;
if(!isset($data['0']->sid))$data['0']->sid=NULL;

echo form_hidden('sid',set_value('sid',$data['0']->sid));
echo "Station Name:";
echo form_input('station_name',set_value('station_name',$station_name));


 echo form_label('Date', 'date');
 $data1 = array(
              'name'        => 'date',
              'id'          => 'datepicker',
                         );
echo form_input($data1,set_value('date',$data['0']->wdate));

echo "Rainfall (mm):";
echo form_input('rainfall',set_value('rainfall',$data['0']->rainfall));

echo "Minimum Temperature:";
echo form_input('mintemp',set_value('mintemp',$data['0']->mintemp));



echo "Maximum Temperature:";
echo form_input('maxtemp',set_value('maxtemp',$data['0']->maxtemp));

echo "Humidity :";
echo form_input('humidity',set_value('humidity',$data['0']->maxtemp));




echo form_submit('upload','Upload');
echo form_close();

?>

<br/><br/><br/><br/><br/><br/><br/><br/>
 </div>

        <br class="clear" />

  </div>
</div>

