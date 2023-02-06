<div class=" form-group">
	<label for="text" class=" control-label"><?php  esc_html_e('Job Title','jobbank'); ?></label>
	<div class="  "> 
		<input type="text" class="form-control" name="title" id="title" value="" placeholder="<?php  esc_html_e('Enter Title Here','jobbank'); ?>">
	</div>																		
</div>	

<div class="form-group">
	<label for="text" class="control-label"><?php  esc_html_e('Job Description','jobbank'); ?>  </label>
	<?php
		$settings_a = array(															
		'textarea_rows' =>8,
		'editor_class' => 'form-control'															 
		);
		$editor_id = 'new_post_content';
		wp_editor( '', $editor_id,$settings_a );										
	?>
</div>
<div class="form-group">
	<label for="text" class="control-label"><?php  esc_html_e('Education & Experience','jobbank'); ?>  </label>
	<?php
		$settings_a = array(															
		'textarea_rows' =>8,
		'editor_class' => 'form-control'															 
		);
		$editor_id = 'content_education';
		wp_editor( '', $editor_id,$settings_a );										
	?>
</div>
<div class="form-group">
	<label for="text" class="control-label"><?php  esc_html_e('Must Have','jobbank'); ?>  </label>
	<?php
		$settings_a = array(															
		'textarea_rows' =>8,
		'editor_class' => 'form-control'															 
		);
		$editor_id = 'content_must_have';
		wp_editor( '', $editor_id,$settings_a );										
	?>
</div>							
<div class="  form-group ">
	<label for="text" class="  control-label"><?php  esc_html_e('Status','jobbank'); ?>  </label>
	<select name="post_status" id="post_status"  class="form-control">
		<?php
			$jobbank_user_can_publish=get_option('jobbank_user_can_publish');	
			if($jobbank_user_can_publish==""){$jobbank_user_can_publish='yes';}	
			if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){?>
			<option value="publish"><?php esc_html_e('Publish','jobbank'); ?></option>
			<?php
			}
			if(isset($current_user->roles[0]) and $current_user->roles[0]!='administrator'){
				if($jobbank_user_can_publish=="yes"){
				?>
				<option value="publish"><?php esc_html_e('Publish','jobbank'); ?></option>
				<?php
				}
			}
		?>											
		<option value="pending"><?php esc_html_e('Pending Review','jobbank'); ?></option>
		<option value="draft" ><?php esc_html_e('Draft','jobbank'); ?></option>	
	</select>	
</div>										
<span class="caption-subject">														
	<?php  esc_html_e('External form URL e.g. Google Form link(if any) ','jobbank'); ?>
</span>
<hr/>								
<div class=" form-group ">	
	<input type="text" class="form-control col-md-12" name="external_form_url" id="external_form_url" value="" placeholder="<?php  esc_html_e('External form URL','jobbank'); ?>">				
</div>
<span class="caption-subject">														
	<?php  esc_html_e('Contact Info','jobbank'); ?>
</span>
<hr/>
<?php
	$listing_contact_source='';
	if($listing_contact_source==''){$listing_contact_source='user_info';}
?>

