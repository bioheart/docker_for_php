<?php $this -> render('metaboxes' . DS . 'admin-mode-switcher', false, true, 'admin'); ?>

<label for="tableofcontents"><?php _e('Go to section', 'wp-mailinglist'); ?></label>
<select name="tableofcontents" id="tableofcontents" onchange="if (this.value != '') { jQuery('#' + this.value).removeClass('closed'); wpml_scroll('#' + this.value); window.location.hash = '#' + this.value; }">
	<option value=""><?php _e('Choose section...', 'wp-mailinglist'); ?></option>
	<option value="postsdiv"><?php _e('Posts', 'wp-mailinglist'); ?></option>
	<option value="latestpostsdiv"><?php _e('Latest Posts', 'wp-mailinglist'); ?></option>
	<option value="sendasdiv"><?php _e('Send as Newsletter', 'wp-mailinglist'); ?></option>
	<option value="confirmdiv"><?php _e('Confirmation Email', 'wp-mailinglist'); ?></option>
	<option value="bouncediv"><?php _e('Bounce Email', 'wp-mailinglist'); ?></option>
	<option value="unsubscribediv"><?php _e('Unsubscribe Admin Email', 'wp-mailinglist'); ?></option>
	<option value="unsubscribeuserdiv"><?php _e('Unsubscribe User Email', 'wp-mailinglist'); ?></option>
	<option value="expirediv"><?php _e('Expiration Email', 'wp-mailinglist'); ?></option>
	<option value="orderdiv"><?php _e('Paid Subscription Email', 'wp-mailinglist'); ?></option>
	<option value="schedulediv"><?php _e('Cron Schedule Email', 'wp-mailinglist'); ?></option>
	<option value="subscribediv"><?php _e('New Subscription Email', 'wp-mailinglist'); ?></option>
	<option value="authenticatediv"><?php _e('Authentication Email', 'wp-mailinglist'); ?></option>
</select>

<p class="savebutton">
	<button value="1" type="submit" class="button button-primary button-large" name="save">
		<i class="fa fa-check fa-fw"></i> <?php _e('Save Settings', 'wp-mailinglist'); ?>
	</button>
</p>