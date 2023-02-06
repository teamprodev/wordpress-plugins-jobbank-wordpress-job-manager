<div class=" col-xl-3 col-lg-3  col-md-6  col-sm-6 col-12 listingdata-col">
	<div class="card-grid-2 card-employers " >		
		<div class="text-center card-grid-2-image-rd  d-flex justify-content-around">
			<a href="<?php echo esc_url($page_link); ?>">
				
					<?php
						$iv_profile_pic_url=get_user_meta($user->ID, 'jobbank_profile_pic_thum',true);
						if($iv_profile_pic_url!=''){ ?>
							<figure class="">	<img  class="rounded-circle logo-max-h"  src="<?php echo esc_url($iv_profile_pic_url); ?>"></figure>
						<?php
							}else{
							echo'<figure class="blank-rounded-logo center "></figure>';
							
						}
					?>
					
				
			</a>
		</div>
		<div class="card-block-info">
			<div class="card-profile">
				<h5><a href="<?php echo esc_url($page_link); ?>" class="toptitle "><?php echo (get_user_meta($user->ID,'full_name',true)!=''? get_user_meta($user->ID,'full_name',true) : $user->display_name ); ?></a></h5>
				<?php
					if(get_user_meta($user->ID,'company_type',true)!='' ){
						?>
						<span class="text-sm"><?php echo get_user_meta($user->ID,'company_type',true); ?></span>
					<?php
					}
				?>	
			</div>			
			<div class="row mt-2">
				<div class="col-sm-12 text-center text-sm">
					<?php
					  $all_locations= str_replace(',',' ',get_user_meta($user->ID, 'all_locations', true));
					 
						if($all_locations!=''){
						?>
						<span class="card-location ">
							<i class="fa-solid fa-location-dot mr-1"></i><?php echo esc_html($all_locations); ?>
						</span>
						<?php
						}
					?>					
				</div>					
			</div>
			
			<div class="card-2-bottom card-2-bottom-candidate mt-3">
				<div class="text-center">
				<?php
				if(get_user_meta($user->ID, 'user_type', true)==='employer' ){
					$total_jobs= $main_class->jobbank_total_job_count($user->ID, $allusers='no' );
					?>
						<a class="btn btn-border" href="<?php echo get_post_type_archive_link( $jobbank_directory_url ).'?employer='.esc_attr($user->ID); ?>"><?php echo esc_html($total_jobs);?> <?php esc_html_e('Open Jobs', 'jobbank'); ?></a>
					
				<?php
				}else{
					$tags_user= get_user_meta($user->ID,'professional_skills',true); 				
					$tags_user_arr=  array_filter( explode(",", $tags_user), 'strlen' );
					foreach ( $tags_user_arr as $tag ) {
					?>
					<span class="btn btn-small mr-1 mb-2"><?php echo esc_html(ucwords(str_replace('-',' ',$tag)));?></span>
					<?php
					}						
				
				?>
					<div class="text-center">
					<a class="btn btn-border mt-2" href="<?php echo esc_url($page_link); ?>"><?php esc_html_e('View Profile', 'jobbank'); ?></a>
					</div>
				<?php
				}
				?>
				</div>
			</div>
		</div>
	</div>
</div>