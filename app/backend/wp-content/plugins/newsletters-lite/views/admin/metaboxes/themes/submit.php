<div id="submitpost" class="submitbox">
	<div id="minor-publishing">
		
	</div>
	<div id="major-publishing-actions">
		<div id="delete-action">
			<?php if ($Html -> field_value('Theme[id]') != "") : ?>
				<a class="submitdelete deletion" href="?page=<?php echo $this -> sections -> themes; ?>&amp;method=delete&amp;id=<?php echo $Html -> field_value('Theme[id]'); ?>" title="<?php _e('Delete this template', 'wp-mailinglist'); ?>" onclick="if (!confirm('<?php _e('Are you sure you wish to remove this template?', 'wp-mailinglist'); ?>')) { return false; }"><?php _e('Delete Template', 'wp-mailinglist'); ?></a>
			<?php endif; ?>
		</div>
		<div id="publishing-action">
			<input id="publish" type="submit" class="button button-primary button-large" name="save" value="<?php _e('Save Template', 'wp-mailinglist'); ?>" />
		</div>
		<br class="clear" />
		<div style="text-align:right; margin:15px 0 5px 0;">
			<label><input style="min-width:0;" <?php echo (!empty($_REQUEST['continueediting'])) ? 'checked="checked"' : ''; ?> type="checkbox" name="continueediting" value="1" id="continueediting" /> <?php _e('Continue editing?', 'wp-mailinglist'); ?></label>
		</div>
	</div>
</div>