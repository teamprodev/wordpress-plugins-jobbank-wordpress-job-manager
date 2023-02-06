<?php
	$profile_url=get_permalink();
	global $current_user;
	$user = $current_user->ID;
	$message='';
	if(isset($_GET['delete_id']))  {
		$post_id=sanitize_text_field($_GET['delete_id']);
		$post_edit = get_post($post_id);
		if($post_edit){
			if($post_edit->post_author==$current_user->ID){
				wp_delete_post($post_id);
				delete_post_meta($post_id,true);
				$message=esc_html__("Deleted Successfully",'jobbank');
			}
			if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
				wp_delete_post($post_id);
				delete_post_meta($post_id,true);
				$message=esc_html__("Deleted Successfully",'jobbank');
			}
		}
	}
	$jobbank_directory_url=get_option('ep_jobbank_url');
	if($jobbank_directory_url==""){$jobbank_directory_url='job';}
	$main_class = new eplugins_jobbank;
?>

<div class="mt-3 row ">	
	<div class="col-md-6">
		<span class="toptitle-sub"><?php esc_html_e('My Job Listings', 'jobbank'); ?></span>
	</div>
	<div class="col-md-6">
		<ul class="nav nav-pills  float-right" id="pills-tab" role="tablist">
			<li class="nav-item">
				 <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#tab_all" role="tab" aria-controls="pills-home" aria-selected="true"><?php    esc_html_e('All Jobs','jobbank')	;?></a>
			</li>
			<li class="nav-item">
				 <a class="nav-link " id="pills-add-tab" data-toggle="pill" href="#tab_add_new" role="tab" aria-controls="pills-home" ><?php    esc_html_e('Add New','jobbank')	;?></a>
				 
				
			</li>
			
		</ul>
	</div>
	<div class="col-md-12"> <p class="border-bottom"> </p></div>
</div>		

	
<div class="clearfix mb-3"></div>
<div class="tab-content">
	<div class="tab-pane active" id="tab_all">
			<div class="list">
			<?php
				global $wpdb;
				$per_page=10;$row_strat=0;$row_end=$per_page;
				$current_page=0 ;
				if(isset($_REQUEST['cpage']) and $_REQUEST['cpage']!=1 ){
					$current_page=$_REQUEST['cpage']; $row_strat =($current_page-1)*$per_page;
					$row_end=$per_page;
				}
				if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
					$sql="SELECT * FROM $wpdb->posts WHERE post_type IN ('".$jobbank_directory_url."')  and post_status IN ('publish','pending','draft' )  ORDER BY `ID` DESC";
					}else{
					$sql="SELECT * FROM $wpdb->posts WHERE post_type IN ('".$jobbank_directory_url."')  and post_author='".$current_user->ID."' and post_status IN ('publish','pending','draft' )  ORDER BY `ID` DESC";
				}
				$authpr_post = $wpdb->get_results($sql);
				$total_post=count($authpr_post);
				if($total_post>0){
				?>
				<table id="job-manage" class="table tbl-job" >
					<thead>
						<tr class="">
							<th><?php  esc_html_e('Title','jobbank');?></th>
						</tr>
					</thead>
					<?php
						$i=0;
						foreach ( $authpr_post as $row )
						{
						?>
						<tr class="my-job-item">
							<td>
								<div class="align-item-center row">
									<div class="text-left col-md-9 col-9">
										<span class="toptitle-sub"><a href="<?php echo get_permalink($row->ID); ?>"><?php echo esc_html($row->post_title); ?></a></span>
										<div class="meta-job"><span class="location"> 
										
										<i class="fas fa-calendar-alt"></i>
											<?php  esc_html_e('Posted','jobbank');?>
										<?php echo date('M d, Y',strtotime($row->post_date)); ?>
										<?php
											$exp_date= get_user_meta($current_user->ID, 'job_exprie_date', true);
											if($exp_date!=''){
												$package_id=get_user_meta($current_user->ID,'jobbank_package_id',true);
												$dir_hide= get_post_meta($package_id, 'jobbank_package_hide_exp', true);
												if($dir_hide=='yes'){?>
												<span> <i class="fas fa-calendar-alt"></i>		
													<?php
														esc_html_e('Expiring','jobbank'); echo" : ";
														echo date('M d, Y',strtotime($exp_date));
													}?>
											</span>
											<?php
											}
										?>
										</span>
										</div>
										<?php
											if(get_post_meta($row->ID,'salary', true)!=''){
											?>
											<div class="location"><i class="fas fa-money-bill-alt"></i>
												<?php echo get_post_meta($row->ID,'salary', true); ?>
											</div>
											<?php
											}
										?>
										<div class="location">
											<span class="number-application"><i class="fas fa-folder-open"></i> 
												<?php
													echo esc_html($main_class ->jobbank_total_applications_count($row->ID));
												?>
												<?php  esc_html_e('Applications','jobbank');?> 
											</span>
											<?php
												if(get_post_meta($row->ID,'job_type', true)!=''){
												?>
												<span> <?php echo esc_html(get_post_meta($row->ID,'job_type', true)); ?> </span>
												<?php
												}
											?>
											
										</div>
										<div class="location">
											<i class="fas fa-eye"></i>
											<?php  esc_html_e('View Count','jobbank');?> :
											<?php echo esc_attr(get_post_meta($row->ID,'job_views_count',true)); ?> 												
										</div>
										<span class="poststatus ">
												<?php $post_ststus=get_post_status($row->ID);  
												echo ucfirst($post_ststus);  ?>
										</span>
									</div>
									<div class="job-func_manage_job col-md-3 col-3 text-right">
										<?php
											$edit_post= $profile_url.'?&profile=post-edit&post-id='.$row->ID;
										?>
										<a href="<?php echo esc_url($edit_post); ?>"  class="btn btn-small-ar mb-2" ><i class="fas fa-pencil-alt"></i></a>
										<a href="<?php echo esc_url($profile_url).'?&profile=all-post&delete_id='.$row->ID ;?>"  onclick="return confirm('Are you sure to delete this post?');"  class="btn btn-small-ar mb-2"><i class="far fa-trash-alt"></i>
										</a>
									</div>
								</div>
							</td>
						</tr>
						<?php
						}
					?>
				</table>
				<?php
				}
			?>
		</div>
	
	</div>
	<div class="tab-pane" id="tab_add_new">
		<?php
		include( ep_jobbank_template. 'private-profile/profile-new-post-1.php');
		?>
	</div>
</div>	
