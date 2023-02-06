<?php
	include('header.php');
?>
<div class="card col-md-6 mb-3">
	<div class="card-body">
		
		<div class="row">
			<div class="col-md-12"><h3 class="page-header"><?php esc_html_e( 'Create New Coupon ', 'jobbank' );?></h3>						
				</div>	
		</div> 
		<form id="coupon_form_iv" name="coupon_form_iv" onsubmit="return false;">
			<div class="form-group ">
				<label for="text" class="col-md-2 control-label"></label>
				<div id="iv-loading"></div>
			</div>	
			<div class="form-group ">
				<label for="text" class="control-label"><?php esc_html_e( 'Coupon Name', 'jobbank' );?></label>				
				<input type="text" class="form-control" name="coupon_name" id="coupon_name" value="">
				
			</div>
			<div class="form-group">
				<label for="text" class="control-label"><?php esc_html_e( 'Discount Type', 'jobbank' );?></label>
				
					<select  name="coupon_type" id ="coupon_type" class="form-control">
						<option value="amount" ><?php esc_html_e( 'Fixed Amount', 'jobbank' );?></option>
						<option value="percentage" ><?php esc_html_e( 'Percentage', 'jobbank' );?></option>
					</select>
				
			</div> 			
			<div class="form-group ">
				<label for="text" class=" control-label"><?php esc_html_e( 'Package Only', 'jobbank' );?></label>
				
					<?php
						global $wpdb, $post;
						$jobbank_pack='jobbank_pack';		
						$sql=$wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type = '%s'",$jobbank_pack);
						$membership_pack = $wpdb->get_results($sql);
						$total_package=count($membership_pack);
						if(sizeof($membership_pack)>0){
							$i=0;
							echo'<select multiple name="package_id" id ="package_id" class="form-control">';
							foreach ( $membership_pack as $row )
							{	
								$recurring= get_post_meta( $row->ID,'jobbank_package_recurring',true);
								$pac_cost= get_post_meta( $row->ID,'jobbank_package_cost',true);
								if($recurring!='on' and $pac_cost!="" ){										
									echo '<option value="'. $row->ID.'" selected >'. $row->post_title.'</option>';
								}
							}	
							echo '</select>';	
						}	
					?>
				
			</div> 
			<div class="form-group ">
				<label for="inputEmail3" class=" control-label"><?php esc_html_e( 'Usage Limit', 'jobbank' );?></label>
				
					<input type="text" class="form-control" id="coupon_count" name="coupon_count" value=""  value="999999">
				
			</div>
			<div class="form-group " >									
				<label for="text" class="control-label"><?php esc_html_e( 'Start Date', 'jobbank' );?></label>
				
					<input type="text"  name="start_date"  readonly   id="start_date" class="form-control ctrl-textbox"  placeholder="<?php esc_attr_e( 'Select Date', 'jobbank' );?>">
				
			</div>							  
			<div class="form-group ">
				<label for="inputEmail3" class=" control-label"><?php esc_html_e( 'Expire Date', 'jobbank' );?></label>
			
					<input type="text" class="form-control" readonly id="end_date" name="end_date" value=""  placeholder="<?php esc_html_e( 'Select Date', 'jobbank' );?>">
				
			</div>
			<div class="form-group ">
				<label for="inputEmail3" class=" control-label"><?php esc_html_e( 'Amount', 'jobbank' );?></label>
			
					<input type="text" class="form-control" id="coupon_amount" name="coupon_amount" value=""  placeholder=" <?php esc_attr_e( 'Coupon number [ no currency or comma ]', 'jobbank' );?>">
				
			</div>	
			<div class="form-group ">
				<label for="inputEmail3" class=" control-label"></label>
				
					<button class="btn btn-info mt-2" onclick="return jobbank_create_coupon();"><?php esc_attr_e( 'Save Coupon', 'jobbank' );?></button>
					<a href="<?php echo ep_jobbank_ADMINPATH; ?>admin.php?page=jobbank-settings&coupons" class="btn btn-info mt-2" ><?php esc_html_e( '<< Back', 'jobbank' );?></a>
				
			</div>	
			
		</form>
		
		<div class=" col-md-12  bs-callout bs-callout-info">		
			<?php esc_html_e( 'Note : Coupon will work on "One Time Payment" only. Coupon will not work on recurring payment and it will not support 100% discount.		', 'jobbank' );?>
		</div>
	</div>						
</div>	 