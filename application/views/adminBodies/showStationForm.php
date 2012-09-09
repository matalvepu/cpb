<div class="wrapper col6">
  <div id="footer">
      <?php   echo validation_errors();?>
      
          <div id="welcome_msg">

      <h2><br/>Station Data::</h2>

<?php  
 echo "  Station Name:  ";
 echo $data['0']->name; ?>
 <br/>
 <?php
 echo "  Latitude:  ";
 echo $data['0']->latitude;
?>
 <br/>
 <?php
 echo "  Longitude:  ";
 echo $data['0']->longitude;
?>
<br/><br/>

<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
 </div>

        <br class="clear" />

  </div>
</div>

