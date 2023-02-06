<?php
	wp_enqueue_script('jobbank_edit_resume_js', ep_jobbank_URLPATH . 'admin/files/js/edit_resume.js');
	wp_enqueue_script('jobbank_candidate_resume_js', ep_jobbank_URLPATH . 'admin/files/js/candidate_edit_resume.js');
?>
<div class="border-bottom pb-15 mb-3 toptitle-sub"><?php esc_html_e('My Resume', 'jobbank'); ?>
</div>


	<form role="form" name="profile_setting_form" id="profile_setting_form" action="#">
    <section class="box-admin edit-profile">
		<div class="body-box-admin">
			<div class="row mb-3">
				<div class="col-md-4">
					<div class="upload-avatar">
						<div class="avatar" id="profile_image_main">
							<?php
								$iv_profile_pic_url=get_user_meta($current_user->ID, 'jobbank_profile_pic_thum',true);
								if($iv_profile_pic_url!=''){ ?>
								<img class="rounded-profileimg" src="<?php echo esc_url($iv_profile_pic_url); ?>">
								<?php
									}else{
									echo'	 <img class="rounded-profileimg" src="'. ep_jobbank_URLPATH.'assets/images/default-user.png">';
								}
							?>
						</div>
						</div>
				</div>	
				<div class="col-md-8">
						<div class="upload">
							<div class="btn-upload">
								<button type="button" onclick="jobbank_edit_profile_image('profile_image_main');"  class="btn btn-small-ar">
								<?php esc_html_e('Change Image','jobbank'); ?> </button>
							</div>
						</div>
				</div>
				
					<div class="col-md-4 mt-3">	
		<?php
			$topbanner=get_user_meta($current_user->ID,'topbanner', true);
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
		<div class="avatar" id="banner_image_main">
			<?php					
				echo'<img src="'. esc_url($default_image_banner).'">';
			?>
		</div>
	</div>		
	<div class="col-md-8 mt-3">	
		<button type="button" onclick="jobbank_edit_banner_image('banner_image_main');"  class="btn btn-small-ar">
		<?php esc_html_e('Change Banner [best fit: 1200 X 400]','jobbank'); ?> </button>
	</div>
	<input type="hidden" name="topbanner_url" id="topbanner_url" value="<?php echo esc_url($default_image_banner); ?>">	
	<input type="hidden" name="topbanner" id="topbanner_id" value="<?php echo esc_attr($topbanner); ?>">
	
					
			</div>		
			<div class="row">
						<?php
		$default_fields = array();
		$field_set=get_option('jobbank_profile_fields' );
		if($field_set!=""){
			$default_fields=get_option('jobbank_profile_fields' );
		}else{
			$default_fields['full_name']='Full Name';	
			$default_fields['phone']='Phone Number';
			$default_fields['mobile']='Mobile Number';
			$default_fields['address']='Address';
			$default_fields['city']='City';
			$default_fields['zipcode']='Zipcode';
			$default_fields['state']='State';
			$default_fields['country']='Country';										
			$default_fields['job_title']='Job title';									
			$default_fields['hourly_rate']='Hourly Rate';
			$default_fields['experience']='Experience';
			$default_fields['age']='Age';
			$default_fields['qualification']='Qualification';								
			$default_fields['gender']='Gender';	
			$default_fields['website']='Website Url';
			$default_fields['description']='About';
		}
		
		$field_type_roles=  	get_option( 'jobbank_field_type_roles' );			
		$myaccount_fields_array=  get_option( 'jobbank_myaccount_fields' );							
		$user = new WP_User( $current_user->ID );
		$i=1;
		foreach ( $default_fields as $field_key => $field_value ) { 		
			if(isset($myaccount_fields_array[$field_key])){ 
				if($myaccount_fields_array[$field_key]=='yes'){
					$role_access='no';
				
					if(in_array('all',$field_type_roles[$field_key] )){
						$role_access='yes';
					}
					if(in_array('administrator',$field_type_roles[$field_key] )){
						$role_access='yes';
					}
					if(in_array('candidate',$field_type_roles[$field_key] )){
						$role_access='yes';
					}
					if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
						foreach ( $user->roles as $role ){
							if(in_array($role,$field_type_roles[$field_key] )){
							$role_access='yes';
							}
							if('administrator'==$role){
								$role_access='yes';
							}
						}
					}	
					if($role_access=='yes'){
						echo  $main_class->jobbank_check_field_input_access($field_key, $field_value, 'myaccount', $current_user->ID );
					}
				}
			}else{ 
				echo  $main_class->jobbank_check_field_input_access($field_key, $field_value, 'myaccount', $current_user->ID );
			}
		}
	?>
			</div>

		</div>


	</section>

	<section class="box-admin edit-profile">
		<div class="body-box-admin">
			<div class="form-group not-forty boxshadow">
				<label><?php  esc_html_e('Cover Letter/Objective','jobbank');?></label>
				<?php
					$content=get_user_meta($current_user->ID,'coverletter',true);
					$settings_a = array(
					'textarea_rows' =>8,
					'editor_class' => 'form-control',
					);
					$content_client =$content;
					$editor_id = 'coverletter';
					wp_editor($content_client, $editor_id,$settings_a );
				?>

			</div>
		</div>
	</section>
	
	<section class="box-admin edit-profile">
		<div class="body-box-admin">
			<div class="form-group not-forty boxshadow">
				<label><?php  esc_html_e('Industries','jobbank');?></label>
					<select name="company_type" id="company_type" class="form-control">								
					<?php
					$argscat = array(
					'type'                     => $jobbank_directory_url,
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => true,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'include'                  => '',
					'number'                   => '',
					'taxonomy'                 => $jobbank_directory_url.'-category',
					'pad_counts'               => false
					);
					$categories = get_categories( $argscat );
					$category_input_array= array();
					if(isset($_REQUEST['category_input'])){
						$category_input_array=$_REQUEST['category_input'];
					}						
					if ( $categories && !is_wp_error( $categories ) ) :
					foreach ( $categories as $term ) {
						if(trim($term->name)!=''){	
							$selected='';
							if( get_user_meta($current_user->ID,'company_type',true)==$term->name){
								$selected='selected';
							}
							?>
							<option value="<?php echo esc_attr($term->name);?>" <?php echo esc_html($selected); ?> ><?php echo esc_html($term->name);?></option>					
						<?php
						}
					}
					endif;
				?>
			</select>	
			</div>
		</div>
	</section>

	<section class="box-admin edit-profile">
		<div class="body-box-admin">
		<label><?php  esc_html_e('Professional Skills','jobbank');?></label>
			<div class="my-skill" id="myskill-parent">				
				<div class="container-skill">	
				<div class="row form-group">
				<?php
					
					
					$args2 = array(
					'type'                     => $jobbank_directory_url,									
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 0,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'include'                  => '',
					'number'                   => '',
					'taxonomy'                 => $jobbank_directory_url.'-tag',
					'pad_counts'               => false
					);
					$main_tag = get_categories( $args2 );
								
				$tags_user= get_user_meta($current_user->ID,'professional_skills',true); 				
				$tags_user_arr=  array_filter( explode(",", $tags_user), 'strlen' );
				if ( $main_tag && !is_wp_error( $main_tag ) ) :
					foreach ( $main_tag as $term ) {
						$checked='';
						if(in_array( $term->slug,$tags_user_arr)){
							$checked=' checked'; 					
						}
						
					?>
						<div class="col-md-4">
						 <label class="form-group">
							 <input type="checkbox" name="professional_skills[]" id="professional_skills[]" value="<?php echo esc_attr($term->slug); ?>" <?php echo esc_html($checked);?> > <?php echo esc_html($term->name); ?> </label>
						</div>
					<?php
					}					
				endif;
				?>
				</div>
				
				<div class=" form-group">
					<label for="text" class=" control-label"><?php esc_html_e('Add New Professional Skills','jobbank'); ?></label>
					<div class="  ">
						<input type="text" class="form-control" name="new_professional_skills" id="new_professional_skills" value="" placeholder="<?php esc_html_e('Separate with commas','jobbank'); ?>">
					</div>
				</div>
				
				
				
				
			  </div>
				
			</div>
		</div>
	</section>

	<div class="header-box-admin border-btm">
		<h3 class="lighter-heading"><?php  esc_html_e('Education','jobbank');?></h3>
	</div>
	<div class="wrapperForClone">
		<section class="box-admin edit-profile" id="educationsection" >
			<div class="body-box-admin">
				<div class="row boxshadow" >
					<div class="col-lg-12">
						<div class="trash text-right">
							<a class="buttonremove btn btn-small-ar"><i class="far fa-trash-alt"></i></a>
						</div>
						<div class="form-group">
							<label><?php  esc_html_e('Education Title','jobbank');?></label>
							<input class="form-control" placeholder="Diploma in Graphics Design" name="educationtitle[]">
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label><?php  esc_html_e('Start Year','jobbank');?></label>
									<input class="form-control" placeholder="2001" name="edustartdate[]">

								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label><?php  esc_html_e('End Year','jobbank');?></label>
									<input class="form-control" placeholder="2005" name="eduenddate[]">

								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label><?php  esc_html_e('Institute','jobbank');?></label>
									<input class="form-control" placeholder="Graphic Arts Institute" name="institute[]">
								</div>
							</div>
							<div class="col-12 not-forty">
								<div class="form-group">
									<label><?php  esc_html_e('Description','jobbank');?></label>
									<textarea  rows="7" class="form-control" placeholder="" name="edudescription[]"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php
	$aw=0;
	 for($i=0;$i<20;$i++){
		 if(get_user_meta($current_user->ID,'educationtitle'.$i,true)!=''){?>
			<section class="box-admin edit-profile" id="educationsection" >
				<div class="body-box-admin">
				<div class="row boxshadow" >
					<div class="col-lg-12">
						<div class="trash text-right">
							<a class="buttonremove btn btn-small-ar"><i class="far fa-trash-alt"></i></a>
						</div>
						<div class="form-group">
							<label><?php  esc_html_e('Education Title','jobbank');?></label>
							<input class="form-control" placeholder="Diploma in Graphics Design" name="educationtitle[]" value="<?php
							echo esc_attr(get_user_meta($current_user->ID,'educationtitle'.$i,true)); ?>">
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label><?php  esc_html_e('Start Year','jobbank');?></label>
									<input class="form-control" placeholder="2001" name="edustartdate[]" value="<?php
							echo esc_attr(get_user_meta($current_user->ID,'edustartdate'.$i,true)); ?>">

								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label><?php  esc_html_e('End Year','jobbank');?></label>
									<input class="form-control" placeholder="2005" name="eduenddate[]" value="<?php
							echo esc_attr(get_user_meta($current_user->ID,'eduenddate'.$i,true)); ?>">

								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label><?php  esc_html_e('Institute','jobbank');?></label>
									<input class="form-control" placeholder="Graphic Arts Institute" name="institute[]" value="<?php
							echo esc_attr(get_user_meta($current_user->ID,'institute'.$i,true)); ?>">
								</div>
							</div>
							<div class="col-12 not-forty">
								<div class="form-group">
									<label><?php  esc_html_e('Description','jobbank');?></label>
									<textarea rows="7" class="form-control" placeholder="" name="edudescription[]"><?php
							echo esc_attr(get_user_meta($current_user->ID,'edudescription'.$i,true)); ?></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	<?php
		 }
	 }
	?>
	<div id="addmoreedu" class="mt-5">
	</div>

	<a id="education_add"  onclick="jobbank_education_more2();"  class="btn btn-small-ar">
		<i class="fas fa-plus-circle"></i> <?php  esc_html_e('More Education','jobbank');?>
	</a>


	<!-- EXPERIENCE & SKILL -->

	<div class="header-box-admin border-btm mt-5">
		<h3 class='lighter-heading'><?php  esc_html_e('Work & Experience','jobbank');?> </h3>
	</div>
	<?php			
	 for($i=0;$i<30;$i++){
		 if(get_user_meta($current_user->ID,'experience_title'.$i,true)!=''){?>
		<section class="box-admin edit-profile" >
			<div class="body-box-admin">
				<div class="row">
					<div class="col-lg-12" id="position_root">
						<div class="trash text-right">
							<a class="buttonremove2 btn btn-small-ar"><i class="far fa-trash-alt"></i></a>
						</div>
						<div class="form-group">
							<label><?php  esc_html_e('Position Title','jobbank');?></label>
							<input class="form-control" name="experience_title[]" value="<?php
							echo esc_attr(get_user_meta($current_user->ID,'experience_title'.$i,true)); ?>" >
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label><?php  esc_html_e('Start Year','jobbank');?></label>
									<input class="form-control" placeholder="2001" name="experience_start[]" value="<?php
							echo esc_attr(get_user_meta($current_user->ID,'experience_start'.$i,true)); ?>">

								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label><?php  esc_html_e('End Year','jobbank');?></label>
									<input class="form-control" placeholder="2005" name="experience_end[]" value="<?php
							echo esc_attr(get_user_meta($current_user->ID,'experience_end'.$i,true)); ?>">
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label><?php  esc_html_e('Company','jobbank');?></label>
									<input class="form-control" name="experience_company[]"  value="<?php
							echo esc_attr(get_user_meta($current_user->ID,'experience_company'.$i,true)); ?>" >
								</div>
							</div>
							<div class="col-12 not-forty">
								<div class="form-group">
									<label><?php  esc_html_e('Description','jobbank');?></label>
									<textarea rows="7" class="form-control" name="experience_description[]" placeholder=""><?php
							echo esc_attr(get_user_meta($current_user->ID,'experience_description'.$i,true)); ?></textarea>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</section>
	
		
	<?php
		 }
	 }	 
	?>
	
	<div class="wrapperForClone">	
		<section class="box-admin edit-profile" id="expsection">
			<div class="body-box-admin">
				<div class="row">
					<div class="col-lg-12" id="position_root">
						<div class="trash text-right">
							<a class="buttonremove2 btn btn-small-ar"><i class="far fa-trash-alt"></i></a>
						</div>
						<div class="form-group">
							<label><?php  esc_html_e('Position Title','jobbank');?></label>
							<input class="form-control" name="experience_title[]" placeholder="Lead UI/UX Designer">
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label><?php  esc_html_e('Start Year','jobbank');?></label>
									<input class="form-control" placeholder="2001" name="experience_start[]">

								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label><?php  esc_html_e('End Year','jobbank');?></label>
									<input class="form-control" placeholder="2005" name="experience_end[]">
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label><?php  esc_html_e('Company','jobbank');?></label>
									<input class="form-control" name="experience_company[]" placeholder="Graphicreeeo CO">
								</div>
							</div>
							<div class="col-12 not-forty">
								<div class="form-group">
									<label><?php  esc_html_e('Description','jobbank');?></label>
									<textarea rows="7" class="form-control" name="experience_description[]" placeholder=""></textarea>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</section>
	
	</div>
	<div id="addmoreexp" class="mt-5"></div>
	<a id="exp_add"  onclick="jobbank_exp_more2();"  class="btn btn-small-ar">
		<i class="fas fa-plus-circle"></i> <?php  esc_html_e('More Experience','jobbank');?>
	</a>


	<!-- AWARDS AND HONOR -->
	<div class="header-box-admin border-btm mt-5">
		<h3 class='lighter-heading'><?php  esc_html_e('Honors & Awards','jobbank');?> </h3>
	</div>
	<?php	
	 for($i=0;$i<20;$i++){
		 if(get_user_meta($current_user->ID,'award_title'.$i,true)!=''){?>
			<section class="box-admin edit-profile" >
			<div class="body-box-admin">
				<div class="row">
					<div class="col-lg-12" id="position_root">
						<div class="trash text-right">
							<a class="buttonremove3 btn btn-small-ar"><i class="far fa-trash-alt"></i></a>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label><?php  esc_html_e('Award Title','jobbank');?></label>
									<input class="form-control" placeholder="" name="award_title[]" value="<?php
							echo esc_attr(get_user_meta($current_user->ID,'award_title'.$i,true)); ?>">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label><?php  esc_html_e('Year','jobbank');?></label>
									<input class="form-control"  name="award_year[]" value="<?php
							echo esc_attr(get_user_meta($current_user->ID,'award_year'.$i,true)); ?>">
								</div>
							</div>
							<div class="col-12 not-forty">
								<div class="form-group">
									<label><?php  esc_html_e('Description','jobbank');?></label>
									<textarea rows="7" class="form-control" name="award_description[]" placeholder=""><?php
							echo esc_attr(get_user_meta($current_user->ID,'award_description'.$i,true)); ?></textarea>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</section>
		 <?php
		 }
	 }	 
		 ?>
	<div class="wrapperForClone">
		<section class="box-admin edit-profile" id="awardsection">
			<div class="body-box-admin">
				<div class="row">
					<div class="col-lg-12" id="position_root">
						<div class="trash text-right">
							<a class="buttonremove3 btn btn-small-ar"><i class="far fa-trash-alt"></i></a>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label><?php  esc_html_e('Award Title','jobbank');?></label>
									<input class="form-control" placeholder="" name="award_title[]">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label><?php  esc_html_e('Year','jobbank');?></label>
									<input class="form-control"  name="award_year[]">
								</div>
							</div>
							<div class="col-12 not-forty">
								<div class="form-group">
									<label><?php  esc_html_e('Description','jobbank');?></label>
									<textarea rows="7" class="form-control" name="award_description[]" placeholder=""></textarea>
								</div>
							</div>
						</div>
					</div>				
				</div>
			</div>
		</section>
	</div>
	<div id="addmoreaward" class="mt-5"></div>
	<a id="award_add"  onclick="jobbank_award_more2();"  class="btn btn-small-ar">
		<i class="fas fa-plus-circle"></i> <?php  esc_html_e('Add More','jobbank');?>
	</a>

	<!-- LANGUAGES -->
	<div class="header-box-admin border-btm mt-5">
		<h3 class='lighter-heading'><?php  esc_html_e('Languages','jobbank');?> </h3>
	</div>
	<section class="box-admin edit-profile">
		<div class="body-box-admin">
		
		<?php
		for($i=0;$i<5;$i++){	
		?>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label><?php  esc_html_e('Language Name','jobbank');?></label>
								<input class="form-control" placeholder="English" name="language[]" value="<?php echo esc_attr(get_user_meta($current_user->ID,'language'.$i,true)); ?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label><?php  esc_html_e('Level','jobbank');?></label>
								<select class="form-control" id="exampleFormControlSelect1" name="language_level[]">
									<option value="Beginner" <?php echo (get_user_meta($current_user->ID,'language_level'.$i,true)=='Beginner'? "selected":''); ?> ><?php esc_html_e('Beginner','jobbank');?></option>
									<option value="Intermediate" <?php echo (get_user_meta($current_user->ID,'language_level'.$i,true)=='Intermediate'? "selected":''); ?> ><?php  esc_html_e('Intermediate','jobbank');?></option>
									<option value="Proficient" <?php echo (get_user_meta($current_user->ID,'language_level'.$i,true)=='Proficient'? "selected":''); ?> ><?php  esc_html_e('Proficient','jobbank');?></option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		<?php
		}
		?>			
	
		</div>
	</section>

	<div class="" id="update_message"></div>
	<a id="update" type="button" onclick="jobbank_update_profile_setting();"  class="btn green-haze">
		<i class="fas fa-database"></i> <?php  esc_html_e('Update','jobbank');?>
	</a>

	</form>

