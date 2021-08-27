<div class="newsletters <?php echo $this -> pre; ?>">
	<?php $this -> render('error', array('errors' => $errors), true, 'default'); ?>
	
	<div class="alert alert-success">
		<i class="fa fa-check"></i>
		<?php _e('You have resubscribed!', 'wp-mailinglist'); ?><br/>
		<?php _e('We are happy that you still want to receive our emails.', 'wp-mailinglist'); ?>
	</div>
	
	<p><a class="newsletters_button btn btn-primary" href="<?php echo $this -> get_managementpost(true); ?>"><?php _e('Manage Subscriptions', 'wp-mailinglist'); ?></a></p>
</div>