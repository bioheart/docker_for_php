<div class="wrap newsletters">
	<h2><?php _e('View Order: ' . $order -> order_number, 'wp-mailinglist'); ?></h2>
	
	<div class="subsubsub" style="float:none;">
		<a href="<?php echo $this -> url; ?>"><?php _e('&larr; All Orders', 'wp-mailinglist'); ?></a>
	</div>
	
	<div class="tablenav">
		<div class="alignleft actions">
			<a class="button" href="?page=<?php echo $this -> sections -> orders; ?>&amp;method=save&amp;id=<?php echo $order -> id; ?>"><?php _e('Change', 'wp-mailinglist'); ?></a>
			<a class="button button-highlighted" onclick="if (!confirm('<?php _e('Are you sure you want to delete this order?', 'wp-mailinglist'); ?>')) { return false; }" href="?page=<?php echo $this -> sections -> orders; ?>&amp;method=delete&amp;id=<?php echo $order -> id; ?>"><?php _e('Delete', 'wp-mailinglist'); ?></a>
		</div>
	</div>
	
	<table class="widefat">
		<thead>
			<tr>
				<th><?php _e('Field', 'wp-mailinglist'); ?></th>
				<th><?php _e('Value', 'wp-mailinglist'); ?></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th><?php _e('Field', 'wp-mailinglist'); ?></th>
				<th><?php _e('Value', 'wp-mailinglist'); ?></th>
			</tr>
		</tfoot>
		<tbody>
			<?php $class = ''; ?>
			<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
				<th><?php _e('Subscriber', 'wp-mailinglist'); ?></th>
				<td><a href="?page=<?php echo $this -> sections -> subscribers; ?>&amp;method=view&amp;id=<?php echo $subscriber -> id; ?>"><?php echo $subscriber -> email; ?></a></td>
			</tr>
			<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
				<th><?php _e('Mailing List', 'wp-mailinglist'); ?></th>
				<td><a href="?page=<?php echo $this -> sections -> lists; ?>&amp;method=view&amp;id=<?php echo $mailinglist -> id; ?>"><?php echo __($mailinglist -> title); ?></a></td>
			</tr>
			<tr class="alternate">
				<th><?php _e('Amount', 'wp-mailinglist'); ?></th>
				<td><?php echo $Html -> currency(); ?><?php echo number_format($order -> amount, 2, '.', ''); ?></td>
			</tr>
			<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
				<th><?php _e('Payment Method', 'wp-mailinglist'); ?></th>
				<td><?php echo (!empty($order -> pmethod) && $order -> pmethod == "2co") ? __('2CheckOut', 'wp-mailinglist') : __('PayPal', 'wp-mailinglist'); ?></td>
			</tr>
			<?php if (!empty($order -> pmethod) && $order -> pmethod == "2co") : ?>
				<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
					<th><?php _e('2CO Order Number', 'wp-mailinglist'); ?></th>
					<td><?php echo $order -> order_number; ?></td>
				</tr>
			<?php endif; ?>
			<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
				<th><?php _e('Created', 'wp-mailinglist'); ?></th>
				<td><?php echo $order -> created; ?></td>
			</tr>
			<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
				<th><?php _e('Modified', 'wp-mailinglist'); ?></th>
				<td><?php echo $order -> modified; ?></td>
			</tr>
		</tbody>
	</table>
</div>