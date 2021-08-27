<div class="wrap newsletters">
	<h1><?php _e('Support &amp; Help', 'wp-mailinglist'); ?></h1>
	
	<?php if (apply_filters('newsletters_whitelabel', true)) : ?>
		<h2><?php _e('Useful Links', 'wp-mailinglist'); ?></h2>
		<ul>
			<li><a href="https://tribulant.com/plugins/view/1/wordpress-newsletter-plugin" target="_blank"><?php _e('Newsletter plugin', 'wp-mailinglist'); ?></a></li>
			<li><a href="https://tribulant.com/plugins/extensions/1/wordpress-newsletter-plugin" target="_blank"><?php _e('Extension plugins', 'wp-mailinglist'); ?></a></li>
			<li><a href="https://tribulant.com/blog/" title="<?php _e('Tribulant News Blog', 'wp-mailinglist'); ?>" target="_blank"><?php _e('News Blog', 'wp-mailinglist'); ?></a></li>
			<li><a href="https://tribulant.com/docs/wordpress-mailing-list-plugin/wordpress-mailing-list-plugin/" title="Tribulant Documentation" target="_blank"><?php _e('Documentation', 'wp-mailinglist'); ?></a></li>
			<li><a href="https://tribulant.com/support/" title="Tribulant Support" target="_blank"><?php _e('Support Ticket System', 'wp-mailinglist'); ?></a></li>
			<li><a href="https://tribulant.com/forums/" target="_blank"><?php _e('Support Forums', 'wp-mailinglist'); ?></a></li>
		</ul>
	<?php endif; ?>
	
	<?php do_action('newsletters_support_below'); ?>
</div>