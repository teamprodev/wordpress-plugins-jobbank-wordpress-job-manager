<?php	
	global $wpdb, $post;
	global $current_user;	
	$main_class = new eplugins_jobbank;
	wp_enqueue_script("jquery");
	wp_enqueue_style('jquery-ui', ep_jobbank_URLPATH . 'admin/files/css/jquery-ui.css');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_style('bootstrap', ep_jobbank_URLPATH . 'admin/files/css/iv-bootstrap.css');
	wp_enqueue_style('jobbank-my-account-css', ep_jobbank_URLPATH . 'admin/files/css/my-account.css');
	wp_enqueue_script('bootstrap.min', ep_jobbank_URLPATH . 'admin/files/js/bootstrap.min-4.js');
	wp_enqueue_script('popper', 		ep_jobbank_URLPATH . 'admin/files/js/popper.min.js');
	
	// Map openstreet
	wp_enqueue_script('leaflet', ep_jobbank_URLPATH . 'admin/files/js/leaflet.js');
	wp_enqueue_style('leaflet', ep_jobbank_URLPATH . 'admin/files/css/leaflet.css');
	wp_enqueue_script('leaflet-geocoder-locationiq', ep_jobbank_URLPATH . 'admin/files/js/leaflet-geocoder-locationiq.min.js');		
	wp_enqueue_style('leaflet-geocoder-locationiq', ep_jobbank_URLPATH . 'admin/files/css/leaflet-geocoder-locationiq.min.css');
	$jobbank_directory_url=get_option('ep_jobbank_url');					
	if($jobbank_directory_url==""){$jobbank_directory_url='job';}
	$curr_post_id=$post->ID;
	
	$current_post = $curr_post_id;
	$post_edit = get_post($curr_post_id); 
