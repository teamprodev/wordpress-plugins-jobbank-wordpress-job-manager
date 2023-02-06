<?php
	namespace Elementor;
	class Jobbank_Map_Widget extends Widget_Base {
		public function get_name() {
			return 'jobbank_map';
		}
		public function get_title() {
			return esc_html__( 'Listings Map Only', 'jobbank' );
		}
		public function get_icon() {
			return 'eicon-post-excerpt';
		}
		public function get_categories() {
			return [ 'jobbank_elements' ];
		}
		protected function register_controls() {
		
		$this->start_controls_section(
			'map_settings',
			[
				'label' => esc_html__( 'All Listing : Map Only', 'jobbank' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'search_option',
			[
			'label'       => esc_html__( 'Search Form Type', 'jobbank' ),
			'type'        => Controls_Manager::SELECT,
			'label_block' => true,			
			'default' => 'popup',
				'options' => [
					'popup'  => esc_html__( 'Popup/Modal Search', 'jobbank' ),
					'on-page' => esc_html__( 'Search Form on The Page', 'jobbank' ),
					'no-search' => esc_html__( 'No Search Form', 'jobbank' ),
				],	
			]
			);	
			
			$this->end_controls_section();
		}
		//Render
		protected function render() {
			$settings = $this->get_settings_for_display();	
			$atts='';	
			if ( !empty( $settings['search_option'] ) ) {			
					$atts=' search-form="'.$settings['search_option'].'"';
			}		
			$shortcode ="[jobbank_map ".$atts." ]";
		
		?>
		<div class="elementor-shortcode"><?php echo do_shortcode( shortcode_unautop( $shortcode ) ); ?></div>
		<?php
		}
	}
Plugin::instance()->widgets_manager->register_widget_type( new Jobbank_Map_Widget );