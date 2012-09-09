<?php if(!isset($current)) $current = "welcome";?>
<div class="wrapper col2">
  <div id="topbar">
    <div id="topnav">
      <ul>
        <li <?php  if($current=="welcome") echo "class=\"active\"";?>><a href="<?php echo base_url();?>">হোম</a></li>
        <li <?php  if($current=="forecast") echo "class=\"active\"";?>><a href="<?php echo base_url();?>index.php/forecast">পুর্বাভাস</a></li>
        <li <?php  if($current=="map") echo "class=\"active\"";?>><a href="<?php echo base_url();?>index.php/map">তাপমাত্রা তুলনা </a>
          <!--  <ul>
            <li><a href="#">Link 1</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
          </ul>
          -->
        </li>
        <li><a href="">DropDown</a>
          <ul>
            <li><a href="#">Link 1</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
          </ul>
        </li>
        <li class="last"><a href="#">A Long Link Text</a></li>
      </ul>
    </div>

    <br class="clear" />
  </div>
</div>