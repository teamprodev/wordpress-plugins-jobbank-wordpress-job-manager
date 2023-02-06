<?php
	global $wpdb;
	global $current_user;
	$ii=1;
?>

	
		
		<form id="my_account_menu" name="my_account_menu" class="form-horizontal" role="form" onsubmit="return false;">
				<div id="success_message">	</div>	
	
					<div class="row ">
						<div class="col-sm-3 ">										
							<h4><strong><?php  esc_html_e('Menu Title / Label','jobbank');?> </strong> </h4>
						</div>
						<div class="col-sm-7">
							<h4><strong><?php  esc_html_e('Link','jobbank');?> </strong></h4>									
						</div>
						<div class="col-sm-2">
							<h4><strong><?php  esc_html_e('Action','jobbank');?></strong> </h4>
						</div>		
					</div>
					<?php
						$profile_page=get_option('epjbjobbank_profile_page'); 	
						$page_link= get_permalink( $profile_page); 
					?>
					<hr>
					<div class="row ">
						<div class="col-sm-3 ">										
							<?php  esc_html_e('Job Search','jobbank');?>  
						</div>
						<div class="col-sm-7">
							<a href="<?php echo get_post_type_archive_link( 'job' ) ; ?>">
								<?php echo get_post_type_archive_link( 'job' ) ; ?>
							</a>									
						</div>
						<div class="col-sm-2">
							<div class="checkbox ">
								<label><?php
									$account_menu_check='';
									if( get_option('epjbjobbank_menu_listinghome' ) ) {
										$account_menu_check= get_option('epjbjobbank_menu_listinghome'); 
									}	 
								?>
								<input type="checkbox" name="listinghome" id="listinghome" value="yes" <?php echo ($account_menu_check=='yes'? 'checked':'' ); ?> > <?php  esc_html_e('Hide','jobbank');?>  
								</label>
							</div>											
						</div>					  
					</div>
					<hr>
					<div class="row ">
						<div class="col-sm-3 ">										
							<?php  esc_html_e('Membership','jobbank');	 ?> 
						</div>
						<div class="col-sm-7">
							<a href="<?php echo esc_url($page_link); ?>?&profile=level">
								<?php echo esc_url($page_link); ?>?&profile=level
							</a>									
						</div>
						<div class="col-sm-2">
							<div class="checkbox ">
								<label><?php
									$account_menu_check='';
									if( get_option('epjbjobbank_mylevel' ) ) {
										$account_menu_check= get_option('epjbjobbank_mylevel'); 
									}	 
								?>
								<input type="checkbox" name="mylevel" id="mylevel" value="yes" <?php echo ($account_menu_check=='yes'? 'checked':'' ); ?> >  <?php  esc_html_e('Hide','jobbank');?>  
								</label>
							</div>											
						</div>					  
					</div>
					<hr>
					<div class="row ">
						<div class="col-sm-3 ">										
							<?php  esc_html_e('Edit Profile','jobbank');?>  
						</div>
						<div class="col-sm-7">
							<a href="<?php echo esc_url($page_link); ?>?&profile=setting">
								<?php echo esc_url($page_link); ?>?&profile=setting
							</a>									
						</div>
						<div class="col-sm-2">
							<div class="checkbox ">
								<label><?php
									$account_menu_check='';
									if( get_option('epjbjobbank_menusetting' ) ) {
										$account_menu_check= get_option('epjbjobbank_menusetting'); 
									}	 
								?>
								<input type="checkbox" name="menusetting" id="menusetting" value="yes" <?php echo ($account_menu_check=='yes'? 'checked':'' ); ?> >  <?php  esc_html_e('Hide','jobbank');?> 
								</label>
							</div>											
						</div>					  
					</div>		
					<hr>
					<div class="row ">
					
						<div class="col-sm-3 ">										
							<?php  esc_html_e('Manage Jobs','jobbank');?>  
						</div>
						<div class="col-sm-7">
							<a href="<?php echo esc_url($page_link); ?>?&profile=all-post">
								<?php echo esc_url($page_link); ?>?&profile=all-post
							</a>										
						</div>
						<div class="col-sm-2">
							<div class="checkbox ">
								<label><?php
									$account_menu_check='';
									if( get_option('epjbjobbank_menuallpost' ) ) {
										$account_menu_check= get_option('epjbjobbank_menuallpost'); 
									}	 
								?>
								<input type="checkbox" name="menuallpost" id="menuallpost" value="yes" <?php echo ($account_menu_check=='yes'? 'checked':'' ); ?> >  <?php  esc_html_e('Hide','jobbank');?> 
								</label>
							</div>											
						</div>
						
					</div>		
					<hr>
					<div class="row ">
						<div class="col-sm-3 ">										
							<?php  esc_html_e('Manage Candidates','jobbank');?>  
						</div>
						<div class="col-sm-7">
							<a href="<?php echo esc_url($page_link); ?>?&profile=new-post">
								<?php echo esc_url($page_link); ?>?&profile=employer_manage_candidates
							</a>										
						</div>
						<div class="col-sm-2">
							<div class="checkbox ">
								<label><?php
									$account_menu_check='';
									if( get_option('epjbjobbank_menunecandidates' ) ) {
										$account_menu_check= get_option('epjbjobbank_menunecandidates'); 
									}	 
								?>
								<input type="checkbox" name="menunecandidates" id="menunecandidates" value="yes" <?php echo ($account_menu_check=='yes'? 'checked':'' ); ?> >  <?php  esc_html_e('Hide','jobbank');?> 
								</label>
							</div>											
						</div>					  
					</div>	
					<hr>
					<div class="row ">
						<div class="col-sm-3 ">										
							<?php  esc_html_e('Message board','jobbank');?>  
						</div>
						<div class="col-sm-7">
							<a href="<?php echo esc_url($page_link); ?>?&profile=messageboard">
								<?php echo esc_url($page_link); ?>?&profile=messageboard
							</a>									
						</div>
						<div class="col-sm-2">
							<div class="checkbox ">
								<label><?php
									$account_menu_check='';
									if( get_option('epjbjobbank_messageboard' ) ) {
										$account_menu_check= get_option('epjbjobbank_messageboard'); 
									}	 
								?>
								<input type="checkbox" name="messageboard" id="messageboard" value="yes" <?php echo ($account_menu_check=='yes'? 'checked':'' ); ?> >  <?php  esc_html_e('Hide','jobbank');?> 
								</label>
							</div>											
						</div>					  
					</div>	
					<hr>
					<div class="row ">
						<div class="col-sm-3 ">										
							<?php  esc_html_e('Notification','jobbank');?>  
						</div>
						<div class="col-sm-7">
							<a href="<?php echo esc_url($page_link); ?>?&profile=notification">
								<?php echo esc_url($page_link); ?>?&profile=notification
							</a>										
						</div>
						<div class="col-sm-2">
							<div class="checkbox ">
								<label><?php
									$account_menu_check='';
									if( get_option('epjbjobbank_notification' ) ) {
										$account_menu_check= get_option('epjbjobbank_notification'); 
									}	 
								?>
								<input type="checkbox" name="notification" id="notification" value="yes" <?php echo ($account_menu_check=='yes'? 'checked':'' ); ?> >  <?php  esc_html_e('Hide','jobbank');?> 
								</label>
							</div>											
						</div>					  
					</div>		
					<hr>
					<div class="row ">
						<div class="col-sm-3 ">										
							<?php  esc_html_e('Candidate Bookmarks','jobbank');?>  
							</div>
						<div class="col-sm-7">
							<a href="<?php echo esc_url($page_link); ?>?&profile=candidate-bookmarks">
								<?php echo esc_url($page_link); ?>?&profile=candidate-bookmarks
							</a>										
						</div>
						<div class="col-sm-2">
							<div class="checkbox ">
								<label><?php
									$account_menu_check='';
									if( get_option('epjbjobbank_candidate_bookmarks' ) ) {
										$account_menu_check= get_option('epjbjobbank_candidate_bookmarks'); 
									}	 
								?>
								<input type="checkbox" name="candidate_bookmarks" id="candidate_bookmarks" value="yes" <?php echo ($account_menu_check=='yes'? 'checked':'' ); ?> >  <?php  esc_html_e('Hide','jobbank');?> 
								</label>
							</div>											
						</div>					  
					</div>		
					<hr>
					<div class="row ">
						<div class="col-sm-3 ">										
							<?php  esc_html_e('Employer Bookmarks','jobbank');?>  
							</div>
						<div class="col-sm-7">
							<a href="<?php echo esc_url($page_link); ?>?&profile=employer_bookmarks">
								<?php echo esc_url($page_link); ?>?&profile=employer_bookmarks
							</a>										
						</div>
						<div class="col-sm-2">
							<div class="checkbox ">
								<label><?php
									$account_menu_check='';
									if( get_option('epjbjobbank_employer_bookmarks' ) ) {
										$account_menu_check= get_option('epjbjobbank_employer_bookmarks'); 
									}	 
								?>
								<input type="checkbox" name="employer_bookmarks" id="employer_bookmarks" value="yes" <?php echo ($account_menu_check=='yes'? 'checked':'' ); ?> >  <?php  esc_html_e('Hide','jobbank');?> 
								</label>
							</div>											
						</div>					  
					</div>		
					
					<hr>
					<div class="row ">
						<div class="col-sm-3 ">										
							<?php  esc_html_e('Job Bookmarks','jobbank');?>  
							</div>
						<div class="col-sm-7">
							<a href="<?php echo esc_url($page_link); ?>?&profile=job_bookmark">
								<?php echo esc_url($page_link); ?>?&profile=job_bookmark
							</a>										
						</div>
						<div class="col-sm-2">
							<div class="checkbox ">
								<label><?php
									$account_menu_check='';
									if( get_option('epjbjobbank_job_bookmarks' ) ) {
										$account_menu_check= get_option('epjbjobbank_job_bookmarks'); 
									}	 
								?>
								<input type="checkbox" name="job_bookmark" id="job_bookmark" value="yes" <?php echo ($account_menu_check=='yes'? 'checked':'' ); ?> >  <?php  esc_html_e('Hide','jobbank');?> 
								</label>
							</div>											
						</div>	
					</div>		
						
		</form>
		<div class="row">					
			<div class="col-md-12">					
				
					
					<div id="update_myaccount_menu-message"></div>					
					<button class="btn btn-info " onclick="return jobbank_update_myaccount_menu();"><?php  esc_html_e('Update','jobbank');?>  </button>
			
			
			</div>
		</div>
	