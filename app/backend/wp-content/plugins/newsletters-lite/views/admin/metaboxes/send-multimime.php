<!-- TEXT Version for Multipart Emails -->

<?php
	
$defaulttexton = $this -> get_option('defaulttexton');
$defaulttextversion = $this -> get_option('defaulttextversion');	
$customtext = (!empty($defaulttexton)) ? $defaulttextversion : sanitize_textarea_field($_POST['customtext']);
	
?>

<p class="howto">
	<?php _e('By default, the TEXT version of multipart emails is automatically generated.', 'wp-mailinglist'); ?><br/>
	<?php _e('You may override that and specify your own TEXT version below.', 'wp-mailinglist'); ?>
</p>

<p>
	<label>
		<input onclick="if (jQuery(this).is(':checked')) { jQuery('#multimime_div').show(); } else { jQuery('#multimime_div').hide(); }" <?php echo (!empty($_POST['customtexton']) || !empty($defaulttexton)) ? 'checked="checked"' : ''; ?> type="checkbox" name="customtexton" value="1" id="customtexton" />
		<?php _e('Specify a custom TEXT version of this newsletter', 'wp-mailinglist'); ?>
	</label>
</p>

<div id="multimime_div" style="display:<?php echo (!empty($_POST['customtext']) || !empty($defaulttexton)) ? 'block' : 'none'; ?>;">
	<textarea name="customtext" id="customtext" rows="6" cols="100%" class="widefat"><?php echo esc_attr(strip_tags(wp_unslash($customtext))); ?></textarea>
	<p><label><input <?php checked($defaulttexton, 1, true); ?> type="checkbox" name="defaulttexton" value="1" id="defaulttexton" /> <?php _e('Make this the default TEXT template for future use.', 'wp-mailinglist'); ?></label>
	<span class="howto"><?php _e('Specify the TEXT version of this multipart email. Only plain TEXT, no HTML is allowed.', 'wp-mailinglist'); ?></span>
</div>