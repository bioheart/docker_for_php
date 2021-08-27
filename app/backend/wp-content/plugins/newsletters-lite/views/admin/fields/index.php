<!-- Manage Fields -->

<?php
	
global $Field;
$Field -> check_default_fields();	
	
?>

<div class="wrap newsletters">
	<h1><?php _e('Manage Custom Fields', 'wp-mailinglist'); ?> <a class="add-new-h2" href="?page=<?php echo $this -> sections -> fields; ?>&amp;method=save" title="<?php _e('Create a new custom field', 'wp-mailinglist'); ?>"><?php _e('Add New', 'wp-mailinglist'); ?></a></h1>	
	<form id="posts-filter" action="?page=<?php echo $this -> sections -> fields; ?>" method="post">
		<?php wp_nonce_field($this -> sections -> fields . '_search'); ?>
		
		<ul class="subsubsub">
			<li><?php echo (empty($_GET['showall'])) ? $paginate -> allcount : count($fields); ?> <?php _e('custom fields', 'wp-mailinglist'); ?> |</li>
			<?php if (empty($_GET['showall'])) : ?>
				<li><?php echo $Html -> link(__('Show All', 'wp-mailinglist'), $this -> url . '&amp;showall=1'); ?></li>
			<?php else : ?>
				<li><?php echo $Html -> link(__('Show Paging', 'wp-mailinglist'), '?page=' . $this -> sections -> fields); ?></li>
			<?php endif; ?>
		</ul>
		<p class="search-box">
			<input type="text" name="searchterm" id="post-search-input" class="search-input" value="<?php echo (empty($_POST['searchterm'])) ? esc_attr($_GET[$this -> pre . 'searchterm']) : esc_attr($_POST['searchterm']); ?>" />
			<input class="button" name="search" type="submit" value="<?php _e('Search Fields', 'wp-mailinglist'); ?>" />
		</p>
	</form>
	<?php $this -> render('fields' . DS . 'loop', array('fields' => $fields, 'paginate' => $paginate), true, 'admin'); ?>
</div>