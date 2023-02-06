<?php
	$jobbank_directory_url=get_option('ep_jobbank_url');					
	if($jobbank_directory_url==""){$jobbank_directory_url='job';}
	global $post;
	add_action( 'manage_'.$jobbank_directory_url.'_posts_custom_column' , 'jobbank_custom_job_column' );
	add_filter( 'manage_edit-'.$jobbank_directory_url.'_columns',  'jobbank_set_custom_edit_job_columns'  );
	function jobbank_set_custom_edit_job_columns($columns) {	
		$columns['id'] = esc_html__('ID','jobbank'); 
		$columns['salary'] = esc_html__('Salary','jobbank'); 
		$columns['deadline'] = esc_html__('Deadline','jobbank');
		return $columns;
	}
	function jobbank_custom_job_column( $column ) {
		global $post;
		switch ( $column ) {
			case 'id' :		
			echo  esc_html($post->ID);
			break; 
			case 'salary' :		
			echo  get_post_meta($post->ID,'salary',true);		
			break; 
			case 'deadline' :
			echo date('M d, Y',strtotime(get_post_meta($post->ID,'deadline',true)));  
			break;
		}
	}		
	add_action( 'manage_job_apply_posts_custom_column' , 'jobbank_custom_job_apply_column' );
	add_filter( 'manage_edit-job_apply_columns',  'jobbank_set_custom_edit_job_apply_columns'  );
	function jobbank_set_custom_edit_job_apply_columns($columns) {				
		$columns['title'] = esc_html__('Candidate Name','jobbank');
		$columns['email'] = esc_html__('Email','jobbank');
		$columns['phone'] = esc_html__('Phone','jobbank');
		$columns['job'] = esc_html__('Job','jobbank');
		$columns['cv'] = esc_html__('CV','jobbank');
		return $columns;
	}
	function jobbank_custom_job_apply_column( $column ) {
		global $post;
		switch ( $column ) {
			case 'job' :		
			$job_post_id= get_post_meta($post->ID,'apply_jod_id',true);			
			echo get_the_title($job_post_id);
			break; 
			case 'phone' :
			if(get_post_meta($post->ID,'user_id',true)<1){
				echo esc_attr(get_post_meta($post->ID,'phone',true));  
				}else{
				$userid= get_post_meta($post->ID,'user_id',true);
				echo esc_attr(get_user_meta($userid,'phone',true));  
			}
			break;
			case 'email' :
			echo esc_attr(get_post_meta($post->ID,'email_address',true));  
			break;
			case 'cv' :
			$upload_dir = wp_upload_dir();
			$file_name=get_post_meta($post->ID, 'file_name', true);
			$useridpdf=get_post_meta($post->ID, 'user_id', true);
			if(get_post_meta($post->ID, 'user_id', true)!=''){ 
				echo'<a target="_blank" href="?&jobbankpdfcv='.esc_attr($useridpdf).'">'.esc_html__('Print CV','jobbank').' </a>';
				}else{
				echo'<a target="_blank" href="'. esc_url(get_post_meta($post->ID, 'cv_file_url', true) ).'"  > '.esc_html__('Print CV','jobbank').' </a>';
			}
			break;
		}
	}	
	
	add_action( 'manage_jobbank_message_posts_custom_column' , 'jobbank_custom_jobbank_message_column' );
	add_filter( 'manage_edit-jobbank_message_columns',  'jobbank_set_custom_edit_jobbank_message_columns'  );
	function jobbank_set_custom_edit_jobbank_message_columns($columns) {				
		$columns['Message'] = esc_html__('Message','jobbank');
		$columns['email'] = esc_html__('Email','jobbank');
		$columns['phone'] = esc_html__('Phone','jobbank');		
		return $columns;
	}
	function jobbank_custom_jobbank_message_column( $column ) {
		global $post;
		switch ( $column ) {
			case 'Message' :		
				echo esc_html($post->post_content);
			break; 
			case 'phone' :			
				echo get_post_meta($post->ID,'from_phone',true);  
			break;
			case 'email' :
				echo get_post_meta($post->ID,'from_email',true);  
			break;
			
			
		}
	}	
	
?>