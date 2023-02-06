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
	wp_enqueue_style('fontawesome', ep_jobbank_URLPATH . 'admin/files/css/all.min.css');
	wp_enqueue_style('jobbank_my-account-css', ep_jobbank_URLPATH . 'admin/files/css/my-account.css');
	wp_enqueue_style('jobbank_my-account-css-2', ep_jobbank_URLPATH . 'admin/files/css/my-account-new.css');
	wp_enqueue_style('jobbank_my-menu-css', ep_jobbank_URLPATH . 'admin/files/css/cssmenu.css');
	wp_enqueue_script('jobbank_script-user-directory', ep_jobbank_URLPATH . 'admin/files/js/user-directory.js');
	wp_enqueue_style('jquery.dataTables', ep_jobbank_URLPATH . 'admin/files/css/jquery.dataTables.css');
	wp_enqueue_script('jquery.dataTables', ep_jobbank_URLPATH . 'admin/files/js/jquery.dataTables.js');		
	wp_enqueue_script('datetimepicker', ep_jobbank_URLPATH . 'admin/files/js/jquery.datetimepicker.full.js');
	wp_enqueue_style('datetimepicker', ep_jobbank_URLPATH . 'admin/files/css/jquery.datetimepicker.css');
	// Map openstreet
	wp_enqueue_script('leaflet', ep_jobbank_URLPATH . 'admin/files/js/leaflet.js');
	wp_enqueue_style('leaflet', ep_jobbank_URLPATH . 'admin/files/css/leaflet.css');
	wp_enqueue_script('leaflet-geocoder-locationiq', ep_jobbank_URLPATH . 'admin/files/js/leaflet-geocoder-locationiq.min.js');		
	wp_enqueue_style('leaflet-geocoder-locationiq', ep_jobbank_URLPATH . 'admin/files/css/leaflet-geocoder-locationiq.min.css');
	wp_enqueue_media();
	$main_class = new eplugins_jobbank;
	$jobbank_directory_url=get_option('ep_jobbank_url');
	if($jobbank_directory_url==""){$jobbank_directory_url='job';}
	global $current_user;
	global $wpdb;
	$user = new WP_User( $current_user->ID );
	if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
		foreach ( $user->roles as $role ){
			$crole= ucfirst($role);
			break;
		}
	}
	if(strtoupper($crole)!=strtoupper('administrator')){
		include(ep_jobbank_template.'/private-profile/check_status.php');
	}
	$currencies = array();
	$currencies['AUD'] ='$';$currencies['CAD'] ='$';
	$currencies['EUR'] ='€';$currencies['GBP'] ='£';
	$currencies['JPY'] ='¥';$currencies['USD'] ='$';
	$currencies['NZD'] ='$';$currencies['CHF'] ='Fr';
	$currencies['HKD'] ='$';$currencies['SGD'] ='$';
	$currencies['SEK'] ='kr';$currencies['DKK'] ='kr';
	$currencies['PLN'] ='zł';$currencies['NOK'] ='kr';
	$currencies['HUF'] ='Ft';$currencies['CZK'] ='Kč';
	$currencies['ILS'] ='₪';$currencies['MXN'] ='$';
	$currencies['BRL'] ='R$';$currencies['PHP'] ='₱';
	$currencies['MYR'] ='RM';$currencies['AUD'] ='$';
	$currencies['TWD'] ='NT$';$currencies['THB'] ='฿';
	$currencies['TRY'] ='TRY';	$currencies['CNY'] ='¥';
	$currency= get_option('jobbank_api_currency');
	$currency_symbol=(isset($currencies[$currency]) ? $currencies[$currency] :$currency );
	$user_id= $current_user->ID;
