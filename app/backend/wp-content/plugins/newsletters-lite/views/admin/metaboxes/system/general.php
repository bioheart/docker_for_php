<!-- General System Settings -->

<?php
	
$csvdelimiter = $this -> get_option('csvdelimiter');	
	
?>

<table class="form-table">
	<tbody>
		<tr>
			<th><label for="csvdelimiter"><?php _e('Global CSV Delimiter', 'wp-mailinglist'); ?></label></th>
			<td>
				<input style="width:45px;" type="text" name="csvdelimiter" value="<?php echo esc_attr(wp_unslash($csvdelimiter)); ?>" id="csvdelimiter" />
				<span class="howto"><?php _e('The global CSV delimiter to use for exports and imports. The default is comma (,)', 'wp-mailinglist'); ?></span>
			</td>
		</tr>
	</tbody>
</table>