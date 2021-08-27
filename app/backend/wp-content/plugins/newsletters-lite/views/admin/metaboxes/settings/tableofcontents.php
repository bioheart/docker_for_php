<?php $this -> render('metaboxes' . DS . 'admin-mode-switcher', false, true, 'admin'); ?>

<label for="tableofcontents"><?php _e('Go to section', 'wp-mailinglist'); ?></label>
<select name="tableofcontents" id="tableofcontents" onchange="if (this.value != '') { jQuery('#' + this.value).removeClass('closed'); wpml_scroll('#' + this.value); window.location.hash = '#' + this.value; }">
	<option value=""><?php _e('Choose section...', 'wp-mailinglist'); ?></option>
	<option value="generaldiv"><?php _e('General Mail Settings', 'wp-mailinglist'); ?></option>
	<option value="sendingdiv"><?php _e('Sending Settings', 'wp-mailinglist'); ?></option>
	<option value="optindiv"><?php _e('Default Subscription Form Settings', 'wp-mailinglist'); ?></option>
	<option value="subscriptionsdiv"><?php _e('Paid Subscriptions', 'wp-mailinglist'); ?></option>
	<option value="ppdiv"><?php _e('PayPal Configuration', 'wp-mailinglist'); ?></option>
	<option value="tcdiv"><?php _e('2CheckOut Configuration', 'wp-mailinglist'); ?></option>
	<option value="publishingdiv"><?php _e('Posts Configuration', 'wp-mailinglist'); ?></option>
	<option value="schedulingdiv"><?php _e('Email Scheduling', 'wp-mailinglist'); ?></option>
	<option value="bouncediv"><?php _e('Bounce Configuration', 'wp-mailinglist'); ?></option>
	<option value="emailsdiv"><?php _e('History &amp; Emails Configuration', 'wp-mailinglist'); ?></option>
	<option value="latestposts"><?php _e('Latest Posts Subscription', 'wp-mailinglist'); ?></option>
	<option value="customcss"><?php _e('Theme, Scripts &amp; Custom CSS', 'wp-mailinglist'); ?></option>
</select>

<p class="savebutton">
	<button value="1" type="submit" class="button button-primary button-large" name="save">
		<i class="fa fa-check fa-fw"></i> <?php _e('Save Settings', 'wp-mailinglist'); ?>
	</button>
</p>