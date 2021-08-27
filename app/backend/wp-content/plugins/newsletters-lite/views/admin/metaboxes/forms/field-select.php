<!-- Select Field Template -->

<?php
	
if ($this -> language_do()) {
	$languages = $this -> language_getlanguages();
}	
	
?>

<input type="hidden" name="form_fields[<?php echo $field -> id; ?>][id]" value="<?php echo esc_attr(wp_unslash($form_field -> id)); ?>" />

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
						<input type="text" class="widefat" name="form_fields[<?php echo $field -> id; ?>][label]" id="form_fields_<?php echo $field -> id; ?>_label" value="<?php echo esc_attr(wp_unslash($form_field -> label)); ?>" placeholder="<?php echo esc_attr(wp_unslash(__($field -> title))); ?>" />
					<?php endif; ?>
					<span class="howto"><?php _e('Label to show for this field. Leave empty for default.', 'wp-mailinglist'); ?></span>
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
						<input type="text" class="widefat" name="form_fields[<?php echo $field -> id; ?>][caption]" id="form_fields_<?php echo $field -> id; ?>_caption" value="<?php echo esc_attr(wp_unslash(__($form_field -> caption))); ?>" placeholder="<?php echo esc_attr(wp_unslash(__($field -> caption))); ?>" />
					<?php endif; ?>
					<span class="howto"><?php _e('Caption/description to show below this field with more details. Leave empty for default.', 'wp-mailinglist'); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="form_fields_<?php echo $field -> id; ?>_required"><?php _e('Required?', 'wp-mailinglist'); ?></label></th>
				<td>
					<label><input onclick="if (jQuery(this).is(':checked')) { jQuery('#form_fields_<?php echo $field -> id; ?>_required_div').show(); } else { jQuery('#form_fields_<?php echo $field -> id; ?>_required_div').hide(); }" <?php echo (!empty($form_field -> required) || (empty($form_field -> id) && !empty($field -> required) && $field -> required == "Y")) ? 'checked="checked"' : ''; ?> type="checkbox" name="form_fields[<?php echo $field -> id; ?>][required]" value="1" id="form_fields_<?php echo $field -> id; ?>_required" /> <?php _e('Yes, this field is required', 'wp-mailinglist'); ?></label>
					<span class="howto"><?php _e('Turn this on to require the user to make a selection or fill in a value.', 'wp-mailinglist'); ?></span>
				</td>
			</tr>
		</tbody>
	</table>
	
	<div id="form_fields_<?php echo $field -> id; ?>_required_div" style="display:<?php echo (!empty($form_field -> required) || (empty($form_field -> id) && !empty($field -> required) && $field -> required == "Y")) ? 'block' : 'none'; ?>;">
		<table class="form-table">
			<tbody>
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
</div>