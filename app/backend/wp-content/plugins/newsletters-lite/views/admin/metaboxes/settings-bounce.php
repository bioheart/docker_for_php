<!-- Bounce Configuration Settings -->

<?php 
	
$deleteonbounce = $this -> get_option('deleteonbounce'); 
$bouncemethod = $this -> get_option('bouncemethod');
$bouncepop_type = $this -> get_option('bouncepop_type');
$bouncepop_prot = $this -> get_option('bouncepop_prot');

?>

<table class="form-table">
	<tbody>
		<tr>
			<th><label for="deleteonbounce_Y"><?php echo __('Subscriber Delete on Bounce', 'wp-mailinglist'); ?></label>
			<?php echo $Html -> help(__('When an email has bounced to a subscriber the number of times specified in the "Bounce Count" setting below, the subscriber will be permanently deleted from the database.', 'wp-mailinglist')); ?></th>
			<td>
				<label><input onclick="jQuery('#deleteonbounce_div').show();" <?php echo ($deleteonbounce == "Y") ? 'checked="checked"' : ''; ?> type="radio" name="deleteonbounce" value="Y" id="deleteonbounce_Y" /> <?php echo __('Yes', 'wp-mailinglist'); ?></label>
				<label><input onclick="jQuery('#deleteonbounce_div').hide();" <?php echo ($deleteonbounce == "N") ? 'checked="checked"' : ''; ?> type="radio" name="deleteonbounce" value="N" id="deleteonbounce_N" /> <?php echo __('No', 'wp-mailinglist'); ?></label>
				<span class="howto"><?php _e('Should a subscriber be deleted when an email to a subscriber bounces?', 'wp-mailinglist'); ?></span>
			</td>
		</tr>
    </tbody>
</table>

