<?php
	wp_enqueue_script("jquery");	
	wp_enqueue_style('bootstrap', ep_jobbank_URLPATH .'admin/files/css/iv-bootstrap.css');
	wp_enqueue_style('jobbank-public-css', ep_jobbank_URLPATH . 'admin/files/css/profile-public.css');
	wp_enqueue_style('all-awesome', ep_jobbank_URLPATH . 'admin/files/css/all.min.css');
	wp_enqueue_style('colorbox', ep_jobbank_URLPATH . 'admin/files/css/colorbox.css');
	wp_enqueue_script('colorbox', ep_jobbank_URLPATH . 'admin/files/js/jquery.colorbox-min.js');
	$jobbank_directory_url=get_option('ep_jobbank_url');
	if($jobbank_directory_url==""){$jobbank_directory_url='job';}
	$display_name='';
	$email='';
	$current_page_permalink='';
	$user_id=1;
	$main_class = new eplugins_jobbank;
	if(isset($_REQUEST['id'])){
		$author_name= sanitize_text_field($_REQUEST['id']);
		$user = get_user_by( 'ID', $author_name );
		if(isset($user->ID)){
			$user_id=$user->ID;
			$display_name=$user->display_name;
			$email=$user->user_email;
		}
		}else{
		global $current_user;
		$user_id=$current_user->ID;
		$display_name=$current_user->display_name;
		$email=$current_user->user_email;
		$author_name= $current_user->ID;
		if($user_id==0){
			$user_id=1;
		}
	}
	$iv_profile_pic_url=get_user_meta($user_id, 'jobbank_profile_pic_thum',true);
	$topbanner=get_user_meta($user_id,'topbanner', true);
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
	$active_single_fields_saved=get_option('jobbank_single_fields_saved' );	
	if(empty($active_single_fields_saved)){$active_single_fields_saved=jobbank_get_listing_fields_all_single();}	
