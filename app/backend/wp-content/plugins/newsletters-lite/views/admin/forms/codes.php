<div class="wrap newsletters">
	<h2><?php _e('Subscribe Form Embed/Codes', 'wp-mailinglist'); ?></h2>
	
	<?php $this -> render('forms' . DS . 'navigation', array('form' => $form), true, 'admin'); ?>
	
	<h3><?php _e('Shortcode', 'wp-mailinglist'); ?></h3>
	<p class="howto"><?php _e('Put this shortcode into any WordPress post, page or other area that supports shortcodes to output the subscribe form.', 'wp-mailinglist'); ?></p>
	<code>[newsletters_subscribe form=<?php echo $form -> id; ?>]</code>
	<button type="button" class="button button-secondary button-small copy-button" data-clipboard-text="[newsletters_subscribe form=<?php echo $form -> id; ?>]">
		<i class="fa fa-clipboard fa-fw"></i>
	</button>
	
	<h3><?php _e('Before/After Post', 'wp-mailinglist'); ?></h3>
	<p class="howto"><?php _e('Automatically display this subscribe form before/after all posts.', 'wp-mailinglist'); ?></p>
	
	
	<h3><?php _e('Widget', 'wp-mailinglist'); ?></h3>
	<p class="howto"><?php _e('To add a widget of this subscribe form, go to Appearance > Widgets.', 'wp-mailinglist'); ?></p>
	<p>
		<a href="<?php echo admin_url('widgets.php'); ?>" class="button"><i class="fa fa-external-link-square fa-fw"></i> <?php _e('Go to Widgets', 'wp-mailinglist'); ?></a>
		<a href="<?php echo admin_url('widgets.php?editwidget=newsletters&addnew=1&num=1&base=newsletters'); ?>" class="button button-primary"><i class="fa fa-plus fa-fw"></i> <?php _e('Add Widget', 'wp-mailinglist'); ?></a>
	</p>
	
	<h2><?php _e('Harcode', 'wp-mailinglist'); ?></h3>
	<p class="howto"><?php _e('The harcode is PHP which can be used inside the WordPress theme or another plugin.', 'wp-mailinglist'); ?></p>
	<code>newsletters_hardcode(false, false, false, <?php echo $form -> id; ?>);</code>
	<button type="button" class="button button-secondary button-small copy-button" data-clipboard-text="newsletters_hardcode(false, false, false, <?php echo $form -> id; ?>);">
		<i class="fa fa-clipboard fa-fw"></i>
	</button>
	
	<h3><?php _e('Offsite URL', 'wp-mailinglist'); ?></h3>
	<p class="howto"><?php _e('Use this URL in 3rd party apps like Facebook or an opt-in plugin.', 'wp-mailinglist'); ?></p>
	<code><?php echo $Html -> retainquery($this -> pre . 'method=offsite&form=' . $form -> id, home_url()); ?></code>
	<button type="button" class="button button-secondary button-small copy-button" data-clipboard-text="<?php echo esc_attr($Html -> retainquery($this -> pre . 'method=offsite&form=' . $form -> id, home_url())); ?>">
		<i class="fa fa-clipboard fa-fw"></i>
	</button>
	
	<h3><?php _e('Offsite HTML', 'wp-mailinglist'); ?></h3>
	<p class="howto"><?php _e('Offsite HTML code to use on an external website, an opt-in/popup plugin, etc.', 'wp-mailinglist'); ?></p>
	<?php $output = $this -> render('offsite-subscribeform', array('form' => $form), false, 'admin'); ?>
	<textarea onclick="this.select();" class="widefat" cols="100%" rows="10" style="width:100%;"><?php echo htmlentities(wp_unslash($output)); ?></textarea>
	<button type="button" class="button button-secondary button-small copy-button" data-clipboard-text="<?php echo esc_attr(htmlentities(wp_unslash($output))); ?>">
		<i class="fa fa-clipboard fa-fw"></i>
	</button>
</div>