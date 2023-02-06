<?php
if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( 'Are you cheating:user Permission?' );
}
global $current_user; global $wpdb;	
$jobbank_directory_url=get_option('ep_jobbank_url');					
if($jobbank_directory_url==""){$jobbank_directory_url='job';}
	$post_names = array('PHP Developer','WordPress Developer','Warehouse Handler','Plant Technician', 'Warehouse Worker','Senior Full Stack Engineer');
	$post_cat = array('Accounting','Commercial','IT & Telecommunication','Support Service','Sales & Marketing');	
	$post_tag = array('WordPress','Php','C++','Electrical','Dairy ','Food','Law & Legal','Creative','Beauty','Care/ Health','Fitness');
	$post_city = array('New York ','Dubai','Bretagne','New South Wales','London','Paris','Berlin');	
	$post_aear = array('Central Brooklyn','Chelsea','Midtown','Shoreditch' , 'Upper Manhattan','Berlin');
	$post_location = array('New York','London','Tokyo','Los Angeles' , 'Houston','Berlin');
	
$i=0;	
	foreach($post_names as $one_post){ 
	$my_post = array();
	$my_post['post_title'] = $one_post;
	$my_post['post_content'] = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
	
	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
	
	';	
	$my_post['post_status'] = 'publish';	
	$my_post['post_type'] = $jobbank_directory_url;	
	$newpost_id= wp_insert_post( $my_post );		
	
	$rand_keys = array_rand($post_cat, 2);	
	$new_post_arr=array();
	$new_post_arr[]=$post_cat[$rand_keys[0]];
	$new_post_arr[]=$post_cat[$rand_keys[1]];
	wp_set_object_terms( $newpost_id, $new_post_arr, $jobbank_directory_url.'-category');	
	
	// For Tag Save tag_arr	
	$rand_keys = array_rand($post_tag, 6);	
	$new_post_arr=array();
	$new_post_arr[]=$post_tag[$rand_keys[0]];
	$new_post_arr[]=$post_tag[$rand_keys[1]];
	$new_post_arr[]=$post_tag[$rand_keys[2]];
	$new_post_arr[]=$post_tag[$rand_keys[3]];
	$new_post_arr[]=$post_tag[$rand_keys[4]];
	$new_post_arr[]=$post_tag[$rand_keys[5]];
	
	wp_set_object_terms( $newpost_id, $new_post_arr, $jobbank_directory_url.'-tag');
	
	
	wp_set_object_terms( $newpost_id, $post_location[$i], $jobbank_directory_url.'-locations');
	
	update_post_meta($newpost_id, 'address', '129-133 West 22nd Street'); 
	$rand_keys = array_rand($post_aear, 1);	
	update_post_meta($newpost_id, 'local-area', $post_aear[$rand_keys]); 
	update_post_meta($newpost_id, 'latitude', '40.7427704'); 
	update_post_meta($newpost_id, 'longitude','-73.99455039999998');
	$rand_keys = array_rand($post_city, 1);		
	update_post_meta($newpost_id, 'city', $post_city[$rand_keys]); 
	update_post_meta($newpost_id, 'postcode', '10011'); 
	update_post_meta($newpost_id, 'country', 'USA'); 
	update_post_meta($newpost_id, 'phone', '212245-4606'); 
	update_post_meta($newpost_id, 'fax', '212245-4606'); 
		
	update_post_meta($newpost_id, 'company_name', 'Apple Inc'); 
	update_post_meta($newpost_id, 'contact-email', 'test@test.com'); 
	update_post_meta($newpost_id, 'contact_web', 'www.e-plugin.com'); 
	update_post_meta($newpost_id, 'listing_contact_source', 'new_value'); 	
	update_post_meta($newpost_id, 'youtube', '0y4rXoWrJlw'); 
	
	update_post_meta($newpost_id, 'vacancy', '5'); 
	update_post_meta($newpost_id, 'job_type', 'Full Time'); 
	update_post_meta($newpost_id, 'jobbank_experience_range', '3 - <5 Years');	
	update_post_meta($newpost_id, 'salary', '$10000');
	update_post_meta($newpost_id, 'gender', 'Male');
	update_post_meta($newpost_id, 'jobbank_job_level', 'Mid Level'); 
	update_post_meta($newpost_id, 'educational_requirements', 'MBA');
	$date = date('Y-m-d', strtotime('+'.$i.' days'));
	update_post_meta($newpost_id, 'deadline', $date); 
	update_post_meta($newpost_id, 'job_education', 'Strong understanding of Java 8, Microservices, Spring-boot, API Development and AWS
Proficient in Core Java /J2EE technologies & Spring framework Experience in Pair programming'); 
	update_post_meta($newpost_id, 'job_must_have', '<ul><li>
Ability to work independently, with minimal supervision and guidance</li><li>
Experience using Docker to package and deploy web applications</li><li>
Experience with cloud-based web services and database systems (e.g. AWS, Google Cloud, Microsoft Azure)</li><li>
Familiarity with server-side programming (e.g. Node.js, Python)</li><li>
Experience customizing Content Management Systems</li><li>
Experience working in an agile environment</li><li>
Background in user experience and/or design</li><li>
Involvement in open source projects</li></ul>'); 
	
	// FAQ;
	update_post_meta($newpost_id, 'faq_title0', 'What is the best way to apply for a position at Microsoft?');
	update_post_meta($newpost_id, 'faq_description0', 'Search and apply for a job on our Careers website. Once you’ve created a profile you’ll be able to quickly apply for additional openings, set-up job alerts, and view the status of your application(s).'); 
	
	update_post_meta($newpost_id, 'faq_title1', 'Can I apply for more than one job at the same time?');
	update_post_meta($newpost_id, 'faq_description1', 'Yes, you can apply for multiple openings.'); 
	
	update_post_meta($newpost_id, 'faq_title2', 'What is the rehire process for former Microsoft employees?');
	update_post_meta($newpost_id, 'faq_description2', 'The application process for a former Microsoft employee is the same as for other candidates.'); 
	
	update_post_meta($newpost_id, 'faq_title3', 'Do you have an employee referral program?');
	update_post_meta($newpost_id, 'faq_description3', 'We do have an employee referral program and encourage you to reach out to any friends or former colleagues who work at Microsoft so that they can submit your information.'); 
	
	update_post_meta($newpost_id, 'faq_title4', 'What is my application status?');
	update_post_meta($newpost_id, 'faq_description4', 'You’ll typically meet with three to six people for up to an hour each.'); 
	
	update_post_meta($newpost_id, 'other_benefits', 'As per company policy');  
 $i++; 
}

// /// **** Create Home Page ******	
	$page_title='Home';
	$page_name='home';
	$page_content='[depicter id="9"]';
	$my_post_form = array(
	'post_title'    => wp_strip_all_tags( $page_title),
	'post_name'    => wp_strip_all_tags( $page_name),
	'post_content'  => $page_content,
	'post_status'   => 'publish',
	'post_author'   =>  get_current_user_id(),	
	'post_type'		=> 'page',
	);
	$newpost_id= wp_insert_post( $my_post_form );	

?>