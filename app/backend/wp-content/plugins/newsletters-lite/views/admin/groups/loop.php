
	<form onsubmit="if (!confirm('<?php _e('Are you sure you wish to execute this action on the selected groups?', 'wp-mailinglist'); ?>')) { return false; }" action="?page=<?php echo $this -> sections -> groups; ?>&amp;method=mass" method="post">
		<?php wp_nonce_field($this -> sections -> groups . '_mass'); ?>
		<div class="tablenav">
			<div class="alignleft actions">
				<select name="action" class="widefat" style="width:auto;">
					<option value=""><?php _e('- Bulk Actions -', 'wp-mailinglist'); ?></option>
					<option value="delete"><?php _e('Delete Selected', 'wp-mailinglist'); ?></option>
				</select>
				<button value="1" type="submit" class="button-secondary" name="execute">
					<?php _e('Apply', 'wp-mailinglist'); ?>
				</button>
			</div>
			<?php $this -> render('pagination', array('paginate' => $paginate), true, 'admin'); ?>
		</div>
		
		<?php
		
		$orderby = (empty($_GET['orderby'])) ? 'modified' : esc_html($_GET['orderby']);
		$order = (empty($_GET['order'])) ? 'desc' : strtolower(esc_html($_GET['order']));
		$otherorder = ($order == "desc") ? 'asc' : 'desc';
		
		$colspan = 5;
		
		?>
		
		<table class="widefat">
			<thead>
				<tr>
					<td class="check-column"><input type="checkbox" name="" value="" id="checkboxall" /></td>
					<th class="column-id <?php echo ($orderby == "id") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=id&order=' . (($orderby == "id") ? $otherorder : "asc")); ?>">
							<span><?php _e('ID', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
					<th class="column-title <?php echo ($orderby == "title") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=title&order=' . (($orderby == "title") ? $otherorder : "asc")); ?>">
							<span><?php _e('Title', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
                    <th><?php _e('Lists', 'wp-mailinglist'); ?></th>
					<th class="column-modified <?php echo ($orderby == "modified") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=modified&order=' . (($orderby == "modified") ? $otherorder : "asc")); ?>">
							<span><?php _e('Date', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td class="check-column"><input type="checkbox" name="" value="" id="checkboxall" /></td>
					<th class="column-id <?php echo ($orderby == "id") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=id&order=' . (($orderby == "id") ? $otherorder : "asc")); ?>">
							<span><?php _e('ID', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
					<th class="column-title <?php echo ($orderby == "title") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=title&order=' . (($orderby == "title") ? $otherorder : "asc")); ?>">
							<span><?php _e('Title', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
                    <th><?php _e('Lists', 'wp-mailinglist'); ?></th>
					<th class="column-modified <?php echo ($orderby == "modified") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=modified&order=' . (($orderby == "modified") ? $otherorder : "asc")); ?>">
							<span><?php _e('Date', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
				</tr>
			</tfoot>
			<tbody>
				<?php if (empty($groups)) : ?>
					<tr class="no-items">
						<td class="colspanchange" colspan="<?php echo $colspan; ?>"><?php _e('No groups were found', 'wp-mailinglist'); ?></td>
					</tr>
				<?php else : ?>
					<?php foreach ($groups as $group) : ?>
						<?php $class = ($class == 'alternate') ? '' : 'alternate'; ?>
						<tr class="<?php echo $class; ?>" id="grouprow<?php echo $group -> id; ?>">
							<th class="check-column"><input id="checklist<?php echo $group -> id; ?>" type="checkbox" name="groupslist[]" value="<?php echo esc_attr($group -> id); ?>" /></th>
							<td><label for="checklist<?php echo $group -> id; ?>"><?php echo $group -> id; ?></label></td>
							<td>
								<strong><a class="row-title" href="?page=<?php echo $this -> sections -> groups; ?>&amp;method=view&amp;id=<?php echo $group -> id; ?>" title="<?php _e('View the details of this group.', 'wp-mailinglist'); ?>"><?php echo __($group -> title); ?></a></strong>
								<div class="row-actions">
									<span class="edit"><?php echo $Html -> link(__('Edit', 'wp-mailinglist'), '?page=' . $this -> sections -> groups . '&amp;method=save&amp;id=' . $group -> id); ?> |</span>
									<span class="delete"><?php echo $Html -> link(__('Delete', 'wp-mailinglist'), '?page=' . $this -> sections -> groups . '&amp;method=delete&amp;id=' . $group -> id, array('onclick' => "if (!confirm('" . __('Are you sure you want to delete this group?', 'wp-mailinglist') . "')) { return false; }", 'class' => "submitdelete")); ?> |</span>
									<span class="view"><?php echo $Html -> link(__('View', 'wp-mailinglist'), '?page=' . $this -> sections -> groups . '&amp;method=view&amp;id=' . $group -> id); ?></span>
								</div>
							</td>
		                    <td>
		                    	<?php echo $Html -> link($Mailinglist -> count(array('group_id' => $group -> id)), '?page=' . $this -> sections -> groups . '&amp;method=view&amp;id=' . $group -> id . '#mailinglists'); ?>
		                    </td>
							<td><abbr title="<?php echo $Html -> gen_date("Y-m-d H:i:s", strtotime($group -> modified)); ?>"><?php echo $Html -> gen_date(false, strtotime($group -> modified)); ?></abbr></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
		<div class="tablenav">
			<div class="alignleft">
				<?php if (empty($_GET['showall'])) : ?>
					<select class="widefat" style="width:auto;" name="perpage" onchange="change_perpage(this.value);">
						<option value=""><?php _e('- Per Page -', 'wp-mailinglist'); ?></option>
						<?php $p = 5; ?>
						<?php while ($p < 100) : ?>
							<option <?php echo (!empty($_COOKIE[$this -> pre . 'groupsperpage']) && $_COOKIE[$this -> pre . 'groupsperpage'] == $p) ? 'selected="selected"' : ''; ?> value="<?php echo $p; ?>"><?php echo $p; ?> <?php _e('per page', 'wp-mailinglist'); ?></option>
							<?php $p += 5; ?>
						<?php endwhile; ?>
						<?php if (isset($_COOKIE[$this -> pre . 'groupsperpage'])) : ?>
							<option selected="selected" value="<?php echo $_COOKIE[$this -> pre . 'groupsperpage']; ?>"><?php echo $_COOKIE[$this -> pre . 'groupsperpage']; ?></option>
						<?php endif; ?>
					</select>
				<?php endif; ?>
				
				<script type="text/javascript">
				function change_perpage(perpage) {				
					if (perpage != "") {
						document.cookie = "<?php echo $this -> pre; ?>groupsperpage=" + perpage + "; expires=<?php echo $Html -> gen_date($this -> get_option('cookieformat'), strtotime("+30 days")); ?> UTC; path=/";
						window.location = "<?php echo preg_replace("/\&?" . $this -> pre . "page\=(.*)?/si", "", $_SERVER['REQUEST_URI']); ?>";
					}
				}
				
				function change_sorting(field, dir) {
					document.cookie = "<?php echo $this -> pre; ?>listssorting=" + field + "; expires=<?php echo $Html -> gen_date($this -> get_option('cookieformat'), strtotime("+30 days")); ?> UTC; path=/";
					document.cookie = "<?php echo $this -> pre; ?>lists" + field + "dir=" + dir + "; expires=<?php echo $Html -> gen_date($this -> get_option('cookieformat'), strtotime("+30 days")); ?> UTC; path=/";
					window.location = "<?php echo preg_replace("/\&?" . $this -> pre . "page\=(.*)?/si", "", $_SERVER['REQUEST_URI']); ?>";
				}
				</script>
			</div>
			<?php $this -> render('pagination', array('paginate' => $paginate), true, 'admin'); ?>
		</div>
	</form>