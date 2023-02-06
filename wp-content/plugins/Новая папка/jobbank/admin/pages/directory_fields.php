<?php
	global $wpdb;
	global $current_user;
	$ii=1;
	$main_category='';
	if(isset($_POST['main_category'])){$main_category=sanitize_text_field($_POST['main_category']);}	
	wp_enqueue_style('dataTables-min', ep_jobbank_URLPATH . 'admin/files/css/jquery.dataTables.min.css');	
	wp_enqueue_style('rowReorder-dataTables', ep_jobbank_URLPATH . 'admin/files/css/rowReorder.dataTables.min.css');
	wp_enqueue_style('responsive-dataTables', ep_jobbank_URLPATH . 'admin/files/css/responsive.dataTables.min.css');
	wp_enqueue_script('dataTables', ep_jobbank_URLPATH . 'admin/files/js/jquery.dataTables.js');
	wp_enqueue_script('dataTablesrowReordermin', ep_jobbank_URLPATH . 'admin/files/js/dataTables.rowReorder.min.js');
	wp_enqueue_script('dataTablesresponsivemin', ep_jobbank_URLPATH . 'admin/files/js/dataTables.responsive.min.js');
	
	
	$jobbank_directory_url=get_option('ep_jobbank_url');					
	if($jobbank_directory_url==""){$jobbank_directory_url='job';}
?>

