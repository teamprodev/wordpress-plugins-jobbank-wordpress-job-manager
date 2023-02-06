<div class="" id="erp_update_message"></div>
<div class="row bs-wizard" >
	<div id="step-1" class="col-md-3 bs-wizard-step   ">
		<div class="text-center bs-wizard-stepnum"><?php esc_html_e('Step 1','jobbank'); ?></div>
		<div class="progress"><div class="progress-bar"></div></div>
		<a href="#" class="bs-wizard-dot"></a>
		<div class="bs-wizard-info text-center">
			<?php esc_html_e('Upload CSV File','jobbank'); ?>
		</div>
	</div>
	<div id="step-2" class="col-md-3 bs-wizard-step disabled">
		<div class="text-center bs-wizard-stepnum"><?php esc_html_e('Step 2','jobbank'); ?></div>
		<div class="progress"><div class="progress-bar"></div></div>
		<a href="#" class="bs-wizard-dot"></a>
		<div class="bs-wizard-info text-center">
			<?php esc_html_e('Column mapping','jobbank'); ?>
		</div>
	</div>
	<div id="step-3" class="col-md-3 bs-wizard-step disabled ">
		<div class="text-center bs-wizard-stepnum"><?php esc_html_e('Step 3','jobbank'); ?></div>
		<div class="progress"><div class="progress-bar"></div></div>
		<a href="#" class="bs-wizard-dot"></a>
		<div class="bs-wizard-info text-center">
			<span><?php esc_html_e('Import','jobbank'); ?></span>
		</div>
	</div>
	<div id="step-4" class="col-md-3 bs-wizard-step disabled">
		<div class="text-center bs-wizard-stepnum"><?php esc_html_e('Step 4','jobbank'); ?></div>
		<div class="progress"><div class="progress-bar"></div></div>
		<a href="#" class="bs-wizard-dot"></a>
		<div class="bs-wizard-info text-center">
			<?php esc_html_e('Done!','jobbank'); ?>
		</div>
	</div>
</div>
<div id="ep1">	
	<center>
		<button type="button" onclick="jobbank_upload_csv_file('gallery_doc_div');" class="btn btn-success" > <?php esc_html_e('Upload CSV File','jobbank'); ?></button>
	</center>
	<div class="" id="uploaded_csv_file_name"></div>
	<input type="hidden" name="erp_csv_id" id="erp_csv_id" value="">
	<hr/>
	<center>		
		<p><?php esc_html_e('This tool allows you to import (or merge) job listing data to your site from a CSV file.','jobbank'); ?></p>
		<p><?php esc_html_e('If CSV ID filed value match your listing ID then it will update/merge','jobbank'); ?></p>
		<a class="btn btn-info btn-xs" href="<?php echo  ep_jobbank_URLPATH; ?>assets/sample-data.csv" download ><?php esc_html_e('Sample CSV File','jobbank'); ?></a>
	</center>
</div>
<div id="ep2" class="none">
	<div id="data_maping"></div>
	<center>
		<button type="button" onclick="jobbank_save_csv_file_to_database();"  class="btn btn-success" ><?php  esc_html_e('Run The importer','jobbank');?></button>
	</center>
</div>
<div id="ep3" class="none">
	<center>
		<img src="<?php echo ep_jobbank_URLPATH; ?>admin/files/images/loader.gif">
		<div class="progress" >
			<div class="progress-bar progress-bar-striped progress-bar-animated" id="progress-bar-csv" >0%</div>
		</div>
	</center>
</div>
<div id="ep4" class="none">
	<center>
		<h2><?php esc_html_e('Done!','jobbank'); ?></h2>
	</center>
</div>
<?php
	wp_enqueue_script('iv_directory-ar-script-30', ep_jobbank_URLPATH . 'admin/files/js/csv-import.js');
	wp_localize_script('iv_directory-ar-script-30', 'dirpro_data', array(
	'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
	'loading_image'		=> '<img src="'.ep_jobbank_URLPATH.'admin/files/images/loader.gif">',	
	'dirwpnonce'=> wp_create_nonce("csv"),
	) );
?>