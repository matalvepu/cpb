<div class="wrapper col6">
  <div id="footer">
      <?php   echo validation_errors();
	  if(strcmp($select,'delete')==0)
		{
			$uri='adminArea/deleteStation/deleteConfirm';
		}
		 else if(strcmp($select,'show')==0)
		{
			$uri='adminArea/showStation/showStationData';
		}
		else
		{
			$uri='adminArea/updateStation/showUpdateForm';
		}
	  
	  ?>
      
          <div id="welcome_msg">

      <h2><br/><?php echo $header; ?></h2>

<?php  



echo form_open_multipart($uri);

 

echo "Station Name:";
echo form_input('station_name',set_value('station_name'));





echo form_submit('upload','Enter');

echo form_close();


?>

<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
 </div>

        <br class="clear" />

  </div>
</div>

