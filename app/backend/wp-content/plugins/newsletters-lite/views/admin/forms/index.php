<div class="wrap newsletters <?php echo $this -> pre; ?>">
	<h1><?php _e('Manage Forms', 'wp-mailinglist'); ?> <a class="add-new-h2" onclick="jQuery.colorbox({title:'<?php _e('Create a New Form', 'wp-mailinglist'); ?>', href:'<?php echo admin_url('admin-ajax.php?action=newsletters_forms_createform'); ?>'}); return false;" href="?page=<?php echo $this -> sections -> forms; ?>&amp;method=save"><?php _e('Add New', 'wp-mailinglist'); ?></a></h1>
	<form id="posts-filter" action="?page=<?php echo $this -> sections -> forms; ?>" method="post">
		<?php wp_nonce_field($this -> sections -> forms . '_search'); ?>
		<ul class="subsubsub">
			<li><?php echo (empty($_GET['showall'])) ? $paginate -> allcount : count($forms); ?> <?php _e('forms', 'wp-mailinglist'); ?> |</li>
			<?php if (empty($_GET['showall'])) : ?>
				<li><?php echo $Html -> link(__('Show All', 'wp-mailinglist'), $this -> url . '&amp;showall=1'); ?></li>
			<?php else : ?>
				<li><?php echo $Html -> link(__('Show Paging', 'wp-mailinglist'), '?page=' . $this -> sections -> forms); ?></li>
			<?php endif; ?>
		</ul>
		<p class="search-box">
			<input id="post-search-input" class="search-input" type="text" name="searchterm" value="<?php echo (!empty($_POST['searchterm'])) ? esc_attr($_POST['searchterm']) : esc_attr($_GET[$this -> pre . 'searchterm']); ?>" />
			<button value="1" type="submit" class="button">
				<?php _e('Search Forms', 'wp-mailinglist'); ?>
			</button>
		</p>
	</form>
	<?php $this -> render('forms' . DS . 'loop', array('forms' => $forms, 'paginate' => $paginate), true, 'admin'); ?>
</div>