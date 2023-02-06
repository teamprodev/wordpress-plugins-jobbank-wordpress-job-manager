<?php
	$dir_map_api=get_option('epjbdir_map_api');	
	if($dir_map_api==""){$dir_map_api='';}	
?>
<form class="form-horizontal" role="form"  name='map_settings' id='map_settings'>	
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Google Map & Places API Key','jobbank');  ?>
			<br/><small><?php esc_html_e('Please set your own google map API key for your site( default key is for only demo)
			','jobbank');  ?> </small>
		</label>
		<div class="col-md-8">																		
			<input class="col-md-12 form-control" type="text" name="dir_map_api" id="dir_map_api" value='<?php echo esc_attr($dir_map_api); ?>' >
			<a  class="col-md-12" href="<?php echo esc_url('https://developers.google.com/maps/documentation/javascript/get-api-key');?>">https://developers.google.com/maps/documentation/javascript/get-api-key  <?php esc_html_e( 'Get your Google Maps API Key here.', 'jobbank' );?>     </a>
		</div>
	</div>
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Map Zoom','jobbank');  ?></label>
		<?php
			$dir_map_zoom=get_option('epjbdir_map_zoom');	
			if($dir_map_zoom==""){$dir_map_zoom='7';}	
		?>
		<div class="col-md-3">													
			<input  class="form-control" type="text" name="dir_map_zoom" id="dir_map_zoom" value='<?php echo esc_attr($dir_map_zoom); ?>' >
				<?php esc_html_e('20 is more Zoom, 1 is less zoom','jobbank');  ?> 
				
		</div>
		
	</div>
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Map Type','jobbank');  ?></label>
		<div class="col-md-6">
			<?php
				$dir_map_type=get_option('epjbdir_map_type');	
				if($dir_map_type==""){$dir_map_type='OpenSteet';}	
			?>
			<select id='map_type' name='map_type' class='form-control'>
				<option value="google-map" <?php echo ($dir_map_type=='google-map'?' selected':''); ?>><?php esc_html_e('Google Map','jobbank');  ?></option>
				<option value="opensteet-map" <?php echo ($dir_map_type=='opensteet-map'?' selected':''); ?> ><?php esc_html_e('OpenSteet Map','jobbank');  ?></option>
			</select>
		</div>
		<div class="col-md-2">
			<label>	
			</label>	
		</div>
	</div>
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Map Radius','jobbank');  ?></label>
		<div class="col-md-6">
			<?php
				$epjbdir_map_radius=get_option('epjbdir_map_radius');	
				if($epjbdir_map_radius==""){$epjbdir_map_radius='Km';}	
			?>
			<select id='epjbdir_map_radius' name='epjbdir_map_radius' class='form-control'>
				<option value="Km" <?php echo ($epjbdir_map_radius=='Km'?' selected':''); ?>><?php esc_html_e('Km','jobbank');  ?></option>
				<option value="Mile" <?php echo ($epjbdir_map_radius=='Mile'?' selected':''); ?> ><?php esc_html_e('Mile','jobbank');  ?></option>
			</select>
		</div>
		<div class="col-md-2">
			<label>	
			</label>	
		</div>
	</div>
	
	
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Search Box Near to Me','jobbank');  ?></label>
		<div class="col-md-3">
			<?php
				$jobbank_near_to_me=get_option('jobbank_near_to_me');	
				if($jobbank_near_to_me==""){$jobbank_near_to_me='50';}	
			?>
			<input  class="form-control" type="text" name="jobbank_near_to_me" id="jobbank_near_to_me" value='<?php echo esc_attr($jobbank_near_to_me); ?>' >
		</div>
		<div class="col-md-2">
			<label>	
			</label>	
		</div>
	</div>
	
	
	
	
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Force Default Location','jobbank');  ?>			
			</label>
		<div class="col-md-3">			<?php
				$jobbank_forcelocation=get_option('jobbank_forcelocation');					
			?>
			<label class="switch">
			  <input name="jobbank_forcelocation" type="checkbox" value="forcelocation"  <?php echo ($jobbank_forcelocation=='forcelocation' ? ' checked':'');  ?> >
			  <span class="slider round"></span>
			</label>
		</div>		
	</div>
	
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Default Latitude','jobbank');  ?>			
			</label>
		<div class="col-md-3">			<?php
				$jobbank_defaultlatitude=get_option('jobbank_defaultlatitude');					
			?>
			<input  class="form-control" type="text" name="jobbank_defaultlatitude" id="jobbank_defaultlatitude" value='<?php echo esc_attr($jobbank_defaultlatitude); ?>' >
		</div>
		<div class="col-md-4">
			<label>	<a href="<?php echo esc_url('https://www.maps.ie/coordinates.html');?>" target="_blank" >
				<?php esc_html_e('You can find latitude here','jobbank');  ?></a> 
			</label>	
		</div>
	</div>
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Default Longitude','jobbank');  ?></label>
		<div class="col-md-3">			<?php
				$jobbank_defaultlongitude=get_option('jobbank_defaultlongitude');					
			?>
			<input  class="form-control" type="text" name="jobbank_defaultlongitude" id="jobbank_defaultlongitude" value='<?php echo esc_attr($jobbank_defaultlongitude); ?>' >
		</div>
		<div class="col-md-4">
			<label>	<a href="<?php echo esc_url('https://www.maps.ie/coordinates.html');?>" target="_blank" >
				<?php esc_html_e('You can find longitude here','jobbank');  ?></a> 
			</label>	
		</div>
	</div>
	<hr/>
	 <label class="jobbank-settings-sub-section-title "> <?php esc_html_e('Map Popup/ Infobox settings','jobbank');  ?></label>
	
	
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Map Popup/Infobox Image ','jobbank');  ?>			
			</label>
		<div class="col-md-3">			<?php
				$jobbank_infobox_image=get_option('jobbank_infobox_image');	
				if($jobbank_infobox_image==""){$jobbank_infobox_image='yes';}	
			?>
			<label class="switch">
			  <input name="jobbank_infobox_image" type="checkbox" value="yes"  <?php echo ($jobbank_infobox_image=='yes' ? ' checked':'');  ?> >
			  <span class="slider round"></span>
			</label>
		</div>		
	</div>
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Map Popup/Infobox Title ','jobbank');  ?>			
			</label>
		<div class="col-md-3">			<?php
				$jobbank_infobox_title=get_option('jobbank_infobox_title');	
				if($jobbank_infobox_title==""){$jobbank_infobox_title='yes';}	
			?>
			<label class="switch">
			  <input name="jobbank_infobox_title" type="checkbox" value="yes"  <?php echo ($jobbank_infobox_title=='yes' ? ' checked':'');  ?> >
			  <span class="slider round"></span>
			</label>
		</div>		
	</div>
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Map Popup/Infobox Location ','jobbank');  ?>			
			</label>
		<div class="col-md-3">			<?php
				$jobbank_infobox_location=get_option('jobbank_infobox_location');		
				if($jobbank_infobox_location==""){$jobbank_infobox_location='yes';}	
			?>
			<label class="switch">
			  <input name="jobbank_infobox_location" type="checkbox" value="yes"  <?php echo ($jobbank_infobox_location=='yes' ? ' checked':'');  ?> >
			  <span class="slider round"></span>
			</label>
		</div>		
	</div>
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Map Popup/Infobox Direction ','jobbank');  ?>			
			</label>
		<div class="col-md-3">			<?php
				$jobbank_infobox_direction=get_option('jobbank_infobox_direction');
				if($jobbank_infobox_direction==""){$jobbank_infobox_direction='yes';}
			?>
			<label class="switch">
			  <input name="jobbank_infobox_direction" type="checkbox" value="yes"  <?php echo ($jobbank_infobox_direction=='yes' ? ' checked':'');  ?> >
			  <span class="slider round"></span>
			</label>
		</div>		
	</div>
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Link to Detail page ','jobbank');  ?>			
			</label>
		<div class="col-md-3">			<?php
				$jobbank_infobox_linkdetail=get_option('jobbank_infobox_linkdetail');
				if($jobbank_infobox_linkdetail==""){$jobbank_infobox_linkdetail='yes';}
			?>
			<label class="switch">
			  <input name="jobbank_infobox_linkdetail" type="checkbox" value="yes"  <?php echo ($jobbank_infobox_linkdetail=='yes' ? ' checked':'');  ?> >
			  <span class="slider round"></span>
			</label>
		</div>		
	</div>
	
	<div class="row">
		
		<div class="col-md-12 col-12">
			<hr/>
			<div id="success_message_map_setting"></div>	
			<button type="button" onclick="return  jobbank_update_map_settings();" class="button button-primary"><?php esc_html_e( 'Update', 'jobbank' );?></button>
		</div>	
	</div>	
</form>