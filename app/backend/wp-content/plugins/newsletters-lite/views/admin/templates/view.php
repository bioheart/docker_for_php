<div id="templates">
	<div class="wrap newsletters">
		<h2><?php _e('View Snippet', 'wp-mailinglist'); ?> : <?php echo $template -> title; ?></h2>
		
		<div style="float:none;" class="subsubsub">
			<?php echo $Html -> link(__('&larr; All Snippets', 'wp-mailinglist'), $this -> url, array('title' => __('Manage All Snippets', 'wp-mailinglist'))); ?>
		</div>
		
		<div class="tablenav">
			<div class="alignleft">				
				<a href="?page=<?php echo $this -> sections -> send; ?>&method=template&id=<?php echo $template -> id; ?>" class="button button-primary"><i class="fa fa-paper-plane"></i> <?php _e('Send', 'wp-mailinglist'); ?></a>
				<a href="?page=<?php echo $this -> sections -> templates_save; ?>&amp;id=<?php echo $template -> id; ?>" class="button"><i class="fa fa-pencil"></i> <?php _e('Edit', 'wp-mailinglist'); ?></a>
				<a href="?page=<?php echo $this -> sections -> templates; ?>&amp;method=delete&amp;id=<?php echo $template -> id; ?>" onclick="if (!confirm('<?php _e('Are you sure you wish to remove this snippet?', 'wp-mailinglist'); ?>')) { return false; }" class="button button-highlighted"><i class="fa fa-times"></i> <?php _e('Delete', 'wp-mailinglist'); ?></a>
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
				<tr class="alternate">
					<th><?php _e('Title', 'wp-mailinglist'); ?></th>
					<td><?php echo __($template -> title); ?></td>
				</tr>
				<tr>
					<th><?php _e('Created', 'wp-mailinglist'); ?></th>
					<td><?php echo $template -> created; ?></td>
				</tr>
				<tr class="alternate">
					<th><?php _e('Modified', 'wp-mailinglist'); ?></th>
					<td><?php echo $template -> modified; ?></td>
				</tr>
				<tr>
					<th><?php _e('Times Sent', 'wp-mailinglist'); ?></th>
					<td><?php echo $template -> sent; ?></td>
				</tr>
			</tbody>
		</table>
		<iframe width="100%" frameborder="0" scrolling="no" class="autoHeight widefat" style="width:100%; margin-top:15px;" src="<?php echo admin_url('admin-ajax.php?action=newsletters_template_iframe&security=' . wp_create_nonce('template_iframe') . '&id=' . $template -> id); ?>"></iframe>
		<div class="tablenav">
			
		</div>
	</div>
</div>