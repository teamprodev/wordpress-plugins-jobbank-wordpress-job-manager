<?php
	require_once( explode( "wp-content" , __FILE__ )[0] . "wp-load.php" );	
	
	$dir_id=0; if(isset($_REQUEST['dir_id'])){$dir_id=sanitize_text_field($_REQUEST['dir_id']);}
	$id=$dir_id;	
	
?>
<div class="bootstrap-wrapper popup0margin "id="popup-contact" >		
	<div class="container" >
		<div class="row" >
		
			<div class="col-md-12">
				<div class="modal-header">
					<div class="modal-title"><?php esc_html_e('Job Application','jobbank'); ?></div>							
						<button type="button" onclick="jobbank_contact_close();" class="close btn btn-border " data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
				</div>
				<div class="modal-body">
					<div class="row vertical-divider">
						<div class="<?php echo(get_post_meta($id,'external_form_url',true)!='' ?'col-md-4' :'col-md-6'); ?>  col-sm-12">
							<?php
							include( ep_jobbank_template. 'listing/apply-form.php');						
							?>
						</div>
						
						<div class="<?php echo(get_post_meta($id,'external_form_url',true)!='' ?'col-md-4' :'col-md-6'); ?> col-sm-12">
								<div class="modal-title"><?php esc_html_e('Apply From Your Account ','jobbank'); ?></div>
								<hr/>
								<?php
								 if(is_user_logged_in()){
								
									$job_apply='no';
									$userID = get_current_user_id();
									$job_apply_all = get_user_meta($userID,'job_apply_all',true);
									$job_apply_all = explode(",", $job_apply_all);
									if (in_array($id, $job_apply_all)) {
										$job_apply='yes';
									}										
									if($job_apply=='yes'){ ?>
										<div class="col-md-12 alert alert-info alert-dismissable"><h4><?php  esc_html_e( 'Applyed Already', 'jobbank' ); ?></h4></div>
										
									<?php	
									}	
									?>
								<form action="#" id="apply-pop2" name="apply-pop2"   method="POST" >
									<div class="form-group ">
										<label for="message" ><?php  esc_html_e( 'Cover Letter', 'jobbank' ); ?></label>
										 <input type="hidden" name="dir_id" id="dir_id" value="<?php echo esc_attr($id);?>">
										<textarea  class="col-md-12  form-control-textarea" name="cover-content2" id="cover-content2"  cols="20" rows="3"></textarea>
									 </div>
									 <div class="form-group ">									
									  <button type="button" class="btn btn-big  ml-2"  onclick="jobbank_job_apply_user();" ><?php  esc_html_e( 'Submit', 'jobbank' ); ?></button>									 
									  </div>
								</form>
								 <div  id="message_popupjob_apply_user"></div> 
								<?php
								}else{
								$login_page=get_option('epjbjobbank_login_page'); 
								?>
								<h5 ><a href="<?php echo get_permalink( $login_page);?>"><?php esc_html_e('Please Login & Apply','jobbank'); ?></a></h5>
							<?php
							
							}
							?>
						</div>
						
							
									<?php
									if(get_post_meta($id,'external_form_url',true)!=''){
									?>	
									<div class="col-md-4 col-sm-12">								
										<a  target="_blank" class="btn btn-big  ml-2 mt-4" href="<?php echo esc_url(get_post_meta($id,'external_form_url',true)); ?>"> <?php esc_html_e('Submit on External Form','jobbank'); ?> </a>
									</div>
									
								<?php
								}
								?>
							</div>
					
				</div>	
				
				
				</div>									
					
		</div>	
	</div>	
</div>	
