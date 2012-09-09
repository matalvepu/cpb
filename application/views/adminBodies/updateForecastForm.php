
<div class="wrapper col6">
  <div id="footer">
      <?php   echo validation_errors();
	 ?>
      
          <div id="welcome_msg">

      <h2><br/> Update Forecast !</h2>

<?php  


echo form_open_multipart('adminArea/updateForecast/update');

 if(!isset($data['0']->fdate))$data['0']->fdate=NULL;
if(!isset($data['0']->rainfall))$data['0']->rainfall=NULL;
if(!isset($data['0']->mintemp))$data['0']->mintemp=NULL;
if(!isset($data['0']->maxtemp))$data['0']->maxtemp=NULL;

if(!isset($division_name))$division_name=NULL;
if(!isset($data['0']->did))$data['0']->did=NULL;

echo form_hidden('did',set_value('did',$data['0']->did));
echo "Division Name:";
echo form_input('division_name',set_value('division_name',$division_name));


 echo form_label('Date', 'date');
 $data1 = array(
              'name'        => 'date',
              'id'          => 'datepicker',
                         );
echo form_input($data1,set_value('date',$data['0']->fdate));


echo "Minimum Temperature:";
echo form_input('mintemp',set_value('mintemp',$data['0']->mintemp));



echo "Maximum Temperature:";
echo form_input('maxtemp',set_value('maxtemp',$data['0']->maxtemp));

echo "Rainfall (mm):";
echo form_input('rainfall',set_value('rainfall',$data['0']->rainfall));






echo form_submit('upload','Upload');
echo form_close();

?>

<br/><br/><br/><br/><br/><br/><br/><br/>
 </div>

        <br class="clear" />

  </div>
</div>

