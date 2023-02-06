<?php
	wp_enqueue_script("jquery");	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_style('jquery-ui', ep_jobbank_URLPATH . 'admin/files/css/jquery-ui.css');
	wp_enqueue_style('bootstrap', ep_jobbank_URLPATH . 'admin/files/css/iv-bootstrap.css');	;	
	wp_enqueue_style('multiselect-css', ep_jobbank_URLPATH . 'admin/files/css/jquery.multiselect.css');
	wp_enqueue_style('jobbank_search-form', ep_jobbank_URLPATH . 'admin/files/css/search-form.css');
	wp_enqueue_style('fontawesome', 			ep_jobbank_URLPATH . 'admin/files/css/fontawesome.css');
	wp_enqueue_script('popper', ep_jobbank_URLPATH . 'admin/files/js/popper.min.js');
	wp_enqueue_script('bootstrap-slider', ep_jobbank_URLPATH . 'admin/files/js/bootstrap-slider.min.js');
	wp_enqueue_style('bootstrap-slider.min', 			ep_jobbank_URLPATH . 'admin/files/css/bootstrap-slider.min.css');
	wp_enqueue_script('bootstrap', ep_jobbank_URLPATH . 'admin/files/js/bootstrap.min-4.js');
	wp_enqueue_script('multiselect-js', ep_jobbank_URLPATH . 'admin/files/js/jquery.multiselect.js');
	// Map openstreet
		
	global $post,$wpdb,$wp,$jobbank_filter_badge;
	$jobbank_directory_url=get_option('ep_jobbank_url');
	if($jobbank_directory_url==""){$jobbank_directory_url='job';}
	$active_search_fields_saved=get_option('jobbank_search_fields_saved' );	
	if($active_search_fields_saved==''){		
		$active_search_fields =jobbank_get_search_fields_default();				
		}else{
		$active_search_fields=array();
		$active_search_fields=$active_search_fields_saved;
	}	
	//atts atts
	if(isset($atts['field-name'])){	
		$field_name= $atts['field-name'];
		$field_type= $atts['field-type'];
		$field_name_arr= explode(",",$field_name);
		$field_type_arr= explode(",",$field_type);
		$i=0;
		$active_search_fields=array();
		foreach($field_name_arr as $one_field){		
			if(isset($field_type_arr[$i])){
				$active_search_fields[$one_field]=$field_type_arr[$i];
			}
			$i++;
		}		
	}
	$form_action=get_post_type_archive_link( $jobbank_directory_url );
	if(isset($atts['action'])){		
		if($atts['action']=='same_page'){
				
				$current_url =  home_url( $wp->request ); 
				$pos = strpos($current_url , '/page');
				
				$finalurl = substr($current_url,0,$pos);			
				$form_action=$finalurl;
			}elseif($atts['action']=='default_archive'){
				$form_action=get_post_type_archive_link( $jobbank_directory_url );
			}elseif($atts['action']=='default_archive'){
				$form_action=get_post_type_archive_link( $jobbank_directory_url );
			}else{
				$form_action=get_permalink( $atts['action']);		
		}
	}
