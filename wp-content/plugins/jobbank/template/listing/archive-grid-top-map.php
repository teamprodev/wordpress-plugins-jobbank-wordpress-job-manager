<?php
	wp_enqueue_script("jquery");	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('jquery-ui-autocomplete');
	wp_enqueue_script('popper', ep_jobbank_URLPATH . 'admin/files/js/popper.min.js');
	wp_enqueue_script('bootstrap', ep_jobbank_URLPATH . 'admin/files/js/bootstrap.min-4.js'); 
	wp_enqueue_style('bootstrap', ep_jobbank_URLPATH . 'admin/files/css/iv-bootstrap.css');
	wp_enqueue_style('jobbank_listing_style_alphabet_sort', ep_jobbank_URLPATH . 'admin/files/css/archive-listing.css');	
	wp_enqueue_style('colorbox', ep_jobbank_URLPATH . 'admin/files/css/colorbox.css');
	wp_enqueue_script('colorbox', ep_jobbank_URLPATH . 'admin/files/js/jquery.colorbox-min.js');
	wp_enqueue_style('jquery-ui', ep_jobbank_URLPATH . 'admin/files/css/jquery-ui.css');
	wp_enqueue_style('font-awesome', ep_jobbank_URLPATH . 'admin/files/css/all.min.css');	
	wp_enqueue_style('flaticon', ep_jobbank_URLPATH . 'admin/files/fonts/flaticon/flaticon.css');	 
	wp_enqueue_style('jobbank_post-paging', ep_jobbank_URLPATH . 'admin/files/css/post-paging.css');
	$main_class = new eplugins_jobbank;
	global $post,$wpdb,$tag,$jobbank_query,$jobbank_filter_badge;
	$defaul_feature_img= $this->jobbank_listing_default_image();
	$jobbank_directory_url=get_option('ep_jobbank_url');
	if($jobbank_directory_url==""){$jobbank_directory_url='job';}
	$current_post_type=$jobbank_directory_url;
	$dir_style5_perpage=get_option('jobbank_dir_perpage');
	if($dir_style5_perpage==""){$dir_style5_perpage=20;}	
	$dirs_data =array();
	$tag_arr= array();
	$search_arg= array();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array(
	'post_type' => $jobbank_directory_url, // enter your custom post type
	'paged' => $paged,
	'post_status' => 'publish',
	'posts_per_page'=> $dir_style5_perpage,  // overrides posts per page in theme settings
	);
	$search_arg= jobbank_get_search_args($jobbank_directory_url);
	$args= array_merge( $args, $search_arg );
	$lat='';$long='';$keyword_post='';$address='';$postcats ='';$selected='';
	// Add new shortcode only category
	if(isset($atts['category']) and $atts['category']!="" ){
		$postcats = $atts['category'];
		$args[$jobbank_directory_url.'-category']=$postcats;		
	}
	if(isset($atts['locations']) and $atts['locations']!="" ){
		$postcats = $atts['locations'];
		$args[$jobbank_directory_url.'-locations']=$postcats;		
	}
	if(isset($atts['tag']) and $atts['tag']!="" ){
		$postcats = $atts['tag'];
		$args[$jobbank_directory_url.'-tag']=$postcats;
	}
	if(get_query_var($jobbank_directory_url.'-category')!=''){
		$postcats = get_query_var($jobbank_directory_url.'-category');
		$args[$jobbank_directory_url.'-category']=$postcats;
		$selected=$postcats;
		$search_show=1;
	}
	if(get_query_var($jobbank_directory_url.'-tag')!=''){
		$postcats = get_query_var($jobbank_directory_url.'-tag');
		$args[$jobbank_directory_url.'-tag']=$postcats;
		$search_show=1;
	}
	if(get_query_var($jobbank_directory_url.'-locations')!=''){
		$postcats = get_query_var($jobbank_directory_url.'-locations');
		$args[$jobbank_directory_url.'-locations']=$postcats;
		$search_show=1;
	}
	if(get_query_var('employer')!=''){
		$author = get_query_var('employer');
		$args['author']=(int) sanitize_text_field($author);		
	}
	if( isset($_REQUEST['employer'])){ 
		$author = $_REQUEST['employer'];
		$args['author']= (int)sanitize_text_field($author);		
	}
	// For featrue listing***********
	$feature_listing_all =array();
	$feature_listing_all =$args;
	if(isset($search_arg['lng']) and $search_arg['lng']!=''){ 
		$jobbank_query = new WP_GeoQuery( $args );
		}else{  
		$jobbank_query = new WP_Query( $args );
	}
	$active_archive_fields=jobbank_get_archive_fields_all();	
	$active_archive_icon_saved=get_option('jobbank_archive_icon_saved' );	
	
	$search_form_setting='popup';
	if(isset($active_archive_icon_saved['top_search_form'])){	
		$search_form_setting=$active_archive_icon_saved['top_search_form'];
	}
	if(isset($atts['search-form']) and $atts['search-form']!="" ){
		$search_form_setting=$atts['search-form'];
	}
