<div class="wrapper col6">
  <div id="footer">
      <?php   echo validation_errors();?>
      
          <div id="welcome_msg">

      <h2><br/><?php echo $title;?></h2>

      <?php echo $main;

      for($i=0 ;$i<$count;$i++)
      {
          echo $crop[$i]." : <br/>";
          echo "$quantityText : ".$quantity[$i]."<br/>";
          echo "$costText : ".$cost[$i]."  <br/>";
          echo "$sellText : ".$sell[$i]."<br/>";
          echo "$revenueText : ".$revenue[$i]." <br/>";

          echo "$maxrevText : ".$maxrev[$i]."  <br/>";
          echo "<br/>";
          }
      ?>



<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
 </div>

        <br class="clear" />

  </div>
</div>