<div class="newsletters_indented" id="deleteonbounce_div" style="display:<?php echo ($this -> get_option('deleteonbounce') == "Y") ? 'block' : 'none'; ?>;">
    <table class="form-table">
        <tbody>
            <tr>
                <th><label for="bouncecount"><?php _e('Bounce Count', 'wp-mailinglist'); ?></label>
                <?php echo $Html -> help(__('The number of emails to bounce to a subscriber before it is deleted. Use a number 1 (immediate delete) or higher.', 'wp-mailinglist')); ?></th>
                <td>
                    <input type="text" class="widefat" style="width:45px;" name="bouncecount" value="<?php echo esc_attr(wp_unslash($this -> get_option('bouncecount'))); ?>" id="bouncecount" />
                    <span class="howto"><?php _e('How many times should an email bounce to a subscriber before deletion?', 'wp-mailinglist'); ?></span>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<table class="form-table">
    <tbody>
		<?php $adminemailonbounce = $this -> get_option('adminemailonbounce'); ?>
		<tr>
			<th><?php echo __('Admin Notify on Bounce', 'wp-mailinglist'); ?></th>
			<td>
				<label><input <?php echo ($adminemailonbounce == "Y") ? 'checked="checked"' : ''; ?> type="radio" name="adminemailonbounce" value="Y" /> <?php echo __('Yes', 'wp-mailinglist'); ?></label>
				<label><input <?php echo ($adminemailonbounce == "N") ? 'checked="checked"' : ''; ?> type="radio" name="adminemailonbounce" value="N" /> <?php echo __('No', 'wp-mailinglist'); ?></label>
				<span class="howto"><?php _e('Should the admin be notified when an email to a subscriber has bounced?', 'wp-mailinglist'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="bounceemail"><?php echo __('Bounce Receival Email', 'wp-mailinglist'); ?></label></th>
			<td>
				<input class="widefat" type="text" size="25" id="bounceemail" name="bounceemail" value="<?php echo esc_attr(wp_unslash($this -> get_option('bounceemail'))); ?>" />
				<span class="howto"><?php _e('Email address to receive bounce notifications on. The Return-Path header on all emails is set to this value.', 'wp-mailinglist'); ?></span>
			</td>
		</tr>
        <tr>
            <th><label for="bouncemethod_pop"><?php _e('Bounce Handling Method', 'wp-mailinglist'); ?></label></th>
            <td>
	            <label><input class="newsletters_bouncemethod_radio" <?php echo ($bouncemethod == "off") ? 'checked="checked"' : ''; ?> type="radio" name="bouncemethod" value="off" id="bouncemethod_off" /><i class="fa fa-times"></i> <?php _e('Off or API webhook', 'wp-mailinglist'); ?></label><br/>
                <label><input class="newsletters_bouncemethod_radio" <?php echo ($bouncemethod == "cgi") ? 'checked="checked"' : ''; ?> type="radio" name="bouncemethod" value="cgi" id="bouncemethod_cgi" /><i class="fa fa-server"></i> <?php _e('Email Piping (CGI)', 'wp-mailinglist'); ?></label><br/>
                <label><input class="newsletters_bouncemethod_radio" <?php echo ($bouncemethod == "pop") ? 'checked="checked"' : ''; ?> type="radio" name="bouncemethod" value="pop" id="bouncemethod_pop" /><i class="fa fa-inbox"></i> <?php _e('POP/IMAP Email Fetch', 'wp-mailinglist'); ?></label><br/>
                <span class="howto"><?php _e('Method to use to record bounced emails to subscribers.', 'wp-mailinglist'); ?></span>
                
                <script type="text/javascript">
	            jQuery('.newsletters_bouncemethod_radio').on('click', function(e) {
		            change_bouncemethod(jQuery(this).val());
	            });
	                
	            function change_bouncemethod(method) {
		            jQuery('div[id^="bouncemethod_"]').hide();
		            jQuery('#bouncemethod_' + method + '_div').show();
	            }
	            </script>
            </td>
        </tr>
	</tbody>
</table>

<div class="newsletters_indented" id="bouncemethod_cgi_div" style="display:<?php echo ($bouncemethod == "cgi") ? 'block' : 'none'; ?>;">
	<table class="form-table">
		<tbody>
			<tr>
				<th><label for="<?php echo $this -> pre; ?>servertype"><?php _e('Server Type', 'wp-mailinglist'); ?></label></th>
				<td>
					<?php $servertypes = array('cpanel' => 'cPanel (or other)', 'plesk' => 'Plesk'); ?>
					<select class="widefat" style="width:auto;" id="<?php echo $this -> pre; ?>servertype" name="servertype">
						<?php foreach ($servertypes as $skey => $sval) : ?>
							<option <?php echo ($this -> get_option('servertype') == $skey) ? 'selected="selected"' : ''; ?> value="<?php echo esc_attr(wp_unslash($skey)); ?>"><?php echo $sval; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<div class="newsletters_indented" id="bouncemethod_pop_div" style="display:<?php echo ($bouncemethod == "pop") ? 'block' : 'none'; ?>;">
	
	<p class="howto">
		<?php _e('All the POP/IMAP settings are provided inside your hosting panel or by your hosting provider. Make sure the host, type, port, protocol, etc. are correct.', 'wp-mailinglist'); ?>
	</p>
	
	<?php if (!function_exists('imap_check') || !extension_loaded('imap')) : ?>
		<p class="newsletters_error"><?php _e('It looks like PHP IMAP is not installed/active, ask your hosting provider to install it for you.', 'wp-mailinglist'); ?></p>
	<?php else : ?>
		<p class="newsletters_success"><?php _e('PHP IMAP detected as installed and active, you can continue.', 'wp-mailinglist'); ?></p>
	<?php endif; ?>
	
    <table class="form-table">
        <tbody>
            <tr>
                <th><label for="bouncepop_interval"><?php _e('Check Interval', 'wp-mailinglist'); ?></label></th>
                <td>
                    <?php $popintervals = wp_get_schedules(); ?>
                    <select class="widefat" style="width:auto;" name="bouncepop_interval" id="bouncepop_interval">
                        <option value="0"><?php _e('- Select -', 'wp-mailinglist'); ?></option>
                        <?php foreach ($popintervals as $key => $val) : ?>
                            <option <?php echo ($this -> get_option('bouncepop_interval') == $key) ? 'selected="selected"' : ''; ?> value="<?php echo esc_attr(wp_unslash($key)); ?>"><?php echo $val['display']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="howto"><?php _e('How often should the mailbox be checked for bounced emails.', 'wp-mailinglist'); ?></span>
                </td>
            </tr>
            <tr>
	            <th><label for="bouncepop_type"><?php _e('Mail Type', 'wp-mailinglist'); ?></label></th>
	            <td>
		            <label><input <?php echo (empty($bouncepop_type) || $bouncepop_type == "imap") ? 'checked="checked"' : ''; ?> type="radio" name="bouncepop_type" value="imap" id="bouncepop_type_imap" /> <?php _e('IMAP', 'wp-mailinglist'); ?></label>
		            <label><input <?php echo (!empty($bouncepop_type) && $bouncepop_type == "pop3") ? 'checked="checked"' : ''; ?> type="radio" name="bouncepop_type" value="pop3" id="bouncepop_type_pop3" /> <?php _e('POP3', 'wp-mailinglist'); ?></label>
		            <span class="howto"><?php _e('Choose the driver/type that your mailbox supports. IMAP is recommended.', 'wp-mailinglist'); ?></span>
	            </td>
            </tr>
            <tr>
                <th><label for="bouncepop_host"><?php _e('Host', 'wp-mailinglist'); ?></label></th>
                <td>
                    <input class="widefat" type="text" name="bouncepop_host" value="<?php echo esc_attr(wp_unslash($this -> get_option('bouncepop_host'))); ?>" id="bouncepop_host" />
                    <span class="howto"><?php _e('The incoming email server hostname', 'wp-mailinglist'); ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="bouncepop_user"><?php _e('User/Email', 'wp-mailinglist'); ?></label></th>
                <td>
                    <input class="widefat" autocomplete="off" type="text" name="bouncepop_user" value="<?php echo esc_attr(wp_unslash($this -> get_option('bouncepop_user'))); ?>" id="bouncepop_user" />
                    <span class="howto"><?php _e('Email username', 'wp-mailinglist'); ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="bouncepop_pass"><?php _e('Password', 'wp-mailinglist'); ?></label></th>
                <td>
                    <input class="widefat" autocomplete="off" type="password" name="bouncepop_pass" value="<?php echo esc_attr(wp_unslash($this -> get_option('bouncepop_pass'))); ?>" id="bouncepop_pass" />
                    <span class="howto"><?php _e('Email password', 'wp-mailinglist'); ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="bouncepop_port"><?php _e('Port', 'wp-mailinglist'); ?></label></th>
                <td>
                    <input class="widefat" style="width:65px;" type="text" name="bouncepop_port" value="<?php echo esc_attr(wp_unslash($this -> get_option('bouncepop_port'))); ?>" id="bouncepop_port" />
                    <span class="howto"><?php _e('Port number to connect to', 'wp-mailinglist'); ?></span>
                </td>
            </tr>
            <tr>
	            <th><label for="bouncepop_prot"><?php _e('Protocol', 'wp-mailinglist'); ?></label></th>
	            <td>
		            <label><input <?php echo (empty($bouncepop_prot) || $bouncepop_prot == "normal") ? 'checked="checked"' : ''; ?> type="radio" name="bouncepop_prot" value="normal" id="bouncepop_prot_normal" /> <?php _e('Regular (Insecure)', 'wp-mailinglist'); ?></label>
		            <label><input <?php echo (!empty($bouncepop_prot) && $bouncepop_prot == "ssl") ? 'checked="checked"' : ''; ?> type="radio" name="bouncepop_prot" value="ssl" id="bouncepop_prot_ssl" /> <?php _e('SSL (Secure)', 'wp-mailinglist'); ?></label>
		            <span class="howto"><?php _e('Specify the protocol to connect over.', 'wp-mailinglist'); ?></span>
	            </td>
            </tr>
            <tr>
            	<th></th>
            	<td>
            		<a id="testbouncesettings" class="button-primary" onclick="testbouncesettings(); return false;" href="?page=<?php echo $this -> sections -> settings; ?>"><?php _e('Test POP/IMAP Settings', 'wp-mailinglist'); ?> <i class="fa fa-arrow-right"></i></a>
            		<span id="testbouncesettingsloading" style="display:none;"><i class="fa fa-refresh fa-spin fa-fw"></i></span>
            	</td>
            </tr>
        </tbody>
    </table>
</div>

<script type="text/javascript">
function testbouncesettings() {
	var pop_type = jQuery('input[name="bouncepop_type"]:checked').val();
	var pop_host = jQuery('#bouncepop_host').val();
	var pop_user = jQuery('#bouncepop_user').val();
	var pop_pass = jQuery('#bouncepop_pass').val();
	var pop_port = jQuery('#bouncepop_port').val();
	var pop_prot = jQuery('input[name="bouncepop_prot"]:checked').val();
	var formvalues = {type:pop_type, host:pop_host, user:pop_user, pass:pop_pass, port:pop_port, prot:pop_prot};
	jQuery('#testbouncesettingsloading').show();
	jQuery('#testbouncesettings').attr('disabled', "disabled");
	
	jQuery.post(newsletters_ajaxurl + 'action=<?php echo $this -> pre; ?>testbouncesettings&security=<?php echo wp_create_nonce('testbouncesettings'); ?>', formvalues, function(response) {
		jQuery.colorbox({html:response});
		jQuery('#testbouncesettingsloading').hide();
		jQuery('#testbouncesettings').removeAttr('disabled');
	});
}
</script>