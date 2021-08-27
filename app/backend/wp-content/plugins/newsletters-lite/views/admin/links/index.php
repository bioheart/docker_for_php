<!-- Links -->
<div class="wrap newsletters <?php echo $this -> pre; ?>">
	<h1><?php _e('Manage Links &amp; Clicks', 'wp-mailinglist'); ?></h1>
	<form id="posts-filter" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
		<?php wp_nonce_field($this -> sections -> links . '_search'); ?>
    	<?php if (!empty($links)) : ?>
            <ul class="subsubsub">
                <li><?php echo (empty($_GET['showall'])) ? $paginate -> allcount : count($links); ?> <?php _e('links', 'wp-mailinglist'); ?> |</li>
                <?php if (empty($_GET['showall'])) : ?>
                    <li><?php echo $Html -> link(__('Show All', 'wp-mailinglist'), $Html -> retainquery('showall=1')); ?></li>
                <?php else : ?>
                    <li><?php echo $Html -> link(__('Show Paging', 'wp-mailinglist'), "?page=" . $this -> sections -> links); ?></li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>
		<p class="search-box">
			<input id="post-search-input" class="search-input" type="text" name="searchterm" value="<?php echo (!empty($_POST['searchterm'])) ? esc_attr($_POST['searchterm']) : esc_attr($_GET[$this -> pre . 'searchterm']); ?>" />
			<button value="1" type="submit" class="button">
				<?php _e('Search Links', 'wp-mailinglist'); ?>
			</button>
		</p>
	</form>
	<br class="clear" />
	<?php $this -> render('links' . DS . 'loop', array('links' => $links, 'paginate' => $paginate), true, 'admin'); ?>
</div>