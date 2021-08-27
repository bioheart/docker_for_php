<!-- Form Settings -->

<?php

if ($this -> language_do()) {
	$languages = $this -> language_getlanguages();
}	

$styling = maybe_unserialize($form -> styling);
	
?>

<div class="wrap newsletters">	
	<h1><?php _e('Form Settings', 'wp-mailinglist'); ?></h1>
	
	<?php $this -> render('forms' . DS . 'navigation', array('form' => $form), true, 'admin'); ?>
	
	<form action="" method="post" id="newsletters-form-settings" name="post" enctype="multipart/form-data">
		<?php wp_nonce_field($this -> sections -> forms . '_settings'); ?>
		
		<input type="hidden" name="saveform" value="1" />
		<input type="hidden" name="id" value="<?php echo esc_attr(wp_unslash($form -> id)); ?>" />
		
		<div id="newsletters-forms-settings-tabs" style="position:relative;">
			<div id="newsletters-form-preview" style="position:absolute; top:50px; right:10px; z-index:999;">
				<button class="button button-primary button-hero" type="button" name="preview" id="newsletters-form-preview-button" onclick="" value="1">
					<span id="newsletters-form-preview-button-icon"><i class="fa fa-eye fa-fw"></i></span> Preview
				</button>
			</div>
			
			<script type="text/javascript">
			(function($) {			
				$('#newsletters-form-preview-button').on('click', function() {
					$button = $('#newsletters-form-preview-button');
					$button.prop('disabled', true);
	
					$icon = $button.find('span');
					$icon.html('<i class="fa fa-refresh fa-spin fa-fw"></i>');
					
					$form = $('#newsletters-form-settings');
					$formvalues = $form.serialize();
					
					$.ajax({
						url: newsletters_ajaxurl + 'action=newsletters_form_preview&security=<?php echo wp_create_nonce('form_preview'); ?>&id=<?php echo $form -> id; ?>',
						type: "POST", 
						data: $formvalues,
						success: function(response) {
							$button.prop('disabled', false);
							$icon.html('<i class="fa fa-eye fa-fw"></i>');
							
							$.colorbox({
								scrolling: true,
								iframe: true,
								href: newsletters_ajaxurl + 'action=newsletters_form_preview&security=<?php echo wp_create_nonce('form_preview'); ?>&id=<?php echo $form -> id; ?>&' + $formvalues,
								title: '<?php echo esc_js(__($form -> title)); ?>',
								open: true,
								width: '80%',
								height: '80%',
								html: response,
							});
						},
						error: function(response) {
							$button.prop('disabled', false);
							$icon.html('<i class="fa fa-eye fa-fw"></i>');
							alert('<?php _e('An error occurred, please try again.', 'wp-mailinglist'); ?>');
						}
					});
				});
			})(jQuery);
			</script>
			
			<ul>
				<li><a href="#newsletters-forms-settings-tabs-general"><i class="fa fa-cogs"></i> <?php _e('General', 'wp-mailinglist'); ?></a></li>
				<li><a href="#newsletters-forms-settings-tabs-confirmation"><i class="fa fa-check"></i> <?php _e('Confirmation', 'wp-mailinglist'); ?></a></li>
				<li><a href="#newsletters-forms-settings-tabs-emails"><i class="fa fa-envelope"></i> <?php _e('Emails', 'wp-mailinglist'); ?></a></li>
				<li><a href="#newsletters-forms-settings-tabs-styling"><i class="fa fa-paint-brush"></i> <?php _e('Styling', $tihs -> plugin_name); ?></a></li>
				<?php /*<li><a href="#newsletters-forms-settings-tabs-notifications"><?php _e('Notifications', 'wp-mailinglist'); ?></a></li>*/ ?>
			</ul>
			
			<div id="newsletters-forms-settings-tabs-general">
				<div class="inside">
					<h3><i class="fa fa-cogs"></i> <?php _e('General Settings', 'wp-mailinglist'); ?></h3>
					
					<table class="form-table">
						<tbody>
							<tr>
								<th><label for="buttontext"><?php _e('Button Text', 'wp-mailinglist'); ?></label></th>
								<td>
									<?php if ($this -> language_do()) : ?>
										<div id="buttontext-tabs">
											<ul>
												<?php foreach ($languages as $language) : ?>
													<li><a href="#buttontext-tabs-<?php echo $language; ?>"><?php echo $this -> language_flag($language); ?></a></li>
												<?php endforeach; ?>
											</ul>
											<?php foreach ($languages as $language) : ?>
												<div id="buttontext-tabs-<?php echo $language; ?>">
													<input type="text" class="widefat" name="buttontext[<?php echo $language; ?>]" value="<?php echo esc_attr(wp_unslash($this -> language_use($language, $form -> buttontext))); ?>" id="buttontext_<?php echo $language; ?>" />
												</div>
											<?php endforeach; ?>
										</div>
										
										<script type="text/javascript">
										jQuery(document).ready(function() {
											if (jQuery.isFunction(jQuery.fn.tabs)) {
												jQuery('#buttontext-tabs').tabs();
											}
										});
										</script>
									<?php else : ?>
										<input type="text" class="widefat" name="buttontext" value="<?php echo esc_attr(wp_unslash($form -> buttontext)); ?>" id="buttontext" />
									<?php endif; ?>
									<span class="howto"><?php _e('Text that shows on the subscribe button', 'wp-mailinglist'); ?></span>
								</td>
							</tr>
							<tr>
								<th><label for="ajax"><?php _e('Enable Ajax', 'wp-mailinglist'); ?></label></th>
								<td>
									<label><input <?php echo (!empty($form -> ajax)) ? 'checked="checked"' : ''; ?> type="checkbox" name="ajax" value="1" id="ajax" /> <?php _e('Yes, enable Ajax form submission', 'wp-mailinglist'); ?></label>
									<span class="howto"><?php _e('Turn this on to submit this form with Ajax instead of page refresh.', 'wp-mailinglist'); ?></span>
								</td>
							</tr>
						</tbody>
					</table>
					
					<div id="ajax_div" style="display:<?php echo (!empty($form -> ajax)) ? 'block' : 'none'; ?>;">
						<table class="form-table">
							<tbody>
								<tr>
									<th><?php _e('Scroll to Form', 'wp-mailinglist'); ?></th>
									<td>
										<label for="scroll"><input <?php echo (!empty($form -> scroll)) ? 'checked="checked"' : ''; ?> type="checkbox" name="scroll" value="1" id="scroll" /> <?php _e('Yes, scroll to the subscribe form', 'wp-mailinglist'); ?></label>
										<span class="howto"><?php _e('Turn on/off the scroll to the subscribe form container after submitting.', 'wp-mailinglist'); ?></span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					
					<table class="form-table">
						<tbody>
							<tr>
								<th><label for="captcha"><?php _e('Enable Captcha', 'wp-mailinglist'); ?></label></th>
								<td>
									<label><input <?php echo (!$this -> use_captcha()) ? 'disabled="disabled"' : ''; ?> <?php echo (!empty($form -> captcha) && $this -> use_captcha()) ? 'checked="checked"' : ''; ?> type="checkbox" name="captcha" value="1" id="captcha" /> <?php _e('Yes, enable security captcha', 'wp-mailinglist'); ?></label>
									<?php if (!$this -> use_captcha()) : ?>
										<div class="newsletters_error"><?php echo sprintf(__('Please configure a security captcha under %s > Configuration > System > Captcha in order to use this.', 'wp-mailinglist'), $this -> name); ?></div>
									<?php else : ?>
										<div class="newsletters_success"><?php echo sprintf(__('Captcha is already setup, you can %s.', 'wp-mailinglist'), '<a href="' . admin_url('admin.php?page=' . $this -> sections -> settings_system) . '#captchadiv">' . __('configure it here', 'wp-mailinglist') . '</a>'); ?></div>
									<?php endif; ?>
									<span class="howto"><?php _e('Do you want to show a security captcha on this form to prevent spam subscriptions?', 'wp-mailinglist'); ?></span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			
			<div id="newsletters-forms-settings-tabs-confirmation">
				<h3><i class="fa fa-check"></i> <?php _e('Confirmation Settings', 'wp-mailinglist'); ?></h3>
				
				<table class="form-table">
					<tbody>
						<tr>
							<th><label for="confirmationtype_message"><?php _e('Confirmation Type', 'wp-mailinglist'); ?></label></th>
							<td>
								<label><input <?php echo (empty($form -> confirmationtype) || (!empty($form -> confirmationtype) && $form -> confirmationtype == "message")) ? 'checked="checked"' : ''; ?> onclick="jQuery('#confirmationtype_message_div').show(); jQuery('#confirmationtype_redirect_div').hide();" type="radio" name="confirmationtype" value="message" id="confirmationtype_message" /> <?php _e('Message', 'wp-mailinglist'); ?></label>
								<label><input <?php echo (!empty($form -> confirmationtype) && $form -> confirmationtype == "redirect") ? 'checked="checked"' : ''; ?> onclick="jQuery('#confirmationtype_message_div').hide(); jQuery('#confirmationtype_redirect_div').show();" type="radio" name="confirmationtype" value="redirect" id="confirmationtype_redirect" /> <?php _e('Redirect', 'wp-mailinglist'); ?></label>
							</td>
						</tr>
					</tbody>
				</table>
				
				<div id="confirmationtype_message_div" style="display:<?php echo (empty($form -> confirmationtype) || (!empty($form -> confirmationtype) && $form -> confirmationtype == "message")) ? 'block' : 'none'; ?>;">
					<table class="form-table">
						<tbody>
							<tr>
								<th><label for="confirmation_message"><?php _e('Message', 'wp-mailinglist'); ?></label></th>
								<td>
									<?php if ($this -> language_do()) : ?>
										<?php if (!empty($languages) && is_array($languages)) : ?>
									    	<div id="confirmation_message-tabs">
									        	<ul>
													<?php $tabnumber = 1; ?>
									                <?php foreach ($languages as $language) : ?>
									                 	<li><a href="#confirmation_message-tabs<?php echo $tabnumber; ?>"><?php echo $this -> language_flag($language); ?></a></li>   
									                    <?php $tabnumber++; ?>
									                <?php endforeach; ?>
									            </ul>
									            
									            <?php $tabnumber = 1; ?>
									            <?php foreach ($languages as $language) : ?>
									            	<div id="confirmation_message-tabs<?php echo $tabnumber; ?>">
										            	<?php 
										
														$settings = array(
															'media_buttons'		=>	true,
															'textarea_name'		=>	'confirmation_message[' . $language . ']',
															'textarea_rows'		=>	5,
															'quicktags'			=>	true,
															'teeny'				=>	false,
														);
														
														wp_editor(wp_unslash($this -> language_use($language, $form -> confirmation_message)), 'confirmation_message_' . $language, $settings); 
														
														?>
									            	</div>
									            	<?php $tabnumber++; ?>
									            <?php endforeach; ?>
									    	</div>
									    <?php endif; ?>
									    
									    <script type="text/javascript">
									    jQuery(document).ready(function() {
										    if (jQuery.isFunction(jQuery.fn.tabs)) {
										    	jQuery('#confirmation_message-tabs').tabs();
										    }
									    });
									    </script>
									<?php else : ?>
										<?php
											
										$settings = array(
											'media_buttons'		=>	true,
											'textarea_name'		=>	'confirmation_message',
											'textarea_rows'		=>	5,
											'quicktags'			=>	true,
											'teeny'				=>	false,
										);
										
										wp_editor(wp_unslash($form -> confirmation_message), 'confirmation_message', $settings); 
											
										?>		
									<?php endif; ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				
				<div id="confirmationtype_redirect_div" style="display:<?php echo (!empty($form -> confirmationtype) && $form -> confirmationtype == "redirect") ? 'block' : 'none'; ?>;">
					<table class="form-table">
						<tbody>
							<tr>
								<th><label for="confirmation_redirect"><?php _e('Redirect URL', 'wp-mailinglist'); ?></label></th>
								<td>
									<?php if ($this -> language_do()) : ?>
										<div id="confirmation_redirect-tabs">
											<ul>
												<?php foreach ($languages as $language) : ?>
													<li><a href="#confirmation_redirect-tabs-<?php echo $language; ?>"><?php echo $this -> language_flag($language); ?></a></li>
												<?php endforeach; ?>
											</ul>
											<?php foreach ($languages as $language) : ?>
												<div id="confirmation_redirect-tabs-<?php echo $language; ?>">
													<input type="text" class="widefat" name="confirmation_redirect[<?php echo $language; ?>]" value="<?php echo esc_attr(wp_unslash($this -> language_use($language, $form -> confirmation_redirect))); ?>" id="confirmation_redirect_<?php echo $language; ?>" placeholder="https://..." />
												</div>
											<?php endforeach; ?>
										</div>
										
										<script type="text/javascript">
										jQuery(document).ready(function() {
											if (jQuery.isFunction(jQuery.fn.tabs)) {
												jQuery('#confirmation_redirect-tabs').tabs();
											}
										});
										</script>
									<?php else : ?>
										<input type="text" class="widefat" name="confirmation_redirect" value="<?php echo esc_attr(wp_unslash($form -> confirmation_redirect)); ?>" id="confirmation_redirect" />
									<?php endif; ?>
									<span class="howto"><?php _e('Enter a URL to redirect to upon successful subscribe.', 'wp-mailinglist'); ?></span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			
			<!-- Emails Settings -->
			<div id="newsletters-forms-settings-tabs-emails">
				<h2><i class="fa fa-envelope fa-fw"></i> <?php _e('Emails', 'wp-mailinglist'); ?></h2>
				
				<h3><?php _e('Confirmation/Activation Email', 'wp-mailinglist'); ?></h3>
				<p class="howto"><?php _e('Leave blank to use system default', 'wp-mailinglist'); ?></p>
				<?php $this -> render('forms' . DS . 'emails' . DS . 'confirm', array('form' => $form, 'languages' => $languages), true, 'admin'); ?>
			</div>
			
			<!-- Styling Settings -->
			<div id="newsletters-forms-settings-tabs-styling" style="position:relative;">
				<h2><i class="fa fa-paint-brush"></i> <?php _e('Styling Settings', 'wp-mailinglist'); ?></h2>
				
				<div id="newsletters-forms-settings-styling-tabs">
					<ul>
						<li><a href="#newsletters-forms-settings-styling-tabs-form"><?php _e('Form Styling', 'wp-mailinglist'); ?></a></li>
						<li><a href="#newsletters-forms-settings-styling-tabs-field"><?php _e('Field Styling', 'wp-mailinglist'); ?></a></li>
						<li><a href="#newsletters-forms-settings-styling-tabs-button"><?php _e('Button Styling', 'wp-mailinglist'); ?></a></li>
						<li><a href="#newsletters-forms-settings-styling-tabs-customhtml"><?php _e('Custom HTML', 'wp-mailinglist'); ?></a></li>
						<li><a href="#newsletters-forms-settings-styling-tabs-customcss"><?php _e('Custom CSS', 'wp-mailinglist'); ?></a></li>
					</ul>
					
					<div id="newsletters-forms-settings-styling-tabs-form">
						<!-- Form Styling Settings -->
						<h3><?php _e('Form Styling', 'wp-mailinglist'); ?></h3>
						<table class="form-table">
							<tbody>
								<tr>
									<th><label for="styling_formlayout_normal"><?php _e('Layout', 'wp-mailinglist'); ?></label></th>
									<td>
										<label><input <?php echo (empty($styling['formlayout']) || $styling['formlayout'] == "normal") ? 'checked="checked"' : ''; ?> type="radio" name="styling[formlayout]" value="normal" id="styling_formlayout_normal" /> <?php _e('Normal', 'wp-mailinglist'); ?></label>
										<label><input <?php echo (!empty($styling['formlayout']) && $styling['formlayout'] == "inline") ? 'checked="checked"' : ''; ?> type="radio" name="styling[formlayout]" value="inline" id="styling_formlayout_inline" /> <?php _e('Inline/Horizontal', 'wp-mailinglist'); ?></label>
									</td>
								</tr>
							</tbody>
						</table>
						
						<div id="styling_formlayout_normal_div">
							<table class="form-table">
								<tbody>
									<tr>
										<th><label for="styling_twocolumns"><?php _e('Two Columns inside Posts/Pages', 'wp-mailinglist'); ?></label></th>
										<td>
											<label><input <?php checked($styling['twocolumns'], 1, true); ?> type="checkbox" name="styling[twocolumns]" value="1" id="styling_twocolumns" /> <?php _e('Yes, display two columns inside posts/pages.', 'wp-mailinglist'); ?></label>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<table class="form-table">
							<tbody>
								<tr>
									<th><label for="styling_formpadding"><?php _e('Form Padding', 'wp-mailinglist'); ?></label></th>
									<td>
										<?php $styling['formpadding'] = (empty($styling['formpadding'])) ? 0 : $styling['formpadding']; ?>
										<input type="hidden" style="width:45px;" name="styling[formpadding]" value="<?php echo esc_attr(wp_unslash($styling['formpadding'])); ?>" id="styling_formpadding" />
										<div class="slider" data-input="styling_formpadding" data-min="0" data-max="100" data-meas="px" data-value="<?php echo esc_attr(wp_unslash($styling['formpadding'])); ?>"></div>
									</td>
								</tr>
								<tr>
									<th><label for="styling_formtextcolor"><?php _e('Text Color', 'wp-mailinglist'); ?></label></th>
									<td>
										<input type="text" class="color-picker" name="styling[formtextcolor]" value="<?php echo esc_attr(wp_unslash($styling['formtextcolor'])); ?>" id="styling_formtextcolor" />
									</td>
								</tr>
								<tr>
									<th><label for="styling_background"><?php _e('Background Color', 'wp-mailinglist'); ?></label></th>
									<td>
										<input type="text" class="color-picker" name="styling[background]" value="<?php echo esc_attr(wp_unslash($styling['background'])); ?>" id="styling_background" />
									</td>
								</tr>
								<tr>
									<th><label for="styling_loadingindicator"><?php _e('Loading Indicator?', 'wp-mailinglist'); ?></label></th>
									<td>
										<label><input <?php echo (!empty($styling['loadingindicator'])) ? 'checked="checked"' : ''; ?> onclick="if (jQuery(this).is(':checked')) { jQuery('#styling_loadingindicator_div').show(); } else { jQuery('#styling_loadingindicator_div').hide(); }" type="checkbox" name="styling[loadingindicator]" value="1" id="styling_loadingindicator" /> <?php _e('Yes, show a loading indicator on Ajax calls', 'wp-mailinglist'); ?></label>
									</td>
								</tr>
							</tbody>
						</table>
						
						<div id="styling_loadingindicator_div" style="display:<?php echo (!empty($styling['loadingindicator'])) ? 'block' : 'none'; ?>;">
							<table class="form-table">
								<tbody>
									<tr>
										<th><label for=""><?php _e('Loading Icon', 'wp-mailinglist'); ?></label></th>
										<td>
											<?php
											
											include($this -> plugin_base() . DS . 'includes' . DS . 'variables.php');
											if (!empty($spinners)) {
												foreach ($spinners as $key => $loading) {
													?>
													
													<label>
														<input <?php echo (!empty($styling['loadingicon']) && $styling['loadingicon'] == $key) ? 'checked="checked"' : ''; ?> type="radio" name="styling[loadingicon]" value="<?php echo esc_attr(wp_unslash($key)); ?>" />
														<i class="<?php echo $loading; ?>"></i>
													</label>
													
													<?php
												}
											}	
												
											?>
										</td>
									</tr>
									<tr>
										<th><label for="styling_loadingcolor"><?php _e('Loading Color', 'wp-mailinglist'); ?></label></th>
										<td>
											<input type="text" class="color-picker" name="styling[loadingcolor]" value="<?php echo esc_attr(wp_unslash($styling['loadingcolor'])); ?>" id="styling_loadingcolor" />
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					
					<div id="newsletters-forms-settings-styling-tabs-field">
						<!-- Field Styling Settings -->
						<h3><?php _e('Field Styling', 'wp-mailinglist'); ?></h3>
						<table class="form-table">
							<tbody>
								<tr>
									<th><label for=""><?php _e('Color', 'wp-mailinglist'); ?></label></th>
									<td>
										<input type="text" class="color-picker" name="styling[fieldcolor]" value="<?php echo esc_attr(wp_unslash($styling['fieldcolor'])); ?>" />
									</td>
								</tr>
								<tr>
									<th><label for=""><?php _e('Text Color', 'wp-mailinglist'); ?></label></th>
									<td>
										<input type="text" class="color-picker" name="styling[fieldtextcolor]" value="<?php echo esc_attr(wp_unslash($styling['fieldtextcolor'])); ?>" />
									</td>
								</tr>
								<tr>
									<th><label for="styling_fieldborderradius"><?php _e('Border Radius', 'wp-mailinglist'); ?></label>
									<td>
										<input type="hidden" style="width:45px;" name="styling[fieldborderradius]" value="<?php echo esc_attr(wp_unslash($styling['fieldborderradius'])); ?>" id="styling_fieldborderradius" />
										<div class="slider" data-input="styling_fieldborderradius" data-min="0" data-max="100" data-meas="px" data-value="<?php echo esc_attr(wp_unslash($styling['fieldborderradius'])); ?>"></div>
									</td>
								</tr>
								<tr>
									<th><label for="styling_fieldshowlabel"><?php _e('Show Label?', 'wp-mailinglist'); ?></label></th>
									<td>
										<label><input onclick="jQuery('#styling_fieldshowlabel_div').toggle();" <?php echo (!empty($styling['fieldshowlabel'])) ? 'checked="checked"' : ''; ?> type="checkbox" name="styling[fieldshowlabel]" value="1" id="styling_fieldshowlabel" /> <?php _e('Yes, show the label for each field', 'wp-mailinglist'); ?></label>
									</td>
								</tr>
							</tbody>
						</table>
						
						<div id="styling_fieldshowlabel_div" style="display:<?php echo (!empty($styling['fieldshowlabel'])) ? 'block' : 'none'; ?>;">
							<table class="form-table">
								<tbody>
									<tr>
										<th><label for="styling_fieldlabelcolor"><?php _e('Label Color', 'wp-mailinglist'); ?></label></th>
										<td>
											<input type="text" class="color-picker" name="styling[fieldlabelcolor]" value="<?php echo esc_attr(wp_unslash($styling['fieldlabelcolor'])); ?>" id="styling_fieldlabelcolor" />
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<table class="form-table">
							<tbody>
								<tr>
									<th><label for="styling_fieldcaptions"><?php _e('Show Captions', 'wp-mailinglist'); ?></label></th>
									<td>
										<label><input onclick="if (jQuery(this).is(':checked')) { jQuery('#styling_fieldcaptioncolor_div').show(); } else { jQuery('#styling_fieldcaptioncolor_div').hide(); }" <?php echo (!empty($styling['fieldcaptions'])) ? 'checked="checked"' : ''; ?> type="checkbox" name="styling[fieldcaptions]" value="1" id="styling_fieldcaptions" /> <?php _e('Yes, show captions below fields', 'wp-mailinglist'); ?></label>
									</td>
								</tr>
							</tbody>
						</table>
						
						<div id="styling_fieldcaptioncolor_div" style="display:<?php echo (!empty($styling['fieldcaptions'])) ? 'block' : 'none'; ?>;">
							<table class="form-table">
								<tbody>
									<tr>
										<th><label for="styling_fieldcaptioncolor"><?php _e('Caption Color', 'wp-mailinglist'); ?></label></th>
										<td>
											<input type="text" class="color-picker" name="styling[fieldcaptioncolor]" value="<?php echo esc_attr(wp_unslash($styling['fieldcaptioncolor'])); ?>" id="styling_fieldcaptioncolor" />
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<table class="form-table">
							<tbody>
								<tr>
									<th><label for="styling_fielderrors"><?php _e('Show Errors', 'wp-mailinglist'); ?></label></th>
									<td>
										<label><input onclick="if (jQuery(this).is(':checked')) { jQuery('#styling_fielderrors_div').show(); } else { jQuery('#styling_fielderrors_div').hide(); }" <?php echo (!empty($styling['fielderrors'])) ? 'checked="checked"' : ''; ?> type="checkbox" name="styling[fielderrors]" value="1" id="styling_fielderrors" /> <?php _e('Yes, show error messages below fields on validation.', 'wp-mailinglist'); ?></label>
									</td>
								</tr>
							</tbody>
						</table>
						
						<div id="styling_fielderrors_div" style="display:<?php echo (!empty($styling['fielderrors'])) ? 'block' : 'none'; ?>;">
							<table class="form-table">
								<tbody>
									<tr>
										<th><label for="styling_fielderrorcolor"><?php _e('Error Color', 'wp-mailinglist'); ?></label></th>
										<td>
											<input type="text" class="color-picker" name="styling[fielderrorcolor]" value="<?php echo esc_attr(wp_unslash($styling['fielderrorcolor'])); ?>" id="styling_fielderrorcolor" />
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					
					<div id="newsletters-forms-settings-styling-tabs-button">
						<!-- Button Styling Settings -->
						<h3><?php _e('Button Styling', 'wp-mailinglist'); ?></h3>
						<table class="form-table">
							<tbody>
								<tr>
									<th><label for="styling_buttoncolor"><?php _e('Color', 'wp-mailinglist'); ?></label></th>
									<td>
										<input type="text" name="styling[buttoncolor]" class="color-picker" value="<?php echo esc_attr(wp_unslash($styling['buttoncolor'])); ?>" id="styling_buttoncolor" />
									</td>
								</tr>
								<tr>
									<th><label for=""><?php _e('Text Color', 'wp-mailinglist'); ?></label></th>
									<td>
										<input type="text" name="styling[buttontextcolor]" class="color-picker" value="<?php echo esc_attr(wp_unslash($styling['buttontextcolor'])); ?>" id="styling_buttontextcolor" />
									</td>
								</tr>
								<tr>
									<th><label for="styling_buttonbordersize"><?php _e('Border Size', 'wp-mailinglist'); ?></label></th>
									<td>
										<input type="hidden" style="width:45px;" name="styling[buttonbordersize]" value="<?php echo esc_attr(wp_unslash($styling['buttonbordersize'])); ?>" id="styling_buttonbordersize" />
										<div class="slider" data-min="0" data-max="100" data-meas="px" data-input="styling_buttonbordersize" data-value="<?php echo esc_attr(wp_unslash($styling['buttonbordersize'])); ?>"></div>
									</td>
								</tr>
								<tr>
									<th><label for="styling_buttonborderradius"><?php _e('Border Radius', 'wp-mailinglist'); ?></label></th>
									<td>
										<input type="hidden" style="width:45px;" name="styling[buttonborderradius]" value="<?php echo esc_attr(wp_unslash($styling['buttonborderradius'])); ?>" id="styling_buttonborderradius" />
										<div class="slider" data-min="0" data-max="100" data-meas="px" data-input="styling_buttonborderradius" data-value="<?php echo esc_attr(wp_unslash($styling['buttonborderradius'])); ?>"></div>
									</td>
								</tr>
								<tr>
									<th><label for="styling_buttonbordercolor"><?php _e('Border Color', 'wp-mailinglist'); ?></label></th>
									<td>
										<input type="text" name="styling[buttonbordercolor]" class="color-picker" value="<?php echo esc_attr(wp_unslash($styling['buttonbordercolor'])); ?>" id="styling_buttonbordercolor" />
									</td>
								</tr>
								<tr>
									<th><label for="styling_buttonhovercolor"><?php _e('Hover Color', 'wp-mailinglist'); ?></label></th>
									<td>
										<input type="text" name="styling[buttonhovercolor]" class="color-picker" value="<?php echo esc_attr(wp_unslash($styling['buttonhovercolor'])); ?>" id="styling_buttonhovercolor" />
									</td>
								</tr>
								<tr>
									<th><label for="styling_buttonhoverbordercolor"><?php _e('Hover Border Color', 'wp-mailinglist'); ?></label></th>
									<td>
										<input type="text" name="styling[buttonhoverbordercolor]" class="color-picker" value="<?php echo esc_attr(wp_unslash($styling['buttonhoverbordercolor'])); ?>" id="styling_buttonhoverbordercolor" />
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					
					<div id="newsletters-forms-settings-styling-tabs-customhtml">
						<h3><?php _e('Custom HTML', 'wp-mailinglist'); ?></h3>
						<table class="form-table">
							<tbody>
								<tr>
									<th><?php _e('Before Form', 'wp-mailinglist'); ?></th>
									<td>
										<?php if ($this -> language_do()) : ?>
											<?php if (!empty($languages) && is_array($languages)) : ?>
										    	<div id="styling_beforeform-tabs">
										        	<ul>
														<?php $tabnumber = 1; ?>
										                <?php foreach ($languages as $language) : ?>
										                 	<li><a href="#styling_beforeform-tabs<?php echo $tabnumber; ?>"><?php echo $this -> language_flag($language); ?></a></li>   
										                    <?php $tabnumber++; ?>
										                <?php endforeach; ?>
										            </ul>
										            
										            <?php $tabnumber = 1; ?>
										            <?php foreach ($languages as $language) : ?>
										            	<div id="styling_beforeform-tabs<?php echo $tabnumber; ?>">
											            	<?php 
											
															$settings = array(
																'media_buttons'		=>	true,
																'textarea_name'		=>	'styling_beforeform[' . $language . ']',
																'textarea_rows'		=>	5,
																'quicktags'			=>	true,
																'teeny'				=>	false,
															);
															
															wp_editor(wp_unslash($this -> language_use($language, $form -> styling_beforeform)), 'styling_beforeform_' . $language, $settings); 
															
															?>
										            	</div>
										            	<?php $tabnumber++; ?>
										            <?php endforeach; ?>
										    	</div>
										    <?php endif; ?>
										    
										    <script type="text/javascript">
										    jQuery(document).ready(function() {
											    if (jQuery.isFunction(jQuery.fn.tabs)) {
											    	jQuery('#styling_beforeform-tabs').tabs();
											    }
										    });
										    </script>
										<?php else : ?>
											<?php
												
											$settings = array(
												'media_buttons'		=>	true,
												'textarea_name'		=>	'styling_beforeform',
												'textarea_rows'		=>	5,
												'quicktags'			=>	true,
												'teeny'				=>	false,
											);
											
											wp_editor(wp_unslash($form -> styling_beforeform), 'styling_beforeform', $settings); 
												
											?>		
										<?php endif; ?>
									</td>
								</tr>
								<tr>
									<th><?php _e('After Form', 'wp-mailinglist'); ?></th>
									<td>
										<?php if ($this -> language_do()) : ?>
											<?php if (!empty($languages) && is_array($languages)) : ?>
										    	<div id="styling_afterform-tabs">
										        	<ul>
														<?php $tabnumber = 1; ?>
										                <?php foreach ($languages as $language) : ?>
										                 	<li><a href="#styling_afterform-tabs<?php echo $tabnumber; ?>"><?php echo $this -> language_flag($language); ?></a></li>   
										                    <?php $tabnumber++; ?>
										                <?php endforeach; ?>
										            </ul>
										            
										            <?php $tabnumber = 1; ?>
										            <?php foreach ($languages as $language) : ?>
										            	<div id="styling_afterform-tabs<?php echo $tabnumber; ?>">
											            	<?php 
											
															$settings = array(
																'media_buttons'		=>	true,
																'textarea_name'		=>	'styling_afterform[' . $language . ']',
																'textarea_rows'		=>	5,
																'quicktags'			=>	true,
																'teeny'				=>	false,
															);
															
															wp_editor(wp_unslash($this -> language_use($language, $form -> styling_afterform)), 'styling_afterform_' . $language, $settings); 
															
															?>
										            	</div>
										            	<?php $tabnumber++; ?>
										            <?php endforeach; ?>
										    	</div>
										    <?php endif; ?>
										    
										    <script type="text/javascript">
										    jQuery(document).ready(function() {
											    if (jQuery.isFunction(jQuery.fn.tabs)) {
											    	jQuery('#styling_afterform-tabs').tabs();
											    }
										    });
										    </script>
										<?php else : ?>
											<?php
												
											$settings = array(
												'media_buttons'		=>	true,
												'textarea_name'		=>	'styling_afterform',
												'textarea_rows'		=>	5,
												'quicktags'			=>	true,
												'teeny'				=>	false,
											);
											
											wp_editor(wp_unslash($form -> styling_afterform), 'styling_afterform', $settings); 
												
											?>		
										<?php endif; ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					
					<div id="newsletters-forms-settings-styling-tabs-customcss">
						<h3><?php _e('Custom CSS', 'wp-mailinglist'); ?></h3>
						<table class="form-table">
							<tbody>
								<tr>
									<th><label for="styling_customcss"><?php _e('Custom CSS', 'wp-mailinglist'); ?></label></th>
									<td>
										<p><code>#newsletters-<?php echo $form -> id; ?>-form-wrapper {</code></p>
										<div id="customcss">
											<?php echo htmlspecialchars(wp_unslash($form -> styling_customcss)); ?>
										</div>
										<p><code>}</code></p>
										<textarea name="styling_customcss" id="styling_customcss" class="widefat" rows="10" cols="100%"><?php echo htmlspecialchars(wp_unslash($form -> styling_customcss)); ?></textarea>
										<span class="howto"><?php _e('Specify optional custom CSS to load for this form specifically.', 'wp-mailinglist'); ?></span>
									</td>
								</tr>
							</tbody>
						</table>	
					</div>
				</div>
			</div>
		</div>
		
		<input type="hidden" name="styling[1]" value="1" />
		
		<p class="submit">
			<button value="1" type="submit" name="save" class="button button-primary">
				<i class="fa fa-check fa-fw"></i> <?php _e('Save Settings', 'wp-mailinglist'); ?>
			</button>
		</p>
	</form>
