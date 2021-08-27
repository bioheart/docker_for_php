<?php

$tcoaccount = $this -> get_option('tcoaccount');
$url = (empty($tcoaccount) || $tcoaccount == "live") ? 
'https://www.2checkout.com/2co/buyer/purchase' : 
'https://sandbox.2checkout.com/checkout/purchase';	

?>

<?php if (!empty($checkoutdata)) : ?>
	<form action="<?php echo esc_attr(wp_unslash($url)); ?>" method="post" id="<?php echo $formid; ?>" target="<?php echo $target; ?>">
		<?php foreach ($checkoutdata as $key => $val) : ?>
			<input type="hidden" name="<?php echo $key; ?>" value="<?php echo esc_attr($val); ?>" />
		<?php endforeach; ?>
		<?php $buttontext = (empty($extend)) ? __('Pay with 2CO', 'wp-mailinglist') : __('Extend with 2CO', 'wp-mailinglist'); ?>
		<button value="1" type="submit" class="<?php echo $this -> pre; ?>button btn btn-success paybutton" name="checkout">
			<i class="fa fa-credit-card-alt fa-fw"></i> <?php echo $buttontext; ?>
		</button>
	</form>
	
	<?php if ($autosubmit) : ?>
		<script type="text/javascript">
		document.getElementById('<?php echo $formid; ?>').submit();
		</script>
	<?php endif; ?>
<?php endif; ?>