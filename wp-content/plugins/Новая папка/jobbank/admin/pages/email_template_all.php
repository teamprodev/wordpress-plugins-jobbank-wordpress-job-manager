		<form class="form-horizontal" role="form"  name='email_settings' id='email_settings'>	
							<?php
								$form_id='';										
							?>
							<div class="form-group row">
								<label  class="col-md-2  control-label"> <?php esc_html_e( 'Email Sender :', 'jobbank' );?> </label>
								<div class="col-md-4 ">
									<?php
										$admin_email_setting='';
										if( get_option( 'jobbank_admin_email' )==FALSE ) {
											$admin_email_setting = get_option('admin_email');						 
											}else{
											$admin_email_setting = get_option('jobbank_admin_email');								
										}	
									?>
									<input type="text" class="form-control" id="jobbank_admin_email" name="jobbank_admin_email" value="<?php echo esc_html($admin_email_setting); ?>" placeholder="">
								</div>
							</div>	
							<div class="form-group row">
								<h3  class="col-md-12   page-header"><?php esc_html_e( 'Signup / Forget password Email', 'jobbank' );?> </h3>
							</div>
							<div class="form-group row">
								<label  class="col-md-2   control-label"><?php esc_html_e( 'Email Subject', 'jobbank' );?>  : </label>
								<div class="col-md-4 ">
									<?php
										$jobbank_signup_email_subject = get_option( 'jobbank_signup_email_subject');
									?>
									<input type="text" class="form-control" id="jobbank_signup_email_subject" name="jobbank_signup_email_subject" value="<?php echo esc_html($jobbank_signup_email_subject); ?>" placeholder="Enter signup email subject">
								</div>
							</div>
							<div class="form-group row">
								<label  class="col-md-2   control-label"> <?php esc_html_e( 'Email Tempalte ', 'jobbank' );?>: </label>
								<div class="col-md-10 ">
									<?php
										$settings_a = array(															
										'textarea_rows' =>20,															 
										);
										$content_client = get_option( 'jobbank_signup_email');
										$editor_id = 'signup_email_template';
									?>
									<textarea id="<?php echo esc_html($editor_id) ;?>" name="<?php echo esc_html($editor_id) ;?>" rows="20" class="col-md-12 ">
										<?php echo esc_html($content_client); ?>
									</textarea>		
								</div>
							</div>
							<div class="form-group row">
								<label  class="col-md-2   control-label"> <?php esc_html_e( 'Forget Subject', 'jobbank' );?> : </label>
								<div class="col-md-4 ">
									<?php
										$jobbank_forget_email_subject = get_option( 'jobbank_forget_email_subject');
									?>
									<input type="text" class="form-control" id="forget_email_subject" name="forget_email_subject" value="<?php echo esc_html($jobbank_forget_email_subject); ?>" placeholder="Enter forget email subject">
								</div>
							</div>
							<div class="form-group row">
								<label  class="col-md-2   control-label"><?php esc_html_e( 'Forget Tempalte :', 'jobbank' );?>  </label>
								<div class="col-md-10 ">
									<?php
										$settings_forget = array(															
										'textarea_rows' =>'20',	
										'editor_class'  => 'form-control',														 
										);
										$content_client = get_option( 'jobbank_forget_email');
										$editor_id = 'forget_email_template';																				
									?>
									<textarea id="<?php echo esc_attr($editor_id );?>" name="<?php echo esc_attr($editor_id) ;?>" rows="20" class="col-md-12 ">
										<?php echo esc_html($content_client); ?>
									</textarea>		
								</div>
							</div>
							<div class="form-group row">
								<h3  class="col-md-12 col-xs-12 col-sm-12  page-header"><?php esc_html_e( 'Order Email', 'jobbank' );?> </h3>
							</div>
							<div class="form-group row">
								<label  class="col-md-2   control-label"><?php esc_html_e( 'User Email Subject :', 'jobbank' );?>  </label>
								<div class="col-md-4 ">
									<?php
										$jobbank_order_email_subject = get_option( 'jobbank_order_client_email_sub');
									?>
									<input type="text" class="form-control" id="jobbank_order_email_subject" name="jobbank_order_email_subject" value="<?php echo esc_html($jobbank_order_email_subject); ?>" placeholder="Enter order email subject">
								</div>
							</div>
							<div class="form-group row">
								<label  class="col-md-2   control-label"> <?php esc_html_e( 'User Email Tempalte :', 'jobbank' );?> </label>
								<div class="col-md-10 ">
									<?php
										$settings_a = array(															
										'textarea_rows' =>20,															 
										);
										$content_client = get_option( 'jobbank_order_client_email');
										$editor_id = 'order_client_email_template';																			
									?>
									<textarea id="<?php echo esc_attr($editor_id);?>" name="<?php echo esc_attr($editor_id) ;?>" rows="20" class="col-md-12 ">
										<?php echo esc_html($content_client); ?>
									</textarea>			
								</div>
							</div>
							<div class="form-group row">
								<label  class="col-md-2   control-label"> <?php esc_html_e( 'Admin Email Subject :', 'jobbank' );?> </label>
								<div class="col-md-4 ">
									<?php
										$jobbank_order_admin_email_subject = get_option( 'jobbank_order_admin_email_sub');
									?>
									<input type="text" class="form-control" id="jobbank_order_admin_email_subject" name="jobbank_order_admin_email_subject" value="<?php echo esc_attr($jobbank_order_admin_email_subject); ?>" placeholder="Enter order email subject">
								</div>
							</div>
							<div class="form-group row">
								<label  class="col-md-2   control-label"> <?php esc_html_e( 'Admin Email Tempalte :', 'jobbank' );?> </label>
								<div class="col-md-10 ">
									<?php
										$settings_a = array(															
										'textarea_rows' =>20,															 
										);
										$content_client = get_option( 'jobbank_order_admin_email');
										$editor_id = 'order_admin_email_template';																							
									?>
									<textarea id="<?php echo esc_attr($editor_id) ;?>" name="<?php echo esc_attr($editor_id );?>" rows="20" class="col-md-12 ">
										<?php echo esc_html($content_client); ?>
									</textarea>		
								</div>
							</div>
							<div class="form-group row">
								<h3  class="col-md-12 col-xs-12 col-sm-12  page-header"><?php esc_html_e( 'Reminder Email', 'jobbank' );?> </h3>
							</div>
							<?php
								include (ep_jobbank_DIR .'/admin/pages/reminder_email.php');
							?>
							<div class="form-group row">
								<h3  class="col-md-12 col-xs-12 col-sm-12  page-header"><?php esc_html_e( 'New Message Email', 'jobbank' );?> </h3>
							</div>
							<?php
								include (ep_jobbank_DIR .'/admin/pages/new-message.php');
							?>
							
							<div class="row">					
							<div class="col-md-12">	
								<hr/>
								<div id="email-success"></div>												
									<button type="button" onclick="return  jobbank_update_email_settings();" class="button button-primary"><?php  esc_html_e('Update Email Setting','jobbank');?>  </button>		
								
								<p>&nbsp;</p>
							</div>
						</div>
							
							
						</form>
						
						
					