?>
<?php
	
	$user_id=$current_user->ID;
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
<div class="bootstrap-wrapper " id="profile-account2">
	<input type="hidden" id="profileID" value="<?php echo esc_attr($user_id); ?>">
	<div class="container">
		<section class="section ">   		
			<div class=" banner-hero banner-image-single mt-1" id="topbanner_heroimg" style="background:url(<?php echo esc_url($default_image_banner); ?>) no-repeat; background-size:cover;">
			</div>	
			<div class="row mt-2">
				<div class="col-lg-7 col-md-12 ">					
					<h2 class="title-detail "><?php echo get_user_meta($user_id,'full_name',true); ?>
						<?php					
							
							$all_locations= get_user_meta($user_id, 'all_locations', true);
							if($all_locations!=''){							
							?>
							<span class="card-location ">
								<i class="fa-solid fa-location-dot mr-1 ml-2"></i><?php echo esc_html($all_locations); ?>
							</span>
							<?php
							}
						?>
					</h2>
					<?php if(get_user_meta($user_id,'tagline',true)!=''){ ?>
					<div class="mt-1 mb-1  font-tag_line "><?php						
					?><?php echo get_user_meta($user_id,'tagline',true); ?></span> 				
					</div>
					<?php
						}
					?>
					
			</div>
			<div class="col-lg-5 col-md-12 text-lg-end  col-12">
				<div class=" text-right">	
					<?php 
						$user_type=get_user_meta($current_user->ID, 'user_type',true);
						if(get_user_meta($current_user->ID, 'user_type',true)=='employer'){
							$profile_page=get_option('epjbjobbank_employer_public_page');
						}
						if(get_user_meta($current_user->ID, 'user_type',true)=='candidate'){
							$profile_page=get_option('epjbjobbank_candidate_public_page');
						}
						if($user_type==''){
							if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
								$profile_page=get_option('epjbjobbank_employer_public_page');
								}else{
								$profile_page=get_option('epjbjobbank_candidate_public_page');
							}
						}
						$page_link= get_permalink( $profile_page).'?&id='.$current_user->ID; 
					?>
					<a class="btn btn-border mb-2" href="<?php echo esc_url($page_link); ?>" target="_blank"><?php  esc_html_e('View Profile','jobbank');?> </a>	
					<?php
						if(get_user_meta($current_user->ID, 'user_type',true)!='employer'){?>
						<a class="btn btn-big ml-2 mb-2" href="<?php echo get_permalink();?>?&jobbankpdfcv=<?php echo esc_attr($current_user->ID);?>" target="_blank"><i class="fas fa-download"></i> <?php esc_html_e('PDF', 'jobbank'); ?></a>
						<?php
						}
					?>
					
					<button class="btn btn-border ml-2 mb-2" id="compose_adminmenu" ><i class="fa-solid fa-bars"></i></button>
					
				</div>		
			</div>
			
			
		</div>
		
		
	</section>
	
	<div class="row mt-4" >
		<div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
			<div class="sidebar-myaccount" id="jobbank-left-menu">
				<div class="sidebar-heading pb-15 ">
					<div class="avatar-sidebar mt-3">
						<?php	
							$company_name= get_user_meta($user_id,'full_name', true);
							$company_address= get_user_meta($user_id,'address', true);
							$company_web=get_user_meta($user_id,'website', true);
							$company_phone=get_user_meta($user_id,'phone', true);
							$company_logo=get_user_meta($user_id, 'jobbank_profile_pic_thum',true);
							if(array_key_exists('company-logo',$active_single_fields_saved)){ 
								if(trim($company_logo)!=''){
								?>
								<figure><img alt="image" class="ml-2 height100p"  src="<?php echo esc_url($company_logo); ?>"></figure>
								<?php
								}else{?>
								<figure class="blank-rounded-logo ml-2"></figure>
								<?php
								}
							}
						?>
						<div class="sidebar-info"><span class="toptitle-sub"><?php echo esc_html($company_name); ?></span>
							<?php
								$all_locations= str_replace(',',' ',get_user_meta($user_id, 'all_locations', true));
								if(!empty( $all_locations)){
								?>
								<span class="card-location mt-2"><i class="fa-solid fa-location-dot mr-2"></i><?php echo esc_html($all_locations); ?>
								</span>
								<?php
								}
								$total_jobs= $main_class->jobbank_total_job_count($user_id, $allusers='no' );
								if($total_jobs>0){
								?>
								<a class="link-underline mt-1 " href="<?php echo get_post_type_archive_link( $jobbank_directory_url ).'?employer='.esc_attr($user_id); ?>">
									<?php echo esc_html($total_jobs);?> <?php esc_html_e('Open Jobs', 'jobbank'); ?>
								</a>
								<?php
								}
							?>
						</div>
					</div>
				</div>
				
					
				<div class="sidebar-list-job"  id="jobbank-left-menu">
					
					<!-- SIDEBAR MENU -->
					<div class="profile-usermenu" >
						<?php
							$active='all-post';
							if(isset($_GET['profile']) AND $_GET['profile']=='setting' ){
								$active='setting';
							}
							if(isset($_GET['profile']) AND $_GET['profile']=='level' ){
								$active='level';
							}
							if(isset($_GET['profile']) AND $_GET['profile']=='all-post' ){
								$active='all-post';
							}
							if(isset($_GET['profile']) AND $_GET['profile']=='new-post' ){
								$active='new-post';
							}
							if(isset($_GET['profile']) AND $_GET['profile']=='new-post' ){
								$active='new-post';
							}
							if(isset($_GET['profile']) AND $_GET['profile']=='dashboard' ){
								$active='dashboard';
							}
							if(isset($_GET['profile']) AND $_GET['profile']=='favorites' ){
								$active='favorites';
							}
							if(isset($_GET['profile']) AND $_GET['profile']=='who-is-interested' ){
								$active='who-is-interested';
							}
							if(isset($_GET['profile']) AND $_GET['profile']=='notification' ){
								$active='notification';
							}
							if(isset($_GET['profile']) AND $_GET['profile']=='post-edit' ){
								$active='all-post';
							}
							if(isset($_GET['profile']) AND $_GET['profile']=='candidate-bookmarks' ){
								$active='candidate-bookmarks';
							}
							if(isset($_GET['profile']) AND $_GET['profile']=='employer_manage_jobs' ){
								$active='employer_manage_jobs';
							}
							if(isset($_GET['profile']) AND $_GET['profile']=='employer_bookmarks' ){
								$active='employer_bookmarks';
							}
							if(isset($_GET['profile']) AND $_GET['profile']=='employer_post_a_job' ){
								$active='employer_post_a_job';
							}
							if(isset($_GET['profile']) AND $_GET['profile']=='employer_manage_candidates' ){
								$active='employer_manage_candidates';
							}
							if(isset($_GET['profile']) AND $_GET['profile']=='edit_resume' ){
								$active='edit_resume';
							}
							if(isset($_GET['profile']) AND $_GET['profile']=='candidate_edit_profile' ){
								$active='candidate_edit_profile';
							}
							if(isset($_GET['profile']) AND $_GET['profile']=='messageboard' ){
								$active='messageboard';
							}
							if(isset($_GET['profile']) AND $_GET['profile']=='candidate-applied' ){
								$active='candidate-applied';
							}
							if(isset($_GET['profile']) AND $_GET['profile']=='job_bookmark' ){
								$active='job_bookmark';
							}
							$post_type=  'job';
						?>
						<div id='cssmenu'>
							<?php
								if(get_user_meta($current_user->ID, 'user_type',true)=='candidate'){
									include(  ep_jobbank_template. 'private-profile/candidate-menu.php');
									}else{
									include(  ep_jobbank_template. 'private-profile/employer-menu.php');
								}		
							?>
						</div>
					</div>
					<!-- END MENU -->
				</div>
			</div>
		</div>
		<div class="col-lg-8 col-md-12 col-sm-12 col-12">
			<div class="job-overview">	
				<?php
					if(isset($_GET['profile']) AND $_GET['profile']=='all-post' ){
						include(  ep_jobbank_template. 'private-profile/profile-all-post-1.php');
					}					
					elseif(isset($_GET['profile']) AND $_GET['profile']=='new-post' ){
						include( ep_jobbank_template. 'private-profile/profile-new-post-1.php');
					}
					elseif(isset($_GET['profile']) AND $_GET['profile']=='level' ){
						include(  ep_jobbank_template. 'private-profile/profile-level-1.php');
					}
					elseif(isset($_GET['profile']) AND $_GET['profile']=='post-edit' ){
						include(  ep_jobbank_template. 'private-profile/profile-edit-post-1.php');
					}	
					elseif(isset($_GET['profile']) AND $_GET['profile']=='setting' ){
						include(  ep_jobbank_template. 'private-profile/profile-setting-1.php');
					}
					elseif(isset($_GET['profile']) AND $_GET['profile']=='candidate-bookmarks' ){
						include(  ep_jobbank_template. 'private-profile/candidate-bookmarks.php');
					}
					elseif(isset($_GET['profile']) AND $_GET['profile']=='employer_manage_jobs' ){
						include(  ep_jobbank_template. 'private-profile/employer-manage-jobs.php');
					}
					elseif(isset($_GET['profile']) AND $_GET['profile']=='employer_bookmarks' ){
						include(  ep_jobbank_template. 'private-profile/employer-bookmarks.php');
					}
					elseif(isset($_GET['profile']) AND $_GET['profile']=='employer_post_a_job' ){
						include(  ep_jobbank_template. 'private-profile/employer-post-a-job.php');
					}
					elseif(isset($_GET['profile']) AND $_GET['profile']=='employer_manage_candidates' ){
						include(  ep_jobbank_template. 'private-profile/employer-manage-candidates.php');
					}
					elseif(isset($_GET['profile']) AND $_GET['profile']=='edit_resume' ){
						include(  ep_jobbank_template. 'private-profile/edit-resume.php');
					}
					elseif(isset($_GET['profile']) AND $_GET['profile']=='candidate_edit_profile' ){
						include(  ep_jobbank_template. 'private-profile/candidate-edit-profile.php');
					}
					elseif(isset($_GET['profile']) AND $_GET['profile']=='job_bookmark' ){
						include(  ep_jobbank_template. 'private-profile/listing_bookmark-file.php');
						}elseif(isset($_GET['profile']) AND $_GET['profile']=='messageboard' ){
						include(  ep_jobbank_template. 'private-profile/messageboard.php');
						}elseif(isset($_GET['profile']) AND $_GET['profile']=='notification' ){
						include(  ep_jobbank_template. 'private-profile/listing-notifications.php');
						}elseif(isset($_GET['profile']) AND $_GET['profile']=='candidate-applied' ){
						include(  ep_jobbank_template. 'private-profile/my-applied.php');
					}
					else{
						if(get_user_meta($current_user->ID, 'user_type',true)=='candidate'){
							include(  ep_jobbank_template. 'private-profile/messageboard.php');
							}else{
							include(  ep_jobbank_template. 'private-profile/profile-all-post-1.php');
						}
					}
				?>
			</div>			
		</div>
	</div>		
