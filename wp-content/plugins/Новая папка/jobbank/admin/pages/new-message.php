<div class="form-group row">
		<label  class="col-md-2   control-label"> <?php esc_html_e( 'BCC to Admin all Message :', 'jobbank' );?> </label>
		<div class="col-md-4 ">
			
			<?php
			 $bcc_message='';
			 if( get_option('epjbjobbank_bcc_message' ) ) {
				  $bcc_message= get_option('epjbjobbank_bcc_message'); 
			 }	
			
			?><label>
		  <input  class="" type="checkbox" name="bcc_message" id="bcc_message" value="yes" <?php echo ($bcc_message=='yes'? 'checked':'' ); ?> > 
				<?php esc_html_e( 'Yes, Admin will  get all message.', 'jobbank' );?>
		
	</div>
</div>
<div class="form-group row">
		<label  class="col-md-2   control-label"> <?php esc_html_e( 'New Message Subject : ', 'jobbank' );?></label>
		<div class="col-md-4 ">
			
				<?php
				$jobbank_contact_email_subject = get_option( 'jobbank_contact_email_subject');
				?>
				
				<input type="text" class="form-control" id="contact_email_subject" name="contact_email_subject" value="<?php echo esc_attr($jobbank_contact_email_subject); ?>" placeholder="<?php esc_html_e( 'Enter subject', 'jobbank' );?>">
		
	</div>
</div>
<div class="form-group row">
		<label  class="col-md-2   control-label"> <?php esc_html_e( 'New Message Template :', 'jobbank' );?> </label>
		<div class="col-md-10 ">
													<?php
					$settings_forget = array(															
						'textarea_rows' =>'20',	
						'editor_class'  => 'form-control',														 
						);
					$content_client = get_option( 'jobbank_contact_email');
					$editor_id = 'message_email_template';
													
					?>
			<textarea  name="message_email_template" rows="20" class="col-md-12 ">
			<?php echo esc_html($content_client); ?>
			</textarea>				

	</div>
</div>
<div class="form-group row">
	<h3  class="col-md-12 col-xs-12 col-sm-12  page-header"><?php esc_html_e( 'Apply Email', 'jobbank' );?> </h3>
</div>
	<div class="form-group row">
		<label  class="col-md-2   control-label"> <?php esc_html_e( 'Appy Subject : ', 'jobbank' );?></label>
		<div class="col-md-4 ">
			
				<?php
				$jobbank_apply_email_subject = get_option( 'jobbank_apply_email_subject');
				?>
				
				<input type="text" class="form-control" id="jobbank_apply_email_subject" name="jobbank_apply_email_subject" value="<?php echo esc_attr($jobbank_apply_email_subject); ?>" placeholder="<?php esc_attr_e( 'Enter subject', 'jobbank' );?>">
		
	</div>
</div>
<div class="form-group row">
		<label  class="col-md-2   control-label"> <?php esc_html_e( 'New Apply Template :', 'jobbank' );?> </label>
		<div class="col-md-10 ">
													<?php
					$settings_forget = array(															
						'textarea_rows' =>'20',	
						'editor_class'  => 'form-control',														 
						);
					$content_client = get_option( 'jobbank_apply_email');
					$editor_id = 'apply_email_template';
													
					?>
			<textarea  name="apply_email_template" rows="20" class="col-md-12 ">
			<?php echo esc_html($content_client); ?>
			</textarea>				

	</div>
</div>
<div class="form-group row">
	<h3  class="col-md-12 col-xs-12 col-sm-12  page-header"><?php esc_html_e( 'Job Notification Email', 'jobbank' );?> </h3>
</div>
	<div class="form-group row">
		<label  class="col-md-2   control-label"> <?php esc_html_e( 'Notification Subject : ', 'jobbank' );?></label>
		<div class="col-md-4 ">
			
				<?php
				$jobbank_notification_email_subject = get_option( 'jobbank_notification_email_subject');
				?>
				
				<input type="text" class="form-control" id="jobbank_notification_email_subject" name="jobbank_notification_email_subject" value="<?php echo esc_attr($jobbank_notification_email_subject); ?>" placeholder="<?php esc_html_e( 'Enter subject', 'jobbank' );?>">
		
	</div>
</div>
<div class="form-group row">
		<label  class="col-md-2   control-label"> <?php esc_html_e( 'Notification Template :', 'jobbank' );?> </label>
		<div class="col-md-10 ">
													<?php
					$settings_forget = array(															
						'textarea_rows' =>'20',	
						'editor_class'  => 'form-control',														 
						);
					$content_client = get_option( 'jobbank_notification_email');
				
													
					?>
			<textarea  name="notification_email_template" rows="20" class="col-md-12 ">
			<?php echo esc_html($content_client); ?>
			</textarea>				

	</div>
</div>
