<div class="newsletters <?php echo $this -> pre; ?>unsubscribe <?php echo $this -> pre; ?>">
	<?php global $wpdb, $Mailinglist; ?>	
	<?php $this -> render('error', array('errors' => $errors), true, 'default'); ?>
	
	<?php if (!empty($success) && $success == true) : ?>
		<h2><?php _e('Unsubscribe Successful', 'wp-mailinglist'); ?></h2>
		<p>
			<?php _e('You have successfully unsubscribed.', 'wp-mailinglist'); ?><br/>
			<?php _e('You will no longer receive correspondence.', 'wp-mailinglist'); ?>
		</p>
		
		<?php if (empty($deleted) && $deleted == false) : ?>
			<ul>
				<li><?php _e('Go back to', 'wp-mailinglist'); ?> <a href="<?php echo home_url(); ?>" title="<?php echo esc_attr(wp_unslash(get_bloginfo('name'))); ?>"><?php echo get_bloginfo('name'); ?></a></li>
			</ul>
		<?php endif; ?>
	<?php elseif (!empty($data)) : ?>
		<h2><?php _e('Unsubscribe Confirmation', 'wp-mailinglist'); ?></h2>
		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
			<?php foreach ($data as $gkey => $gval) : ?>
				<input type="hidden" name="<?php echo $gkey; ?>" value="<?php echo $gval; ?>" />
			<?php endforeach; ?>
			
			<p><?php _e('Please confirm that you want to unsubscribe.', 'wp-mailinglist'); ?></p>
			
			<table>
				<tbody>
					<tr>
						<td><strong><?php _e('Email Address:', 'wp-mailinglist'); ?></strong></td>
						<td><?php echo $user -> user_email; ?></td>
					</tr>
				</tbody>
			</table>
			
			<?php if ($this -> get_option('unsubscribecomments') == "Y") : ?>
				<h3><?php _e('Comments', 'wp-mailinglist'); ?> <?php _e('(optional)', 'wp-mailinglist'); ?></h3>
				<p>
					<textarea name="<?php echo $this -> pre; ?>comments" style="width:97%;" rows="5" class="widefat"><?php echo wp_unslash(htmlentities(strip_tags($data[$this -> pre . 'comments']), false, get_bloginfo('charset'))); ?></textarea>
				</p>
			<?php endif; ?>
			
			<p class="submit">
				<button value="1" type="submit" name="confirm" value="1" class="<?php echo $this -> pre; ?>button">
					<?php _e('Confirm Unsubscribe', 'wp-mailinglist'); ?>
				</button>
			</p>
		</form>
	<?php else : ?>
		<?php foreach ($errors as $err) : ?>
			&raquo; <?php echo $err; ?><br/>
		<?php endforeach; ?>
	<?php endif; ?>
</div>