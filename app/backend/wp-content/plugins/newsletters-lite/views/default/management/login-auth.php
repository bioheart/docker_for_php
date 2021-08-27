<div class="newsletters newsletters-management-loginauth">
	<p>
		<?php _e('Thank you for authenticating your email address.', 'wp-mailinglist'); ?><br/>
		<?php _e('If you do not get redirected in a second, click the link below.', 'wp-mailinglist'); ?>
	</p>
	
	<p><a class="newsletters_button" href="<?php echo $this -> get_managementpost(true); ?>"><?php _e('Manage Subscriptions', 'wp-mailinglist'); ?></a></p>
	
	<script type="text/javascript">jQuery(document).ready(function() { window.location = "<?php echo remove_query_arg(array('method', 'email'), $Html -> retainquery('subscriberauth=' . $subscriberauth)); ?>"; });</script>
</div>