
<div class="wrapper col6">
  <div id="footer">
      <?php   echo validation_errors();?>
      
          <div id="welcome_msg">

      <h2><br/> ফসলের বিবরণ </h2>

<?php  

if(!isset($msg))$msg="";

echo form_open_multipart('adminArea/cropinformation/insertInformation');

echo "স্টেশনের নাম:";
//echo form_input('station_name',set_value('station_name'));

echo form_dropdown('station_name', $stationName,0, 'style="width: 230px; height: 25px; background-color:#C0C0C0; font-size: 16px"');



?>
<br/> 
<?php
echo " ফসলের নাম:";
//echo form_input('station_name',set_value('station_name'));

echo form_dropdown('crop_name', $cropName,0, 'style="width: 230px; height: 25px; background-color:#C0C0C0; font-size: 16px"');

 



?>
<br/><br/>
<?php
  
 echo form_label('বীজ বপনের সময়:', 'sdate');
 $data = array(
              'name'        => 'sdate',
              'id'          => 'datepicker',
                         );
echo form_input($data,set_value('sdate'),'style="width: 200px; height: 20px; background-color:#C0C0C0; font-size: 16px"');



?>


<?php
  
 echo form_label('ফসল তোলার সময়', 'hdate');
 $data = array(
              'name'        => 'hdate',
              'id'          => 'datepicker1',
                         );
echo form_input($data,set_value('hdate'),'style="width: 200px; height: 20px; background-color:#C0C0C0; font-size: 16px"');



?>


<?php
  
 echo "ফসলের পরিমাণ(মণ):";
echo form_input('amount',set_value('amount'),'style="width: 200px; height: 20px; background-color:#C0C0C0; font-size: 16px"');

 echo "উৎপাদন  খরচ (টাকা):";
echo form_input('cost',set_value('cost'),'style="width: 200px; height: 20px; background-color:#C0C0C0; font-size: 16px"');

 echo "বিক্রয় মূল্য (টাকা):";
echo form_input('sellingprice',set_value('sellingprice'),'style="width: 200px; height: 20px; background-color:#C0C0C0; font-size: 16px"');
echo "জমির পরিমাণ (একর):";
echo form_input('landspace',set_value('landspace'),'style="width: 200px; height: 20px; background-color:#C0C0C0; font-size: 16px"');



?>
<br/>

<br/><br/>
<?
echo form_submit('upload','সাবমিট');
echo form_close();

?>
<br/><br/><br/><br/><br/><br/>
<div id="message" style="font-family: sans-serif; font-size:18px; color:#900;">
 <?php 
	echo $msg;
     ?>
     
     </div>

 </div>


 <div id="chart_div" style="width: 1000px; height: 600px;" ></div>
    
        <br class="clear" />

  </div>
</div>

