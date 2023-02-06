<?php
	namespace Elementor;
	class Jobbank_Registration_Widget extends Widget_Base {
		public function get_name() {
			return 'jobbank_registration';
		}
		public function get_title() {
			return esc_html__( 'Registration', 'jobbank' );
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
			$shortcode ="[jobbank_form_wizard]";		
		?>
		<div class="elementor-shortcode"><?php echo do_shortcode( shortcode_unautop( $shortcode ) );  ?></div>
		<?php
		}
	} 
Plugin::instance()->widgets_manager->register_widget_type( new Jobbank_Registration_Widget );