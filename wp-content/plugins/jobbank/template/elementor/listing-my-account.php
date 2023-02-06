<?php
	namespace Elementor;
	class Jobbank_Myaccount_Widget extends Widget_Base {
		public function get_name() {
			return 'jobbank_myaccount';
		}
		public function get_title() {
			return esc_html__( 'My Account', 'jobbank' );
		}
		public function get_icon() {
			return 'eicon-post-excerpt';
		}
		public function get_categories() {
			return [ 'jobbank_elements' ];
		}
		protected function register_controls() {
		}
		//Render
		protected function render() {
			$shortcode ="[jobbank_profile_template]";		
		?>
		<div class="elementor-shortcode"><?php echo do_shortcode( shortcode_unautop( $shortcode ) );  ?></div>
		<?php
		}
	}
Plugin::instance()->widgets_manager->register_widget_type( new Jobbank_Myaccount_Widget );