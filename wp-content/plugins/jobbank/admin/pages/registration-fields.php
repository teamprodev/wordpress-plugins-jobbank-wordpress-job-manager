<?php
	$ii=1;
	global $wp_roles;
	wp_enqueue_style('dataTables-min', ep_jobbank_URLPATH . 'admin/files/css/jquery.dataTables.min.css');	
	wp_enqueue_style('rowReorder-dataTables', ep_jobbank_URLPATH . 'admin/files/css/rowReorder.dataTables.min.css');
	wp_enqueue_style('responsive-dataTables', ep_jobbank_URLPATH . 'admin/files/css/responsive.dataTables.min.css');
	wp_enqueue_script('dataTables', ep_jobbank_URLPATH . 'admin/files/js/jquery.dataTables.js');
	wp_enqueue_script('dataTablesrowReordermin', ep_jobbank_URLPATH . 'admin/files/js/dataTables.rowReorder.min.js');
	wp_enqueue_script('dataTablesresponsivemin', ep_jobbank_URLPATH . 'admin/files/js/dataTables.responsive.min.js');
?> 
<div class="row">
			<div class="col-md-12 table-responsive mb-4">

		<h4><?php esc_html_e('Registration / User Profile Fields','jobbank');?></h4>
		<form id="profile_fields_signup" name="profile_fields_signup" class="form-horizontal" role="form" onsubmit="return false;">
			<table id="all_fieldsdatatable" name="all_fieldsdatatable"  class="display table" width="100%">					
				<thead>
					<tr>
						<th class="width20td"> <?php  esc_html_e('Input Name','jobbank')	;?> </th>
						<th class="width20td"> <?php  esc_html_e('Label','jobbank')	;?> </th>
						<th class="width10td"> <?php  esc_html_e('Type','jobbank')	;?> </th>
						<th class="width10td"> <?php  esc_html_e('Value','jobbank')	;?> <br/>
							<?php  esc_html_e('[Dropdown,checkbox & Radio Button]','jobbank')	;?>
						</th>
						<th class="width15td"> <?php  esc_html_e('User Role','jobbank')	;?> <br/>
							<?php  esc_html_e('[Show on My Account/Profile]','jobbank')	;?> 	
						</th>						
						<th class="width20td"> <?php  esc_html_e('Location & Require','jobbank')	;?></th>
						<th class="width5td"><?php  esc_html_e('Action','jobbank')	;?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<?php  esc_html_e('User Profile Pic Uploader','jobbank');
								$jobbank_signup_profile_pic=get_option('jobbank_signup_profile_pic');
								if($jobbank_signup_profile_pic=='' ){ $jobbank_signup_profile_pic='yes';	}		
							?>
						</td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> <label>
							<input type="checkbox" name="signup_profile_pic" id="signup_profile_pic" value="yes" <?php echo($jobbank_signup_profile_pic=='yes'? 'checked':'' );?> >
							 
							 <?php  esc_html_e('Registration','jobbank');?>
						</label></td>
						<td> </td>						
					</tr>	
					<tr  >
						<td>
							<?php  esc_html_e('Terms CheckBox','jobbank')	;
								$jobbank_payment_terms=get_option('jobbank_payment_terms');
								if($jobbank_payment_terms=='' ){ $jobbank_payment_terms='yes';	}
							?>
						</td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> <label>
							<input type="checkbox" name="jobbank_payment_terms" id="jobbank_payment_terms" value="yes" <?php echo($jobbank_payment_terms=='yes'? 'checked':'' );?> >
							<?php  esc_html_e('Registration','jobbank');?>
						</label>
						
						</td>
						<td> </td>
						
					</tr>	
					<tr  >
						<td>
							<?php  esc_html_e('Coupon Buton','jobbank')	;
								$jobbank_payment_coupon=get_option('_jobbank_payment_coupon');
								if($jobbank_payment_coupon=='' ){ $jobbank_payment_coupon='yes';	}
							?>
						</td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> <label>
							<input type="checkbox" name="jobbank_payment_coupon" id="jobbank_payment_coupon" value="yes" <?php echo($jobbank_payment_coupon=='yes'? 'checked':'' );?> >
							<?php  esc_html_e('Registration','jobbank');?>
						</label></td>
						
						<td> </td>
					</tr>	
					<?php
						
						$default_fields = array();
						$field_set=get_option('jobbank_profile_fields' );
						if($field_set!=""){
							$default_fields=$field_set;
							}else{									
							$default_fields['full_name']='Full Name';	
							$default_fields['tagline']='Tag line';
							$default_fields['company_since']='Estd Since';
							$default_fields['team_size']='Team Size';									
							$default_fields['phone']='Phone Number';
							$default_fields['mobile']='Mobile Number';
							$default_fields['address']='Address';
							$default_fields['city']='City';
							$default_fields['postcode']='Postcode';
							$default_fields['state']='State';
							$default_fields['country']='Country';										
							$default_fields['job_title']='Job title';									
							$default_fields['hourly_rate']='Hourly Rate';
							$default_fields['experience']='Experience';
							$default_fields['age']='Age';
							$default_fields['qualification']='Qualification';								
							$default_fields['gender']='Gender';	
							$default_fields['website']='Website Url';
							$default_fields['description']='About';
						}
						$i=0;								
						$field_type_opt=  get_option( 'jobbank_field_type' );
						if($field_type_opt!=''){
							$field_type=$field_type_opt;
							}else{	
							$field_type= array();
							$field_type['full_name']='text';								
							$field_type['company_since']='datepicker';
							$field_type['team_size']='text';									
							$field_type['phone']='text';
							$field_type['mobile']='text';
							$field_type['address']='text';
							$field_type['city']='text';
							$field_type['postcode']='text';
							$field_type['state']='text';
							$field_type['country']='text';										
							$field_type['job_title']='text';									
							$field_type['hourly_rate']='text';
							$field_type['experience']='textarea';
							$field_type['age']='text';
							$field_type['qualification']='text';								
							$field_type['gender']='radio';	
							$field_type['website']='url';
							$field_type['description']='textarea';									
						}
						$field_type_value= get_option( 'jobbank_field_type_value' );
						if($field_type_value==''){
							$field_type_value=array();
							$field_type_value['gender']=esc_html__('Female,Male,Other', 'jobbank');	
						}
						$field_type_roles=  	get_option( 'jobbank_field_type_roles' );
						$sign_up_array=  get_option( 'jobbank_signup_fields' );
						$myaccount_fields_array=  get_option( 'jobbank_myaccount_fields' );
						$require_array=  get_option( 'jobbank_signup_require' );								
						foreach ( $default_fields as $field_key => $field_value ) {
							$sign_up='';									
							if(isset($sign_up_array[$field_key]) && $sign_up_array[$field_key] == 'yes') {
								$sign_up=$sign_up_array[$field_key] ;
							}
							$require='';
							if(isset($require_array[$field_key]) && $require_array[$field_key] == 'yes') {
								$require=$require_array[$field_key];
							}
							$myaccount_one='';									
							if(isset($myaccount_fields_array[$field_key]) && $myaccount_fields_array[$field_key] == 'yes') {
								$myaccount_one=$myaccount_fields_array[$field_key];
							}
						?>
						<tr  id="wpdatatablefield_<?php echo esc_attr($i);?>">
							<td>
								<input type="text" class="form-control" name="meta_name[]" id="meta_name[]" value="<?php echo esc_attr($field_key); ?>"> 
							</td>
							<td>
								<input type="text" class="form-control" name="meta_label[]" id="meta_label[]" value="<?php echo esc_attr($field_value);?>" >
							</td>
							<td id="inputtypell_<?php echo esc_attr($i);?>">
								<?php $field_type_saved= (isset($field_type[$field_key])?$field_type[$field_key]:'' );?>
								<select class="form-control" name="field_type[]" id="field_type[]">
									<option value="text" <?php echo ($field_type_saved=='text'? "selected":'');?> ><?php esc_html_e('Text','jobbank');?></option>
									<option value="textarea" <?php echo ($field_type_saved=='textarea'? "selected":'');?> ><?php esc_html_e('Text Area','jobbank');?></option>
									<option value="dropdown" <?php echo ($field_type_saved=='dropdown'? "selected":'');?> ><?php esc_html_e('Dropdown','jobbank');?></option>
									<option value="radio" <?php echo ($field_type_saved=='radio'? "selected":'');?> ><?php esc_html_e('Radio button','jobbank');?></option>
									<option value="datepicker" <?php echo ($field_type_saved=='datepicker'? "selected":'');?> ><?php esc_html_e('Date Picker','jobbank');?></option>
									<option value="checkbox" <?php echo ($field_type_saved=='checkbox'? "selected":'');?> ><?php esc_html_e('Checkbox','jobbank');?></option>
									<option value="url" <?php echo ($field_type_saved=='url'? "selected":'');?> ><?php esc_html_e('URL','jobbank');?></option>
								</select>
							</td>
							<td>
								<textarea class="form-control" rows="3" name="field_type_value[]" id="field_type_value[]" placeholder="<?php  esc_html_e('Separated by comma','jobbank');?> "><?php echo esc_attr((isset($field_type_value[$field_key])?$field_type_value[$field_key]:''));?></textarea>
							</td>
							<td id="roleall_<?php echo esc_attr($i);?>">									
								<?php $field_user_role_saved= (isset($field_type_roles[$field_key])?$field_type_roles[$field_key]:'' );
									if($field_user_role_saved==''){$field_user_role_saved=array('all');}
								?>									
								<select name="field_user_role<?php echo esc_attr($i);?>[]" multiple="multiple" class="form-control" size="7">
									<option value="all" <?php echo (in_array('all',$field_user_role_saved)? "selected":'');?>> 
									<?php esc_html_e('All Users','jobbank');?> </option>
									<option value="employer" <?php echo (in_array('employer',$field_user_role_saved)? "selected":'');?>> 
									<?php esc_html_e('Employer','jobbank');?> </option>	
									<option value="candidate" <?php echo (in_array('candidate',$field_user_role_saved)? "selected":'');?>> 
									<?php esc_html_e('Candidate','jobbank');?> </option>		
									<?php										
										foreach ( $wp_roles->roles as $key_role=>$value_role ){?>
										<option value="<?php echo esc_attr($key_role); ?>" <?php echo (in_array($key_role,$field_user_role_saved)? "selected":'');?>> <?php echo esc_html($key_role);?> </option>
										<?php												
										}
									?>
								</select>
							</td>
							
							<td>
								<p>
								<label>
									<input type="checkbox" name="signup<?php echo esc_attr($i); ?>" id="signup<?php echo esc_attr($i); ?>" value="yes" <?php echo($sign_up=='yes'? 'checked':'' );?> >
									
									<?php  esc_html_e('Registration','jobbank')	;?> 
								</label>
								</p>
								<p>
								<label>
									<input type="checkbox" name="myaccountprofile<?php echo esc_attr($i); ?>" id="myaccountprofile<?php echo esc_attr($i); ?>" value="yes" <?php echo ($myaccount_one=='yes'? 'checked':'' );?>  class="text-center">
									
									<?php  esc_html_e('My Account/Profile','jobbank')	;?> 
								</label>
								</p>
								<p>
								<label>
									<input type="checkbox" name="srequire<?php echo esc_attr($i); ?>" id="srequire<?php echo esc_attr($i); ?>" value="yes" <?php echo ($require=='yes'? 'checked':'' );?>  class="text-center">
									<?php  esc_html_e('Require','jobbank')	;?> 
								</label>
								</p>
							</td>
							<td>
								<?php
									if($i>=1){
									?>
									<button class="btn btn-primary btn-sm" onclick="return jobbank_remove_field('<?php echo esc_attr($i); ?>');"><span class="dashicons dashicons-trash"></span></button>
									<?php
									}
								?>
							</td>
						</tr>	
						<?php
							$i++;
						}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th> <?php  esc_html_e('Input Name','jobbank')	;?> </th>
						<th> <?php  esc_html_e('Label','jobbank')	;?> </th>
						<th> <?php  esc_html_e('Type','jobbank')	;?> </th>
						<th> <?php  esc_html_e('Value[Dropdown,checkbox & Radio Button]','jobbank')	;?> </th>
						<th> <?php  esc_html_e('User Role [Show on My Account/Profile]','jobbank')	;?> </th>						
						<th> <?php  esc_html_e('Location & Require','jobbank')	;?></th>
						
						<th><?php  esc_html_e('Action','jobbank')	;?></th>
					</tr>
				</tfoot>
			</table>
			<div id="custom_field_div">
			</div>
			<div class="col-xs-12">
				<div id="success_message_profile"></div>
				<button class="button button-primary" onclick="return jobbank_update_profile_signup_fields();"><?php esc_html_e('Update Fields','jobbank');?> </button>
				<button class="btn btn-warning " onclick="return jobbank_add_field();"><?php esc_html_e('Add More Field','jobbank');?></button>
			</div>
		</form>
	</div>
