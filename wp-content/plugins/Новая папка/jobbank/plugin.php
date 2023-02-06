<?php
	/**
		*
		*
		* @version 1.0.4
		* @package Main
		* @author e-plugins
	*/
	/*
		Plugin Name: Job Bank
		Plugin URI: http://e-plugins.com/
		Description: Build Paid job board Listing using Wordpress.No programming knowledge required.
		Author: e-plugins
		Author URI: http://e-plugins.com/
		Version: 1.0.4
		Text Domain: jobbank
		License: GPLv3
	*/
	// Exit if accessed directly
	if (!defined('ABSPATH')) {
		exit;
	}
	if (!class_exists('eplugins_jobbank')) {  	
		final class eplugins_jobbank {
			private static $instance;
			/**
				* The Plug-in version.
				*
				* @var string
			*/
			public $version = "1.0.4";
			/**
				* The minimal required version of WordPress for this plug-in to function correctly.
				*
				* @var string
			*/
			public $wp_version = "3.5";
			public static function instance() {
				if (!isset(self::$instance) && !(self::$instance instanceof eplugins_jobbank)) {
					self::$instance = new eplugins_jobbank;
				}
				return self::$instance;
			}
			/**
				* Construct and start the other plug-in functionality
			*/
			public function __construct() {
				//
				// 1. Plug-in requirements
				//
				if (!$this->check_requirements()) {
					return;
				}
				//
				// 2. Declare constants and load dependencies
				//
				$this->define_constants();
				$this->load_dependencies();
				//
				// 3. Activation Hooks
				//
				register_activation_hook(__FILE__, array($this, 'activate'));
				register_deactivation_hook(__FILE__, array($this, 'deactivate'));
				register_uninstall_hook(__FILE__, 'eplugins_jobbank::uninstall');
				//
				// 4. Load Widget
				//
				add_action('widgets_init', array($this, 'register_widget'));
				//
				// 5. i18n
				//
				add_action('init', array($this, 'i18n'));
				//
				// 6. Actions
				//	
				add_action('wp_ajax_jobbank_check_coupon', array($this, 'jobbank_check_coupon'));
				add_action('wp_ajax_nopriv_jobbank_check_coupon', array($this, 'jobbank_check_coupon'));					
				add_action('wp_ajax_jobbank_check_package_amount', array($this, 'jobbank_check_package_amount'));
				add_action('wp_ajax_nopriv_jobbank_check_package_amount', array($this, 'jobbank_check_package_amount'));
				add_action('wp_ajax_jobbank_update_profile_pic', array($this, 'jobbank_update_profile_pic'));					
				add_action('wp_ajax_jobbank_update_profile_setting', array($this, 'jobbank_update_profile_setting'));
				add_action('wp_ajax_jobbank_update_wp_post', array($this, 'jobbank_update_wp_post'));					
				add_action('wp_ajax_jobbank_save_wp_post', array($this, 'jobbank_save_wp_post'));	
				add_action('wp_ajax_jobbank_update_setting_password', array($this, 'jobbank_update_setting_password'));
				add_action('wp_ajax_jobbank_check_login', array($this, 'jobbank_check_login'));
				add_action('wp_ajax_nopriv_jobbank_check_login', array($this, 'jobbank_check_login'));
				add_action('wp_ajax_jobbank_forget_password', array($this, 'jobbank_forget_password'));
				add_action('wp_ajax_nopriv_jobbank_forget_password', array($this, 'jobbank_forget_password'));					
				add_action('wp_ajax_jobbank_cancel_stripe', array($this, 'jobbank_cancel_stripe'));								
				add_action('wp_ajax_jobbank_cancel_paypal', array($this, 'jobbank_cancel_paypal'));					
				add_action('wp_ajax_jobbank_profile_stripe_upgrade', array($this, 'jobbank_profile_stripe_upgrade'));
				add_action('wp_ajax_jobbank_save_favorite', array($this, 'jobbank_save_favorite'));						
				add_action('wp_ajax_jobbank_save_un_favorite', array($this, 'jobbank_save_un_favorite'));				
				add_action('wp_ajax_jobbank_applied_delete', array($this, 'jobbank_applied_delete'));	
				add_action('wp_ajax_jobbank_save_notification', array($this, 'jobbank_save_notification'));							
				add_action('wp_ajax_jobbank_delete_favorite', array($this, 'jobbank_delete_favorite'));
				add_action('wp_ajax_jobbank_candidate_delete', array($this, 'jobbank_candidate_delete'));
				add_action('wp_ajax_jobbank_candidate_reject', array($this, 'jobbank_candidate_reject'));
				add_action('wp_ajax_jobbank_candidate_shortlisted', array($this, 'jobbank_candidate_shortlisted'));
				add_action('wp_ajax_jobbank_candidate_schedule', array($this, 'jobbank_candidate_schedule'));
				add_action('wp_ajax_jobbank_profile_bookmark', array($this, 'jobbank_profile_bookmark'));
				add_action('wp_ajax_jobbank_profile_bookmark_delete', array($this, 'jobbank_profile_bookmark_delete'));
				add_action('wp_ajax_jobbank_employer_bookmark', array($this, 'jobbank_employer_bookmark'));
				add_action('wp_ajax_jobbank_employer_bookmark_delete', array($this, 'jobbank_employer_bookmark_delete'));
				add_action('wp_ajax_jobbank_message_delete', array($this, 'jobbank_message_delete'));
				add_action('wp_ajax_jobbank_message_send', array($this, 'jobbank_message_send'));
				add_action('wp_ajax_nopriv_jobbank_message_send', array($this, 'jobbank_message_send'));
				add_action('wp_ajax_jobbank_claim_send', array($this, 'jobbank_claim_send'));
				add_action('wp_ajax_nopriv_jobbank_claim_send', array($this, 'jobbank_claim_send'));					
				add_action('wp_ajax_jobbank_cron_job', array($this, 'jobbank_cron_job'));
				add_action('wp_ajax_nopriv_jobbank_cron_job', array($this, 'jobbank_cron_job'));	
				add_action('wp_ajax_jobbank_apply_submit_login', array($this, 'jobbank_apply_submit_login'));
				add_action('wp_ajax_jobbank_apply_submit_nonlogin', array($this, 'jobbank_apply_submit_nonlogin'));
				add_action('wp_ajax_nopriv_jobbank_apply_submit_nonlogin', array($this, 'jobbank_apply_submit_nonlogin'));
				add_action('wp_ajax_jobbank_candidate_meeting_popup', array($this, 'jobbank_candidate_meeting_popup'));
				add_action('wp_ajax_jobbank_candidate_email_popup', array($this, 'jobbank_candidate_email_popup'));
				add_action('wp_ajax_nopriv_jobbank_candidate_email_popup', array($this, 'jobbank_candidate_email_popup'));
				add_action('wp_ajax_jobbank_apply_popup', array($this, 'jobbank_apply_popup'));
				add_action('wp_ajax_nopriv_jobbank_apply_popup', array($this, 'jobbank_apply_popup'));
				add_action('wp_ajax_jobbank_finalerp_csv_product_upload', array($this, 'jobbank_finalerp_csv_product_upload'));
				add_action('wp_ajax_jobbank_save_csv_file_to_database', array($this, 'jobbank_save_csv_file_to_database'));
				add_action('wp_ajax_jobbank_eppro_get_import_status', array($this, 'jobbank_eppro_get_import_status'));		
				add_action('wp_ajax_jobbank_contact_popup', array($this, 'jobbank_contact_popup'));
				add_action('wp_ajax_jobbank_listing_contact_popup', array($this, 'jobbank_listing_contact_popup'));
				add_action('wp_ajax_nopriv_jobbank_listing_contact_popup', array($this, 'jobbank_listing_contact_popup'));
				add_action('wp_ajax_jobbank_load_categories_fields_wpadmin', array($this, 'jobbank_load_categories_fields_wpadmin'));
				add_action('wp_ajax_nopriv_jobbank_load_categories_fields_wpadmin', array($this, 'jobbank_load_categories_fields_wpadmin'));
				add_action('wp_ajax_jobbank_save_post_without_user', array($this, 'jobbank_save_post_without_user'));
				add_action('wp_ajax_nopriv_jobbank_save_post_without_user', array($this, 'jobbank_save_post_without_user'));				
				add_action('add_meta_boxes', array($this, 'jobbank_custom_meta_jobbank'));
				add_action('save_post', array($this, 'jobbank_meta_save'));	
							
				add_action('pre_get_posts',array($this, 'jobbank_restrict_media_library') );	
				// 7. Shortcode
				add_shortcode('jobbank_price_table', array($this, 'jobbank_price_table_func'));				
				add_shortcode('jobbank_form_wizard', array($this, 'jobbank_form_wizard_func'));
				add_shortcode('jobbank_profile_template', array($this, 'jobbank_profile_template_func'));
				add_shortcode('jobbank_candidate_profile_public', array($this, 'jobbank_candidate_profile_public_func'));
				add_shortcode('jobbank_employer_profile_public', array($this, 'jobbank_employer_profile_public_func'));	
				add_shortcode('jobbank_login', array($this, 'jobbank_login_func'));
				add_shortcode('jobbank_employer_directory', array($this, 'jobbank_employer_directory_func'));					
				add_shortcode('jobbank_candidate_directory', array($this, 'jobbank_candidate_directory_func'));
				add_shortcode('jobbank_categories', array($this, 'jobbank_categories_func'));
				add_shortcode('jobbank_featured', array($this, 'jobbank_featured_func'));					
				add_shortcode('jobbank_map', array($this, 'jobbank_map_func'));												
				add_shortcode('jobbank_archive_grid_no_map', array($this, 'jobbank_archive_grid_no_map_func'));
				add_shortcode('jobbank_archive_grid', array($this, 'jobbank_archive_grid_func'));
				add_shortcode('jobbank_archive_grid_top_map', array($this, 'jobbank_archive_grid_top_map_func'));
				add_shortcode('jobbank_search', array($this, 'jobbank_search_func'));
				add_shortcode('jobbank_search_popup', array($this, 'jobbank_search_popup_func'));
				add_shortcode('listing_filter', array($this, 'jobbank_listing_filter_func'));					
				add_shortcode('jobbank_categories_carousel', array($this, 'jobbank_categories_carousel_func'));
				add_shortcode('jobbank_tags_carousel', array($this, 'jobbank_tags_carousel_func'));
				add_shortcode('jobbank_locations_carousel', array($this, 'jobbank_locations_carousel_func'));
				add_shortcode('jobbank_locations', array($this, 'jobbank_locations_func'));						
				add_shortcode('jobbank_reminder_email_cron', array($this, 'jobbank_reminder_email_cron_func'));
				add_shortcode('jobbank_add_listing', array($this, 'jobbank_add_listing_func'));				
				// 8. Filter	
				add_filter( 'template_include', array($this, 'jobbank_include_template_function'), 9, 2  );
				add_filter('request', array($this, 'jobbank_post_type_tags_fix'));						
				add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'jobbank_plugin_action_links' ) );
				// For elementor
				add_action( 'init', array($this, 'jobbank_elementor_file') );
				// *** End elementor
				//---- COMMENT FILTERS ----//		
				add_action('init', array($this, 'jobbank_remove_admin_bar') );	
				add_action( 'init', array($this, 'jobbank_paypal_form_submit') );
				add_action( 'init', array($this, 'jobbank_stripe_form_submit') );
				add_action( 'init', array($this, 'jobbank_post_type') );
				add_action( 'init', array($this, 'jobbank_create_taxonomy_category'));
				add_action( 'init', array($this, 'jobbank_create_taxonomy_tags'));
				add_action( 'init', array($this, 'jobbank_create_taxonomy_locations'));
				add_action( 'init', array($this, 'ep_jobbank_pdf_cv') );
				add_action('init', array($this, 'jobbank_all_functions'));
				add_action( 'wp_loaded', array($this, 'jobbank_woocommerce_form_submit') );
				add_action( 'init', array($this, 'ep_jobbank_cpt_columns') );
				// Add color script
				add_action('wp_enqueue_scripts', array($this, 'jobbank_color_js') );
			}
			/**
				* Define constants needed across the plug-in.
			*/
			private function define_constants() {
				if (!defined('ep_jobbank_BASENAME')) define('ep_jobbank_BASENAME', plugin_basename(__FILE__));
				if (!defined('ep_jobbank_DIR')) define('ep_jobbank_DIR', dirname(__FILE__));
				if (!defined('ep_jobbank_FOLDER'))define('ep_jobbank_FOLDER', plugin_basename(dirname(__FILE__)));
				if (!defined('ep_jobbank_ABSPATH'))define('ep_jobbank_ABSPATH', trailingslashit(str_replace("\\", "/", WP_PLUGIN_DIR . '/' . plugin_basename(dirname(__FILE__)))));
				if (!defined('ep_jobbank_URLPATH'))define('ep_jobbank_URLPATH', trailingslashit(plugins_url() . '/' . plugin_basename(dirname(__FILE__))));
				if (!defined('ep_jobbank_ADMINPATH'))define('ep_jobbank_ADMINPATH', get_admin_url());
				$filename = get_stylesheet_directory()."/jobbank/";
				if (!file_exists($filename)) {					
					if (!defined('ep_jobbank_template'))define( 'ep_jobbank_template', ep_jobbank_ABSPATH.'template/' );
					}else{
					if (!defined('ep_jobbank_template'))define( 'ep_jobbank_template', $filename);
				}	
			}				
			public function jobbank_remove_admin_bar() {
				$iv_hide = get_option('epjbjobbank_hide_admin_bar');
				if (!current_user_can('administrator') && !is_admin()) {
					if($iv_hide=='yes'){							
						show_admin_bar(false);
					}
				}	
			}
			public function jobbank_include_template_function( $template_path ) {
				$jobbank_directory_url=get_option('ep_jobbank_url');					
				if($jobbank_directory_url==""){$jobbank_directory_url='job';}				
				$post_type = get_post_type();
				if($post_type==''){
					if(is_post_type_archive($jobbank_directory_url)){
						$post_type =$jobbank_directory_url;
					}
				}				
				if ( $post_type ==$jobbank_directory_url ) { 	 
					if ( is_single() ) { 
						$template_path =  ep_jobbank_template. 'listing/single-job.php';	
					}				
					if( is_tag() || is_category() || is_archive() ){
						$template_path =  ep_jobbank_template. 'listing/listing-layout.php';
					}
				}
				return $template_path;
			}
			public function jobbank_create_taxonomy_category() {
				$jobbank_directory_url=get_option('ep_jobbank_url');					
				if($jobbank_directory_url==""){$jobbank_directory_url='job';}
				register_taxonomy(
				$jobbank_directory_url.'-category',
				$jobbank_directory_url,
				array(
				'label' => esc_html__( 'Categories','jobbank' ),
				'rewrite' => array( 'slug' => $jobbank_directory_url.'-category' ),
				'hierarchical' => true,					
				'show_in_rest' =>	true,
				)
				);
			}
			public function jobbank_post_type() {
				$jobbank_directory_url=get_option('ep_jobbank_url');					
				if($jobbank_directory_url==""){$jobbank_directory_url='job';}
				$jobbank_directory_url_name=ucfirst($jobbank_directory_url);
				$labels = array(
				'name'                => esc_html__( $jobbank_directory_url_name, 'Post Type General Name', 'jobbank' ),
				'singular_name'       => esc_html__( $jobbank_directory_url_name, 'Post Type Singular Name', 'jobbank' ),
				'menu_name'           => esc_html__( $jobbank_directory_url_name, 'jobbank' ),
				'name_admin_bar'      => esc_html__( $jobbank_directory_url_name, 'jobbank' ),
				'parent_item_colon'   => esc_html__( 'Parent Item:', 'jobbank' ),
				'all_items'           => esc_html__( 'All ', 'jobbank' ).$jobbank_directory_url_name,
				'add_new_item'        => esc_html__( 'Add New Item', 'jobbank' ),
				'add_new'             => esc_html__( 'Add New', 'jobbank' ),
				'new_item'            => esc_html__( 'New Item', 'jobbank' ),
				'edit_item'           => esc_html__( 'Edit Item', 'jobbank' ),
				'update_item'         => esc_html__( 'Update Item', 'jobbank' ),
				'view_item'           => esc_html__( 'View Item', 'jobbank' ),
				'search_items'        => esc_html__( 'Search Item', 'jobbank' ),
				'not_found'           => esc_html__( 'Not found', 'jobbank' ),
				'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'jobbank' ),
				);
				$args = array(
				'label'               => esc_html__( $jobbank_directory_url_name, 'jobbank' ),
				'description'         => esc_html__( $jobbank_directory_url_name, 'jobbank' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'post-formats','custom-fields' ),					
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu' => 		'jobbank',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => true,
				'show_in_rest' =>	true,	
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'post',
				);
				register_post_type( $jobbank_directory_url, $args );
				// For job_apply
				$labels3 = array(
				'name'                => esc_html__( 'Applicants', 'Post Type General Name', 'jobbank' ),
				'singular_name'       => esc_html__( 'Applicants', 'Post Type Singular Name', 'jobbank' ),
				'menu_name'           => esc_html__( 'Applicants', 'jobbank' ),
				'name_admin_bar'      => esc_html__( 'Applicants', 'jobbank' ),
				'parent_item_colon'   => esc_html__( 'Parent Item:', 'jobbank' ),
				'all_items'           => esc_html__( 'All Applicants', 'jobbank' ),
				'add_new_item'        => esc_html__( 'Add New Item', 'jobbank' ),
				'add_new'             => esc_html__( 'Add New', 'jobbank' ),
				'new_item'            => esc_html__( 'New Item', 'jobbank' ),
				'edit_item'           => esc_html__( 'Edit Item', 'jobbank' ),
				'update_item'         => esc_html__( 'Update Item', 'jobbank' ),
				'view_item'           => esc_html__( 'View Item', 'jobbank' ),
				'search_items'        => esc_html__( 'Search Item', 'jobbank' ),
				'not_found'           => esc_html__( 'Not found', 'jobbank' ),
				'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'jobbank' ),
				);
				$args3 = array(
				'label'               => esc_html__( 'Applicants', 'jobbank' ),
				'description'         => esc_html__( 'Applicants', 'jobbank' ),
				'labels'              => $labels3,
				'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'post-formats','custom-fields' ),					
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu' => 		'jobbank',
				'menu_position'       => 5,
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'show_in_rest' =>true,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'post',
				);
				register_post_type( 'job_apply', $args3 );
				// Message 
				$labels4 = array(
				'name'                => esc_html__( 'Message', 'Post Type General Name', 'jobbank' ),
				'singular_name'       => esc_html__( 'Message', 'Post Type Singular Name', 'jobbank' ),
				'menu_name'           => esc_html__( 'Message', 'jobbank' ),
				'name_admin_bar'      => esc_html__( 'Message', 'jobbank' ),
				'parent_item_colon'   => esc_html__( 'Parent Item:', 'jobbank' ),
				'all_items'           => esc_html__( 'All Message', 'jobbank' ),
				'add_new_item'        => esc_html__( 'Add New Item', 'jobbank' ),
				'add_new'             => esc_html__( 'Add New', 'jobbank' ),
				'new_item'            => esc_html__( 'New Item', 'jobbank' ),
				'edit_item'           => esc_html__( 'Edit Item', 'jobbank' ),
				'update_item'         => esc_html__( 'Update Item', 'jobbank' ),
				'view_item'           => esc_html__( 'View Item', 'jobbank' ),
				'search_items'        => esc_html__( 'Search Item', 'jobbank' ),
				'not_found'           => esc_html__( 'Not found', 'jobbank' ),
				'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'jobbank' ),
				);
				$args4 = array(
				'label'               => esc_html__( 'Message', 'jobbank' ),
				'description'         => esc_html__( 'Message', 'jobbank' ),
				'labels'              => $labels4,
				'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'post-formats','custom-fields' ),					
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu' => 		'jobbank',
				'menu_position'       => 5,
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'show_in_rest' =>true,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'post',
				);
				register_post_type( 'jobbank_message', $args4 );
			}
			public function jobbank_post_type_tags_fix($request) {
				$jobbank_directory_url=get_option('ep_jobbank_url');					
				if($jobbank_directory_url==""){$jobbank_directory_url='job';}
				if ( isset($request['tag']) && !isset($request['post_type']) ){
					$request['post_type'] = $jobbank_directory_url;
				}
				return $request;
			} 
			public function ep_jobbank_cpt_columns(){ 				
				require_once(ep_jobbank_DIR . '/admin/pages/manage-cpt-columns.php');				
			}
			public function jobbank_plugin_action_links( $links ) {
				return array_merge( array(
				'settings' => '<a href="admin.php?page=jobbank-settings">' . esc_html__( 'Settings', 'jobbank' ).'</a>',
				'doc'  => '<a href="'.esc_url('http://help.eplug-ins.com/jobbank').'">' . esc_html__( 'Docs', 'jobbank' ) . '</a>',
				), $links );
			}	
		
			
			public function author_public_profile() {
				$author = get_the_author();	
				$iv_redirect = get_option('epjbjobbank_profile_public_page');
				if($iv_redirect!='defult'){ 
					$reg_page= get_permalink( $iv_redirect) ; 
					return    $reg_page.'?&id='.$author; 
					exit;
				}
			}
			
			public function jobbank_login_func($atts = ''){
				global $current_user;
				ob_start();		
				if($current_user->ID==0){
					include(ep_jobbank_template. 'private-profile/profile-login.php');
					}else{	
					include( ep_jobbank_template. 'private-profile/profile-template-1.php');
				}	
				$content = ob_get_clean();	
				return $content;
			}
			public function jobbank_forget_password(){
				parse_str($_POST['form_data'], $data_a);
				if( ! email_exists($data_a['forget_email']) ) {
					echo json_encode(array("code" => "not-success","msg"=>"There is no user registered with that email address."));
					exit(0);
					} else {
					require_once( ep_jobbank_ABSPATH. 'inc/forget-mail.php');
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				}
			}
			public function jobbank_check_login(){
				parse_str($_POST['form_data'], $form_data);
				global $user;
				$creds = array();
				$creds['user_login'] =sanitize_text_field($form_data['username']);
				$creds['user_password'] =  sanitize_text_field($form_data['password']);
				$creds['remember'] = 'true';
				$secure_cookie = is_ssl() ? true : false;
				$user = wp_signon( $creds, $secure_cookie );
				if ( is_wp_error($user) ) {
					echo json_encode(array("code" => "not-success","msg"=>$user->get_error_message()));
					exit(0);
				}
				if ( !is_wp_error($user) ) {
					$iv_redirect = get_option('epjbjobbank_profile_page');
					if($iv_redirect!='defult'){
						$reg_page= get_permalink( $iv_redirect); 
						echo json_encode(array("code" => "success","msg"=>$reg_page));
						exit(0);
					}
				}		
			}
			public function get_unique_keyword_values( $key = 'keyword', $post_type ){
				global $wpdb;
				if( empty( $key ) ){
					return;
				}	
				$res=array();
				$args = array(
				'post_type' => $post_type, // enter your custom post type						
				'post_status' => 'publish',						
				'posts_per_page'=> -1,  // overrides posts per page in theme settings
				);
				$query_auto = new WP_Query( $args );
				$posts_auto = $query_auto->posts;						
				foreach($posts_auto as $post_a) {
					$res[]=$post_a->post_title;
				}	
				return $res;
			}
			public function get_unique_post_meta_values( $key = 'postcode', $post_type ){
				global $wpdb;
				$jobbank_directory_url=get_option('ep_jobbank_url');
				if($jobbank_directory_url==""){$jobbank_directory_url='job';}
				if( empty( $key ) ){
					return;
				}	
				$res = $wpdb->get_col( $wpdb->prepare( "
				SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
				LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
				WHERE p.post_type='{$post_type}' AND  pm.meta_key = '%s'						
				", $key) );
				return $res;
			}  
			public function jobbank_check_field_input_access($field_key_pass, $field_value, $template='myaccount', $user_id){ 
				if($template=='myaccount'){				
					$current_user_id=$user_id;					
					}else{
					$current_user_id=0;		
				}					
				$field_type_opt=  get_option( 'jobbank_field_type' );
				if(!empty($field_type_opt)){
					$field_type=get_option('jobbank_field_type' ); 
					}else{
					$field_type= array();
					$field_type['full_name']='text';								
					$field_type['company_since']='datepicker';
					$field_type['team_size']='text';									
					$field_type['phone']='text';
					$field_type['mobile']='text';
					$field_type['address']='text';
					$field_type['city']='text';
					$field_type['postcode']='text';
					$field_type['state']='text';
					$field_type['country']='text';										
					$field_type['job_title']='text';									
					$field_type['hourly_rate']='text';
					$field_type['experience']='text';
					$field_type['age']='text';
					$field_type['qualification']='text';								
					$field_type['gender']='radio';	
					$field_type['website']='url';
					$field_type['description']='textarea';			
				}
				$field_type_value= get_option( 'jobbank_field_type_value' );
				if($field_type_value==''){
					$field_type_value=array();
					$field_type_value['gender']=esc_html__('Female,Male,Other', 'jobbank');	
				}	
				$return_value='';
				if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='dropdown'){	 								
					$dropdown_value= explode(',',$field_type_value[$field_key_pass]);
					$return_value=$return_value.'<div class="col-md-6"><div class="form-group">
					<label class="control-label">'. esc_html($field_value).'</label>
					<select name="'. esc_html($field_key_pass).'" id="'.esc_attr($field_key_pass).'" class="form-control col-md-12"  >';				
					foreach($dropdown_value as $one_value){	 
						if(trim($one_value)!=''){
							$return_value=$return_value.'<option '.(trim(get_user_meta($current_user_id,$field_key_pass,true))==trim($one_value)?' selected':'').' value="'. esc_attr($one_value).'">'. esc_html($one_value).'</option>';
						}
					}	
					$return_value=$return_value.'</select></div></div>';					
				}
				if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='checkbox'){	 								
					$dropdown_value= explode(',',$field_type_value[$field_key_pass]);
					$return_value=$return_value.'<div class="col-md-6"><div class="form-group">
					<label class="control-label ">'. esc_html($field_value).'</label>						
					';
					$saved_checkbox_value =	explode(',',get_user_meta($current_user_id,$field_key_pass,true));
					foreach($dropdown_value as $one_value){
						if(trim($one_value)!=''){
							$return_value=$return_value.'
							<div class="form-check form-check-inline">
							<label class="form-check-label" for="'. esc_attr($one_value).'">
							<input '.( in_array($one_value,$saved_checkbox_value)?' checked':'').' class=" form-check-input" type="checkbox" name="'. esc_attr($field_key_pass).'[]"  id="'. esc_attr($one_value).'" value="'. esc_attr($one_value).'">
							'. esc_html($one_value).' </label>
							</div>';
						}
					}	
					$return_value=$return_value.'</div></div>';						
				}
				if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='radio'){	 								
					$dropdown_value= explode(',',$field_type_value[$field_key_pass]);
					$return_value=$return_value.'<div class="col-md-6"><div class="form-group ">
					<label class="control-label ">'. esc_html($field_value).'</label>
					';						
					foreach($dropdown_value as $one_value){	 
						if(trim($one_value)!=''){
							$return_value=$return_value.'
							<div class="form-check form-check-inline">
							<label class="form-check-label" for="'. esc_attr($one_value).'">
							<input '.(get_user_meta($current_user_id,$field_key_pass,true)==$one_value?' checked':'').' class="form-check-input" type="radio" name="'. esc_attr($field_key_pass).'"  id="'. esc_attr($one_value).'" value="'. esc_attr($one_value).'">
							'. esc_html($one_value).'</label>
							</div>														
							';
						}
					}	
					$return_value=$return_value.'</div></div>';					
				}					 
				if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='textarea'){	 
					$return_value=$return_value.'<div class="col-md-12"><div class="form-group">';
					$return_value=$return_value.'<label class="control-label ">'. esc_html($field_value).'</label>';
					$return_value=$return_value.'<textarea  placeholder="'.esc_html__('Enter ','jobbank').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-textarea col-md-12"  rows="4"/>'.esc_textarea(get_user_meta($current_user_id,$field_key_pass,true)).'</textarea></div></div>';
				}
				if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='datepicker'){	 
					$return_value=$return_value.'<div class="col-md-6"><div class="form-group ">';
					$return_value=$return_value.'<label class="control-label ">'. esc_html($field_value).'</label>';
					$return_value=$return_value.'<input type="text" placeholder="'.esc_html__('Select ','jobbank').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-control epinputdate " value="'.esc_attr(get_user_meta($current_user_id,$field_key_pass,true)).'"/></div></div>';
				}
				if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='text'){ 
					if($field_value=='address'){								
						$return_value=$return_value.'<input type="hidden" class="form-control" name="address" id="address" value="'. esc_attr(get_user_meta($current_user_id,'address',true)).'" >									
						<div class=" form-group col-md-12">
						<label for="text" class=" control-label">'.esc_html__('Address','jobbank').'</label>
						<div id="map"></div>
						<div id="search-box"></div>
						<div id="result"></div>
						</div>';
						}else{
						$return_value=$return_value.'<div class="col-md-6"><div class="form-group ">';
						$return_value=$return_value.'<label class="control-label ">'. esc_html($field_value).'</label>';
						$return_value=$return_value.'<input type="text" placeholder="'.esc_html__('Enter ','jobbank').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-control " value="'.esc_attr(get_user_meta($current_user_id,$field_key_pass,true)).'"/></div></div>';
					}
				}
				if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='url'){	 
					$return_value=$return_value.'<div class="col-md-6"><div class="form-group ">';
					$return_value=$return_value.'<label class="control-label ">'. esc_html($field_value).'</label>';
					$return_value=$return_value.'<input type="text" placeholder="'.esc_html__('Enter ','jobbank').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-control " value="'.esc_url(get_user_meta($current_user_id,$field_key_pass,true)).'"/></div></div>';
				}
				return $return_value;
			}
			public function jobbank_check_field_input_access_signup($field_key_pass, $field_value){ 
				$sign_up_array=		get_option( 'jobbank_signup_fields');
				$require_array=		get_option( 'jobbank_signup_require');
				$field_type=  		get_option( 'jobbank_field_type' );
				$field_type_value=  get_option( 'jobbank_field_type_value' );
				$field_type_roles=  get_option( 'jobbank_field_type_roles' );
				$myaccount_fields_array=  get_option( 'jobbank_myaccount_fields' );
				$return_value='';
				$require='no';				
				if(isset($require_array[$field_key_pass]) && $require_array[$field_key_pass] == 'yes') {
					$require='yes';
				}
				if(isset($sign_up_array[$field_key_pass]) && $sign_up_array[$field_key_pass]=='yes'){
					if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='dropdown'){	 								
						$dropdown_value= explode(',',$field_type_value[$field_key_pass]);
						$return_value=$return_value.'<div class="form-group row">
						<label class="control-label col-md-4">'. esc_html($field_value).'</label>
						<div class="col-md-8"><select name="'. esc_html($field_key_pass).'" id="'.esc_attr($field_key_pass).'" class="form-dropdown col-md-12" '.($require=='yes'?'data-validation="required" data-validation-error-msg="'. esc_html__('This field cannot be left blank','jobbank').'"':'').'>';				
						foreach($dropdown_value as $one_value){	 	
							if(trim($one_value)!=''){
								$return_value=$return_value.'<option value="'. esc_attr($one_value).'">'. esc_html($one_value).'</option>';
							}
						}	
						$return_value=$return_value.'</select></div></div>';					
					}
					if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='checkbox'){	 								
						$dropdown_value= explode(',',$field_type_value[$field_key_pass]);
						$return_value=$return_value.'<div class="form-group row">
						<label class="control-label col-md-4">'. esc_html($field_value).'</label>
						<div class="col-md-8">
						<div class="" >
						';
						foreach($dropdown_value as $one_value){
							if(trim($one_value)!=''){
								$return_value=$return_value.'
								<div class="form-check form-check-inline col-md-4">
								<input class=" form-check-input" type="checkbox" name="'. esc_attr($field_key_pass).'[]"  id="'. esc_attr($one_value).'" value="'. esc_attr($one_value).'" '.($require=='yes'?'data-validation="required" data-validation-error-msg="'. esc_html__('Required','jobbank').'"':'').'>
								<label class="form-check-label" for="'. esc_attr($one_value).'">							
								'. esc_attr($one_value).' </label>
								</div>';
							}
						}	
						$return_value=$return_value.'</div></div></div>';						
					}
					if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='radio'){	 								
						$dropdown_value= explode(',',$field_type_value[$field_key_pass]);
						$return_value=$return_value.'<div class="form-group row ">
						<label class="control-label col-md-4">'. esc_html($field_value).'</label>
						<div class="col-md-8">
						<div class="" >
						';						
						foreach($dropdown_value as $one_value){	 		
							if(trim($one_value)!=''){
								$return_value=$return_value.'
								<div class="form-check form-check-inline col-md-4">
								<label class="form-check-label" for="'. esc_attr($one_value).'">
								<input class="form-check-input" type="radio" name="'. esc_attr($field_key_pass).'"  id="'. esc_attr($one_value).'" value="'. esc_attr($one_value).'" '.($require=='yes'?'data-validation="required" data-validation-error-msg="'. esc_html__('Required','jobbank').'"':'').'>
								'. esc_attr($one_value).'</label>
								</div>';
							}
						}	
						$return_value=$return_value.'</div></div></div>';					
					}					 
					if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='textarea'){	 
						$return_value=$return_value.'<div class="form-group row">';
						$return_value=$return_value.'<label class="control-label col-md-4">'. esc_html($field_value).'</label><div class="col-md-8">';
						$return_value=$return_value.'<textarea  placeholder="'.esc_html__('Enter ','jobbank').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-textarea col-md-12"  rows="4"/ '.($require=='yes'?'data-validation="length" data-validation-length="2-100"':'').'></textarea></div></div>';
					}
					if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='datepicker'){	 
						$return_value=$return_value.'<div class="form-group row">';
						$return_value=$return_value.'<label class="control-label col-md-4">'. esc_html($field_value).'</label>';
						$return_value=$return_value.'<div class="col-md-8"><input type="text" placeholder="'.esc_html__('Select ','jobbank').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-date col-md-12 epinputdate " '.($require=='yes'?'data-validation="required" data-validation-error-msg="'. esc_html__('This field cannot be left blank','jobbank').'"':'').' /></div></div>';
					}
					if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='text'){	 
						$return_value=$return_value.'<div class="form-group row">';
						$return_value=$return_value.'<label class="control-label col-md-4">'. esc_html($field_value).'</label>';
						$return_value=$return_value.'<div class="col-md-8"><input type="text" placeholder="'.esc_html__('Enter ','jobbank').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-input col-md-12" '.($require=='yes'?'data-validation="length" data-validation-length="2-100"':'').' /></div></div>';
					}
					if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='url'){	 
						$return_value=$return_value.'<div class="form-group row">';
						$return_value=$return_value.'<label class="control-label col-md-4">'. esc_html($field_value).'</label>';
						$return_value=$return_value.'<div class="col-md-8"><input type="text" placeholder="'.esc_html__('Enter ','jobbank').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-input col-md-12" '.($require=='yes'?'data-validation="length" data-validation-length="2-100"':'').' /></div></div>';
					}
				}
				return $return_value;
			}
			public function user_profile_image_upload($userid){
				$iv_membership_signup_profile_pic=get_option('jobbank_signup_profile_pic');
				if($iv_membership_signup_profile_pic=='' ){ $iv_membership_signup_profile_pic='yes';}	
				if($iv_membership_signup_profile_pic=='yes' ){ 
					if ( 0 < $_FILES['profilepicture']['error'] ) { 
						echo json_encode(array("code" => "Error","msg"=>esc_html__( 'File Error', 'jobbank')));						
					}
					else {  
						$new_file_type = mime_content_type( $_FILES['profilepicture']['tmp_name'] );	
						if( in_array( $new_file_type, get_allowed_mime_types() ) ){   
							$upload_dir   = wp_upload_dir();
							$date = date('YmdHis');						
							$file_name = $date.$_FILES['profilepicture']['name'];
							$return= move_uploaded_file($_FILES['profilepicture']['tmp_name'],  $upload_dir['basedir'].'/'.$file_name);
							if($return){  
								$image_url= $upload_dir['baseurl'].'/'.$file_name;
								update_user_meta($userid, 'jobbank_profile_pic_thum',sanitize_url($image_url));
							}
						}
					}
				}
			}
			public function jobbank_update_wp_post(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'addlisting' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'edit_posts' ) ) {
					wp_die( 'Are you cheating:user Permission?' );								
				}
				global $current_user;global $wpdb;	
				$allowed_html = wp_kses_allowed_html( 'post' );	
				$jobbank_directory_url=get_option('ep_jobbank_url');					
				if($jobbank_directory_url==""){$jobbank_directory_url='job';}
				parse_str($_POST['form_data'], $form_data);
				$newpost_id= sanitize_text_field($form_data['user_post_id']);
				$my_post = array();
				$my_post['ID'] = $newpost_id;
				$my_post['post_title'] = sanitize_text_field($form_data['title']);
				$my_post['post_content'] =  wp_kses( $form_data['new_post_content'], $allowed_html);
				$my_post['post_type'] 	= $jobbank_directory_url;					
				$jobbank_user_can_publish=get_option('jobbank_user_can_publish');	
				if($jobbank_user_can_publish==""){$jobbank_user_can_publish='yes';}	
				$my_post['post_status']=$form_data['post_status'];
				if($form_data['post_status']=='publish'){					
					$my_post['post_status']='pending';
					if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
						$my_post['post_status']='publish';
						}else{ 
						if($jobbank_user_can_publish=="yes"){ 
							$my_post['post_status']='publish';
							}else{
							$my_post['post_status']='pending';
						}								
					}						
				}
				wp_update_post( $my_post );
				if(isset($form_data['feature_image_id'] ) AND $form_data['feature_image_id']!='' ){
					$attach_id =sanitize_text_field($form_data['feature_image_id']);
					set_post_thumbnail( sanitize_text_field($form_data['user_post_id']), $attach_id );
					}else{
					$attach_id='0';
					delete_post_thumbnail( sanitize_text_field($form_data['user_post_id']));
				}
				if(isset($form_data['postcats'] )){ 
					$category_ids = $form_data['postcats'];
					$input_array_data= sanitize_text_field($category_ids) ;
					if(is_array($category_ids)){
						$input_array_data= array();
						foreach($category_ids as $one_input_field){
							$input_array_data[]=sanitize_text_field($one_input_field);
						}					
					}
					wp_set_object_terms( $newpost_id, $input_array_data, $jobbank_directory_url.'-category');
				}
				if(isset($form_data['new_category'] )){						
					$tag_new= explode(",", $form_data['new_category']); 			
					foreach($tag_new  as $one_tag){	
						wp_add_object_terms( $newpost_id, sanitize_text_field($one_tag), $jobbank_directory_url.'-category');
					}
				}	
				// Location
				if(isset($form_data['location_arr'] )){ 
					$location_arr = $form_data['location_arr'];
					$input_array_data= sanitize_text_field($location_arr) ;
					if(is_array($location_arr)){
						$input_array_data= array();
						foreach($location_arr as $one_input_field){
							$input_array_data[]=sanitize_text_field($one_input_field);
						}					
					}
					
					wp_set_object_terms( $newpost_id, $input_array_data, $jobbank_directory_url.'-locations');
				}
				if(isset($form_data['new_location'] )){						
					$tag_new= explode(",", $form_data['new_location']); 			
					foreach($tag_new  as $one_tag){	
						wp_add_object_terms( $newpost_id, sanitize_text_field($one_tag), $jobbank_directory_url.'-locations');
					}
				}	
				// Check Feature*************	
				$post_author_id= $current_user->ID;
				$author_package_id=get_user_meta($post_author_id, 'jobbank_package_id', true);
				$have_package_feature= get_post_meta($author_package_id,'jobbank_package_feature',true);
				$exprie_date= strtotime (get_user_meta($post_author_id, 'jobbank_exprie_date', true));
				$current_date=time();						
				if($have_package_feature=='yes'){
					if($exprie_date >= $current_date){ 
						update_post_meta($newpost_id, 'jobbank_featured', 'featured' );	
					}	
					}else{
					update_post_meta($newpost_id, 'jobbank_featured', 'no' );	
				}
				// job detail *****	
				update_post_meta($newpost_id, 'job_education', wp_kses( $form_data['content_education'], $allowed_html));	
				update_post_meta($newpost_id, 'job_must_have', wp_kses( $form_data['content_must_have'], $allowed_html));
				// For Tag Save tag_arr			
				$tag_all='';
				if(isset($form_data['tag_arr'] )){
					$tag_name= $form_data['tag_arr'] ;	
					$input_array_data= sanitize_text_field($tag_name) ;
					if(is_array($tag_name)){
						$input_array_data= array();
						foreach($tag_name as $one_input_field){
							$input_array_data[]=sanitize_text_field($one_input_field);
						}					
					}
					
					$i=0;$tag_all='';						
					wp_set_object_terms( $newpost_id, $input_array_data, $jobbank_directory_url.'-tag');							
				}
				$tag_all='';
				if(isset($form_data['new_tag'] )){						
					$tag_new= explode(",", $form_data['new_tag']); 			
					foreach($tag_new  as $one_tag){	
						wp_add_object_terms( $newpost_id, sanitize_text_field($one_tag), $jobbank_directory_url.'-tag');											
						$i++;	
					}
				}	
				update_post_meta($newpost_id, 'address', sanitize_text_field($form_data['address'])); 
				update_post_meta($newpost_id, 'latitude', sanitize_text_field($form_data['latitude']));  
				update_post_meta($newpost_id, 'longitude', sanitize_text_field($form_data['longitude']));					
				update_post_meta($newpost_id, 'city', sanitize_text_field($form_data['city'])); 
				update_post_meta($newpost_id, 'state', sanitize_text_field($form_data['state'])); 
				update_post_meta($newpost_id, 'postcode', sanitize_text_field($form_data['postcode'])); 
				update_post_meta($newpost_id, 'country', sanitize_text_field($form_data['country'])); 
				update_post_meta($newpost_id, 'local-area', sanitize_text_field($form_data['local-area'])); 
				// For FAQ Save
				// Delete 1st
				$i=0;
				for($i=0;$i<20;$i++){
					delete_post_meta($newpost_id, 'faq_title'.$i);							
					delete_post_meta($newpost_id, 'faq_description'.$i);
				}
				// Delete End
				if(isset($form_data['faq_title'] )){
					$faq_title= $form_data['faq_title']; //this is array data we sanitize later, when it save				
					$faq_description= $form_data['faq_description'];
					$i=0;
					for($i=0;$i<20;$i++){
						if(isset($faq_title[$i]) AND $faq_title[$i]!=''){
							update_post_meta($newpost_id, 'faq_title'.$i, sanitize_text_field($faq_title[$i]));
							update_post_meta($newpost_id, 'faq_description'.$i, sanitize_textarea_field($faq_description[$i]));
						}
					}
				}
				// End FAQ
				$default_fields = array();
				$field_set=get_option('jobbank_li_fields' );
				if($field_set!=""){ 
					$default_fields=get_option('jobbank_li_fields' );
					}else{															
					$default_fields['business_type']='Business Type';
					$default_fields['main_products']='Main Products';
					$default_fields['number_of_employees']='Number Of Employees';
					$default_fields['main_markets']='Main Markets';
					$default_fields['total_annual_sales_volume']='Total Annual Sales Volume';	
				}				
				if(sizeof($default_fields )){			
					foreach( $default_fields as $field_key => $field_value ) { 
						update_post_meta($newpost_id, $field_key, $form_data[$field_key] );							
					}					
				}
				// job detail*****
				update_post_meta($newpost_id, 'jobbank_job_status', sanitize_text_field($form_data['job_type'])); 
				update_post_meta($newpost_id, 'educational_requirements', sanitize_text_field($form_data['educational_requirements'])); 
				update_post_meta($newpost_id, 'job_type', sanitize_text_field($form_data['job_type'])); 
				update_post_meta($newpost_id, 'jobbank_job_level', sanitize_text_field($form_data['jobbank_job_level'])); 
				update_post_meta($newpost_id, 'jobbank_experience_range', sanitize_text_field($form_data['jobbank_experience_range'])); 
				update_post_meta($newpost_id, 'age_range', sanitize_text_field($form_data['age_range'])); 
				update_post_meta($newpost_id, 'gender', sanitize_text_field($form_data['gender'])); 
				update_post_meta($newpost_id, 'vacancy', sanitize_text_field($form_data['vacancy'])); 
				if($form_data['deadline']==''){ 
					$deadline= date("Y-m-d", strtotime("+1 month"));
					}else{
					$deadline=sanitize_text_field($form_data['deadline']);
				}
				update_post_meta($newpost_id, 'deadline', $deadline); 
				update_post_meta($newpost_id, 'workplace', sanitize_text_field($form_data['workplace']));
				update_post_meta($newpost_id, 'salary', sanitize_text_field($form_data['salary']));
				update_post_meta($newpost_id, 'other_benefits', sanitize_text_field($form_data['other_benefits']));
				if(isset($form_data['dirpro_email_button'])){						
					update_post_meta($newpost_id, 'dirpro_email_button', sanitize_text_field($form_data['dirpro_email_button'])); 
				}
				if(isset($form_data['dirpro_web_button'])){						
					update_post_meta($newpost_id, 'dirpro_web_button', sanitize_text_field($form_data['dirpro_web_button'])); 
				}
				update_post_meta($newpost_id, 'image_gallery_ids', sanitize_text_field($form_data['gallery_image_ids'])); 
				update_post_meta($newpost_id, 'topbanner', sanitize_text_field($form_data['topbanner_image_id'])); 
				if(isset($form_data['feature_image_id'] )){
					$attach_id =sanitize_text_field($form_data['feature_image_id']);
					set_post_thumbnail( $newpost_id, $attach_id );					
				}	
				update_post_meta($newpost_id, 'external_form_url', sanitize_url($form_data['external_form_url']));  
				update_post_meta($newpost_id, 'listing_contact_source', sanitize_text_field($form_data['contact_source']));  
				update_post_meta($newpost_id, 'company_name', sanitize_text_field($form_data['company_name']));
				update_post_meta($newpost_id, 'phone', sanitize_text_field($form_data['phone'])); 
				update_post_meta($newpost_id, 'address', sanitize_text_field($form_data['address'])); 
				update_post_meta($newpost_id, 'contact-email', sanitize_text_field($form_data['contact-email'])); 
				update_post_meta($newpost_id, 'contact_web', sanitize_text_field($form_data['contact_web']));				
				update_post_meta($newpost_id, 'vimeo', sanitize_text_field($form_data['vimeo'])); 
				update_post_meta($newpost_id, 'youtube', sanitize_text_field($form_data['youtube'])); 
				delete_post_meta($newpost_id, 'jobbank-tags');
				delete_post_meta($newpost_id, 'jobbank-category');
				delete_post_meta($newpost_id, 'jobbank-locations');
				
				if($form_data['post_status']=='publish'){ 
					include( ep_jobbank_ABSPATH. 'inc/add-listing-notification.php');
					include( ep_jobbank_ABSPATH. 'inc/notification.php');
				}
				echo json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'jobbank')));
				exit(0);				
			}
			public function jobbank_save_wp_post(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'addlisting' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'edit_posts' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}
				$allowed_html = wp_kses_allowed_html( 'post' );	
				global $current_user; global $wpdb;	
				parse_str($_POST['form_data'], $form_data);				
				$my_post = array();
				$jobbank_directory_url=get_option('ep_jobbank_url');					
				if($jobbank_directory_url==""){$jobbank_directory_url='job';}
				$post_type = $jobbank_directory_url;
				$jobbank_user_can_publish=get_option('jobbank_user_can_publish');	
				if($jobbank_user_can_publish==""){$jobbank_user_can_publish='yes';}	
				if($form_data['post_status']=='publish'){					
					$form_data['post_status']='pending';
					if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
						$form_data['post_status']='publish';
						}else{
						if($jobbank_user_can_publish=="yes"){
							$form_data['post_status']='publish';
							}else{
							$form_data['post_status']='pending';
						}								
					}						
				}
				$my_post['post_title'] = sanitize_text_field($form_data['title']);
				$my_post['post_content'] = wp_kses( $form_data['new_post_content'], $allowed_html); 
				$my_post['post_type'] = $post_type;
				$my_post['post_status'] = sanitize_text_field($form_data['post_status']);										
				$newpost_id= wp_insert_post( $my_post );
				update_post_meta($newpost_id, 'jobbank_job_status', sanitize_text_field($form_data['job_type'])); 
				// WPML Start******
				if ( function_exists('icl_object_id') ) {
					include_once( WP_PLUGIN_DIR . '/sitepress-multilingual-cms/inc/wpml-api.php' );
					$_POST['icl_post_language'] = $language_code = ICL_LANGUAGE_CODE;
					$query =$wpdb->prepare( "UPDATE {$wpdb->prefix}icl_translations SET element_type='post_%s' WHERE element_id='%s' LIMIT 1",$post_type,$newpost_id );
					$wpdb->query($query);					
				}
				// End WPML**********	
				if(isset($form_data['postcats'] )){ 				
					$category_ids = $form_data['postcats'];
					$input_array_data= sanitize_text_field($category_ids) ;
					if(is_array($category_ids)){
						$input_array_data= array();
						foreach($category_ids as $one_input_field){
							$input_array_data[]=sanitize_text_field($one_input_field);
						}					
					}
					wp_set_object_terms( $newpost_id, $input_array_data, $jobbank_directory_url.'-category');
				}
				if(isset($form_data['new_category'] )){						
					$tag_new= explode(",", $form_data['new_category']); 			
					foreach($tag_new  as $one_tag){	
						wp_add_object_terms( $newpost_id, sanitize_text_field($one_tag), $jobbank_directory_url.'-category');							
					}
				}	
				// For FAQ Save				
				if(isset($form_data['faq_title'] )){
					$faq_title= $form_data['faq_title']; //this is array data we sanitize later, when it save				
					$faq_description= $form_data['faq_description'];
					$i=0;
					for($i=0;$i<20;$i++){
						if(isset($faq_title[$i]) AND $faq_title[$i]!=''){
							update_post_meta($newpost_id, 'faq_title'.$i, sanitize_text_field($faq_title[$i]));
							update_post_meta($newpost_id, 'faq_description'.$i, sanitize_textarea_field($faq_description[$i]));
						}
					}
				}
				// End FAQ
				// Location
				if(isset($form_data['location_arr'] )){ 
					$location_arr = $form_data['location_arr'];
					$input_array_data= sanitize_text_field($location_arr) ;
					if(is_array($location_arr)){
						$input_array_data= array();
						foreach($location_arr as $one_input_field){
							$input_array_data[]=sanitize_text_field($one_input_field);
						}					
					}
					
					wp_set_object_terms( $newpost_id, $input_array_data, $jobbank_directory_url.'-locations');
				}
				if(isset($form_data['new_location'] )){						
					$tag_new= explode(",", $form_data['new_location']); 			
					foreach($tag_new  as $one_tag){	
						wp_add_object_terms( $newpost_id, sanitize_text_field($one_tag), $jobbank_directory_url.'-locations');
					}
				}	
				$default_fields = array();
				$field_set=get_option('jobbank_li_fields' );
				if($field_set!=""){ 
					$default_fields=get_option('jobbank_li_fields' );
					}else{															
					$default_fields['business_type']='Business Type';
					$default_fields['main_products']='Main Products';
					$default_fields['number_of_employees']='Number Of Employees';
					$default_fields['main_markets']='Main Markets';
					$default_fields['total_annual_sales_volume']='Total Annual Sales Volume';	
				}					
				if(sizeof($default_fields )){			
					foreach( $default_fields as $field_key => $field_value ) { 
						update_post_meta($newpost_id, $field_key, $form_data[$field_key] );							
					}					
				}
				// Check Feature*************	
				$post_author_id= $current_user->ID;
				$author_package_id=get_user_meta($post_author_id, 'jobbank_package_id', true);
				$have_package_feature= get_post_meta($author_package_id,'jobbank_package_feature',true);
				$exprie_date= strtotime (get_user_meta($post_author_id, 'jobbank_exprie_date', true));
				$current_date=time();						
				if($have_package_feature=='yes'){
					if($exprie_date >= $current_date){
						update_post_meta($newpost_id, 'jobbank_featured', 'featured' );	
					}	
					}else{
					update_post_meta($newpost_id, 'jobbank_featured', 'no' );	
				}
				update_post_meta($newpost_id, 'job_education', wp_kses( $form_data['content_education'], $allowed_html));	
				update_post_meta($newpost_id, 'job_must_have', wp_kses( $form_data['content_must_have'], $allowed_html));
				// For Tag Save tag_arr
				$tag_all='';
				if(isset($form_data['tag_arr'] )){
					$tag_name= $form_data['tag_arr'] ;	
					$input_array_data= sanitize_text_field($tag_name) ;
					if(is_array($tag_name)){
						$input_array_data= array();
						foreach($tag_name as $one_input_field){
							$input_array_data[]=sanitize_text_field($one_input_field);
						}					
					}
					
					$i=0;$tag_all='';						
					wp_set_object_terms( $newpost_id, $input_array_data, $jobbank_directory_url.'-tag');							
				}
				$tag_all='';
				if(isset($form_data['new_tag'] )){						
					$tag_new= explode(",", $form_data['new_tag']); 			
					foreach($tag_new  as $one_tag){	
						wp_add_object_terms( $newpost_id, sanitize_text_field($one_tag), $jobbank_directory_url.'-tag');											
						$i++;	
					}
				}	
				update_post_meta($newpost_id, 'address', sanitize_text_field($form_data['address'])); 
				update_post_meta($newpost_id, 'latitude', sanitize_text_field($form_data['latitude'])); 
				update_post_meta($newpost_id, 'longitude', sanitize_text_field($form_data['longitude']));					
				update_post_meta($newpost_id, 'city', sanitize_text_field($form_data['city'])); 
				update_post_meta($newpost_id, 'state', sanitize_text_field($form_data['state'])); 
				update_post_meta($newpost_id, 'postcode', sanitize_text_field($form_data['postcode'])); 
				update_post_meta($newpost_id, 'country', sanitize_text_field($form_data['country'])); 
				update_post_meta($newpost_id, 'local-area', sanitize_text_field($form_data['local-area'])); 
				// job detail*****
				update_post_meta($newpost_id, 'educational_requirements', sanitize_text_field($form_data['educational_requirements'])); 
				update_post_meta($newpost_id, 'job_type', sanitize_text_field($form_data['job_type'])); 
				update_post_meta($newpost_id, 'jobbank_job_level', sanitize_text_field($form_data['jobbank_job_level'])); 
				update_post_meta($newpost_id, 'jobbank_experience_range', sanitize_text_field($form_data['jobbank_experience_range'])); 
				update_post_meta($newpost_id, 'age_range', sanitize_text_field($form_data['age_range'])); 
				update_post_meta($newpost_id, 'gender', sanitize_text_field($form_data['gender'])); 
				update_post_meta($newpost_id, 'vacancy', sanitize_text_field($form_data['vacancy'])); 
				if($form_data['deadline']==''){ 
					$deadline= date("Y-m-d", strtotime("+1 month"));
					}else{
					$deadline=sanitize_text_field($form_data['deadline']);
				}
				update_post_meta($newpost_id, 'deadline', $deadline);  
				update_post_meta($newpost_id, 'workplace', sanitize_text_field($form_data['workplace']));
				update_post_meta($newpost_id, 'salary', sanitize_text_field($form_data['salary']));
				update_post_meta($newpost_id, 'other_benefits', sanitize_text_field($form_data['other_benefits']));
				if(isset($form_data['dirpro_email_button'])){						
					update_post_meta($newpost_id, 'dirpro_email_button', sanitize_text_field($form_data['dirpro_email_button'])); 
				}
				if(isset($form_data['dirpro_web_button'])){						
					update_post_meta($newpost_id, 'dirpro_web_button', sanitize_text_field($form_data['dirpro_web_button'])); 
				}
				update_post_meta($newpost_id, 'image_gallery_ids', sanitize_text_field($form_data['gallery_image_ids'])); 
				update_post_meta($newpost_id, 'topbanner', sanitize_text_field($form_data['topbanner_image_id'])); 
				update_post_meta($newpost_id, 'listing_contact_source', sanitize_text_field($form_data['contact_source']));  
				update_post_meta($newpost_id, 'external_form_url', sanitize_url($form_data['external_form_url']));  
				if(isset($form_data['feature_image_id'] )){
					$attach_id =sanitize_text_field($form_data['feature_image_id']);
					set_post_thumbnail( $newpost_id, $attach_id );					
				}	
				update_post_meta($newpost_id, 'company_name', sanitize_text_field($form_data['company_name']));
				update_post_meta($newpost_id, 'phone', sanitize_text_field($form_data['phone'])); 
				update_post_meta($newpost_id, 'address', sanitize_text_field($form_data['address'])); 
				update_post_meta($newpost_id, 'contact-email', sanitize_text_field($form_data['contact-email'])); 
				update_post_meta($newpost_id, 'contact_web', sanitize_text_field($form_data['contact_web']));
				update_post_meta($newpost_id, 'vimeo', sanitize_text_field($form_data['vimeo'])); 
				update_post_meta($newpost_id, 'youtube', sanitize_text_field($form_data['youtube']));
				
				include( ep_jobbank_ABSPATH. 'inc/add-listing-notification.php');
				if($form_data['post_status']=='publish'){ 
					include( ep_jobbank_ABSPATH. 'inc/notification.php');
				}
				echo json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'jobbank')));
				exit(0);
			}
			// add listing jobbank_save_post_without_user
			public function jobbank_save_post_without_user(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'addlisting' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				$allowed_html = wp_kses_allowed_html( 'post' );	
				global $current_user; global $wpdb;	
				parse_str($_POST['form_data'], $form_data);		
				if($form_data['user_id']=='0'){ 					// create new user 
					if($form_data['n_user_email']!='' and $form_data['n_password']!='' ){ 
						$userdata = array();
						$userdata['user_email']=sanitize_email($form_data['n_user_email']);
						$userdata['user_login']='';
						$userdata['user_pass']=sanitize_text_field($form_data['n_password']);
						if ( email_exists($userdata['user_email']) == false ) {						
							$user_id = wp_create_user($userdata['user_email'],$userdata['user_pass'],$userdata['user_email']); 
							update_user_meta($user_id, 'user_type','employer'); 
							wp_clear_auth_cookie();
							wp_set_current_user ( $user_id);
							wp_set_auth_cookie  ( $user_id );
							include( ep_jobbank_ABSPATH. 'inc/signup-mail.php');
							}else{
							echo json_encode(array("code" => "error","msg"=>esc_html__( 'Email already exists ', 'jobbank')));
							exit(0);
						}
					}	
				}
				$my_post = array();
				$jobbank_directory_url=get_option('ep_jobbank_url');					
				if($jobbank_directory_url==""){$jobbank_directory_url='job';}
				$post_type = $jobbank_directory_url;
				$jobbank_user_can_publish=get_option('jobbank_user_can_publish');	
				if($jobbank_user_can_publish==""){$jobbank_user_can_publish='yes';}	
				$form_data['post_status']='pending';
				if($form_data['post_status']=='publish'){	
					if($jobbank_user_can_publish=="yes"){
						$form_data['post_status']='publish';
						}else{
						$form_data['post_status']='pending';
					}								
				}
				$my_post['post_title'] = sanitize_text_field($form_data['title']);
				$my_post['post_content'] = wp_kses( $form_data['new_post_content'], $allowed_html); 
				$my_post['post_type'] = $post_type;
				$my_post['post_status'] = sanitize_text_field($form_data['post_status']);										
				$newpost_id= wp_insert_post( $my_post );
				update_post_meta($newpost_id, 'jobbank_job_status', sanitize_text_field($form_data['job_type'])); 
				// WPML Start******
				if ( function_exists('icl_object_id') ) {
					include_once( WP_PLUGIN_DIR . '/sitepress-multilingual-cms/inc/wpml-api.php' );
					$_POST['icl_post_language'] = $language_code = ICL_LANGUAGE_CODE;
					$query =$wpdb->prepare( "UPDATE {$wpdb->prefix}icl_translations SET element_type='post_%s' WHERE element_id='%s' LIMIT 1",$post_type,$newpost_id );
					$wpdb->query($query);					
				}
				// End WPML**********	
				if(isset($form_data['postcats'] )){ 				
					$category_ids = $form_data['postcats'];
					$input_array_data= sanitize_text_field($category_ids) ;
					if(is_array($category_ids)){
						$input_array_data= array();
						foreach($category_ids as $one_input_field){
							$input_array_data[]=sanitize_text_field($one_input_field);
						}					
					}
					wp_set_object_terms( $newpost_id, $input_array_data, $jobbank_directory_url.'-category');
				}
				if(isset($form_data['new_category'] )){						
					$tag_new= explode(",", $form_data['new_category']); 			
					foreach($tag_new  as $one_tag){	
						wp_add_object_terms( $newpost_id, sanitize_text_field($one_tag), $jobbank_directory_url.'-category');							
					}
				}	
				// For FAQ Save				
				if(isset($form_data['faq_title'] )){
					$faq_title= $form_data['faq_title']; //this is array data we sanitize later, when it save				
					$faq_description= $form_data['faq_description'];
					$i=0;
					for($i=0;$i<20;$i++){
						if(isset($faq_title[$i]) AND $faq_title[$i]!=''){
							update_post_meta($newpost_id, 'faq_title'.$i, sanitize_text_field($faq_title[$i]));
							update_post_meta($newpost_id, 'faq_description'.$i, sanitize_textarea_field($faq_description[$i]));
						}
					}
				}
				// End FAQ
				// Location
				if(isset($form_data['location_arr'] )){ 
					$location_arr = $form_data['location_arr'];
					$input_array_data= sanitize_text_field($location_arr) ;
					if(is_array($location_arr)){
						$input_array_data= array();
						foreach($location_arr as $one_input_field){
							$input_array_data[]=sanitize_text_field($one_input_field);
						}					
					}
					
					wp_set_object_terms( $newpost_id, $input_array_data, $jobbank_directory_url.'-locations');
				}
				if(isset($form_data['new_location'] )){						
					$tag_new= explode(",", $form_data['new_location']); 			
					foreach($tag_new  as $one_tag){	
						wp_add_object_terms( $newpost_id, sanitize_text_field($one_tag), $jobbank_directory_url.'-locations');
					}
				}	
				$default_fields = array();
				$field_set=get_option('jobbank_li_fields' );
				if($field_set!=""){ 
					$default_fields=get_option('jobbank_li_fields' );
					}else{															
					$default_fields['business_type']='Business Type';
					$default_fields['main_products']='Main Products';
					$default_fields['number_of_employees']='Number Of Employees';
					$default_fields['main_markets']='Main Markets';
					$default_fields['total_annual_sales_volume']='Total Annual Sales Volume';	
				}					
				if(sizeof($default_fields )){			
					foreach( $default_fields as $field_key => $field_value ) {
						if(isset($form_data[$field_key])){
							update_post_meta($newpost_id, $field_key, $form_data[$field_key] );				
						}
					}					
				}
				$post_author_id= $current_user->ID;
				update_post_meta($newpost_id, 'job_education', wp_kses( $form_data['content_education'], $allowed_html));	
				update_post_meta($newpost_id, 'job_must_have', wp_kses( $form_data['content_must_have'], $allowed_html));
				// For Tag Save tag_arr
				$tag_all='';
				if(isset($form_data['tag_arr'] )){
					$tag_name= $form_data['tag_arr'] ;							
					$i=0;$tag_all='';	
					$input_array_data= sanitize_text_field($tag_name) ;
					if(is_array($tag_name)){
						$input_array_data= array();
						foreach($tag_name as $one_input_field){
							$input_array_data[]=sanitize_text_field($one_input_field);
						}					
					}
					
					wp_set_object_terms( $newpost_id, $input_array_data, $jobbank_directory_url.'-tag');							
				}
				$tag_all='';
				if(isset($form_data['new_tag'] )){						
					$tag_new= explode(",", $form_data['new_tag']); 			
					foreach($tag_new  as $one_tag){	
						wp_add_object_terms( $newpost_id, sanitize_text_field($one_tag), $jobbank_directory_url.'-tag');											
						$i++;	
					}
				}	
				update_post_meta($newpost_id, 'address', sanitize_text_field($form_data['address'])); 
				update_post_meta($newpost_id, 'latitude', sanitize_text_field($form_data['latitude'])); 
				update_post_meta($newpost_id, 'longitude', sanitize_text_field($form_data['longitude']));					
				update_post_meta($newpost_id, 'city', sanitize_text_field($form_data['city'])); 
				update_post_meta($newpost_id, 'state', sanitize_text_field($form_data['state'])); 
				update_post_meta($newpost_id, 'postcode', sanitize_text_field($form_data['postcode'])); 
				update_post_meta($newpost_id, 'country', sanitize_text_field($form_data['country'])); 
			
				// job detail*****
				update_post_meta($newpost_id, 'educational_requirements', sanitize_text_field($form_data['educational_requirements'])); 
				update_post_meta($newpost_id, 'job_type', sanitize_text_field($form_data['job_type'])); 
				update_post_meta($newpost_id, 'jobbank_job_level', sanitize_text_field($form_data['jobbank_job_level'])); 
				update_post_meta($newpost_id, 'jobbank_experience_range', sanitize_text_field($form_data['jobbank_experience_range'])); 
				update_post_meta($newpost_id, 'age_range', sanitize_text_field($form_data['age_range'])); 
				update_post_meta($newpost_id, 'gender', sanitize_text_field($form_data['gender'])); 
				update_post_meta($newpost_id, 'vacancy', sanitize_text_field($form_data['vacancy'])); 
				if($form_data['deadline']==''){ 
					$deadline= date("Y-m-d", strtotime("+1 month"));
					}else{
					$deadline=sanitize_text_field($form_data['deadline']);
				}
				update_post_meta($newpost_id, 'deadline', $deadline);  
				update_post_meta($newpost_id, 'workplace', sanitize_text_field($form_data['workplace']));
				update_post_meta($newpost_id, 'salary', sanitize_text_field($form_data['salary']));
				update_post_meta($newpost_id, 'other_benefits', sanitize_text_field($form_data['other_benefits']));
				if(isset($form_data['dirpro_email_button'])){						
					update_post_meta($newpost_id, 'dirpro_email_button', sanitize_text_field($form_data['dirpro_email_button'])); 
				}
				if(isset($form_data['dirpro_web_button'])){						
					update_post_meta($newpost_id, 'dirpro_web_button', sanitize_text_field($form_data['dirpro_web_button'])); 
				}
				update_post_meta($newpost_id, 'image_gallery_ids', sanitize_text_field($form_data['gallery_image_ids'])); 
				update_post_meta($newpost_id, 'topbanner', sanitize_text_field($form_data['topbanner_image_id'])); 
				update_post_meta($newpost_id, 'listing_contact_source', sanitize_text_field($form_data['contact_source']));  
				update_post_meta($newpost_id, 'external_form_url', sanitize_url($form_data['external_form_url']));  
				if(isset($form_data['feature_image_id'] )){
					$attach_id =sanitize_text_field($form_data['feature_image_id']);
					set_post_thumbnail( $newpost_id, $attach_id );					
				}	
				update_post_meta($newpost_id, 'company_name', sanitize_text_field($form_data['company_name']));
				update_post_meta($newpost_id, 'phone', sanitize_text_field($form_data['phone'])); 
				update_post_meta($newpost_id, 'address', sanitize_text_field($form_data['address'])); 
				update_post_meta($newpost_id, 'contact-email', sanitize_text_field($form_data['contact-email'])); 
				update_post_meta($newpost_id, 'contact_web', sanitize_text_field($form_data['contact_web']));
				update_post_meta($newpost_id, 'vimeo', sanitize_text_field($form_data['vimeo'])); 
				update_post_meta($newpost_id, 'youtube', sanitize_text_field($form_data['youtube'])); 
				
					include( ep_jobbank_ABSPATH. 'inc/add-listing-notification.php');
				
				echo json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'jobbank')));
				exit(0);
			}
			public function eppro_upload_featured_image($thumb_url, $post_id ) { 
				require_once(ABSPATH . 'wp-admin/includes/file.php');
				require_once(ABSPATH . 'wp-admin/includes/media.php');
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				// Download file to temp location
				$i=0;$product_image_gallery='';									
				$tmp = download_url( $thumb_url );						
				// Set variables for storage
				// fix file name for query strings
				preg_match('/[^\?]+\.(jpg|JPG|jpe|JPE|jpeg|JPEG|gif|GIF|png|PNG|webp|WEBP)/', $thumb_url, $matches);
				$file_array['name'] = basename($matches[0]);
				$file_array['tmp_name'] = $tmp;
				// If error storing temporarily, unlink
				if ( is_wp_error( $tmp ) ) {
					@unlink($file_array['tmp_name']);
					$file_array['tmp_name'] = '';						
				}
				//use media_handle_sideload to upload img:
				$thumbid = media_handle_sideload( $file_array, $post_id, 'gallery desc' );
				// If error storing permanently, unlink
				if ( is_wp_error($thumbid) ) {
					@unlink($file_array['tmp_name']);										
				}						
				set_post_thumbnail($post_id, $thumbid);	
			}
			public function jobbank_finalerp_csv_product_upload(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'csv' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}
				$csv_file_id=0;$maping='';
				if(isset($_POST['csv_file_id'])){
					$csv_file_id= sanitize_text_field($_POST['csv_file_id']);
				}
				require(ep_jobbank_DIR .'/admin/pages/importer/upload_main_big_csv.php');
				$total_files = get_option( 'finalerp-number-of-files');
				echo json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'jobbank'), "maping"=>$maping));
				exit(0);
			}
			public function jobbank_save_csv_file_to_database(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'csv' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}
				parse_str($_POST['form_data'], $form_data);
				$csv_file_id=0;
				if(isset($_POST['csv_file_id'])){
					$csv_file_id= sanitize_text_field($_POST['csv_file_id']);
				}	
				$row_start=0;
				if(isset($_POST['row_start'])){
					$row_start= sanitize_text_field($_POST['row_start']);
				}
				require (ep_jobbank_DIR .'/admin/pages/importer/csv_save_database.php');
				echo json_encode(array("code" => $done_status,"msg"=>esc_html__( 'Updated Successfully', 'jobbank'), "row_done"=>$row_done ));
				exit(0);
			}
			public function jobbank_eppro_get_import_status(){
				$eppro_total_row = floatval( get_option( 'eppro_total_row' ));	
				$eppro_current_row = floatval( get_option( 'eppro_current_row' ));		
				$progress =  ((int)$eppro_current_row / (int)$eppro_total_row)*100;
				if($eppro_total_row<=$eppro_current_row){$progress='100';}
				if($progress=='100'){
					echo json_encode(array("code" => "-1","progress"=>(int)$progress, "eppro_total_row"=>$eppro_total_row,"eppro_current_row"=>$eppro_current_row));	
					}else{
					echo json_encode(array("code" => "0","progress"=>(int)$progress, "eppro_total_row"=>$eppro_total_row ,"eppro_current_row"=>$eppro_current_row));
				}		  
				exit(0);
			}
			public function ep_jobbank_pdf_cv(){ 
				require( ep_jobbank_DIR . '/template/pdf/pdf_cv.php');
				require( ep_jobbank_DIR . '/template/pdf/pdf_post.php');
			}
			public function  jobbank_apply_submit_login(){
				global $current_user;
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'listing' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['form_data'], $form_data);
				$my_post = array();	
				$allowed_html = wp_kses_allowed_html( 'post' );	
				$jobbank_directory_url='job_apply';
				$my_post['post_author'] =$current_user->ID;
				$my_post['post_title'] = $current_user->display_name;
				$my_post['post_name'] = $current_user->display_name;
				$my_post['post_content'] =wp_kses( $form_data['cover-content2'], $allowed_html) ;  
				$my_post['post_type'] 	= $jobbank_directory_url;
				$my_post['post_status']='private';						
				$newpost_id= wp_insert_post( $my_post );
				update_post_meta($newpost_id, 'candidate_name', $current_user->display_name); 
				update_post_meta($newpost_id, 'apply_jod_id',  sanitize_text_field($form_data['dir_id']));				
				update_post_meta($newpost_id, 'email_address', $current_user->user_email); 
				update_post_meta($newpost_id, 'user_id', $current_user->ID); 					
				$old_apply=get_user_meta($current_user->ID,'job_apply_all', true);
				$new_apply=$old_apply.', '.sanitize_text_field($form_data['dir_id']);						
				update_user_meta($current_user->ID,'job_apply_all',$new_apply);
				echo json_encode(array("code" => "success","msg"=>esc_html__( 'Successfully Sent', 'jobbank')));
				// Send Email
				include( ep_jobbank_ABSPATH. 'inc/apply_submit_login.php');
				exit(0);
			}
			public function jobbank_apply_submit_nonlogin(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'listing' ) ) {
				}			
				// Save data
				parse_str($_POST['form_data'], $form_data);
				if ( 0 < $_FILES['file']['error'] ) {
					echo json_encode(array("code" => "Error","msg"=>esc_html__( 'File Error', 'jobbank')));						
				}
				else {									
					$allowed_html = wp_kses_allowed_html( 'post' );								
					if ( ! function_exists( 'wp_handle_upload' ) ) {
						require_once( ABSPATH . 'wp-admin/includes/file.php' );
					}
					$uploadedfile = $_FILES['file']; 
					$upload_overrides = array(
					'test_form' => false
					);
					$file_url='';$file_name='';
					$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
					if ( $movefile && ! isset( $movefile['error'] ) ) {						
						$file_url = $movefile['url'] ;
						} else {
					}
					// Add post in apply_job section
					$my_post = array();	
					$jobbank_directory_url='job_apply';
					$my_post['post_author'] = '0';
					$my_post['post_title'] = sanitize_title($form_data['canname']);
					$my_post['post_name'] = sanitize_text_field($form_data['canname']);
					$my_post['post_content'] =wp_kses( $form_data['cover-content'], $allowed_html) ;  
					$my_post['post_type'] 	= $jobbank_directory_url;
					$my_post['post_status']='private';						
					$newpost_id= wp_insert_post( $my_post );
					update_post_meta($newpost_id, 'candidate_name', sanitize_text_field($form_data['canname'])); 
					update_post_meta($newpost_id, 'apply_jod_id',  sanitize_text_field($form_data['dir_id'])); 
					update_post_meta($newpost_id, 'file_name', $file_name); 
					update_post_meta($newpost_id, 'cv_file_url', $file_url);
					update_post_meta($newpost_id, 'email_address', sanitize_email($form_data['email_address'])); 
					update_post_meta($newpost_id, 'phone', sanitize_text_field($form_data['contact_phone'])); 
					echo json_encode(array("code" => "success","msg"=>esc_html__( 'Successfully Sent', 'jobbank')));
				}
				// Send Email
				include( ep_jobbank_ABSPATH. 'inc/apply_submit_nonlogin.php');
				exit(0);
			}
			public function jobbank_candidate_meeting_popup(){
				$candidate_post_id=$_REQUEST['user_id'];
				include( ep_jobbank_template. 'private-profile/candidate_meeting_popup-file.php');
				exit(0);
			}
			public function jobbank_candidate_email_popup(){
				include( ep_jobbank_template. 'private-profile/candidate_email_popup-file.php');
				exit(0);
			}
			public function jobbank_apply_popup(){
				include( ep_jobbank_template. 'listing/apply_popup-file.php');
				exit(0);
			}
			public function jobbank_elementor_file(  ) { 
				//Register Custom Elementor Widget					
				if(defined( 'ELEMENTOR_PATH' )){						
					require_once(ep_jobbank_template . 'elementor/custom-elementor-widgets.php' );
				}				
			}
			public function jobbank_cancel_paypal(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				global $wpdb;
				global $current_user;
				parse_str($_POST['form_data'], $form_data);
				if( ! class_exists('Paypal' ) ) {
					require_once(ep_jobbank_DIR . '/inc/class-paypal.php');
				}
				$post_name='jobbank_paypal_setting';						
				$row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_name = '%s' ",$post_name));
				$paypal_id='0';
				if(isset($row->ID )){
					$paypal_id= $row->ID;
				}
				$paypal_api_currency=get_post_meta($paypal_id, 'jobbank_paypal_api_currency', true);
				$paypal_username=get_post_meta($paypal_id, 'jobbank_paypal_username',true);
				$paypal_api_password=get_post_meta($paypal_id, 'jobbank_paypal_api_password', true);
				$paypal_api_signature=get_post_meta($paypal_id, 'jobbank_paypal_api_signature', true);
				$credentials = array();
				$credentials['USER'] = (isset($paypal_username)) ? $paypal_username : '';
				$credentials['PWD'] = (isset($paypal_api_password)) ? $paypal_api_password : '';
				$credentials['SIGNATURE'] = (isset($paypal_api_signature)) ? $paypal_api_signature : '';
				$paypal_mode=get_post_meta($paypal_id, 'jobbank_paypal_mode', true);
				$currencyCode = $paypal_api_currency;
				$sandbox = ($paypal_mode == 'live') ? '' : 'sandbox.';
				$sandboxBool = (!empty($sandbox)) ? true : false;
				$paypal = new Paypal($credentials,$sandboxBool);
				$oldProfile = get_user_meta($current_user->ID,'iv_paypal_recurring_profile_id',true);
				if (!empty($oldProfile)) {
					$cancelParams = array(
					'PROFILEID' => $oldProfile,
					'ACTION' => 'Cancel'
					);
					$paypal -> request('ManageRecurringPaymentsProfileStatus',$cancelParams);
					update_user_meta($current_user->ID,'iv_paypal_recurring_profile_id','');
					update_user_meta($current_user->ID,'jobbank_iv_cancel_reason', sanitize_text_field($form_data['cancel_text'])); 
					update_user_meta($current_user->ID,'jobbank_payment_status', 'cancel'); 
					echo json_encode(array("code" => "success","msg"=>"Cancel Successfully"));
					exit(0);							
					}else{
					echo json_encode(array("code" => "not","msg"=>esc_html__( 'Unable to Cancel', 'jobbank')));
					exit(0);	
				}
			}
			public function jobbank_woocommerce_form_submit(  ) {
				$iv_gateway = get_option('jobbank_payment_gateway');
				if($iv_gateway=='woocommerce'){ 
					require_once(ep_jobbank_ABSPATH . '/admin/pages/payment-inc/woo-submit.php');
				}	
			}
			public function  jobbank_profile_stripe_upgrade(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				require_once(ep_jobbank_DIR . '/admin/init.php');
				global $wpdb;
				global $current_user;
				parse_str($_POST['form_data'], $form_data);	
				$newpost_id='';
				$post_name='jobbank_stripe_setting';
				$row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_name = '%s' ",$post_name ));
				if(isset($row->ID )){
					$newpost_id= $row->ID;
				}
				$stripe_mode=get_post_meta( $newpost_id,'jobbank_stripe_mode',true);	
				if($stripe_mode=='test'){
					$stripe_api =get_post_meta($newpost_id, 'jobbank_stripe_secret_test',true);	
					}else{
					$stripe_api =get_post_meta($newpost_id, 'jobbank_stripe_live_secret_key',true);	
				}
				\Stripe\Stripe::setApiKey($stripe_api);				
				// For  cancel ----
				$arb_status =	get_user_meta($current_user->ID, 'jobbank_payment_status', true);
				$cust_id = get_user_meta($current_user->ID,'jobbank_stripe_cust_id',true);
				$sub_id = get_user_meta($current_user->ID,'jobbank_stripe_subscrip_id',true);
				if($sub_id!=''){	
					try{
						$iv_cancel_stripe = Stripe_Customer::retrieve(sanitize_text_field($form_data['cust_id']));
						$iv_cancel_stripe->subscriptions->retrieve(sanitize_text_field($form_data['sub_id']))->cancel();
						} catch (Exception $e) {
					}
					update_user_meta($current_user->ID,'jobbank_payment_status', 'cancel'); 
					update_user_meta($current_user->ID,'jobbank_stripe_subscrip_id','');
				}			
				require_once(ep_jobbank_DIR . '/admin/pages/payment-inc/stripe-upgrade.php');
				echo json_encode(array("code" => "success","msg"=>$response));
				exit(0);
			}
			public function jobbank_contact_popup(){
				include( ep_jobbank_template. 'private-profile/contact_popup.php');
				exit(0);
			}
			public function jobbank_listing_contact_popup(){
				include( ep_jobbank_template. 'listing/contact_popup.php');
				exit(0);
			}
			public function jobbank_get_categories_caching($id, $post_type){				
				if(metadata_exists('post', $id, 'jobbank-category')) {
					$items = get_post_meta($id,'jobbank-category',true );										
					}else{									
					$items=wp_get_object_terms( $id, $post_type.'-category');
					update_post_meta($id, 'jobbank-category' , $items);
				}					
				return $items;
			}
			public function jobbank_get_categories_mapmarker($id, $post_type){	
				$default_marker =ep_jobbank_URLPATH."/admin/files/css/images/marker-icon.png";
				if(metadata_exists('post', $id, 'jobbank-category')) {
					$items = get_post_meta($id,'jobbank-category',true );
					if(isset($items[0]->slug)){										
						foreach($items as $c){
							$map_marker= get_term_meta($c->term_id, 'jobbank_term_mapmarker', true);
							if($map_marker!=''){
								$default_marker =$map_marker;
								break;
							}							
						}
					}
				}			
				return $default_marker;
			}
			public function jobbank_get_location_caching($id, $post_type){				
				if(metadata_exists('post', $id, 'jobbank-locations')) {
					$items = get_post_meta($id,'jobbank-locations',true );										
					}else{									
					$items=wp_get_object_terms( $id, $post_type.'-locations');
					update_post_meta($id, 'jobbank-locations' , $items);
				}					
				return $items;
			}					
			public function jobbank_get_tags_caching($id, $post_type){				
				if(metadata_exists('post', $id, 'jobbank-tags')) {
					$items = get_post_meta($id,'jobbank-tags',true );										
					}else{										
					$items=wp_get_object_terms( $id, $post_type.'-tag');
					update_post_meta($id, 'jobbank-tags' , $items);
				}					
				return $items;
			}
			public function jobbank_listing_default_image() {
				$jobbank_listing_defaultimage=get_option('jobbank_listing_defaultimage');
				if(!empty($jobbank_listing_defaultimage)){
					$default_image_url= wp_get_attachment_image_src($jobbank_listing_defaultimage,'full');		
					if(isset($default_image_url[0])){									
						$default_image_url=$default_image_url[0] ;
					}
					}else{
					$default_image_url=ep_jobbank_URLPATH."/assets/images/default-directory.jpg";
				}
				return $default_image_url;
			}
			public function jobbank_cancel_stripe(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				require_once(ep_jobbank_DIR . '/admin/files/lib/Stripe.php');
				global $wpdb;
				global $current_user;
				parse_str($_POST['form_data'], $form_data);	
				$newpost_id='';
				$post_name='jobbank_stripe_setting';
				$row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_name = '%s' ",$post_name ));
				if(isset($row->ID )){
					$newpost_id= $row->ID;
				}
				$stripe_mode=get_post_meta( $newpost_id,'jobbank_stripe_mode',true);	
				if($stripe_mode=='test'){
					$stripe_api =get_post_meta($newpost_id, 'jobbank_stripe_secret_test',true);	
					}else{
					$stripe_api =get_post_meta($newpost_id, 'jobbank_stripe_live_secret_key',true);	
				}
				Stripe::setApiKey($stripe_api);
				try{
					$iv_cancel_stripe = Stripe_Customer::retrieve(sanitize_text_field($form_data['cust_id']));
					$iv_cancel_stripe->subscriptions->retrieve(sanitize_text_field($form_data['sub_id']))->cancel();
					} catch (Exception $e) {
				}
				update_user_meta($current_user->ID,'jobbank_iv_cancel_reason', sanitize_text_field($form_data['cancel_text'])); 
				update_user_meta($current_user->ID,'jobbank_payment_status', 'cancel'); 
				update_user_meta($current_user->ID,'jobbank_stripe_subscrip_id','');
				echo json_encode(array("code" => "success","msg"=>esc_html__( 'Cancel Successfully', 'jobbank')));
				exit(0);
			}
			
			public function jobbank_update_setting_password(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['form_data'], $form_data);		
				if(array_key_exists('wp_capabilities',$form_data)){
					wp_die( 'Are you cheating:wp_capabilities?' );		
				}
				global $current_user;										
				if ( wp_check_password( sanitize_text_field($form_data['c_pass']), $current_user->user_pass, $current_user->ID) ){
					if($form_data['r_pass']!=$form_data['n_pass']){
						echo json_encode(array("code" => "not", "msg"=>"New Password & Re Password are not same. "));
						exit(0);
						}else{
						wp_set_password( sanitize_text_field($form_data['n_pass']), $current_user->ID);
						echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
						exit(0);
					}
					}else{
					echo json_encode(array("code" => "not", "msg"=>esc_html__( 'Current password is wrong.', 'jobbank')));
					exit(0);
				}
			}
			public function jobbank_update_profile_setting(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['form_data'], $form_data);		
				if(array_key_exists('wp_capabilities',$form_data)){
					wp_die( 'Are you cheating:wp_capabilities?' );		
				}
				$jobbank_directory_url=get_option('ep_jobbank_url');
				if($jobbank_directory_url==""){$jobbank_directory_url='job';}
				$allowed_html = wp_kses_allowed_html( 'post' );
				global $current_user;
				
				
				// Location
				$all_locations='';
				if(is_array($form_data['location_arr'])){				
				 $all_locations= implode(",",$form_data['location_arr']);
					if(isset($form_data['new_location']) AND $form_data['new_location']!=''){ 
						$all_locations= $all_locations.','.$form_data['new_location'];
					}
				}				
				update_user_meta($current_user->ID, 'all_locations', sanitize_text_field($all_locations)); 
				update_user_meta($current_user->ID, 'new_locations', sanitize_text_field($form_data['new_location']));  
				
				$field_type=array();
				$field_type_opt=  get_option( 'jobbank_field_type' );
				if($field_type_opt!=''){
					$field_type=get_option('jobbank_field_type' );
					}else{
					$field_type['full_name']='text';					 
					$field_type['company_type']='text';
					$field_type['phone']='text';								
					$field_type['address']='text';
					$field_type['city']='text';
					$field_type['postcode']='text';
					$field_type['country']='text';
					$field_type['job_title']='text';
					$field_type['gender']='radio';
					$field_type['occupation']='text';
					$field_type['description']='textarea';
					$field_type['web_site']='url';					
				}	
				
				foreach ( $form_data as $field_key => $field_value ) { 
					if(strtolower(trim($field_key))!='wp_capabilities'){						
						if(is_array($field_value)){
							$field_value =implode(",",$field_value);
						}
						if($field_type[$field_key]=='url'){							
							update_user_meta($current_user->ID, sanitize_text_field($field_key), sanitize_url($field_value)); 
						}elseif($field_type[$field_key]=='textarea'){
							update_user_meta($current_user->ID, sanitize_text_field($field_key), sanitize_textarea_field($field_value));  
						}else{
							update_user_meta($current_user->ID, sanitize_text_field($field_key), sanitize_text_field($field_value)); 
						}
					}
				}
				// top banner
				update_user_meta($current_user->ID, 'topbanner', sanitize_text_field($form_data['topbanner'])); 
				
				// For education Save
				// Delete 1st
				$i=0;
				for($i=0;$i<20;$i++){
					delete_user_meta($current_user->ID, 'educationtitle'.$i);
					delete_user_meta($current_user->ID, 'edustartdate'.$i);
					delete_user_meta($current_user->ID, 'eduenddate'.$i);
					delete_user_meta($current_user->ID, 'institute'.$i);
					delete_user_meta($current_user->ID, 'edudescription'.$i);
				}
				// Delete End
				if(isset($form_data['educationtitle'] )){
					$educationtitle= $form_data['educationtitle']; //this is array data we sanitize later, when it save
					$edustartdate= $form_data['edustartdate']; //this is array data we sanitize later, when it save
					$eduenddate= $form_data['eduenddate']; //this is array data we sanitize later, when it save
					$institute= $form_data['institute'];
					$edudescription= $form_data['edudescription'];
					$i=0;
					for($i=0;$i<20;$i++){
						if(isset($educationtitle[$i]) AND $educationtitle[$i]!=''){
							update_user_meta($current_user->ID, 'educationtitle'.$i, sanitize_text_field($educationtitle[$i]));
							update_user_meta($current_user->ID, 'edustartdate'.$i, sanitize_text_field($edustartdate[$i]));
							update_user_meta($current_user->ID, 'eduenddate'.$i, sanitize_text_field($eduenddate[$i]));
							update_user_meta($current_user->ID, 'institute'.$i, sanitize_text_field($institute[$i]));
							update_user_meta($current_user->ID, 'edudescription'.$i, sanitize_textarea_field($edudescription[$i]));
						}
					}
				}
				// End education	
				// For Work Experience Save
				// Delete 1st
				$i=0;
				for($i=0;$i<20;$i++){
					delete_user_meta($current_user->ID, 'experience_title'.$i);
					delete_user_meta($current_user->ID, 'experience_start'.$i);
					delete_user_meta($current_user->ID, 'experience_end'.$i);
					delete_user_meta($current_user->ID, 'experience_company'.$i);
					delete_user_meta($current_user->ID, 'experience_description'.$i);
				}
				// Delete End
				if(isset($form_data['experience_title'] )){
					$experience_title= $form_data['experience_title']; //this is array data we sanitize later, when it save
					$experience_start= $form_data['experience_start']; //this is array data we sanitize later, when it save
					$experience_end= $form_data['experience_end']; //this is array data we sanitize later, when it save
					$experience_company= $form_data['experience_company'];
					$experience_description= $form_data['experience_description'];
					$i=0;
					for($i=0;$i<20;$i++){
						if(isset($experience_title[$i]) AND $experience_title[$i]!=''){
							update_user_meta($current_user->ID, 'experience_title'.$i, sanitize_text_field($experience_title[$i]));
							update_user_meta($current_user->ID, 'experience_start'.$i, sanitize_text_field($experience_start[$i]));
							update_user_meta($current_user->ID, 'experience_end'.$i, sanitize_text_field($experience_end[$i]));
							update_user_meta($current_user->ID, 'experience_company'.$i, sanitize_text_field($experience_company[$i]));
							update_user_meta($current_user->ID, 'experience_description'.$i, sanitize_textarea_field($experience_description[$i]));
						}
					}
				}
				// End Work Experience
				// For Award Save
				// Delete 1st
				$i=0;
				for($i=0;$i<20;$i++){
					delete_user_meta($current_user->ID, 'award_title'.$i);
					delete_user_meta($current_user->ID, 'award_year'.$i);						
					delete_user_meta($current_user->ID, 'award_description'.$i);
				}
				// Delete End
				if(isset($form_data['award_title'] )){
					$award_title= $form_data['award_title']; //this is array data we sanitize later, when it save
					$award_year= $form_data['award_year']; //this is array data we sanitize later, when it save
					$award_description= $form_data['award_description'];
					$i=0;
					for($i=0;$i<20;$i++){
						if(isset($award_title[$i]) AND $award_title[$i]!=''){
							update_user_meta($current_user->ID, 'award_title'.$i, sanitize_text_field($award_title[$i]));
							update_user_meta($current_user->ID, 'award_year'.$i, sanitize_text_field($award_year[$i]));
							update_user_meta($current_user->ID, 'award_description'.$i, sanitize_textarea_field($award_description[$i]));
						}
					}
				}
				// End Award
				// Languages
				for($i=0;$i<20;$i++){
					delete_user_meta($current_user->ID, 'language'.$i);
					delete_user_meta($current_user->ID, 'language_level'.$i);
				}
				$language= $form_data['language']; //this is array data we sanitize later, when it save
				$language_level= $form_data['language_level']; //this is array data we sanitize later, when it save
				for($i=0;$i<20;$i++){
					if(isset($language[$i]) AND $language[$i]!=''){							
						update_user_meta($current_user->ID, 'language'.$i, sanitize_text_field($language[$i]));
					}
					if(isset($language_level[$i]) AND $language_level[$i]!=''){			
						update_user_meta($current_user->ID, 'language_level'.$i, sanitize_text_field($language_level[$i]));
					}
				}	
				// professional_skills***
				$specialties='';
				if(isset($form_data['professional_skills'])){
					foreach ($form_data['professional_skills'] as $specialty){
						$specialties= $specialties.','. sanitize_text_field($specialty);
					}
				}
				// For new professional_skill
				$new_professional_skills=$form_data['new_professional_skills'];
				$new_professional_skills_arr= explode(",",$new_professional_skills);
				foreach ($new_professional_skills_arr as $specialty1){
					$specialty1= sanitize_text_field($specialty1);
					wp_create_term( $specialty1,$jobbank_directory_url.'-tag');
					$specialties= $specialties.','. $specialty1;									
				}								
				update_user_meta($current_user->ID, 'professional_skills', $specialties); 
				if(isset($form_data['latitude'])){
					update_user_meta($current_user->ID, 'latitude', sanitize_text_field($form_data['latitude']));
				}
				if(isset($form_data['longitude'])){
					update_user_meta($current_user->ID, 'longitude', sanitize_text_field($form_data['longitude']));
				}
				echo json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'jobbank')));
				exit(0);
			}
			public function jobbank_total_job_count($userid, $allusers='no' ){
				$jobbank_directory_url=get_option('ep_jobbank_url');
				if($jobbank_directory_url==""){$jobbank_directory_url='job';}
				if($allusers=='yes' ){
					$args = array(
					'post_type' => $jobbank_directory_url, // enter your custom post type
					'paged' => '1',					
					'post_status' => 'publish',	
					'posts_per_page'=>'99999',  // overrides posts per page in theme settings
					);
					}else{
					$args = array(
					'post_type' => $jobbank_directory_url, // enter your custom post type
					'paged' => '1',
					'author'=>$userid ,
					'post_status' => 'publish',	
					'posts_per_page'=>'99999',  // overrides posts per page in theme settings
					);
				}
				$job_count = new WP_Query( $args );
				$count = $job_count->found_posts;
				return $count;
			}
			public function jobbank_total_applications_count($jobid ){ 
				$jobbank_directory_url2='job_apply';		
				$args_apply ='';
				$args_apply = array(
				'post_type' => $jobbank_directory_url2, 
				'paged' => '1',	
				'post_status'=>'Private',
				'posts_per_page'=>'99999', 
				'meta_query' => array(
				array(
				'key' => 'apply_jod_id',
				'value' => $jobid,
				'compare' => '='
				)
				)					
				);				
				$apply_count = new WP_Query( $args_apply );				
				$count = $apply_count->found_posts;
				return $count;
			}
			public function jobbank_restrict_media_library( $wp_query ) {
				if(!function_exists('wp_get_current_user')) { include(ABSPATH . "wp-includes/pluggable.php"); }
				global $current_user, $pagenow;
				if( is_admin() && !current_user_can('edit_others_posts') ) {
					$wp_query->set( 'author', $current_user->ID );
					add_filter('views_edit-post', 'fix_post_counts');
					add_filter('views_upload', 'fix_media_counts');
				}
			}
			
			public function jobbank_update_profile_pic(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				global $current_user;
				if(isset($_REQUEST['profile_pic_url_1'])){
					$iv_profile_pic_url=$_REQUEST['profile_pic_url_1'];
					$attachment_thum=$_REQUEST['attachment_thum'];
					}else{
					$iv_profile_pic_url='';
					$attachment_thum='';
				}
				update_user_meta($current_user->ID, 'jobbank_profile_pic_thum', $attachment_thum);					
				update_user_meta($current_user->ID, 'iv_profile_pic_url', $iv_profile_pic_url);
				echo json_encode('success');
				exit(0);
			}
			public function jobbank_paypal_form_submit(  ) {
				require_once(ep_jobbank_DIR . '/admin/pages/payment-inc/paypal-submit.php');
			}	
			public function jobbank_stripe_form_submit(  ) {
				require_once(ep_jobbank_DIR . '/admin/pages/payment-inc/stripe-submit.php');
			}
			
			/***********************************
				* Adds a meta box to the post editing screen
			*/
			public function jobbank_custom_meta_jobbank() {
				$jobbank_directory_url=get_option('ep_jobbank_url');
				if($jobbank_directory_url==""){$jobbank_directory_url='job';}
				add_meta_box('prfx_meta', esc_html__('Claim Approve ', 'jobbank'), array(&$this, 'jobbank_meta_callback'),$jobbank_directory_url,'side');
				add_meta_box('prfx_meta2', esc_html__('Listing Data  ', 'jobbank'), array(&$this, 'jobbank_meta_callback_full_data'),$jobbank_directory_url,'advanced');
			}
			public function jobbank_check_coupon(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'signup' ) ) {
					echo json_encode(array("msg"=>"Are you cheating:wpnonce?"));						
					exit(0);
				}
				global $wpdb;
				$coupon_code=sanitize_text_field($_REQUEST['coupon_code']);
				$package_id=sanitize_text_field($_REQUEST['package_id']);					
				$package_amount=get_post_meta($package_id, 'jobbank_package_cost',true);
				$api_currency =sanitize_text_field($_REQUEST['api_currency']);
				$post_cont = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_title = '%s' and  post_type='jobbank_coupon'",$coupon_code ));	
				if(sizeof($post_cont)>0 && $package_amount>0){
					$coupon_name = $post_cont->post_title;
					$current_date=$today = date("m/d/Y");
					$start_date=get_post_meta($post_cont->ID, 'jobbank_coupon_start_date', true);
					$end_date=get_post_meta($post_cont->ID, 'jobbank_coupon_end_date', true);
					$coupon_used=get_post_meta($post_cont->ID, 'jobbank_coupon_used', true);
					$coupon_limit=get_post_meta($post_cont->ID, 'jobbank_coupon_limit', true);
					$dis_amount=get_post_meta($post_cont->ID, 'jobbank_coupon_amount', true);							 
					$package_ids =get_post_meta($post_cont->ID, 'jobbank_coupon_pac_id', true);
					$all_pac_arr= explode(",",$package_ids);
					$today_time = strtotime($current_date);
					$start_time = strtotime($start_date);
					$expire_time = strtotime($end_date);
					if(in_array('0', $all_pac_arr)){
						$pac_found=1;
						}else{
						if(in_array($package_id, $all_pac_arr)){
							$pac_found=1;
							}else{
							$pac_found=0;
						}
					}
					$recurring = get_post_meta( $package_id,'jobbank_package_recurring',true); 
					if($today_time >= $start_time && $today_time<=$expire_time && $coupon_used<=$coupon_limit && $pac_found == '1' && $recurring!='on' ){
						$total = $package_amount -$dis_amount;
						$coupon_type= get_post_meta($post_cont->ID, 'jobbank_coupon_type', true);
						if($coupon_type=='percentage'){
							$dis_amount= $dis_amount * $package_amount/100;
							$total = $package_amount -$dis_amount ;
						}
						echo json_encode(array('code' => 'success',
						'dis_amount' => $dis_amount.' '.$api_currency,
						'gtotal' => $total.' '.$api_currency,
						'p_amount' => $package_amount.' '.$api_currency,
						));
						exit(0);
						}else{
						$dis_amount='';
						$total=$package_amount;
						echo json_encode(array('code' => 'not-success-2',
						'dis_amount' => '',
						'gtotal' => $total.' '.$api_currency,
						'p_amount' => $package_amount.' '.$api_currency,
						));
						exit(0);
					}
					}else{
					if($package_amount=="" or $package_amount=="0"){$package_amount='0';}
					$dis_amount='';
					$total=$package_amount;
					echo json_encode(array('code' => 'not-success-1',
					'dis_amount' => '',
					'gtotal' => $total.' '.$api_currency,
					'p_amount' => $package_amount.' '.$api_currency,
					));
					exit(0);
				}
			}
			public function jobbank_check_package_amount(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'signup' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				global $wpdb;
				$coupon_code=(isset($_REQUEST['coupon_code'])? sanitize_text_field($_REQUEST['coupon_code']):'');
				$package_id=sanitize_text_field($_REQUEST['package_id']);
				if( get_post_meta( $package_id,'jobbank_package_recurring',true) =='on'  ){
					$package_amount=get_post_meta($package_id, 'jobbank_package_recurring_cost_initial', true);			
					}else{					
					$package_amount=get_post_meta($package_id, 'jobbank_package_cost',true);
				}
				$api_currency =sanitize_text_field($_REQUEST['api_currency']);			
				$iv_gateway = get_option('jobbank_payment_gateway');
				if($iv_gateway=='woocommerce'){
					if ( class_exists( 'WooCommerce' ) ) {	
						$api_currency= get_option( 'woocommerce_currency' );
						$api_currency= get_woocommerce_currency_symbol( $api_currency );
					}
				}		
				$post_cont = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_title = '%s' and  post_type='jobbank_coupon'", $coupon_code));	
				if(isset($post_cont->ID)){
					$coupon_name = $post_cont->post_title;
					$current_date=$today = date("m/d/Y");
					$start_date=get_post_meta($post_cont->ID, 'jobbank_coupon_start_date', true);
					$end_date=get_post_meta($post_cont->ID, 'jobbank_coupon_end_date', true);
					$coupon_used=get_post_meta($post_cont->ID, 'jobbank_coupon_used', true);
					$coupon_limit=get_post_meta($post_cont->ID, 'jobbank_coupon_limit', true);
					$dis_amount=get_post_meta($post_cont->ID, 'jobbank_coupon_amount', true);							 
					$package_ids =get_post_meta($post_cont->ID, 'jobbank_coupon_pac_id', true);
					$all_pac_arr= explode(",",$package_ids);
					$today_time = strtotime($current_date);
					$start_time = strtotime($start_date);
					$expire_time = strtotime($end_date);
					$pac_found= in_array($package_id, $all_pac_arr);							
					if($today_time >= $start_time && $today_time<=$expire_time && $coupon_used<=$coupon_limit && $pac_found=="1"){
						$total = $package_amount -$dis_amount;
						echo json_encode(array('code' => 'success',
						'dis_amount' => $api_currency.' '.$dis_amount,
						'gtotal' => $api_currency.' '.$total,
						'p_amount' => $api_currency.' '.$package_amount,
						));
						exit(0);
						}else{
						$dis_amount='--';
						$total=$package_amount;
						echo json_encode(array('code' => 'not-success',
						'dis_amount' => $api_currency.' '.$dis_amount,
						'gtotal' => $api_currency.' '.$total,
						'p_amount' => $api_currency.' '.$package_amount,
						));
						exit(0);
					}
					}else{
					$dis_amount='--';
					$total=$package_amount;
					echo json_encode(array('code' => 'not-success',
					'dis_amount' => $api_currency.' '.$dis_amount,
					'gtotal' => $api_currency.' '.$total,
					'p_amount' => $api_currency.' '.$package_amount,
					));
					exit(0);
				}
			}
			/**
				* Outputs the content of the meta box
			*/
			public function jobbank_meta_callback($post) {
				wp_nonce_field(basename(__FILE__), 'prfx_nonce');
				require_once ('admin/pages/metabox.php');
			}
			public function jobbank_meta_callback_full_data(){
				require_once ('admin/pages/metabox_full_data.php');
			}
			public function jobbank_color_js(){
				$big_button_color=get_option('epjbdir_big_button_color');	
				if($big_button_color==""){$big_button_color='#9777fa';}	
				$small_button_color=get_option('epjbdir_small_button_color');	
				if($small_button_color==""){$small_button_color='#9777fa';}
				$icon_color=get_option('epjbdir_icon_color');	
				if($icon_color==""){$icon_color='#9777fa';}	
				$title_color=get_option('epjbdir_title_color');	
				if($title_color==""){$title_color='#9777fa';}
				$button_font_color=get_option('epjbdir_button_font_color');	
				if($button_font_color==""){$button_font_color='#fffff';}
				$button_small_font_color=get_option('epjbdir_button_small_font_color');	
				if($button_small_font_color==""){$button_small_font_color='#000000';}
				$content_font_color=get_option('epjbdir_content_font_color');	
				if($content_font_color==""){$content_font_color='#66789C';}	
				$border_color=get_option('epjbdir_border_color');	
				if($border_color==""){$border_color='#E0E6F7';}	
				wp_enqueue_script('jobbank-dynamic-color', ep_jobbank_URLPATH . 'admin/files/js/dynamic-color.js');
				wp_localize_script('jobbank-dynamic-color', 'jobbank_color', array(
				'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
				'big_button'=>$big_button_color,
				'small_button'=>$small_button_color,
				'button_font'=>$button_font_color,
				'button_small_font'=>$button_small_font_color,
				'title_color'=>$title_color,
				'content_font_color'=>$content_font_color,
				'icon_color'=>$icon_color,
				'max_border_color'=>$border_color,	
				) );	
			}
			public function jobbank_all_functions(){
				include_once('functions/listing-functions.php');
				include_once('admin/pages/metaboxes/location-meta.php');
				include_once('admin/pages/metaboxes/category-meta.php');
			}
			public function jobbank_meta_save($post_id) {
				global $wpdb;
				$is_autosave = wp_is_post_autosave($post_id);
				if (isset($_REQUEST['jobbank_approve'])) {
					if($_REQUEST['jobbank_approve']=='yes'){ 
						update_post_meta($post_id, 'jobbank_approve', sanitize_text_field($_REQUEST['jobbank_approve']));
						// Set new user for post							
						$jobbank_author_id= sanitize_text_field($_REQUEST['jobbank_author_id']);
						$sql=$wpdb->prepare("UPDATE  $wpdb->posts SET post_author=%d  WHERE ID=$d",$jobbank_author_id,$post_id );		
						$wpdb->query($sql); 					
					}
				} 
				if (isset($_REQUEST['jobbank_featured'])) {							
					update_post_meta($post_id, 'jobbank_featured', sanitize_text_field($_REQUEST['jobbank_featured']));
				}
				if (isset($_REQUEST['listing_data_submit'])) {
					$newpost_id=$post_id;
					// For FAQ Save
					// Delete 1st
					$i=0;
					for($i=0;$i<20;$i++){
						delete_post_meta($newpost_id, 'faq_title'.$i);							
						delete_post_meta($newpost_id, 'faq_description'.$i);
					}
					// Delete End
					if(isset($_REQUEST['faq_title'] )){
						$faq_title= $_REQUEST['faq_title']; //this is array data we sanitize later, when it save				
						$faq_description= $_REQUEST['faq_description'];
						$i=0;
						for($i=0;$i<20;$i++){
							if(isset($faq_title[$i]) AND $faq_title[$i]!=''){
								update_post_meta($newpost_id, 'faq_title'.$i, sanitize_text_field($faq_title[$i]));
								update_post_meta($newpost_id, 'faq_description'.$i, sanitize_textarea_field($faq_description[$i]));
							}
						}
					}
					// End FAQ
					update_post_meta($newpost_id, 'jobbank_job_status', sanitize_text_field($_REQUEST['job_type'])); 
					$default_fields = array();
					$field_set=get_option('jobbank_li_fields' );
					if($field_set!=""){ 
						$default_fields=get_option('jobbank_li_fields' );
						}else{															
						$default_fields['business_type']='Business Type';
						$default_fields['main_products']='Main Products';
						$default_fields['number_of_employees']='Number Of Employees';
						$default_fields['main_markets']='Main Markets';
						$default_fields['total_annual_sales_volume']='Total Annual Sales Volume';	
					}					
					if(sizeof($default_fields )){			
						foreach( $default_fields as $field_key => $field_value ) { 
							update_post_meta($newpost_id, $field_key, $_REQUEST[$field_key] );							
						}					
					}
					update_post_meta($newpost_id, 'job_education', wp_kses( $_REQUEST['content_education'], $allowed_html));	
					update_post_meta($newpost_id, 'job_must_have', wp_kses( $_REQUEST['content_must_have'], $allowed_html));
					update_post_meta($newpost_id, 'address', sanitize_text_field($_REQUEST['address'])); 
					update_post_meta($newpost_id, 'latitude', sanitize_text_field($_REQUEST['latitude'])); 
					update_post_meta($newpost_id, 'longitude', sanitize_text_field($_REQUEST['longitude']));					
					update_post_meta($newpost_id, 'city', sanitize_text_field($_REQUEST['city'])); 
					update_post_meta($newpost_id, 'state', sanitize_text_field($_REQUEST['state'])); 
					update_post_meta($newpost_id, 'postcode', sanitize_text_field($_REQUEST['postcode'])); 
					update_post_meta($newpost_id, 'country', sanitize_text_field($_REQUEST['country'])); 
					update_post_meta($newpost_id, 'local-area', sanitize_text_field($_REQUEST['local-area'])); 
					// Get latlng from address* START********
					// Get latlng from address* ENDDDDDD********	
					// job detail*****
					update_post_meta($newpost_id, 'jobbank_job_status', sanitize_text_field($_REQUEST['job_type'])); 
					update_post_meta($newpost_id, 'educational_requirements', sanitize_text_field($_REQUEST['educational_requirements'])); 
					update_post_meta($newpost_id, 'job_type', sanitize_text_field($_REQUEST['job_type'])); 
					update_post_meta($newpost_id, 'jobbank_job_level', sanitize_text_field($_REQUEST['jobbank_job_level'])); 
					update_post_meta($newpost_id, 'jobbank_experience_range', sanitize_text_field($_REQUEST['jobbank_experience_range'])); 
					update_post_meta($newpost_id, 'age_range', sanitize_text_field($_REQUEST['age_range'])); 
					update_post_meta($newpost_id, 'gender', sanitize_text_field($_REQUEST['gender'])); 
					update_post_meta($newpost_id, 'vacancy', sanitize_text_field($_REQUEST['vacancy'])); 
					if($_REQUEST['deadline']==''){ 
						$deadline= date("Y-m-d", strtotime("+1 month"));
						}else{
						$deadline=sanitize_text_field($form_data['deadline']);
					}
					update_post_meta($newpost_id, 'deadline', $deadline); 
					update_post_meta($newpost_id, 'workplace', sanitize_text_field($_REQUEST['workplace']));
					update_post_meta($newpost_id, 'salary', sanitize_text_field($_REQUEST['salary']));
					update_post_meta($newpost_id, 'other_benefits', sanitize_text_field($_REQUEST['other_benefits']));
					if(isset($_REQUEST['dirpro_email_button'])){						
						update_post_meta($newpost_id, 'dirpro_email_button', sanitize_text_field($_REQUEST['dirpro_email_button'])); 
					}
					if(isset($_REQUEST['dirpro_web_button'])){						
						update_post_meta($newpost_id, 'dirpro_web_button', sanitize_text_field($_REQUEST['dirpro_web_button'])); 
					}
					update_post_meta($newpost_id, 'image_gallery_ids', sanitize_text_field($_REQUEST['gallery_image_ids'])); 
					update_post_meta($newpost_id, 'topbanner', sanitize_text_field($_REQUEST['topbanner_image_id'])); 
					if(isset($_REQUEST['feature_image_id'] )){
						$attach_id =sanitize_text_field($_REQUEST['feature_image_id']);
						set_post_thumbnail( $newpost_id, $attach_id );					
					}
					update_post_meta($newpost_id, 'external_form_url', sanitize_url($_REQUEST['external_form_url']));  
					update_post_meta($newpost_id, 'listing_contact_source', sanitize_text_field($_REQUEST['contact_source']));  
					update_post_meta($newpost_id, 'company_name', sanitize_text_field($_REQUEST['company_name']));
					update_post_meta($newpost_id, 'phone', sanitize_text_field($_REQUEST['phone'])); 
					update_post_meta($newpost_id, 'address', sanitize_text_field($_REQUEST['address'])); 
					update_post_meta($newpost_id, 'contact-email', sanitize_text_field($_REQUEST['contact-email'])); 
					update_post_meta($newpost_id, 'contact_web', sanitize_text_field($_REQUEST['contact_web']));
					update_post_meta($newpost_id, 'vimeo', sanitize_text_field($_REQUEST['vimeo'])); 
					update_post_meta($newpost_id, 'youtube', sanitize_text_field($_REQUEST['youtube'])); 
					delete_post_meta($newpost_id, 'jobbank-tags');
					delete_post_meta($newpost_id, 'jobbank-category');
					delete_post_meta($newpost_id, 'jobbank-locations');
				}
			}
			/**
				* Checks that the WordPress setup meets the plugin requirements
				* @global string $wp_version
				* @return boolean
			*/
			private function check_requirements() {
				global $wp_version;
				if (!version_compare($wp_version, $this->wp_version, '>=')) {
					add_action('admin_notices', 'eplugins_jobbank::display_req_notice');
					return false;
				}
				return true;
			}
			/**
				* Display the requirement notice
				* @static
			*/
			static function display_req_notice() {
				global $eplugins_jobbank;
				echo '<div id="message" class="error"><p><strong>';
				echo esc_html__('Sorry, BootstrapPress re requires WordPress ' . $eplugins_jobbank->wp_version . ' or higher.
				Please upgrade your WordPress setup', 'jobbank');
				echo '</strong></p></div>';
			}
			private function load_dependencies() {
				// Admin Panel
				if (is_admin()) {						
					require_once ('admin/notifications.php');					
					require_once ('admin/admin.php');					
				}
				// Front-End Site
				if (!is_admin()) {
				}
				require_once('functions/listing-functions.php');
				// Global
			}
			/**
				* Called every time the plug-in is activated.
			*/
			public function activate() {				
				require_once ('install/install.php');
			}
			/**
				* Called when the plug-in is deactivated.
			*/
			public function deactivate() {
				global $wpdb;			
				$page_name='price-table';						
				$query = "delete from {$wpdb->prefix}posts where  post_name='".$page_name."'";
				$wpdb->query($query);
				$page_name='registration';						
				$query = "delete from {$wpdb->prefix}posts where  post_name='".$page_name."'";
				$wpdb->query($query);
				$page_name='my-account';						
				$query = "delete from {$wpdb->prefix}posts where  post_name='".$page_name."' ";
				$wpdb->query($query);
				$page_name='agent-public';						
				$query = "delete from {$wpdb->prefix}posts where  post_name='".$page_name."' ";
				$wpdb->query($query);
				$page_name='login';						
				$query = "delete from {$wpdb->prefix}posts where  post_name='".$page_name."'";				
				$wpdb->query($query);
				$page_name='candidate-directory';						
				$query = "delete from {$wpdb->prefix}posts where  post_name='".$page_name."' ";
				$wpdb->query($query);
				$page_name='candidate-public';						
				$query = "delete from {$wpdb->prefix}posts where  post_name='".$page_name."' ";				
				$wpdb->query($query);
				$page_name='employer-directory';						
				$query = "delete from {$wpdb->prefix}posts where  post_name='".$page_name."' ";				
				$wpdb->query($query);
				$page_name='employer-public';						
				$query = "delete from {$wpdb->prefix}posts where  post_name='".$page_name."' ";				
				$wpdb->query($query);
				$page_name='all-listings';						
				$query = "delete from {$wpdb->prefix}posts where  post_name='".$page_name."' ";				
				$wpdb->query($query);
				$page_name='all-listings-no-map';						
				$query = "delete from {$wpdb->prefix}posts where  post_name='".$page_name."' ";				
				$wpdb->query($query);
				$page_name='all-locations';						
				$query = "delete from {$wpdb->prefix}posts where  post_name='".$page_name."' ";				
				$wpdb->query($query);
				$page_name='all-categories';						
				$query = "delete from {$wpdb->prefix}posts where  post_name='".$page_name."' ";				
				$wpdb->query($query);
				$page_name='search-form';						
				$query = "delete from {$wpdb->prefix}posts where  post_name='".$page_name."' ";				
				$wpdb->query($query);				
				$page_name='add-listing';						
				$query = "delete from {$wpdb->prefix}posts where  post_name='".$page_name."' ";				
				$wpdb->query($query);	
			}
			/**
				* Called when the plug-in is uninstalled
			*/
			static function uninstall() {
			}
			/**
				* Register the widgets
			*/
			public function register_widget() {
			}
			/**
				* Internationalization
			*/
			public function i18n() {
				load_plugin_textdomain('jobbank', false, basename(dirname(__FILE__)) . '/languages/' );
			}
			/**
				* Starts the plug-in main functionality
			*/
			
			public function jobbank_price_table_func($atts = '', $content = '') {									
				ob_start();					  //include the specified file
				include( ep_jobbank_template. 'price-table/price-table-1.php');
				$content = ob_get_clean();	
				return $content;
			}
			public function jobbank_form_wizard_func($atts = '') {
				global $current_user;
				$template_path=ep_jobbank_template.'signup/';
				ob_start();	 //include the specified file
				if($current_user->ID==0){
					$signup_access= get_option('users_can_register');	
					if($signup_access=='0'){
						esc_html_e( 'Sorry! You are not allowed for signup.', 'jobbank' );
						}else{
						include( $template_path. 'wizard-style-2.php');
					}						
					}else{						  
					include( ep_jobbank_template. 'private-profile/profile-template-1.php');
				}
				$content = ob_get_clean();	
				return $content;
			}
			public function jobbank_profile_template_func($atts = '') {
				global $current_user;
				ob_start();
				if($current_user->ID==0){
					require_once(ep_jobbank_template. 'private-profile/profile-login.php');
					}else{					  
					include( ep_jobbank_template. 'private-profile/profile-template-1.php');
				}
				$content = ob_get_clean();	
				return $content;
			}
			public function jobbank_reminder_email_cron_func ($atts = ''){
				include( ep_jobbank_ABSPATH. 'inc/reminder-email-cron.php');
			}
			public function jobbank_cron_job(){
				include( ep_jobbank_ABSPATH. 'inc/all_cron_job.php');
				exit(0);
			}
			public function jobbank_categories_func($atts = ''){
				ob_start();				
				include( ep_jobbank_template. 'listing/listing_categories.php');
				$content = ob_get_clean();
				return $content;	
			}
			public function jobbank_add_listing_func(){
				ob_start();	
				include( ep_jobbank_template. 'private-profile/add-listing-without-user.php');
				$content = ob_get_clean();
				return $content;
			}
			public function jobbank_locations_func($atts = ''){
				ob_start();	
				include( ep_jobbank_template. 'listing/listing-locations.php');
				$content = ob_get_clean();
				return $content;
			}
			public function jobbank_search_popup_func($atts = ''){
				ob_start();	
				include( ep_jobbank_template. 'listing/listing_search_popup.php');
				$content = ob_get_clean();
				return $content;
			}
			public function jobbank_search_func($atts = ''){
				ob_start();	
				include( ep_jobbank_template. 'listing/listing_search.php');
				$content = ob_get_clean();
				return $content;
			}
			public function jobbank_categories_carousel_func($atts = ''){
				ob_start();	
				include( ep_jobbank_template. 'listing/carousel/categories-carousel.php');
				$content = ob_get_clean();
				return $content;
			}
			public function jobbank_tags_carousel_func($atts = ''){
				ob_start();	
				include( ep_jobbank_template. 'listing/carousel/tags-carousel.php');
				$content = ob_get_clean();
				return $content;
			}
			public function jobbank_locations_carousel_func($atts = ''){
				ob_start();	
				include( ep_jobbank_template. 'listing/carousel/locations-carousel.php');
				$content = ob_get_clean();
				return $content;
			}
			public function jobbank_map_func($atts = ''){
				ob_start();	
				include( ep_jobbank_template. 'listing/archive-map.php');
				$content = ob_get_clean();
				return $content;
			}				
			public function jobbank_featured_func($atts = ''){
				ob_start();	
				if(isset($atts['style']) and $atts['style']!="" ){
					$tempale=$atts['style']; 
					}else{
					$tempale=get_option('jobbank_featured'); 
				}
				if($tempale==''){
					$tempale='style-1';
				}						
				//include the specified file
				if($tempale=='style-1'){
					include( ep_jobbank_template. 'listing/listing_featured.php');
				}
				$content = ob_get_clean();
				return $content;	
			}	
			public function jobbank_archive_grid_top_map_func($atts=''){
				ob_start();	
				include( ep_jobbank_template. 'listing/archive-grid-top-map.php');
				$content = ob_get_clean();
				return $content;
			}
			public function jobbank_archive_grid_func($atts=''){
				ob_start();	
				include( ep_jobbank_template. 'listing/archive-grid.php');
				$content = ob_get_clean();
				return $content;
			}
			public function jobbank_archive_grid_no_map_func($atts=''){
				ob_start();	
				include( ep_jobbank_template. 'listing/archive-grid-no-map.php');
				$content = ob_get_clean();
				return $content;
			}
			public function jobbank_listing_filter_func($atts=''){
				ob_start();	
				include( ep_jobbank_template. 'listing/listing-filter.php');
				$content = ob_get_clean();
				return $content;				
			}
			public function jobbank_employer_directory_func($atts = ''){
				global $current_user;	
				ob_start(); //include the specified file					
				include( ep_jobbank_template. 'user-directory/employer-directory.php');
				$content = ob_get_clean();
				return $content;	
			}
			public function jobbank_candidate_directory_func($atts = ''){
				global $current_user;	
				ob_start(); //include the specified file					
				include( ep_jobbank_template. 'user-directory/candidate-directory.php');
				$content = ob_get_clean();
				return $content;	
			}
			public function get_unique_location_values( $key = 'keyword', $post_type ){
				global $wpdb;
				$post_type=get_option('ep_jobbank_url');
				if($post_type==""){$post_type='job';}
				$all_data=array();
				// Area**
				$dir_facet_title=get_option('dir_facet_area_title');
				if($dir_facet_title==""){$dir_facet_title= esc_html__('Area','jobbank');}
				$res=array();
				$key = 'area';
				$res = $wpdb->get_col( $wpdb->prepare( "
				SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
				LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
				WHERE p.post_type='{$post_type}' AND  pm.meta_key = '%s'						
				", $key) );						
				foreach($res as $row1){							
					$row_data=array();
					if(!empty($row1)){
						$row_data['label']=$row1;
						$row_data['value']=$row1;
						$row_data['category']= $dir_facet_title;
						array_push( $all_data, $row_data );
					}
				}
				// City ***
				$dir_facet_title=get_option('dir_facet_location_title');
				if($dir_facet_title==""){$dir_facet_title= esc_html__('City','jobbank');}
				$res=array();
				$key = 'city';
				$res = $wpdb->get_col( $wpdb->prepare( "
				SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
				LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
				WHERE p.post_type='{$post_type}' AND  pm.meta_key = '%s'						
				", $key) );						
				foreach($res as $row1){							
					$row_data=array();
					if(!empty($row1)){
						$row_data['label']=$row1;
						$row_data['value']=$row1;
						$row_data['category']= $dir_facet_title;
						array_push( $all_data, $row_data );
					}	
				}
				// Zipcode ***
				$dir_facet_title=get_option('dir_facet_zipcode_title');
				if($dir_facet_title==""){$dir_facet_title= esc_html__('Zipcode','jobbank');}
				$res=array();
				$key = 'postcode';
				$res = $wpdb->get_col( $wpdb->prepare( "
				SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
				LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
				WHERE p.post_type='{$post_type}' AND  pm.meta_key = '%s'						
				", $key) );						
				foreach($res as $row1){							
					$row_data=array();
					if(!empty($row1)){
						$row_data['label']=$row1;
						$row_data['value']=$row1;
						$row_data['category']= $dir_facet_title;
						array_push( $all_data, $row_data );
					}	
				}
				$all_data_json= json_encode($all_data);		
				return $all_data_json;
			}
			public function get_unique_search_values(){						
				global $wpdb;
				$post_type=get_option('ep_jobbank_url');
				if($post_type==""){$post_type='job';}
				$res=array();
				$all_data=array();						
				$partners = array();
				$partners_obj =  get_terms( $post_type.'-category', array('hide_empty' => true) );
				$dir_facet_title=get_option('dir_facet_cat_title');
				if($dir_facet_title==""){$dir_facet_title= esc_html__('Categories','jobbank');}
				foreach ($partners_obj as $partner) {
					$row_data=array();
					$row_data['label']=$partner->name.'['.$partner->count.']';
					$row_data['value']=$partner->name;
					$row_data['category']= $dir_facet_title;
					array_push( $all_data, $row_data );
				}
				// For tags
				$dir_facet_title=get_option('dir_facet_features_title');
				if($dir_facet_title==""){$dir_facet_title= esc_html__('Features','jobbank');}
				$dir_tags=get_option('epjbdir_tags');	
				if($dir_tags==""){$dir_tags='yes';}	
				if($dir_tags=="yes"){
					$partners = array();
					$partners_obj =  get_terms( $post_type.'-tag', array('hide_empty' => true) );
					foreach ($partners_obj as $partner) {
						$row_data=array();
						$row_data['label']=$partner->name.'['.$partner->count.']';
						$row_data['value']=$partner->name;
						$row_data['category']=$dir_facet_title;
						array_push( $all_data, $row_data );
					}
					}else{
					$args =array();
					$args['hide_empty']=true;
					$tags = get_tags($args );
					foreach ( $tags as $tag ) { 
						$row_data=array();
						$row_data['label']=$tag->name.'['.$tag->count.']';
						$row_data['value']=$tag->name;
						$row_data['category']=$dir_facet_title;
						array_push( $all_data, $row_data );
					}							
				}
				// End Tags	****					
				$args3 = array(
				'post_type' => $post_type, // enter your custom post type						
				'post_status' => 'publish',						
				'posts_per_page'=> -1,  // overrides posts per page in theme settings
				'orderby' => 'title',
				'order' => 'ASC',
				);
				$all_data_json=array();
				$query_auto = new WP_Query( $args3 );
				$posts_auto = $query_auto->posts;						
				foreach($posts_auto as $post_a) {
					$row_data=array();  
					$row_data['label']=$post_a->post_title;
					$row_data['value']=$post_a->post_title;
					$row_data['category']= esc_html__('Title','jobbank');
					array_push( $all_data, $row_data );
				}						
				$all_data_json= json_encode($all_data);	
				return $all_data_json;
			}
			public function jobbank_candidate_profile_public_func($atts = '') {	
				ob_start();						  //include the specified file
				include( ep_jobbank_template. 'profile-public/candidate-profile.php');							
				$content = ob_get_clean();	
				return $content;
			}
			public function jobbank_employer_profile_public_func($atts = '') {	
				ob_start();						  //include the specified file
				include( ep_jobbank_template. 'profile-public/employer-profile.php');							
				$content = ob_get_clean();	
				return $content;
			}
			public function jobbank_create_taxonomy_locations(){
				$jobbank_directory_url=get_option('ep_jobbank_url');
				if($jobbank_directory_url==""){$jobbank_directory_url='job';}
				$jobbank_directory_url_name=ucfirst('Locations');
				$labels = array(			
				'all_items'           => esc_html__( 'All Location', 'jobbank' ).$jobbank_directory_url_name,
				'add_new_item'        => esc_html__( 'Add New Location', 'jobbank' ),
				'add_new'             => esc_html__( 'Add Location', 'jobbank' ),
				'new_item'            => esc_html__( 'New Location', 'jobbank' ),
				'edit_item'           => esc_html__( 'Edit Location', 'jobbank' ),
				'update_item'         => esc_html__( 'Update Location', 'jobbank' ),
				'view_item'           => esc_html__( 'View Location', 'jobbank' ),
				'search_items'        => esc_html__( 'Search Location', 'jobbank' ),
				'not_found'           => esc_html__( 'Not found', 'jobbank' ),
				'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'jobbank' ),
				);
				register_taxonomy(
				$jobbank_directory_url.'-locations',
				$jobbank_directory_url,
				array(
				'label' => esc_html__( 'Locations', 'jobbank'),					
				'description'         => esc_html__('Locations' , 'jobbank' ),
				'labels'              => $labels,
				'rewrite' => array( 'slug' => $jobbank_directory_url.'-locations' ),
				'description'         => esc_html__( 'Location', 'jobbank' ),
				'hierarchical' => true,
				'show_in_rest' =>	true,
				)
				);		
			}
			public function jobbank_create_taxonomy_tags(){
				$jobbank_directory_url=get_option('ep_jobbank_url');
				if($jobbank_directory_url==""){$jobbank_directory_url='job';}
				$jobbank_directory_url_name=ucfirst('Tags');
				$labels = array(			
				'all_items'           => esc_html__( 'All Tags', 'jobbank' ).$jobbank_directory_url_name,
				'add_new_item'        => esc_html__( 'Add New Tags', 'jobbank' ),
				'add_new'             => esc_html__( 'Add Tags', 'jobbank' ),
				'new_item'            => esc_html__( 'New Tags', 'jobbank' ),
				'edit_item'           => esc_html__( 'Edit Tags', 'jobbank' ),
				'update_item'         => esc_html__( 'Update Tags', 'jobbank' ),
				'view_item'           => esc_html__( 'View Tags', 'jobbank' ),
				'search_items'        => esc_html__( 'Search Tags', 'jobbank' ),
				'not_found'           => esc_html__( 'Not found', 'jobbank' ),
				'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'jobbank' ),
				);
				register_taxonomy(
				$jobbank_directory_url.'-tag',
				$jobbank_directory_url,
				array(
				'label' => esc_html__( 'Tags', 'jobbank'),					
				'description'         => esc_html__('Tags' , 'jobbank' ),
				'labels'              => $labels,
				'rewrite' => array( 'slug' => $jobbank_directory_url.'-tag' ),					
				'hierarchical' => true,
				'show_in_rest' =>	true,
				)
				);						
			}		
			public function jobbank_save_favorite(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'contact' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['data'], $form_data);					
				$dir_id=sanitize_text_field($form_data['id']);
				$old_favorites= get_post_meta($dir_id,'_favorites',true);
				$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
				$new_favorites=$old_favorites.', '.get_current_user_id();
				update_post_meta($dir_id,'_favorites',$new_favorites);
				$old_favorites2=get_user_meta(get_current_user_id(),'_dir_favorites', true);						
				$old_favorites2 = str_replace($dir_id ,' ',  $old_favorites2);
				$new_favorites2=$old_favorites2.', '.$dir_id;
				update_user_meta(get_current_user_id(),'_dir_favorites',$new_favorites2);
				echo json_encode(array("msg" => 'success'));
				exit(0);	
			}
			public function jobbank_applied_delete(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'contact' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['data'], $form_data);					
				$dir_id=sanitize_text_field($form_data['id']);
				$old_favorites= get_post_meta($dir_id,'job_apply_all',true);
				$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
				$new_favorites=$old_favorites;
				update_post_meta($dir_id,'job_apply_all',$new_favorites);
				$old_favorites2=get_user_meta(get_current_user_id(),'job_apply_all', true);						
				$old_favorites2 = str_replace($dir_id ,' ',  $old_favorites2);
				$new_favorites2=$old_favorites2;
				update_user_meta(get_current_user_id(),'job_apply_all',$new_favorites2);
				echo json_encode(array("msg" => 'success'));
				exit(0);	
			}
			public function jobbank_save_un_favorite(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'contact' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['data'], $form_data);					
				$dir_id=sanitize_text_field($form_data['id']);
				$old_favorites= get_post_meta($dir_id,'_favorites',true);
				$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
				$new_favorites=$old_favorites;
				update_post_meta($dir_id,'_favorites',$new_favorites);
				$old_favorites2=get_user_meta(get_current_user_id(),'_dir_favorites', true);						
				$old_favorites2 = str_replace($dir_id ,' ',  $old_favorites2);
				$new_favorites2=$old_favorites2;
				update_user_meta(get_current_user_id(),'_dir_favorites',$new_favorites2);
				echo json_encode(array("msg" => 'success'));
				exit(0);	
			}
			public function jobbank_save_notification(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'contact' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['form_data'], $form_data);	
				get_current_user_id();
				$notification_value=array();
				$notification= $form_data['notificationone']; //this is array data we sanitize later, when it save
				foreach($notification as $notification_one){
					if( $notification_one!=''){							
						$notification_value[]= sanitize_text_field($notification_one);
					}
				}	
				update_user_meta(get_current_user_id(),'job_notifications',$notification_value);
				echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
				exit(0);	
			}
			public function jobbank_candidate_schedule(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['form_data'], $form_data);	
				$dir_id=sanitize_text_field($form_data['dir_id']);	
				$already_meeting=get_post_meta($dir_id,'candidate_schedule',true);
				update_post_meta($dir_id,'candidate_schedule','yes');
				update_post_meta($dir_id,'candidate_schedule_time',sanitize_text_field($form_data['meeting_date']));
				update_post_meta($dir_id,'candidate_schedule_note',sanitize_text_field($form_data['message-content']));
				echo json_encode(array("msg" => 'success', 'already_meeting'=>$already_meeting ));
				exit(0);
			}
			public function jobbank_candidate_shortlisted(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}				
				parse_str($_POST['data'], $form_data);	
				$dir_id=sanitize_text_field($form_data['id']);	
				if(isset($form_data['shortlisted'])){
					update_post_meta($dir_id,'jobbank_candidate_shortlisted','no');
					}else{
					update_post_meta($dir_id,'jobbank_candidate_shortlisted','yes');
				}
				echo json_encode(array("msg" => 'success'));
				exit(0);	
			}
			public function jobbank_profile_bookmark(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				
				parse_str($_POST['data'], $form_data);					
				$dir_id=sanitize_text_field($form_data['id']);
				$old_favorites= get_post_meta($dir_id,'jobbank_profilebookmark',true);
				$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
				$new_favorites=$old_favorites.', '.get_current_user_id();
				update_post_meta($dir_id,'jobbank_profilebookmark',$new_favorites);
				$old_favorites2=get_user_meta(get_current_user_id(),'jobbank_profilebookmark', true);						
				$old_favorites2 = str_replace($dir_id ,' ',  $old_favorites2);
				$new_favorites2=$old_favorites2.', '.$dir_id;
				update_user_meta(get_current_user_id(),'jobbank_profilebookmark',$new_favorites2);
				echo json_encode(array("msg" => 'success'));
				exit(0);	
			}
			public function jobbank_profile_bookmark_delete(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['data'], $form_data);					
				$dir_id=sanitize_text_field($form_data['id']);
				$old_favorites= get_post_meta($dir_id,'jobbank_profilebookmark',true);
				$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
				$new_favorites=$old_favorites;
				update_post_meta($dir_id,'jobbank_profilebookmark',$new_favorites);
				$old_favorites2=get_user_meta(get_current_user_id(),'jobbank_profilebookmark', true);						
				$old_favorites2 = str_replace($dir_id ,'',  $old_favorites2);
				$new_favorites2=$old_favorites2;
				update_user_meta(get_current_user_id(),'jobbank_profilebookmark',$new_favorites2);
				echo json_encode(array("msg" => 'success'));
				exit(0);		
			}
			public function jobbank_employer_bookmark(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['data'], $form_data);					
				$dir_id=sanitize_text_field($form_data['id']);
				$old_favorites= get_post_meta($dir_id,'jobbank_employerbookmark',true);
				$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
				$new_favorites=$old_favorites.', '.get_current_user_id();
				update_post_meta($dir_id,'jobbank_employerbookmark',$new_favorites);
				$old_favorites2=get_user_meta(get_current_user_id(),'jobbank_employerbookmark', true);						
				$old_favorites2 = str_replace($dir_id ,' ',  $old_favorites2);
				$new_favorites2=$old_favorites2.', '.$dir_id;
				update_user_meta(get_current_user_id(),'jobbank_employerbookmark',$new_favorites2);
				echo json_encode(array("msg" => 'success'));
				exit(0);	
			}
			public function jobbank_message_delete(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['data'], $form_data);
				global $current_user;
				$message_id=sanitize_text_field($form_data['id']);
				$user_to=get_post_meta($message_id,'user_to',true);	
				if($user_to==$current_user->ID){				
					wp_delete_post($message_id);
					delete_post_meta($message_id,true);	
					echo json_encode(array("msg" => 'success'));
					}else{
					echo json_encode(array("msg" => 'Not success'));
				}
				exit(0);		
			}
			public function jobbank_load_categories_fields_wpadmin(){
				$jobbank_directory_url=get_option('ep_jobbank_url');					
				if($jobbank_directory_url==""){$jobbank_directory_url='job';}
				$main_class = new eplugins_jobbank;
				$fields_data='';
				$categories_arr=array();
				$term_id = $_POST['term_id'];
				$post_id= $_POST['post_id'];
				$datatype= $_POST['datatype']; 
				if (!empty($term_id)) {
					if($datatype!='slug'){
						foreach ($term_id as $tid) {
							$category = get_term_by('name', $tid, $jobbank_directory_url.'-category');
							$categories_arr[] = $category->slug;
						}
						}else{
						foreach ($term_id as $tid) {							
							$categories_arr[] = $tid;
						}
					}
					$fields_data=$main_class->jobbank_listing_fields($post_id, $categories_arr );
				}
				echo json_encode(array("msg" => 'success',"field_data"=>$fields_data));
				exit(0);
			}
			public function jobbank_listing_fields($listid, $categories_arr){ 
				$listid=$listid;
				$default_fields = array();			
				$jobbank_fields=  		get_option( 'jobbank_li_fields' );
				$field_type=  get_option( 'jobbank_li_field_type' );
				$field_type_value=  get_option( 'jobbank_li_fieldtype_value' );													
				$jobbank_field_type_cat=  get_option( 'jobbank_field_type_cat' );
				if($jobbank_fields==""){ 									
					$default_fields['business_type']='Business Type';
					$default_fields['main_products']='Main Products';
					$default_fields['number_of_employees']='Number Of Employees';
					$default_fields['main_markets']='Main Markets';
					$default_fields['total_annual_sales_volume']='Total Annual Sales Volume';
					}else{
					$default_fields=$jobbank_fields;				
				}
				$return_value='';
				foreach ( $default_fields as $field_key_pass => $field_value ) { 					
					$intersection='';				
					$field_cat_arr= $jobbank_field_type_cat[$field_key_pass];					
					if(is_array($field_cat_arr) AND is_array($categories_arr) ){
						$intersection = array_intersect($categories_arr, $jobbank_field_type_cat[$field_key_pass]);
					}
					if(!empty($intersection)){ 
						$return_value=$return_value.'<div class="col-md-12">';
						if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='dropdown'){	 								
							$dropdown_value= explode(',',$field_type_value[$field_key_pass]);
							$return_value=$return_value.'<div class="form-group row">
							<label class="control-label col-md-4">'. esc_html($field_value).'</label>
							<div class="col-md-8"><select name="'. esc_html($field_key_pass).'" id="'.esc_attr($field_key_pass).'" class="form-control "  >';				
							foreach($dropdown_value as $one_value){	 
								if(trim($one_value)!=''){
									$return_value=$return_value.'<option '.(trim(get_post_meta($listid,$field_key_pass,true))==trim($one_value)?' selected':'').' value="'. esc_attr($one_value).'">'. esc_html($one_value).'</option>';
								}
							}	
							$return_value=$return_value.'</select></div></div>';					
						}
						if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='checkbox'){								
							$dropdown_value= explode(',',$field_type_value[$field_key_pass]);						
							$return_value=$return_value.'<div class="form-group row">
							<label class="control-label col-md-4">'. esc_html($field_value).'</label>
							<div class="col-md-8">
							<div class="" >
							';
							$saved_checkbox_value=get_post_meta($listid,$field_key_pass,true);							
							if(!is_array($saved_checkbox_value)){
								if($saved_checkbox_value!=''){								
									$saved_checkbox_value =	explode(',',get_post_meta($listid,$field_key_pass,true));
								}
							}
							if(empty($saved_checkbox_value)){$saved_checkbox_value=array();}
							foreach($dropdown_value as $one_value){
								if(trim($one_value)!=''){
									$return_value=$return_value.'
									<div class="form-check form-check-inline col-md-12 margin-top10">
									<label class="form-check-label" for="'. esc_attr($one_value).'">
									<input '.( in_array($one_value,$saved_checkbox_value)?' checked':'').' class=" form-check-input" type="checkbox" name="'. esc_attr($field_key_pass).'[]"  id="'. esc_attr($one_value).'" value="'. esc_attr($one_value).'">
									'. esc_attr($one_value).' </label>
									</div>';
								}
							}	
							$return_value=$return_value.'</div></div></div>';						
						}
						if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='radio'){	 								
							$dropdown_value= explode(',',$field_type_value[$field_key_pass]);
							$return_value=$return_value.'<div class="form-group row ">
							<label class="control-label col-md-4">'. esc_html($field_value).'</label>
							<div class="col-md-8">
							<div class="" >
							';						
							foreach($dropdown_value as $one_value){	 
								if(trim($one_value)!=''){
									$return_value=$return_value.'
									<div class="form-check form-check-inline col-md-12 margin-top10">
									<label class="form-check-label " for="'. esc_attr($one_value).'">
									<input '.(get_post_meta($listid,$field_key_pass,true)==$one_value?' checked':'').' class="form-check-input" type="radio" name="'. esc_attr($field_key_pass).'"  id="'. esc_attr($one_value).'" value="'. esc_attr($one_value).'">
									'. esc_attr($one_value).'</label>
									</div>														
									';
								}
							}	
							$return_value=$return_value.'</div></div></div>';					
						}					 
						if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='textarea'){	
							$return_value=$return_value.'<div class="form-group row">';
							$return_value=$return_value.'<label class="control-label col-md-4">'. esc_html($field_value).'</label>';
							$return_value=$return_value.'<div class="col-md-8"><textarea  placeholder="'.esc_html__('Enter ','ivdirectories').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="col-md-12"  rows="4"/>'.esc_attr(get_post_meta($listid,$field_key_pass,true)).'</textarea></div></div>';
						}
						if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='datepicker'){	 
							$return_value=$return_value.'<div class="form-group row">';
							$return_value=$return_value.'<label class="control-label col-md-4">'. esc_html($field_value).'</label>';
							$return_value=$return_value.'<div class="col-md-8"><input type="text" placeholder="'.esc_html__('Select ','ivdirectories').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-control epinputdate " value="'.esc_attr(get_post_meta($listid,$field_key_pass,true)).'"/></div></div>';
						}
						if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='text'){	 
							$return_value=$return_value.'<div class="form-group row">';
							$return_value=$return_value.'<label class="control-label col-md-4">'. esc_html($field_value).'</label>';
							$return_value=$return_value.'<div class="col-md-8"><input type="text" placeholder="'.esc_html__('Enter ','ivdirectories').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-control " value="'.esc_attr(get_post_meta($listid,$field_key_pass,true)).'"/></div></div>';
						}
						if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='url'){	 
							$return_value=$return_value.'<div class="form-group row">';
							$return_value=$return_value.'<label class="control-label col-md-4">'. esc_html($field_value).'</label>';
							$return_value=$return_value.'<div class="col-md-8"><input type="text" placeholder="'.esc_html__('Enter ','ivdirectories').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-control " value="'.esc_url(get_post_meta($listid,$field_key_pass,true)).'"/></div></div>';
						}
						$return_value=$return_value.'</div>';
					}
				} // For main  fields loop 
				return $return_value;
			}
			public function jobbank_employer_bookmark_delete(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['data'], $form_data);					
				$dir_id=sanitize_text_field($form_data['id']);
				$old_favorites= get_post_meta($dir_id,'jobbank_employerbookmark',true);
				$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
				$new_favorites=$old_favorites;
				update_post_meta($dir_id,'jobbank_employerbookmark',$new_favorites);
				$old_favorites2=get_user_meta(get_current_user_id(),'jobbank_employerbookmark', true);						
				$old_favorites2 = str_replace($dir_id ,'',  $old_favorites2);
				$new_favorites2=$old_favorites2;
				update_user_meta(get_current_user_id(),'jobbank_employerbookmark',$new_favorites2);
				echo json_encode(array("msg" => 'success'));
				exit(0);		
			}
			public function jobbank_candidate_delete(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				global $current_user;
				parse_str($_POST['data'], $form_data);	
				$post_id=sanitize_text_field($form_data['id']);				
				$job_post_id= get_post_meta($post_id,'apply_jod_id',true);
				$post_edit = get_post($job_post_id);				
				$success='0';
				if($post_edit){
					if($post_edit->post_author==$current_user->ID){
						wp_delete_post($post_id);
						delete_post_meta($post_id,true);
						$success='1';
					}
					if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
						wp_delete_post($post_id);
						delete_post_meta($post_id,true);								
						$success='1';
					}	
				}
				if($success=='1'){
					echo json_encode(array("msg" => 'success'));
					}else{
					echo json_encode(array("msg" => 'not-success'));
				}				
				exit(0);
			}
			public function jobbank_candidate_reject(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				global $current_user;
				parse_str($_POST['data'], $form_data);							
				$post_id=sanitize_text_field($form_data['id']);				
				$job_post_id= get_post_meta($post_id,'apply_jod_id',true);
				$post_edit = get_post($job_post_id);				
				$success='0';
				if(isset($form_data['reject'])){
					if($post_edit->post_author==$current_user->ID){ 
						update_post_meta($post_id,'jobbank_candidate_reject','no');		
						$success='1';
					}
					if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){ 
						update_post_meta($post_id,'jobbank_candidate_reject','no');							
						$success='1';
					}	
					}else{
					if($post_edit){
						if($post_edit->post_author==$current_user->ID){ 
							update_post_meta($post_id,'jobbank_candidate_reject','yes');		
							$success='1';
						}
						if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){ 
							update_post_meta($post_id,'jobbank_candidate_reject','yes');							
							$success='1';
						}	
					}
				}
				if($success=='1'){
					echo json_encode(array("msg" => 'success'));
					}else{
					echo json_encode(array("msg" => 'not-success'));
				}		
				exit(0);
			}
			public function jobbank_delete_favorite(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['data'], $form_data);					
				$dir_id=sanitize_text_field($form_data['id']);						
				$old_favorites= get_post_meta($dir_id,'_favorites',true);
				$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
				$new_favorites=$old_favorites;
				update_post_meta($dir_id,'_favorites',$new_favorites);						
				$old_favorites2=get_user_meta(get_current_user_id(),'_dir_favorites', true);						
				$old_favorites2 = str_replace($dir_id ,' ',  $old_favorites2);						
				$new_favorites2=$old_favorites2;
				update_user_meta(get_current_user_id(),'_dir_favorites',$new_favorites2);
				echo json_encode(array("msg" => 'success'));
				exit(0);
			}
			public function jobbank_message_send(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'contact' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['form_data'], $form_data);					
				// Create new message post
				$allowed_html = wp_kses_allowed_html( 'post' );					
				if(isset($form_data['dir_id'])){
					if($form_data['dir_id']>0){
						$dir_id=sanitize_text_field($form_data['dir_id']);
						$dir_detail= get_post($dir_id); 
						$dir_title= '<a href="'.get_permalink($dir_id).'">'.$dir_detail->post_title.'</a>';
						$user_id=$dir_detail->post_author;
						$user_info = get_userdata( $user_id);
						$client_email_address =$user_info->user_email;
						$userid_to=$user_id;
					}
				}
				if(isset($form_data['user_id'])){
					if($form_data['user_id']!=''){
						$dir_title= '';
						$user_info = get_userdata(sanitize_text_field($form_data['user_id']));
						$client_email_address =$user_info->user_email;
						$userid_to=sanitize_text_field($form_data['user_id']);
					}
				}
				$new_nessage= esc_html__( 'New Message', 'jobbank' );
				$my_post=array();
				$subject=$new_nessage;
				if(isset($form_data['subject'])){
					$subject=sanitize_text_field($form_data['subject']);
				} 
				$my_post['post_title'] =$subject;
				$my_post['post_content'] = wp_kses( $form_data['message-content'], $allowed_html); 
				$my_post['post_type'] = 'jobbank_message';
				$my_post['post_status']='private';												
				$newpost_id= wp_insert_post( $my_post );
				Update_post_meta($newpost_id,'user_to', $userid_to );
				Update_post_meta($newpost_id,'dir_url', $dir_title );				
				Update_post_meta($newpost_id,'from_email',sanitize_email($form_data['email_address']) );
				if(isset($form_data['name'])){
					Update_post_meta($newpost_id,'from_name', sanitize_text_field($form_data['name']) );
				}
				Update_post_meta($newpost_id,'from_phone', sanitize_text_field($form_data['visitorphone']) );
				include( ep_jobbank_ABSPATH. 'inc/message-mail.php');	
				echo json_encode(array("msg" => esc_html__( 'Message Sent', 'jobbank' )));
				exit(0);
			}
			public function jobbank_claim_send(){
				if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'contact' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['form_data'], $form_data);					
				include( ep_jobbank_ABSPATH. 'inc/claim-mail.php');	
				echo json_encode(array("msg" => esc_html__( 'Message Sent', 'jobbank' )));
				exit(0);
			}
			public function check_listing_expire_date($listin_id, $owner_id,$jobbank_directory_url){ 
				$listing_hide=get_option('jobbank_listing_hide_opt');	
				if($listing_hide==""){$listing_hide='package';}			
				if($listing_hide=='package'){
					$exp_date= get_user_meta($owner_id, 'jobbank_exprie_date', true);
					if($exp_date!=''){
						$package_id=get_user_meta($owner_id,'jobbank_package_id',true);
						$dir_hide= get_post_meta($package_id, 'jobbank_package_hide_exp', true);
						if($dir_hide=='yes'){
							if(strtotime($exp_date) < time()){
								$dir_post = array();
								$dir_post['ID'] = $listin_id;
								$dir_post['post_status'] = 'draft';	
								$dir_post['post_type'] = $jobbank_directory_url;	
								wp_update_post( $dir_post );
							}
						}
						$have_package_feature= get_post_meta($package_id,'jobbank_package_feature',true);										
						if($have_package_feature=='yes'){
							if(strtotime($exp_date) < time()){
								update_post_meta($listin_id, 'jobbank_featured', 'no' );
							}	
						}
					}
				}
				if($listing_hide=='deadline'){
					$deadline= get_post_meta($listin_id, 'deadline', true);		
					$current_time= strtotime(date("Y-m-d"));							
					if(strtotime($deadline) < $current_time){ 
						$dir_post = array();
						$dir_post['ID'] = $listin_id;
						$dir_post['post_status'] = 'draft';	
						$dir_post['post_type'] = $jobbank_directory_url;	
						wp_update_post( $dir_post );
						$have_package_feature= get_post_meta($package_id,'jobbank_package_feature',true);
						if($have_package_feature=='yes'){
							if(strtotime($exp_date) < time()){
								update_post_meta($listin_id, 'jobbank_featured', 'no' );
							}	
						}						
					}
				}
			}
			public function paging() {
				global $wp_query;
			} 
		}
	}
	if(!class_exists('WP_GeoQuery'))
	{
		/**
			* Extends WP_Query to do geographic searches
		*/
		class WP_GeoQuery extends WP_Query
		{
			private $_search_latitude = NULL;
			private $_search_longitude = NULL;
			private $_search_distance = NULL;
			private $_search_postcats = NULL;
			/**
				* Constructor - adds necessary filters to extend Query hooks
			*/
			public function __construct($args = array())
			{
				$jobbank_directory_url=get_option('ep_jobbank_url');
				if($jobbank_directory_url==""){$jobbank_directory_url='job';}
				// Extract Latitude
				if(!empty($args['lat']))
				{
					$this->_search_latitude = $args['lat'];
				}
				// Extract Longitude
				if(!empty($args['lng']))
				{
					$this->_search_longitude = $args['lng'];
				}
				if(!empty($args['distance']))
				{
					$this->_search_distance = (int)$args['distance'];
				}
				if(!empty($args[$jobbank_directory_url.'-category']))
				{
					$this->_search_postcats= $args[$jobbank_directory_url.'-category'];
				}
				if(!empty($args[$jobbank_directory_url.'-tag']))
				{
					$this->_search_posttags= $args[$jobbank_directory_url.'-tag'];
				}
				if(!empty($args[$jobbank_directory_url.'-locations']))
				{
					$this->_search_postlocations= $args[$jobbank_directory_url.'-locations'];
				}
				// unset lat/lng
				unset($args['lat'], $args['lng'],$args['distance']);
				add_filter('posts_fields', array($this, 'jobbank_posts_fields'), 10, 2);
				add_filter('posts_join', array($this, 'jobbank_posts_join'), 10, 2);
				add_filter('posts_where', array($this, 'jobbank_posts_where'), 10, 2);
				add_filter('posts_groupby', array($this, 'jobbank_posts_groupby'), 10, 2);
				add_filter('posts_orderby', array($this, 'jobbank_posts_orderby'), 10, 2);
				parent::query($args);
				remove_filter('posts_fields', array($this, 'jobbank_posts_fields'));
				remove_filter('posts_join', array($this, 'jobbank_posts_join'));
				remove_filter('posts_where', array($this, 'jobbank_posts_where'));
				remove_filter('posts_groupby', array($this, 'jobbank_posts_groupby'));
				remove_filter('posts_orderby', array($this, 'jobbank_posts_orderby'));
			} // END public function __construct($args = array())
			/**
				* Selects the distance from a haversine formula
			*/
			public function jobbank_posts_groupby($where) {
				global $wpdb;
				if($this->_search_longitude!=""){
					if($this->_search_postcats!=""){
						$where .= $wpdb->prepare(" HAVING distance < %d ", $this->_search_distance);
						}else{
						$where = $wpdb->prepare("{$wpdb->posts}.ID  HAVING distance < %d ", $this->_search_distance);
					}
					if($this->_search_posttags!=""){
						$where .= $wpdb->prepare(" HAVING distance < %d ", $this->_search_distance);
						}else{
						$where = $wpdb->prepare("{$wpdb->posts}.ID  HAVING distance < %d ", $this->_search_distance);
					}
					if($this->_search_postlocations!=""){
						$where .= $wpdb->prepare(" HAVING distance < %d ", $this->_search_distance);
						}else{
						$where = $wpdb->prepare("{$wpdb->posts}.ID  HAVING distance < %d ", $this->_search_distance);
					}
				}
				if($this->_search_postcats!=""){
				}
				return $where;
			}
			public function jobbank_posts_fields($fields)
			{
				global $wpdb;
				if(!empty($this->_search_latitude) && !empty($this->_search_longitude))
				{
					$dir_search_redius=get_option('epjbdir_map_radius');
					$for_option_redius='6387.7';
					if($dir_search_redius=="Mile"){$for_option_redius='3959';}else{$for_option_redius='6387.7'; }
					$fields .= sprintf(", ( ".$for_option_redius."* acos(
					cos( radians(%s) ) *
					cos( radians( latitude.meta_value ) ) *
					cos( radians( longitude.meta_value ) - radians(%s) ) +
					sin( radians(%s) ) *
					sin( radians( latitude.meta_value ) )
					) ) AS distance ", $this->_search_latitude, $this->_search_longitude, $this->_search_latitude);
					$fields .= ", latitude.meta_value AS latitude ";
					$fields .= ", longitude.meta_value AS longitude ";
				}
				return $fields;
			} // END public function posts_join($join, $query)
			/**
				* Makes joins as necessary in order to select lat/long metadata
			*/
			public function jobbank_posts_join($join, $query)
			{
				global $wpdb;
				if(!empty($this->_search_latitude) && !empty($this->_search_longitude)){
					$join .= " INNER JOIN {$wpdb->postmeta} AS latitude ON {$wpdb->posts}.ID = latitude.post_id ";
					$join .= " INNER JOIN {$wpdb->postmeta} AS longitude ON {$wpdb->posts}.ID = longitude.post_id ";
				}
				return $join;
			} // END public function posts_join($join, $query)
			/**
				* Adds where clauses to compliment joins
			*/
			public function jobbank_posts_where($where)
			{
				if(!empty($this->_search_latitude) && !empty($this->_search_longitude)){
					$where .= ' AND latitude.meta_key="latitude" ';
					$where .= ' AND longitude.meta_key="longitude" ';
				}
				return $where;
			} // END public function posts_where($where)
			/**
				* Adds where clauses to compliment joins
			*/
			public function jobbank_posts_orderby($orderby)
			{
				if(!empty($this->_search_latitude) && !empty($this->_search_distance))
				{
					$orderby = " distance ASC, " . $orderby;
				}
				return $orderby;
			} // END public function posts_orderby($orderby)
		}
	}
	/*
		* Creates a new instance of the BoilerPlate Class
	*/
	function jobbankBootstrap() {
		return eplugins_jobbank::instance();
	}
jobbankBootstrap(); ?>