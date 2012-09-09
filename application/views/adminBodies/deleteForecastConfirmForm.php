<div class="wrapper col6">
  <div id="footer">
      <?php   echo validation_errors();?>
      
          <div id="welcome_msg">

      <h2><br/></h2>

<?php  
 echo "  Division Name:  ";
 echo $division_name; ?>
 <br/>
 <?php
 echo "  Date:  ";
 echo $data['0']->fdate;
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
 echo "  Rainfall:  ";
 echo $data['0']->rainfall;
?>
 
<br/><br/>

<?php

if(strcmp($show,'no')==0)
{
	$url1="adminArea/deleteForecast/delete/".$data['0']->did."/".$data['0']->fdate;
	echo "Do you want to delete this data???";
	?>
    <br/>
    <?
	
	echo anchor($url1, 'Yes', 'title="Yes"');
	
	echo anchor("adminArea/deleteForecast", 'No', 'title="No"');
}

?>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
 </div>

        <br class="clear" />

  </div>
</div>