<div  class="row" id="new_contact_div" > 
	<div class=" form-group col-md-6">
		<label for="text" class=" control-label"><?php  esc_html_e('Company Name','jobbank'); ?></label>						
		<input type="text" class="form-control" name="company_name" id="company_name" value="" placeholder="<?php  esc_attr_e('Company name','jobbank'); ?>">
	</div>
	<div class=" form-group col-md-6">
		<label for="text" class=" control-label"><?php  esc_html_e('Phone','jobbank'); ?></label>						
		<input type="text" class="form-control" name="phone" id="phone" value="" placeholder="<?php  esc_attr_e('Enter Phone Number','jobbank'); ?>">
	</div>
	<input type="hidden" class="form-control" name="address" id="address" value=""  placeholder="<?php  esc_html_e('Enter Address','jobbank'); ?>">
	<div class=" form-group col-md-12">
		<label for="text" class=" control-label"><?php  esc_html_e('Address','jobbank'); ?></label>
		<div id="map"></div>
		<div id="search-box"></div>
		<div id="result"></div>
	</div>
	<div class=" form-group col-md-6">
		<label for="text" class=" control-label"><?php  esc_html_e('city','jobbank'); ?></label>
		<input type="text" class="form-control" name="city" id="city" value="" placeholder="<?php  esc_attr_e('Enter city','jobbank'); ?>">
	</div>	
	<div class=" form-group col-md-6">
		<label for="text" class=" control-label"><?php  esc_html_e('State','jobbank'); ?></label>
		<input type="text" class="form-control" name="state" id="state" value="" placeholder="<?php  esc_attr_e('Enter State','jobbank'); ?>">
	</div>	
	<div class=" form-group col-md-6">
		<label for="text" class=" control-label"><?php  esc_html_e('Zipcode/Postcode','jobbank'); ?></label>
		<input type="text" class="form-control" name="postcode" id="postcode" value="" placeholder="<?php  esc_attr_e('Enter Zipcode/Postcode','jobbank'); ?>">
	</div>	
	<div class=" form-group col-md-6">
		<label for="text" class=" control-label"><?php  esc_html_e('Country','jobbank'); ?></label>
		<input type="text" class="form-control" name="country" id="country" value="" placeholder="<?php  esc_attr_e('Enter Country','jobbank'); ?>">
	</div>	
	<div class=" form-group col-md-6">
		<label for="text" class=" control-label"><?php  esc_html_e('Latitude ','jobbank'); ?></label>
		<input type="text" class="form-control" name="latitude" id="latitude" value="" placeholder="<?php  esc_attr_e('Enter Latitude','jobbank'); ?>">
	</div>	
	<div class=" form-group col-md-6">
		<label for="text" class=" control-label"><?php  esc_html_e('Longitude','jobbank'); ?></label>
		<input type="text" class="form-control" name="longitude" id="longitude" value="" placeholder="<?php  esc_attr_e('Enter Longitude','jobbank'); ?>">
	</div>	
	<div class=" form-group col-md-6">
		<label for="text" class=" control-label"><?php  esc_html_e('Email Address','jobbank'); ?></label>
		<input type="text" class="form-control" name="contact-email" id="contact-email" value="" placeholder="<?php  esc_attr_e('Enter Email Address','jobbank'); ?>">
	</div>
	<div class=" form-group col-md-6">
		<label for="text" class=" control-label"><?php  esc_html_e('Web Site','jobbank'); ?></label>
		<input type="text" class="form-control" name="contact_web" id="contact_web" value="" placeholder="<?php  esc_attr_e('Enter Web Site','jobbank'); ?>">
	</div>
</div>	
<hr/>
<div class="clearfix"></div>
<span class="caption-subject">												
	<?php  esc_html_e('Categories','jobbank'); ?>
</span>
<hr/>
<div class=" form-group row"  id="jobbankcats-container">																	
	<?php $selected='';
		//job
		$taxonomy = $jobbank_directory_url.'-category';
		$args = array(
		'orderby'           => 'name', 
		'order'             => 'ASC',
		'hide_empty'        => false, 
		'exclude'           => array(), 
		'exclude_tree'      => array(), 
		'include'           => array(),
		'number'            => '', 
		'fields'            => 'all', 
		'slug'              => '',
		'hierarchical'      => true, 
		'child_of'          => 0,
		'childless'         => false,
		'get'               => '', 
		);
		$terms = get_terms($taxonomy,$args); // Get all terms of a taxonomy
		if ( $terms && !is_wp_error( $terms ) ) :
		$i=0;
		foreach ( $terms as $term_parent ) {  ?>												
		<?php  
			if($term_parent->name!=''){	
			?>	
			<div class="col-md-6">
				<label class="form-group "> <input type="checkbox" name="postcats[]" id="postcats"  value="<?php echo esc_attr($term_parent->slug); ?>" class="jobbankcats-fields" > <?php echo esc_html($term_parent->name); ?> </label>
			</div>
			<?php
			}
			$i++;
		} 								
		endif;	
	?>	
	<div class="col-md-12">
		<input type="text" class="form-control" name="new_category" id="new_category" value="" placeholder="<?php  esc_html_e('Enter New Categories: Separate with commas','jobbank'); ?>">
	</div>		
</div>
<div class="clearfix"></div>
<span class="caption-subject">												
	<?php  esc_html_e('Tags','jobbank'); ?>
</span>
<hr/>
<div class=" row">		
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
		$tags_all= '';													
		if ( $main_tag && !is_wp_error( $main_tag ) ) :
		foreach ( $main_tag as $term_m ) {
		?>
		<div class="col-md-6">
			<label class="form-group"> 
			<input type="checkbox" name="tag_arr[]" id="tag_arr[]"  value="<?php echo esc_attr($term_m->slug); ?>"> <?php echo esc_html($term_m->name); ?> </label>  
		</div>
		<?php	
		}
		endif;	
	?>
</div>
<div class=" form-group">	
	<input type="text" class="form-control" name="new_tag" id="new_tag" value="" placeholder="<?php  esc_html_e('Enter New Tags: Separate with commas','jobbank'); ?>">
</div>															
<div class="clearfix"></div>
<span class="caption-subject">												
	<?php  esc_html_e('Locations','jobbank'); ?>
