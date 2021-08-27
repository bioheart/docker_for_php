<div class="total">
	<p><?php _e('Unsubscribes to date:', 'wp-mailinglist'); ?></p>
	<p class="totalnumber"><?php echo $total; ?></p>
	<p><a href="?page=<?php echo $this -> sections -> subscribers; ?>&method=unsubscribes" class="button button-primary button-large"><?php _e('Manage Unsubscribes', 'wp-mailinglist'); ?></a></p>
</div>