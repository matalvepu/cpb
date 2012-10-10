<?php if(!isset($current)) $current = "welcome";?>
<div class="wrapper col2">
  <div id="topbar">
    <div id="topnav">
      <ul>
        <li <?php  if($current=="welcome") echo "class=\"active\"";?>><a href="<?php echo base_url()."index.php/adminArea/adminPanel";?>">Home</a></li>
        
                
                
       <!-- <li <?php  if($current=="forecast") echo "class=\"active\"";?>><a href="<?php echo base_url();?>index.php/forecast"><?=$forecast?></a></li>
        <li <?php  if($current=="map") echo "class=\"active\"";?>><a href="<?php echo base_url();?>index.php/map"><?=$temp_comparison?></a>-->
          <!--  <ul>
            <li><a href="#">Link 1</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
          </ul>
          -->
        </li>
        
        <li><a href="">Station</a>
          <ul>
<li> <a href="<?php echo base_url()."index.php/adminArea/addStation";?>" >Add Station</a></li>
  <li> <a href="<?php echo base_url()."index.php/adminArea/deleteStation";?>">Delete Station</a></li>
   <li> <a href="<?php echo base_url()."index.php/adminArea/updateStation";?>">Update Station</a></li>
   <li> <a href="<?php echo base_url()."index.php/adminArea/showStation";?>">Show Station Data</a></li>
          
          </ul>
        </li>
        
        <li><a href="">Division</a>
          <ul>
   <li> <a href="<?php echo base_url()."index.php/adminArea/addDivision";?>">Add Division</a></li>
  <li> <a href="<?php echo base_url()."index.php/adminArea/deleteDivision";?>">Delete Division</a></li>
   <li> <a href="<?php echo base_url()."index.php/adminArea/updateDivision";?>">Update Division</a></li>
   <li> <a href="<?php echo base_url()."index.php/adminArea/showDivision";?>">Show Division Data</a></li>
          </ul>
        </li>

        <li><a href="">Weather</a>
          <ul>
   <li> <a href="<?php echo base_url()."index.php/adminArea/addWeather";?>">Add Weather Data</a></li>
  <li> <a href="<?php echo base_url()."index.php/adminArea/deleteWeather";?>">Delete Weather Data</a></li>
   <li> <a href="<?php echo base_url()."index.php/adminArea/updateWeather";?>">Update Weather Data</a></li>
   <li> <a href="<?php echo base_url()."index.php/adminArea/showWeather";?>">Show Weather Data</a></li>
           </ul>
        </li>
        
        <li><a href="">Forecast</a>
          <ul>
  <li> <a href="<?php echo base_url()."index.php/adminArea/addForecast";?>">Add Forecast Data</a></li>
  <li> <a href="<?php echo base_url()."index.php/adminArea/deleteForecast";?>">Delete Forecast Data</a></li>
   <li> <a href="<?php echo base_url()."index.php/adminArea/updateForecast";?>">Update Forecast Data</a></li>
   <li> <a href="<?php echo base_url()."index.php/adminArea/showForecast";?>">Show Forecast Data</a></li>
            </ul>
        </li>
        
        <li><a href="">Cultivation Data</a>
          <ul>
   <li> <a href="<?php echo base_url()."index.php/adminArea/cropinformation";?>" >Add Data</a></li>
  <li> <a href="<?php echo base_url()."index.php/adminArea/cropinformation";?>">Delete Data</a></li>
   <li> <a href="<?php echo base_url()."index.php/adminArea/cropinformation";?>">Update Data</a></li>
   <li> <a href="<?php echo base_url()."index.php/adminArea/cropinformation";?>">Show Data</a></li>
          
          </ul>
        </li>
        
        <li class="last"><a href="<?php echo base_url()."index.php/adminArea/welcome/logout";?>">Log Out</a></li>
        <!--
        <li class="last"><a href="#">A Long Link Text</a></li>
        -->
      </ul>
    </div>

    <br class="clear" />
  </div>
</div>