</span>
<hr/>
<div class=" row mb-3">		
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
		'taxonomy'                 => $jobbank_directory_url.'-locations',
		'pad_counts'               => false
		);
		$main_tag = get_categories( $args2 );	
		$tags_all= '';													
		if ( $main_tag && !is_wp_error( $main_tag ) ) :
		foreach ( $main_tag as $term_m ) {
		?>
		<div class="col-md-6">
			<label class="form-group"> 
			<input type="checkbox" name="location_arr[]" id="location_arr"  value="<?php echo esc_attr($term_m->slug); ?>"> <?php echo esc_html($term_m->name); ?> </label>  
		</div>
		<?php	
		}
		endif;	
	?>
	<div class="col-md-12">
		<input type="text" class="form-control" name="new_location" id="new_location" value="" placeholder="<?php  esc_html_e('Enter New Locations: Separate with commas','jobbank'); ?>">
	</div>															
</div>
<div class="clearfix"></div>	
<span class="caption-subject">												
	<?php  esc_html_e('Job information','jobbank'); ?>
</span>
<hr/>	
<div class="clearfix"></div>
<div class="row">
	<div class="col-md-6  form-group">
		<label for="text" class=" control-label"><?php  esc_html_e('Educational Requirements','jobbank'); ?></label>
		<input type="text" class="form-control" name="educational_requirements" id="educational_requirements" value="" placeholder="<?php  esc_html_e('Bachelor Degree','jobbank'); ?>">								
	</div>
	<div class="  form-group col-md-6">
		<label for="text" class="  control-label"><?php  esc_html_e('Job Nature','jobbank'); ?></label>
		<select name="job_type" class="form-control ">		
			<?php
				$jobbank_job_status='';
				$jobbank_job_status_all=get_option('jobbank_job_status');					
				if($jobbank_job_status_all==""){$jobbank_job_status_all='Full Time, Part Time,Freelance, Hourly, Project Base';}
				$jobbank_job_status_all_arr= explode(',',$jobbank_job_status_all);
				foreach($jobbank_job_status_all_arr as $jobbank_job_statusone){ 
					if(!empty($jobbank_job_statusone)){
						echo' <option '. ($jobbank_job_status ==$jobbank_job_statusone ? 'selected':'' ).' value="'.trim(esc_attr($jobbank_job_statusone)).'">'.esc_html__($jobbank_job_statusone,'jobbank').'</option>';
					}
				}											
			?>	
		</select>									
	</div>
	<div class="  form-group col-md-6">
		<label for="text" class="  control-label"><?php  esc_html_e('Job Level','jobbank'); ?></label>
		<select name="jobbank_job_level" class="form-control ">		
			<?php
				$jobbank_job_level='';
				$jobbank_job_level_all=get_option('jobbank_job_level');					
				if($jobbank_job_level_all==""){$jobbank_job_level_all='Any,Entry Lavel,Mid Level,Top Level';}
				$jobbank_job_level_arr= explode(',',$jobbank_job_level_all);
				foreach($jobbank_job_level_arr as $jobbank_job_statusone){ 
					if(!empty($jobbank_job_statusone)){
						echo' <option '. ($jobbank_job_level ==$jobbank_job_statusone ? 'selected':'' ).' value="'.trim(esc_attr($jobbank_job_statusone)).'">'.esc_html__($jobbank_job_statusone,'jobbank').'</option>';
					}
				}											
			?>	
		</select>									
	</div>
	<div class="  form-group col-md-6">
		<label for="text" class="  control-label"><?php  esc_html_e('Experience Range','jobbank'); ?></label>
		<select name="jobbank_experience_range" class="form-control ">		
			<?php
				$jobbank_experience_range='';
				$jobbank_experience_range=get_option('jobbank_experience_range');					
				if($jobbank_experience_range==""){
					$jobbank_experience_range='Any,Below 1 Year,1 - 3 Years,3 - 5 Years,5 - 10 Years,Over 10 Years';
				}
				$job_arr= explode(',',$jobbank_experience_range);
				foreach($job_arr as $jobbank_job_statusone){ 
					if(!empty($jobbank_job_statusone)){
						echo' <option '. ($jobbank_job_status ==$jobbank_job_statusone ? 'selected':'' ).' value="'.trim($jobbank_job_statusone).'">'.esc_html__($jobbank_job_statusone,'jobbank').'</option>';
					}
				}											
			?>	
		</select>														
	</div>
	<div class="  form-group col-md-6">
		<label for="text" class="  control-label"><?php  esc_html_e('Age Range','jobbank'); ?></label>
		<select name="age_range" class="form-control ">		
			<?php
				$age_range='';
				$age_range=get_option('age_range');					
				if($age_range==""){$age_range=esc_html__('Any, Below 20 years, 20-30 Years, 30-40 Years,40-50 Years,Over 50 Years','jobbank');}
				$job_arr= explode(',',$age_range);
				foreach($job_arr as $jobbank_job_statusone){ 
					if(!empty($jobbank_job_statusone)){
						echo' <option '. ($jobbank_job_status ==$jobbank_job_statusone ? 'selected':'' ).' value="'.trim(esc_attr($jobbank_job_statusone)).'">'.esc_html__($jobbank_job_statusone,'jobbank').'</option>';
					}
				}											
			?>	
		</select>														
	</div>
	<div class=" col-md-6 form-group">
		<label for="text" class=" control-label"><?php  esc_html_e('Gender','jobbank'); ?></label>
		<select name="gender"  class="form-control">
			<option value="Any"><?php  esc_html_e('Any','jobbank'); ?></option>
			<option value="Male"><?php  esc_html_e('Male','jobbank'); ?></option>
			<option value="Female"><?php  esc_html_e('Female','jobbank'); ?></option>
		</select>
	</div>
	<div class="col-md-6  form-group">
		<label for="text" class=" control-label"><?php  esc_html_e('Vacancy','jobbank'); ?></label>
		<input type="text" class="form-control" name="vacancy" id="vacancy" value="" placeholder="<?php  esc_html_e('Enter Vacancy, e.g : 2','jobbank'); ?>">								
	</div>
	<div class=" col-md-6 form-group">
		<label for="text" class=" control-label"><?php  esc_html_e('Application Deadline','jobbank'); ?></label>
		<input type="text" class="form-control" name="deadline" id="deadline" value="" >
	</div>	
	<div class=" col-md-6 form-group">
		<label for="text" class=" control-label"><?php  esc_html_e('Workplace','jobbank'); ?></label>
		<input type="text" class="form-control" name="workplace"  value=""  placeholder="<?php  esc_html_e('Office, Work from Home','jobbank'); ?>">
	</div>
	<div class="col-md-6  form-group">
		<label for="text" class=" control-label"><?php  esc_html_e('Offered Salary','jobbank'); ?></label>
		<input type="text" class="form-control" name="salary" value="" >								
	</div>
	<div class="col-md-12  form-group">
		<label for="text" class=" control-label"><?php  esc_html_e('Compensation & Other Benefits','jobbank'); ?></label>
		<input type="text" class="form-control" name="other_benefits" value="" >								
	</div>
