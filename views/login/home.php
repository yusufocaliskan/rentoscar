		<?php echo html::formOpen('login'); ?>

					<div class="wrapper">
						<div style="text-align: center; margin-top: -30px; color: #666"><h1 style="font-size: 30px">LOGIN</h1></div>
						<label for="email">E-Mail</label>
							<input class="form_el" type="text" name="email" id="email" value="<?php echo input::get('email','email')?>">
						<label for="password">Password</label>
							<input class="form_el" type="password" name="password" id="password">

							<?php echo recaptcha_get_html(config::get('RECAPTCHA_PUBLIC_KEY'), error::$err); ?>
							<button class="btn">Submit</button>
					</div> <!-- end: wrapper -->
				<?php echo html::formClose(); ?>