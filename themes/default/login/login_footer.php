

			
		</div> <!-- end: container -->
		
		<div id="footer">
			<div class="wrapper">
				&copy; Copyright 2014 - <?php echo date('Y');?>
			</div> <!-- end: wrapper -->
		</div>  <!-- #footer -->
 		<?php echo Html::script(array('src'=>Config::get('DEFAULT_CURRENT_THEME').'js/jquery-1.10.1.min.js.pagespeed.jm.hJPIhFzu5k.js')); ?>
 		<?php echo Html::script(array('src'=>Config::get('DEFAULT_CURRENT_THEME').'js/toastmessage/javascript/jquery.toastmessage.js')); ?>
		 
		<?php error::displayNotice(); ?>


</body>
</html>