</div>
<span class="caption-subject">	
	<?php  esc_html_e('Videos ','jobbank'); ?>
</span>
<hr/>
<div class="row">
	<div class=" col-md-6 form-group">
		<label for="text" class=" control-label"><?php  esc_html_e('Youtube','jobbank'); ?></label>
		<input type="text" class="form-control" name="youtube" id="youtube" value="" placeholder="<?php  esc_html_e('Enter Youtube video ID, e.g : bU1QPtOZQZU ','jobbank'); ?>">
	</div>
	<div class="col-md-6  form-group">
		<label for="text" class=" control-label"><?php  esc_html_e('vimeo','jobbank'); ?></label>
		<input type="text" class="form-control" name="vimeo" id="vimeo" value="" placeholder="<?php  esc_html_e('Enter vimeo ID, e.g : 134173961','jobbank'); ?>">								
	</div>
</div>	

<hr/>
<span class="caption-subject">	
	<?php  esc_html_e('More Details ','jobbank'); ?>
</span>								
<hr/>
<div class="row" id="jobbank_fields">
	<?php							
		$post_cats=array();			
		echo ''.$main_class->jobbank_listing_fields(0, $post_cats );
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
<span class="caption-subject">												
	<?php  esc_html_e('Button Setting','jobbank'); ?>
</span>
<hr/>
<?php											
	$dir_style5_email=get_option('dir_style5_email');	
	if($dir_style5_email==""){$dir_style5_email='yes';}
	if($dir_style5_email=="yes"){
		$dirpro_email_button='';
		if($dirpro_email_button==""){$dirpro_email_button='yes';}
	?>	
	<div class="form-group row ">
		<label  class="col-md-4 control-label"> <?php  esc_html_e('Contact Button','jobbank');  ?></label>
		<div class="col-md-3">
			<label>												
				<input type="radio" name="dirpro_email_button" id="dirpro_email_button" class="mr-1" value='yes' <?php echo ($dirpro_email_button=='yes' ? 'checked':'' ); ?> ><?php  esc_html_e('Show Contact Button','jobbank');  ?>
			</label>	
		</div>
		<div class="col-md-5">	
			<label>											
				<input type="radio"  name="dirpro_email_button" id="dirpro_email_button" class="mr-1"  value='no' <?php echo ($dirpro_email_button=='no' ? 'checked':'' );  ?> > <?php  esc_html_e('Hide Contact Button','jobbank');  ?>
			</label>
		</div>	
	</div>		
	<?php
	}	
	?>	