<?php
global $wpdb;			
	$email_body_cilent = get_option( 'jobbank_order_client_email');
	$order_email_subject_client = get_option( 'jobbank_order_client_email_sub');			
					
		$admin_mail = get_option('admin_email');	
		if( get_option( 'jobbank_admin_email' )==FALSE ) {
			$admin_mail = get_option('admin_email');						 
		}else{
			$admin_mail = get_option('jobbank_admin_email');								
		}						
		$wp_title = get_bloginfo();
					
	$api_currency= get_option('jobbank_api_currency' );
	
	if($package_id==''){
		$package_id='';
	}
			
	
	$row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE id = '%s' ",$package_id ));
	$package_name=$row->post_title;		
		
	$user_info = get_userdata( $userId);
	
	$invoice_no='000-'.$userId.'-'.date('Y',time());			
	$member_no='000-'.$userId;
	// Email for Client					
	 
	if(get_post_meta($package_id,'jobbank_package_recurring',true)=='on'){
		$jobbank_package_cost =get_post_meta($package_id,'jobbank_package_recurring_cost_initial',true);
	}else{
		$jobbank_package_cost =get_post_meta($package_id,'jobbank_package_cost',true);
	}	
	
	$dis_amount =get_user_meta($userId, 'jobbank_discount',true);
	
	$package_amount_2=$jobbank_package_cost.' '.$api_currency;
	$discount_2= $dis_amount.' '.$api_currency;
	$total_g =($jobbank_package_cost - $dis_amount).' '.$api_currency;
	$address_invoice=$user_info->display_name.'<br/>'.$user_info->user_email;
	
	$email_body_cilent = str_replace('[package_name]', $package_name, $email_body_cilent);
	$email_body_cilent = str_replace('[buyer_address]', $address_invoice, $email_body_cilent); 
	$email_body_cilent = str_replace('[member_no]', $member_no, $email_body_cilent); 	
	$email_body_cilent = str_replace('[invoice_no]', $invoice_no, $email_body_cilent); 
	$email_body_cilent = str_replace('[package_amount]', $package_amount_2, $email_body_cilent); 	
	$email_body_cilent = str_replace('[discount_amount]', $discount_2, $email_body_cilent); 
	$email_body_cilent = str_replace('[total_amount]', $total_g, $email_body_cilent); 
	
	
	$cilent_email_address =$user_info->user_email; 
	$headers = array("From: " . get_bloginfo() . " <" . $admin_mail . ">", "Content-Type: text/html");
	$h = implode("\r\n", $headers) . "\r\n";
	wp_mail($cilent_email_address, $order_email_subject_client, $email_body_cilent, $h);
	
	// For Admin Email*****	
	$email_body_admin = get_option( 'jobbank_order_admin_email');
	$order_email_subject_admin = get_option( 'jobbank_order_admin_email_sub');			
					
	
	$email_body_admin = str_replace('[package_name]', $package_name, $email_body_admin);
	$email_body_admin = str_replace('[buyer_address]', $address_invoice, $email_body_admin); 
	$email_body_admin = str_replace('[member_no]', $member_no, $email_body_admin); 	
	$email_body_admin = str_replace('[invoice_no]', $invoice_no, $email_body_admin); 
	$email_body_admin = str_replace('[package_amount]', $package_amount_2, $email_body_admin); 	
	$email_body_admin = str_replace('[discount_amount]', $discount_2, $email_body_admin); 
	$email_body_admin = str_replace('[total_amount]', $total_g, $email_body_admin); 
	
	
	
	
	$headers = array("From: " . get_bloginfo() . " <" . $admin_mail . ">", "Content-Type: text/html");
	$h = implode("\r\n", $headers) . "\r\n";
	wp_mail($admin_mail, $order_email_subject_admin, $email_body_admin, $h);
	
	//Add  History for Payment
	$trial_enable= get_post_meta( $package_id,'jobbank_package_enable_trial_period',true); 
	if( $trial_enable!='yes' ){	
			
			$post_type = 'iv_payment';
			$my_post_form = array('post_title' => wp_strip_all_tags($package_name), 'post_name' => wp_strip_all_tags($package_name), 'post_content' => $total_g, 'post_type'=>$post_type, 'post_status' => 'publish', 'post_author' => $userId,);
			$newpost_id = wp_insert_post($my_post_form);
						
			update_post_meta( $newpost_id, 'p_user_id',$userId);
			
	}		
	//End  History for Payment				
			
