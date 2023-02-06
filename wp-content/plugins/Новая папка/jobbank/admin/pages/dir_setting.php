<div id="update_message"> </div>		 
<form class="form-horizontal" role="form"  name='directory_settings' id='directory_settings'>
	<?php
		$jobbank_archive_layout=get_option('jobbank_archive_layout');	
		if($jobbank_archive_layout==""){$jobbank_archive_layout='archive-left-map';}	
	?>
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Default All Listing Page Layout','jobbank');  ?></label>
		<div class="col-md-2">
			<label>												
				<input type="radio" name="jobbank_archive_layout" id="jobbank_archive_layout" value='archive-left-map' <?php echo ($jobbank_archive_layout=='archive-left-map' ? 'checked':'' ); ?> > <?php esc_html_e( 'Listing + Left Map', 'jobbank' );?>  
			</label>	
		</div>
		<div class="col-md-2">	
			<label>											
				<input type="radio"  name="jobbank_archive_layout" id="jobbank_archive_layout" value='archive-top-map' <?php echo ($jobbank_archive_layout=='archive-top-map' ? 'checked':'' );  ?> > <?php esc_html_e( 'Listing + Top Map', 'jobbank' );?>
			</label>
		</div>	
		<div class="col-md-2">	
			<label>											
				<input type="radio"  name="jobbank_archive_layout" id="jobbank_archive_layout" value='archive-no-map' <?php echo ($jobbank_archive_layout=='archive-no-map' ? 'checked':'' );  ?> > <?php esc_html_e( 'Listing Without Map', 'jobbank' );?>
			</label>
		</div>		
	</div>	
	<?php
		$jobbank_user_can_publish=get_option('jobbank_user_can_publish');	
		if($jobbank_user_can_publish==""){$jobbank_user_can_publish='yes';}	
	?>
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Publish Listing','jobbank');  ?></label>
		<div class="col-md-2">
			<label>												
				<input type="radio" name="jobbank_user_can_publish" id="jobbank_user_can_publish" value='yes' <?php echo ($jobbank_user_can_publish=='yes' ? 'checked':'' ); ?> > <?php esc_html_e( 'Admin will Publish', 'jobbank' );?>  
			</label>	
		</div>
		<div class="col-md-2">	
			<label>											
				<input type="radio"  name="jobbank_user_can_publish" id="jobbank_user_can_publish" value='no' <?php echo ($jobbank_user_can_publish=='no' ? 'checked':'' );  ?> > <?php esc_html_e( 'All user can publish', 'jobbank' );?>
			</label>
		</div>	
	</div>
	<?php
		$listing_hide=get_option('jobbank_listing_hide_opt');	
		if($listing_hide==""){$listing_hide='package';}	
	?>
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Listing hide','jobbank');  ?></label>
		<div class="col-md-2">
			<label>												
				<input type="radio" name="listing_hide" id="listing_hide" value='package' <?php echo ($listing_hide=='package' ? 'checked':'' ); ?> > <?php esc_html_e( 'When User Package Expire ', 'jobbank' );?>  
			</label>	
		</div>
		<div class="col-md-2">	
			<label>											
				<input type="radio"  name="listing_hide" id="listing_hide" value='deadline' <?php echo ($listing_hide=='deadline' ? 'checked':'' );  ?> > <?php esc_html_e( 'After Deadline of listing', 'jobbank' );?>
			</label>
		</div>	
		<div class="col-md-2">	
			<label>											
				<input type="radio"  name="listing_hide" id="listing_hide" value='admin' <?php echo ($listing_hide=='admin' ? 'checked':'' );  ?> > <?php esc_html_e( 'Admin will hide/delete', 'jobbank' );?>
			</label>
		</div>	
		
	</div>
	
	<?php											
		$opt_style=	get_option('jobbank_archive_template');
		
	?>	
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Default listing Image','jobbank');  ?> 
		</label>
		<div class="col-md-2" id="listing_defaultimage">
				<?php
					if(get_option('jobbank_listing_defaultimage')!=''){
						$default_image= wp_get_attachment_image_src(get_option('jobbank_listing_defaultimage'));
						if(isset($default_image[0])){									
							$default_image=$default_image[0] ;
						}
						}else{
							$default_image=ep_jobbank_URLPATH."/assets/images/default-directory.jpg";
						}
					?>
				<img class="w80"   src="<?php echo esc_url($default_image);?>">
				
		</div>
		<div class="col-md-5">	
			
				<input type="hidden" name="jobbank_listing_defaultimage" id="jobbank_listing_defaultimage" >
				<button type="button" onclick="return  jobbank_listing_defaultimage_fun();" class="btn btn-primary btn-xs mt-1"><?php esc_html_e('Set Image','jobbank');  ?></button>			
				<p><?php esc_html_e('Best Fit 450px X 350px','jobbank');  ?> </p>
		</div>
	</div>
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Default Location Image','jobbank');  ?> 
		</label>
		<div class="col-md-2" id="location_defaultimage">
			<?php
					if(get_option('jobbank_location_defaultimage')!=''){
						$default_image= wp_get_attachment_image_src(get_option('jobbank_location_defaultimage'));
						if(isset($default_image[0])){									
							$default_image=$default_image[0] ;
						}
						}else{
							$default_image=ep_jobbank_URLPATH."/assets/images/location.jpg";
						}
					?>
				<img class="w80"   src="<?php echo esc_url($default_image);?>">
				
		</div>
		<div class="col-md-5">	
				<input type="hidden" name="jobbank_location_defaultimage" id="jobbank_location_defaultimage" >
				<button type="button" onclick="return  jobbank_location_defaultimage_fun();" class="btn btn-primary btn-xs mt-1"><?php esc_html_e('Set Image','jobbank');  ?></button>	
				<p><?php esc_html_e('Best Fit 300px X 400px','jobbank');  ?> </p>
		</div>
	</div>
	
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Default Category Image','jobbank');  ?> 
		</label>
		<div class="col-md-2" id="category_defaultimage">
					<?php
					if(get_option('jobbank_category_defaultimage')!=''){
						$default_image= wp_get_attachment_image_src(get_option('jobbank_category_defaultimage'));
						if(isset($default_image[0])){									
							$default_image=$default_image[0] ;
						}
						}else{
							$default_image=ep_jobbank_URLPATH."/assets/images/category.png";
						}
					?>
				<img class="w80"  src="<?php echo esc_url($default_image);?>">
				
		</div>
		<div class="col-md-5">	
				<input type="hidden" name="jobbank_category_defaultimage" id="jobbank_category_defaultimage" >										
				<button type="button" onclick="return  jobbank_category_defaultimage_fun();" class="btn btn-primary btn-xs mt-1"><?php esc_html_e('Set Image','jobbank');  ?></button>			
				<p><?php esc_html_e('Best Fit 400px X 400px','jobbank');  ?> </p>
		</div>
	</div>
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Default Listing Banner Image','jobbank');  ?> 
		</label>
		<div class="col-md-2" id="banner_defaultimage">
			<?php
					if(get_option('jobbank_banner_defaultimage')!=''){
						$default_image= wp_get_attachment_image_src(get_option('jobbank_banner_defaultimage'));
					if(isset($default_image[0])){									
						$default_image=$default_image[0] ;
					}
					}else{
						$default_image=ep_jobbank_URLPATH."/assets/images/banner.png";
					}
					?>
				<img class="w80"   src="<?php echo esc_url($default_image);?>">
				
		</div>
		
		<div class="col-md-5">	
			
				<input type="hidden" name="jobbank_banner_defaultimage" id="jobbank_banner_defaultimage" >
				<button type="button" onclick="return  jobbank_banner_defaultimage_fun();" class="btn btn-primary btn-xs mt-1"><?php esc_html_e('Set Image','jobbank');  ?></button>	
				<p><?php esc_html_e('Best Fit 1200px X 400px','jobbank');  ?> </p>
			
		</div>
	</div>
	
	<div class="form-group row">
		<?php
			$dir_style5_perpage='20';						
			$dir_style5_perpage=get_option('jobbank_dir_perpage');	
			if($dir_style5_perpage==""){$dir_style5_perpage=20;}
		?>	
		<label  class="col-md-3 control-label">	<?php esc_html_e('Load Per Page','jobbank');  ?> </label>					
		<div class="col-md-2">																	
			<input  class="form-control" type="input" name="jobbank_dir_perpage" id="jobbank_dir_perpage" value='<?php echo esc_attr($dir_style5_perpage); ?>'>
		</div>						
	</div>

	<?php
		$jobbank_url=get_option('ep_jobbank_url');					
		if($jobbank_url==""){$jobbank_url='job';}
	?>
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Custom Post Type','jobbank');  ?></label>					
		<div class="col-md-2">													
				<input  class="form-control"  type="input" name="jobbank_url" id="jobbank_url" value='<?php echo esc_attr($jobbank_url); ?>' >
			
		</div>
		<div class="col-md-5">
			<?php esc_html_e('No special characters, no upper case, no space','jobbank');  ?>
		</div>
	</div>
	<hr>
	

	
	<div class="form-group row">
		<label  class="col-md-3 control-label"> </label>
		<div class="col-md-8">
			<div id="update_message49"> </div>	
			<button type="button" onclick="return  jobbank_update_dir_setting();" class="button button-primary"><?php esc_html_e('Save & Update','jobbank');  ?></button>
		</div>
	</div>
</form>