</div>

<style type="text/css">
#customcss/*, #styling_beforeform_editor, #styling_afterform_editor*/ {
	position: relative;
	width: 100%;
	height: 200px;
}
</style>

<script type="text/javascript">
var warnMessage = "<?php echo addslashes(__('You have unsaved changes on this page! All unsaved changes will be lost and it cannot be undone.', 'wp-mailinglist')); ?>";
	
(function($) {	
	$(document).ready(function() {
		$("#newsletters-forms-settings-tabs" ).tabs({
			activate: function(event, ui) {                   
				var hash = ui.newTab.find('a').attr('href');
				if (history.pushState) {
					history.pushState(null, null, hash);
				} else {
		        	window.location.hash = hash;   
		        }
		    }
		});
		
		$('#newsletters-forms-settings-styling-tabs').tabs();
		
		// Sliders 
		if ($.isFunction($.fn.slider)) {
			$('.slider').each(function() {
				var input = $(this).data('input');
				var min = $(this).data('min');
				var max = $(this).data('max');
				var value = $(this).data('value');
				var meas = $(this).data('meas');
				
				$(this).slider({
					min: min,
					max: max,
					value: value,
					create: function(event, ui) {
						$('#' + input).val(value);
						$(this).after('<span class="slider-value">' + value + (typeof meas !== 'undefined' ? meas : '') + '</span>');	
					},
					slide: function(event, ui) {				
						$(this).next('.slider-value').html(ui.value + (typeof meas != 'undefined' ? meas : ''));
						$('#' + input).val(ui.value).trigger('change');
					}
				});
			});
		}
		
		$('#ajax').on('click', function(e) {
			if ($(this).is(":checked")) {
				$('#ajax_div').show();
			} else {
				$('#ajax_div').hide();
			}
		});
	
		var editor = ace.edit("customcss", {
			mode: 'ace/mode/css',
			minLines: 4,
			maxLines: Infinity
		});
		
		var textarea = $('#styling_customcss').hide();
		editor.getSession().setValue(textarea.val());
		
		editor.getSession().on('change', function(){
			textarea.val(editor.getSession().getValue());
		});
		
		$('input:not(:button,:submit),textarea,select').change(function() {  		  
	        window.onbeforeunload = function () {
	            if (warnMessage != null) return warnMessage;
	        }
	    });
	    
	    $(':submit').click(function(e) {	    	    
	        warnMessage = null;
	        return true;
	    });
	});
})(jQuery);
</script>