</div>
</div>

<?php
	$currencyCode = get_option('jobbank_api_currency');
	wp_enqueue_script('jobbank_myaccount', ep_jobbank_URLPATH . 'admin/files/js/my-account.js');
	wp_localize_script('jobbank_myaccount', 'jobbank1', array(
	'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
	'loading_image'		=> '<img src="'.ep_jobbank_URLPATH.'admin/files/images/loader.gif">',
	'wp_iv_directories_URLPATH'		=> ep_jobbank_URLPATH,
	'current_user_id'	=>get_current_user_id(),
	'SetImage'		=>esc_html__('Set Image','jobbank'),
	'GalleryImages'=>esc_html__('Gallery Images','jobbank'),
	'cancel-message' => esc_html__('Are you sure to cancel this Membership','jobbank'),
	'currencyCode'=>  $currencyCode,
	'dirwpnonce'=> wp_create_nonce("myaccount"),
	'dirwpnonce2'=> wp_create_nonce("signup2"),
	'signup'=> wp_create_nonce("signup"),
	'contact'=> wp_create_nonce("contact"),
	'permalink'=> get_permalink(),
	"sProcessing"=>  esc_html__('Processing','jobbank'),
	"sSearch"=>   esc_html__('Search','jobbank'),
	"lengthMenu"=>   esc_html__('Display _MENU_ ','jobbank'),
	"zeroRecords"=>  esc_html__('Nothing found - sorry','jobbank'),
	"info"=>  esc_html__('Showing page _PAGE_ of _PAGES_','jobbank'),
	"infoEmpty"=>   esc_html__('No records available','jobbank'),
	"infoFiltered"=>  esc_html__('(filtered from _MAX_ total records)','jobbank'),
	"sFirst"=> esc_html__('First','jobbank'),
	"sLast"=>  esc_html__('Last','jobbank'),
	"sNext"=>     esc_html__('Next','jobbank'),
	"sPrevious"=>  esc_html__('Previous','jobbank'),
	"makeShortListed"=>  esc_html__('Make Shortlisted','jobbank'), 
	"ShortListed"=>  esc_html__('Undo Shortlisted','jobbank'), 
	"Rejected"=>  esc_html__('Rejected','jobbank'), 
	"MakeReject"=>  esc_html__('Make Reject','jobbank'), 		
	) );
	wp_enqueue_script('jobbank_single-listing', ep_jobbank_URLPATH . 'admin/files/js/single-listing.js');
	wp_localize_script('jobbank_single-listing', 'jobbank_data', array(
	'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
	'loading_image'		=> '<img src="'.ep_jobbank_URLPATH.'admin/files/images/loader.gif">',
	'current_user_id'	=>get_current_user_id(),
	'Please_login'=>esc_html__('Please login', 'jobbank' ),
	'Add_to_Favorites'=>esc_html__('Add to Favorites', 'jobbank' ),
	'Added_to_Favorites'=>esc_html__('Added to Favorites', 'jobbank' ),
	'Please_put_your_message'=>esc_html__('Please put your name,email & Cover letter', 'jobbank' ),
	'contact'=> wp_create_nonce("contact"),
	'listing'=> wp_create_nonce("listing"),
	'cv'=> wp_create_nonce("Doc/CV/PDF"),
	'ep_jobbank_URLPATH'=>ep_jobbank_URLPATH,
	) );
	wp_enqueue_script('jobbank_message', ep_jobbank_URLPATH . 'admin/files/js/user-message.js');
	wp_localize_script('jobbank_message', 'jobbank_data_message', array(
	'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
	'loading_image'		=> '<img src="'.ep_jobbank_URLPATH.'admin/files/images/loader.gif">',		
	'Please_put_your_message'=>esc_html__('Please put your name,email & message', 'jobbank' ),
	'contact'=> wp_create_nonce("contact"),
	'listing'=> wp_create_nonce("listing"),
	) );
	wp_reset_query();
	?>	