<div class="wrap newsletters">
	<script type="text/javascript">
	//var newsletters_ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>?';
	</script>
	
	<div style="width:400px;">
	    <h1><?php _e('Test Email Settings', 'wp-mailinglist'); ?></h1>
	    
	    <p><?php _e('This function will test your current email settings and provide an explanatory error message if email sending fails.', 'wp-mailinglist'); ?>
	     <?php _e('Please type an email address below to send a test email to.', 'wp-mailinglist'); ?></p>
	    
	    <div class="newsletters_error"><?php $this -> render('error', array('errors' => $errors), true, 'admin'); ?></div>
	    
	    <form id="testsettingsform" onsubmit="wpml_testsettings(this); return false;" action="<?php echo home_url(); ?>/?<?php echo $this -> pre; ?>method=testsettings" method="post">    
	        <p>
	            <label for="testemail"><?php _e('Email Address:', 'wp-mailinglist'); ?></label><br/>
	            <input tabindex="1" class="widefat" type="text" style="width:400px;" name="testemail" id="testemail" value="<?php echo esc_attr(wp_unslash($_POST['testemail'])); ?>" />
	        </p>
	        
	        <p>
	        	<?php $_POST['subject'] = (empty($_POST['subject'])) ? __('Test Email', 'wp-mailinglist') : wp_kses_post(wp_unslash($_POST['subject'])); ?>
	        	<label for="subject"><?php _e('Subject:', 'wp-mailinglist'); ?></label><br/>
	        	<input tabindex="2" class="widefat" style="width:400px;" type="text" name="subject" id="subject" value="<?php echo esc_attr(wp_unslash($_POST['subject'])); ?>" />
	        </p>
	        
	        <p>
	        	<label for="message"><?php _e('Message:', 'wp-mailinglist'); ?></label>
	        	<?php $_POST['message'] = (empty($_POST['message'])) ? __('This is a test email sent from the Newsletter plugin.', 'wp-mailinglist') : wp_kses_post(wp_unslash($_POST['message'])); ?>
	        	<textarea name="message" id="message" rows="5" class="widefat" style="width:400px;" cols="100%"><?php echo esc_attr(wp_unslash($_POST['message'])); ?></textarea>
	        </p>
	        
	        <p>
	        	<label><input <?php echo (!empty($_POST['testattachment'])) ? 'checked="checked"' : ''; ?> type="checkbox" name="testattachment" value="1" /> <?php _e('Include a test attachment', 'wp-mailinglist'); ?></label>
	        </p>
	        
	        <p>
	        	<input class="button-secondary" onclick="jQuery.colorbox.close();" type="button" name="close" value="<?php _e('Close', 'wp-mailinglist'); ?>" />
	            <button value="1" type="submit" id="testsettingsbutton" class="button button-primary" name="submit">
		            <?php _e('Send Test Email', 'wp-mailinglist'); ?>
		            <span style="display:none;" id="wpml_testsettings_loading"><i class="fa fa-refresh fa-spin fa-fw"></i></span>
	            </button>
	        </p>
	    </form>
	    
	    <script type="text/javascript">   
		jQuery(document).ready(function() {
			setTimeout(function() { jQuery('#testemail').focus(); }, 500);
		});
		     
		function wpml_testsettings(form) {			
			var formvalues = jQuery('#testsettingsform').serialize();
			jQuery('#wpml_testsettings_loading').show();
			jQuery('#testsettingsbutton').attr('disabled', "disabled");
			
			jQuery.post(newsletters_ajaxurl + 'action=<?php echo $this -> pre; ?>testsettings&security=<?php echo wp_create_nonce('testsettings'); ?>', formvalues, function(response) {
				jQuery('#testsettingswrapper').html(response);
				jQuery('#wpml_testsettings_loading').hide();
				jQuery('#testsettingsbutton').removeAttr('disabled');
				jQuery.colorbox.resize();
			});
		}
		</script>
	</div>
</div>