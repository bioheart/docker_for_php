<?php $this -> render('metaboxes' . DS . 'admin-mode-switcher', false, true, 'admin'); ?>

<label for="tableofcontents"><?php _e('Go to section', 'wp-mailinglist'); ?></label>
<select name="tableofcontents" id="tableofcontents" onchange="if (this.value != '') { jQuery('#' + this.value).removeClass('closed'); wpml_scroll('#' + this.value); window.location.hash = '#' + this.value; }">
	<option value=""><?php _e('Choose section...', 'wp-mailinglist'); ?></option>
	<option value="managementdiv"><?php _e('Subscriber Management Section', 'wp-mailinglist'); ?></option>
	<option value="subscribersdiv"><?php _e('Subscription Behaviour', 'wp-mailinglist'); ?></option>
	<option value="unsubscribediv"><?php _e('Unsubscribe Behaviour', 'wp-mailinglist'); ?></option>
</select>

<p class="savebutton">
	<button value="1" type="submit" class="button button-primary button-large" name="save">
		<i class="fa fa-check fa-fw"></i> <?php _e('Save Settings', 'wp-mailinglist'); ?>
	</button>
</p>