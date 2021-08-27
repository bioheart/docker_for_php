<div class="newsletters newsletters-management-logout">
	<p>
		<?php _e('You have now logged out of your subscriber profile management.', 'wp-mailinglist'); ?><br/>
		<?php _e('If you wish to go back, please click the link below.', 'wp-mailinglist'); ?>
	</p>
	
	<p><a class="newsletters_button" href="<?php echo $this -> get_managementpost(true); ?>"><?php _e('Manage Subscriptions', 'wp-mailinglist'); ?></a></p>
</div>