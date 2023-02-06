<?php
	global $post;
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui');
	wp_enqueue_style('fontawesome', ep_jobbank_URLPATH . 'admin/files/css/all.min.css');
	wp_enqueue_style('bootstrap', ep_jobbank_URLPATH . 'admin/files/css/iv-bootstrap.css');
	wp_enqueue_script('bootstrap', ep_jobbank_URLPATH . 'admin/files/js/bootstrap.min-4.js'); 	
	wp_enqueue_style('jobbank_directory', ep_jobbank_URLPATH . 'admin/files/css/directory.css');
	
	$main_class = new eplugins_jobbank;
	$jobbank_directory_url=get_option('ep_jobbank_url');
	if($jobbank_directory_url==""){$jobbank_directory_url='job';}
	if(isset($atts['per_page'])){
	$users_per_page=$atts['per_page'];
		}else{
		$users_per_page=15;
	}
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	if($paged==1){
		$offset=0;  
		}else {
		$offset= ($paged-1)*$users_per_page;
	}
	$args = array();
	$args['number']=$users_per_page;
	$args['offset']= $offset; 
	$args['orderby']='display_name';
	$args['order']='ASC'; 
	
	$location_city_arr= array();							
	$location_input_array= array();
	
	if(isset($_REQUEST['location_input'])){
		$location_input_array = array_map( 'sanitize_text_field', $_REQUEST['location_input'] );
		foreach($location_input_array as $one_value){										
				$city_counrty= explode(',',$one_value);
				$location_city_arr[]=$city_counrty[0];
		}
		
	}
								
	$user_name_search='';
	if( isset($_REQUEST['user_name_search'])){								
		if($_REQUEST['user_name_search']!=""){
				$user_name_search = array(
				'relation' => 'AND',
					array(
						'key'     => 'full_name',
						'value'   => sanitize_text_field($_REQUEST['user_name_search']),
						'compare' => 'LIKE'
					),
				);
		}
	}
	$categories_search='';
	if( isset($_REQUEST['category_input'])){								
		if($_REQUEST['category_input']!=""){									
			$categories_arr = array_map( 'sanitize_text_field', $_REQUEST['category_input'] );
				$categories_search = array(
				'relation' => 'AND',
					array(
						'key'     => 'company_type',
						'value'   => $categories_arr,
						'compare' => 'IN'
					),
				);
		}
	}							
	$city_search='';
	if( isset($_REQUEST['location_input'])){								
		if($_REQUEST['location_input']!=""){
				$city_search = array(
				'relation' => 'AND',
					array(
						'key'     => 'city',
						'value'   => $location_city_arr,
						'compare' => 'IN'
					),
				);
		}
	}
	$user_type = array(
	'relation' => 'AND',
		array(
			'key'     => 'user_type',
			'value'   => 'employer',
			'compare' => '='
		),
	);
	
	
	$args['meta_query'] = array(
		$user_name_search,$city_search, $categories_search,$user_type,
	);
	
?>

<div class="bootstrap-wrapper">
	<div class="container-fluid " >
		<div class="row " >
			<div class="col-md-4 col-lg-4 col-xl-4 col-sm-12  " >						
				<?php
					include( ep_jobbank_template. 'user-directory/employer-search.php');
				?>
			</div>
			<div class="col-md-8 col-lg-8 col-xl-8 col-sm-12  " id="user_directory" >	
				<div class="row" >
					<?php	
						$user_query = new WP_User_Query( $args );
						$total_users = $user_query->get_total();	
						$i=0;
						// User Loop
						if ( ! empty( $user_query->results ) ) {
							foreach ( $user_query->results as $user ) {
							
								$profile_page=get_option('epjbjobbank_employer_public_page');
								$page_link= get_permalink( $profile_page).'?&id='.$user->ID; 
								
								
								include( ep_jobbank_template. 'user-directory/employer-grid-block.php');
								$i++;
							}
						}	
							?>
				</div>
				<div class="col-12">
					<?php
									
						$params =array();
						$pages = paginate_links( array_merge( [
						'base'         => str_replace( $post->ID, '%#%', esc_url( get_pagenum_link( $post->ID ) ) ),
						'format'       => '?paged=%#%',
						'current'      => max( 1, get_query_var( 'paged' ) ),
						'total'        => round((int)$total_users/$users_per_page),
						'type'         => 'array',
						'show_all'     => false,
						'end_size'     => 3,
						'mid_size'     => 1,
						'prev_next'    => true,
						'prev_text'    => esc_html__( '« Prev','jobbank' ),
						'next_text'    => esc_html__( 'Next »','jobbank' ),
						'add_args'     => $args,
						'add_fragment' => ''
						], $params )
						);			 				
						if ( is_array( $pages ) ) {			
							$pagination = '<div class=" mt-3 pagination justify-content-center"><ul class="pagination">';												
							foreach ( $pages as $page ) {
								$pagination .= '<li class="page-item' . (strpos($page, 'current') !== false ? ' active' : '') . '"> ' . str_replace('page-numbers', 'page-link', $page) . '</li>';
							}
							$pagination .= '</ul></div>';
							echo wp_specialchars_decode($pagination);
						}
					?>
				</div>
			</div>			
		</div>		
	</div>				
</div>
<?php
	wp_enqueue_script('jobbank_user-directory', ep_jobbank_URLPATH . 'admin/files/js/user-directory.js');
	
wp_reset_query();
?>