<div class="row">
			<div class="col-md-12 mb-4">
			
		<form id="dir_fields_max" name="dir_fields_max" class="form-horizontal" role="form" onsubmit="return false;">			
			
					
			
			<div class="card col-md-12">				
				<div class="card-body table-responsive ">
					
					<table id="listing_fieldsdatatable" name="listing_fieldsdatatable"  class="display table" width="100%">					
						<thead>
							<tr>
								<th > <?php  esc_html_e('Input Detail','jobbank')	;?> </th>								
								<th> <?php  esc_html_e('Categories','jobbank')	;?> </th>	
								<th ><?php  esc_html_e('Action','jobbank')	;?></th>
							</tr>
						</thead>
						<tbody>							
							<?php
								
								
								$default_fields = array();
								$field_set=			get_option('jobbank_li_fields' );
								$field_type=  		get_option( 'jobbank_li_field_type' );
								$field_type_value=  get_option( 'jobbank_li_fieldtype_value' );
								
								$field_type_cat=  	get_option( 'jobbank_field_type_cat' );
								
								if($field_set!=""){
									$default_fields=get_option('jobbank_li_fields' );
									}else{
									$default_fields['business_type']='Business Type';
									$default_fields['main_products']='Main Products';
									$default_fields['number_of_employees']='Number Of Employees';
									$default_fields['main_markets']='Main Markets';
									$default_fields['total_annual_sales_volume']='Total Annual Sales Volume';	
								}
								$i=0;								
								
								
								
								
								foreach ( $default_fields as $field_key => $field_value ) {
									
								
									
									
								?>
								<tr  id="wpdatatablelistingfield_<?php echo esc_attr($i);?>">
									<td >
										<div class="row mt-2">
											<label class="col-md-6 col-6"><?php  esc_html_e('Input Name','jobbank');?></label>
											<input type="text" class="form-control col-md-6 col-6" name="meta_name[]" id="meta_name[]" value="<?php echo esc_attr($field_key); ?>"> 	
										</div>
										<div class="row mt-2">
											<label class="col-md-6 col-6"><?php  esc_html_e('Label','jobbank')	;?></label>
											<input type="text" class="form-control col-md-6 col-6" name="meta_label[]" id="meta_label[]" value="<?php echo esc_attr($field_value);?>" >
										</div>
										<div class="row mt-2">
											<label class="col-md-6 col-6"><?php  esc_html_e('Type','jobbank');?></label>
												<?php $field_type_saved= (isset($field_type[$field_key])?$field_type[$field_key]:'' );?>
												<select class="form-control col-md-6 col-6" name="field_type[]" id="field_type[]">
													<option value="text" <?php echo ($field_type_saved=='text'? "selected":'');?> ><?php esc_html_e('Text','jobbank');?></option>
													<option value="textarea" <?php echo ($field_type_saved=='textarea'? "selected":'');?> ><?php esc_html_e('Text Area','jobbank');?></option>
													<option value="dropdown" <?php echo ($field_type_saved=='dropdown'? "selected":'');?> ><?php esc_html_e('Dropdown','jobbank');?></option>
													<option value="radio" <?php echo ($field_type_saved=='radio'? "selected":'');?> ><?php esc_html_e('Radio button','jobbank');?></option>
													<option value="datepicker" <?php echo ($field_type_saved=='datepicker'? "selected":'');?> ><?php esc_html_e('Date Picker','jobbank');?></option>
													<option value="checkbox" <?php echo ($field_type_saved=='checkbox'? "selected":'');?> ><?php esc_html_e('Checkbox','jobbank');?></option>
													<option value="url" <?php echo ($field_type_saved=='url'? "selected":'');?> ><?php esc_html_e('URL','jobbank');?></option>
												</select>
										</div>
										<div class="row mt-2">
											<label class="col-md-12 col-12"><?php  esc_html_e('Value[Dropdown,checkbox,Radio]','jobbank')	;?> </label>
											<textarea class="form-control col-md-12 col-12 ml-3" rows="3" name="field_type_value[]" id="field_type_value[]" placeholder="<?php  esc_html_e('Separated by comma','jobbank');?> "><?php echo esc_attr((isset($field_type_value[$field_key])?$field_type_value[$field_key]:''));?></textarea>
										</div>
									
									</td>
									
									
									
									<td id="categoriesmax_<?php echo esc_attr($i);?>"  >									
										<div class="row mt-2 p-3">
										<?php
										$field_type_cat_saved= (isset($field_type_cat[$field_key])?$field_type_cat[$field_key]:'' ) ;										
										if($field_type_cat_saved==''){$field_type_cat_saved=array('all');}
										
										$args =array();								
										
										
										$args2 = array(
										'type'                     => $jobbank_directory_url,									
										'orderby'                  => 'name',
										'order'                    => 'ASC',
										'hide_empty'               => 0,
										'hierarchical'             => 1,
										'exclude'                  => '',
										'include'                  => '',
										'number'                   => '',
										'taxonomy'                 => $jobbank_directory_url.'-category',
										'pad_counts'               => false
										);
										$main_tag = get_categories( $args2 );										
										if ( $main_tag && !is_wp_error( $main_tag ) ) :
										
										foreach ( $main_tag as $term_m ) {
											
											$checked= (in_array($term_m->slug,$field_type_cat_saved)? " checked":'');
											if($field_type_cat_saved=='all'){
												$checked=' checked';
											}
											if($term_m->name!=''){		
										?>
										
										<div class="col-md-4">
											<label class="listing-field-cat" > <input type="checkbox"  name="field_categories<?php echo esc_attr($i);?>[]"  id="field_categories<?php echo esc_attr($i);?>[]" <?php echo esc_attr($checked);?> value="<?php echo esc_attr($term_m->slug); ?>"> <?php echo esc_html($term_m->name); ?> </label>
										</div>
										<?php
											}
											
										}
										endif;
										
									
									?>
									</div>
																	
									
								
									</td>
							
									<td >									
									<span onclick="return jobbank_remove_listingfield('<?php echo esc_attr($i); ?>');" class="dashicons dashicons-trash"></span>
									</td>
								</tr>	
								<?php
									$i++;
								}
							?>
						</tbody>
						<tfoot>
							<tr>
								<th> <?php  esc_html_e('Input Detail','jobbank')	;?> </th>								
								<th> <?php  esc_html_e('Categories','jobbank');?> </th>	
								<th><?php  esc_html_e('Action','jobbank')	;?></th>
							</tr>
						</tfoot>
					</table>
					
					<div id="custom_field_div">
					</div>
					<div class="col-xs-12">
						<button class="btn btn-warning " onclick="return jobbank_add_listingfield();"><?php esc_html_e('Add More Field','jobbank');?></button>
					</div>
				</div>
			</div>
		
		
	 	
		
	<div class="card col-md-12">
		<div class="card-heading"><h4><?php 
		esc_html_e('Job status','jobbank'); ?> </h4></div>
		<div class="card-body">
			<div class="row ">
				
					<?php
						$jobbank_job_status_all=get_option('jobbank_job_status');					
						if($jobbank_job_status_all==""){$jobbank_job_status_all='Full Time, Part Time,Freelance, Hourly, Project Base';}
					?>
					<textarea class="form-control col-12"  id="jobbank_job_status_all" name="jobbank_job_status_all" rows="3"><?php echo esc_html($jobbank_job_status_all); ?></textarea>
				
			</div>
		</div>		 
	</div>
	<div class="card col-md-12">
		<div class="card-heading"><h4><?php 
		esc_html_e('Job Experience Range','jobbank'); ?> </h4></div>
		<div class="card-body">
			<div class="row ">
				
					<?php
						$jobbank_experience_range='';
						$jobbank_experience_range=get_option('jobbank_experience_range');					
						if($jobbank_experience_range==""){
							$jobbank_experience_range='Any,Below 1 Year,1 - 3 Years,3 - 5 Years,5 - 10 Years,Over 10 Years';
							}
					?>
					<textarea class="form-control col-12"  id="job_jobbank_experience_range" name="job_jobbank_experience_range" rows="3"><?php echo esc_html($jobbank_experience_range); ?></textarea>
				
			</div>
		</div>		 
	</div>
	
	
	<div class="card col-md-12">
		<div class="card-heading"><h4><?php 
		esc_html_e('Job level','jobbank'); ?> </h4></div>
		<div class="card-body">
			<div class="row ">
				
					<?php
						$jobbank_job_level_all=get_option('jobbank_job_level');					
						if($jobbank_job_level_all==""){$jobbank_job_level_all='Any,Entry Lavel,Mid Level,Top Level';}
					?>
					<textarea class="form-control col-12"  id="jobbank_job_level_all" name="jobbank_job_level_all" rows="3"><?php echo esc_html($jobbank_job_level_all); ?></textarea>
				
			</div>
		</div>		 
	</div>
	
	
	<div class="row">					
		<div class="col-md-12">	
			<hr>
				<div id="success_message-fields"></div>														
				<button class="button button-primary" onclick="return jobbank_update_dir_fields();"><?php esc_html_e( 'Update', 'jobbank' );?> </button>
			
			<p>&nbsp;</p>
		</div>
	</div>
