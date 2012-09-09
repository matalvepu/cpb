
<link type="text/css" href="<?php echo base_url();?>jq/css/redmond/jquery-ui-1.8.18.custom.css" rel="Stylesheet" />
<script type="text/javascript" src="<?php echo base_url();?>jq/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>jq/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript">
			$(function(){

				// Datepicker
				$('#datepicker').datepicker({
					inline: true
				});

				//hover states on the static widgets
				$('#dialog_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); },
					function() { $(this).removeClass('ui-state-hover'); }
				);

			});
		</script>