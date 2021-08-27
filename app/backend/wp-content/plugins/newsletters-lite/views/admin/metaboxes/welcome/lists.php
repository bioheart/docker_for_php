<div class="total">
	<p><?php _e('Mailing lists total:', 'wp-mailinglist'); ?></p>
	<p class="totalnumber"><?php echo $total_public; ?> / <?php echo $total_private; ?></p>
	<p class="totalsmall"><?php _e('public', 'wp-mailinglist'); ?> / <?php _e('private', 'wp-mailinglist'); ?></p>
	<p><a href="?page=<?php echo $this -> sections -> lists; ?>" class="button button-primary button-large"><?php _e('Manage Lists', 'wp-mailinglist'); ?></a></p>
</div>