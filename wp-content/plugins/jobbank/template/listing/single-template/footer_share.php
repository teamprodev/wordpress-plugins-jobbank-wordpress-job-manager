<div class="single-apply-jobs mb-4">
	<div class="row align-items-center">
		<div class="col-md-5">
			<?php			
				if(array_key_exists('apply_button',$active_single_fields_saved)){ 				
				?>
				<button onclick="jobbank_apply_popup('<?php echo esc_attr($jobid);?>')" class="btn btn-big mr-2 mb-2 ">
					<?php 
						if($job_apply=='yes'){?>
						<i class="fa fa-check-circle"></i>
						<?php
						}
					?>
				<?php esc_html_e('Apply Now','jobbank'); ?></button>	
				<?php
				}
				
				$dir_style5_email='yes';
				$dirpro_email_button=get_post_meta($jobid,'dirpro_email_button',true);
				if($dirpro_email_button==""){$dirpro_email_button='yes';}
				if($dir_style5_email=="yes" AND $dirpro_email_button=='yes'){
					$email_button='yes';
					}else{
					$email_button='no';
				}
				
				if(array_key_exists('contact_button',$active_single_fields_saved)){ 
					if($email_button=='yes'){ ?>
						<button type="button" class="btn btn-border mt-1 mb-2 " onclick="jobbank_call_popup('<?php echo esc_html($jobid);?>')"><?php esc_html_e( 'Contact', 'jobbank' ); ?></button>
					<?php
					}
				}
			?>
			
		</div>
		<?php
			if(array_key_exists('social-share',$active_single_fields_saved)){  
			?>
			<div class="col-md-7 text-lg-end social-share">
				<h6 class="color-text-paragraph-2 d-inline-block d-baseline mr-10"><?php esc_html_e('Share this', 'jobbank'); ?> </h6>
				<a class=" d-inline-block d-middle" href="<?php echo esc_url('https://www.facebook.com/sharer/sharer.php?u='.get_the_permalink($jobid ));?>">
				<img alt="" src="<?php echo ep_jobbank_URLPATH.'/assets/images/'; ?>share-fb.svg"></a>
				<a class=" d-inline-block d-middle" href="<?php echo esc_url('https://twitter.com/home?status='.get_the_permalink($jobid ));?>">
				<img alt="" src="<?php echo ep_jobbank_URLPATH.'/assets/images/'; ?>share-tw.svg"></a>
				<a class=" d-inline-block d-middle" href="<?php echo esc_url('http://www.reddit.com/submit?url='. get_the_permalink($jobid ));?>">
				<img alt="" src="<?php echo ep_jobbank_URLPATH.'/assets/images/'; ?>share-red.svg"></a>
				<a class="d-inline-block d-middle" href="<?php echo esc_url('https://api.whatsapp.com/send?text='.get_the_permalink($jobid ));?>">
				<img alt="" src="<?php echo ep_jobbank_URLPATH.'/assets/images/'; ?>share-whatsapp.svg"></a>
			</div>
			<?php
			}
		?>
	</div>
</div>