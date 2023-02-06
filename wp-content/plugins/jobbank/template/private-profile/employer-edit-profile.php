<div class="row"> 
	<div class="col-md-4">			
		<div class="upload-avatar">
			<div class="avatar" id="profile_image_main">
				<?php
					$iv_profile_pic_url=get_user_meta($current_user->ID, 'jobbank_profile_pic_thum',true);
					if($iv_profile_pic_url!=''){ ?>
					<img src="<?php echo esc_url($iv_profile_pic_url); ?>">
					<?php
						}else{
						echo'	 <img src="'. ep_jobbank_URLPATH.'assets/images/company-enterprise.png">';
					}
				?>
			</div>
		</div>
	</div>		
	<div class="col-md-8">
		<button type="button" onclick="jobbank_edit_profile_image('profile_image_main');"  class="btn btn-small-ar">
		<?php esc_html_e('Change Logo','jobbank'); ?> </button>
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
	
	<div class="col-md-12 mt-3">
		<div class="form-group">
			<label class=""><?php esc_html_e('Industry', 'jobbank'); ?></label>
			<select name="company_type" id="company_type" class="form-control ">								
				<?php
					$argscat = array(
					'type'                     => $jobbank_directory_url,									
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 0,
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
	<div class="col-md-12 mt-3">
		<div class="form-group">		
			<label class=""><?php esc_html_e('Location', 'jobbank'); ?></label>
			<hr/>
			<div class=" row">		
			<?php
				$args =array();					
				$args3 = array(
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
				$main_tag = get_categories( $args3 );
				$tags_all= explode(",",get_user_meta($current_user->ID, 'all_locations', true));  
				if ( $main_tag && !is_wp_error( $main_tag ) ) :
				foreach ( $main_tag as $term_m ) {
					$checked='';
					foreach ( $tags_all as $term ) {
						if( $term==$term_m->name){
							$checked=' checked';
						}
					}
				?>
				<div class="col-md-6">
					<label class="form-group"> <input type="checkbox" name="location_arr[]" id="location_arr" <?php echo esc_attr($checked);?> value="<?php echo esc_attr($term_m->name); ?>"> <?php echo esc_html($term_m->name); ?> </label>
				</div>
				<?php
				}
				endif;
				
			?>
				<div class="col-md-12">
					<input type="text" class="form-control" name="new_location" id="new_location" value="<?php echo get_user_meta($current_user->ID,"new_locations",true); ?>" placeholder="<?php  esc_html_e('Enter New Locations: Separate with commas','jobbank'); ?>">
				</div>	
		</div>
		</div>
	</div>	
		
	<?php
		$default_fields = array();
		$field_set=get_option('jobbank_profile_fields' );
		if($field_set!=""){
			$default_fields=get_option('jobbank_profile_fields' );
			}else{
			$default_fields['full_name']='Full Name';	
			$default_fields['tagline']='Tag line';
			$default_fields['company_since']='Estd Since';
			$default_fields['team_size']='Team Size';									
			$default_fields['phone']='Phone Number';			
			$default_fields['address']='Address';
			$default_fields['city']='City';
			$default_fields['postcode']='Postcode';
			$default_fields['state']='State';
			$default_fields['country']='Country';	
			$default_fields['website']='Website Url';
			$default_fields['description']='About';
		}
		
		$field_type_opt=  get_option( 'jobbank_field_type' );
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
					if(in_array('employer',$field_type_roles[$field_key] )){
						$role_access='yes';
					}
					if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
						foreach ( $user->roles as $role ){
							if(in_array($role,$field_type_roles[$field_key] )){
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
<div class="margin-top-10">
	<div class="" id="update_message"></div>
	<input type="hidden" name="latitude" id="latitude" value="<?php echo esc_attr(get_user_meta($current_user->ID,'latitude ',true)); ?>">
	<input type="hidden" name="longitude" id="longitude" value="<?php echo esc_attr(get_user_meta($current_user->ID,'longitude',true)); ?>">
	<button type="button" onclick="jobbank_update_profile_setting();"  class="btn green-haze"><?php   esc_html_e('Save Changes','jobbank');?></button>
</div>