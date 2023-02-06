<?php
	get_header();
	wp_enqueue_script("jquery");
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_style('bootstrap', 			ep_jobbank_URLPATH . 'admin/files/css/iv-bootstrap.css');
	wp_enqueue_style('fontawesome', 			ep_jobbank_URLPATH . 'admin/files/css/fontawesome.css');
	wp_enqueue_style('jquery.fancybox', ep_jobbank_URLPATH . 'admin/files/css/jquery.fancybox.css');
	wp_enqueue_style('colorbox', ep_jobbank_URLPATH . 'admin/files/css/colorbox.css');
	wp_enqueue_style('jquery-ui', ep_jobbank_URLPATH . 'admin/files/css/jquery-ui.css');
	wp_enqueue_script('colorbox', ep_jobbank_URLPATH . 'admin/files/js/jquery.colorbox-min.js');	
	wp_enqueue_script('jquery.fancybox',ep_jobbank_URLPATH . 'admin/files/js/jquery.fancybox.js');
	/**************************** css resources from qdesk ********************************************/	
	wp_enqueue_style('jobbank_single-job', ep_jobbank_URLPATH . 'admin/files/css/single-job.css');	
	/*************************************************************************************************************/
	$main_class = new eplugins_jobbank;
	$jobbank_directory_url=get_option('ep_jobbank_url');
	if($jobbank_directory_url==""){$jobbank_directory_url='job';}
	global $post,$wpdb, $current_user;
	$favorite_icon='';
	$jobid = get_the_ID();
	$post_id_1 = get_post($jobid);
	$post_id_1->post_title;
	$active_single_fields_saved=get_option('jobbank_single_fields_saved' );	
	if(empty($active_single_fields_saved)){$active_single_fields_saved=jobbank_get_listing_fields_all_single();}	
	$single_page_icon_saved=get_option('jobbank_single_icon_saved' );		
	$wp_directory= new eplugins_jobbank();
	while ( have_posts() ) : the_post();
	$currentCategory = $main_class->jobbank_get_categories_caching($jobid,$jobbank_directory_url);
	$cat_name2='';
	if(isset($currentCategory[0]->slug)){										
		foreach($currentCategory as $c){						
			$cat_name2 = $cat_name2. $c->name.' / ';
		}
	}
	$listing_contact_source=get_post_meta($jobid,'listing_contact_source',true);
	if($listing_contact_source==''){$listing_contact_source='user_info';}
	if($listing_contact_source=='new_value'){
		$company_logo='';
		}else{
		$company_logo='';
	}
	// View Count***
	$current_count=get_post_meta($jobid,'job_views_count',true);
	$current_count=(int)$current_count+1;
	update_post_meta($jobid,'job_views_count',$current_count);
	$data_for_top=array();	
	$data_for_top['category']='category';	
	$data_for_top['deadline']='deadline';
	$data_for_top['type']='job_type';
	$data_for_top['level']='jobbank_job_level';
	$data_for_top['gender']='gender';
	$data_for_top['experience']='jobbank_experience_range';
	$data_for_top['age']='age_range';
	$data_for_top['post_date']='post_date';
	$data_for_top['salary']='salary';	
	$data_for_top['vacancy']='vacancy';
	$data_not_for_all_section=array();	
	$data_not_for_all_section['title']='title';
	$data_not_for_all_section['address']='address';
	$data_not_for_all_section['top-image']='top-image';
	$data_not_for_all_section['category']='category';
	$data_not_for_all_section['apply_button']='apply_button';
	$data_not_for_all_section['contact_button']='contact_button';
	$data_not_for_all_section['pdf_button']='pdf_button';
	$data_not_for_all_section['favorite']='favorite';
	$data_not_for_all_section['simillar_listing']='simillar_listing';
	$dir_detail= get_post($jobid); 	
	$author_id=$dir_detail->post_author;
	$user_info = get_userdata( $author_id);
	$company_email =$user_info->user_email;	
	if($listing_contact_source=='new_value'){
		$company_name= get_post_meta($jobid, 'company_name',true);
		$company_address= get_post_meta($jobid, 'address',true);
		$company_web=get_post_meta($jobid, 'contact_web',true);
		$company_phone=get_post_meta($jobid, 'phone',true);
		$company_email= get_post_meta($jobid, 'contact-email',true);		
		if(has_post_thumbnail()){
			$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $jobid ), 'large' );
			if(isset($feature_image[0])){
				$company_logo =$feature_image[0];
			}
		}
		}else{ 
			$company_name= get_user_meta($author_id,'full_name', true);
			$company_address= get_user_meta($author_id,'address', true);
			$company_web=get_user_meta($author_id,'website', true);
			$company_phone=get_user_meta($author_id,'phone', true);
			$company_logo=get_user_meta($author_id, 'jobbank_profile_pic_thum',true);
	}	