?>		
<div class="bootstrap-wrapper">
	<div id="profile-account2"  class="container">				
		<div class="row">
			<div class=" col-md-12">																
				<div class=" col-md-6" id="post_image_div10">	
					<?php $feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $curr_post_id ), 'thumbnail' );
						if(isset($feature_image[0])){ ?>
						<img title="profile image" class=" img-responsive rounded "  src="<?php  echo esc_url($feature_image[0]); ?>">
						<?php
						}
						$feature_image_id=get_post_thumbnail_id( $curr_post_id );
					?>
				</div> 
				<div class=" form-group col-md-6">											
					<div class="" id="post_image_edit">	
						<button type="button" onclick="jobbank_edit_post_image('post_image_div10');"  class="btn btn-xs green-haze"><?php  esc_html_e('Feature Image / Company Logo','jobbank'); ?> </button>
					</div>									
				</div>								
			</div>	
		
			
			<div class="clearfix"></div>								
			<div class=" col-md-12">																
				<div class=" col-md-6" id="post_image_topbaner">	
					<?php 
						$topbanner=get_post_meta($post_edit->ID,'topbanner', true);
						if(trim($topbanner)!=''){ 
							$jobbank_topbanner_image = wp_get_attachment_url($topbanner );
						?>
						<img title="image" class=" img-responsive rounded " src="<?php  echo esc_url($jobbank_topbanner_image); ?>">
						<?php
						}
						
					?>
				</div> 
				<div class=" form-group col-md-6">											
					<div class="" id="topbanner_image_edit">
						<button type="button" onclick="jobbank_topbanner_image('post_image_topbaner');"  class="btn btn-xs green-haze"><?php  esc_html_e('Top Banner[best fit 1200X400]','jobbank'); ?> </button>
					</div>									
				</div>								
			</div>	
			<input type="hidden" name="topbanner_image_id" id="topbanner_image_id" value="<?php echo esc_attr($topbanner); ?>">	
			<div class="col-md-12">	 
				<div class="form-group">
					<label for="text" class="control-label"><h4><?php  esc_html_e('Education & Experience','jobbank'); ?> </h4> </label>
					<?php
						$content=get_post_meta($post_edit->ID,'job_education', true);
						$settings_a = array(															
						'textarea_rows' =>8,
						'editor_class' => 'form-control'															 
						);
						$editor_id = 'content_education';
						wp_editor( $content, $editor_id,$settings_a );										
					?>
				</div>
				<div class="form-group">
					<label for="text" class="control-label"><h4><?php  esc_html_e('Must Have','jobbank'); ?> </h4> </label>
					<?php
						$content=get_post_meta($post_edit->ID,'job_must_have', true);
						$settings_a = array(															
						'textarea_rows' =>8,
						'editor_class' => 'form-control'															 
						);
						$editor_id = 'content_must_have';
						wp_editor( $content, $editor_id,$settings_a );										
					?>
				</div>	
				<span class="caption-subject">														
					<?php  esc_html_e('External form URL e.g. Google Form link(if any) ','jobbank'); ?>
				</span>
				<hr/>								
				<div class=" form-group ">	
					<input type="text" class="form-control col-md-12" name="external_form_url" id="external_form_url" value="<?php echo esc_url(get_post_meta($post_edit->ID,'external_form_url',true)); ?>" placeholder="<?php  esc_html_e('External form URL','jobbank'); ?>">				
				</div>
				<h4>														
					<?php  esc_html_e('Contact Info','jobbank'); ?>
				</h4>
				<hr/>
				<?php
					$listing_contact_source=get_post_meta($post_edit->ID,'listing_contact_source',true);
					if($listing_contact_source==''){$listing_contact_source='user_info';}
				?>
				<div class=" form-group">	
					<div class="radio">											
						<label><input type="radio" name="contact_source" value="user_info"  <?php echo ($listing_contact_source=='user_info'?'checked':''); ?> > <?php  esc_html_e(' Use The company Info ->','jobbank'); ?> <?php echo ucfirst($current_user->display_name); ?><?php  esc_html_e(' : Logo, Email, Phone, Website','jobbank'); ?> <a href="<?php echo get_permalink().'?profile=setting';?>" target="_blank"> <?php  esc_html_e('Edit','jobbank'); ?> </a></label>
					</div>
					<div class="radio">
						<label><input type="radio" name="contact_source" value="new_value" <?php echo ($listing_contact_source=='new_value'?'checked':''); ?>><?php  esc_html_e(' New Contact Info','jobbank'); ?>  </label>
					</div>
				</div>
				
				
				<div  class="row" id="new_contact_div" <?php echo ($listing_contact_source=='user_info'?'class="displaynone"':''); ?> >
					<div class=" form-group col-md-6">																
						<div class="col-md-3" id="post_image_div">	
							<?php $feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $curr_post_id ), 'thumbnail' );
								if(isset($feature_image[0])){ ?>
								<img title="profile image" class=" img-responsive" src="<?php  echo esc_url($feature_image[0]); ?>">
								<?php
								}else{ ?>
								<a href="javascript:void(0);" onclick="jobbank_edit_post_image('post_image_div');"  >
									<?php  echo '<img src="'. ep_jobbank_URLPATH.'assets/images/image-add-icon.png">'; ?>
								</a>
								<?php
								}
								$feature_image_id=get_post_thumbnail_id( $curr_post_id );
							?>
						</div> 
						
						<div class="col-md-3" id="post_image_edit">	
							<button type="button" onclick="jobbank_edit_post_image('post_image_div');"  class="btn btn-xs green-haze"><?php  esc_html_e('Add/Edit Company Logo','jobbank'); ?> </button>
						</div>									
					</div>										
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Company Name','jobbank'); ?></label>						
						<input type="text" class="form-control" name="company_name" id="company_name" value="<?php echo esc_html(get_post_meta($post_edit->ID,'company_name',true)); ?>" placeholder="<?php  esc_attr_e('Company name','jobbank'); ?>">
					</div>
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Phone','jobbank'); ?></label>						
						<input type="text" class="form-control" name="phone" id="phone" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'phone',true)); ?>" placeholder="<?php  esc_attr_e('Enter Phone Number','jobbank'); ?>">
					</div>
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Email Address','jobbank'); ?></label>
						<input type="text" class="form-control" name="contact-email" id="contact-email" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'contact-email',true)); ?>" placeholder="<?php  esc_html_e('Enter Email Address','jobbank'); ?>">
					</div>
					<div class=" form-group col-md-12">
						<label for="text" class=" control-label"><?php  esc_html_e('Address autocomplete helper','jobbank'); ?></label>
						<div id="map"></div>
						<div id="search-box" ></div>	
					</div>
					
					<div class=" form-group col-md-12">
						<label for="text" class=" control-label"><?php  esc_html_e('Address (Save in the listing field)','jobbank'); ?></label>						
						<input type="text" class="form-control" name="address" id="address" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'address',true)); ?>"  placeholder="<?php  esc_html_e('Enter Address','jobbank'); ?>">
					</div>
									
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('City','jobbank'); ?></label>
						<input type="text" class="form-control" name="city" id="city" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'city',true)); ?>" placeholder="<?php  esc_attr_e('Enter city','jobbank'); ?>">
					</div>	
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('State','jobbank'); ?></label>
						<input type="text" class="form-control" name="state" id="state" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'state',true)); ?>" placeholder="<?php  esc_attr_e('Enter State','jobbank'); ?>">
					</div>	
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Zipcode/Postcode','jobbank'); ?></label>
						<input type="text" class="form-control" name="postcode" id="postcode" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'postcode',true)); ?>" placeholder="<?php  esc_attr_e('Enter Zipcode/Postcode','jobbank'); ?>">
					</div>	
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Country','jobbank'); ?></label>
						<input type="text" class="form-control" name="country" id="country" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'country',true)); ?>" placeholder="<?php  esc_attr_e('Enter Country','jobbank'); ?>">
					</div>
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Latitude ','jobbank'); ?></label>
						<input type="text" class="form-control" name="latitude" id="latitude" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'latitude',true)); ?>" placeholder="<?php  esc_attr_e('Enter Latitude','jobbank'); ?>">
					</div>	
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Longitude','jobbank'); ?></label>
						<input type="text" class="form-control" name="longitude" id="longitude" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'longitude',true)); ?>" placeholder="<?php  esc_attr_e('Enter Longitude','jobbank'); ?>">
					</div>	
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Web Site','jobbank'); ?></label>
						<input type="text" class="form-control" name="contact_web" id="contact_web" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'contact_web',true)); ?>"  placeholder="<?php  esc_attr_e('Enter Web Site','jobbank'); ?>">
					</div>
				</div>
				<input type="hidden" name="feature_image_id" id="feature_image_id" value="<?php echo esc_attr($feature_image_id); ?>">
				<hr/>
				<h4>												
					<?php  esc_html_e('Job information','jobbank'); ?>
				</h4>
				<hr/>	
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-6  form-group">
						<label for="text" class=" control-label"><?php  esc_html_e('Educational Requirements','jobbank'); ?></label>
						<input type="text" class="form-control" name="educational_requirements" id="educational_requirements" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'educational_requirements',true)); ?>" placeholder="<?php  esc_attr_e('Bachelor Degree','jobbank'); ?>">								
					</div>
					<div class="  form-group col-md-6">
						<label for="text" class="  control-label"><?php  esc_attr_e('Job Nature','jobbank'); ?></label>
						<select name="job_type" class="form-control ">		
							<?php
								$jobbank_job_status=get_post_meta($post_edit->ID,'job_type',true);
								$jobbank_job_status_all=get_option('jobbank_job_status');					
								if($jobbank_job_status_all==""){$jobbank_job_status_all='Full Time, Part Time,Freelance, Hourly, Project Base';}
								$jobbank_job_status_all_arr= explode(',',$jobbank_job_status_all);
								foreach($jobbank_job_status_all_arr as $jobbank_job_statusone){ 
									if(!empty($jobbank_job_statusone)){
										echo' <option '. ($jobbank_job_status ==$jobbank_job_statusone ? 'selected':'' ).' value="'.trim($jobbank_job_statusone).'">'.esc_html__($jobbank_job_statusone,'jobbank').'</option>';
									}
								}											
							?>	
						</select>									
					</div>
					<div class="  form-group col-md-6">
						<label for="text" class="  control-label"><?php  esc_html_e('Job Level','jobbank'); ?></label>
						<select name="jobbank_job_level" class="form-control ">		
							<?php
								$jobbank_job_level=trim(get_post_meta($post_edit->ID,'jobbank_job_level',true));
								$jobbank_job_level_all=get_option('jobbank_job_level');					
								if($jobbank_job_level_all==""){$jobbank_job_level_all='Any, Entry Lavel, Mid Level, Top Level';}
								$jobbank_job_level_arr= explode(',',$jobbank_job_level_all);
								foreach($jobbank_job_level_arr as $jobbank_job_statusone){ 
									if(!empty($jobbank_job_statusone)){													
										echo' <option '. (trim($jobbank_job_level) ==trim($jobbank_job_statusone) ? 'selected':'' ).' value="'.trim(esc_attr($jobbank_job_statusone)).'">'.esc_html__($jobbank_job_statusone,'jobbank').'</option>';
									}
								}											
							?>	
						</select>									
					</div>
					<div class="  form-group col-md-6">
						<label for="text" class="  control-label"><?php  esc_html_e('Experience Range','jobbank'); ?></label>
						<select name="jobbank_experience_range" class="form-control ">		
							<?php
								$jobbank_experience_range_select=trim(get_post_meta($post_edit->ID,'jobbank_experience_range',true));
								$jobbank_experience_range=get_option('jobbank_experience_range');					
								if($jobbank_experience_range==""){$jobbank_experience_range='Any,Below 1 Year,1 - 3 Years,3 - 5 Years,5 - 10 Years,Over 10 Years';}
								$job_arr= array_filter(explode(',',$jobbank_experience_range));
								foreach($job_arr as $job_1){ 
									if(!empty($job_1)){
										echo'<option '.(trim($jobbank_experience_range_select)==trim($job_1) ? ' selected':'' ).' value="'.trim(esc_attr($job_1)).'">'.$job_1.'</option>';
									}
								}											
							?>	
						</select>														
					</div>
					<div class="  form-group col-md-6">
						<label for="text" class="  control-label"><?php  esc_html_e('Age Range','jobbank'); ?></label>
						<select name="age_range" class="form-control ">		
							<?php
								$age_range_select=trim(get_post_meta($post_edit->ID,'age_range',true));
								$age_range=get_option('age_range');					
								if($age_range==""){$age_range=esc_html__('Any, Below 20 years, 20 - < 30 Years, 30 - < 40 Years,40 - < 50 Years,Over 50 Years','jobbank');}
								$job_arr= explode(',',$age_range);
								foreach($job_arr as $jobbank_job_statusone){ 
									if(!empty($jobbank_job_statusone)){
										echo' <option '. ($age_range_select ==$jobbank_job_statusone ? 'selected':'' ).' value="'.trim(esc_attr($jobbank_job_statusone)).'">'.$jobbank_job_statusone.'</option>';
									}
								}											
							?>	
						</select>														
					</div>
					<div class=" col-md-6 form-group">
						<label for="text" class=" control-label"><?php  esc_html_e('Gender','jobbank'); ?></label>
						<select name="gender"  class="form-control">
							<option value="Any" <?php echo ( get_post_meta($post_edit->ID,'gender',true)=='Any'? ' selected':''); ?> ><?php  esc_html_e('Any','jobbank'); ?></option>
							<option value="Male" <?php echo ( get_post_meta($post_edit->ID,'gender',true)=='Male'? ' selected':''); ?> ><?php  esc_html_e('Male','jobbank'); ?></option>
							<option value="Female" <?php echo ( get_post_meta($post_edit->ID,'gender',true)=='Female'? ' selected':''); ?>><?php  esc_html_e('Female','jobbank'); ?></option>
						</select>
					</div>
					<div class="col-md-6  form-group">
						<label for="text" class=" control-label"><?php  esc_html_e('Vacancy','jobbank'); ?></label>
						<input type="text" class="form-control" name="vacancy" id="vacancy" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'vacancy',true));?>" placeholder="<?php  esc_html_e('Enter Vacancy, e.g : 2','jobbank'); ?>">								
					</div>
					<div class=" col-md-6 form-group">
						<label for="text" class=" control-label"><?php  esc_html_e('Application Deadline','jobbank'); ?></label>
						<input type="text" readonly class="form-control" name="deadline" id="deadline" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'deadline',true));?>" >
					</div>	
					<div class=" col-md-6 form-group">
						<label for="text" class=" control-label"><?php  esc_html_e('Workplace','jobbank'); ?></label>
						<input type="text" class="form-control" name="workplace"  value="<?php echo esc_attr(get_post_meta($post_edit->ID,'workplace',true));?>"  placeholder="<?php  esc_html_e('Office, Work from Home','jobbank'); ?>">
					</div>
					<div class="col-md-6  form-group">
						<label for="text" class=" control-label"><?php  esc_html_e('Offered Salary','jobbank'); ?></label>
						<input type="text" class="form-control" name="salary" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'salary',true));?>">								
					</div>
					<div class="col-md-12  form-group">
						<label for="text" class=" control-label"><?php  esc_html_e('Compensation & Other Benefits','jobbank'); ?></label>
						<input type="text" class="form-control" name="other_benefits" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'other_benefits',true));?>">								
					</div>
				</div>
				<h4 >	
					<?php  esc_html_e('Videos ','jobbank'); ?>
				</h4>
				<hr/>
				
					<div class="row">
						<div class=" col-md-6 form-group">
							<label for="text" class=" control-label"><?php  esc_html_e('Youtube','jobbank'); ?></label>
							<input type="text" class="form-control" name="youtube" id="youtube" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'youtube',true));?>" placeholder="<?php  esc_html_e('Enter Youtube video ID, e.g : bU1QPtOZQZU ','jobbank'); ?>">
						</div>
						<div class="col-md-6  form-group">
							<label for="text" class=" control-label"><?php  esc_html_e('vimeo','jobbank'); ?></label>
							<input type="text" class="form-control" name="vimeo" id="vimeo" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'vimeo',true));?>" placeholder="<?php  esc_html_e('Enter vimeo ID, e.g : 134173961','jobbank'); ?>">								
						</div>
					</div>	
					
				<h4>											
					<?php  esc_html_e('Image Gallery','jobbank'); ?>
				</h4>
				<hr/>
				<div class="form-group ">	
					<div class="col-md-12" id="gallery_image_div">
					</div>									
				</div>
				<div class="row">										
					<div class="  form-group col-md-12">	
						<?php
							$gallery_ids=get_post_meta($curr_post_id ,'image_gallery_ids',true);
							$gallery_ids_array = array_filter(explode(",", $gallery_ids));
						?>
						<input type="hidden" name="gallery_image_ids" id="gallery_image_ids" value="<?php echo esc_attr($gallery_ids); ?>">
						<div class="row" id="gallery_image_div">
							<?php
								if(sizeof($gallery_ids_array)>0){
									foreach($gallery_ids_array as $slide){
									?>
									<div id="gallery_image_div<?php echo esc_html($slide);?>" class="col-md-2"><img  class="img-responsive"  src="<?php echo wp_get_attachment_url( $slide ); ?>"><button type="button" onclick="jobbank_remove_gallery_image('gallery_image_div<?php echo esc_html($slide);?>', <?php echo esc_html($slide);?>);"  class="btn btn-sm btn-danger"><?php esc_html_e('X','jobbank'); ?> </button> </div>
									<?php
									}
								}
							?>
						</div>
						<button type="button" onclick="jobbank_edit_gallery_image('gallery_image_div');"  class="btn btn-xs green-haze"><?php  esc_html_e('Add Images','jobbank'); ?></button>
					</label>						
				</div>
			</div>
			<hr/>
			<h4>	
				<?php  esc_html_e('More Details ','jobbank'); ?>
			</h4>								
			<hr/>
			<div class="row" id="jobbank_fields">
				<?php	
					$currentCategory=wp_get_object_terms( $post_edit->ID, $jobbank_directory_url.'-category');
					$post_cats=array();
					foreach($currentCategory as $c){
						array_push($post_cats,$c->slug);
					}														
					echo ''.$main_class->jobbank_listing_fields($post_edit->ID,$post_cats  );
				?>	
			</div>
			<span class="caption-subject">					
				<?php  esc_html_e('FAQs ','jobbank'); ?>
			</span>								
			<hr/>
			<div class="row">
				<?php							
					include( ep_jobbank_template. 'private-profile/profile-add-edit-faq.php');						
				?>		
			</div>
			<h4>												
				<?php  esc_html_e('Button Setting','jobbank'); ?>
			</h4>
			<hr/>
			<?php											
				
				$dir_style5_email=get_option('dir_style5_email');	
				if($dir_style5_email==""){$dir_style5_email='yes';}
				if($dir_style5_email=="yes"){
					$dirpro_email_button=get_post_meta($post_edit->ID,'dirpro_email_button',true);
					if($dirpro_email_button==""){$dirpro_email_button='yes';}
				?>	
				<div class="form-group row ">
					<label  class="col-md-4 control-label"> <?php  esc_html_e('Contact Button','jobbank');  ?></label>
					<div class="col-md-3">
						<label>												
							<input type="radio" name="dirpro_email_button" id="dirpro_email_button" value='yes' <?php echo ($dirpro_email_button=='yes' ? 'checked':'' ); ?> > <?php  esc_html_e('Show Contact Button','jobbank');  ?>
						</label>	
					</div>
					<div class="col-md-5">	
						<label>											
							<input type="radio"  name="dirpro_email_button" id="dirpro_email_button" value='no' <?php echo ($dirpro_email_button=='no' ? 'checked':'' );  ?> > <?php  esc_html_e('Hide Contact Button','jobbank');  ?>
						</label>
					</div>	
				</div>		
				<?php
				}	
			?>								
		</div>
	</div>
	<input type="hidden" name="listing_data_submit" id="listing_data_submit" value="yes">
