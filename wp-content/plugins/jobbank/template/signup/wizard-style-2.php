<?php
	global $wpdb;
	wp_enqueue_script("jquery");
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-datepicker'); 
	wp_enqueue_style('bootstrap', ep_jobbank_URLPATH . 'admin/files/css/iv-bootstrap.css');
	wp_enqueue_style('jobbank_signup-css', ep_jobbank_URLPATH . 'admin/files/css/signup.css');
	wp_enqueue_script('bootstrap.min', ep_jobbank_URLPATH . 'admin/files/js/bootstrap.min-4.js');
	wp_enqueue_style('jquery-ui', ep_jobbank_URLPATH . 'admin/files/css/jquery-ui.css');
	wp_enqueue_style('datetimepicker', ep_jobbank_URLPATH . 'admin/files/css/jquery.datetimepicker.css');
	
	$api_currency= 'USD';
	if( get_option('jobbank_api_currency' )!=FALSE ) {
		$api_currency= get_option('jobbank_api_currency' );
	}
	if(isset($_REQUEST['payment_gateway'])){
		$payment_gateway=$_REQUEST['payment_gateway'];
	}
	$eprecaptcha_api=get_option( 'eprecaptcha_api');
	
	$iv_directories_pack='jobbank_pack';
	$sql=$wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type =%s  and post_status='draft' ", $iv_directories_pack);
	$membership_pack = $wpdb->get_results($sql);
	$total_package=count($membership_pack);
	$package_id= 0;
	$main_class = new eplugins_jobbank;
	$iv_gateway='paypal-express';
	if( get_option( 'jobbank_payment_gateway' )!=FALSE ) {
		$iv_gateway = get_option('jobbank_payment_gateway');
		if($iv_gateway=='paypal-express'){
			$post_name='jobbank_paypal_setting';
			$row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_name = '%s' ", $post_name));
			$paypal_id='0';
			if(isset($row->ID )){
				$paypal_id= $row->ID;
			}
			$api_currency=get_post_meta($paypal_id, 'jobbank_paypal_api_currency', true);
		}
	}
	$package_id='';
	if(isset($_REQUEST['package_id'])){
		$package_id=$_REQUEST['package_id'];
		$recurring= get_post_meta($package_id, 'jobbank_package_recurring', true);
		if($recurring == 'on'){
			$package_amount=get_post_meta($package_id, 'jobbank_package_recurring_cost_initial', true);
			}else{
			$package_amount=get_post_meta($package_id, 'jobbank_package_cost',true);
		}
		if($package_amount=='' || $package_amount=='0' ){$iv_gateway='paypal-express';}
	}
	$form_meta_data= get_post_meta( $package_id,'jobbank_content',true);
	$row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE id = '%s' ",$package_id ));
	$package_name='';
	$package_amount='';
	if(isset($row->post_title)){
		$package_name=$row->post_title;
		$count =get_post_meta($package_id, 'jobbank_package_recurring_cycle_count', true);
		$package_name=$package_name;
		$package_amount=get_post_meta($package_id, 'jobbank_package_cost',true);
	}
	$newpost_id='';
	$post_name='jobbank_stripe_setting';
	$row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_name = '%s' " ,$post_name));
	if(isset($row->ID )){
		$newpost_id= $row->ID;
	}
	$stripe_mode=get_post_meta( $newpost_id,'jobbank_stripe_mode',true);
	if($stripe_mode=='test'){
		$stripe_publishable =get_post_meta($newpost_id, 'jobbank_stripe_publishable_test',true);
		}else{
		$stripe_publishable =get_post_meta($newpost_id, 'jobbank_stripe_live_publishable_key',true);
	}
	
	if($total_package<1){$iv_gateway='paypal-express';}
