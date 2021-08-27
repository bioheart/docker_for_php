<div class="wrap newsletters <?php echo $this -> pre; ?>">
	<h2><?php _e('View Group:', 'wp-mailinglist'); ?> <?php echo __($group -> title); ?></h2>	
	<div style="float:none;" class="subsubsub"><?php echo $Html -> link(__('&larr; All Groups', 'wp-mailinglist'), $this -> url, array('title' => __('Manage All Groups', 'wp-mailinglist'))); ?></div>
	
	<div class="tablenav">
		<div class="alignleft">
			<a href="?page=<?php echo $this -> sections -> groups; ?>&amp;method=save&amp;id=<?php echo $group -> id; ?>" class="button"><i class="fa fa-pencil"></i> <?php _e('Edit', 'wp-mailinglist'); ?></a>
			<a href="?page=<?php echo $this -> sections -> groups; ?>&amp;method=delete&amp;id=<?php echo $group -> id; ?>" class="button button-highlighted" onclick="if (!confirm('<?php _e('Are you sure you wish to remove this group?', 'wp-mailinglist'); ?>')) { return false; }"><i class="fa fa-times"></i> <?php _e('Delete', 'wp-mailinglist'); ?></a>
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
			<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
				<th><?php _e('Title', 'wp-mailinglist'); ?></th>
				<td><?php echo __($group -> title); ?></td>
			</tr>
            <tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
            	<th><?php _e('Lists', 'wp-mailinglist'); ?></th>
                <td>
                	<?php echo $Html -> link($Mailinglist -> count(array('group_id' => $group -> id)), '#mailinglists'); ?>
                </td>
            </tr>
			<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
				<th><?php _e('Created', 'wp-mailinglist'); ?></th>
				<td><?php echo $group -> created; ?></td>
			</tr>
			<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
				<th><?php _e('Modified', 'wp-mailinglist'); ?></th>
				<td><?php echo $group -> modified; ?></td>
			</tr>
		</tbody>
	</table>
	
	<h3 id="mailinglists"><?php _e('Mailing Lists', 'wp-mailinglist'); ?> <?php echo $Html -> link(__('Add New', 'wp-mailinglist'), '?page=' . $this -> sections -> lists . '&amp;method=save&amp;group_id=' . $group -> id, array('class' => "add-new-h2")); ?></h3>
	<?php $this -> render('mailinglists' . DS . 'loop', array('mailinglists' => $mailinglists, 'paginate' => $paginate), true, 'admin'); ?>
</div>