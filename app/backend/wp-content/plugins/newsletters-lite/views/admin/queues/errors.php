<!-- Queue Errors Page -->

<?php
		
$batchnumber = (empty($_GET['batchnumber'])) ? 1 : esc_html($_GET['batchnumber']);
	
$queue_status = $this -> get_option('queue_status');
$count = $this -> qp_get_queued_count();

?>	

<div class="wrap newsletters <?php echo $this -> pre; ?> <?php echo $this -> sections -> queue; ?>">
	<h1>
		<?php _e('Queue Errors', 'wp-mailinglist'); ?> 
		<a href="<?php echo admin_url('admin.php?page=' . $this -> sections -> queue); ?>" class="add-new-h2"><?php echo sprintf(__('Go to Email Queue %s', 'wp-mailinglist'), '<span class="update-plugins count-1"><span class="update-count" id="newsletters-menu-queue-count">' . $count . '</span></span>'); ?></a>
	</h1>
	
	<?php if (!empty($errors)) : ?>
		<br class="clear" />
		<h2><?php _e('Queue Errors', 'wp-mailinglist'); ?></h2>
		<table class="widefat">
			<thead>
				<tr>
					<td><?php _e('Subscriber/User', 'wp-mailinglist'); ?></td>
					<td><?php _e('Newsletter', 'wp-mailinglist'); ?></td>
					<td><?php _e('Error', 'wp-mailinglist'); ?></td>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td><?php _e('Subscriber/User', 'wp-mailinglist'); ?></td>
					<td><?php _e('Newsletter', 'wp-mailinglist'); ?></td>
					<td><?php _e('Error', 'wp-mailinglist'); ?></td>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach ($errors as $error) : ?>
					<?php foreach ($error -> data as $data) : ?>
						<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
							<td>
								<?php
									
								if (!empty($data['subscriber_id'])) {
									$subscriber = $Subscriber -> get($data['subscriber_id']); 
								} elseif (!empty($data['user_id'])) {
									$user = $this -> userdata($data['user_id']);
								}	
									
								?>
								<?php if (!empty($subscriber)) : ?>
									<a href="?page=<?php echo $this -> sections -> subscribers; ?>&amp;method=view&amp;id=<?php echo $subscriber -> id; ?>" class="row-title" title="<?php _e('View this subscriber', 'wp-mailinglist'); ?>"><?php echo $subscriber -> email; ?></a>
								<?php elseif (!empty($user)) : ?>
									<a href="<?php echo get_edit_user_link($user -> ID); ?>" class="row-title"><?php echo $user -> display_name; ?></a>
									<br/><small><?php echo $user -> user_email; ?></small>
								<?php else : ?>
									<span class="howto"><?php _e('Subscriber or user does not exist anymore.', 'wp-mailinglist'); ?></span>
								<?php endif; ?>
							</td>
							<td><?php echo $Html -> link(__($data['subject']), "?page=" . $this -> sections -> history . "&amp;method=view&amp;id=" . $data['history_id']); ?></td>
		                    <td>
		                    	<i class="fa fa-exclamation-triangle fa-fw newsletters_error"></i> <?php echo $data['error']; ?>
		                    </td>
						</tr>
					<?php endforeach; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else : ?>
		<p><?php _e('There are no errors in the email queue', 'wp-mailinglist'); ?></p>
	<?php endif; ?>
</div>