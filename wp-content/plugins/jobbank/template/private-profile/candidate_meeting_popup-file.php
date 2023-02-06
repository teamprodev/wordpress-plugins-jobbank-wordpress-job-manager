<?php
	require_once( explode( "wp-content" , __FILE__ )[0] . "wp-load.php" );	
	wp_enqueue_style('bootstrap', ep_jobbank_URLPATH . 'admin/files/css/iv-bootstrap.css');
	$dir_id=0; if(isset($_REQUEST['user_id'])){$dir_id=sanitize_text_field($_REQUEST['user_id']);}
	$candidate_post_id=$dir_id;	
	$id=$dir_id;
?>
<div class="bootstrap-wrapper popup0margin "id="popup-contact" >		
	<div class="container" >
		<div class="row" >
			<div class="col-md-12">
				<div class="modal-header">
					<h4 class="modal-title"><?php esc_html_e('Meeting Schedule','jobbank'); ?></h4>							
					<button type="button" onclick="jobbank_contact_close();" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<form action="#" id="candidate-meeting-form" name="candidate-meeting-form"   method="POST" >
								<div class="form-group">
									<label for="message" ><?php  esc_html_e( 'Schedule Date', 'jobbank' ); ?></label>
								 	<input type="text"  name="meeting_date"  id="meeting_date" class="form-control ctrl-textbox"   
									value="<?php echo esc_attr(get_post_meta($candidate_post_id, 'candidate_schedule_time', true)); ?>" placeholder="<?php  esc_html_e( 'Select Date & time', 'jobbank' ); ?>">	
								</div>
								<div class="form-group ">
									<label for="message" ><?php  esc_html_e( 'Schedule Message/Notes', 'jobbank' ); ?></label>
									<input type="hidden" name="dir_id" id="dir_id" value="<?php echo esc_attr($id);?>">		 
									<textarea  class="form-control" name="message-content" id="message-content"  cols="20" rows="3"><?php echo esc_html(get_post_meta($candidate_post_id, 'candidate_schedule_note', true)); ?></textarea>
								</div>									
								<div class="form-group ">
									<button type="button" class="btn btn-secondary btn-sm ml-2"  onclick="jobbank_job_candidate_schedule(<?php echo esc_attr($id);?>);" ><?php  esc_html_e( 'Submit', 'jobbank' ); ?></button>
									<div class="ml-2" id="update_message_popup"></div> 
								</div> 
							</form>
						</div>
					</div>				
				</div>	
			</div>				
		</div>	
	</div>	
</div>	