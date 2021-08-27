<div class="newsletters <?php echo $this -> pre; ?>">
	<?php $this -> render('error', array('errors' => $errors), true, 'default'); ?>
	
	<h2><?php _e('You have resubscribed!', 'wp-mailinglist'); ?></h2>
	<p><?php _e('We are happy that you still want to receive our emails.', 'wp-mailinglist'); ?></p>
	<p><?php echo $Html -> link(__('Manage Subscriptions', 'wp-mailinglist'), $Html -> retainquery('email=' . $subscriber -> email, $this -> get_managementpost(true))); ?></p>
</div>