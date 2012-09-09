<body id="top">
<div class="wrapper col1">
  <div id="header">
    <div id="logo">
        <h1><a href="<?php echo base_url();?>"><?php echo $title;?></a></h1>
      <!--<p><strong>Subtitle</strong></p> -->
    </div>
        <?php
        if($this->session->userdata('language')=="bangla")
        {
            $img="eng.png";
            $path=base_url()."index.php/english";
        }
        else
        {
             $img="bng.png";
            $path=base_url()."index.php/bangla";
        }
        ?>
      <div id="langbar" ><a href="<?php echo $path;?>"><img src="<?php echo base_url()."css/images/".$img?>"/><a/></div>
    <br class="clear" />
  </div>
</div>
