<form action="#" id="apply-pop" name="apply-pop"   method="POST" >
	 <div class="form-group  ">
			<label  for="Name"><?php  esc_html_e( 'Name', 'jobbank' ); ?></label>
			<input  class="  form-control" id="canname" name ="canname" type="text">
	 </div>
	<div class="form-group ">
			<label for="eamil" ><?php  esc_html_e( 'Email', 'jobbank' ); ?></label>
			 <input class=" form-control"  name="email_address" id="email_address" type="text">
	 </div>
	 <div class="form-group ">
			<label for="contact_phone" ><?php  esc_html_e( 'Phone', 'jobbank' ); ?></label>
			 <input class=" form-control"  name="contact_phone" id="contact_phone" type="text">
	 </div>
		
	 
	 <div class="form-group ">
		<label for="message" ><?php  esc_html_e( 'Cover Letter', 'jobbank' ); ?></label>
		 <input type="hidden" name="dir_id" id="dir_id" value="<?php echo esc_attr($id);?>">	
		<textarea  class="col-md-12  form-control-textarea " name="cover-content" id="cover-content"  cols="20" rows="3"></textarea>
	 </div>
	 <div class="form-group ">
			<label for="resume" ><?php  esc_html_e( 'Resume (Max 5Mb): ', 'jobbank' ); ?></label>			 
			 <input class="form-control-file"  name="finalresume" id="finalresume" type="file">
			 <small id="passwordHelpInline" class="text-muted">
				  <?php  esc_html_e( 'Allowed file types are(.doc, .docx, .pdf) ', 'jobbank' ); ?>
			</small>			
	 </div>	
	 <div class="form-group ">
		 <button type="button" class="btn btn-big ml-2"  onclick="job_apply_nonlogin();" ><?php  esc_html_e( 'Submit', 'jobbank' ); ?></button>		 
	</div> 
	
</form>

<div class="ml-2" id="update_message_popup80"></div> 