?>
<div class="bootstrap-wrapper " id="">
	<input type="hidden" id="profileID" value="<?php echo esc_attr($user_id); ?>">
	<div class="container ">
		<section class="section ">   		
			<div class=" banner-hero banner-image-single mt-1" style="background:url(<?php echo esc_url($default_image_banner); ?>) no-repeat; background-size:cover;">
			</div>
			<div class="row mt-2">
				<div class="col-lg-7 col-md-12 ">					
					<h2 class="title-detail mr-2 "><?php echo get_user_meta($user_id,'full_name',true); ?>
						<?php
							if(get_user_meta($user_id,'city',true)!=''){
							?>
							<span class="card-location ">
								<i class="fa-solid fa-location-dot mr-1"></i><?php echo get_user_meta($user_id,'city',true); ?>
							</span>
							<?php
							}
						?>
					</h2>
					<?php
					if(get_user_meta($user_id,'tagline',true)!=""){
					?>
					<div class="mt-0  font-tag_line "><?php echo get_user_meta($user_id,'tagline',true); ?></span> 				
					</div>
				  <?php
					}
				  $default_fields['job_title']='Job title';									
					$default_fields['hourly_rate']='Hourly Rate';
					$default_fields['experience']='Experience';
					$default_fields['age']='Age';
					$default_fields['qualification']='Qualification';								
					$default_fields['gender']='Gender';	
				  ?>
			
				  <?php
				 if(get_user_meta($user_id,'job_title',true)!=""){
					?>
					<div class="mt-0  top-subtitle mr-2"><?php echo get_user_meta($user_id,'job_title',true); ?></span> 				
					</div>
				  <?php
					}
				  ?>
				    <?php
				 if(get_user_meta($user_id,'experience',true)!=""){ 
					?>
					<div class="mt-0  top-subtitle mr-2"><i class="fa-solid fa-business-time mr-1"></i><?php echo get_user_meta($user_id,'experience',true); ?></span> 				
					</div>
				  <?php
					}
				  ?>
				 <?php
					if(get_user_meta($user_id,'experience',true)!=""){
					?>
					<div class="mt-0  top-subtitle mr-2"> <i class="fa-solid fa-graduation-cap mr-1"></i><?php echo get_user_meta($user_id,'qualification',true); ?></span> 				
					</div>
				  <?php
					}
				  ?>
				 <?php
					if(get_user_meta($user_id,'gender',true)!=""){
					?>
					<div class="mt-0  mr-2 top-subtitle"><i class="fa-regular fa-user mr-1"></i> <?php echo get_user_meta($user_id,'gender',true); ?></span> 				
					</div>
				  <?php
					}
				  ?>
				   <?php
					if(get_user_meta($user_id,'phone',true)!=""){
					?>
					<div class="mt-0  mr-2 top-subtitle"><i class="fa-solid fa-phone mr-1"></i> <?php echo get_user_meta($user_id,'phone',true); ?></span> 				
					</div>
				  <?php
					}
				  ?>
				  
			</div>
			<div class="col-lg-5 col-md-12 text-lg-end ">
				<div class="btn-feature text-right">
					<a class=" btn btn-border  mr-1 " href="<?php echo get_permalink($current_page_permalink);?>?&jobbankpdfcv=<?php echo esc_attr($user_id);?>" target="_blank"><?php esc_html_e('PDF', 'jobbank'); ?></a>
					
					<button class="btn btn-big " onclick="jobbank_candidate_email_popup('<?php echo esc_attr($user_id);?>')">
					<?php esc_html_e('Message', 'jobbank'); ?></button>
					<?php
						$current_ID = get_current_user_id();
						$favourites='no';
						if($current_ID>0){
							$my_favorite = get_post_meta($user_id,'jobbank_profilebookmark',true);											
							$all_users = explode(",", $my_favorite);
							if (in_array($current_ID, $all_users)) {
								$favourites='yes';
							}
						}
						$added_to_Boobmark=esc_html__('Saved', 'jobbank');
						$add_to_Boobmark=esc_html__('Save', 'jobbank');
					?>
					<button id="candidatebookmark" class="btn  <?php echo ($favourites=='yes'?'btn btn-big ':'btn btn-border' ); ?> ml-1"  title="<?php echo ($favourites=='yes'? $added_to_Boobmark: $add_to_Boobmark ); ?>" ><i class="far fa-heart"></i></button>
				</div>		
			</div>
		</div>
		<div class="border-bottom pt-10 pb-10"></div>  
	</section>
	<div class="row mt-5">
		<div class="col-lg-8 col-md-12 col-sm-12 col-12">
			<div class="job-overview">					
				<div class="border-bottom pb-15 mb-3 toptitle"><?php esc_html_e('About', 'jobbank'); ?>
				</div>
				<div class=" row col-md-12 content-single  mb-4">
					<?php
						$content= get_user_meta($user_id,'description',true);								
						$content = apply_filters('the_content', $content);
						$content = str_replace(']]>', ']]&gt;', $content);
						echo wpautop($content);
					?>												
				</div>
					<?php
						if(get_user_meta($user_id,'educationtitle0',true)!='' Or get_user_meta($user_id,'educationtitle1',true)!=''){?>
						
						<div class="border-bottom pb-15 mb-3 toptitle"><?php esc_html_e('Education', 'jobbank'); ?>
						</div>	
							<?php					   
								for($i=0;$i<20;$i++){
									if(get_user_meta($user_id,'educationtitle'.$i,true)!=''){?>
									
									<div class="row " >										
										<div class="col-md-12">
											<span class="font-md"><?php echo esc_html(get_user_meta($user_id,'educationtitle'.$i,true)); ?>
											</span>
											<span class="content-single "><span><i class=" ml-2 fa-solid fa-building-columns "></i>
											 <?php echo get_user_meta($user_id,'institute'.$i,true); ?></span></span>
											
											<span class="content-single "><span><i class=" ml-1 fa-regular fa-clock mr-1"></i><?php
											echo esc_html(get_user_meta($user_id,'edustartdate'.$i,true)); ?> - <?php
											echo get_user_meta($user_id,'eduenddate'.$i,true); ?></span></span>
											</div>											
											<div class="col-12 "><span class="content-single"> <?php
												echo wpautop(get_user_meta($user_id,'edudescription'.$i,true)); ?></span>
											</div>
										</div>
									<?php
									}
								}
						}
						?>
						<?php
						if(get_user_meta($user_id,'experience_title0',true)!='' OR get_user_meta($user_id,'experience_title1',true)!=''){?>
							<div class="border-bottom pb-15 mb-3 toptitle mt-3"><?php esc_html_e('Work & Experiance', 'jobbank'); ?>
						</div>					
						<?php			
							for($i=0;$i<30;$i++){
								if(get_user_meta($user_id,'experience_title'.$i,true)!=''){?> 
								<div class="row " >										
									<div class="col-md-12">
										<span class="font-md"><?php echo esc_html(get_user_meta($user_id,'experience_title'.$i,true)); ?>
										</span>
										<span class="content-single "><span><i class=" ml-2 fa-solid fa-building"></i>
										 <?php echo get_user_meta($user_id,'experience_company'.$i,true); ?></span></span>
										
										<span class="content-single"><span><i class=" ml-1 fa-regular fa-clock mr-1"></i><?php
										echo esc_html(get_user_meta($user_id,'experience_start'.$i,true)); ?> - <?php
										echo get_user_meta($user_id,'experience_end'.$i,true); ?></span></span>
									</div>											
									<div class="col-12 "><span class="content-single"> <?php
											echo wpautop(get_user_meta($user_id,'experience_description'.$i,true)); ?></span>
									</div>
								</div>									
								<?php
								}
							}
						}
						?>	
						
						<?php
						if(get_user_meta($user_id,'award_title0',true)!='' OR get_user_meta($user_id,'award_title1',true)!=''){?>
							<div class="border-bottom pb-15 mb-3 toptitle mt-3"><?php esc_html_e('Honors & Awards', 'jobbank'); ?>
						</div>					
						<?php			
							for($i=0;$i<30;$i++){
								if(get_user_meta($user_id,'award_title'.$i,true)!=''){?> 
								<div class="row  " >										
									<div class="col-md-12">
										<span class="font-md"><?php echo esc_html(get_user_meta($user_id,'award_title'.$i,true)); ?>
										</span>
										<span class="content-single "><span><i class=" ml-1 fa-regular fa-clock mr-1"></i><?php
										echo esc_html(get_user_meta($user_id,'award_year'.$i,true)); ?></span></span>
									</div>											
									<div class="col-12 "><span class="content-single"> <?php
											echo wpautop(get_user_meta($user_id,'award_description'.$i,true)); ?></span>
									</div>
								</div>									
								<?php
								}
							}
						}
						?>
						<?php
						if(trim(get_user_meta($user_id,'professional_skills',true))!=''){?>
							<div class="border-bottom pb-15 mb-3 toptitle mt-3"><?php esc_html_e('Professional Skill', 'jobbank'); ?>
						</div>							
						<?php
							$tags_user= get_user_meta($user_id,'professional_skills',true); 				
							$tags_user_arr=  array_filter( explode(",", $tags_user), 'strlen' );
							foreach ( $tags_user_arr as $tag ) {
							?>
							<span class="btn btn-small mr-1 mb-2"><?php echo esc_html(ucwords(str_replace('-',' ',$tag)));?></span>
							<?php
							}						
						}
						?>
						<?php
							if(get_user_meta($user_id,'language0',true)!='' OR get_user_meta($user_id,'language1',true)!=''){?>
							<div class="border-bottom pb-15 mb-3 toptitle mt-3"><?php esc_html_e('Languages', 'jobbank'); ?>
							</div>
									<?php
										for($i=0;$i<5;$i++){	
										 if(get_user_meta($user_id,'language'.$i,true)!=''){
										?>
										<div class="row">
											<div class="col-sm-3">
												<span class="font-md">
												<?php echo get_user_meta($user_id,'language'.$i,true); ?>
												</span>			
											</div>		
											<div class="col-sm-9">													
												<span class="content-single"><?php echo esc_html(get_user_meta($user_id,'language_level'.$i,true));?></span>
											</div>
										</div>
										<?php
										 }
										}
									?>													
											
						<?php
						}
						?>
						
						
			</div>			
			<?php
				include(ep_jobbank_template . '/profile-public/footer_share.php');  
			?>
		</div>
		<div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
			<div class="sidebar-border">
				<div class="sidebar-heading pb-15 ">
					<div class="avatar-sidebar">
						<?php	
							$company_name= get_user_meta($user_id,'full_name', true);
							$company_address= get_user_meta($user_id,'address', true);
							$company_web=get_user_meta($user_id,'website', true);
							$company_phone=get_user_meta($user_id,'phone', true);
							$company_logo=get_user_meta($user_id, 'jobbank_profile_pic_thum',true);
							if(array_key_exists('company-logo',$active_single_fields_saved)){ 
								if(trim($company_logo)!=''){
								?>
								<figure><img alt="image" src="<?php echo esc_url($company_logo); ?>"></figure>
								<?php
								}else{?>
								<figure class="blank-rounded-logo"></figure>
								<?php
								}
							}
						?>
						<div class="sidebar-info"><span class="toptitle"><?php echo esc_html($company_name); ?></span>
							<?php
								if(!empty(get_user_meta($user_id,'city',true))){
								?>
								<div class="top-subtitle-right mt-2"><i class="fa-solid fa-location-dot mr-2"></i><?php echo get_user_meta($user_id,'city',true); ?>
								</div>
								<?php
								} 
								if(get_user_meta($user_id,'hourly_rate',true)!=""){
								?>
								<div class="top-subtitle-right mt-1"><i class="fa-regular fa-money-bill-1 mr-1"></i><?php echo get_user_meta($user_id,'hourly_rate',true); ?>								
								</div>
							  <?php
								}
								
								?>
								
						
							
							
							  
						</div>
					</div>
				</div>
				<div class="sidebar-list-job">
					<div class="box-map mt-4">				  
						<iframe width="100%" height="325" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo esc_attr($company_address); ?>&amp;ie=UTF8&amp;&amp;output=embed"></iframe>
					</div>
					<ul class="ul-disc ml-3">
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
						<?php if($email!=''){  ?>
							<li><?php esc_html_e('Email','jobbank'); ?> : <?php echo esc_html($email); ?></li>
							<?php
							}
						?>
						<?php if($company_web!=''){  ?>
							<li><a href="<?php echo esc_url($company_web); ?>"  target="_blank" ><?php echo esc_url($company_web); ?></a></li>
							<?php
							}
						?>
						
						
					</ul>
				</div>
			</div>
			<?php
				include(ep_jobbank_template.'/listing/single-template/similar-jobs.php');
					
			?>
		</div>
	</div>		
