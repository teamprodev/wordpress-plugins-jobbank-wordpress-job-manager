<?php
	global $wpdb;
	$newpost_id='';
	$post_name='jobbank_paypal_setting';			
	$row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_name = '%s' ", $post_name));
	if(isset($row->ID )){
		$newpost_id= $row->ID;
	}	
	$paypal_mode=get_post_meta( $newpost_id,'jobbank_paypal_mode',true);	
?>
<?php
	 include('header.php');
?>
<div class="card col-md-6 mb-3">
	<div class="card-body">
	
		<div class="row">
			<div class="col-md-12"><h3 class="page-header"><?php  esc_html_e('Paypal Api Settings [Express Checkout]','jobbank'); ?> </h3>
			</div>	
		</div> 
		<form id="paypal_form_iv" name="paypal_form_iv" class="form-horizontal" role="form" onsubmit="return false;">
			<div class="form-group row">
				<label for="text" class="col-md-3 control-label"></label>
				<div id="iv-loading"></div>
			</div>		
			<div class="form-group row">
				<label for="text" class="col-md-3 control-label"><?php  esc_html_e('Gateway Mode','jobbank'); ?></label>
				<div class="col-md-5">
					<select name="paypal_mode" id ="paypal_mode" class="form-select">
						<option value="test" <?php echo ($paypal_mode == 'test' ? 'selected' : '') ?>><?php  esc_html_e('Test Mode','jobbank'); ?></option>
						<option value="live" <?php echo ($paypal_mode == 'live' ? 'selected' : '') ?>><?php  esc_html_e('Live Mode','jobbank'); ?></option>
					</select>	
				</div>
			</div> 
			<div class="form-group row">
				<label for="text" class="col-md-3 control-label"><?php  esc_html_e('PayPal API Username','jobbank'); ?> <span class="chili"></span></label>
				<div class="col-md-5">
					<input type="text" class="form-control" name="paypal_username" id="paypal_username" value="<?php echo esc_attr(get_post_meta($newpost_id, 'jobbank_paypal_username', true)); ?>" placeholder="<?php  esc_html_e('Enter Paypal Username','jobbank'); ?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputEmail3" class="col-md-3 control-label"><?php  esc_html_e('PayPal API Password','jobbank'); ?> <span class="chili"></span></label>
				<div class="col-md-5">
					<input type="text" class="form-control" id="paypal_api_password" name="paypal_api_password" value="<?php echo esc_attr(get_post_meta($newpost_id, 'jobbank_paypal_api_password', true)); ?>"  placeholder="<?php  esc_html_e('Enter Paypal Api Password','jobbank'); ?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputEmail3" class="col-md-3 control-label"><?php  esc_html_e('PayPal API Signature','jobbank'); ?> <span class="chili"></span></label>
				<div class="col-md-5">
					<input type="text" class="form-control" id="paypal_api_signature" name="paypal_api_signature" value="<?php echo esc_attr(get_post_meta($newpost_id, 'jobbank_paypal_api_signature', true)); ?>"  placeholder="<?php  esc_html_e('Enter Paypal Api Signature','jobbank'); ?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputEmail3" class="col-md-3 control-label"><?php  esc_html_e('PayPal API Currency Code','jobbank'); ?></label>
				<div class="col-md-5">
					<?php
						$currency_iv=get_post_meta($newpost_id, 'jobbank_paypal_api_currency', true);
					?>
					<select id="paypal_api_currency" name="paypal_api_currency" class="form-select">
						<option value="USD" <?php echo ($currency_iv=='USD' ? 'selected':'')  ?> ><?php  esc_html_e('US Dollars ($)','jobbank'); ?></option>
						<option value="EUR" <?php echo ($currency_iv=='EUR' ? 'selected':'')  ?> ><?php  esc_html_e('Euros (€)','jobbank'); ?></option>
						<option value="GBP" <?php echo ($currency_iv=='GBP' ? 'selected':'')  ?> ><?php  esc_html_e('Pounds Sterling (£)','jobbank'); ?></option>
						<option value="AUD" <?php echo ($currency_iv=='AUD' ? 'selected':'')  ?> ><?php  esc_html_e('Australian Dollars ($)','jobbank'); ?></option>
						<option value="BRL" <?php echo ($currency_iv=='BRL' ? 'selected':'')  ?> ><?php  esc_html_e('Brazilian Real (R$)','jobbank'); ?></option>
						<option value="CAD" <?php echo ($currency_iv=='CAD' ? 'selected':'')  ?> ><?php  esc_html_e('Canadian Dollars ($)','jobbank'); ?></option>
						<option value="CNY" <?php echo ($currency_iv=='CNY' ? 'selected':'')  ?> ><?php  esc_html_e('Chinese Yuan','jobbank'); ?></option>
						<option value="CZK" <?php echo ($currency_iv=='CZK' ? 'selected':'')  ?> ><?php  esc_html_e('Czech Koruna','jobbank'); ?></option>
						<option value="DKK" <?php echo ($currency_iv=='DKK' ? 'selected':'')  ?> ><?php  esc_html_e('Danish Krone','jobbank'); ?></option>
						<option value="HKD" <?php echo ($currency_iv=='HKD' ? 'selected':'')  ?> ><?php  esc_html_e('Hong Kong Dollar ($)','jobbank'); ?></option>
						<option value="HUF" <?php echo ($currency_iv=='HUF' ? 'selected':'')  ?> ><?php  esc_html_e('Hungarian Forint','jobbank'); ?></option>
						<option value="INR" <?php echo ($currency_iv=='INR' ? 'selected':'')  ?> ><?php  esc_html_e('Indian Rupee','jobbank'); ?></option>
						<option value="ILS" <?php echo ($currency_iv=='ILS' ? 'selected':'')  ?> ><?php  esc_html_e('Israeli Sheqel','jobbank'); ?></option>
						<option value="JPY" <?php echo ($currency_iv=='JPY' ? 'selected':'')  ?> ><?php  esc_html_e('Japanese Yen (¥)','jobbank'); ?></option>
						<option value="MYR" <?php echo ($currency_iv=='MYR' ? 'selected':'')  ?> ><?php  esc_html_e('Malaysian Ringgits','jobbank'); ?></option>
						<option value="MXN" <?php echo ($currency_iv=='MXN' ? 'selected':'')  ?> ><?php  esc_html_e('Mexican Peso ($)','jobbank'); ?></option>
						<option value="NZD" <?php echo ($currency_iv=='NZD' ? 'selected':'')  ?> ><?php  esc_html_e('New Zealand Dollar ($)','jobbank'); ?></option>
						<option value="NOK" <?php echo ($currency_iv=='NOK' ? 'selected':'')  ?> ><?php  esc_html_e('Norwegian Krone','jobbank'); ?></option>
						<option value="PHP" <?php echo ($currency_iv=='PHP' ? 'selected':'')  ?> ><?php  esc_html_e('Philippine Pesos','jobbank'); ?></option>
						<option value="PLN" <?php echo ($currency_iv=='PLN' ? 'selected':'')  ?> ><?php  esc_html_e('Polish Zloty','jobbank'); ?></option>
						<option value="SGD" <?php echo ($currency_iv=='SGD' ? 'selected':'')  ?> ><?php  esc_html_e('Singapore Dollar ($)','jobbank'); ?></option>
						<option value="ZAR" <?php echo ($currency_iv=='ZAR' ? 'selected':'')  ?> ><?php  esc_html_e('South African Rand','jobbank'); ?></option>
						<option value="KRW" <?php echo ($currency_iv=='KRW' ? 'selected':'')  ?> ><?php  esc_html_e('South Korean Won','jobbank'); ?></option>
						<option value="SEK" <?php echo ($currency_iv=='SEK' ? 'selected':'')  ?> ><?php  esc_html_e('Swedish Krona','jobbank'); ?></option>
						<option value="CHF" <?php echo ($currency_iv=='CHF' ? 'selected':'')  ?> ><?php  esc_html_e('Swiss Franc','jobbank'); ?></option>
						<option value="RUB" <?php echo ($currency_iv=='RUB' ? 'selected':'')  ?> ><?php  esc_html_e('Russian Ruble','jobbank'); ?></option> 
						<option value="TWD" <?php echo ($currency_iv=='TWD' ? 'selected':'')  ?> ><?php  esc_html_e('Taiwan New Dollars','jobbank'); ?></option>
						<option value="THB" <?php echo ($currency_iv=='THB' ? 'selected':'')  ?> ><?php  esc_html_e('Thai Baht','jobbank'); ?></option>
						<option value="TRY" <?php echo ($currency_iv=='TRY' ? 'selected':'')  ?> ><?php  esc_html_e('Turkish Lira','jobbank'); ?></option>
					</select>										
				</div>
			</div>						  
		</form>
		<div class="row">	
			<label for="" class="col-md-3 control-label"></label>						
			<div class="col-md-5">					
				<div align="">
				<button class="btn btn-info mt-2" onclick="return jobbank_update_paypal_setting();"><?php esc_html_e( 'Update Settings', 'jobbank' );?></button>
				<a href="<?php echo ep_jobbank_ADMINPATH; ?>admin.php?page=jobbank-settings&payment_gateways" class="btn btn-info mt-2" ><?php esc_html_e( '<< Back', 'jobbank' );?></a>
				
				</div>
				<p>&nbsp;</p>
			</div>
		</div>
	</div>
</div>	