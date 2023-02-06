<?php
	$jobbank_directory_url=get_option('ep_jobbank_url');
	if($jobbank_directory_url==""){$jobbank_directory_url='job';}
	global $wpdb;
	if(isset($current_user->roles[0]) and $current_user->roles[0]!='administrator'){
		$args['post_author']=$current_user->ID;
	}
	if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
		$sql="SELECT * FROM $wpdb->posts WHERE post_type IN ('".$jobbank_directory_url."')  and post_status IN ('publish','pending','draft' )  ORDER BY `ID` DESC";
		}else{
		$sql="SELECT * FROM $wpdb->posts WHERE post_type IN ('".$jobbank_directory_url."')  and post_author='".$current_user->ID."' and post_status IN ('publish','pending','draft' )  ORDER BY `ID` DESC";
	}
	$authpr_post = $wpdb->get_results($sql);		
?>
<div class="row">
	<div class="col-md-6 pull-right">
	</div>
	<div class="col-md-6 pull-right ">
		<select id="dropdown1" class="form-control mb-3 ">
			<option value=""><?php  esc_html_e('All Jobs ','jobbank');?></option>
			<?php
				$all_job_ids=array();
				foreach ( $authpr_post as $row ){
					$all_job_ids[]=$row->ID;
				?>
				<option value="<?php echo esc_attr($row->post_title); ?>"><?php echo esc_html($row->post_title); ?></option>
				<?php
				}
			?>
		</select>
	</div>