?>
<div class="bootstrap-wrapper  mb-3">
	<div class="container  jobbankborder p-4">
		<?php
				if($iv_gateway=='paypal-express'){
				?>
				<form id="jobbank_registration" name="jobbank_registration" class="form-horizontal" action="<?php  the_permalink() ?>?package_id=<?php echo esc_attr($package_id); ?>&payment_gateway=paypal&iv-submit-listing=register" method="post" role="form"  enctype="multipart/form-data">
				<?php
				}
				if($iv_gateway=='woocommerce'){
				?>
				<form id="jobbank_registration" name="jobbank_registration" class="form-horizontal" action="<?php  the_permalink() ?>?package_id=<?php echo esc_attr($package_id); ?>&payment_gateway=woocommerce&iv-submit-listing=register" method="post" role="form"  enctype="multipart/form-data">
				<?php
				}
				if($iv_gateway=='stripe'){?>
				<form id="jobbank_registration" name="jobbank_registration" class="form-horizontal" action="<?php  the_permalink() ?>?&package_id=<?php echo esc_attr($package_id); ?>&payment_gateway=stripe&iv-submit-stripe=register" method="post" role="form"  enctype="multipart/form-data">
					<input type="hidden" name="payment_gateway" id="payment_gateway" value="stripe">
					<input type="hidden" name="iv-submit-stripe" id="iv-submit-stripe" value="register">
					<?php
					}
				?>				
				<div class="border-bottom pb-4 mb-3 toptitle "><?php esc_html_e('User Info','jobbank');?></div>
				
				<div class="row user_info">
				 
					<div class="col-md-12  ">
						<?php
							if(isset($_REQUEST['message-error'])){?>
						  <div class="row alert alert-info alert-dismissable" id='loading-2'><a class="panel-close close" data-dismiss="alert">x</a> <?php   esc_html_e('User_or_Email_Exists','jobbank'); ?></div>
						  <?php
							}
						?>
						<!--
							For Form Validation we used plugins https://formvalidation.io/
							This is in line validation so you can add fields easily.
						-->
						
						
						<div class="form-group row">
							<label  class="col-md-4 control-label" ><?php   esc_html_e('User Type','jobbank');?><span class="chili"></span></label>
							<div class="col-md-8">
							<select name="user_type" id ="user_type" class="form-control">
								<option value="candidate" ><?php   esc_html_e("I'm a candidate",'jobbank'); ?></option>
								<option value="employer" ><?php   esc_html_e("I'm an employer",'jobbank'); ?></option>
							</select>								
							</div>
						</div>
						
						
						<div class="text-center" id="loading"> </div>
						<div class="form-group row"  >
							<label for="text" class="col-md-4 control-label"><?php   esc_html_e('User Name','jobbank');?><span class="chili"></span></label>
							<div class="col-md-8">
								<input type="text"  name="iv_member_user_name" id="iv_member_user_name"  data-validation="length alphanumeric"
								data-validation-length="4-12" data-validation-error-msg="<?php   esc_html_e(' The user name has to be an alphanumeric value between 4-12 characters','jobbank');?>" class="form-control ctrl-textbox" placeholder="<?php  esc_html_e('Enter User Name','jobbank');?>"  alt="required">
							</div>
						</div>
						
						<div class="form-group row">
							<label for="email" class="col-md-4 control-label" ><?php   esc_html_e('Email Address','jobbank');?><span class="chili"></span></label>
							<div class="col-md-8">
								<input type="email" name="iv_member_email" id="iv_member_email" data-validation="email"  class="form-control ctrl-textbox" placeholder="<?php   esc_html_e('Enter email address','jobbank');?>" data-validation-error-msg="<?php   esc_html_e('Please enter a valid email address','jobbank');?> " >
							</div>
						</div>
						
						<?php wp_nonce_field( 'signup1' ); ?>
						<div class="form-group row ">
							<label for="text" class="col-md-4 control-label"><?php   esc_html_e('Password','jobbank');?><span class="chili"></span></label>
							<div class="col-md-8">
								<input type="password" name="iv_member_password"  id="iv_member_password" class="form-control ctrl-textbox" placeholder="" data-validation="strength"
								data-validation-strength="2" data-validation-error-msg="<?php   esc_html_e('The password is not strong enough','jobbank');?>">
							</div>
						</div>
						
							
							<?php
							$iv_membership_signup_profile_pic=get_option('jobbank_signup_profile_pic');
							if($iv_membership_signup_profile_pic=='' ){ $iv_membership_signup_profile_pic='yes';}	
							if($iv_membership_signup_profile_pic=='yes' ){
							?>
							<div class="form-group row ">
								<label for="text" class="col-md-4 control-label"><?php  esc_html_e('Profile Image','jobbank');?></label>
								<div class="col-md-8">
									<input type="file" name="profilepicture"  id="profilepicture" size="25" class="form-input " />
								</div>
							</div>
							<?php
							}
						?>
						
				
						<?php
						$i=1;
						$default_fields = array();
						$default_fields=get_option('jobbank_profile_fields');
						$sign_up_array=get_option( 'jobbank_signup_fields');
						$require_array=get_option( 'jobbank_signup_require');
						if(is_array($default_fields)){
							foreach ( $default_fields as $field_key => $field_value ) {
								$sign_up='no';
								if(isset($sign_up_array[$field_key]) && $sign_up_array[$field_key] == 'yes') {
									$sign_up='yes';
								}
								$require='no';
								if(isset($require_array[$field_key]) && $require_array[$field_key] == 'yes') {
									$require='yes';
								}
								if($sign_up=='yes--'){
								?>
								<div class="form-group row">
									<label  class="col-md-4 control-label" ><?php echo esc_html($field_value); ?><span class="<?php echo($require=='yes'?'chili':''); ?>"></span></label>
									<div class="col-md-8">
										<input type="text"  name="<?php echo esc_html($field_key);?>" <?php echo($require=='yes'?'data-validation="length" data-validation-length="2-100"':''); ?>
										class="form-control ctrl-textbox" placeholder="<?php esc_html_e('Enter', 'jobbank');?><?php echo esc_html($field_value);?>" >
									</div>
								</div>
								<?php
								}
								echo  $main_class->jobbank_check_field_input_access_signup($field_key, $field_value);
							}
						}
					?>
						
						<?php							
						$total_package = count($membership_pack);
						if($total_package<1){		
						?>							
							<div class="row form-group" id="nopaymentform">
								<input type="hidden" name="reg_error" id="reg_error" value="yes">
								<input type="hidden" name="package_id" id="package_id" value="0">
								<input type="hidden" name="return_page" id="return_page" value="<?php  the_permalink() ?>">
									<div class="col-md-4"> </div>
									<div class="col-md-8">
									<div id="errormessage" class="alert alert-danger mt-2 displaynone" role="alert"></div>
										<div id="paypal-button">
											<div id="loading-3" class="displaynone"  ><img src='<?php echo ep_jobbank_URLPATH. 'admin/files/images/loader.gif'; ?>' /></div>
											<?php
											if($eprecaptcha_api==''){
											?>
												<button  id="submit_jobbank_payment" name="submit_jobbank_payment"  type="submit" class="btn btn-secondary"  >												
													<?php  esc_html_e('Submit','jobbank');?>
												</button>
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
						<?php
						}
						?>
						<input type="hidden" name="hidden_form_name" id="hidden_form_name" value="jobbank_registration">
					</div>
				
				</div>
				<?php
				
				if($total_package>0){
				?>
				<div id="employer-div">					
					<div class="border-bottom pb-4 mb-3 toptitle"><?php esc_html_e('Payment Info','jobbank');?></div>
					<div class="row payment_info">
						<div class="col-md-12 ">
							<?php
								if($iv_gateway=='paypal-express'){
									include(ep_jobbank_template.'signup/paypal_form_2.php');
								}
								if($iv_gateway=='stripe'){
									include(ep_jobbank_template.'signup/iv_stripe_form_2.php');
								}
								if($iv_gateway=='woocommerce'){
									include(ep_jobbank_template.'signup/woocommerce.php');
								}
							?>
						</div>
					</div>
				</div>
				<?php
				}
				?>
			</form>
		</div>
	</div>
	<?php
		
		wp_enqueue_script('jquery.form-validator', ep_jobbank_URLPATH . 'admin/files/js/jquery.form-validator.js');
		wp_enqueue_script('jobbank_signup', ep_jobbank_URLPATH . 'admin/files/js/signup.js');
		wp_localize_script('jobbank_signup', 'dirpro_data', array(
		'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
		'loader_image'=>'<img src="'.ep_jobbank_URLPATH. 'admin/files/images/loader.gif" />',
		'loader_image2'=>'<img src="'.ep_jobbank_URLPATH. 'admin/files/images/old-loader.gif" />',
		'right_icon'=>'<img src="'.ep_jobbank_URLPATH. 'admin/files/images/right_icon.png" />',
		'wrong_16x16'=>'<img src="'.ep_jobbank_URLPATH. 'admin/files/images/wrong_16x16.png" />',
		'stripe_publishable'=>$stripe_publishable,
		'package_amount'=>$package_amount,
		'api_currency'=>$api_currency,
		'iv_gateway'=>$iv_gateway,
		'total_package'=> $total_package,
		'errormessage'=>esc_html__("Please complete the form",'jobbank'),
		'HideCoupon'=>esc_html__("Hide Coupon",'jobbank'),
		'Havecoupon'=> esc_html__("Have Coupon",'jobbank'),
		'dirwpnonce'=> wp_create_nonce("signup"),
		'signup'=> wp_create_nonce("signup"),
		) );


	if($eprecaptcha_api!=''){	
		wp_register_script( 'rechaptcha', 'https://www.google.com/recaptcha/api.js?render='.$eprecaptcha_api, null, null, true );
		wp_enqueue_script('rechaptcha');
	}
	

?>	