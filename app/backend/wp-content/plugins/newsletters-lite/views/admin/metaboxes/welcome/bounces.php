<div class="total">
	<p><?php _e('Bounced emails to date:', 'wp-mailinglist'); ?></p>
	<p class="totalnumber"><?php echo $total; ?></p>
	<p><a href="?page=<?php echo $this -> sections -> subscribers; ?>&amp;method=bounces" class="button button-primary button-large"><?php _e('Manage Bounces', 'wp-mailinglist'); ?></a></p>
</div>