<?php
	$main_class = new eplugins_jobbank;
	wp_enqueue_style('admin-jobbank', ep_jobbank_URLPATH . 'admin/files/css/admin.css');
	wp_enqueue_style('dataTables', ep_jobbank_URLPATH . 'admin/files/css/vue-admin.css');
?>	
<div class="bootstrap-wrapper">
	<div class=" container-fluid">	
		<div class="jobbank-admin-header row">
			<div class="jobbank-admin-header-logo">
				<img src="<?php echo ep_jobbank_URLPATH."assets/images/admin-logo.png";?>" alt="jobbank Logo">
				<span class="jobbank-admin-header-version"><?php echo esc_html($main_class->version); ?></span>
			</div>
			<div class="jobbank-admin-header-menu">
				<div class="menu-item">
					<div class="menu-icon">
						<i class="fa-solid fa-question"></i>
						<div class="dropdown">
							<h3><?php  esc_html_e('Get Help','jobbank'); ?></h3>
							<div class="list-item">  
							
							 <a href="<?php echo esc_url('https://www.youtube.com/playlist?list=PLLRcfoNnzUb4fQXXTRbcqt5hUDwN_iRTZ');?>" target="_blank">
									<span class="jobbank-icon">
										<i class="fa-brands fa-youtube"></i>
									</span>
									<?php  esc_html_e('Video Tutorial','jobbank'); ?>
								</a>
								
								<a href="<?php echo esc_url('https://e-plugins.com/support/');?>" target="_blank">
									<span class="jobbank-icon">
										<i class="fa-regular fa-comments"></i>
									</span>
									<?php  esc_html_e('Get Support','jobbank'); ?>
								</a>
								<a href="<?php echo esc_url('https://help.eplug-ins.com/jobbank');?>" target="_blank">
									<div class="jobbank-icon">
										<i class="fa-solid fa-file-lines"></i>
									</div>
									<?php  esc_html_e('Documentation','jobbank'); ?>
								</a>
								
								<a href="#" target="_blank">
									<div class="jobbank-icon">
										<i class="fa-regular fa-comments"></i>
									</div>
								<?php  esc_html_e('FAQ','jobbank'); ?>
								</a>
								<a href="<?php echo esc_url('https://jobbank.e-plugins.com/request-a-feature/');?>" target="_blank">
									<div class="jobbank-icon">
										<i class="fa-regular fa-lightbulb"></i>
									</div>
								<?php  esc_html_e('Request a Feature  ','jobbank'); ?>                      </a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>