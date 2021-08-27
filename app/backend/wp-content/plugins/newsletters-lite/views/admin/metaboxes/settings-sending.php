<!-- Sending Settings -->

<?php

$createpreview = $this -> get_option('createpreview');
$createspamscore = $this -> get_option('createspamscore');
$themeintextversion = $this -> get_option('themeintextversion');
$inlinestyles = $this -> get_option('inlinestyles');
$videoembed = $this -> get_option('videoembed');
$defaulttemplate = $this -> get_option('defaulttemplate');
$remove_width_height_attr = $this -> get_option('remove_width_height_attr');

$domdocexists = true;
if (!class_exists('DOMDocument')) {
	$domdocexists = false;
}

?>

<table class="form-table">
	<tbody>
		<tr class="advanced-setting">
			<th><label for="sendingprogress_Y"><?php _e('Ajax Sending/Queuing Progress', 'wp-mailinglist'); ?></label>
			<?php echo $Html -> help(__('By turning On the Ajax sending/queuing progress, a newsletter will be visually sent or queued with a progress bar. Immediate newsletters will be sent immediately and newsletters with a future date will be queued. If you turn this Off, emails will go into the queue without a progress bar which could be quicker.', 'wp-mailinglist')); ?></th>
			<td>
				<label><input <?php echo ($this -> get_option('sendingprogress') == "Y") ? 'checked="checked"' : ''; ?> type="radio" name="sendingprogress" id="sendingprogress_Y" value="Y" /> <?php _e('On', 'wp-mailinglist'); ?></label>
				<label><input <?php echo ($this -> get_option('sendingprogress') == "N") ? 'checked="checked"' : ''; ?> type="radio" name="sendingprogress" id="sendingprogress_N" value="N" /> <?php _e('Off', 'wp-mailinglist'); ?></label>
				<span class="howto"><?php _e('For large lists, you might want to turn this off so you do not have to sit and wait.', 'wp-mailinglist'); ?></span>
			</td>
		</tr>
		<tr class="advanced-setting">
			<th><label for="createpreview_Y"><?php _e('Preview', 'wp-mailinglist'); ?></label>
			<?php echo $Html -> help(sprintf(__('When you create or edit a newsletter under %s > Create Newsletter, there is a "Preview" box which periodically updates and shows what the newsletter will look like. You can turn this feature On or Off here according to your needs.', 'wp-mailinglist'), $this -> name)); ?></th>
			<td>
				<label><input <?php echo (!empty($createpreview) && $createpreview == "Y") ? 'checked="checked"' : ''; ?> type="radio" name="createpreview" value="Y" id="createpreview_Y" /> <?php _e('On', 'wp-mailinglist'); ?></label>
				<label><input <?php echo (!empty($createpreview) && $createpreview == "N") ? 'checked="checked"' : ''; ?> type="radio" name="createpreview" value="N" id="createpreview_N" /> <?php _e('Off', 'wp-mailinglist'); ?></label>
				<span class="howto"><?php _e('Turn on/off the preview feature while creating a newsletter.', 'wp-mailinglist'); ?></span>
			</td>
		</tr>
		<tr class="advanced-setting">
			<th><label for="createspamscore_Y"><?php _e('Spam Score', 'wp-mailinglist'); ?></label></th>
			<td>
				<label><input <?php echo (!empty($createspamscore) && $createspamscore == "Y") ? 'checked="checked"' : ''; ?> type="radio" name="createspamscore" value="Y" id="createspamscore_Y" /> <?php _e('On', 'wp-mailinglist'); ?></label>
				<label><input <?php echo (!empty($createspamscore) && $createspamscore == "N") ? 'checked="checked"' : ''; ?> type="radio" name="createspamscore" value="N" id="createspamscore_N" /> <?php _e('Off', 'wp-mailinglist'); ?></label>
				<span class="howto"><?php _e('Turn on/off the spam score utility while creating a newsletter', 'wp-mailinglist'); ?></span>
			</td>
		</tr>
    	<tr class="advanced-setting">
        	<th><label for="imagespost"><?php _e('Newsletter Images Post ID', 'wp-mailinglist'); ?></label>
        	<?php echo $Html -> help(__('The ID of the WordPress post or page to which images uploaded through the media uploader is stored. All images are stored to this post or page so that they can be reused later on.', 'wp-mailinglist')); ?></th>
            <td>
            	<?php $imagespost = $this -> get_option('imagespost'); ?>
                <input type="text" autocomplete="off" class="widefat" style="width:50px;" name="imagespost" value="<?php echo esc_attr(wp_unslash($imagespost)); ?>" id="imagespost" />
            	<span class="howto"><?php _e('A WordPress post (draft or published) is required for the Newsletter plugin to save images to when uploading through the editor.', 'wp-mailinglist'); ?></span>
            </td>
        </tr>
        <tr class="advanced-setting">
        	<th><label for="emailencoding"><?php _e('Email Encoding', 'wp-mailinglist'); ?></label>
        	<?php echo $Html -> help(__('The character encoding of the outgoing emails. The default and recommended is 8bit but if you experience problems with irregular line wrapping or garbled characters, you can change this to base64 or a different value.', 'wp-mailinglist')); ?></th>
        	<td>
        		<?php $encodings = array('8bit', '7bit', 'binary', 'base64', 'quoted-printable'); ?>
        		<select name="emailencoding" id="emailencoding">
        			<?php foreach ($encodings as $encoding) : ?>
        				<option <?php echo ($this -> get_option('emailencoding') == $encoding) ? 'selected="selected"' : ''; ?> value="<?php echo $encoding; ?>"><?php echo $encoding; ?></option>
        			<?php endforeach; ?>
        		</select>
        		<span class="howto"><?php _e('Choose the encoding of outgoing emails. Recommended is 8bit but if there are character problems, change to base64.', 'wp-mailinglist'); ?></span>
        	</td>
        </tr>
        <tr>
	        <th><label for="defaulttemplate"><?php _e('Styled Default Template', 'wp-mailinglist'); ?></label></th>
	        <td>
		        <label><input <?php echo (!empty($defaulttemplate)) ? 'checked="checked"' : ''; ?> type="checkbox" name="defaulttemplate" value="1" id="defaulttemplate" /> <?php _e('Use a styled, default template for newsletters and system emails', 'wp-mailinglist'); ?></label>
	        </td>
        </tr>
        <tr class="advanced-setting">
	        <th><label for="inlinestyles"><?php _e('Auto Inline Styles', 'wp-mailinglist'); ?></label></th>
	        <td>
		        <label><input <?php echo (!empty($inlinestyles) && !empty($domdocexists)) ? 'checked="checked"' : ''; ?> <?php echo (empty($domdocexists)) ? 'disabled="disabled"' : ''; ?> type="checkbox" name="inlinestyles" value="1" id="inlinestyles" /> <?php _e('Yes, convert CSS to inline styles automatically', 'wp-mailinglist'); ?></label>
		        <span class="howto"><?php _e('Turning this on will take your STYLE tags CSS and automatically apply it as inline styles upon sending', 'wp-mailinglist'); ?></span>
		        
		        <?php if (empty($domdocexists)) : ?>
		        	<span class="newsletters_error"><?php _e('PHP DOMDocument class is not available. Please install and enable PHP DOM extension.', 'wp-mailinglist'); ?></span>
		        <?php endif; ?>
	        </td>
        </tr>
        <tr class="advanced-setting">
	        <th><label for="remove_width_height_attr"><?php _e('Remove Width/Height Attributes', 'wp-mailinglist'); ?></label>
	        <?php echo $Html -> help(__('By turning this on, ensure that you do not resize images inside the editor but that you rather insert images at the correct image size eg. thumbnail, medium, large, full, etc.', 'wp-mailinglist')); ?></th>
	        <td>
		        <label><input type="checkbox" name="remove_width_height_attr" value="1" id="remove_width_height_attr" <?php echo (!empty($remove_width_height_attr)) ? 'checked="checked"' : ''; ?> /> <?php _e('Yes, strip them out, I do not resize images in the editor.', 'wp-mailinglist'); ?></label>
		        <span class="howto"><?php _e('Removes width/height attributes from images which break responsive newsletters.', 'wp-mailinglist'); ?></span>
	        </td>
        </tr>
        <tr>
	        <th><label for="videoembed"><?php _e('Video Embed', 'wp-mailinglist'); ?></label>
	        <?php echo $Html -> help(__('Paste the URL of any video of a popular video service eg. YouTube, Vimeo etc. into a newsletter. The URL will be automatically replaced with a video image and play icon. When a user clicks the image, they are taken to the original video URL.', 'wp-mailinglist')); ?></th>
	        <td>
		        <label><input <?php echo (!empty($videoembed)) ? 'checked="checked"' : ''; ?> type="checkbox" name="videoembed" value="1" id="videoembed" /> <?php _e('Yes, make videos email compatible.', 'wp-mailinglist'); ?></label>
		        <span class="howto"><?php _e('Turn this on to automatically replace video URLs with a video image and play icon, compatible with email.', 'wp-mailinglist'); ?></span>
	        </td>
        </tr>
    	<tr class="advanced-setting">
        	<th><label for="multimime_Y"><?php _e('Send Multipart Emails', 'wp-mailinglist'); ?></label></th>
            <td>
            	<label><input <?php echo ($this -> get_option('multimime') == "Y") ? 'checked="checked"' : ''; ?> type="radio" name="multimime" value="Y" id="multimime_Y" /> <?php _e('Yes', 'wp-mailinglist'); ?></label>
                <label><input <?php echo ($this -> get_option('multimime') == "N") ? 'checked="checked"' : ''; ?> type="radio" name="multimime" value="N" id="multimime_N" /> <?php _e('No', 'wp-mailinglist'); ?></label>
            	<span class="howto"><?php _e('Send emails in both plain text and HTML mime types to let the client software decide which to use.', 'wp-mailinglist'); ?></span>
            </td>
        </tr>
        <tr class="advanced-setting">
        	<th><label for="themeintextversion"><?php _e('Template In TEXT Version', 'wp-mailinglist'); ?></label></th>
        	<td>
        		<label><input <?php echo (!empty($themeintextversion)) ? 'checked="checked"' : ''; ?> type="checkbox" name="themeintextversion" value="1" id="themeintextversion" /> <?php _e('Yes, include the template content into TEXT version emails', 'wp-mailinglist'); ?></label>
        	</td>
        </tr>
        <tr>
            <th><label for="mailpriority"><?php _e('Email Priority', 'wp-mailinglist'); ?></label></th>
            <td>
                <?php $priorities = array(1 => __('High', 'wp-mailinglist'), 3 => __('Normal', 'wp-mailinglist'), 5 => __('Low', 'wp-mailinglist')); ?>
                <select name="mailpriority" id="mailpriority">
                    <option value="3"><?php _e('- Select -', 'wp-mailinglist'); ?></option>
                    <?php foreach ($priorities as $pr_key => $pr_val) : ?>
                        <option <?php echo ($this -> get_option('mailpriority') == $pr_key) ? 'selected="selected"' : ''; ?> value="<?php echo $pr_key; ?>"><?php echo $pr_val; ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="howto"><?php _e('Set the email priority which will be displayed to recipients. High, Normal, Low', 'wp-mailinglist'); ?></span>
            </td>
        </tr>
        <tr>
        	<th><label for="shortlinks_Y"><?php _e('Bit.ly Shortlinks', 'wp-mailinglist'); ?></label></th>
            <td>
            	<label><input <?php echo ($this -> get_option('shortlinks') == "Y") ? 'checked="checked"' : ''; ?> onclick="jQuery('#shortlinksdiv').show();" type="radio" name="shortlinks" value="Y" id="shortlinks_Y" /> <?php _e('Yes', 'wp-mailinglist'); ?></label>
                <label><input <?php echo ($this -> get_option('shortlinks') == "N") ? 'checked="checked"' : ''; ?> onclick="jQuery('#shortlinksdiv').hide();" type="radio" name="shortlinks" value="N" id="shortlinks_N" /> <?php _e('No', 'wp-mailinglist'); ?></label>
				<span class="howto"><?php _e('Turn On to replace all links with Bit.ly shortlinks for tracking purposes.', 'wp-mailinglist'); ?></span>
            </td>
        </tr>
    </tbody>
