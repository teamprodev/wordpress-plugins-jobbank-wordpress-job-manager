<?php
	global $wpdb;
	global $current_user;
	$ii=1;
	$jobbank_directory_url=get_option('ep_jobbank_url');					
	if($jobbank_directory_url==""){$jobbank_directory_url='job';}			
?>
<div class="row">
	<div class="col-md-12">	
		<div class="progress ">							
			<div id="dynamic" class=" progress-bar progress-bar-success progress-bar-striped active " role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" >
				<span id="current-progress"></span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4 none " id="cptlink12" > <a  class="btn btn-info " href="<?php echo get_post_type_archive_link( $jobbank_directory_url) ; ?>" target="_blank"><?php esc_html_e('View All Listing','jobbank');?>  </a>
			</div>
			<div class="col-md-4"></div>	
		</div>	
		<div class="row" id="importbutton">						
			<div class="col-md-12 "> 								
				<button type="button" onclick="return  jobbank_import_demo();" class="btn btn-info mt-3"><?php esc_html_e('Import Demo Listing','jobbank');?> </button>							
			</div>
		</div>					
	</div>			
</div>
<div class="row">
	<div class="col-md-12 mb-2 mt-3">	
		<a class="button button-primary mr-3" href="<?php echo  ep_jobbank_URLPATH; ?>assets/depicter-8.zip" download ><?php esc_html_e('Demo Slider','jobbank');?>  </a>		
		<a class="button button-primary  " href="<?php echo esc_url('https://wordpress.org/plugins/depicter/');?>" target="_blank" ><?php esc_html_e('Depicter Slider Plugin','jobbank');?></a>		
	</div>	
</div>
<div class="row mt-3">	
	<div class="col-md-12 mt-2">
		<label class="jobbank-settings-sub-section-title"> <?php esc_html_e('Setup Tutorial','jobbank');?></label>
	</div>
	<div class="col-md-6 col-12 mt-2">	
		<iframe width="100%" height="315" src="https://www.youtube.com/embed/dYRcpEgY50M" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>		
</div>