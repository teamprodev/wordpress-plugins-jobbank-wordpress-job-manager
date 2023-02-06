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
	$post_limit='999999';
	if(isset($atts['post_limit']) and $atts['post_limit']!="" ){
		$post_limit=$atts['post_limit'];
	}	
	$dirs_data =array();
	$tag_arr= array();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array(
	'post_type' => $jobbank_directory_url, // enter your custom post type
	'paged' => $paged,
	'post_status' => 'publish',		
	'posts_per_page'=> $post_limit,  // overrides posts per page in theme settings
	);
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
		$posttags = $atts['tag'];
		$args[$jobbank_directory_url.'-tag']=$posttags;			
	}	
	if( isset($atts['employer'])){ 
		$author = $atts['employer'];
		$args['author__in']= explode(",",$author);	
	}
	if(isset($atts['ids']) AND $atts['ids']!=''){	
		$ids = explode(",",$atts['ids']) ; 
		$args['post__in'] = $ids;
	}	
	// Meta Query***********************
	$joblevel ='';
	if(isset($atts['joblevel']) AND $atts['joblevel']!=''){							
		$joblevel = array(
		'relation' => 'AND',
		array(
		'key'     => 'jobbank_job_level',
		'value'   => explode(",",$atts['joblevel']),
		'compare' => 'IN'
		),
		);
	}
	$experiencerange ='';
	if(isset($atts['experiencerange']) AND $atts['experiencerange']!=''){							
		$experiencerange = array(
		'relation' => 'AND',
		array(
		'key'     => 'jobbank_experience_range',
		'value'   => explode(",",$atts['experiencerange']),
		'compare' => 'IN'
		),
		);
	}
	$gender ='';
	if(isset($atts['gender']) AND $atts['gender']!=''){	
		$gender = array(
		'relation' => 'AND',
		array(
		'key'     => 'gender',
		'value'   => explode(",",$atts['gender']),
		'compare' => 'IN'
		),
		);
	}
	$city_mq ='';
	if(isset($atts['city']) AND $atts['city']!=''){							
		$city_mq = array(
		'relation' => 'AND',
		array(
		'key'     => 'city',
		'value'   => sanitize_text_field($atts['city']),
		'compare' => 'IN'
		),
		);
	}
	$zip_mq='';
	if(isset($atts['zipcode']) AND $atts['zipcode']!=''){	
		$zip_mq = array(
		'relation' => 'AND',
		array(
		'key'     => 'postcode',
		'value'   => $atts['zipcode'],
		'compare' => 'IN'
		),
		);
	}
	$job_type='';
	if( isset($atts['job_type'])){	
		if($atts['job_type']!=""){	
			$jobbank_job_status = array(
			'relation' => 'AND',
			array(
			'key'     => 'job_type',
			'value'   => explode(",",$atts['job_type']),
			'compare' => 'IN'
			),
			);
		}
	}
	if(isset($atts['sort']) AND $atts['sort']!=''){
		if($atts['sort']=='asc'){
			$args['orderby']='title';
			$args['order']='ASC';
		}
		if($atts['sort']=='desc'){
			$args['orderby']='title';
			$args['order']='DESC';
		}
		// Date
		if($atts['sort']=='date-desc'){
			$args['orderby']='date';
			$args['order']='DESC';
		}
		if($atts['sort']=='date-asc'){
			$args['orderby']='date';
			$args['order']='ASC';
		}
		if($atts['sort']=='rand'){
			$args['orderby']='rand';
			$args['order']='ASC';
		}
	}		
	$args['meta_query'] = array(
	$city_mq, $job_type, $zip_mq,$gender,$experiencerange,$joblevel,
	);
	$the_query_filter = new WP_Query( $args );
	$active_archive_fields=jobbank_get_archive_fields_all();	
	$active_archive_icon_saved=get_option('jobbank_archive_icon_saved' );	
?>
<!-- wrap everything for our isolated bootstrap -->
<div class="bootstrap-wrapper">
	<!-- archieve page own design font and others -->
	<section class=" py-5">
		<div class="container-fluid "  >		
			<div class="row" id="full_grid"> 				
				<div class="col-md-12 col-lg-12 col-xl-12 col-sm-12  " id="dirpro_directories" >	
					<div class="clearfix"></div>
					<div class="row justify-content-center" >
						<?php
							$i=0;														
							if ( $the_query_filter->have_posts() ) :
							while ( $the_query_filter->have_posts() ) : $the_query_filter->the_post();
							$id = get_the_ID();
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
							$post_author_id= $the_query_filter->post->post_author;								
							$author_package_id=get_user_meta($post_author_id, 'iv_directories_package_id', true);
							$have_vip_badge= get_post_meta($author_package_id,'iv_directories_package_vip_badge',true);
							$exprie_date= strtotime (get_user_meta($post_author_id, 'iv_directories_exprie_date', true));
							$current_date=time();
							include( ep_jobbank_template. 'listing/single-template/archive-grid-block.php');
							$i++;
							endwhile;
						endif; ?>
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