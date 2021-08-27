<?php

global $ID, $post_ID;
$ID = $this -> get_option('imagespost');
$post_ID = $this -> get_option('imagespost');

if ($this -> language_do()) {
	$languages = $this -> language_getlanguages();
}

?>

<table class="form-table">
	<tbody>
		<tr>
			<th><label for="etsubject_unsubscribeuser"><?php _e('Email Subject', 'wp-mailinglist'); ?></label></th>
			<td>
				<?php if ($this -> language_do()) : ?>				    
				    <?php if (!empty($languages) && is_array($languages)) : ?>
				    	<div id="languagetabsunsubscribeuser">
				        	<ul>
								<?php $tabnumber = 1; ?>
				                <?php foreach ($languages as $language) : ?>
				                 	<li><a href="#languagetabunsubscribeuser<?php echo $tabnumber; ?>"><?php echo $this -> language_flag($language); ?></a></li>   
				                    <?php $tabnumber++; ?>
				                <?php endforeach; ?>
				            </ul>
				            
				            <?php $tabnumber = 1; ?>
				            <?php $texts = $this -> get_option('etsubject_unsubscribeuser'); ?>
				            <?php foreach ($languages as $language) : ?>
				            	<div id="languagetabunsubscribeuser<?php echo $tabnumber; ?>">
				            		<input type="text" name="etsubject_unsubscribeuser[<?php echo $language; ?>]" value="<?php echo esc_attr(wp_unslash($this -> language_use($language, $texts))); ?>" id="etsubject_unsubscribeuser_<?php echo $language; ?>" class="widefat" />
				            	</div>
				            	<?php $tabnumber++; ?>
				            <?php endforeach; ?>
				    	</div>
				    <?php endif; ?>
				    
				    <script type="text/javascript">
				    jQuery(document).ready(function() {
					    if (jQuery.isFunction(jQuery.fn.tabs)) {
					    	jQuery('#languagetabsunsubscribeuser').tabs();
					    }
				    });
				    </script>
				<?php else : ?>
					<input type="text" name="etsubject_unsubscribeuser" value="<?php echo esc_attr(wp_unslash($this -> get_option('etsubject_unsubscribeuser'))); ?>" id="etsubject_unsubscribeuser" class="widefat" />
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<th><label for="etmessage_unsubscribeuser"><?php _e('Email Message', 'wp-mailinglist'); ?></label></th>
			<td>
				<?php if ($this -> language_do()) : ?>
					<?php if (!empty($languages) && is_array($languages)) : ?>
				    	<div id="languagetabsunsubscribeusermessage">
				        	<ul>
								<?php $tabnumber = 1; ?>
				                <?php foreach ($languages as $language) : ?>
				                 	<li><a href="#languagetabunsubscribeusermessage<?php echo $tabnumber; ?>"><?php echo $this -> language_flag($language); ?></a></li>   
				                    <?php $tabnumber++; ?>
				                <?php endforeach; ?>
				            </ul>
				            
				            <?php $tabnumber = 1; ?>
				            <?php $texts = $this -> get_option('etmessage_unsubscribeuser'); ?>
				            <?php foreach ($languages as $language) : ?>
				            	<div id="languagetabunsubscribeusermessage<?php echo $tabnumber; ?>">
					            	<?php 
					
									$settings = array(
										'media_buttons'		=>	true,
										'textarea_name'		=>	'etmessage_unsubscribeuser[' . $language . ']',
										'textarea_rows'		=>	10,
										'quicktags'			=>	true,
										'teeny'				=>	false,
									);
									
									wp_editor(wp_unslash($this -> language_use($language, $texts)), 'etmessage_unsubscribeuser_' . $language, $settings); 
									
									?>
				            	</div>
				            	<?php $tabnumber++; ?>
				            <?php endforeach; ?>
				    	</div>
				    <?php endif; ?>
				    
				    <script type="text/javascript">
				    jQuery(document).ready(function() {
					    if (jQuery.isFunction(jQuery.fn.tabs)) {
					    	jQuery('#languagetabsunsubscribeusermessage').tabs();
					    }
				    });
				    </script>
				<?php else : ?>
					<?php
					
					$settings = array(
						'media_buttons'		=>	true,
						'textarea_name'		=>	'etmessage_unsubscribeuser',
						'textarea_rows'		=>	10,
						'quicktags'			=>	true,
						'teeny'				=>	false,
					);	
						
					?>
					<?php wp_editor(wp_unslash($this -> get_option('etmessage_unsubscribeuser')), 'etmessage_unsubscribeuser', $settings); ?>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<th><label for="ettemplate_unsubscribeuser"><?php _e('Email Template', 'wp-mailinglist'); ?></label></th>
			<td>
				<?php $ettemplate_unsubscribeuser = __($this -> get_option('ettemplate_unsubscribeuser')); ?>
				<?php if ($themes = $Theme -> select()) : ?>
					<select name="ettemplate_unsubscribeuser" id="ettemplate_unsubscribeuser">
						<option value=""><?php _e('- Default -', 'wp-mailinglist'); ?></option>
						<?php foreach ($themes as $theme_id => $theme_title) : ?>
							<option <?php echo (!empty($ettemplate_unsubscribeuser) && $ettemplate_unsubscribeuser == $theme_id) ? 'selected="selected"' : ''; ?> value="<?php echo $theme_id; ?>"><?php _e($theme_title); ?></option>
						<?php endforeach; ?>
					</select>
				<?php else : ?>
					<p class="newsletters_error"><?php _e('No templates are available', 'wp-mailinglist'); ?></p>
				<?php endif; ?>
			</td>
		</tr>
	</tbody>
</table>