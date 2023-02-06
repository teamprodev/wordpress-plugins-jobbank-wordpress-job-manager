<?php
	global $wpdb;	
	$email_body = get_option( 'jobbank_contact_email');
	$contact_email_subject = get_option( 'jobbank_contact_email_subject');			
	$admin_mail = get_option('admin_email');	
	if( get_option( 'jobbank_admin_email' )==FALSE ) {
		$admin_mail = get_option('admin_email');						 
		}else{
		$admin_mail = get_option('jobbank_admin_email');								
	}						
	$bcc_message='';
	if( get_option('epjbjobbank_bcc_message' ) ) {
		$bcc_message= get_option('epjbjobbank_bcc_message'); 
	}	
	$wp_title = get_bloginfo();
	parse_str($_POST['form_data'], $form_data);
	$dir_id=$form_data['dir_id'];	
	
	if(isset($form_data['dir_id'])){
		if($form_data['dir_id']>0){	
		$dir_detail= get_post($dir_id); 
		$dir_title= '<a href="'.get_permalink($dir_id).'">'.$dir_detail->post_title.'</a>';
		$user_id=$dir_detail->post_author;
		$user_info = get_userdata( $user_id);
		$client_email_address =$user_info->user_email;
		}	
	}
	if(isset($form_data['user_id'])){
		if($form_data['user_id']>0){
		$dir_title= '<a href="'.site_url().'">'.get_bloginfo().'</a>';
		$user_info = get_userdata( $form_data['user_id']);
		$client_email_address =$user_info->user_email;
	}
	}
	// Email for Client	
			
	$name=(isset($form_data['name'])?$form_data['name']:'');
	$visitor_email_address=$name.' | '.$form_data['email_address'];
	$sender_phone='';
	if(isset($form_data['visitorphone'])){
		$sender_phone=$form_data['visitorphone'];
	}
	$email_body = str_replace("[iv_member_sender_email]", $visitor_email_address, $email_body);
	$email_body = str_replace("[iv_member_sender_phone]", $sender_phone, $email_body);
	$email_body = str_replace("[iv_member_directory]", $dir_title, $email_body);
	$email_body = str_replace("[iv_member_message]", $form_data['message-content'], $email_body);	
	
	

	$auto_subject= $contact_email_subject; 
	$headers = array("From: " . $wp_title . " <" . $admin_mail . ">", "Reply-To: ".$form_data['email_address']  ,"Content-Type: text/html");
	$h = implode("\r\n", $headers) . "\r\n";
	wp_mail($client_email_address, $auto_subject, $email_body, $h);
	if($bcc_message=='yes'){
		$h = implode("\r\n", $headers) . "\r\n";
		wp_mail($admin_mail, $auto_subject, $email_body, $h);	
	}		