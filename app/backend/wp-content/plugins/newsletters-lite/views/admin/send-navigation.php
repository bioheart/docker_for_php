<!-- Send Navigation -->

<?php
	

	
?>

<div class="wp-filter">	
	<?php /*<ul class="filter-links">
		<li><a class="<?php echo ($_GET['page'] == $this -> sections -> settings) ? 'current' : ''; ?>" href="?page=<?php echo $this -> sections -> settings; ?>"><?php _e('General', 'wp-mailinglist'); ?></a></li>
		<li><a class="<?php echo ($_GET['page'] == $this -> sections -> settings_subscribers) ? 'current' : ''; ?>" href="?page=<?php echo $this -> sections -> settings_subscribers; ?>"><?php _e('Subscribers', 'wp-mailinglist'); ?></a></li>
		<li><a class="<?php echo ($_GET['page'] == $this -> sections -> settings_templates) ? 'current' : ''; ?>" href="?page=<?php echo $this -> sections -> settings_templates; ?>"><?php _e('System Emails', 'wp-mailinglist'); ?></a></li>
		<li><a class="<?php echo ($_GET['page'] == $this -> sections -> settings_system) ? 'current' : ''; ?>" href="?page=<?php echo $this -> sections -> settings_system; ?>"><?php _e('System', 'wp-mailinglist'); ?></a></li>
		<li><a class="<?php echo ($_GET['page'] == $this -> sections -> settings_tasks) ? 'current' : ''; ?>" href="?page=<?php echo $this -> sections -> settings_tasks; ?>"><?php _e('Scheduled Tasks', 'wp-mailinglist'); ?></a></li>
		<li><a class="<?php echo ($_GET['page'] == $this -> sections -> settings_api) ? 'current' : ''; ?>" href="?page=<?php echo $this -> sections -> settings_api; ?>"><?php _e('API', 'wp-mailinglist'); ?></a></li>
	</ul>*/ ?>
	
	<?php if (true || !empty($tableofcontents)) : ?>
		<div class="search-form" id="tableofcontentsdiv">
			<div class="inside">
				<?php $this -> render('metaboxes' . DS . 'send' . DS . 'tableofcontents', false, true, 'admin'); ?>
			</div>
		</div>
	<?php endif; ?>
</div>