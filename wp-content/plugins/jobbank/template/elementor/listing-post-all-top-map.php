<?php
namespace Elementor;
class Jobbank_Posts_Topmap_Widget extends Widget_Base {

	public function get_name() {

		return 'jobbank_post_topmap';
	}

	public function get_title() {
		return esc_html__( 'All Listings Top Map', 'jobbank' );
	}

	public function get_icon() {

		return 'eicon-post-excerpt';
	}

	public function get_categories() {
		return [ 'jobbank_elements' ];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'recent_post_settings',
			[
				'label' => esc_html__( 'All Listing : Top Map', 'jobbank' ),
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

		$this->add_control(
			'category',
			[
				'label'       => esc_html__( 'Categories', 'jobbank' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => ep_jobbank_post_categories_topmap(),			
			]
		);
		$this->add_control(
			'locations',
			[
				'label'       => esc_html__( 'Locations', 'jobbank' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => ep_jobbank_post_locations_topmap(),			
			]
		);
		$this->add_control(
			'tag',
			[
				'label'       => esc_html__( 'Tags', 'jobbank' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => ep_jobbank_post_tag_topmap(),			
			]
		);
		

		$this->end_controls_section();

	}

	//Render
	protected function render() {
		$settings = $this->get_settings_for_display();		
		$atts='';
		if ( ! empty( $settings['category'] ) ) {
			if(is_array($settings['category'])){
				$atts=$atts.' category="'.implode(",",$settings['category']).'"';
			}else{
				$atts=$atts.' category="'.$settings['category'].'"';
			}
		}
		if ( ! empty( $settings['locations'] ) ) {
			if(is_array($settings['locations'])){
				$atts=$atts.' locations="'.implode(",",$settings['locations']).'"';
			}else{
				$atts=$atts.' locations="'.$settings['locations'].'"';
			}
		}
		if ( ! empty( $settings['tag'] ) ) {
			if(is_array($settings['tag'])){
				$atts=$atts.' tag="'.implode(",",$settings['tag']).'"';
			}else{
				$atts=$atts.' tag="'.$settings['tag'].'"';
			}
		}
		if ( ! empty( $settings['search_option'] ) ) {			
				$atts=$atts.' search-form="'.$settings['search_option'].'"';
		}
		
		$shortcode ="[jobbank_archive_grid_top_map ".$atts." ]";
				
		?>
		<div class="elementor-shortcode"><?php echo do_shortcode( shortcode_unautop( $shortcode ) );  ?></div>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Jobbank_Posts_Topmap_Widget );
//Post Category
function ep_jobbank_post_categories_topmap() {
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
//Post tag
function ep_jobbank_post_tag_topmap() {
	$jobbank_directory_url=get_option('ep_jobbank_url');
	if($jobbank_directory_url==""){$jobbank_directory_url='job';}
	$taxonomy = $jobbank_directory_url.'-tag';
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
//Post locations
function ep_jobbank_post_locations_topmap() {
	$jobbank_directory_url=get_option('ep_jobbank_url');
	if($jobbank_directory_url==""){$jobbank_directory_url='job';}
	$taxonomy = $jobbank_directory_url.'-locations';
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