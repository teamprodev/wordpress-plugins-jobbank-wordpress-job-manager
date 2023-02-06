<div class="row form-group">
	<label for="text" class="col-md-4"><?php  esc_html_e('Package Name','jobbank');?></label>
	<div class="col-md-8">
		<?php
			$recurring_text='';
			$api_currency= get_option( 'woocommerce_currency' );
			if($api_currency==''){$api_currency= 'USD';}
			if( $package_name==""){
				$jobbank_pack='jobbank_pack';
				$sql=$wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type =%s  and post_status='draft' ", $jobbank_pack);
				$membership_pack = $wpdb->get_results($sql);
				$total_package = count($membership_pack);
				if(sizeof($membership_pack)>0){
					$i=0;
					echo'<select name="package_sel" id ="package_sel" class=" form-control">';
						foreach ( $membership_pack as $row )
						{	
							
						$recurring_text='  ';
						if(get_post_meta($row->ID, 'jobbank_package_cost', true)=='0' or get_post_meta($row->ID, 'jobbank_package_cost', true)==""){
								$amount= 'Free';
						}else{
								$amount= $api_currency.' '. get_post_meta($row->ID, 'jobbank_package_cost', true);
								$amount_only= get_post_meta($row->ID, 'jobbank_package_cost', true);
						}
						
						$recurring_text=$amount;						
						$recurring= get_post_meta($row->ID, 'jobbank_package_recurring', true);
						if($recurring == 'on'){
								$amount= $api_currency.' '. get_post_meta($row->ID, 'jobbank_package_recurring_cost_initial', true);
								$amount_only= get_post_meta($row->ID, 'jobbank_package_recurring_cost_initial', true);
								$count_arb=get_post_meta($row->ID, 'jobbank_package_recurring_cycle_count', true);
								if($count_arb=="" or $count_arb=="1"){
									$recurring_text=$recurring_text.' per '.$count_arb.' '.get_post_meta($row->ID, 'jobbank_package_recurring_cycle_type', true).esc_html__(', Auto recurring ','jobbank') ;
									$recurring_text=$recurring_text.', '.get_post_meta($row->ID,'package_subtitle',true);
								}else{
									$recurring_text=$recurring_text.' per '.$count_arb.' '.get_post_meta($row->ID, 'jobbank_package_recurring_cycle_type', true).'s'.esc_html__(', Auto recurring ','jobbank') ;
									$recurring_text=$recurring_text.' '.get_post_meta($row->ID,'package_subtitle',true);
								}
							}else{ 
								$recurring_text=$recurring_text.', '.esc_html__('Package Expire After ','jobbank' ).get_post_meta($row->ID, 'jobbank_package_initial_expire_interval', true).' '.get_post_meta($row->ID, 'jobbank_package_initial_expire_type', true).', '. get_post_meta($row->ID,'package_subtitle',true);
							}
							
							echo '<option value="'. esc_attr($row->ID).'" >'. esc_html($row->post_title).' | '.esc_html($recurring_text).'</option>';
							if($i==0){$package_id=$row->ID;}
							$i++;
						}	
						
						echo '</select>';	
					$package_id= $membership_pack[0]->ID;
					$recurring= get_post_meta($package_id, 'jobbank_package_recurring', true);
					if($recurring == 'on'){
						$package_amount=get_post_meta($package_id, 'jobbank_package_recurring_cost_initial', true).' '.$api_currency.'/'.get_post_meta($package_id, 'jobbank_package_recurring_cycle_count', true).' '.get_post_meta($package_id, 'jobbank_package_recurring_cycle_type', true);
						}else{
						$package_amount=get_post_meta($package_id, 'jobbank_package_cost',true).' '.$api_currency;
					}
				?>
				<?php
				}
				}else{
				echo '<label class=""> '.$package_name.'</label>';
				$recurring= get_post_meta($package_id, 'jobbank_package_recurring', true);
				if($recurring == 'on'){
					$package_amount=get_post_meta($package_id, 'jobbank_package_recurring_cost_initial', true).' '.$api_currency.'/'.get_post_meta($package_id, 'jobbank_package_recurring_cycle_count', true).' '.get_post_meta($package_id, 'jobbank_package_recurring_cycle_type', true);
					}else{
					$package_amount=get_post_meta($package_id, 'jobbank_package_cost',true).' '.$api_currency;
				}
			}
		?>
	</div>
</div>
<div class="row form-group">
	<label for="text" class="col-md-4"><?php  esc_html_e('Amount','jobbank');?></label>
	<div class="col-md-8" id="p_amount"> <label class="control-label"><?php echo esc_html($package_amount) ; ?> </label>
	</div>
</div>
<input type="hidden" name="reg_error" id="reg_error" value="yes">
<input type="hidden" name="package_id" id="package_id" value="<?php echo esc_attr($package_id); ?>">
<?php
	$jobbank_payment_terms=get_option('jobbank_payment_terms');
	$term_text='I have read & accept the Terms & Conditions';
	if( get_option( 'jobbank_payment_terms_text' ) ) {
		$term_text= get_option('jobbank_payment_terms_text');
	}
	if($jobbank_payment_terms=='yes'){
	?>
	<div class="row">
		<div class="col-md-4 ">
		</div>
		<div class="col-md-8 ">
			<label>
				<input type="checkbox" data-validation="required"
				data-validation-error-msg="You have to agree to our terms "  name="check_terms" id="check_terms"> <?php echo esc_html($term_text); ?>
			</label>
		</div>
	</div>
	<?php
	}
?>
<div class="row">
	<div class="col-md-4">
	</div>
	<div class="col-md-8 ">
		<div id="errormessage" class="alert alert-danger mt-2 displaynone" role="alert"></div>
		<div id="paypal-button" class="margin-top-20">
			
		<div id="loading-3" class="displaynone"><img src='<?php echo ep_jobbank_URLPATH. 'admin/files/images/loader.gif'; ?>' /></div>
		<?php
		if($eprecaptcha_api==''){
			?>
				<button  id="submit_jobbank_payment" name="submit_jobbank_payment"  type="submit" class="btn btn-secondary"  > <?php  esc_html_e('Submit','jobbank');?></button>	
		<?php
		}else{
		?>
			<button  id="submit_jobbank_payment" name="submit_jobbank_payment"  class="btn btn-secondary g-recaptcha" data-sitekey="<?php echo esc_html($eprecaptcha_api); ?>"  data-callback='jobbank_epluginrecaptchaSubmit' data-action='submit' >
				<?php  esc_html_e('Submit','jobbank');?>
			</button>
		<?php
		}
		?>
		
			
			
		</div>
	</div>
</div>