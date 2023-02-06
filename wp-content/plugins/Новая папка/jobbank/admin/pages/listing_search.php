<?php
	$jobbank_directory_url=get_option('ep_jobbank_url');
	if($jobbank_directory_url==""){$jobbank_directory_url='job';}
	
	$active_search_fields_saved=get_option('jobbank_search_fields_saved' );	
	if($active_search_fields_saved==''){
		$active_search_fields=array();
		$active_search_fields[$jobbank_directory_url.'-category']='multi-checkbox';
		$active_search_fields[$jobbank_directory_url.'-tag']='multi-checkbox';
		$active_search_fields[$jobbank_directory_url.'-locations']='drop-down';
		$active_search_fields['near_to_me']='text-field';
		$active_search_fields['title']='text-field';
		$active_search_fields['deadline']='datefield';
		$active_search_fields['job_type']='drop-down';
		$active_search_fields['jobbank_job_level']='drop-down';
		$active_search_fields['gender']='drop-down';
		$active_search_fields['jobbank_experience_range']='drop-down';
		$active_search_fields['age_range']='drop-down';
		$active_search_fields['post_date']='datefield';
		$active_search_fields['salary']='drop-down';
		$active_search_fields['experience']='drop-down';
		$active_search_fields['educational_requirements']='drop-down';	
		
	}else{
		$active_search_fields=array();
		$active_search_fields=$active_search_fields_saved;
	}
	$available_fields=array();
	$available_fields[$jobbank_directory_url.'-category']='multi-checkbox';
	$available_fields[$jobbank_directory_url.'-tag']='multi-checkbox';
	$available_fields[$jobbank_directory_url.'-locations']='drop-down';
	$available_fields['near_to_me']='text-field';
	$available_fields['title']='text-field';
	$available_fields['deadline']='datefield';
	$available_fields['job_type']='drop-down';
	$available_fields['jobbank_job_level']='drop-down';
	$available_fields['gender']='drop-down';
	$available_fields['jobbank_experience_range']='drop-down';
	$available_fields['age_range']='drop-down';
	$available_fields['post_date']='datefield';
	$available_fields['salary']='drop-down';
	$available_fields['experience']='drop-down';
	$available_fields['educational_requirements']='drop-down';
	$available_fields['sort_listing']='drop-down';
	
	
	$no_dropdown=array('near_to_me','address');
	$only_dropdown=array('sort_listing');
	
	$new_field_set=	get_option('jobbank_li_fields' );
	if(is_array($new_field_set)){
		foreach($new_field_set  as $field_key => $field_value){
			$available_fields[$field_key]=$field_value;
		}
	}
	$args = array(
		'child_of'     => 0,
		'sort_order'   => 'ASC',
		'sort_column'  => 'post_title',
		'hierarchical' => 1,															
		'post_type' => 'page'
		);
	
