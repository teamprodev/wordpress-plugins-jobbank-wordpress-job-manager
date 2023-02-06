<div class="col-xl-4 col-lg-4 col-md-6  col-sm-12 col-12  mt-4 mb-4 listingdata-col " id="<?php echo esc_html($i); ?>" >
		<div class=" card-border-round mb-2 bg-white" >											
			<?php						
				if(isset($active_archive_fields['image'])){				
				?>
				<div class="card-img-container">
					<a href="<?php echo get_the_permalink($id);?>"><img src="<?php echo esc_html($feature_img);?>" class="card-img-top-listing">					
						</a>
						<?php
						if(get_post_meta($id, 'jobbank_featured', true)=='featured'){
						?>
						<label class="btn-urgent-right"><?php  esc_html_e('Featured','jobbank'); ?></label> 
						<?php
						}
						?>
					<?php
						if(isset($active_archive_fields['favorite'])){	
							$saved_icon= jobbank_get_icon($active_archive_icon_saved, 'favorite','archive');
							if($saved_icon==''){
								$saved_icon='far fa-heart';
							}
						
								$user_ID = get_current_user_id();
								$favourites='no';
								if($user_ID>0){
									$my_favorite = get_post_meta($id,'_favorites',true);
									$all_users = explode(",", $my_favorite);
									if (in_array($user_ID, $all_users)) {
										$favourites='yes';
									}
								}
								if($favourites!='yes'){?>														
								<label class="btn-urgent-left btn-add-favourites jobbookmark" id="jobbookmark<?php echo esc_html($id); ?>"><?php  esc_html_e('Save','jobbank'); ?></label>
								<?php
									}else{
								?>
								<label class="btn-urgent-left btn-added-favourites jobbookmark" id="jobbookmark<?php echo esc_html($id); ?>"><?php  esc_html_e('Saved','jobbank'); ?></label>
								<?php
								}													
						}
					?>
				</div>	
				<?php
				}
			?>
			<div class="card-body  card-body-min-height mt-1">
				
				<?php
					if(is_array($active_archive_fields)){
						foreach($active_archive_fields  as $field_key => $field_value){
							$saved_icon= jobbank_get_icon($active_archive_icon_saved, $field_key,'archive');
							if($field_key!='image'){
								switch ($field_key) {
									case "title":
								?>
								<p class=" p-0 ">
									<a href="<?php echo get_permalink($id); ?>" class="title m-0 p-0">
										<?php echo esc_html($post->post_title);?>
									</a>
								</p>													
								<?php
									break;
									case "tag":
									$tag_name='';
									$currenttag = $main_class->jobbank_get_tags_caching($id,$jobbank_directory_url);
									if(isset($currenttag[0]->slug)){														
										$cc=0;$tag_name='';
										foreach($currenttag as $c){									
											$tag_name = $tag_name .', '.$c->name;
										}
									}
									if($tag_name!=''){
									?>
									<p class="address">
										<i class="<?php echo esc_html($saved_icon); ?>"></i> <?php echo esc_html(ucfirst(trim( $tag_name))); ?>
									</p> 
									<?php
									}
									break;
									case "category":
									$currentCategory = $main_class->jobbank_get_categories_caching($id,$jobbank_directory_url);
									$cat_name2='';
									if(isset($currentCategory[0]->slug)){										
									foreach($currentCategory as $c){								
										$saved_icon_cat= jobbank_get_cat_icon($c->term_id);																
										$cat_name2 = $cat_name2 .' <i class="'.esc_html($saved_icon_cat).'"></i>'.$c->name;
									}
									}
									if($cat_name2 !=''){
									?>
									<p class=" address">
										<?php echo wp_kses($cat_name2,'post') ; ?>
									</p>	
									<?php
									}
									break;
									case "location":
									$currentlocation = $main_class->jobbank_get_location_caching($id,$jobbank_directory_url);
									$locations='';
									if(isset($currentlocation[0]->slug)){										
									foreach($currentlocation as $c){
										$locations = $locations .' '.$c->name;
									}
									}
									if($locations !=''){
										$dir_data['locations']= $locations;
									?>
									<p class=" address">
										<i class="<?php echo esc_html($saved_icon); ?>"></i><?php echo esc_html(ucfirst($locations)); ?>
									</p>	
									<?php
									}
									break;	
									case "post_date": 
								?>
								<p class=" address">
									<i class="<?php echo esc_html($saved_icon); ?>"></i><?php echo get_the_date( 'd M-Y ', $id ); ?>
								</p>
								<?php																
									break;
									case "deadline": 
										$deadline= strtotime(get_post_meta($id, 'deadline', true));	
										$deadline_format= date('j M, Y',$deadline);
									?>
									<p class=" address">
										<i class="<?php echo esc_html($saved_icon); ?>"></i><?php echo esc_html($deadline_format); ?>
									</p>
									<?php		
									break;
									
									default:
									if(get_post_meta($id,$field_key,true)!=''){
										$custom_meta_data=get_post_meta($id,$field_key,true);
										if(is_array($custom_meta_data)){
											$full_data='';
											foreach( $custom_meta_data as $one_data){
												$full_data=$full_data.' '.$one_data;
											}
											$custom_meta_data=$full_data;
										}
									?>
									<p class=" address ">
										<i class="<?php echo esc_html($saved_icon); ?>"></i><?php echo esc_html($custom_meta_data);?>
									</p>
									<?php	
									}
									break;
								}										
							}									
						}
					}								
				?>
				<?php								
					$dir_style5_email='yes';
					$dirpro_email_button=get_post_meta($id,'dirpro_email_button',true);
					if($dirpro_email_button==""){$dirpro_email_button='yes';}
					if($dir_style5_email=="yes" AND $dirpro_email_button=='yes'){
						$email_button='yes';
						}else{
						$email_button='no';
					}
				?>
				<p class="client-contact">									
					<?php									
						$saved_icon= jobbank_get_icon($active_archive_icon_saved, 'contact_button','archive');
						if(isset($active_archive_fields['contact_button'])){
							if($email_button=='yes'){ ?>
							<button type="button" class="btn btn-small-ar mt-1" onclick="jobbank_call_popup('<?php echo esc_html($id);?>')"><i class="<?php echo esc_html($saved_icon); ?>"></i><?php esc_html_e( 'Contact', 'jobbank' ); ?></button>
							<?php
							}
						}
						if(isset($active_archive_fields['apply_button'])){
							$saved_icon= jobbank_get_icon($active_archive_icon_saved, 'apply_button','archive');
						?>
						<button type="button" class=" btn btn-small-ar  mt-1" onclick="jobbank_apply_popup('<?php echo esc_attr($id);?>')"><i class="<?php echo esc_html($saved_icon); ?>"></i><?php esc_html_e( 'Apply', 'jobbank' ); ?></button>
						<?php
						}
					?>
				</p>
			</div>
					
		</div>
	</div>
	