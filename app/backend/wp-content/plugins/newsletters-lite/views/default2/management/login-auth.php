<div class="newsletters newsletters-management-loginauth">
	<div class="alert alert-success">
		<i class="fa fa-check"></i>
		<?php _e('Thank you for authenticating your email address.', 'wp-mailinglist'); ?><br/>
		<?php _e('If you do not get redirected in a second, click the link below.', 'wp-mailinglist'); ?>
	</div>

	<p><a class="newsletters_button btn btn-primary" href="<?php echo $this -> get_managementpost(true); ?>"><?php _e('Manage Subscriptions', 'wp-mailinglist'); ?></a></p>

	<script type="text/javascript">jQuery(document).ready(function() { window.location = "<?php echo remove_query_arg(array('method', 'email'), $Html -> retainquery('subscriberauth=' . $subscriberauth)); ?>"; });</script>
</div>