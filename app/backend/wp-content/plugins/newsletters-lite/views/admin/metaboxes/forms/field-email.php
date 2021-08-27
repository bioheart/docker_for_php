<!-- Email address field template -->

<?php 
	
if ($this -> language_do()) {
	$languages = $this -> language_getlanguages();
}	
	
?>

<input type="hidden" name="form_fields[<?php echo $field -> id; ?>][id]" value="<?php echo esc_attr(wp_unslash($form_field -> id)); ?>" />
<input type="hidden" name="form_fields[<?php echo $field -> id; ?>][required]" value="1" />

<div class="misc-pub-section">
	<table class="form-table">
		<tbody>
			<tr>
				<th><label for="form_fields_<?php echo $field -> id; ?>_label"><?php _e('Label', 'wp-mailinglist'); ?></label></th>
				<td>
					<?php if ($this -> language_do()) : ?>
						<div id="<?php echo $field -> slug; ?>-label-tabs">
							<ul>
								<?php foreach ($languages as $language) : ?>
									<li><a href="#<?php echo $field -> slug; ?>-label-tabs-<?php echo $language; ?>"><?php echo $this -> language_flag($language); ?></a></li>
								<?php endforeach; ?>
							</ul>
							<?php foreach ($languages as $language) : ?>
								<div id="<?php echo $field -> slug; ?>-label-tabs-<?php echo $language; ?>">
									<input type="text" class="widefat" name="form_fields[<?php echo $field -> id; ?>][label][<?php echo $language; ?>]" value="<?php echo esc_attr(wp_unslash($this -> language_use($language, $form_field -> label))); ?>" id="form_fields_<?php echo $field -> id; ?>_label_<?php echo $language; ?>" placeholder="<?php echo esc_attr(wp_unslash($this -> language_use($language, $field -> title))); ?>" />
								</div>
							<?php endforeach; ?>
						</div>
						
						<script type="text/javascript">
						jQuery(document).ready(function() {
							if (jQuery.isFunction(jQuery.fn.tabs)) {
								jQuery('#<?php echo $field -> slug; ?>-label-tabs').tabs();
							}
						});
						</script>
					<?php else : ?>
						<input type="text" class="widefat" name="form_fields[<?php echo $field -> id; ?>][label]" id="form_fields_<?php echo $field -> id; ?>_label" value="<?php echo esc_attr(wp_unslash((empty($form_field -> label) ? __($field -> title) : __($form_field -> label)))); ?>" />
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<th><label for="form_fields_<?php echo $field -> id; ?>_caption"><?php _e('Caption', 'wp-mailinglist'); ?></label></th>
				<td>
					<?php if ($this -> language_do()) : ?>
						<div id="<?php echo $field -> slug; ?>-caption-tabs">
							<ul>
								<?php foreach ($languages as $language) : ?>
									<li><a href="#<?php echo $field -> slug; ?>-caption-tabs-<?php echo $language; ?>"><?php echo $this -> language_flag($language); ?></a></li>
								<?php endforeach; ?>
							</ul>
							<?php foreach ($languages as $language) : ?>
								<div id="<?php echo $field -> slug; ?>-caption-tabs-<?php echo $language; ?>">
									<input type="text" class="widefat" name="form_fields[<?php echo $field -> id; ?>][caption][<?php echo $language; ?>]" value="<?php echo esc_attr(wp_unslash($this -> language_use($language, $form_field -> caption))); ?>" id="form_fields_<?php echo $field -> id; ?>_caption_<?php echo $language; ?>" placeholder="<?php echo esc_attr(wp_unslash($this -> language_use($language, $field -> caption))); ?>" />
								</div>
							<?php endforeach; ?>
						</div>
						
						<script type="text/javascript">
						jQuery(document).ready(function() {
							if (jQuery.isFunction(jQuery.fn.tabs)) {
								jQuery('#<?php echo $field -> slug; ?>-caption-tabs').tabs();
							}
						});
						</script>
					<?php else : ?>
						<input type="text" class="widefat" name="form_fields[<?php echo $field -> id; ?>][caption]" id="form_fields_<?php echo $field -> id; ?>_caption" value="<?php echo esc_attr(wp_unslash((empty($form_field -> caption) ? __($field -> caption) : __($form_field -> caption)))); ?>" />
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<th><label for="form_fields_<?php echo $field -> id; ?>_placeholder"><?php _e('Placeholder', 'wp-mailinglist'); ?></label></th>
				<td>
					<?php if ($this -> language_do()) : ?>
						<div id="<?php echo $field -> slug; ?>-placeholder-tabs">
							<ul>
								<?php foreach ($languages as $language) : ?>
									<li><a href="#<?php echo $field -> slug; ?>-placeholder-tabs-<?php echo $language; ?>"><?php echo $this -> language_flag($language); ?></a></li>
								<?php endforeach; ?>
							</ul>
							<?php foreach ($languages as $language) : ?>
								<div id="<?php echo $field -> slug; ?>-placeholder-tabs-<?php echo $language; ?>">
									<input type="text" class="widefat" name="form_fields[<?php echo $field -> id; ?>][placeholder][<?php echo $language; ?>]" value="<?php echo esc_attr(wp_unslash($this -> language_use($language, $form_field -> placeholder))); ?>" id="form_fields_<?php echo $field -> id; ?>_placeholder_<?php echo $language; ?>" placeholder="<?php echo esc_attr(wp_unslash($this -> language_use($language, $field -> watermark))); ?>" />
								</div>
							<?php endforeach; ?>
						</div>
						
						<script type="text/javascript">
						jQuery(document).ready(function() {
							if (jQuery.isFunction(jQuery.fn.tabs)) {
								jQuery('#<?php echo $field -> slug; ?>-placeholder-tabs').tabs();
							}
						});
						</script>
					<?php else : ?>
						<input type="text" class="widefat" name="form_fields[<?php echo $field -> id; ?>][placeholder]" id="form_fields_<?php echo $field -> id; ?>_placeholder" value="<?php echo esc_attr(wp_unslash((empty($form_field -> placeholder) ? __($field -> watermark) : __($form_field -> placeholder)))); ?>" />
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<th><label for="form_fields_<?php echo $field -> id; ?>_errormessage"><?php _e('Error Message', 'wp-mailinglist'); ?></label></th>
				<td>
					<?php if ($this -> language_do()) : ?>
						<div id="<?php echo $field -> slug; ?>-errormessage-tabs">
							<ul>
								<?php foreach ($languages as $language) : ?>
									<li><a href="#<?php echo $field -> slug; ?>-errormessage-tabs-<?php echo $language; ?>"><?php echo $this -> language_flag($language); ?></a></li>
								<?php endforeach; ?>
							</ul>
							<?php foreach ($languages as $language) : ?>
								<div id="<?php echo $field -> slug; ?>-errormessage-tabs-<?php echo $language; ?>">
									<input type="text" class="widefat" name="form_fields[<?php echo $field -> id; ?>][errormessage][<?php echo $language; ?>]" value="<?php echo esc_attr(wp_unslash($this -> language_use($language, $form_field -> errormessage))); ?>" id="form_fields_<?php echo $field -> id; ?>_errormessage_<?php echo $language; ?>" placeholder="<?php echo esc_attr(wp_unslash($this -> language_use($language, $field -> errormessage))); ?>" />
								</div>
							<?php endforeach; ?>
						</div>
						
						<script type="text/javascript">
						jQuery(document).ready(function() {
							if (jQuery.isFunction(jQuery.fn.tabs)) {
								jQuery('#<?php echo $field -> slug; ?>-errormessage-tabs').tabs();
							}
						});
						</script>
					<?php else : ?>
						<input type="text" class="widefat" name="form_fields[<?php echo $field -> id; ?>][errormessage]" id="form_fields_<?php echo $field -> id; ?>_errormessage" value="<?php echo esc_attr(wp_unslash($form_field -> errormessage)); ?>" placeholder="<?php echo esc_attr(wp_unslash(__($field -> errormessage))); ?>" />
					<?php endif; ?>
					<span class="howto"><?php _e('Error message to display. Leave empty to use default.', 'wp-mailinglist'); ?></span>
				</td>
			</tr>
		</tbody>
	</table>
</div>