</div>
</div>
<!-- END PROFILE CONTENT -->
<?php
	$save_address=get_post_meta($curr_post_id ,'address',true);
	$my_theme = wp_get_theme();
	$theme_name= strtolower($my_theme->get( 'Name' ));
	wp_enqueue_script('jobbank_add-edit-listing', ep_jobbank_URLPATH . 'admin/files/js/add-edit-listing.js');
	wp_localize_script('jobbank_add-edit-listing', 'realpro_data', array(
	'ajaxurl' 					=> admin_url( 'admin-ajax.php' ),
	'loading_image'			=> '<img src="'.ep_jobbank_URLPATH.'admin/files/images/loader.gif">',
	'current_user_id'		=>get_current_user_id(),
	'Set_Feature_Image'	=> esc_html__('Set Feature Image','jobbank'),
	'Set_plan_Image'		=> esc_html__('Set Image ','jobbank'),
	'Set_Event_Image'		=> esc_html__(' Set Image ','jobbank'),
	'Gallery Images'		=> esc_html__('Gallery Images','jobbank'),
	'save_address'			=>$save_address,
	'permalink'					=> get_permalink(),
	'dirwpnonce'				=> wp_create_nonce("addlisting"),
	'theme_name'				=> $theme_name,
	) );
	
	 					