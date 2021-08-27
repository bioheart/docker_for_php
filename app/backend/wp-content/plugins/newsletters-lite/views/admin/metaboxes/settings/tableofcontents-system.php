<?php $this -> render('metaboxes' . DS . 'admin-mode-switcher', false, true, 'admin'); ?>

<label for="tableofcontents"><?php _e('Go to section', 'wp-mailinglist'); ?></label>
<select name="tableofcontents" id="tableofcontents" onchange="if (this.value != '') { jQuery('#' + this.value).removeClass('closed'); wpml_scroll('#' + this.value); window.location.hash = '#' + this.value; }">
	<option value=""><?php _e('Choose section...', 'wp-mailinglist'); ?></option>
	<option value="captchadiv"><?php _e('Captcha Settings', 'wp-mailinglist'); ?></option>
	<option value="wprelateddiv"><?php _e('WordPress Related', 'wp-mailinglist'); ?></option>
	<option value="autoimportusersdiv"><?php _e('Auto Import Users', 'wp-mailinglist'); ?></option>
	<option value="commentform"><?php _e('WordPress Comment- and Registration Form', 'wp-mailinglist'); ?></option>
</select>

<p class="savebutton">
	<button value="1" type="submit" class="button button-primary button-large" name="save">
		<i class="fa fa-check fa-fw"></i> <?php _e('Save Settings', 'wp-mailinglist'); ?>
	</button>
</p>