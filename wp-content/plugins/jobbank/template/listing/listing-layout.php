<?php
get_header(); 
$jobbank_archive_layout=get_option('jobbank_archive_layout');	
if($jobbank_archive_layout==""){$jobbank_archive_layout='archive-left-map';}	
if($jobbank_archive_layout=='archive-left-map'){
	echo do_shortcode('[jobbank_archive_grid]');
}elseif($jobbank_archive_layout=='archive-top-map'){
	echo do_shortcode('[jobbank_archive_grid_top_map]');
}elseif($jobbank_archive_layout=='archive-no-map'){
	echo do_shortcode('[jobbank_archive_grid_no_map]');
}else{
	echo do_shortcode('[jobbank_archive_grid]');
}	
get_footer();
 ?>
