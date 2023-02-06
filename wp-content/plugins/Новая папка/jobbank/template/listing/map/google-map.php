<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?libraries=places&key=<?php echo esc_html($dir_map_api);?>'></script>
<?php 
$top_image =( isset($active_archive_fields['image'])?'yes':'no' );
$jobbank_infobox_image=get_option('jobbank_infobox_image');	
if($jobbank_infobox_image==""){$jobbank_infobox_image=$top_image;}	
if($jobbank_infobox_image=='yes'){
	$top_image='yes';	
}
$jobbank_infobox_title=get_option('jobbank_infobox_title');	
if($jobbank_infobox_title==""){$jobbank_infobox_title='yes';}	
$jobbank_infobox_location=get_option('jobbank_infobox_location');	
if($jobbank_infobox_location==""){$jobbank_infobox_location='yes';}	
$jobbank_infobox_direction=get_option('jobbank_infobox_direction');	
if($jobbank_infobox_direction==""){$jobbank_infobox_direction='yes';}	
$jobbank_infobox_linkdetail=get_option('jobbank_infobox_linkdetail');	
if($jobbank_infobox_linkdetail==""){$jobbank_infobox_linkdetail='yes';}
$jobbank_forcelocation=get_option('jobbank_forcelocation');
	
if($jobbank_forcelocation=='forcelocation'){
	$ins_lat=get_option('jobbank_defaultlatitude');
	$ins_lng=get_option('jobbank_defaultlongitude');
}	

wp_enqueue_style('jobbank-single-google-map', ep_jobbank_URLPATH . 'admin/files/css/single-google-map.css');	
wp_enqueue_script('markerclusterer',ep_jobbank_URLPATH . 'admin/files/js/markerclusterer.js');	
wp_enqueue_script('jobbank-google-map', ep_jobbank_URLPATH . 'admin/files/js/google-map.js');
	wp_localize_script('jobbank-google-map', 'jobbank_map_data', array(
	'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
	'loading_image'		=> '<img src="'.ep_jobbank_URLPATH.'admin/files/images/loader.gif">',
	'current_user_id'	=>get_current_user_id(),
	'Please_login'=>esc_html__('Please login', 'jobbank' ),
	'Add_to_Favorites'=>esc_html__('Add to Favorites', 'jobbank' ),
	'direction_text'=>esc_html__('Direction', 'jobbank' ),
	'marker_icon'=> '',
	'ins_lat'=> $ins_lat,
	'top_image'=> $top_image,
	'infotitle'=>$jobbank_infobox_title,
	'infolocation'=>$jobbank_infobox_location,
	'indirection'=>$jobbank_infobox_direction,
	'infolinkdetail'=> $jobbank_infobox_linkdetail,
	'ins_lng'=> $ins_lng,
	'dir_map_zoom'=>$dir_map_zoom,
	'dirs_json'=>$dirs_json_map,
	
	'ep_jobbank_URLPATH'=>ep_jobbank_URLPATH,
	) );
	
?>

 