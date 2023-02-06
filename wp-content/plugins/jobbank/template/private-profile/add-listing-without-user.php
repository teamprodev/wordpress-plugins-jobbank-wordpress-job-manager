<?php
	wp_enqueue_script("jquery");
	wp_enqueue_style('jquery-ui', ep_jobbank_URLPATH . 'admin/files/css/jquery-ui.css');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_style('bootstrap', ep_jobbank_URLPATH . 'admin/files/css/iv-bootstrap.css');
	wp_enqueue_script('bootstrap.min', ep_jobbank_URLPATH . 'admin/files/js/bootstrap.min-4.js');
	wp_enqueue_script('popper', 		ep_jobbank_URLPATH . 'admin/files/js/popper.min.js');
	wp_enqueue_style('colorbox', ep_jobbank_URLPATH . 'admin/files/css/colorbox.css');
	wp_enqueue_script('colorbox', ep_jobbank_URLPATH . 'admin/files/js/jquery.colorbox-min.js');	
	wp_enqueue_style('jobbank_myaccount-css', ep_jobbank_URLPATH . 'admin/files/css/my-account.css');
	wp_enqueue_style('jobbank_myaccount-css-2', ep_jobbank_URLPATH . 'admin/files/css/my-account-new.css');
	
	// Map openstreet
	wp_enqueue_script('leaflet', ep_jobbank_URLPATH . 'admin/files/js/leaflet.js');
	wp_enqueue_style('leaflet', ep_jobbank_URLPATH . 'admin/files/css/leaflet.css');
	wp_enqueue_script('leaflet-geocoder-locationiq', ep_jobbank_URLPATH . 'admin/files/js/leaflet-geocoder-locationiq.min.js');		
	wp_enqueue_style('leaflet-geocoder-locationiq', ep_jobbank_URLPATH . 'admin/files/css/leaflet-geocoder-locationiq.min.css');
	wp_enqueue_media();
	
	$dir_map_api=get_option('epjbdir_map_api');	
	if($dir_map_api==""){$dir_map_api='';}	
	$jobbank_directory_url=get_option('ep_jobbank_url');					
	if($jobbank_directory_url==""){$jobbank_directory_url='job';}
	$map_api_have='no';	
	global $wpdb, $current_user;
	$main_class = new eplugins_jobbank;
?>
<div class="bootstrap-wrapper">
	<div id="profile-account2"  class="container ">
<div class="profile-content">
	<div class="portlet light">	
		
		<div id="full-form-add-new" class="col-md-12">	
						<form action="" id="new_post" name="new_post"  method="POST" role="form" class="p-2">
							<div  class="row " > 	
								<div class="col-md-12 ">	 
									<h4 class=""><?php  esc_html_e('Post a Job','jobbank');?>
									</h4>
									<hr/>
								</div>
							</div>
							
							<div  class="row " > 							
								<div class=" form-group col-md-3">
									<label for="text" class=" control-label"><?php  esc_html_e('Have an account?','jobbank'); ?></label>
								</div>
								
								<div class=" form-group col-md-9">
									<?php
									
									if(isset($current_user->ID) AND $current_user->ID>0){  ?>
										<label for="text" class=" control-label"><?php  esc_html_e(' You are already logged in as ','jobbank'); echo '<strong>'.ucfirst($current_user->display_name).'</strong>';  ?>
											<a class="" href="<?php echo wp_logout_url( get_permalink() ); ?>" >			
													<?php  esc_html_e(' Logout ','jobbank');?>
													</a>
											</label>
									<?php	
									}else{
										$login_page=get_option('epjbjobbank_login_page');
										$reg_page= get_permalink( $login_page); 
									?>
									<label for="text" class=" control-label">
										<a class="" href="<?php  echo esc_url($reg_page); ?>" >			
										<?php  esc_html_e(' Sign in ','jobbank');?>
										</a>
										<?php  esc_html_e(' If you do not have an account you can create one below by entering your email address.','jobbank'); ?></label>
									
									<?php
									}
									?>
									<div class="" id="update_message2"></div>
								</div>
							</div>						
							<?php
							if(isset($current_user->ID) AND $current_user->ID==0){  ?>
								<div  class="row"  > 
									<div class=" form-group col-md-3">
										<label for="text" class=" control-label"><?php  esc_html_e('Your email','jobbank'); ?></label>
										
									</div>
									<div class=" form-group col-md-9">									
										<input type="email" class="form-control" name="n_user_email" id="n_user_email" required autofocus value="" placeholder="<?php  esc_attr_e('jhon@yourdomain.com','jobbank'); ?>">
									</div>
									
									<div class=" form-group col-md-3">
										<label for="text" class=" control-label"><?php  esc_html_e('Password','jobbank'); ?></label>
									</div>
									<div class=" form-group col-md-9">									
										<input type="password" class="form-control" name="n_password" id="n_password" required value="" placeholder="<?php  esc_attr_e('Password','jobbank'); ?>">
									</div>
									
								</div>	
						
							<?php
							}
								include( ep_jobbank_template. 'private-profile/addlisting-form.php');
							?>
							<div class="clearfix"></div>	
							<input type="hidden" name="user_post_id" id="user_post_id" value="0">
							<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_html($current_user->ID); ?>">
						</form>
						<div class="row">
							<div class="col-md-12  "> <hr/>
								<div class="" id="update_message"></div>								
								<button type="button" onclick="jobbank_new_post_without_user();"  class="btn green-haze"><?php  esc_html_e('Save Post',	'jobbank'); ?></button>
							</div>	
						</div>	
			</div>		
	</div>
</div>

</div>
</div>
<?php
	$my_account_page=get_option('epjbjobbank_profile_page');
	$reg_my_account_page= get_permalink( $my_account_page); 
										
	$save_address='';
	$my_theme = wp_get_theme();
	$theme_name= strtolower($my_theme->get( 'Name' ));
	wp_enqueue_script('jobbank_add-edit-listing', ep_jobbank_URLPATH . 'admin/files/js/add-edit-listing.js');
	wp_localize_script('jobbank_add-edit-listing', 'realpro_data', array(
	'ajaxurl' 					=> admin_url( 'admin-ajax.php' ),
	'loading_image'			=> '<img src="'.ep_jobbank_URLPATH.'admin/files/images/loader.gif">',
	'current_user_id'		=>$current_user->ID,
	'Set_Feature_Image'	=> esc_html__('Set Feature Image','jobbank'),
	'Set_plan_Image'		=> esc_html__('Set plan Image','jobbank'),
	'Set_Event_Image'		=> esc_html__('Set Event Image','jobbank'),
	'Gallery Images'		=> esc_html__('Gallery Images','jobbank'),
	'useremail_message'		=> esc_html__('Please input your email & password','jobbank'),
	'success_message'		=> esc_html__('Successfully added. You can edit your listing here: ','jobbank'),	
	'my_account_link'		=> $reg_my_account_page,
	'permalink'				=> get_permalink(),
	'save_address'			=> $save_address,
	'dirwpnonce'			=> wp_create_nonce("addlisting"),
	'theme_name'			=> $theme_name,
	) );
	
	wp_reset_query();
?> 