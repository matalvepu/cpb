
<div class="wrapper col6">
  <div id="footer">
      <?php   echo validation_errors();
	 ?>
      
          <div id="welcome_msg">

      <h2><br/> Update Division !</h2>

<?php  


echo form_open_multipart('adminArea/updateDivision/update');

 if(!isset($data['0']->name))$data['0']->name=NULL;
if(!isset($data['0']->latitude))$data['0']->latitude=NULL;
if(!isset($data['0']->longitude))$data['0']->longitude=NULL;
if(!isset($data['0']->did))$data['0']->did=NULL;

echo form_hidden('did',set_value('did',$data['0']->did));
echo "Division Name:";
echo form_input('division_name',set_value('division_name',$data['0']->name));


echo "Latitude:";
echo form_input('latitude',set_value('latitude',$data['0']->latitude)); 

echo  "Longitude:";
echo form_input('longitude',set_value('longitude',$data['0']->longitude)); 



echo form_submit('upload','Upload');
echo form_close();

?>

<br/><br/><br/><br/><br/><br/><br/><br/>
 </div>

        <br class="clear" />

  </div>
</div>

