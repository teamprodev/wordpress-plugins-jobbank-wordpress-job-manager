<?php
	$jobbank_directory_url=get_option('ep_jobbank_url');
	if($jobbank_directory_url==""){$jobbank_directory_url='job';}
	$args = array();
	$args['number']='999999999';
	$args['orderby']='display_name';
	$args['order']='ASC'; 
	
	$email_body_main = get_option( 'jobbank_notification_email');
	$contact_email_subject =  get_option( 'jobbank_notification_email_subject');
	$admin_mail = get_option('admin_email');
	$wp_title = get_bloginfo();
	$dir_id=$newpost_id;
	$dir_detail= get_post($dir_id); 
	$job_name= $dir_detail->post_title; 
	$currentCategory=wp_get_object_terms( $dir_id, $jobbank_directory_url.'-category');
	$deadline='';
	if(get_post_meta($dir_id,'deadline', true)!=''){
		$deadline =date('M d, Y', strtotime(get_post_meta($dir_id,'deadline', true)));
	}
	$job_link= '<a href="'.get_the_permalink($dir_id).'">'.$dir_detail->post_title.'</a>';	
	$user_query = new WP_User_Query( $args );
	// User Loop
	if ( ! empty( $user_query->results ) ) {
		foreach ( $user_query->results as $user ) {
			$job_notifications_all='';
			$job_notifications_all= get_user_meta($user->ID ,'job_notifications',true);
			$will_send_email='no';		
			foreach($currentCategory as $c){			
				$c->slug;
				if(in_array($c->slug,$job_notifications_all)){
					$will_send_email='yes';
				}
			}
			if($will_send_email=='yes'){  
				$email_body	=$email_body_main;		
				$full_name =get_user_meta($user->ID,'full_name',true);
				$cilent_email_address =$user->user_email;
				$email_body = str_replace("[user_name]", $full_name, $email_body);
				$email_body = str_replace("[iv_member_job_name]",$job_name, $email_body);
				$email_body = str_replace("[iv_member_job_deadline]", $deadline, $email_body);
				$email_body = str_replace("[iv_member_job_url]",$job_link, $email_body); 			
				$headers = array("From: " . $wp_title . " <" . $admin_mail . ">", "Reply-To: ".$admin_mail  ,"Content-Type: text/html");
				$h = implode("\r\n", $headers) . "\r\n";
				wp_mail($cilent_email_address, $contact_email_subject, $email_body, $h);
			}
		}
	}		