</div>
<div class="list">
	<table id="candidate-manageall" class="table tbl-epmplyer-bookmark  " >
		<thead>			
			<tr >
				<th><?php  esc_html_e('Id','jobbank');?></th>
				<th><?php  esc_html_e('Title','jobbank');?></th>
			</tr>
		</thead>
		<?php
			$jobbank_directory_url='job_apply';
			$args = array(
			'post_type' => $jobbank_directory_url, // enter your custom post type
			'post_status' => 'private',
			'posts_per_page'=> '-1',
			'orderby'=>'date',
			'order'=>'DESC',
			);
			$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) {?>
			<?php
				while ( $the_query->have_posts() ) : $the_query->the_post();
				$dir_data=array();
				$candidate_post_id = get_the_ID();
				$candidate_user_id= $the_query->post->post_author;
				$job_post_id= get_post_meta($candidate_post_id,'apply_jod_id',true);
				if(in_array($job_post_id,$all_job_ids)){
				?>
				<tr  id="all_<?php echo esc_html($candidate_post_id);?>" >
					<td>
						<?php
							echo esc_html($candidate_post_id);
						?>	
					</td>
					<?php
						$post_edit = get_post($job_post_id);	
						$useridmain =get_post_meta($candidate_post_id,'user_id',true);
					?>				
					<td class="d-md-table-cell" >	
						<div class="row mb-3 ">							
							<div class="col-md-12">
								<div class="row mb-2">
									<div class="col-md-2">
										<?php
											$iv_profile_pic_url=get_user_meta($useridmain, 'jobbank_profile_pic_thum',true);
											if($iv_profile_pic_url!=''){ ?>
											<img  src="<?php echo esc_url($iv_profile_pic_url); ?>" class=" img-fluid rounded-logo">
											<?php
												}else{
												echo'<img src="'. ep_jobbank_URLPATH.'assets/images/Blank-Profile.jpg" class="rounded-logo" >';
											}
										?>	
									</div>
									<div class="col-md-10">
										<span class="toptitle-sub">										
											<?php 
												if(get_post_meta($candidate_post_id, 'user_id', true)!=''){
													$userid=get_post_meta($candidate_post_id, 'user_id', true);
													$page_link= get_permalink( $profile_page).'?&id='.$userid;  
													}else{
													$page_link= '#'; 
												}
											?>
											<a href="<?php echo esc_url($page_link);?>">
												<?php														
													if($the_query->post->post_author < 1){
														echo  get_post_meta($candidate_post_id, 'candidate_name', true);
														}else{
														$userinfo_data = get_user_by( 'id', $the_query->post->post_author );
														echo esc_html($userinfo_data->display_name);
													}
												?>
											</a>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="meta-job">
									<span class="location">
										<i class="fa fa-check-circle"></i>
										<?php esc_html_e( 'Applied For : ', 'jobbank' );?>
										<?php
											$job_post_id= esc_attr(get_post_meta($candidate_post_id,'apply_jod_id',true));
											$post_edit = get_post($job_post_id);
										?>
										<a href="<?php echo get_the_permalink($job_post_id); ?>">
											<?php
												echo esc_html($post_edit->post_title);
											?>
										</a>
									</span>
								</div>
								<div class="meta-job">
									<span class="location">
										<i class="fas fa-calendar-day"></i>
										<?php esc_html_e( 'Applied : ', 'jobbank' );?>
										<?php
											echo get_the_time('M d, Y h:m a', $candidate_post_id);
										?>
									</span>
								</div>
								<div class="meta-job">
									<span class="location">
										<i class="fas fa-envelope"></i>
										<?php esc_html_e( 'Email : ', 'jobbank' );?>
										<?php
											if($the_query->post->post_author < 1){
												echo  get_post_meta($candidate_post_id, 'email_address', true);
												}else{
												echo esc_html($userinfo_data->user_email) ;
											}
										?>
									</span>
								</div>
								<div class="meta-job">
									<span class="location">
										<i class="fas fa-phone-volume"></i>
										<?php esc_html_e( 'Phone : ', 'jobbank' );?>
										<?php
											if($the_query->post->post_author < 1){
												echo  get_post_meta($candidate_post_id, 'phone', true);
												}else{
												echo esc_html(get_user_meta($the_query->post->post_author,'phone',true));
											}
										?>
									</span>
								</div>
								<div class="group-button mt-3">
									<?php
										$upload_dir = wp_upload_dir();
										$file_name=get_post_meta($candidate_post_id, 'file_name', true);
										get_post_meta($candidate_post_id, 'apply_jod_id', true);
										$useridpdf=get_post_meta($candidate_post_id, 'user_id', true);
										if(get_post_meta($candidate_post_id, 'user_id', true)!=''){ ?>
										<a target="_blank" href="?&jobbankpdfcv=<?php echo esc_html($useridpdf);?>" class="btn btn-small-ar mb-2" data-toggle="tooltip" title="<?php esc_html_e( 'Print PDF', 'jobbank' );?>"> <i class="far fa-file-alt mr-1"></i><?php esc_html_e( 'PDF', 'jobbank' );?> </a>
										<?php
										}else{?>
										<a target="_blank" href="<?php echo esc_url(get_post_meta($candidate_post_id,'cv_file_url',true)); ?>" class="btn btn-small-ar mb-2" data-toggle="tooltip" title="<?php esc_html_e( 'Print PDF', 'jobbank' );?>"> <i class="far fa-file-alt mr-1"></i><?php esc_html_e( 'PDF', 'jobbank' );?></a>
										<?php
										}
									?>
									<span id="shortlistall<?php echo esc_html($candidate_post_id); ?>">
										<?php
											if( get_post_meta($candidate_post_id, 'jobbank_candidate_shortlisted', true)=='yes'){
											?>
											<button id="" class="btn btn-small-ar mb-2 <?php echo (get_post_meta($candidate_post_id, 'jobbank_candidate_shortlisted', true)=='yes'?' shortlisted':''); ?>" data-toggle="tooltip"  onclick="jobbank_candidate_shortlisted_delete('<?php echo esc_html($candidate_post_id);?>','all')" title="<?php esc_html_e( 'Undo Shortlisted', 'jobbank' );?>" ><i class="fas fa-user-check mr-1"></i><?php esc_html_e( 'Shortlist', 'jobbank' );?><i class="fa-regular fa-circle-check ml-1"></i> </button>
											<?php
												}else{
											?>
											<button id="" class="btn btn-small-ar mb-2 <?php echo (get_post_meta($candidate_post_id, 'jobbank_candidate_shortlisted', true)=='yes'?' shortlisted':''); ?>" data-toggle="tooltip"  onclick="jobbank_candidate_shortlisted('<?php echo esc_html($candidate_post_id);?>','all')" title="<?php esc_html_e( 'Make Shortlisted', 'jobbank' );?>" ><i class="fas fa-user-check mr-1"></i><?php esc_html_e( 'Shortlist', 'jobbank' );?> </button>
											<?php
											}
										?>
									</span>
									<span id="scheduleall<?php echo esc_html($candidate_post_id); ?>">
										<button id="schedulebuttonall<?php echo esc_html($candidate_post_id);?>"class="btn btn-small-ar mb-2 <?php echo (get_post_meta($candidate_post_id, 'candidate_schedule', true)=='yes'?' shortlisted':''); ?>" onclick="jobbank_candidate_meeting_popup('<?php echo esc_html($candidate_post_id);?>')" data-toggle="tooltip" title="<?php esc_html_e( 'Meeting Schedule', 'jobbank' );?>" ><i class="fas fa-user-clock mr-1"></i><?php esc_html_e( 'Meeting', 'jobbank' );?></button>
									</span>
									<button class="btn btn-small-ar mb-2" onclick="jobbank_candidate_email_popup('<?php echo esc_html($candidate_post_id);?>')" ><i class="far fa-envelope mr-1"></i><?php esc_html_e( 'Message', 'jobbank' );?></button>
									<span id="rejectall<?php echo esc_html($candidate_post_id); ?>">
										<?php
											if( get_post_meta($candidate_post_id, 'jobbank_candidate_reject', true)=='yes'){
											?>
											<button class="btn btn-small-ar mb-2 shortlisted" onclick="jobbank_candidate_reject_delete('<?php echo esc_attr($candidate_post_id);?>','all')" data-toggle="tooltip" title="<?php esc_html_e( 'Undo Reject', 'jobbank' );?>"><i class="fas fa-user-times mr-1"></i><?php esc_html_e( 'Reject', 'jobbank' );?><i class="fa-regular fa-circle-check ml-1"></i> </button>
											<?php
												}else{
											?>
											<button class="btn btn-small-ar mb-2" onclick="jobbank_candidate_reject('<?php echo esc_attr($candidate_post_id);?>','all')" data-toggle="tooltip" title="<?php esc_html_e( 'Make Reject', 'jobbank' );?>"><i class="fas fa-user-times mr-1"></i><?php esc_html_e( 'Reject', 'jobbank' );?></button>
											<?php
											}
										?>
									</span>
									<button class="btn btn-small-ar mb-2" onclick="jobbank_candidate_delete('<?php echo esc_attr($candidate_post_id);?>','all')" data-toggle="tooltip" title="<?php esc_html_e( 'Delete', 'jobbank' );?>"><i class="far fa-trash-alt mr-1"></i><?php esc_html_e( 'Delete', 'jobbank' );?></button>
								</div>
							</div>
						</div>
					</td>
				</tr>	
				<?php
				}
				endwhile;
			?>
			<?php
			}
			wp_reset_query();
		?>
	</table>
</div>			