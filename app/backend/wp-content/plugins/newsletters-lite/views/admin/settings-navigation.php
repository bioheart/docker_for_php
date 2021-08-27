<!-- Settings Navigation -->

<div class="wp-filter">
	<ul class="filter-links">
		<li><a class="<?php echo ($_GET['page'] == $this -> sections -> settings) ? 'current' : ''; ?>" href="?page=<?php echo $this -> sections -> settings; ?>"><i class="fa fa-cogs"></i> <?php _e('General', 'wp-mailinglist'); ?></a></li>
		<li><a class="<?php echo ($_GET['page'] == $this -> sections -> settings_subscribers) ? 'current' : ''; ?>" href="?page=<?php echo $this -> sections -> settings_subscribers; ?>"><i class="fa fa-users"></i> <?php _e('Subscribers', 'wp-mailinglist'); ?></a></li>
		<li><a class="<?php echo ($_GET['page'] == $this -> sections -> settings_templates) ? 'current' : ''; ?>" href="?page=<?php echo $this -> sections -> settings_templates; ?>"><i class="fa fa-envelope"></i> <?php _e('System Emails', 'wp-mailinglist'); ?></a></li>
		<li><a class="<?php echo ($_GET['page'] == $this -> sections -> settings_system) ? 'current' : ''; ?>" href="?page=<?php echo $this -> sections -> settings_system; ?>"><i class="fa fa-wordpress"></i> <?php _e('System', 'wp-mailinglist'); ?></a></li>
		<li><a class="<?php echo ($_GET['page'] == $this -> sections -> settings_tasks) ? 'current' : ''; ?>" href="?page=<?php echo $this -> sections -> settings_tasks; ?>"><i class="fa fa-clock-o"></i> <?php _e('Scheduled Tasks', 'wp-mailinglist'); ?></a></li>
		<li><a class="<?php echo ($_GET['page'] == $this -> sections -> settings_api) ? 'current' : ''; ?>" href="?page=<?php echo $this -> sections -> settings_api; ?>"><i class="fa fa-code"></i> <?php _e('API', 'wp-mailinglist'); ?></a></li>
	</ul>
	
	<?php if (!empty($tableofcontents)) : ?>
		<div class="search-form" id="tableofcontentsdiv">
			<div class="inside">
				<?php $this -> render('metaboxes' . DS . 'settings' . DS . $tableofcontents, false, true, 'admin'); ?>
			</div>
		</div>
	<?php endif; ?>
	
	<div style="float:right; margin:10px 5px;">
		<button class="button" type="button" name="togglepostboxes" id="togglepostboxes" value="expand"><i class="fa fa-caret-down"></i> <?php _e('Expand All', 'wp-checkout'); ?></button>
	</div>
</div>

<script type="text/javascript">
jQuery('#togglepostboxes').on('click', function(e) {
	var button = e.target;
	if (button.value == "collapse") {
		jQuery('#normal-sortables div.postbox').addClass('closed');
		jQuery(button).val('expand').html('<i class="fa fa-caret-down"></i> <?php _e('Expand All', 'wp-checkout'); ?>');
	} else {
		jQuery('#normal-sortables div.postbox').removeClass('closed');
		jQuery(button).val('collapse').html('<i class="fa fa-caret-up"></i> <?php _e('Collapse All', 'wp-checkout'); ?>');
	}
	
	postboxes.save_order(pagenow);
	postboxes.save_state(pagenow);
});
</script>