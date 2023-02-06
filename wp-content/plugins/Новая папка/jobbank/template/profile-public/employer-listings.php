<?php
	$jobbank_similar = get_posts(array(
	'numberposts'	=> '5000',
	'post_type'		=> $jobbank_directory_url,
	'author'=> $user_id , 
	'post_status'	=> 'publish',
	'orderby'		=> 'rand',
	));
	$single_page_icon_saved=get_option('jobbank_single_icon_saved' );
?>
<div class="sidebar-border">
	<div class="toptitle mb-3"><?php esc_html_e('Opening Jobs', 'jobbank'); ?></div>
	<?php
		if ( ! empty( $jobbank_similar ) ) {	
			$i=0;$company_logo_sim='';
			foreach( $jobbank_similar as $listing_sm ){
				$company_logo_sim='';
				$listing_contact_source_sim=get_post_meta($listing_sm->ID,'listing_contact_source',true);
				if($listing_contact_source_sim==''){$listing_contact_source_sim='user_info';}
				$dir_detail_sim= get_post($listing_sm->ID); 
				
				$author_id_sim=$dir_detail_sim->post_author;			
				if($listing_contact_source_sim=='new_value'){
						$feature_image_sim = wp_get_attachment_image_src( get_post_thumbnail_id( $listing_sm->ID ), 'large' );
						if(isset($feature_image_sim[0])){
							$company_logo_sim =$feature_image_sim[0];
						}
					
					}else{
					$company_logo_sim=get_user_meta($author_id_sim, 'jobbank_profile_pic_thum',true);
				}
			?>	<div class="sidebar-list-job col-md-12"></div>
			<div class="row  card-list-4  " >
				<div class="col-md-3 col-3 mt-3 ">
					<div class="image "><a href="<?php echo  get_the_permalink($listing_sm->ID );?>">
						<?php
							if(trim($company_logo_sim)!=''){
							?>
								<img class="rounded-image " src="<?php echo esc_url($company_logo_sim); ?>" alt="img">
							<?php
							}else{?>
								<div class="blank-rounded-image--"></div>
							<?php
							}
						?>
					</a>
					</div>
				</div>
				<div class="col-md-9 col-9 mt-3">
					<div class=""><a href="<?php echo  get_the_permalink($listing_sm->ID );?>" class="font-md "><?php echo get_the_title($listing_sm->ID); ?> </a></div>
					<div class="mt-0 "><span class="card-briefcase"><?php
						$saved_icon= jobbank_get_icon($single_page_icon_saved, 'job_type' ,'single');
						?><i class="<?php echo esc_html($saved_icon); ?>"></i> <?php  echo esc_html(get_post_meta($listing_sm->ID,'job_type',true)); ?></span><span class="card-time"><span> <?php
							$saved_icon= jobbank_get_icon($single_page_icon_saved,'post_date', 'single');
						?><i class=" ml-2 <?php echo esc_html($saved_icon); ?>"></i><?php echo get_the_date( 'd M-Y', $listing_sm->ID ); ?></span></span></div>		  
						<div class="row mt-2 ">
							<div class="col-6 ">
								<h6 class="card-price "><?php echo esc_attr(get_post_meta($listing_sm->ID,'salary', true)); ?></h6>
							</div>
							<?php
								$location_array= wp_get_object_terms( $listing_sm->ID,  $jobbank_directory_url.'-locations');
								$i=0;$company_locations='';
								foreach($location_array as $one_tag){	
									$company_locations= $company_locations.' '.esc_html($one_tag->name); 						
								}	
								if(trim($company_locations)){
								?>
								<div class="col-6 "><span class="card-briefcase"> <i class="fa-solid fa-location-dot mr-1"></i><?php echo esc_html($company_locations); ?></span></div>
								<?php
								}
							?>
						</div>
				</div>
			</div>
			<?php
			}
		}
	?>
</div>
<?php
	wp_reset_query();
?>