</div>
</div>

<?php
	$currencyCode = get_option('jobbank_api_currency');
	wp_enqueue_script('jobbank_public-profile', ep_jobbank_URLPATH . 'admin/files/js/public-profile.js');
	wp_localize_script('jobbank_public-profile', 'jobbank1', array(
	'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
	'loading_image'		=> '<img src="'.ep_jobbank_URLPATH.'admin/files/images/loader.gif">',
	'wp_iv_directories_URLPATH'		=> ep_jobbank_URLPATH,
	'current_user_id'	=>get_current_user_id(),
	'dirwpnonce'=> wp_create_nonce("myaccount"),
	"Please_login"=>  esc_html__('Please Login','jobbank'), 
	'Add_to_Boobmark'=>esc_html__('Add to Boobmark', 'jobbank' ),
	'Added_to_Boobmark'=>esc_html__('Added to Boobmark', 'jobbank' ),	
	
	) );
	
	wp_enqueue_script('jobbank_message', ep_jobbank_URLPATH . 'admin/files/js/user-message.js');
	wp_localize_script('jobbank_message', 'jobbank_data_message', array(
		'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
		'loading_image'		=> '<img src="'.ep_jobbank_URLPATH.'admin/files/images/loader.gif">',		
		'Please_put_your_message'=>esc_html__('Please put your name,email & message', 'jobbank' ),
		'contact'=> wp_create_nonce("contact"),
		'listing'=> wp_create_nonce("listing"),
		) );