</div>
<?php
	wp_enqueue_script('eplugins_jobbank-dashboard5', ep_jobbank_URLPATH.'admin/files/js/profile-fields.js', array('jquery'), $ver = true, true );
	wp_localize_script('eplugins_jobbank-dashboard5', 'profile_data', array( 			'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
	'loading_image'		=> '<img src="'.ep_jobbank_URLPATH.'admin/files/images/loader.gif">',
	'redirecturl'	=>  ep_jobbank_ADMINPATH.'admin.php?&page=jobbank-profile-fields',
	'adminnonce'=> wp_create_nonce("admin"),
	'pii'	=>$ii,
	'pi'	=> $i,
	"sProcessing"=>  esc_html__('Processing','jobbank'),
	"sSearch"=>   esc_html__('Search','jobbank'),
	"lengthMenu"=>   esc_html__('Display _MENU_ records per page','jobbank'),
	"zeroRecords"=>  esc_html__('Nothing found - sorry','jobbank'),
	"info"=>  esc_html__('Showing page _PAGE_ of _PAGES_','jobbank'),
	"infoEmpty"=>   esc_html__('No records available','jobbank'),
	"infoFiltered"=>  esc_html__('(filtered from _MAX_ total records)','jobbank'),
	"sFirst"=> esc_html__('First','jobbank'),
	"sLast"=>  esc_html__('Last','jobbank'),
	"sNext"=>     esc_html__('Next','jobbank'),
	"sPrevious"=>  esc_html__('Previous','jobbank'),
	) );
?>	