<div class="wrap newsletters <?php echo $this -> pre; ?>">
	<h2><?php _e('View List:', 'wp-mailinglist'); ?> <?php echo __($mailinglist -> title); ?></h2>
	
	<div style="float:none;" class="subsubsub"><?php echo $Html -> link(__('&larr; All Mailing Lists', 'wp-mailinglist'), $this -> url, array('title' => __('Manage All Mailing Lists', 'wp-mailinglist'))); ?></div>
	
	<div class="tablenav">
		<div class="alignleft">
			<a href="?page=<?php echo $this -> sections -> lists; ?>&method=offsite&listid=<?php echo $mailinglist -> id; ?>" class="button"><i class="fa fa-code"></i> <?php _e('Offsite Form', 'wp-mailinglist'); ?></a>
			<a href="?page=<?php echo $this -> sections -> lists; ?>&method=save&id=<?php echo $mailinglist -> id; ?>" class="button"><i class="fa fa-pencil"></i> <?php _e('Edit', 'wp-mailinglist'); ?></a>
			<a href="?page=<?php echo $this -> sections -> lists; ?>&method=delete&id=<?php echo $mailinglist -> id; ?>" class="button button-highlighted" onclick="if (!confirm('<?php _e('Are you sure you wish to remove this mailing list?', 'wp-mailinglist'); ?>')) { return false; }"><i class="fa fa-times"></i> <?php _e('Delete', 'wp-mailinglist'); ?></a>
			<a href="<?php echo admin_url('admin.php?page=' . $this -> sections -> lists . '&method=deletesubscribers&id=' . $mailinglist -> id); ?>" class="button button-secondary" onclick="if (!confirm('<?php _e('Are you sure you want to delete all subscribers in this mailing list?', 'wp-mailinglist'); ?>')) { return false; }"><i class="fa fa-user-times fa-fw"></i> <?php _e('Delete Subscribers', 'wp-mailinglist'); ?></a>
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
				<td><?php echo __($mailinglist -> title); ?></td>
			</tr>
            <tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
            	<th><?php _e('Group', 'wp-mailinglist'); ?></th>
                <td>
                	<?php if (!empty($mailinglist -> group_id) && !empty($mailinglist -> group)) : ?>
                    	<?php echo $Html -> link(__($mailinglist -> group -> title), '?page=' . $this -> sections -> groups . '&method=view&id=' . $mailinglist -> group_id); ?>
                    <?php else : ?>
                    	<?php _e('none', 'wp-mailinglist'); ?>
                    <?php endif; ?>
                </td>
            </tr>
            <?php if (!empty($mailinglist -> adminemail)) : ?>
            	<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
            		<th><?php _e('Admin Email', 'wp-mailinglist'); ?></th>
            		<td><?php echo $mailinglist -> adminemail; ?></td>
            	</tr>
            <?php endif; ?>
            <?php if (!empty($mailinglist -> redirect)) : ?>
            	<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
            		<th><?php _e('Confirm Redirect URL', 'wp-mailinglist'); ?></th>
            		<td><?php echo '<a href="' . esc_attr(wp_unslash(__($mailinglist -> redirect))) . '" target="_blank">' . __($mailinglist -> redirect) . '</a>'; ?></td>
            	</tr>
            <?php endif; ?>
            <?php if (!empty($mailinglist -> subredirect)) : ?>
            	<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
            		<th><?php _e('Subscribe Redirect URL', 'wp-mailinglist'); ?></th>
            		<td><?php echo '<a href="' . esc_attr(wp_unslash(__($mailinglist -> subredirect))) . '" target="_blank">' . __($mailinglist -> subredirect) . '</a>'; ?></td>
            	</tr>
            <?php endif; ?>
			<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
				<th><?php _e('Subscribers', 'wp-mailinglist'); ?></th>
				<td><?php echo $SubscribersList -> count(array('list_id' => $mailinglist -> id)); ?></td>
			</tr>
			<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
				<th><?php _e('Private List', 'wp-mailinglist'); ?></th>
				<td><?php echo (empty($mailinglist -> privatelist) || $mailinglist -> privatelist == "N") ? __('No', 'wp-mailinglist') : __('Yes', 'wp-mailinglist'); ?></td>
			</tr>
			<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
				<th><?php _e('Paid List', 'wp-mailinglist'); ?></th>
				<td><?php echo (empty($mailinglist -> paid) || $mailinglist -> paid == "N") ? __('No', 'wp-mailinglist') : __('Yes', 'wp-mailinglist'); ?></td>
			</tr>
			<?php if ($mailinglist -> paid == "Y") : ?>
				<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
					<th><?php _e('Price', 'wp-mailinglist'); ?></th>
					<td><?php echo $Html -> currency(); ?><?php echo $mailinglist -> price; ?></td>
				</tr>
				<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
					<th><?php _e('Paid Interval', 'wp-mailinglist'); ?></th>
					<td>
						<?php
						
						$intervals = array(
							'daily'			=>	__('Daily', 'wp-mailinglist'),
							'weekly'		=>	__('Weekly', 'wp-mailinglist'),
							'monthly'		=>	__('Monthly', 'wp-mailinglist'),
							'2months'		=>	__('Every Two Months', 'wp-mailinglist'),
							'3months'		=>	__('Every Three Months', 'wp-mailinglist'),
							'biannually'	=>	__('Twice Yearly (Six Months)', 'wp-mailinglist'),
							'9months'		=>	__('Every Nine Months', 'wp-mailinglist'),
							'yearly'		=>	__('Yearly', 'wp-mailinglist'),
							'once'			=>	__('Once Off', 'wp-mailinglist'),
						);
						
						?>
						<?php echo $intervals[$mailinglist -> interval]; ?>
					</td>
				</tr>
			<?php endif; ?>
			<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
				<th><?php _e('Created', 'wp-mailinglist'); ?></th>
				<td><?php echo $mailinglist -> created; ?></td>
			</tr>
			<tr class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
				<th><?php _e('Modified', 'wp-mailinglist'); ?></th>
				<td><?php echo $mailinglist -> modified; ?></td>
			</tr>
		</tbody>
	</table>
	
	<h3 id="subscribers"><?php _e('Subscribers', 'wp-mailinglist'); ?> <?php echo $Html -> link(__('Add New', 'wp-mailinglist'), '?page=' . $this -> sections -> subscribers . '&method=save&mailinglist_id=' . $mailinglist -> id, array('class' => "add-new-h2")); ?></h3>	
	<?php $this -> render('subscribers' . DS . 'loop', array('subscribers' => $subscribers, 'paginate' => $paginate), true, 'admin'); ?>
</div>