?>
<!-- wrap everything for our isolated bootstrap -->
<div class="bootstrap-wrapper">
	<!-- archieve page own design font and others -->
	<div class="   " >
		<?php
					$i=0;
					
					if ( $jobbank_query->have_posts() ) :
					while ( $jobbank_query->have_posts() ) : $jobbank_query->the_post();
					$id = get_the_ID();
					$post_author_id= get_post_field( 'post_author', $id );		
						$feature_img='';
						if(has_post_thumbnail()){ 
							$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' );
							if($feature_image[0]!=""){
								$feature_img =$feature_image[0];
							}
							}else{ 
							$feature_img= $defaul_feature_img;
						}
						$dir_data['title']=esc_html($post->post_title);
						$dir_data['dlink']=get_permalink($id);
						$dir_data['address']= get_post_meta($id,'address',true);										
						$dir_data['image']=  $feature_img;	
						$currentlocation = $main_class->jobbank_get_location_caching($id,$jobbank_directory_url);
						$locations='';
						if(isset($currentlocation[0]->slug)){										
							foreach($currentlocation as $c){
								$locations = $locations .' '.$c->name;
							}
						}			
						$dir_data['locations']= $locations;								
						$dir_data['lat']=get_post_meta($id,'latitude',true);
						$dir_data['lng']=get_post_meta($id,'longitude',true);
						$dir_data['marker_icon']= $main_class->jobbank_get_categories_mapmarker($id,$jobbank_directory_url);
						$ins_lat=get_post_meta($id,'latitude',true);
						$ins_lng=get_post_meta($id,'longitude',true);
						$cat_link='';$cat_name='';$cat_slug='';
						// VIP
						$post_author_id= $jobbank_query->post->post_author;
						$author_package_id=get_user_meta($post_author_id, 'iv_directories_package_id', true);
						$have_vip_badge= get_post_meta($author_package_id,'iv_directories_package_vip_badge',true);
						$exprie_date= strtotime (get_user_meta($post_author_id, 'iv_directories_exprie_date', true));
						$current_date=time();
					
						array_push( $dirs_data, $dir_data );
						$i++;
					
					endwhile;
					$dirs_json_map = json_encode($dirs_data);
				?>
			<?php else :
				$dirs_json=''; ?>			
			<?php endif; ?>
			<div id="map" class="map-top"></div>
			<?php	
			$dir_map_api=get_option('epjbdir_map_api');	
			if($dir_map_api==""){$dir_map_api='';}	
			$dir_map_zoom=get_option('epjbdir_map_zoom');	
			if($dir_map_zoom==""){$dir_map_zoom='7';}	
			$dir_map_type=get_option('epjbdir_map_type');	
			if($dir_map_type==""){$dir_map_type='OpenSteet';}

			if($dir_map_type=='google-map'){
				include( ep_jobbank_template. 'listing/map/google-map.php');

			}else{  
				include( ep_jobbank_template. 'listing/map/openstreet-map.php');
			}

			?>
	</div>
	
	<section class=" py-5">
		<div class="container "  >
			<!-- Search Form -->
			<div class="display-none" tabindex="-1" >	.
				<div class="" id="listingfilter">
					<?php
						if(isset($active_archive_fields['top_search_form'])){
							if($search_form_setting=='popup'){
								echo do_shortcode('[jobbank_search_popup action="same_page"]');
							}
						}
					?>
				</div>
			</div>
			<!-- end of search form -->
			<div class="row" id="full_grid"> 	
					<div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 " >	
						<?php
						if(isset($active_archive_fields['top_search_form'])){										
							if($search_form_setting=='on-page'){
							 echo do_shortcode('[jobbank_search action="same_page"]');					
							}
						}	
						?>
					</div>	
				<div class="col-md-12 col-lg-12 col-xl-12 col-sm-12  " id="dirpro_directories" >	
					<div class="row">	
						<div class="col-xl-3 col-lg-3 col-md-3  col-sm-3 col-3 ">
							<div class="pull-left clearfix  mt-3 text-small ">
								<?php echo esc_html($jobbank_query->found_posts);?><?php esc_html_e(' Results','jobbank');?>
							</div>
						</div>
						<div class="col-xl-9 col-lg-9 col-md-9  col-sm-9 col-9 ">
							<div class="text-right clearfix mb-2 ">								
								<div class="listing-top-layout">
									<?php
										if(isset($active_archive_fields['top_search_form'])){
											if($search_form_setting=='popup'){
										?>
										<span>							
											<button type="button" class="btn btn-big mb-2"  onclick="jobbank_call_filter()">
												<i class="fa-solid fa-magnifying-glass mr-1"></i><?php esc_html_e('Filters', 'jobbank' ); ?>	
												<?php
													if( $jobbank_filter_badge>0 ){
													?>
													<span class="badge badge-pill badge-secondary"><?php echo esc_html($jobbank_filter_badge); ?></span>
													<?php
													}
												?>
											</button>	
										</span>
										<?php
											}
										}
									?>
									<ul class="mr-3">									
										<?php
											if( $jobbank_filter_badge>0 ){
											?>	
											<li class="topicon-border">									
												<a id="resetmainpage"  href="#" data-placement="top" data-toggle="tooltip"  title="<?php  esc_html_e('Reset Search','jobbank'); ?>"><i class="fa fa-refresh" aria-hidden="true"></i>
												</a>
											</li>
											<?php
											}
										?>
									</ul>
								</div>
							</div>
						</div>
					</div>	
					<div class="clearfix"></div>
					<div class="row justify-content-center" >
						<?php
							$i=0;
							$dirs_data =array();
							include( ep_jobbank_template. 'listing/archive_feature_listing.php');
							if ( $jobbank_query->have_posts() ) :
							while ( $jobbank_query->have_posts() ) : $jobbank_query->the_post();
							$id = get_the_ID();
							$post_author_id= get_post_field( 'post_author', $id );
							
							$main_class->check_listing_expire_date($id, $post_author_id, $jobbank_directory_url);
							
							if(get_post_meta($id, 'jobbank_featured', true)!='featured'){
								$feature_img='';
								if(has_post_thumbnail()){ 
									$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' );
									if($feature_image[0]!=""){
										$feature_img =$feature_image[0];
									}
									}else{ 
									$feature_img= $defaul_feature_img;
								}
								$dir_data['title']=esc_html($post->post_title);
								$dir_data['dlink']=get_permalink($id);
								$dir_data['address']= get_post_meta($id,'address',true);										
								$dir_data['image']=  $feature_img;	
								$dir_data['locations']= '';								
								$dir_data['lat']=get_post_meta($id,'latitude',true);
								$dir_data['lng']=get_post_meta($id,'longitude',true);
								$dir_data['marker_icon']= $main_class->jobbank_get_categories_mapmarker($id,$jobbank_directory_url);
								$ins_lat=get_post_meta($id,'latitude',true);
								$ins_lng=get_post_meta($id,'longitude',true);
								$cat_link='';$cat_name='';$cat_slug='';
								// VIP
								$post_author_id= $jobbank_query->post->post_author;
								$author_package_id=get_user_meta($post_author_id, 'iv_directories_package_id', true);
								$have_vip_badge= get_post_meta($author_package_id,'iv_directories_package_vip_badge',true);
								$exprie_date= strtotime (get_user_meta($post_author_id, 'iv_directories_exprie_date', true));
								$current_date=time();
							?>	
							<?php
								include( ep_jobbank_template. 'listing/single-template/archive-grid-block.php');
							?>	
							<?php
								array_push( $dirs_data, $dir_data );
								$i++;
							}
							endwhile;
							$dirs_json_map = json_encode($dirs_data);
						?>
						<?php else :
						$dirs_json=''; ?>
						<?php esc_html_e( 'Sorry, no posts matched your criteria.','jobbank' ); ?>
						<?php endif; ?>
					</div>	
					<div class="row mt-1 post-pagination">
						<div class="col-lg-12 text-center ep-list-style">
							<?php 						
								$GLOBALS['wp_query']->max_num_pages = $jobbank_query->max_num_pages;
								the_posts_pagination(array(
								'next_text' => '<i class="fas fa-angle-double-right"></i>',
								'prev_text' => '<i class="fas fa-angle-double-left"></i>',
								'screen_reader_text' => ' ',
								'type'                => 'list'
								));
							?>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</section>
	<!-- end of arhiece page -->
</div>

<!-- end of bootstrap wrapper -->
<?php
	$dir_addedit_contactustitle=get_option('dir_addedit_contactustitle');
	if($dir_addedit_contactustitle==""){$dir_addedit_contactustitle='Contact US';}
?>
<?php
	wp_enqueue_script('jobbank_message', ep_jobbank_URLPATH . 'admin/files/js/user-message.js');
	wp_localize_script('jobbank_message', 'jobbank_data_message', array(
	'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
	'loading_image'		=> '<img src="'.ep_jobbank_URLPATH.'admin/files/images/loader.gif">',		
	'Please_put_your_message'=>esc_html__('Please put your name,email & message', 'jobbank' ),
	'contact'=> wp_create_nonce("contact"),
	'listing'=> wp_create_nonce("listing"),
	) );
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
	'dirwpnonce'=> wp_create_nonce("myaccount"),
	'listing'=> wp_create_nonce("listing"),
	'cv'=> wp_create_nonce("Doc/CV/PDF"),
	'ep_jobbank_URLPATH'=>ep_jobbank_URLPATH,
	) );
	
?>
<?php
	wp_reset_query();
?>