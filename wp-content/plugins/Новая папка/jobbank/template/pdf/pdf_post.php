<?php
	if(isset($_REQUEST['jobbankpdfpost'])){ 
		global $html_pdf;
		global $current_user;
		$pdfpost_id='';$footer_html='';$header='';
		$current_lang="en";
		$lang=get_bloginfo("language");
		$language_array= explode("-",$lang);
		if(isset($language_array[0])){
			$current_lang=$language_array[0];
		}
		ob_clean();
		require ( ep_jobbank_ABSPATH. 'inc/vendor/autoload.php');
		$user_id=1;
		if(isset($_REQUEST['jobbankpdfpost'])){
			$author_name= sanitize_text_field($_REQUEST['jobbankpdfpost']);
			$user = get_user_by( 'id', $author_name );
			if(isset($user->ID)){
				$user_id=$user->ID;
				$display_name=$user->display_name;
				$email=$user->user_email;
			}
		}	
	    $epfit_margin_left = '15';
		$epfit_margin_right ='15';
		$epfit_margin_top = '10';
		$epfit_margin_bottom = '30';
		$epfit_margin_header = '15';
		$mpdf_config = apply_filters('epfit_mpdf_config',[              
		'format'            => 'A4',
		'margin_left'       => $epfit_margin_left,
		'margin_right'      => $epfit_margin_right,
		'margin_top'        => $epfit_margin_top,
		'margin_bottom'     => $epfit_margin_bottom,
		'margin_header'     => $epfit_margin_header,  
		'fontdata' => [
		'frutiger' => [
		'R' => 'Roboto-Light.ttf',
		'I' => 'Roboto-LightItalic.ttf',
		'B' => 'Roboto-Bold.ttf',
		'BI' => 'Roboto-BoldItalic.ttf',
		]
		],
		'default_font' => 'Roboto'
		]);
		$mpdf = new \Mpdf\Mpdf( $mpdf_config );
		$footer_html='';
		$postid=$_REQUEST['jobbankpdfpost'];	
		$jobid=$postid;
		$name_display=get_the_title($postid);
		$footer_html=''.get_bloginfo();
		$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'large' );
		if(isset($feature_image[0])){
			$feature_img =$feature_image[0];			
			}else{
			$feature_img= ep_jobbank_URLPATH."assets/images/job.png";
		}
		$dir_detail= get_post($postid); 
		$user_id=$dir_detail->post_author;
		$user_info = get_userdata( $user_id);		
		$listing_contact_source=get_post_meta($postid,'listing_contact_source',true);
		if($listing_contact_source==''){$listing_contact_source='user_info';}
		if($listing_contact_source=='new_value'){
			$client_email_address = get_post_meta($postid, 'contact-email',true);
			$phone=get_post_meta($postid, 'phone',true);
			$web=get_post_meta($postid, 'contact_web',true);
			$address=get_post_meta($postid,'address',true);
			}else{
			$client_email_address =$user_info->user_email;
			$phone=get_user_meta($user_id, 'phone',true);
			$web=get_user_meta($user_id, 'website',true);
			$address=get_user_meta($user_id,'address',true).' '.get_user_meta($user_id,'city',true).' '.get_user_meta($user_id,'postcode',true).' '.get_user_meta($user_id,'country',true);
		}
		$header = '	';
		$default_fields = array();
		$i=1;
		$html_pdf=$html_pdf.'<body style="font-family: Helvetica; font-size: 11pt;"><table  class="tableContainer" style="border-collapse: collapse;width:100%;"   ><tr>		
		<td scope="row" style="text-align: left;width:50%"><h2>'. $name_display .'</h2><br/>'.$address.' <br/> '.$client_email_address.'<br/>'. esc_html__('Phone','jobbank').' : '.esc_attr($phone).'  <br/> '. esc_html__('Web','jobbank').' : '.$web.'</td>	
		<td scope="row" style="text-align: right;width:50%"><img height="150px" src="'.$feature_img.'"></td>	
		</tr></table>';
		$html_pdf=$html_pdf.'<table  class="tableContainer" style="border-collapse: collapse;width:100%;"   >
		<tr><td><h4>'. esc_html__('Job Summary','jobbank').'</h4><hr></td></tr>
		<tr><td>'.esc_html__('Vacancy','jobbank').' : '.get_post_meta($jobid,'vacancy', true).'<br></td></tr>
		<tr><td>	'.esc_html__('Deadline','jobbank').' : '.date('M d, Y', strtotime(get_post_meta($jobid,'deadline', true))).'<br></td></tr>
		<tr><td>	'.esc_html__('Published','jobbank').' : '.get_the_date('M d, Y', $jobid).'<br></td></tr>
		<tr><td>	'.esc_html__('Employment Status','jobbank').' : '.get_post_meta($jobid,'job_type', true).'<br></td></tr>
		<tr><td>	'.esc_html__('Experience','jobbank').' : '.get_post_meta($jobid,'jobbank_experience_range', true).'<br></td></tr>
		<tr><td>	'.esc_html__('Salary','jobbank').' : '. get_post_meta($jobid,'salary', true).'<br></td></tr>
		<tr><td>	'.esc_html__('Gender','jobbank').' : '.get_post_meta($jobid,'gender', true).'<br></td></tr>
		<tr><td>	'.esc_html__('Career Level','jobbank').' : '.get_post_meta($jobid,'jobbank_job_level', true).'<br></td></tr>
		<tr><td>	'.esc_html__('Qualification','jobbank').' : '.get_post_meta($jobid,'educational_requirements', true).'<br><br></td></tr>			
		';
		$html_pdf=$html_pdf.'<tr >		
		<td scope="row" style="text-align: left;width:100%,"><br/><h4>'. esc_html__('Job Description','jobbank').'</h4><hr>'.$dir_detail->post_content.'</td>
		</tr>';		 
		$html_pdf=$html_pdf.'<tr>		
		<td scope="row" style="text-align: left;width:100%"><br/><h4>'. esc_html__('Education & Experience','jobbank').'</h4><hr>'.get_post_meta($jobid,'job_education', true).'</td>
		</tr>';
		$html_pdf=$html_pdf.'<tr>		
		<td scope="row" style="text-align: left;width:100%"><br/><h4>'. esc_html__('Must Have','jobbank').'</h4><hr>'.get_post_meta($jobid,'job_must_have', true).'</td>
		</tr>';
		$html_pdf=$html_pdf.'<tr>		
		<td scope="row" style="text-align: left;width:100%"><br/><h4>'. esc_html__('Educational Requirements','jobbank').'</h4><hr>'.get_post_meta($jobid,'educational_requirements', true).'</td>
		</tr>';
		$html_pdf=$html_pdf.'<tr>		
		<td scope="row" style="text-align: left;width:100%"><br/><h4>'. esc_html__('Compensation & Other Benefits','jobbank').'</h4><hr>'.get_post_meta($jobid,'other_benefits', true).'</td>
		</tr>';
		$html_pdf=$html_pdf.'</table></body>';
		$stylesheet = file_get_contents(ep_jobbank_URLPATH . 'admin/files/css/pdf.css');		
		$mpdf->setFooter(''.$footer_html.', Page # {PAGENO}');	
		$mpdf->WriteHTML($html_pdf);
		$mpdf->Output();
		exit;
	}
?>