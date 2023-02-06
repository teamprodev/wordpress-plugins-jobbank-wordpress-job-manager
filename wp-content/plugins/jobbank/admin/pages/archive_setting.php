<?php
wp_enqueue_style('fontawesome-browser', ep_jobbank_URLPATH . 'admin/files/css/fontawesome-browser.css');	
wp_enqueue_style('all-font-awesome', 			ep_jobbank_URLPATH . 'admin/files/css/fontawesome.css');
wp_enqueue_script( 'jobbank_meta-image', ep_jobbank_URLPATH . 'admin/files/js/meta-media-uploader.js', array( 'jquery' ) );		
		
	$jobbank_directory_url=get_option('ep_jobbank_url');
	if($jobbank_directory_url==""){$jobbank_directory_url='job';}
	
	$active_archive_fields=jobbank_get_archive_fields_all();	
	$active_archive_icon_saved=get_option('jobbank_archive_icon_saved' );		
	$available_fields=jobbank_get_listing_fields_all();	

?> 
<div class="row">		
	<div class="col-md-6">	
		<p ><strong><?php esc_html_e('Active Fields','jobbank');?></strong> </p>
		<form id="search_active_archive_fields" name="search_active_archive_fields"  >	
			<ul id="searchfieldsActive" class="connectedSortable">	
				
				<?php
				$i=0;
				if(is_array($active_archive_fields)){
					foreach($active_archive_fields  as $field_key => $field_value){
						if($field_key!=''){
							$saved_icon='';
							if(isset($active_archive_icon_saved[$field_key])){
								$saved_icon=$active_archive_icon_saved[$field_key];
							}
						?>
						<li class="ui-state-default">
							<?php echo esc_html(ucfirst(str_replace('_',' ',$field_key))); ?>
							<?php
								if( $field_key!='category' AND $field_key!='top_search_form'){
									?>	
									<button type="button" class="btn btn-primary btn-sm" onclick="jobbank_icon_uploader('field_icon<?php echo esc_attr($i); ?>');"><?php esc_html_e('Set Icon','jobbank'); ?></button>
								<?php
								}
								?>
								
															
								
							<span class="marginright">								
								<input type="hidden" name="search-field-name[]" id="search-field-name" value="<?php echo esc_html($field_key);?>">
								<?php
								if( $field_key=='category'){
									?>									
									<input type="text" name="field_icon[]" id="field_icon<?php echo esc_attr($i); ?>"  readonly class="form-control"   value="<?php esc_html_e('Collect from category','jobbank'); ?>" />								
								<?php
								}elseif( $field_key=='top_search_form'){
								?>									
									<select name="field_icon[]" id="field_icon<?php echo esc_attr($i); ?>" class="form-control">
										<option value="popup" <?php echo ($saved_icon=='popup'?' selected':''); ?>><?php esc_html_e('Popup/Modal Search','jobbank'); ?></option>
										<option value="on-page" <?php echo ($saved_icon=='on-page'?' selected':''); ?>><?php esc_html_e('Search Form on the page','jobbank'); ?></option>
										<option value="no-search" <?php echo ($saved_icon=='no-search'?' selected':''); ?>><?php esc_html_e('No Search Form Option','jobbank'); ?></option>
									</select>
									
								
								<?php
								}else{
								?>	
								<input type="text" name="field_icon[]" id="field_icon<?php echo esc_attr($i); ?>"  class="form-control" placeholder=""  value="<?php echo esc_attr($saved_icon); ?>" />
								<?php
								}
								?>
							</span>
						</li>				
						<?php
							$i++;
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
						if(!array_key_exists($field_key,$active_archive_fields)){
						?>
						<li class="ui-state-default"><?php echo esc_html(ucfirst(str_replace('_',' ',$field_key))); ?>
							<?php
								if( $field_key!='category' AND $field_key!='top_search_form'){
									?>							
									<button type="button" class="btn btn-primary btn-sm" onclick="jobbank_icon_uploader('field_icon<?php echo esc_attr($i); ?>');"><?php esc_html_e('Set Icon','jobbank'); ?></button>
							<?php
								}
							?>	
								
							<span class="marginright">
								<input type="hidden" name="search-field-name[]" id="search-field-name" value="<?php echo esc_html($field_key);?>">
								<?php
								if( $field_key=='category'){
									?>									
									<input type="text" name="field_icon[]" id="field_icon<?php echo esc_attr($i); ?>" readonly class="form-control"   value="<?php esc_html_e('Collect from category','jobbank'); ?>" />
								
								<?php
								}elseif( $field_key=='top_search_form'){
								?>									
									<select name="field_icon[]" id="field_icon<?php echo esc_attr($i); ?>" class="form-control">
										<option value="popup" selected ><?php esc_html_e('Popup/Modal Search','jobbank'); ?></option>
										<option value="on-page" ><?php esc_html_e('Search Form on The Page','jobbank'); ?></option>
										<option value="no-search" ><?php esc_html_e('No Search Form Option','jobbank'); ?></option>
									</select>
								<?php
								}else{
								?>	
								<input type="text" name="field_icon[]" id="field_icon<?php echo esc_attr($i); ?>"  class="form-control" placeholder=""  value="" />
								<?php
								}
								?>
							
							</span>
						</li>				
						<?php
							$i++;
						}
					}
				}
			?>
		</ul>
	</div>
</div>
<div class="row bottom20 " >					
	<div class="col-md-12">	
		<div id="success_message-archive-fields"></div>														
		<button class="button button-primary" onclick="return jobbank_update_archive_fields();"><?php esc_html_e( 'Save', 'jobbank' );?> </button>
	</div>
</div>