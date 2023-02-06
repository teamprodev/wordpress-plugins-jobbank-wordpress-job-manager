<?php	
	wp_enqueue_style('dataTables', ep_jobbank_URLPATH . 'admin/files/css/jquery.dataTables.css');
	wp_enqueue_script('dataTables', ep_jobbank_URLPATH . 'admin/files/js/jquery.dataTables.js');
	global $post;
?> 

<div class="bootstrap-wrapper">
	<div class="dashboard-eplugin container-fluid">		
		<div class="table-responsive">
			<?php
				
			$args = array(
			'post_type' => 'iv_payment', // enter your custom post type
			'post_status' => 'publish',
			'posts_per_page'=> '9999999999',
			'orderby' => 'date',
			'order'   => 'DESC',
			);							
			$the_query = new WP_Query( $args );
			
			?>
			<table id="user_payment_history" class="display table" width="100%">
				<thead>
					<tr>
						<th> <?php  esc_html_e('Package Name','jobbank')	;?> </th>
						<th> <?php  esc_html_e('Date','jobbank')	;?> </th>
						<th> <?php  esc_html_e('User Name','jobbank')	;?></th>
						<th> <?php  esc_html_e('User ID','jobbank')	;?> </th>
						<th> <?php  esc_html_e('Amount','jobbank')	;?> </th>
					
					</tr>
				</thead>
				<tbody>
					<?php
						// User Loop
						if ( $the_query->have_posts() ) :
							while ( $the_query->have_posts() ) : $the_query->the_post();									
							?>
							<tr>
								<td><?php
									$user_info = get_userdata( $post->post_author);
									if($user_info!='' ){
										echo  esc_html($user_info->user_login);
									}
									
									 ?>
									</td>
								<td><?php echo get_the_date('M d, Y : h i a', $post->date);  ?></td>
								<td><?php echo esc_html($post->post_author);  ?></td>
								<td><?php echo esc_html($user_info->user_email); ?></td>
								<td><?php
									echo esc_html($post->post_content);
								?></td>
								
								
							</tr>
							<?php
						endwhile;
					endif;
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>