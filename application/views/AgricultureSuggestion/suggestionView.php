<div class="wrapper col6">
  <div id="footer">
      <?php   echo validation_errors();?>

<?php

?>
          <div id="welcome_msg">

      <h2><br/><?php echo $title;?></h2>

      <?php

      echo $msg;

        echo form_open('AgricultureSuggestion/suggestion');
        echo "$dropDownText";
        echo form_dropdown('stations', $options, '20');
	echo "<br/>$landSizeText";
	echo form_input('landSize', '10');
        $attributes2 = array('id' =>'submit','value' => $submit);
	echo "<br/>".form_submit($attributes2);
	echo form_close();

      
        if(isset($error) && $error != NULL)
            echo "$error";

        $sortedIndex=NULL;
    
          

     if($count>0)
      {
         for($i=0 ; $i< $count ;$i++)
          {
                $sortedIndex[]= $i;
          }


          for($i=0;$i<$count;$i++)
          {
                for($j = $i + 1; $j<$count ; $j++)
                {
                    if($revenue[$j]>$revenue[$i])
                    {

                        $x = $sortedIndex[$i];
                        $sortedIndex[$i]=$sortedIndex[$j];
                        $sortedIndex[$j]=$x;
                    }
                }
          }
     
   }
      for($j=0 ;$j<$count;$j++)
      {
          $i = $sortedIndex[$j];
          echo $crop[$i]." : <br/>";
          echo "$quantityText : ".round($quantity[$i],2)."<br/>";
          echo "$costText : ".round($cost[$i],2)."  <br/>";
          echo "$sellText : ".round($sell[$i],2)."<br/>";
          echo "$revenueText : ".round($revenue[$i],2)." <br/>";
          echo "$maxrevText : ".round($maxrev[$i],2)."  <br/>";
          echo "<br/>";
        }
       



      ?>



<br/><br/><br/><br/><br/><br/>
 </div>

        <br class="clear" />

  </div>
</div>
