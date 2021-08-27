<div class="total">
	<p><?php _e('Emails sent to date:', 'wp-mailinglist'); ?></p>
	<p class="totalnumber"><?php echo $total; ?></p>
	<p><a href="<?php echo admin_url('admin.php?page=' . $this -> sections -> history); ?>" class="button button-primary button-large"><?php _e('Manage History Emails', 'wp-mailinglist'); ?></a></p>
</div>