</table>

<?php $div_display = ($this -> get_option('shortlinks') == "Y") ? 'block' : 'none'; ?>
<div class="newsletters_indented" id="shortlinksdiv" style="display:<?php echo $div_display; ?>;">
	<p><?php _e('You need a <a href="https://bit.ly" target="_blank">Bit.ly</a> account in order to use this feature. Get your username/login and API key <a href="https://bit.ly/a/your_api_key" target="_blank">here</a>.', 'wp-mailinglist'); ?></p>

	<table class="form-table">
		<tbody>
			<tr>
				<th><label for="<?php echo $this -> pre; ?>shorlinkLogin"><?php _e('Login', 'wp-mailinglist'); ?></label></th>
				<td>
                	<input class="widefat" type="text" id="<?php echo $this -> pre; ?>shortlinkLogin" name="shortlinkLogin" value="<?php echo esc_attr(wp_unslash($this -> get_option('shortlinkLogin'))); ?>" />
                    <span class="howto"><?php _e('your registered Bit.ly username/login', 'wp-mailinglist'); ?></span>
                </td>
			</tr>
			<tr>
				<th><label for="<?php echo $this -> pre; ?>shorlinkAPI"><?php _e('API Key', 'wp-mailinglist'); ?></label></th>
				<td>
                	<input class="widefat" type="text" id="<?php echo $this -> pre; ?>shortlinkAPI" name="shortlinkAPI" value="<?php echo esc_attr(wp_unslash($this -> get_option('shortlinkAPI'))); ?>" />
                    <span class="howto"><?php _e('you can obtain your Bit.ly API key from your account settings', 'wp-mailinglist'); ?></span>
                </td>
			</tr>
		</tbody>
	</table>