?>
<!-- SLIDER SECTION -->
<div class="bootstrap-wrapper ">	
	<div class="container">
		<section class="section ">       
			<?php
				$topbanner=get_post_meta($jobid,'topbanner', true);
				if(trim($topbanner)!=''){					
					$default_image_banner = wp_get_attachment_url($topbanner );
				}else{
					if(get_option('jobbank_banner_defaultimage')!=''){
						$default_image_banner= wp_get_attachment_image_src(get_option('jobbank_banner_defaultimage'),'large');
						if(isset($default_image_banner[0])){									
							$default_image_banner=$default_image_banner[0] ;			
						}
						}else{
						$default_image_banner=ep_jobbank_URLPATH."/assets/images/banner.png";
					}
				}
				
			?>
			<?php			
			if(array_key_exists('top-image',$active_single_fields_saved)){ 				
			?>			
			<div class=" banner-hero banner-image-single mt-1" style="background:url(<?php echo esc_url($default_image_banner); ?>) no-repeat; background-size:cover;"></div>
			<?php
			}
			?>
			<div class="row mt-2">
				<div class="col-lg-7 col-md-12 mb-2">	
					<?php
						$saved_icon= jobbank_get_icon($single_page_icon_saved, 'title' ,'single');
					?>
					<h2 class="title-detail "><i class="<?php echo esc_html($saved_icon); ?> "></i> <?php echo get_the_title($jobid); ?></h2>
					<div class="mt-0 mb-15"><span class="card-briefcase"><?php
						$saved_icon= jobbank_get_icon($single_page_icon_saved, 'job_type' ,'single');
					?><i class="<?php echo esc_html($saved_icon); ?>"></i> <?php  echo esc_html(get_post_meta($id,'job_type',true)); ?></span> 
					<span class="card-time"><?php
						$saved_icon= jobbank_get_icon($single_page_icon_saved,'post_date', 'single');
					?><i class=" ml-2 <?php echo esc_html($saved_icon); ?>"></i><?php echo get_the_date( 'd F - Y g:i a ', $id ); ?></span>
					
					</div>
				</div>
				<div class="col-lg-5 col-md-12 text-lg-end ">
					<div class="btn-feature text-right">
							<?php
							$user_ID = get_current_user_id();
							$favourites='no';
							if($user_ID>0){
								$my_favorite = get_post_meta($id,'_favorites',true);
								$all_users = explode(",", $my_favorite);
								if (in_array($user_ID, $all_users)) {
									$favourites='yes';
								}
							}
							?>
							<?php
							$job_apply='no';
							$user_ID = get_current_user_id();
							$job_apply_all = get_user_meta($user_ID,'job_apply_all',true);
							$job_apply_all = explode(",", $job_apply_all);
							if (in_array($jobid, $job_apply_all)) {
								$job_apply='yes';
							}										
							?>
							<?php			
								if(array_key_exists('apply_button',$active_single_fields_saved)){ 				
							?>
							<button onclick="jobbank_apply_popup('<?php echo esc_attr($jobid);?>')" class="btn btn-big mr-2 mb-2">
								<?php 
									if($job_apply=='yes'){?>
									<i class="fa fa-check-circle"></i>
									<?php
									}
								?>
							<?php esc_html_e('Apply Now','jobbank'); ?></button>	
							<?php
							}
							?>
							
							<?php			
							if(array_key_exists('pdf_button',$active_single_fields_saved)){ 				
							?>							
							<a class=" btn btn-border  mr-2 mb-2" href="<?php echo get_permalink();?>?&jobbankpdfpost=<?php echo esc_attr($jobid);?>" target="_blank"><i class="fas fa-download"></i> <?php esc_html_e('PDF', 'jobbank'); ?></a>
							<?php
							}
							?>
							<?php			
							if(array_key_exists('favorite',$active_single_fields_saved)){ 				
									
								$favorite_icon= jobbank_get_icon($single_page_icon_saved, 'favorite', 'single');
								if($favorite_icon==''){
									$favorite_icon='far fa-heart';
								}else{
									$favorite_icon =str_replace('mr-2','',$favorite_icon );
								}
							?>
							<span id="fav_dir<?php echo esc_html($jobid); ?>">
								<?php
									if($favourites=='yes'){ ?>
									<button class="btn btn-big mb-2" data-placement="left" data-toggle="tooltip" title="<?php esc_html_e('Saved','jobbank'); ?>" href="javascript:;" onclick="jobbank_save_unfavorite('<?php echo esc_attr($jobid); ?>')" >
										<i class="<?php echo esc_html($favorite_icon); ?>" ></i>
									</button>
									<?php
										}else{
									?>
									<button class="btn btn-border mb-2" data-placement="left" data-toggle="tooltip" title="<?php esc_html_e('Save','jobbank'); ?>" href="javascript:;" onclick="jobbank_save_favorite('<?php echo esc_attr($jobid); ?>')" >
										<i class="<?php echo esc_html($favorite_icon); ?>" ></i>
									</button>
									<?php
									}
								?>
							</span>
							<?php
							}
						?>
					</div>		
				</div>
			</div>
			<div class="border-bottom pt-10 pb-10"></div>       
		</section>
		<div class="row mt-5">
			<div class="col-lg-8 col-md-12 col-sm-12 col-12">
				<?php
					include(ep_jobbank_template . '/listing/single-template/top-over-view.php');
				?>
			
				<div class="job-overview">
					<?php
						$saved_icon_cat='';
						if(is_array($active_single_fields_saved)){
							foreach($active_single_fields_saved  as $field_key => $field_value){
								$saved_icon= jobbank_get_icon($single_page_icon_saved, $field_key, 'single');
								if( !in_array($field_key,$data_for_top ) AND !in_array($field_key,$data_not_for_all_section) ){	 					
									switch ($field_key) {																
										case "description": 
									?>
									<div class="border-bottom pb-15 mb-3 toptitle"><i class="<?php echo esc_html($saved_icon); ?>"></i> <?php echo esc_html(ucwords(str_replace('_',' ',$field_key)));  ?></div>
									<div class=" row col-md-12  mb-4">
										<?php
											$content_post = get_post($jobid);
											$content = $content_post->post_content;
											$content = apply_filters('the_content', $content);
											$content = str_replace(']]>', ']]&gt;', $content);
											echo do_shortcode($content);
										?>												
									</div>
									<?php											
										break;
										case "video": 
										include(ep_jobbank_template . '/listing/single-template/video.php');
										break;
										case "tag": 
										include(ep_jobbank_template . '/listing/single-template/tags.php');
										break;
										case "location": 
										include(ep_jobbank_template . '/listing/single-template/locations.php');
										break;
										case "image-gallery": 
										include(ep_jobbank_template . '/listing/single-template/image-gallery.php');
										break;
										case "faq": 
										include(ep_jobbank_template . '/listing/single-template/faqs.php');
										break;
										default:
										if(get_post_meta($id,$field_key,true)!=''){
											$custom_meta_data=get_post_meta($id,$field_key,true);
											if(is_array($custom_meta_data)){
												$full_data='';
												foreach( $custom_meta_data as $one_data){
													$full_data=$full_data.'<span class="btn btn-small background-urgent btn-pink mr-1">'.$one_data.'</span>';
												}
												$custom_meta_data=$full_data;
											}
										?>
										<div class="border-bottom pb-15 mb-3 toptitle"><i class="<?php echo esc_html($saved_icon); ?>"></i>  <?php echo esc_html(ucwords(str_replace('_',' ',$field_key)));  ?></div>
										<div class="row col-md-12 mb-4"> <?php echo wp_kses($custom_meta_data,'post'); ?></div>											
										<?php	
										}
										break;
									}										
								}									
							}
						}								
					?>			 
				</div>
				
				 <?php
					include(ep_jobbank_template . '/listing/single-template/footer_share.php');  
				 ?>
			</div>
			<div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
				
				<div class="sidebar-border">
					
						<div class="row mb-4">
					
							<div class="col-4">
								<?php			
								if(array_key_exists('company-logo',$active_single_fields_saved)){ 
									if(trim($company_logo)!=''){
								?>
									<img alt="image" class="rounded-logo" src="<?php echo esc_url($company_logo); ?>">
								<?php
									}else{?>
										<div class="blank-rounded-logo-"></div>
									<?php
									}
								}
								?>
							</div>
								
							<div class="col-8">
								  <?php
									$location_array= wp_get_object_terms( $jobid,  $jobbank_directory_url.'-locations');
									$i=0;$company_locations='';
									foreach($location_array as $one_tag){	
										$company_locations= $company_locations.' '.esc_html($one_tag->name); 						
									}	
									?>
									<div class="row">
										
										<div class="col-12">	
											<span class="toptitle"><?php echo esc_html($company_name); ?></span>
										</div>
										
										<div class="col-12">	
											<?php
												if(!empty($company_locations)){
												?>
												<span class="card-location mt-2"><i class="fa-solid fa-location-dot mr-2"></i><?php echo esc_html($company_locations); ?>
												</span>
												<?php
												}
												$total_jobs= $main_class->jobbank_total_job_count($user_info->ID, $allusers='no' );
												?>
										</div>
										
										<div class="col-12">	
											<a class="link-underline mt-1 " href="<?php echo get_post_type_archive_link( $jobbank_directory_url ).'?employer='.esc_attr($user_info->ID); ?>">
													<?php echo esc_html($total_jobs);?> <?php esc_html_e('Open Jobs', 'jobbank'); ?>
												</a>
										</div>
									</div>	
									
							</div>
							
						</div>
						
			
					
				
					<div class="sidebar-list-job">
						<div class="box-map mt-4">				  
							<iframe width="100%" height="325" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo esc_attr($company_address); ?>&amp;ie=UTF8&amp;&amp;output=embed"></iframe>
						</div>
						<ul class="ul-disc">
							<?php if($company_address!=''){  ?>
							<li><?php echo esc_html($company_address); ?></li>
							<?php
							}
							?>
							<?php if($company_phone!=''){  ?>
							<li><?php esc_html_e('Phone','jobbank'); ?> : <?php echo esc_html($company_phone); ?></li>
							<?php
							}
							?>
							<?php if($company_email!=''){  ?>
							<li><?php esc_html_e('Email','jobbank'); ?> : <?php echo esc_html($company_email); ?></li>
							<?php
							}
							?>
							
						</ul>
					</div>
				</div>
			
				<?php
				if(array_key_exists('simillar_listing',$active_single_fields_saved)){
					include(ep_jobbank_template.'/listing/single-template/similar-jobs.php');			
				}
				?>
			</div>
		</div>
		
	
	</div>
</div>
<?php
	endwhile;
	wp_enqueue_script('jobbank_single-listing', ep_jobbank_URLPATH . 'admin/files/js/single-listing.js');
	wp_localize_script('jobbank_single-listing', 'jobbank_data', array(
	'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
	'loading_image'		=> '<img src="'.ep_jobbank_URLPATH.'admin/files/images/loader.gif">',
	'current_user_id'	=>get_current_user_id(),
	'Please_login'=>esc_html__('Please login', 'jobbank' ),
	'Add_to_Favorites'=>esc_html__('Save', 'jobbank' ),
	'Added_to_Favorites'=>esc_html__('Saved', 'jobbank' ),
	'Please_put_your_message'=>esc_html__('Please put your name,email Cover letter & attached file', 'jobbank' ),
	'contact'=> wp_create_nonce("contact"),
	'listing'=> wp_create_nonce("listing"),
	'cv'=> wp_create_nonce("Doc/CV/PDF"),
	'ep_jobbank_URLPATH'=>ep_jobbank_URLPATH,
	'favorite_icon'=>$favorite_icon,
	) );
	
	
?>
<?php
	wp_reset_query();
?>
<?php
	get_footer();
?>