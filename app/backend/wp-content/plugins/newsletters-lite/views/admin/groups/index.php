<div class="wrap newsletters <?php echo $this -> pre; ?>">
	<h1><?php _e('Manage Groups', 'wp-mailinglist'); ?> <a class="add-new-h2" href="<?php echo $this -> url; ?>&amp;method=save" title="<?php _e('Create a new group', 'wp-mailinglist'); ?>"><?php _e('Add New', 'wp-mailinglist'); ?></a></h1>
	<form id="posts-filter" action="?page=<?php echo $this -> sections -> groups; ?>" method="post">
		<?php wp_nonce_field($this -> sections -> groups . '_search'); ?>
		<ul class="subsubsub">
			<li><?php echo (empty($_GET['showall'])) ? $paginate -> allcount : count($groups); ?> <?php _e('groups', 'wp-mailinglist'); ?> |</li>
			<?php if (empty($_GET['showall'])) : ?>
				<li><?php echo $Html -> link(__('Show All', 'wp-mailinglist'), $this -> url . '&amp;showall=1'); ?></li>
			<?php else : ?>
				<li><?php echo $Html -> link(__('Show Paging', 'wp-mailinglist'), '?page=' . $this -> sections -> groups); ?></li>
			<?php endif; ?>
		</ul>
		<p class="search-box">
			<input id="post-search-input" class="search-input" type="text" name="searchterm" value="<?php echo (!empty($_POST['searchterm'])) ? esc_attr($_POST['searchterm']) : esc_attr($_GET[$this -> pre . 'searchterm']); ?>" />
			<button value="1" type="submit" class="button">
				<?php _e('Search Groups', 'wp-mailinglist'); ?>
			</button>
		</p>
	</form>
	<?php $this -> render('groups' . DS . 'loop', array('groups' => $groups, 'paginate' => $paginate), true, 'admin'); ?>
</div>