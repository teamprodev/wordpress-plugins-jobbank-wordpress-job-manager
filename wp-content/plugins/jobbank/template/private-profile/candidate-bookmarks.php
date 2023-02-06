<div class="border-bottom pb-15 mb-3 toptitle-sub"><?php esc_html_e('Saved Candidate', 'jobbank'); ?>	
</div>		
<section class="content-main-right list-jobs mb-30">
	<div class="list">
		<?php
			$favorites=get_user_meta(get_current_user_id(),'jobbank_profilebookmark', true);	
			$favorites_a = array();
			$favorites_a = explode(",", $favorites);	
			$profile_page=get_option('epjbjobbank_candidate_public_page');
			$ids = array_filter($favorites_a);		
			if(sizeof($favorites_a)>0){
			?>
			<table id="candidate-bookmark" class="table tbl-epmplyer-bookmark" >
				<thead>
					<tr class="">
						<th><?php  esc_html_e('Title','jobbank');?></th>
					</tr>
				</thead>
				<?php
					$i=0;
					foreach ($ids as $user_id){	 
						if((int)$user_id>0){
							$page_link= get_permalink( $profile_page).'?&id='.$user_id; 
							$user_data = get_user_by( 'ID', $user_id );
							$user_id=trim($user_id);
						?>
						<tr id="candidatebookmark_<?php echo esc_html(trim($user_id));?>" >
							<td class="d-md-table-cell">
								<div class="job-item bookmark">
									<div class="row align-items-center">
										<div class="col-md-2">
											<div class="img-job text-center circle">												
												<a href="<?php  echo esc_url($page_link); ?>">
													<?php
														$iv_profile_pic_url=get_user_meta($user_id, 'jobbank_profile_pic_thum',true);
														if($iv_profile_pic_url!=''){ ?>
														<img  class="rounded-profileimg" src="<?php echo esc_url($iv_profile_pic_url); ?>">
														<?php
															}else{
															echo'<img src="'. ep_jobbank_URLPATH.'assets/images/Blank-Profile.jpg" class="rounded-logo" >';
														}
													?>
												</a>
											</div>
										</div>
										<div class="col-md-10 job-info px-0">
											<div class="text px-0 text-left">
												<span class="toptitle-sub"><a href="<?php  echo esc_url($page_link); ?>">
													<?php echo (get_user_meta($user_id,'full_name',true)!=''? get_user_meta($user_id,'full_name',true) : $user_data->display_name ); ?>
												</a></span>
												<?php
													if(get_user_meta($user_id,'qualification',true)!=''){
													?>					
													<div class="location"><span > <?php echo esc_html(get_user_meta($user_id,'qualification',true)); ?></span>
													</div>
													<?php
													}
													if(get_user_meta($user_id,'address',true)!=''){
													?>
													<div class="date-job"><span class="location"><i class="far fa-map"></i><span class="p-2"><?php echo esc_html(get_user_meta($user_id,'address',true)); ?> <?php echo esc_html(get_user_meta($user_id,'city',true)); ?>, <?php echo esc_html(get_user_meta($user_id,'zipcode',true)); ?>,<?php echo esc_html(get_user_meta($user_id,'country',true)); ?></span></span>
													</div>
													<?php
													}
												?>
												<?php
													if(get_user_meta($user_id,'hourly_rate',true)!=''){
													?>
													<div class="date-job"><span class="location"><i class="far fa-money-bill-alt"></i><span class="p-2"><?php echo esc_html(get_user_meta($user_id,'hourly_rate',true)); ?></span></span>
													</div>
													<?php
													}
												?>
												<div class="group-button">	
													<a class="btn btn-small-ar" target="_blank" href="?&jobbankpdfcv=<?php echo esc_attr(trim($user_id));?>"> <i class="far fa-file-alt"></i></a>
													<button class="btn btn-small-ar" onclick="jobbank_candidate_email_popup('<?php echo esc_attr(trim($user_id));?>')" ><i class="far fa-envelope"></i></button>
													<button class="btn btn-small-ar" onclick="jobbank_candidate_bookmark_delete_myaccount('<?php echo esc_attr($user_id);?>','candidatebookmark')"><i class="far fa-trash-alt"></i></button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<?php
						}
					}
				?>
			</table>
			<?php
			}
		?>
	</div>
</section>