<div class="wrapper col6">
  <div id="footer">
      <?php   echo validation_errors();?>
      
          <div id="welcome_msg">

      <h2><br/><?php echo $title;?></h2>

      <?php echo $msg;

        echo form_open('AgricultureSuggestion/suggestion');
        //echo '<fieldset><div class="fl_left">';
        echo "$dropDownText";
        echo form_dropdown('stations', $options, '20');
	//echo form_select('station', '');
        echo "<br/>$landSizeText";
	echo form_input('landSize', '10');
        //echo '</div>';
        //echo '<div class="fl_left">';

        $attributes2 = array('id' =>'submit','value' => $submit);
	echo "<br/>".form_submit($attributes2);
        //echo "</div></fieldset>";
	echo form_close();

      
        if(isset($error) && $error != NULL)
            echo "$error";
        
      for($i=0 ;$i<$count;$i++)
      {
          echo $crop[$i]." : <br/>";
          echo "$quantityText : ".round($quantity[$i],2)."<br/>";
          echo "$costText : ".$cost[$i]."  <br/>";
          echo "$sellText : ".$sell[$i]."<br/>";
          echo "$revenueText : ".$revenue[$i]." <br/>";

          echo "$maxrevText : ".$maxrev[$i]."  <br/>";
          echo "<br/>";
          }
      ?>



<br/><br/><br/><br/><br/><br/>
 </div>

        <br class="clear" />

  </div>
</div>


