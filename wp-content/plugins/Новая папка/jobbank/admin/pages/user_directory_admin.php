<?php
	wp_enqueue_style('dataTables-min', ep_jobbank_URLPATH . 'admin/files/css/jquery.dataTables.min.css');	
	wp_enqueue_style('rowReorder-dataTables', ep_jobbank_URLPATH . 'admin/files/css/rowReorder.dataTables.min.css');
	wp_enqueue_style('responsive-dataTables', ep_jobbank_URLPATH . 'admin/files/css/responsive.dataTables.min.css');
	wp_enqueue_script('dataTables', ep_jobbank_URLPATH . 'admin/files/js/jquery.dataTables.js');
	wp_enqueue_script('dataTablesrowReordermin', ep_jobbank_URLPATH . 'admin/files/js/dataTables.rowReorder.min.js');
	wp_enqueue_script('dataTablesresponsivemin', ep_jobbank_URLPATH . 'admin/files/js/dataTables.responsive.min.js');
	
	
?> 

<div class="bootstrap-wrapper">
	<div class="dashboard-eplugin container-fluid">
		
		<div class="row">
			<div class="col-md-12 table-responsive">
			<?php
				$no=20000;
				$paged = (isset($_REQUEST['paged'])) ? $_REQUEST['paged'] : 1;
				if($paged==1){
					$offset=0;
					}else {
					$offset= ($paged-1)*$no;
				}
				$args = array();
				$args['number']='99999999';		
				$args['orderby']='registered';
				$args['order']='DESC';
				$user_query = new WP_User_Query( $args );
			?>
			
			<table id="user-data" class="display nowrap "  >
				<thead>
					<tr>
						<th> <?php  esc_html_e('ID','jobbank')	;?> </th>
						<th> <?php  esc_html_e('Create Date','jobbank')	;?> </th>
						<th> <?php  esc_html_e('User Name','jobbank')	;?></th>
						<th> <?php  esc_html_e('Email','jobbank')	;?> </th>
						<th> <?php  esc_html_e('Expiry Date','jobbank')	;?> </th>
						<th> <?php  esc_html_e('Payment Status','jobbank')	;?> </th>
						<th> <?php  esc_html_e('Role','jobbank')	;?> </th>
						<th> <?php  esc_html_e('Type','jobbank')	;?> </th>
						<th><?php  esc_html_e('Action','jobbank')	;?></th>
					</tr>
				</thead>
				<tbody>
					<?php
						// User Loop
						if ( ! empty( $user_query->results ) ) {
							foreach ( $user_query->results as $user ) {
								
							?>
							<tr>
								<td><?php echo esc_html($user->ID); ?></td>
								<td><?php echo date("d-M-Y h:m:s A" ,strtotime($user->user_registered) ); ?></td>
								<td><?php echo esc_attr(get_user_meta($user->ID, 'first_name', true)).' '.esc_attr(get_user_meta($user->ID, 'last_name', true)).' ('. $user->display_name.')'; ?></td>
								<td><?php echo esc_html($user->user_email); ?></td>
								<td><?php
									$exp_date= get_user_meta($user->ID, 'jobbank_exprie_date', true);
									if($exp_date!=''){
										echo date('d-M-Y',strtotime($exp_date));
									}
								?></td>
								<td>
									<?php
										echo esc_attr(get_user_meta($user->ID, 'jobbank_payment_status', true));
									?>
								</td>
								<td><?php
									if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
										foreach ( $user->roles as $role )
										echo ucfirst($role);
									}
								?>
								</td>
								<td>
									<?php  echo ucwords(esc_attr(get_user_meta($user->ID, 'user_type', true)));?>
								</td>
								<td>		
								<a class="btn btn-primary btn-xs" href="?page=jobbank-user_update&id=<?php echo esc_attr($user->ID); ?>"><span class="dashicons dashicons-edit"></span></a>
								
								
									
									<?php 
									$user_type=get_user_meta($user->ID, 'user_type',true);
									$profile_page=get_option('epjbjobbank_candidate_public_page');
									
									if(get_user_meta($user->ID, 'user_type',true)=='employer'){
										$profile_page=get_option('epjbjobbank_employer_public_page');
									}
									if(get_user_meta($user->ID, 'user_type',true)=='candidate'){
										$profile_page=get_option('epjbjobbank_candidate_public_page');
									}
									
									$page_link= get_permalink( $profile_page).'?&id='.$user->ID; 
								?>
							<a  href="<?php echo esc_url($page_link); ?>" target="_blank" class="btn btn-info btn-sm ">
								<span class="dashicons dashicons-visibility"></span><?php esc_html_e(' Profile','jobbank'); ?> </a>
							<a class="btn btn-danger btn-xs" href="<?php echo admin_url().'/users.php'?>"><span class="dashicons dashicons-trash"></span></a>
								</td>
							</tr>
							<?php
							}
						}
					?>
				</tbody>
			</table>
		
		
			</div>
		</div>
	</div>
</div>