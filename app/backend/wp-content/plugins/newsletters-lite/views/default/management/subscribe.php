<!-- Subscribe -->

<div class="newsletters newsletters_subscribe <?php echo $this -> pre; ?>">
	<?php if (!empty($success)) : ?>
		<div class="alert alert-success">
			<i class="fa fa-check"></i>
			<?php _e('You have subscribed!', 'wp-mailinglist'); ?>
		</div>
	<?php else : ?>
		<?php $this -> render('error', array('errors' => $errors), true, 'default'); ?>
	<?php endif; ?>
	
	<p><a class="newsletters_button btn btn-primary" href="<?php echo $this -> get_managementpost(true); ?>"><?php _e('Manage Subscriptions', 'wp-mailinglist'); ?></a></p>
</div>