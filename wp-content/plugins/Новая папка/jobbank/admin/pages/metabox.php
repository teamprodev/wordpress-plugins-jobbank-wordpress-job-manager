<div class="bootstrap-wrapper">
 	<div class="dashboard-eplugin container-fluid">
 		<?php	
			global $wpdb, $post,$current_user;	
			//*************************	plugin file *********
			$jobbank_approve= get_post_meta( $post->ID,'jobbank_approve', true );
			$jobbank_current_author= $post->post_author;
			$userId=$current_user->ID;
			if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
			?>
			<div class="row">
				<div class="col-md-12">
					<?php esc_html_e( 'User ID :', 'jobbank' )?>
					<select class="form-control" id="jobbank_author_id" name="jobbank_author_id">
						<?php	
							$sql="SELECT * FROM $wpdb->users ";		
							$products_rows = $wpdb->get_results($sql); 	
							if(sizeof($products_rows)>0){									
								foreach ( $products_rows as $row ) 
								{	
									echo '<option value="'.$row->ID.'"'. ($jobbank_current_author == $row->ID ? "selected" : "").' >'. $row->ID.' | '.$row->user_email.' </option>';
								}
							}	
						?>
					</select>
				</div>  
				<div class="col-md-12"> <label>
					<input type="checkbox" name="jobbank_approve" id="jobbank_approve" value="yes" <?php echo ($jobbank_approve=="yes" ? 'checked': "" )  ; ?> />  <strong><?php esc_html_e( 'Approve', 'jobbank' )?></strong>
				</label>
				</div> 
			</div>	  
			<?php
			}
		?>
 		<br/>
		<div class="row">
 			<div class="col-md-12">
				<label>
					<?php
						$jobbank_featured= get_post_meta( $post->ID,'jobbank_featured', true );
					?>
					<label><input type="radio" name="jobbank_featured" id="jobbank_featured" value="featured" <?php echo ($jobbank_featured=="featured" ? 'checked': "" )  ; ?> />  <strong><?php esc_html_e( 'Featured (display on top)', 'jobbank' )?></strong></label>
					<br/>
					<label><input type="radio" name="jobbank_featured" id="jobbank_featured" value="Not-featured" <?php echo ($jobbank_featured=="Not-featured" ? 'checked': "" )  ; ?> />  <strong><?php esc_html_e( 'Not Featured', 'jobbank' )?></strong></label>
				</label>
			</div>
		</div>		
	</div>
</div>		