</form>					
</div>
</div>	


<div id="fieldtype-main" class="none">
	<?php $field_type_saved= '' ;?>
					<select class="form-control" name="field_type[]" id="field_type[]">
						<option value="text" <?php echo ($field_type_saved=='text'? "selected":'');?> ><?php esc_html_e('Text','jobbank');?></option>
						<option value="textarea" <?php echo ($field_type_saved=='textarea'? "selected":'');?> ><?php esc_html_e('Text Area','jobbank');?></option>
						<option value="dropdown" <?php echo ($field_type_saved=='dropdown'? "selected":'');?> ><?php esc_html_e('Dropdown','jobbank');?></option>
						<option value="radio" <?php echo ($field_type_saved=='radio'? "selected":'');?> ><?php esc_html_e('Radio button','jobbank');?></option>
						<option value="datepicker" <?php echo ($field_type_saved=='datepicker'? "selected":'');?> ><?php esc_html_e('Date Picker','jobbank');?></option>
						<option value="checkbox" <?php echo ($field_type_saved=='checkbox'? "selected":'');?> ><?php esc_html_e('Checkbox','jobbank');?></option>
						<option value="url" <?php echo ($field_type_saved=='url'? "selected":'');?> ><?php esc_html_e('URL','jobbank');?></option>
					</select>
</div>
<div id="fieldcat-main" class="none">
		<div class="row p-3">
		<?php																		
			$field_type_cat_saved=array('all');										
			$args =array();											
			$args2 = array(
			'type'                     => $jobbank_directory_url,									
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'exclude'                  => '',
			'include'                  => '',
			'number'                   => '',
			'taxonomy'                 => $jobbank_directory_url.'-category',
			'pad_counts'               => false
			);
			$main_tag = get_categories( $args2 );										
			if ( $main_tag && !is_wp_error( $main_tag ) ) :
			
			foreach ( $main_tag as $term_m ) {											
					$checked=' checked';											
			?>										
			<div class="col-md-4">
				<label class="listing-field-cat" > <input type="checkbox"  name="field_categories<?php echo esc_attr($i);?>[]"  id="field_categories<?php echo esc_attr($i);?>[]" <?php echo esc_attr($checked);?> value="<?php echo esc_attr($term_m->slug); ?>"> <?php echo esc_html($term_m->name); ?> </label>
			</div>
			<?php
				
			}
			endif;										
		?>
		</div>
</div>
<?php
	wp_enqueue_script('eplugins_jobbank-dashboard5', ep_jobbank_URLPATH.'admin/files/js/profile-fields.js', array('jquery'), $ver = true, true );
	wp_localize_script('eplugins_jobbank-dashboard5', 'profile_data', array( 			'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
	'loading_image'		=> '<img src="'.ep_jobbank_URLPATH.'admin/files/images/loader.gif">',	
	'adminnonce'=> wp_create_nonce("admin"),
	'pii'	=>$ii,
	'pi'	=> $i,
	"sProcessing"=>  esc_html__('Processing','jobbank'),
	"InputName"=>  esc_html__('Input Name','jobbank'),
	"Label"=>  esc_html__('Label','jobbank'),
	"Type"=>  esc_html__('Type','jobbank'),
	"Value"=>  esc_html__('Value','jobbank'),	
	"sProcessing"=>  esc_html__('Processing','jobbank'),
	"sSearch"=>   esc_html__('Search','jobbank'),
	"lengthMenu"=>   esc_html__('Display _MENU_ records per page','jobbank'),
	"zeroRecords"=>  esc_html__('Nothing found - sorry','jobbank'),
	"info"=>  esc_html__('Showing page _PAGE_ of _PAGES_','jobbank'),
	"infoEmpty"=>   esc_html__('No records available','jobbank'),
	"infoFiltered"=>  esc_html__('(filtered from _MAX_ total records)','jobbank'),
	"sFirst"=> esc_html__('First','jobbank'),
	"sLast"=>  esc_html__('Last','jobbank'),
	"sNext"=>     esc_html__('Next','jobbank'),
	"sPrevious"=>  esc_html__('Previous','jobbank'),
	) );
	

	
	?>	