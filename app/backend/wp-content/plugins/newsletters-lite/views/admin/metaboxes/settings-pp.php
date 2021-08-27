<table class="form-table">
	<tbody>
		<tr>
			<th><label for="<?php echo $this -> pre; ?>paypalemail"><?php _e('PayPal Email Address', 'wp-mailinglist'); ?></label>
			<?php echo $Html -> help(__('Your registered PayPal email that will receive the payments.', 'wp-mailinglist')); ?></th>
			<td>
				<input type="text" class="widefat" name="paypalemail" value="<?php echo esc_attr(wp_unslash($this -> get_option('paypalemail'))); ?>" id="<?php echo $this -> pre; ?>paypalemail" />
				<span class="howto"><?php _e('Your registered PayPal email that will receive the payments.', 'wp-mailinglist'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="paypalsubscriptions_N"><?php _e('PayPal Subscriptions', 'wp-mailinglist'); ?></label>
			<?php echo $Html -> help(__('Turning this On will result in an automatic, recurring payment by your subscribers through PayPal.<br/><br/>Turning this Off will result in a once-off payment through PayPal by your subscribers each time.', 'wp-mailinglist')); ?></th>
			<td>
				<label><input <?php echo ($this -> get_option('paypalsubscriptions') == "Y") ? 'checked="checked"' : ''; ?> type="radio" name="paypalsubscriptions" value="Y" id="paypalsubscriptions_Y" /> <?php _e('On', 'wp-mailinglist'); ?></label>
				<label><input <?php echo ($this -> get_option('paypalsubscriptions') == "N") ? 'checked="checked"' : ''; ?> type="radio" name="paypalsubscriptions" value="N" id="paypalsubscriptions_N" /> <?php _e('Off', 'wp-mailinglist'); ?></label>
				<span class="howto"><?php _e('Use PayPal Subscriptions for automatic, recurring payments.', 'wp-mailinglist'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="<?php echo $this -> pre; ?>paypalsandbox"><?php _e('PayPal Sandbox', 'wp-mailinglist'); ?></label>
			<?php echo $Html -> help(__('Turn this On to use the PayPal Sandbox environment for testing purposes. Make sure you use a valid PayPal Sandbox Seller account for the PayPal Email Address setting above. For the Sandobx, you need to have port 443 over SSL protocol enabled on your hosting.', 'wp-mailinglist')); ?></th>
			<td>
				<label><input <?php echo ($this -> get_option('paypalsandbox') == "Y") ? 'checked="checked"' : ''; ?> type="radio" name="paypalsandbox" value="Y" /> <?php _e('On', 'wp-mailinglist'); ?></label>
				<label><input id="<?php echo $this -> pre; ?>paypalsandbox" <?php echo ($this -> get_option('paypalsandbox') == "N") ? 'checked="checked"' : ''; ?> type="radio" name="paypalsandbox" value="N" /> <?php _e('Off', 'wp-mailinglist'); ?></label>
				<span class="howto"><?php _e('The PayPal Sandbox environment is for testing purposes.', 'wp-mailinglist'); ?></span>
			</td>
		</tr>
	</tbody>
</table>

<?php /*<h2><?php _e('API Credentials', 'wp-mailinglist'); ?></h2>

<p>
	<?php _e('Used for transactions/recurring subscriptions to show details, status, etc. and to do refunds, cancellations, etc.', 'wp-mailinglist'); ?><br/>
	<?php echo sprintf(__('See the %s on how to create an API signature.', 'wp-mailinglist'), '<a href="https://www.paypal-knowledge.com/infocenter/index?page=content&widgetview=true&id=FAQ1953&viewlocale=en_US" target="_blank">' . __('PayPal instructions', 'wp-mailinglist') . '</a>'); ?>
</p>

<table class="form-table">
	<tbody>
		<tr>
			<th><label for="paypal_api_username"><?php _e('API Username', 'wp-mailinglist'); ?></label></th>
			<td>
				
			</td>
		</tr>
		<tr>
			<th><label for="paypal_api_password"><?php _e('API Password', 'wp-mailinglist'); ?></label></th>
			<td>
				
			</td>
		</tr>
		<tr>
			<th><label for="paypal_api_signature"><?php _e('API Signature', 'wp-mailinglist'); ?></label></th>
			<td>
				
			</td>
		</tr>
	</tbody>
</table>*/ ?>