?>

	<div class="bootstrap-wrapper background-transparent" >
		<div class="p-3  background-transparent-slider " >
			<div class="row my-0 py-0 ">
				<div class="col-md-12 my-0 py-0  form-search">
					<form class="mt-4 mb-2 py-0 m-0 " id="jobbank_search_form" name="jobbank_search_form" action="<?php echo esc_url($form_action) ; ?>" >						
						<div class="form-row  d-flex justify-content-end" >
							<input type="hidden" name="latitude" id="latitude" value="<?php echo (isset($_REQUEST['latitude'])? $_REQUEST['latitude']:'' ); ?>">
							<input type="hidden" name="longitude" id="longitude" value="<?php echo (isset($_REQUEST['longitude'])? $_REQUEST['longitude']:'' ); ?>">
							<input type="hidden" name="address_latitude" id="address_latitude" value="<?php echo (isset($_REQUEST['address_latitude'])? $_REQUEST['address_latitude']:'' ); ?>">
							<input type="hidden" name="address_longitude" id="address_longitude" value="<?php echo (isset($_REQUEST['address_longitude'])? $_REQUEST['address_longitude']:'' ); ?>">
							<?php
								if(is_array($active_search_fields)){
									foreach($active_search_fields  as $field_key => $field_value){
										if($field_key!=''){
											$submit_value=(isset($_REQUEST['sf'.$field_key])?$_REQUEST['sf'.$field_key]:'' );
											if($field_value=='text-field'){
												if($field_key=='address'){ ?>
												<div class="form-group col-md-3 my-0 pb-3 py-0 " id="searchaddressauto">
													<div id="search-box" ></div>
													<div id="map_address"></div>	
												</div>	
												<?php
													}elseif($field_key=='near_to_me'){ 
												?>											
												<div class="form-group col-md-3 my-0 pb-3 py-0 " >
													<div class="input-group  mt-3  ">	
														<label class="customcheck mr-2">
															<input type="checkbox" value="on"  name="neartome" id="neartome" onclick="jobbank_getLocation()"  <?php echo (isset($_REQUEST['neartome']) ? ' checked':' '); ?> >
															<span class="checkmark"></span>
															<?php  esc_html_e('Near','jobbank'); ?>
														</label>		
														<input id="near_km" name="near_km" class=" col-md-6  "  data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="1000" data-slider-step="1" data-slider-value="14"  />	
													</div> 
												</div>													
												<?php
													}else{
												?>
												<div class="form-group col-md-3 my-0 pb-3 py-0 " >
													<input type="text" class="form-control " name="sf<?php echo esc_attr($field_key); ?>" id="<?php echo esc_attr($field_key); ?>id" placeholder="<?php echo esc_attr(ucfirst(str_replace('_',' ',$field_key))); ?>" value="<?php echo esc_attr($submit_value); ?>">
												</div>	
												<?php
												}
											}										
											if($field_value=='datefield'){ ?>
											<div class="form-group col-md-3 my-0 pb-3 py-0 " >
												<input type="text" class="form-control  searchdate"  name="sf<?php echo esc_attr($field_key); ?>" id="<?php echo esc_attr($field_key); ?>id" placeholder="<?php echo esc_attr(ucfirst(str_replace('_',' ',$field_key))); ?>" value="<?php echo esc_attr($submit_value); ?>">
											</div>										
											<?php
											}
											if($field_value=='drop-down'){ 
												$cat_tag_location=  str_replace('-','',$field_key); 
												$cat_tag_location=  str_replace($jobbank_directory_url,'',$cat_tag_location);  
												if($cat_tag_location=='category' OR $cat_tag_location=='tag' OR $cat_tag_location=='locations'){
												?>
												<div class="form-group col-md-3 my-0 py-0 pb-3 " >
													<select name="sf<?php echo esc_attr($field_key); ?>" class="form-control " >
														<option value=""><?php  esc_attr_e('Select ','jobbank');?> <?php echo esc_attr(str_replace('_',' ',$cat_tag_location)); ?></option>
														<?php
															$taxonomy = $field_key;
															$args = array(
															'orderby'           => 'name',
															'order'             => 'ASC',
															'hide_empty'        => true,
															'exclude'           => array(),
															'exclude_tree'      => array(),
															'include'           => array(),
															'number'            => '',
															'fields'            => 'all',
															'slug'              => '',
															'parent'            => '0',
															'hierarchical'      => true,
															'child_of'          => 0,
															'childless'         => false,
															'get'               => '',
															);
															$terms = get_terms($taxonomy,$args); // Get all terms of a taxonomy
															if ( $terms && !is_wp_error( $terms ) ) :
															$i=0;
															foreach ( $terms as $term_parent ) {
																$selected= ($term_parent->slug==$submit_value ?' selected':'' );
																echo '<option '.$selected.' value="'.esc_attr($term_parent->slug).'" >'.$term_parent->name.'</option>';
															?>
															<?php
																$args2 = array(
																'type'                     => $jobbank_directory_url,
																'parent'                   => $term_parent->term_id,
																'orderby'                  => 'name',
																'order'                    => 'ASC',
																'hide_empty'               => 1,
																'hierarchical'             => 1,
																'exclude'                  => '',
																'include'                  => '',
																'number'                   => '',
																'taxonomy'                 => $field_key,
																'pad_counts'               => false
																);
																$categories = get_categories( $args2 );
																if ( $categories && !is_wp_error( $categories ) ) :
																foreach ( $categories as $term ) {
																	$selected= ($term->slug==$submit_value ?' selected':'' );
																	echo '<option  '.$selected.' value="'.esc_attr($term->slug).'">-'.esc_attr($term->name).'</option>';
																}
																endif;
																$i++;
															}
															endif;
														?>
													</select>
												</div>
										
												<?php
												}elseif($field_key=='sort_listing'){
												
														?>
													<div class="form-group col-md-3" id="sort_listing_div">													
													<select name="sf<?php echo esc_attr($field_key); ?>" id="sf<?php echo esc_attr($field_key); ?>" class="form-control form-control-sm 	40" >
														<option value=""><?php  esc_attr_e('Sort','jobbank');?></option>
														
														<option  <?php echo esc_html($submit_value=='asc'?' selected':' '); ?> value="asc" ><?php  esc_attr_e('A to Z (title)','jobbank');?></option>
														<option <?php echo esc_html($submit_value=='desc'?' selected':' '); ?> value="desc" ><?php  esc_attr_e('Z to A (title)','jobbank');?></option>
														<option  <?php echo esc_html($submit_value=='date-desc'?' selected':' '); ?> value="date-desc" ><?php  esc_attr_e('Latest listings','jobbank');?></option>
														<option  <?php echo esc_html($submit_value=='date-asc'?' selected':' '); ?> value="date-asc" ><?php  esc_attr_e('Oldest listings','jobbank');?></option>
														<option  <?php echo esc_html($submit_value=='rand'?' selected':' '); ?> value="rand" ><?php  esc_attr_e('Random listings','jobbank');?></option>
													</select>
													</div>
												<?php
												}elseif($field_key=='title'){?>
												<div class="form-group col-md-3 my-0 py-0 pb-3 ">
													<?php
														
														$args_metadata = array(
														'post_type'  => $jobbank_directory_url,
														'posts_per_page' => -1,														
														);
													?>
													<select name="sf<?php echo esc_attr($field_key); ?>" class="form-control " >
														<option value=""><?php  esc_attr_e('Select Title','jobbank');?></option>	
														<?php
															$args_metadata_arr = new WP_Query( $args_metadata );
															while ( $args_metadata_arr->have_posts() ) : $args_metadata_arr->the_post();
															$selected= (get_the_title()==$submit_value ?' selected':'' );
														?>
														<option  <?php echo esc_html($selected); ?> value="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></option>
														<?php
															endwhile;
														?>														
													</select>
												</div>
												<?php
												}else{?>
												<div class="form-group col-md-3 my-0 py-0 pb-3 ">
													<?php
														$args_metadata = array(
														'post_type'  => $jobbank_directory_url,
														'posts_per_page' => -1,
														'meta_query' => array(
														array(
														'key'     => $field_key,
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
															$new_fields_val=get_post_meta($term->ID,$field_key,true);
															if(is_array($new_fields_val)){
																foreach ( $new_fields_val as $new_fields_val_one ) {				
																	if (!in_array($new_fields_val_one,$get_val_arr )) {	
																		$get_val_arr[]=$new_fields_val_one;  
																	}
																}
																}else{
																if (!in_array($new_fields_val, $get_val_arr)) {	
																	$get_val_arr[]=$new_fields_val;
																}
															}
														}
													?>
													<select name="sf<?php echo esc_attr($field_key); ?>" class="form-control " >
														<option value=""><?php  esc_attr_e('Select ','jobbank');?> <?php echo esc_attr(str_replace('_',' ',$cat_tag_location)); ?></option>
														<?php
															if(count($get_val_arr)) {
																asort($get_val_arr);
																foreach($get_val_arr as $row1) { 
																	if($row1!=''){
																		$selected= ($row1==$submit_value ?' selected':'' );
																	?>
																	<option  <?php echo esc_html($selected); ?> value="<?php echo esc_attr($row1); ?>"><?php echo esc_html($row1); ?></option>
																	<?php
																	}
																}
															}
														?>
													</select>
												</div>
												<?php
												}
											?>
											<?php
											}	
											if($field_value=='multi-checkbox'){ 
												$cat_tag_location=  str_replace('-','',$field_key); 
												$cat_tag_location=  str_replace($jobbank_directory_url,'',$cat_tag_location);  
												if($cat_tag_location=='category' OR $cat_tag_location=='tag' OR $cat_tag_location=='locations'){ ?>
												<div class="form-group col-md-3 my-0 py-0 pb-3 " >
													<select name="sf<?php echo esc_attr($field_key); ?>[]" id="<?php echo esc_attr($field_key); ?>id" class="form-control" multiple="multiple" >															
														<?php
															if(!is_array($submit_value)){$submit_value2=array($submit_value);}else{$submit_value2=$submit_value;}
															$taxonomy = $field_key;
															$args = array(
															'orderby'           => 'name',
															'order'             => 'ASC',
															'hide_empty'        => true,
															'exclude'           => array(),
															'exclude_tree'      => array(),
															'include'           => array(),
															'number'            => '',
															'fields'            => 'all',
															'slug'              => '',
															'parent'            => '0',
															'hierarchical'      => true,
															'child_of'          => 0,
															'childless'         => false,
															'get'               => '',
															);
															$terms = get_terms($taxonomy,$args); // Get all terms of a taxonomy
															if ( $terms && !is_wp_error( $terms ) ) :
															$i=0;
															foreach ( $terms as $term_parent ) {
																$selected= (in_array($term_parent->slug,$submit_value2) ?' selected':'' );
																echo '<option '.$selected.' value="'.esc_attr($term_parent->slug).'" >'.$term_parent->name.'</option>';
															?>
															<?php
																$args2 = array(
																'type'                     => $jobbank_directory_url,
																'parent'                   => $term_parent->term_id,
																'orderby'                  => 'name',
																'order'                    => 'ASC',
																'hide_empty'               => 1,
																'hierarchical'             => 1,
																'exclude'                  => '',
																'include'                  => '',
																'number'                   => '',
																'taxonomy'                 => $field_key,
																'pad_counts'               => false
																);
																$categories = get_categories( $args2 );
																if ( $categories && !is_wp_error( $categories ) ) :
																foreach ( $categories as $term ) {
																	$selected= (in_array($term->slug,$submit_value2) ?' selected':'' );
																	echo '<option '.$selected.' value="'.esc_attr($term->slug).'">-'.esc_attr($term->name).'</option>';
																}
																endif;
																$i++;
															}
															endif;
														?>
													</select>
												</div>
												<?php
												}elseif($field_key=='title'){?>
												<div class="form-group col-md-3 my-0 py-0 pb-3 ">
													<?php
														
														$args_metadata = array(
														'post_type'  => $jobbank_directory_url,
														'posts_per_page' => -1,														
														);
													?>														
													<select  name="sf<?php echo esc_attr($field_key); ?>[]" id="<?php echo esc_attr($field_key); ?>id" class="form-control multiselect "  multiple="multiple"   >
														<option value=""><?php  esc_attr_e('Select Title','jobbank');?></option>	
														<?php
															if(!is_array($submit_value)){$submit_value2=array($submit_value);}else{$submit_value2=$submit_value;}
															$args_metadata_arr = new WP_Query( $args_metadata );
															while ( $args_metadata_arr->have_posts() ) : $args_metadata_arr->the_post(); 
															$selected= (in_array($args_metadata_arr->post->ID,$submit_value2) ?' selected':'' );
														?>
														<option   <?php echo esc_html($selected); ?> value="<?php echo esc_attr($args_metadata_arr->post->ID) ; ?>"><?php echo the_title(); ?></option>
														<?php
															endwhile;
														?>														
													</select>
												</div>
												<?php										
													}else{
													$args_metadata = array(
													'post_type'  => $jobbank_directory_url,
													'posts_per_page' => -1,
													'meta_query' => array(
													array(
													'key'     => $field_key,
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
														$new_fields_val=get_post_meta($term->ID,$field_key,true);
														if(is_array($new_fields_val)){
															foreach ( $new_fields_val as $new_fields_val_one ) {
																if (!in_array($new_fields_val_one,$get_val_arr)) {	
																	$get_val_arr[]=$new_fields_val_one;
																}
															}
															}else{
															if (!in_array($new_fields_val, $get_val_arr)) {	
																$get_val_arr[]=$new_fields_val;
															}
														}
													}
												?>
												<div class="form-group col-md-3 my-0 py-0 pb-3 ">
													<select  name="sf<?php echo esc_attr($field_key); ?>[]" id="<?php echo esc_attr($field_key); ?>id" class="form-control multiselect "  multiple="multiple"   >
														<?php
															if(!is_array($submit_value)){$submit_value2=array($submit_value);}else{$submit_value2=$submit_value;}
															if(count($get_val_arr)) {
																asort($get_val_arr);
																foreach($get_val_arr as $row1) {
																	if($row1!=''){
																		$selected= (in_array($row1,$submit_value2) ?' selected':'' );
																	?>
																	<option  <?php echo esc_html($selected); ?>  value="<?php echo esc_attr($row1); ?>"><?php echo esc_html($row1); ?></option>
																	<?php
																	}
																}
															}
														?>
													</select>
												</div>
												<?php
												}
											}
											if($field_value=='multi-checkbox-group'){ 											 
												 ?>
												<div class="form-group col-md-3 my-0 py-0 pb-3 " >
													<select name="sf<?php echo esc_attr($field_key); ?>[]" id="<?php echo esc_attr($field_key); ?>id" class="form-control " multiple="multiple" >															
														<?php
															if(!is_array($submit_value)){$submit_value2=array($submit_value);}else{$submit_value2=$submit_value;}
															$taxonomy = $field_key;
															$args = array(
															'orderby'           => 'name',
															'order'             => 'ASC',
															'hide_empty'        => true,
															'exclude'           => array(),
															'exclude_tree'      => array(),
															'include'           => array(),
															'number'            => '',
															'fields'            => 'all',
															'slug'              => '',
															'parent'            => '0',
															'hierarchical'      => true,
															'child_of'          => 0,
															'childless'         => false,
															'get'               => '',
															);
															$terms = get_terms($taxonomy,$args); // Get all terms of a taxonomy
															if ( $terms && !is_wp_error( $terms ) ) :
															$i=0;
															foreach ( $terms as $term_parent ) {
																$selected= (in_array($term_parent->slug,$submit_value2) ?' selected':'' );
															
																echo '<optgroup label="'.$term_parent->name.'">';
																echo '<option '.esc_attr($selected).' value="'.esc_attr($term_parent->slug).'">'.esc_attr($term_parent->name).'</option>';
															?>
															<?php
																$args2 = array(
																'type'                     => $jobbank_directory_url,
																'parent'                   => $term_parent->term_id,
																'orderby'                  => 'name',
																'order'                    => 'ASC',
																'hide_empty'               => 1,
																'hierarchical'             => 1,
																'exclude'                  => '',
																'include'                  => '',
																'number'                   => '',
																'taxonomy'                 => $field_key,
																'pad_counts'               => false
																);
																$categories = get_categories( $args2 );
																if ( $categories && !is_wp_error( $categories ) ) :
																foreach ( $categories as $term ) {
																	$selected= (in_array($term->slug,$submit_value2) ?' selected':'' );
																	echo '<option '.$selected.' value="'.esc_attr($term->slug).'">'.esc_attr($term->name).'</option>';
																}
																endif;
																$i++;
																echo'</optgroup>';
															}
															endif;
														?>
													</select>
												</div>
											<?php												
											
											}
										}
									}
								}
							?>
							
							<div class="form-group col-md-3 my-0 py-0 " >	
								<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
								 <div class="btn-group  col-md-12 " role="group" >
									<button type="submit" class="btn btn-big mb-2"><?php  esc_html_e('Search ','jobbank');?></button>
								
								  </div>
								</div>
															
							</div>
						</div>
					</form>
				
				</div>
			</div>
		</div>
	</div>


<?php
	$save_address='';	
	if(isset($_REQUEST['near_km'])){
		$jobbank_near_to_me = $_REQUEST['near_km'];
		}else{
		$jobbank_near_to_me =(get_option('jobbank_near_to_me')==''? '50': get_option('jobbank_near_to_me') );
	}
	$epjbdir_map_radius=get_option('epjbdir_map_radius');	
	if($epjbdir_map_radius==''){$epjbdir_map_radius=='Km';}
	
	wp_enqueue_script('jobbank_search', ep_jobbank_URLPATH.'admin/files/js/listing_search.js', array('jquery'), $ver = true, true );
	wp_localize_script('jobbank_search', 'search_data', array( 			
	'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
	'loading_image'		=> '<img src="'.ep_jobbank_URLPATH.'admin/files/images/loader.gif">',	
	'adminnonce'=> wp_create_nonce("admin"),
	'active_search_fields'	=>$active_search_fields,
	'select_text'=> esc_html__('Select ','jobbank'),
	'search'=> esc_html__('Search ','jobbank'),
	'selectAll'=> esc_html__('Select All ','jobbank'),
	'unselectAll'=> esc_html__('Unselect All ','jobbank'),
	'neartome'=> $jobbank_near_to_me,
	'epjbdir_map_radius'=> $epjbdir_map_radius,
	'current_url'=> home_url( add_query_arg( array(), $wp->request ) ),
	'current_location'	=>esc_html__('Your Current Location ','jobbank'),
	) );
	
?>
<?php
	wp_reset_query();
?>