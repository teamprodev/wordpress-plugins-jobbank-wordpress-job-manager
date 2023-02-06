<?php
global $wpdb;
	$current_user = wp_get_current_user();
	$userId=$user_id=$current_user->ID;
	$userId=$current_user->ID;
		$payment_gateway=get_option('jobbank_payment_gateway');
		if($payment_gateway=='paypal-express'){
				if( ! class_exists('Paypal' ) ) {
					require_once(ep_jobbank_DIR . '/inc/class-paypal.php');
				}
				$post_name='jobbank_paypal_setting';						
				$row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_name = '%s' ", $post_name));
				$paypal_id='0';
				if(isset($row->ID )){
					$paypal_id= $row->ID;
				}
				$paypal_api_currency=get_post_meta($paypal_id, 'jobbank_paypal_api_currency', true);
				$paypal_username=get_post_meta($paypal_id, 'jobbank_paypal_username',true);
				$paypal_api_password=get_post_meta($paypal_id, 'jobbank_paypal_api_password', true);
				$paypal_api_signature=get_post_meta($paypal_id, 'jobbank_paypal_api_signature', true);
				$credentials = array();
				$credentials['USER'] = (isset($paypal_username)) ? $paypal_username : '';
				$credentials['PWD'] = (isset($paypal_api_password)) ? $paypal_api_password : '';
				$credentials['SIGNATURE'] = (isset($paypal_api_signature)) ? $paypal_api_signature : '';
				$paypal_mode=get_post_meta($paypal_id, 'jobbank_paypal_mode', true);
				$currencyCode = $paypal_api_currency;
				$sandbox = ($paypal_mode == 'live') ? '' : 'sandbox.';
				$sandboxBool = (!empty($sandbox)) ? true : false;						
				$paypal = new Paypal($credentials,$sandboxBool);
				$payment_status=get_user_meta($userId, 'jobbank_payment_status', true);
				if($payment_status=='pending'){
						$PROFILEID=get_user_meta($userId, 'iv_paypal_recurring_profile_id', true);
						$recurringCheck ='';
						$recurringCheck = $paypal -> request('GetRecurringPaymentsProfileDetails',array('PROFILEID' => $PROFILEID ));
					
						if(isset($recurringCheck['STATUS'])){
							if($recurringCheck['STATUS']=='Active'){
								$package_id=get_user_meta($userId, 'jobbank_package_id', true); 
								$role_package= get_post_meta( $package_id,'jobbank_package_user_role',true); 	
								update_user_meta($userId, 'jobbank_payment_status', 'success');
								$user = new WP_User( $userId );
								$user->set_role($role_package);									
							}
						}
				}
					$exprie_date= strtotime (get_user_meta($userId, 'jobbank_exprie_date', true));	
					$current_date=strtotime(date('Y-m-d'));							
				if($exprie_date < $current_date){
							$PROFILEID=get_user_meta($userId, 'iv_paypal_recurring_profile_id', true);
							$recurringCheck ='';
							$recurringCheck = $paypal -> request('GetRecurringPaymentsProfileDetails',array('PROFILEID' => $PROFILEID ));
							// For one time payment
							if($PROFILEID==''){
								if($exprie_date!=''){
									update_user_meta($userId, 'jobbank_payment_status', 'pending');
									$user = new WP_User( $userId );
									$user->set_role('basic');
								}	
							}
							
							if(isset($recurringCheck['STATUS'])){
								if($recurringCheck['STATUS']=='Active'){
									$package_id=get_user_meta($userId, 'jobbank_package_id', true); 
									$role_package= get_post_meta( $package_id,'jobbank_package_user_role',true); 	
									update_user_meta($userId, 'jobbank_payment_status', 'success');
									$user = new WP_User( $userId );
									$user->set_role($role_package);
									// Change exprie_date 
									$package_id=get_user_meta($userId,'jobbank_package_id',true); 
										$jobbank_exprie_date_old =get_user_meta($userId,'jobbank_exprie_date',true);
										$recurring_cycle_count= get_post_meta($package_id,'jobbank_package_recurring_cycle_count',true);
										if($recurring_cycle_count=="" or $recurring_cycle_count==0){$recurring_cycle_count=1;}
										 $recurring_cycle_type= get_post_meta($package_id,'jobbank_package_recurring_cycle_type',true);
										$periodNum='';
										switch ($recurring_cycle_type) {
											case 'year':
												$periodNum = (60 * 60 * 24 * 365) * $recurring_cycle_count;
												break;
											case 'month':
												$periodNum = (60 * 60 * 24 * 30) * $recurring_cycle_count;
												break;
											case 'week':
												$periodNum = (60 * 60 * 24 * 7) * $recurring_cycle_count;
												break;
											case 'day':
												$periodNum = (60 * 60 * 24) * $recurring_cycle_count;
												break;
										}
										$timeToBegin = time() + $periodNum;
										$date_n = date('Y-m-d',$timeToBegin).'T'.'00:00:00Z';
									$new_exp_date=  date("Y-m-d", strtotime($date_n));
									update_user_meta($userId, 'jobbank_exprie_date', $new_exp_date); 
									// End exprie_date 
									//Add  History for Payment
										$row4 = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE id = '%s' ", $package_id));
										$package_name=$row4->post_title;
										if(get_post_meta($package_id,'jobbank_package_recurring',true)=='on'){
											$jobbank_package_cost =get_post_meta($package_id,'jobbank_package_recurring_cost_initial',true);
										}else{
											$jobbank_package_cost =get_post_meta($package_id,'jobbank_package_cost',true);
										}
										$api_currency= get_option('jobbank_api_currency' );		
										$total_g = $jobbank_package_cost.' '.$api_currency;												
										
										$post_type = 'iv_payment';
										$my_post_form = array('post_title' => wp_strip_all_tags($package_name), 'post_name' => 														wp_strip_all_tags($package_name), 'post_content' => $total_g, 'post_status' => 'publish', 											'post_type'=>$post_type,	'post_author' => get_current_user_id(),);
										$newpost_id = wp_insert_post($my_post_form);
									//End  History for Payment	
								}else{
									update_user_meta($userId, 'jobbank_payment_status', 'pending');
									$user = new WP_User( $userId );
									$user->set_role('basic');
								}
							}	
				}			
		}
		if($payment_gateway=='stripe'){
				$post_name2='jobbank_stripe_setting';
				$row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_name = '%s' ",$post_name2));
					if(isset($row->ID )){
					  $stripe_id= $row->ID;
					}					
				$stripe_mode=get_post_meta( $stripe_id,'jobbank_stripe_mode',true);	
				if($stripe_mode=='test'){
					$stripe_api =get_post_meta($stripe_id, 'jobbank_stripe_secret_test',true);	
				}else{
					$stripe_api =get_post_meta($stripe_id, 'jobbank_stripe_live_secret_key',true);	
				}
				require_once(ep_jobbank_DIR . '/admin/init.php');						
				\Stripe\Stripe::setApiKey($stripe_api);	
				$payment_status=get_user_meta($userId, 'jobbank_payment_status', true);	
				if($payment_status=='pending'){								
						$cust_id = get_user_meta($userId,'jobbank_stripe_cust_id',true);
						$sub_id = get_user_meta($userId,'jobbank_stripe_subscrip_id',true);
						if($sub_id!=''){							
							try{
									$iv_return_stripe 	= Stripe_Customer::retrieve($cust_id);
									$subscription		= $iv_return_stripe->subscriptions->retrieve($sub_id);
							} catch (Exception $e) {
							}							
							if(isset($subscription->status)){
								if($subscription->status=='active'){
									$package_id=get_user_meta($userId, 'jobbank_package_id', true); 
									$role_package= get_post_meta( $package_id,'jobbank_package_user_role',true); 	
									update_user_meta($userId, 'jobbank_payment_status', 'success');
									$user = new WP_User( $userId );
									$user->set_role($role_package);
								}
							}
						}
				}
					$exprie_date= strtotime (get_user_meta($userId, 'jobbank_exprie_date', true));	
					$current_date=strtotime(date('Y-m-d'));
				if(  $current_date > $exprie_date){
						
							$cust_id = get_user_meta($userId,'jobbank_stripe_cust_id',true);
							$sub_id = get_user_meta($userId,'jobbank_stripe_subscrip_id',true);
							if($sub_id!=''){							
								try{
										$iv_return_stripe 	= \Stripe\Customer::retrieve($cust_id);
										$subscription		= $iv_return_stripe->subscriptions->retrieve($sub_id);
								} catch (Exception $e) {
								}	
								if(isset($subscription->status)){
									if($subscription->status=='active'){
										$package_id=get_user_meta($userId, 'jobbank_package_id', true); 
										$role_package= get_post_meta( $package_id,'jobbank_package_user_role',true); 	
										update_user_meta($userId, 'jobbank_payment_status', 'success');
										$user = new WP_User( $userId );
										$user->set_role($role_package);
										// Change exprie_date 										
										$package_id=get_user_meta($userId,'jobbank_package_id',true); 
										$jobbank_exprie_date_old =get_user_meta($userId,'jobbank_exprie_date',true);
										$recurring_cycle_count= get_post_meta($package_id,'jobbank_package_recurring_cycle_count',true);
										if($recurring_cycle_count=="" or $recurring_cycle_count==0){$recurring_cycle_count=1;}
										$recurring_cycle_type= get_post_meta($package_id,'jobbank_package_recurring_cycle_type',true);
										$periodNum='';
										switch ($recurring_cycle_type) {
											case 'year':
												$periodNum = (60 * 60 * 24 * 365) * $recurring_cycle_count;
												break;
											case 'month':
												$periodNum = (60 * 60 * 24 * 30) * $recurring_cycle_count;
												break;
											case 'week':
												$periodNum = (60 * 60 * 24 * 7) * $recurring_cycle_count;
												break;
											case 'day':
												$periodNum = (60 * 60 * 24) * $recurring_cycle_count;
												break;
										}
										$timeToBegin = time() + $periodNum;
										$date_n = date('Y-m-d',$timeToBegin).'T'.'00:00:00Z';
										$new_exp_date=  date("Y-m-d", strtotime($date_n)); 
										update_user_meta($userId, 'jobbank_exprie_date', $new_exp_date);
										// End exprie_date
											//Add  History for Payment
										$row4 = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE id = '%s' ", $package_id));
										$package_name=$row4->post_title;
										if(get_post_meta($package_id,'jobbank_package_recurring',true)=='on'){
											$jobbank_package_cost =get_post_meta($package_id,'jobbank_package_recurring_cost_initial',true);
										}else{
											$jobbank_package_cost =get_post_meta($package_id,'jobbank_package_cost',true);
										}
										$api_currency= get_option('jobbank_api_currency' );		
										$total_g = $jobbank_package_cost.' '.$api_currency;												
										$post_type = 'iv_payment';
										$my_post_form = array('post_title' => wp_strip_all_tags($package_name), 'post_name' => 														wp_strip_all_tags($package_name), 'post_content' => $total_g, 'post_status' => 'publish', 										'post_type'=>$post_type,'post_author' => get_current_user_id(),);
										$newpost_id = wp_insert_post($my_post_form);
										//End  History for Payment	
									}else{
										update_user_meta($userId, 'jobbank_payment_status', 'pending');
										$user = new WP_User( $userId );
										$user->set_role('basic');
									}
								}	
						}else{
										update_user_meta($userId, 'jobbank_payment_status', 'pending');
										$user = new WP_User( $userId );
										$user->set_role('basic');
						}
			}
	}			

	if($payment_gateway=='woocommerce'){ 
		if( class_exists('WooCommerce' ) ) { 
			
		$currencyCode = get_option( 'woocommerce_currency' );
		$status_result=0;
		$wpayment_status=get_user_meta($userId, 'jobbank_payment_woo', true);
		$package_id=get_user_meta($userId, 'jobbank_package_id', true);
		if($wpayment_status=='jobboank_woo_new'){
			 include(ep_jobbank_DIR . '/admin/pages/payment-inc/woo_new_order.php');
		}				
		if($wpayment_status=='woo_update'){ 
			 include(ep_jobbank_DIR . '/admin/pages/payment-inc/woo_update_package.php');			
		}
		if($wpayment_status=='success'){ 
				$exprie_date= strtotime (get_user_meta($userId, 'jobbank_exprie_date', true));
				$current_date=strtotime(date('Y-m-d'));
			if(  $current_date > $exprie_date){ 
				include(ep_jobbank_DIR . '/admin/pages/payment-inc/woo_daily_check.php');
			}
		}
	}
}
		
