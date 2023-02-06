<?php
	wp_enqueue_script('jobbank_edit_resume_js', ep_jobbank_URLPATH . 'admin/files/js/custom_dropdown.js');
	wp_enqueue_style('jobbank_custom_select_box', ep_jobbank_URLPATH . 'admin/files/css/custom_select.css');
	
	
?>

<div class="mt-3 row ">	
	<div class="col-md-3">
		<span class="toptitle-sub"><?php esc_html_e('Applicants', 'jobbank'); ?></span>
	</div>
	<div class="col-md-9">
		<ul class="nav nav-pills  float-right" id="pills-tab" role="tablist">
			<li class="nav-item">
				 <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#candidates_all" role="tab" aria-controls="pills-home" aria-selected="true"><?php   esc_html_e('All','jobbank');?> </a>
			</li>
			<li class="nav-item">
				 <a class="nav-link " id="pills-add-tab" data-toggle="pill" href="#shortlisted" role="tab" aria-controls="pills-home" ><?php   esc_html_e('Shortlisted','jobbank');?></a>
			</li>
			<li class="nav-item">
				 <a class="nav-link " id="pills-add-tab" data-toggle="pill" href="#can_meeting" role="tab" aria-controls="pills-home" ><?php   esc_html_e('Schedule Meeting','jobbank');?></a>
			</li>
			<li class="nav-item">
				 <a class="nav-link " id="pills-add-tab" data-toggle="pill" href="#can_reject" role="tab" aria-controls="pills-home" ><?php   esc_html_e('Rejected','jobbank');?></a>
			</li>
			
			
			
		</ul>
	</div>
	<div class="col-md-12"> <p class="border-bottom"> </p></div>
</div>		





<div class="tab-content ">
	<div class="tab-pane active" id="candidates_all">					
	<?php								
		include('candidates_all.php');
	?>				
	</div>
	<div class="tab-pane" id="shortlisted">
			<?php								
		include('candidates_shortlisted.php');
	?>
	</div>
	<div class="tab-pane" id="can_meeting">
			<?php								
		include('candidates_meeting_schedule.php');
	?>
	</div>
	<div class="tab-pane" id="can_reject">
		<?php								
		include('candidates_deleted.php');
	?>
	</div>
	
</div>
	
