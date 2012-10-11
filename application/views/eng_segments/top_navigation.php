<?php if(!isset($current)) $current = "welcome";?>
<div class="wrapper col2">
  <div id="topbar">
    <div id="topnav">
      <ul>
        <li <?php  if($current=="welcome") echo "class=\"active\"";?>><a href="<?php echo base_url();?>"><?=$home?></a></li>
        <li <?php  if($current=="forecast") echo "class=\"active\"";?>><a href="<?php echo base_url();?>index.php/map"><?=$forecast?></a></li>
        
            <li <?php  if($current=="agri_suggest") echo "class=\"active\"";?>><a href="<?php echo base_url();?>index.php/AgricultureSuggestion/suggestion"><?=$agri_suggest?></a>
         <li <?php  if($current=="analysis") echo "class=\"active\"";?>><a href="<?php echo base_url();?>/index.php/Temp/mKTest"><?php echo $analysis;?></a>
           <ul>
            <li><a href="<?php echo base_url();?>index.php/Temp/mKTest"><?=$mk?></a></li>
            <li><a href="<?php echo base_url();?>index.php/Temp/changeInDecade"><?=$temp_change?></a></li>
            <li><a href="<?php echo base_url();?>index.php/regressionLine"><?=$regression?></a></li>
            <li><a href="<?php echo base_url();?>index.php/rainfallAnalysis/cluster"><?=$cluster?></a></li>
           </ul>
          <!--  <ul>
            <li><a href="#">Link 1</a></li>
>>>>>>> e16f210b3e41b4f84b6d5216d9d178af697bef16
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
          </ul>
         
        </li>
        <!--
        <li><a href="">DropDown</a>
          <ul>
            <li><a href="#">Link 1</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
          </ul>
        </li>
        <li class="last"><a href="#">A Long Link Text</a></li>
        -->
      </ul>
    </div>

    <br class="clear" />
  </div>
</div>