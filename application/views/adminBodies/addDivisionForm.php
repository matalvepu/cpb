
<div class="wrapper col6">
  <div id="footer">
      <?php   echo validation_errors();?>
      
          <div id="welcome_msg">

      <h2><br/> Add Division Data!</h2>

<?php  



echo form_open_multipart('adminArea/addDivision/insertDivisionInfo');

 

echo "Division Name:";
echo form_input('division_name',set_value('division_name'));

echo "Latitude:";
echo form_input('latitude',set_value('latitude')); 

echo  "Longitude:";
echo form_input('longitude',set_value('longitude')); 

echo form_submit('upload','Upload');
echo form_close();

?>
<br/><br/><br/><br/><br/><br/>
 </div>

        <br class="clear" />

  </div>
</div>

