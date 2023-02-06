<?php
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}
	class Jobbank_Elementor_Custom_Widget {
		private static $instance = null;
		public static function get_instance() {
			if ( ! self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
		public function jobbank_add_elementor_custom_widgets() {
			require_once( 'listing-post-all.php' );
			require_once( 'listing-post-all-top-map.php' );
			require_once( 'listing-post-all-no-map.php' );
			require_once( 'listing-filter.php' );
			require_once( 'listing-featured.php' );
			require_once( 'listing-map.php' );			
			require_once( 'listing-search.php' );
			require_once( 'listing-category.php' );
			require_once( 'listing-location.php' );
			require_once( 'listing-login.php' );
			require_once( 'listing-add-new.php' );			
			require_once( 'listing-my-account.php' );
			require_once( 'listing-employer-directory.php' );
			require_once( 'listing-candidate-directory.php' );
			require_once( 'listing-pricing-table.php' );
			require_once( 'listing-registration.php' );
			
			
		}
		public function init() {
			add_action( 'elementor/widgets/widgets_registered', array( $this, 'jobbank_add_elementor_custom_widgets' ) );
		}
	}
	Jobbank_Elementor_Custom_Widget::get_instance()->init();
	// Add New Category In Elementor Widget
	function jobbank_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
		'jobbank_elements',
		[
		'title' => esc_html__( 'Jobbank Elements', 'jobbank' ),
		]
		);
	}
add_action( 'elementor/elements/categories_registered', 'jobbank_elementor_widget_categories' );