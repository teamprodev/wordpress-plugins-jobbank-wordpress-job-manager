<?php
	global $wpdb;
	$jobbank_directory_url=get_option('ep_jobbank_url');
	if($jobbank_directory_url==""){$jobbank_directory_url='job';}
	include('header.php');
?>
<div class="jobbank-settings  mt-3"> 
	<div class="row">
		<div class="col-md-9 col-8">
			<h2 class="mb-3"><?php esc_html_e('Settings','jobbank'); ?> <a title="Video Tutorial" href="<?php echo esc_url('https://www.youtube.com/playlist?list=PLLRcfoNnzUb4fQXXTRbcqt5hUDwN_iRTZ');?>" target="_blank"><span class="jobbank-icon"><i class="fa-brands fa-youtube"></i></span>	</a></h2> 

		</div>
		<div class="col-md-3 col-4 text-right " id="admin-menu">
			<button class=" btn-border mb-2 " id="compose_adminmenu" ><i class="fa-solid fa-bars"></i></button>
		</div>
	</div>
	

	<div class="jobbank-settings-wrap row">	
		<div class="nav-tab-wrapper col-md-3" id="jobbank-left-menu">	
			<a href="#" class=" nav-tab tablinks "  id="defaultOpen" onclick="jobbank_tabopen(event, 'listing_publish')" >
			<span class="dashicons dashicons-admin-generic"></span> <?php esc_html_e('Listing Settings/Layout','jobbank'); ?></a>
			
			<a href="#" class=" nav-tab tablinks "   onclick="jobbank_tabopen(event, 'demo')" ><span class="dashicons dashicons-database-add"></span> <?php esc_html_e('Demo Data','jobbank'); ?></a>
			<a href="#" class=" nav-tab tablinks "  onclick="jobbank_tabopen(event, 'listing_search')" ><span class="dashicons dashicons-search"></span> <?php esc_html_e('Search Form Builder','jobbank'); ?></a>
			<a href="#" class=" nav-tab tablinks "   onclick="jobbank_tabopen(event, 'color_setting')" ><span class="dashicons dashicons-color-picker"></span> <?php esc_html_e('Color','jobbank'); ?></a>
			<a href="#" class=" nav-tab tablinks "   onclick="jobbank_tabopen(event, 'alllistinglayout')" ><span class="dashicons dashicons-list-view"></span> <?php esc_html_e('All Listing Data/Fields','jobbank'); ?></a>
			<a href="#" class=" nav-tab tablinks "   onclick="jobbank_tabopen(event, 'singlelistinglayout')" ><span class="dashicons dashicons-welcome-write-blog"></span> <?php esc_html_e('Single Listing Data/Fields','jobbank'); ?></a>	
			<a href="#" class=" nav-tab tablinks "   onclick="jobbank_tabopen(event, 'map_setting')" ><span class="dashicons dashicons-location-alt"></span> <?php esc_html_e('Map','jobbank'); ?></a>
		
			<a href="#" class=" nav-tab tablinks "  onclick="jobbank_tabopen(event, 'my-account')" ><span class="dashicons dashicons-welcome-widgets-menus"></span> <?php esc_html_e('My Account Menu','jobbank'); ?></a>					
			<a href="#" class=" nav-tab tablinks "  onclick="jobbank_tabopen(event, 'registrationfields')" ><span class="dashicons dashicons-admin-users"></span> <?php esc_html_e('Registration / User Profile','jobbank'); ?></a>
			<a href="#" class=" nav-tab tablinks "  onclick="jobbank_tabopen(event, 'listingfields')" ><span class="dashicons dashicons-list-view"></span> <?php esc_html_e('Listing Custom Fields Builder','jobbank'); ?></a>
			<a href="#" class=" nav-tab tablinks "   onclick="jobbank_tabopen(event, 'csv')" ><span class="dashicons dashicons-database-import"></span> <?php esc_html_e('CSV Importer','jobbank'); ?></a>		
			<a href="#" class="nav-tab tablinks"  onclick="jobbank_tabopen(event, 'payment_gateways')" ><span class="dashicons dashicons-cart"></span> <?php esc_html_e('Payment Gateways','jobbank'); ?></a>
			<a href="#" class="nav-tab tablinks"  onclick="jobbank_tabopen(event, 'packages')" ><span class="dashicons dashicons-money-alt"></span> <?php esc_html_e('Packages','jobbank'); ?></a>
			<a href="#" class="nav-tab tablinks"  onclick="jobbank_tabopen(event, 'coupons')" ><span class="dashicons dashicons-yes"></span> <?php esc_html_e('Coupons','jobbank'); ?></a>
			<a href="#" class=" nav-tab tablinks "  onclick="jobbank_tabopen(event, 'email_template')" ><span class="dashicons dashicons-email"></span> <?php esc_html_e('Email Template','jobbank'); ?></a>
			<a href="#" class=" nav-tab tablinks "   onclick="jobbank_tabopen(event, 'pagesall')" ><span class="dashicons dashicons-admin-page"></span> <?php esc_html_e('Plugin Pages','jobbank'); ?></a>				
			<a href="#" class="nav-tab tablinks" onclick="jobbank_tabopen(event, 'mailchimp')" ><span class="dashicons dashicons-cart"></span> <?php esc_html_e('Mailchimp','jobbank'); ?></a>
		
			<a href="#" class="nav-tab tablinks"  onclick="jobbank_tabopen(event, 'user_settings')" ><span class="dashicons dashicons-admin-users"></span> <?php esc_html_e('Users','jobbank'); ?></a>
			<a href="#" class="nav-tab tablinks"  onclick="jobbank_tabopen(event, 'payment_history')"><span class="dashicons dashicons-money-alt"></span> <?php esc_html_e('Payment History','jobbank'); ?></a>
			
			<a href="#" class="nav-tab tablinks"  onclick="jobbank_tabopen(event, 'shortcodes')"><span class="dashicons dashicons-editor-help"></span> <?php esc_html_e('Useful Shortcode','jobbank'); ?></a>
		</div> 
		<div class="metabox-holder col-md-9">
			
			<div id="demo" class="tabcontent group">				
					
					<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('Demo Import ','jobbank');?>  </label></th></tr></thead></table> 						
					<div class="top-20 "><p></p>
						<?php include (ep_jobbank_DIR .'/admin/pages/dir-demo.php');?>			
					</div>
					
				
			</div>
			<div id="csv" class="tabcontent group">				
			
			
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('Importing CSV Data ','jobbank');?>  </label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>
							<?php
								include('csv-import.php');
							?>					
						</div>
					</div>
				</div>
			</div>
			<div id="user_settings" class="tabcontent group">	
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('Users Settings','jobbank');?>  </label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>				  
							<?php include (ep_jobbank_DIR .'/admin/pages/user_directory_admin.php');?>
						</div>
					</div>
				</div>
			</div>
			<div id="payment_history" class="tabcontent group">	
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('Payment History','jobbank');?>  </label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>				  
							<?php include (ep_jobbank_DIR .'/admin/pages/payment-history.php');?>
						</div>
					</div>
				</div>
			</div>
			<div id="my-account" class="tabcontent group">	
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('My Account Menu ','jobbank');?>  </label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>				  
							<?php include (ep_jobbank_DIR .'/admin/pages/profile-fields.php');?>
						</div>
					</div>
				</div>
			</div>
			<div id="coupons" class="tabcontent group">	
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('Coupons ','jobbank');?>  </label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>				  
							<?php include (ep_jobbank_DIR .'/admin/pages/all_coupons.php');?>
						</div>
					</div>
				</div>
			</div>
			<div id="mailchimp" class="tabcontent group">	
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('Mailchimp ','jobbank');?>  </label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>				  
							<?php include (ep_jobbank_DIR .'/admin/pages/mailchimp.php');?>
						</div>
					</div>
				</div>
			</div>
			<div id="shortcodes" class="tabcontent group">	
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('Useful shortcode/ Widgets ','jobbank');?> 
						
						 <a href="<?php echo esc_url('https://www.youtube.com/playlist?list=PLLRcfoNnzUb4fQXXTRbcqt5hUDwN_iRTZ');?>" target="_blank">
                            <span class="jobbank-icon">
                                <i class="fa-brands fa-youtube"></i>
							</span>
							<?php  esc_html_e('Videos','jobbank'); ?>
						</a>
							
							</label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>				  
							<?php include (ep_jobbank_DIR .'/admin/pages/shortcodes-sample.php');?>
						</div>
					</div>
				</div>
			</div>
			
			<div id="payment_gateways" class="tabcontent group">	
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('Payment Gateways ','jobbank');?>  </label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>				  
							<?php include (ep_jobbank_DIR .'/admin/pages/payment-settings.php');?>
						</div>
					</div>
				</div>
			</div>
			<div id="packages" class="tabcontent group">	
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('Packages ','jobbank');?>  </label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>				  
							<?php include (ep_jobbank_DIR .'/admin/pages/package_all.php');?>
						</div>
					</div>
				</div>
			</div>
			<div id="alllistinglayout" class="tabcontent group">		
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('Listing Archive (drag, drop & sort)','jobbank');?>  </label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>				  
							<?php 
							include (ep_jobbank_DIR .'/admin/pages/archive_setting.php');?>
						</div>
					</div>
				</div>	
			</div>
			<div id="singlelistinglayout" class="tabcontent group">
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('Listing Detail page (drag & drop)','jobbank');?>  </label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>				  
							<?php 
							include (ep_jobbank_DIR .'/admin/pages/single_page_setting.php');?>
						</div>
					</div>
				</div>	
			</div>
			<div id="color_setting" class="tabcontent group">
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('Color Settings ','jobbank');?>  </label></th></tr></thead></table>
						<div class="top-20 "><p></p>				  
							<?php include (ep_jobbank_DIR .'/admin/pages/color_setting.php');?>
						</div>
					</div>
				</div>				
			</div>	
			<div id="email_template" class="tabcontent group">
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('Email Template ','jobbank');?>  </label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>				  
							<?php include (ep_jobbank_DIR .'/admin/pages/email_template_all.php');?>
						</div>
					</div>
				</div>
			</div>
			<div id="map_setting" class="tabcontent group">
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('Map Settings ','jobbank');?>  </label></th></tr></thead></table>
						<div class="top-20 "><p></p>				  
							<?php include (ep_jobbank_DIR .'/admin/pages/map_setting.php');?>
						</div>
					</div>
				</div>				
			</div>	
			<div id="listing_search" class="tabcontent group">
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('Customize the search form (drag, drop & sort)','jobbank');?>  </label></th></tr></thead></table>
						<div class="top-20 "><p></p>				  
							<?php include (ep_jobbank_DIR .'/admin/pages/listing_search.php');?>
						</div>
					</div>
				</div>
			</div>
			<div id="listing_publish" class="tabcontent group">
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('Listing Settings','jobbank');?>  <a class="button button-primary " href="<?php echo esc_url( get_post_type_archive_link( $jobbank_directory_url)) ; ?>" target="blank"><?php esc_html_e('View Page','jobbank');  ?></a></label></th></tr></thead></table>
						<div class="top-20 "><p></p>				  
							<?php include (ep_jobbank_DIR .'/admin/pages/listing_publish.php');?>
						</div>
					</div>
				</div>
			</div>
			<div id="pagesall" class="tabcontent group">
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('Plugin Pages','jobbank');?>  </label></th></tr></thead></table>
						<div class="top-20 "><p></p>				  
							<?php include (ep_jobbank_DIR .'/admin/pages/setting-pages-all.php');?>
						</div>
					</div>
				</div>
			</div>
			<div id="registrationfields" class="tabcontent group">
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('Registration / User Profile Fields','jobbank');?>  </label></th></tr></thead></table>
						<div class="top-20 "><p></p>				  
							<?php include (ep_jobbank_DIR .'/admin/pages/registration-fields.php');?>
						</div>
					</div>
				</div>
			</div>
			<div id="listingfields" class="tabcontent group">
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="jobbank-settings-field-type-sub_section"><th colspan="3" class="jobbank-settings-sub-section-title"><label><?php esc_html_e('Listing Fields','jobbank');?>  </label></th></tr></thead></table>
						<div class="top-20 "><p></p>				  
							<?php include (ep_jobbank_DIR .'/admin/pages/directory_fields.php');?>
						</div>
					</div>
				</div>
			</div>
			
		
		</div>
		</div>
</div>		
<?php
	include('footer.php');
?>