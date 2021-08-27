<div class="total">
	<p><?php _e('Subscribers total to date:', 'wp-mailinglist'); ?></p>
	<p class="totalnumber"><?php echo $total; ?></p>
	<p>
		<a href="?page=<?php echo $this -> sections -> subscribers; ?>" class="button button-primary button-large"><?php _e('Manage Subscribers', 'wp-mailinglist'); ?></a>
	</p>
	<p>
		<a class="button" href="<?php echo admin_url('admin.php?page=' . $this -> sections -> subscribers . '&method=unsubscribes'); ?>"><i class="fa fa-sign-out"></i> <?php _e('Unsubscribes', 'wp-mailinglist'); ?></a>
		<a class="button" href="<?php echo admin_url('admin.php?page=' . $this -> sections -> subscribers . '&method=bounces'); ?>"><i class="fa fa-ban"></i> <?php _e('Bounces', 'wp-mailinglist'); ?></a>
	</p>
	<p>
		<a class="button" href="<?php echo admin_url('admin.php?page=' . $this -> sections -> importexport); ?>"><i class="fa fa-hdd-o"></i> <?php _e('Import/Export', 'wp-mailinglist'); ?></a>
	</p>
</div>