?> 
<div class="row">		
	<div class="col-md-6">	
		<p ><strong><?php esc_html_e('Active Fields','jobbank');?></strong> </p>
		<form id="search_active_fields" name="search_active_fields"  >
				<div class="form-group ">	
					<?php
					$jobbank_search_action_target=get_option('jobbank_search_action_target' );	
					?>								
						<label  class="  control-label"><?php esc_html_e( 'Form Submit Action Terget:', 'jobbank' );?> </label>
					<?php
						if ( $pages = get_pages( $args ) ){
							echo "<select id='jobbank_search_action_target' name='jobbank_search_action_target' class='form-control  '>";
							echo "<option value='same_page' ".($jobbank_search_action_target=='same_page' ? 'selected':'').">".esc_html__( 'Same Page', 'jobbank' )."</option>";
							
							echo "<option value='default_archive' ".($jobbank_search_action_target=='default_archive' ? 'selected':'').">".esc_html__( 'Default Archive Page', 'jobbank' )."</option>";
							
							foreach ( $pages as $page ) {
								if($page->post_title!=''){
								echo "<option value='{$page->ID}' ".($jobbank_search_action_target==$page->ID ? 'selected':'').">{$page->post_title}</option>";
								
								}
							}
							echo "</select>";
						}
					?>
				</div>				
			<ul id="searchfieldsActive" class="connectedSortable">	
				<?php
					if(is_array($active_search_fields)){
						foreach($active_search_fields  as $field_key => $field_value){
							if($field_key!=''){
							?>
							<li class="ui-state-default">
								<?php echo esc_html(ucfirst(str_replace('_',' ',$field_key))); ?>
								<span class="marginright">
									<input type="hidden" name="search-field-name[]" id="search-field-name" value="<?php echo esc_attr($field_key);?>">
									<?php
									if(in_array($field_key ,$no_dropdown)){?>
										<select class="form-control" id="search-field-type" name="search-field-type[]">							
											<option value="text-field"><?php esc_html_e('text-field','jobbank');?> </option>
										</select>
									<?php
									}elseif(in_array($field_key ,$only_dropdown)){?>
										<select class="form-control" id="search-field-type" name="search-field-type[]">	
											<option value="drop-down"> <?php esc_html_e('Drop Down','jobbank');?> </option> 										
										</select>
									<?php
									}else{
									?>
									<select class="form-control" id="search-field-type" name="search-field-type[]">								
										<option value="text-field" <?php echo ($field_value=='text-field'? 'selected' :''); ?>> <?php esc_html_e('Text Field','jobbank');?> </option> 
										<option value="drop-down" <?php echo ($field_value=='drop-down'? 'selected' :''); ?> > <?php esc_html_e('Drop Down','jobbank');?> </option> 										
										<option value="multi-checkbox" <?php echo ($field_value=='multi-checkbox'? 'selected' :''); ?>> <?php esc_html_e('Multi Checkbox','jobbank');?> </option> 
										<?php	
										if($field_key==$jobbank_directory_url.'-category' OR $field_key==$jobbank_directory_url.'-tag' OR $field_key==$jobbank_directory_url.'-locations'){?>
											<option value="multi-checkbox-group" <?php echo ($field_value=='multi-checkbox-group'? 'selected' :''); ?>> <?php esc_html_e('Multi Checkbox-Sub-Group','jobbank');?> </option> 
										
										<?php
										}
										?>
										
										<option value="datefield" <?php echo ($field_value=='datefield'? 'selected' :''); ?>> <?php esc_html_e('Date','jobbank');?> </option> 
									</select>
									<?php
									}
									?>
								</span>
							</li>				
							<?php
							}
						}
					}
				?>			
			</ul>
		</form>
	</div>
	<div class="col-md-6">	
		<p class="text-left"> <strong><?php esc_html_e('Available Fields','jobbank');?> </strong> </p >
		<ul id="searchfieldsAvailable" class="connectedSortable">  	
			<?php
				if(is_array($available_fields)){
					foreach($available_fields  as $field_key => $field_value){ 
						if(!array_key_exists($field_key,$active_search_fields)){
						?>
						<li class="ui-state-default"><?php echo esc_html(ucfirst(str_replace('_',' ',$field_key))); ?>
							<span class="marginright">
								<input type="hidden" name="search-field-name[]" id="search-field-name" value="<?php echo esc_html($field_key);?>">
								<?php
								if(in_array($field_key ,$no_dropdown)){
									?>
									<select class="form-control" id="search-field-type" name="search-field-type[]">							
											<option value="text-field"><?php esc_html_e('text-field','jobbank');?> </option>
									</select>
								
								<?php
								}elseif(in_array($field_key ,$only_dropdown)){?>
										<select class="form-control" id="search-field-type" name="search-field-type[]">	
											<option value="drop-down"> <?php esc_html_e('Drop Down','jobbank');?> </option> 										
										</select>
									<?php
								}else{
								?>
								<select class="form-control" id="search-field-type" name="search-field-type[]">								
									<option value="text-field"> <?php esc_html_e('Text Field','jobbank');?> </option> 
									<option value="drop-down"> <?php esc_html_e('Drop Down','jobbank');?> </option>
									<option value="multi-checkbox"> <?php esc_html_e('Multi Checkbox','jobbank');?> </option> 
									<?php	
										if($field_key==$jobbank_directory_url.'-category' OR $field_key==$jobbank_directory_url.'-tag' OR $field_key==$jobbank_directory_url.'-locations'){?>
											<option value="multi-checkbox-group" <?php echo ($field_value=='multi-checkbox-group'? 'selected' :''); ?>> <?php esc_html_e('Multi Checkbox-Sub-Group','jobbank');?> </option> 
										
										<?php
										}
										?>
									<option value="datefield"> <?php esc_html_e('Date','jobbank');?> </option> 
								</select>
								<?php
								}
								?>
							</span>
						</li>				
						<?php
						}
					}
				}
			?>
		</ul>
	</div>
</div>
<div class="row bottom20 " >					
	<div class="col-md-12">	
		<div id="success_message-search-fields"></div>														
		<button class="button button-primary" onclick="return jobbank_update_search_fields();"><?php esc_html_e( 'Save', 'jobbank' );?> </button>
		<button class="button button-primary" onclick="return jobbank_create_search_shortcode();"><?php esc_html_e( 'Get Shortcode', 'jobbank' );?> </button>
		<form name="savedsearch_shortcodes" id="savedsearch_shortcodes">
			<h4><?php esc_html_e( 'Previously generated shortcodes:', 'jobbank' );?> </h4>
			<div id="create_search_shortcode_update_message"></div>
			<div id="create_search_shortcode">
			
			<?php
				
				$jobbank_search_shortcodes_saved=get_option('jobbank_search_shortcodes_saved' );	
				
				$i=0;
				if(is_array($jobbank_search_shortcodes_saved )){
					foreach($jobbank_search_shortcodes_saved  as $field_key => $field_value ){
						if($field_value!=''){?>
						<div class="row " id="searchshortcode<?php echo esc_attr($i); ?>" >
						<input name="shortcodearr[]" type="hidden" value='<?php echo esc_attr($field_value); ?>'>
						<?php
						echo'<div class="col-md-11" id="searchshortcodedata'.esc_attr($i).'">'.esc_html($field_value).'</div><div class="col-md-1"><span onclick="return jobbank_remove_saved_shortcode('.esc_attr($i).')" class="dashicons dashicons-trash"></span></div></div><hr/>';
						
						$i++;
						}
					}
				}
			?>
			
			
			</div>	
		</form>
	</div>
</div>