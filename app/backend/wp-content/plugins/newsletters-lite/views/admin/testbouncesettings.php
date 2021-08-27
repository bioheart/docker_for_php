<div style="width:400px;">
	<h3><?php _e('Test POP/IMAP Settings', 'wp-mailinglist'); ?></h3>
	
	<?php if ($success == true) : ?>
		<p>
			<?php _e('Congratulations, your POP/IMAP settings are working!', 'wp-mailinglist'); ?><br/>
			<?php _e('Remember to save your configuration settings.', 'wp-mailinglist'); ?>
		</p>
		
		<?php if (!empty($message)) : ?>
			<p class="<?php echo $this -> pre; ?>success"><?php echo $message; ?></p>
		<?php endif; ?>
	<?php else : ?>
		<p class="newsletters_error"><?php _e('Unfortunately a POP/IMAP error occurred:', 'wp-mailinglist'); ?> <?php echo wp_unslash($error); ?></p>
	<?php endif; ?>
	
	<p>
		<input class="button-secondary" onclick="jQuery.colorbox.close();" type="button" name="close" value="<?php _e('Close', 'wp-mailinglist'); ?>" />
	</p>
</div>