</div>

<?php

$embedimagesdisabled = (!$this -> is_plugin_active('embedimages')) ? true : false;
$embedimages = $this -> get_option('embedimages');
$embedimagesdir = $this -> get_option('embedimagesdir');

?>
<table class="form-table">
	<tbody>
		<tr>
			<th><label for="embedimages_N"><?php _e('Embedded Images', 'wp-mailinglist'); ?></label></th>
			<td>
				<label><input onclick="jQuery('#embedimagesdiv').show();" <?php if ($embedimagesdisabled == true) : ?>disabled="disabled"<?php endif; ?> <?php echo ($embedimagesdisabled == false && $embedimages == "Y") ? 'checked="checked"' : ''; ?> type="radio" name="embedimages" value="Y" id="embedimages_Y" /> <?php _e('Yes', 'wp-mailinglist'); ?></label>
				<label><input onclick="jQuery('#embedimagesdiv').hide();" <?php if ($embedimagesdisabled == true) : ?>disabled="disabled"<?php endif; ?> <?php echo ($embedimagesdisabled == true || $embedimages == "N") ? 'checked="checked"' : ''; ?> type="radio" name="embedimages" value="N" id="embedimages_N" /> <?php _e('No', 'wp-mailinglist'); ?></label>
				<?php if ($embedimagesdisabled == true) : ?>
					<span class="newsletters_error howto"><?php _e('You do not have the Embedded Images extension installed or it is not active.', 'wp-mailinglist'); ?></span>
				<?php endif; ?>
				<span class="howto"><?php _e('Embed/attach images into emails instead of loading them remotely from their absolute URL.', 'wp-mailinglist'); ?></span>
			</td>
		</tr>
	</tbody>
</table>

<div class="newsletters_indented" id="embedimagesdiv" style="display:<?php echo ($this -> get_option('embedimages') == "Y") ? 'block' : 'none'; ?>;">
	<table class="form-table">
		<tbody>
			<tr>
				<th><label for="embedimagesdir"><?php _e('Images Location', 'wp-mailinglist'); ?></label></th>
				<td>
					<input type="text" name="embedimagesdir" value="<?php echo esc_attr(wp_unslash($this -> get_option('embedimagesdir'))); ?>" id="embedimagesdir" class="widefat" />
					<span class="howto">
						<?php _e('Location (absolute path) of the images on your server.', 'wp-mailinglist'); ?><br/>
						<?php _e('If you are unsure, deactivate and reactivate the Embedded Images extension plugin for auto detection.', 'wp-mailinglist'); ?>
					</span>
				</td>
			</tr>
		</tbody>
	</table>
</div>