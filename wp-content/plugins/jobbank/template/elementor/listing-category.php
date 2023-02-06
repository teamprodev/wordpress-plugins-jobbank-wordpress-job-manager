<?php
	
	namespace Elementor;
	class Jobbank_Category_Widget extends Widget_Base {
		public function get_name() {
			return 'jobbank_category';
		}
		public function get_title() {
			return esc_html__( 'Category', 'jobbank' );
		}
		public function get_icon() {
			return 'eicon-post-excerpt';
		}
		public function get_categories() {
			return [ 'jobbank_elements' ];
		}
		protected function register_controls() {
			$this->start_controls_section(
			'cat_post_settings',
			[
			'label' => esc_html__( 'Category Settings', 'jobbank' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
			]
			);
			$this->add_control(
			'post_count_filter',
			[
			'label'   => esc_html__( 'Number Of Category To Show', 'jobbank' ),
			'type'    => Controls_Manager::NUMBER,
			'min'     => - 1,
			'max'     => '',
			'step'    => 1,
			'default' => 6,
			]
			);
			$this->add_control(
			'category_filter',
			[
			'label'       => esc_html__( 'Categories', 'jobbank' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => ep_jobbank_post_categories_cat(),			
			]
			);

			$this->end_controls_section();
		
		
		}
		//Render
		protected function render() {
			$settings = $this->get_settings_for_display();		
			$atts='';
			if ( ! empty( $settings['category_filter'] ) ) {
				if(is_array($settings['category_filter'])){
					$atts=$atts.' category="'.implode(",",$settings['category_filter']).'"';
					}else{
					$atts=$atts.' category="'.$settings['category'].'"';
				}
			}
			if ( ! empty( $settings['post_count_filter'] ) ) {			
				$atts=$atts.' post_limit="'.$settings['post_count_filter'].'"';
			}
			
			$shortcode ="[jobbank_categories  ".$atts." ]";		
		?>
		<div class="elementor-shortcode"><?php echo do_shortcode( shortcode_unautop( $shortcode ) );  ?></div>
		<?php
		}
		
				
		
	}
Plugin::instance()->widgets_manager->register_widget_type( new Jobbank_Category_Widget );

//Post Category
	function ep_jobbank_post_categories_cat() {
		$options = array();
		$jobbank_directory_url=get_option('ep_jobbank_url');
		if($jobbank_directory_url==""){$jobbank_directory_url='job';}
		$taxonomy = $jobbank_directory_url.'-category';
		$args = array(
		'orderby'           => 'name',
		'order'             => 'ASC',
		'hide_empty'        => true,	
		);
		$terms = get_terms($taxonomy,$args);
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$options[ $term->slug ] = $term->name;
			}
		}
		return $options;
	}
	