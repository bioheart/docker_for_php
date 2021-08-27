<div class="wrap newsletters">
	<h1><?php _e('Manage Snippets', 'wp-mailinglist'); ?> <a class="add-new-h2" href="?page=<?php echo $this -> sections -> templates_save; ?>" title="<?php _e('Create a new newsletter template', 'wp-mailinglist'); ?>"><?php _e('Add New', 'wp-mailinglist'); ?></a></h1>
	<form id="posts-filter" method="post" action="?page=<?php echo $this -> sections -> templates; ?>">
		<ul class="subsubsub">
			<li><?php echo (empty($_GET['showall'])) ? $paginate -> allcount : count($templates); ?> <?php _e('email snippets', 'wp-mailinglist'); ?> |</li>
			<?php if (empty($_GET['showall'])) : ?>
				<li><?php echo $Html -> link(__('Show All', 'wp-mailinglist'), $this -> url . '&amp;showall=1'); ?></li>
			<?php else : ?>
				<li><?php echo $Html -> link(__('Show Paging', 'wp-mailinglist'), "?page=" . $this -> pre . "templates"); ?></li>
			<?php endif; ?>
		</ul>
		<p class="search-box">
			<input type="text" name="searchterm" value="<?php echo (!empty($_POST['searchterm'])) ? esc_attr($_POST['searchterm']) : esc_attr($_GET[$this -> pre . 'searchterm']); ?>" id="post-search-input" class="search-input" />
			<input class="button-secondary" type="submit" name="" value="<?php _e('Search Snippets', 'wp-mailinglist'); ?>" />
		</p>
	</form>
	<?php $this -> render('templates' . DS . 'loop', array('templates' => $templates, 'paginate' => $paginate), true, 'admin'); ?>
</div>