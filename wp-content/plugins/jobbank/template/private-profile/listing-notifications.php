<div class="border-bottom pb-15 mb-3 toptitle-sub"><?php esc_html_e('Job Notifications', 'jobbank'); ?>
</div>
	
<section class="content-main-right list-jobs mb-30 mt-4">
		<form action="" id="nofification_form" name="nofification_form" method="POST" role="form">
			<div class="row">
				<?php
					$job_notifications_all= get_user_meta($current_user->ID ,'job_notifications',true);
					
					$taxonomy = $jobbank_directory_url.'-category';
					$args = array(
					'orderby'           => 'name', 
					'order'             => 'ASC',
					'hide_empty'        => false, 
					'exclude'           => array(), 
					'exclude_tree'      => array(), 
					'include'           => array(),
					'number'            => '', 
					'fields'            => 'all', 
					'slug'              => '',		
					'hierarchical'      => true, 		
					'childless'         => false,
					'get'               => '', 
					);
					$terms = get_terms($taxonomy,$args); // Get all terms of a taxonomy
					if ( $terms && !is_wp_error( $terms ) ) :
					$i=0;
					$selected='';
					foreach ( $terms as $term_parent ) {  
						$selected='';
						if($job_notifications_all!=''){
							if(in_array($term_parent->slug,$job_notifications_all)){
								$selected='yes';
							}
						}
						?>	
					<div class="col-md-4 ">
						<label for="<?php echo esc_html($term_parent->slug); ?>">
						<input  type="checkbox" name="notificationone[]" id="<?php echo esc_html($term_parent->slug); ?>" value="<?php echo trim(esc_attr($term_parent->slug)); ?>" <?php echo ($selected=='yes'?'checked':'' );?>>
						<?php echo esc_html($term_parent->name);?></label>
					</div>	
					<?php
					}
					endif;	
				?>
			</div>
		</form>
		<div class="row">
			<div class="col-md-12  "> <hr/>				
				<button type="button" onclick="jobbank_save_notification();"  class="btn green-haze"><?php  esc_html_e('Save',	'jobbank'); ?></button>
				<div class="" id="notification_message"></div>
			</div>	
		</div>	
	</section>
