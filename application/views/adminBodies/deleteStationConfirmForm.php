<div class="wrapper col6">
  <div id="footer">
      <?php   echo validation_errors();?>
      
          <div id="welcome_msg">

      <h2><br/>Are you sure to delete this station??</h2>

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
<?php
$url1="adminArea/deleteStation/delete/".$data['0']->sid;
echo anchor($url1, 'Yes', 'title="Yes"');
//$url2="adminArea/deleteStation";
echo anchor('adminArea/deleteStation', 'No', 'title="No"');

?>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
 </div>

        <br class="clear" />

  </div>
</div>

