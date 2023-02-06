<?php
	namespace Elementor;
	use WP_Query;
	use WP_User_Query;
	class Jobbank_Filter_Widget extends Widget_Base {
		public function get_name() {
			return 'jobbank_filter';
		}
		public function get_title() {
			return esc_html__( 'Listings Filter', 'jobbank' );
		}
		public function get_icon() {
			return 'eicon-post-excerpt';
		}
		public function get_categories() {
			return [ 'jobbank_elements' ];
		}
		protected function register_controls() {
			$this->start_controls_section(
			'filter_post_settings',
			[
			'label' => esc_html__( 'Filter Settings', 'jobbank' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
			]
			);
			$this->add_control(
			'post_count_filter',
			[
			'label'   => esc_html__( 'Number Of Post To Show', 'jobbank' ),
			'type'    => Controls_Manager::NUMBER,
			'min'     => - 1,
			'max'     => '',
			'step'    => 1,
			'default' => 6,
			]
			);
			$this->add_control(
			'sort_filter',
			[
			'label'       => esc_html__( 'Sort', 'jobbank' ),
			'type'        => Controls_Manager::SELECT,
			'label_block' => true,			
			'default' => 'date-desc',
				'options' => [
					'date-desc'  => esc_html__( 'Newest Listing', 'jobbank' ),
					'date-asc' => esc_html__( 'Oldest Listing', 'jobbank' ),
					'asc' => esc_html__( 'A to Z (title)', 'jobbank' ),
					'desc' => esc_html__( 'Z to A (title)', 'jobbank' ),
					'rand' => esc_html__( 'Random', 'jobbank' ),					
				],	
			]
			);
			
			$this->add_control(
			'author_filter',
			[
			'label'       => esc_html__( 'Employer', 'jobbank' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => get_author_value_filter(),			
			]
			);
			$this->add_control(
			'job_type_filter',
			[
			'label'       => esc_html__( 'Job Type', 'jobbank' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => get_meta_value_by_key_filter('job_type'),			
			]
			);
			$this->add_control(
			'jobbank_job_level_filter',
			[
			'label'       => esc_html__( 'Job Level', 'jobbank' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => get_meta_value_by_key_filter('jobbank_job_level'),			
			]
			);
			$this->add_control(
			'jobbank_experience_range_filter',
			[
			'label'       => esc_html__( 'Experience Range', 'jobbank' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => get_meta_value_by_key_filter('jobbank_experience_range'),			
			]
			);
			$this->add_control(
			'gender_filter',
			[
			'label'       => esc_html__( 'Gender', 'jobbank' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => get_meta_value_by_key_filter('gender'),			
			]
			);
			$this->add_control(
			'category_filter',
			[
			'label'       => esc_html__( 'Categories', 'jobbank' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => ep_jobbank_post_categories_filter(),			
			]
			);
			$this->add_control(
			'locations_filter',
			[
			'label'       => esc_html__( 'Locations', 'jobbank' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => ep_jobbank_post_locations_filter(),			
			]
			);
			$this->add_control(
			'tag_filter',
			[
			'label'       => esc_html__( 'Tags', 'jobbank' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => ep_jobbank_post_tag_filter(),			
			]
			);
			$this->end_controls_section();
		}
		//Render
		protected function render() {
			$settings = $this->get_settings_for_display();			
			$atts='';
			if ( ! empty( $settings['post_count_filter'] ) ) {			
				$atts=$atts.' post_limit="'.$settings['post_count_filter'].'"';
			}
			if ( ! empty( $settings['author_filter'] ) ) {								
					$atts=$atts.' author__in="'.$settings['author_filter'].'"';				
			}
			if ( ! empty( $settings['sort_filter'] ) ) {						
					$atts=$atts.' sort="'.$settings['sort_filter'].'"';
				
			}
					
			if ( ! empty( $settings['job_type_filter'] ) ) {	
				if(is_array($settings['job_type_filter'])){
					$atts=$atts.' job_type="'.implode(",",$settings['job_type_filter']).'"';					
					}else{
					$atts=$atts.' job_type="'.$settings['job_type_filter'].'"';
				}
			}
			if ( ! empty( $settings['jobbank_job_level_filter'] ) ) {	
				if(is_array($settings['jobbank_job_level_filter'])){
					$atts=$atts.' jobbank_job_level="'.implode(",",$settings['jobbank_job_level_filter']).'"';					
					}else{
					$atts=$atts.' jobbank_job_level="'.$settings['jobbank_job_level_filter'].'"';
				}
			}
			
			if ( ! empty( $settings['jobbank_experience_range_filter'] ) ) {	
				if(is_array($settings['jobbank_experience_range_filter'])){
					$atts=$atts.' jobbank_experience_range="'.implode(",",$settings['jobbank_experience_range_filter']).'"';					
					}else{
					$atts=$atts.' jobbank_experience_range="'.$settings['jobbank_experience_range_filter'].'"';
				}
			}
			
			if ( ! empty( $settings['gender_filter'] ) ) {	
				if(is_array($settings['gender_filter'])){
					$atts=$atts.' gender="'.implode(",",$settings['gender_filter']).'"';					
					}else{
					$atts=$atts.' gender="'.$settings['gender_filter'].'"';
				}
			}
				
			if ( ! empty( $settings['category_filter'] ) ) {
				if(is_array($settings['category_filter'])){
					$atts=$atts.' category="'.implode(",",$settings['category_filter']).'"';
					}else{
					$atts=$atts.' category="'.$settings['category'].'"';
				}
			}
			if ( ! empty( $settings['locations_filter'] ) ) {
				if(is_array($settings['locations_filter'])){
					$atts=$atts.' locations="'.implode(",",$settings['locations_filter']).'"';
					}else{
					$atts=$atts.' locations="'.$settings['locations_filter'].'"';
				}
			}
			if ( ! empty( $settings['tag_filter'] ) ) {
				if(is_array($settings['tag_filter'])){
					$atts=$atts.' tag="'.implode(",",$settings['tag_filter']).'"';
					}else{
					$atts=$atts.' tag="'.$settings['tag_filter'].'"';
				}
			}
			
			
			$shortcode ="[listing_filter ".$atts." ]";
		?>
		<div class="elementor-shortcode"><?php echo do_shortcode( shortcode_unautop( $shortcode ) );  ?></div>
		<?php
		}
	}
	Plugin::instance()->widgets_manager->register_widget_type( new Jobbank_Filter_Widget );
	function get_meta_value_by_key_filter($meta_key){	
		$jobbank_directory_url=get_option('ep_jobbank_url');
		if($jobbank_directory_url==""){$jobbank_directory_url='job';}
		$args_metadata = array(
		'post_type'  => $jobbank_directory_url,
		'posts_per_page' => -1,
		'meta_query' => array(
		array(
		'key'     => $meta_key,
		'orderby' => 'meta_value',
		'order' => 'ASC',
		),
		),
		);
		$args_metadata_arr = new WP_Query( $args_metadata );
		$args_metadata_arr_all = $args_metadata_arr->posts;
		$get_val_arr =array();
		foreach ( $args_metadata_arr_all as $term ) {
			$new_fields_val="";
			$new_fields_val=get_post_meta($term->ID,$meta_key,true);
			if(is_array($new_fields_val)){
				foreach ( $new_fields_val as $new_fields_val_one ) {				
					if (!in_array($new_fields_val_one,$get_val_arr )) {	
						$get_val_arr[$new_fields_val_one]=$new_fields_val_one;  						
					}
				}
				}else{
				if (!in_array($new_fields_val, $get_val_arr)) {	
					$get_val_arr[$new_fields_val]=$new_fields_val;					
				}
			}
		}		
		return $get_val_arr;
	}
	function get_author_value_filter(){
		$options = array();
		$args = array();
		$args['number']='99999';		
		$args['orderby']='display_name';
		$args['order']='ASC'; 
		$user_type = array(
		'relation' => 'AND',
		array(
		'key'     => 'user_type',
		'value'   => 'employer',
		'compare' => '='
		),
		);
		$args['meta_query'] = array(
		$user_type
		);		
		$user_query = new WP_User_Query( $args );
		if ( ! empty( $user_query->results ) ) {
			foreach ( $user_query->results as $user ) {
				$name=(get_user_meta($user->ID,'full_name',true)!=''? get_user_meta($user->ID,'full_name',true) : $user->display_name );
				$options[$user->ID]= $name;
			}
		}	
		return $options;
	}
	//Post Category
	function ep_jobbank_post_categories_filter() {
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
	//Post tag
	function ep_jobbank_post_tag_filter() {
		$options = array();
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
	function ep_jobbank_post_locations_filter() {
		$options = array();
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