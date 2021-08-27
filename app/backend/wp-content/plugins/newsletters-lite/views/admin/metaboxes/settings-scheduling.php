<!-- Email Scheduling Settings -->

<?php

$schedules = wp_get_schedules();	
$scheduleinterval = $this -> get_option('scheduleinterval');
$emailsperinterval = $this -> get_option('emailsperinterval');
$notifyqueuecomplete = $this -> get_option('notifyqueuecomplete');
	
?>

<?php if (apply_filters('newsletters_whitelabel', true)) : ?>
	<p class="howto">
		<?php echo sprintf(__('Sending emails from the queue uses the WordPress cron job. If your queue is not moving, check if the WordPress cron is working and if %s is not set in your %s file. Also consider %s.', 'wp-mailinglist'), '<code>DISABLE_WP_CRON</code>', '<code>wp-config.php</code>', '<a href="https://tribulant.com/blog/wordpress/replace-wordpress-cron-with-real-cron-for-site-speed/" target="_blank">' . __('replacing the WordPress cron job with a real, server cron job', 'wp-mailinglist') . '</a>'); ?>
	</p>
<?php endif; ?>

<input type="hidden" name="croninterval" value="5minutes" />

<table class="form-table">
	<tbody>
		<tr>
			<th><label for="scheduleinterval"><?php _e('Schedule Interval', 'wp-mailinglist'); ?></label></th>
			<td>
				<select onchange="totalemails_calculate();" class="widefat" style="width:auto;" id="scheduleinterval" name="scheduleinterval">
                    <option data-interval="0" value=""><?php _e('- Select Interval -', 'wp-mailinglist'); ?></option>
                    <?php if (!empty($schedules)) : ?>
                        <?php foreach ($schedules as $key => $val) : ?>
                        <?php $sel = ($scheduleinterval == $key) ? 'selected="selected"' : ''; ?>
                        <option data-interval="<?php echo esc_attr(wp_unslash($val['interval'])); ?>" <?php echo $sel; ?> value="<?php echo $key ?>"><?php echo $val['display']; ?> (<?php echo $val['interval'] ?> <?php _e('seconds', 'wp-mailinglist'); ?>)</option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <span class="howto"><?php _e('How often the queue runs to send emails out. Keep as low as possible, eg. Every 2 Minutes', 'wp-mailinglist'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="emailsperinterval"><?php _e('Emails Per Interval', 'wp-mailinglist'); ?></label></th>
			<td>
				<input onkeyup="totalemails_calculate();" class="widefat" style="width:45px;" type="text" value="<?php echo esc_attr(wp_unslash($emailsperinterval)); ?>" id="emailsperinterval" name="emailsperinterval" />
				<span class="howto"><?php _e('The number of emails to send per schedule interval above, eg. 50.', 'wp-mailinglist'); ?>
			</td>
		</tr>
		<tr>
            <th><label for=""><?php _e('Total Emails', 'wp-mailinglist'); ?></label></th>
            <td>
	            <p id="totalemails">
		            <!-- total emails will display here -->
	            </p>
	            
	            <script type="text/javascript">
		        var totalemails_calculate = function() {
			        var emailsperinterval = jQuery('#emailsperinterval').val();
			        var scheduleinterval = jQuery('#scheduleinterval').find(':selected').data('interval');
			        
			        var totalemails_hourly = ((3600 / scheduleinterval) * emailsperinterval);
			        var totalemails_daily = (totalemails_hourly * 24);
			        
			        jQuery('#totalemails').html(totalemails_hourly + ' <?php _e('emails per hour', 'wp-mailinglist'); ?>, ' + totalemails_daily + ' <?php _e('emails per day', 'wp-mailinglist'); ?>');
		        }
		        
		        jQuery(document).ready(function() {
			        totalemails_calculate();
		        });
		        </script>
            </td>
        </tr>
		<tr>
			<th><label for="notifyqueuecomplete"><?php _e('Admin Notify on Complete', 'wp-mailinglist'); ?></label></th>
			<td>
				<label><input <?php echo (!empty($notifyqueuecomplete)) ? 'checked="checked"' : ''; ?> type="checkbox" name="notifyqueuecomplete" value="1" id="notifyqueuecomplete" /> <?php _e('Yes, send me an email when the queue has finished sending.', 'wp-mailinglist'); ?></label>
				<span class="howto"><?php _e('Turn this on to receive an email notification when the queue has finished sending.', 'wp-mailinglist'); ?></span>
			</td>
		</tr>
	</tbody>
</table>