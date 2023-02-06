<ul>
	<?php
		$account_menu_check= '';
		if( get_option('epjbjobbank_menu_listinghome' ) ) {
			$account_menu_check= get_option('epjbjobbank_menu_listinghome');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="">
			<a href="<?php echo get_post_type_archive_link( $jobbank_directory_url ) ; ?>">
				<i class="fas fa-home"></i>
			<?php  esc_html_e('Job Search','jobbank');	 ?> </a>
		</li>
		<?php
		}
	?>
	<?php
		$account_menu_check= '';
		if( get_option('epjbjobbank_mylevel' ) ) {
			$account_menu_check= get_option('epjbjobbank_mylevel');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='level'? 'active':''); ?> ">
			<a href="<?php echo get_permalink(); ?>?&profile=level">
				<i class="fas fa-user-clock"></i>
			<?php  esc_html_e('Membership','jobbank');	 ?> </a>
		</li>
		<?php
		}
	?>
	
	
	
	<?php
		$account_menu_check= '';
		if( get_option('epjbjobbank_menusetting' ) ) {
			$account_menu_check= get_option('epjbjobbank_menusetting');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='setting'? 'active':''); ?> ">
			<a href="<?php echo get_permalink(); ?>?&profile=setting">
				<i class="fas fa-user-cog"></i>
			<?php  esc_html_e('Edit Profile','jobbank');?> </a>
		</li>
		<?php
		}
	?>
	<?php
		$account_menu_check= '';
		if( get_option('epjbjobbank_menunecandidates' ) ) {
			$account_menu_check= get_option('epjbjobbank_menunecandidates');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='employer_manage_candidates'? 'active':''); ?> ">
			<a href="<?php echo get_permalink(); ?>?&profile=employer_manage_candidates">
				<i class="fas fa-users"></i>
			<?php   esc_html_e('Manage Candidates','jobbank');?> </a>
		</li>
		<?php
		}
	?>
		
	<?php
		$account_menu_check= '';
		if( get_option('epjbjobbank_menuallpost' ) ) {
			$account_menu_check= get_option('epjbjobbank_menuallpost');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='all-post'? 'active':''); ?> ">
			<a href="<?php echo get_permalink(); ?>?&profile=all-post">
				<i class="far fa-copy"></i>
			<?php  esc_html_e('Manage Jobs','jobbank');?>  </a>
		</li>
		<?php
		}
	?>	
	<?php
		$account_menu_check= '';
		if( get_option('epjbjobbank_messageboard' ) ) {
			$account_menu_check= get_option('epjbjobbank_messageboard');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='messageboard'? 'active':''); ?> ">
		<a href="<?php echo get_permalink(); ?>?&profile=messageboard">
			<i class="far fa-envelope"></i>
		<?php  esc_html_e('Message','jobbank');?></a>
	</li>
	<?php
		}
	?>
	<?php
		$account_menu_check= '';
		if( get_option('epjbjobbank_notification' ) ) {
			$account_menu_check= get_option('epjbjobbank_notification');
		}
		if($account_menu_check!='yes'){
		?>
	<li class="<?php echo ($active=='notification'? 'active':''); ?> ">
		<a href="<?php echo get_permalink(); ?>?&profile=notification">
			<i class="far fa-bell"></i>
		<?php  esc_html_e('Job Notifications','jobbank');?> </a>
	</li>
	<?php
		}
	?>
	<?php
		$account_menu_check= '';
		if( get_option('epjbjobbank_candidate_bookmarks' ) ) {
			$account_menu_check= get_option('epjbjobbank_candidate_bookmarks');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='candidate-bookmarks'? 'active':''); ?> ">
			<a href="<?php echo get_permalink(); ?>?&profile=candidate-bookmarks">
				<i class="fas fa-user-check"></i>
			<?php   esc_html_e('Saved Candidate','jobbank');?> </a>
		</li>
		<?php
		}
	?>
	<?php
		$account_menu_check= '';
		if( get_option('epjbjobbank_employer_bookmarks' ) ) {
			$account_menu_check= get_option('epjbjobbank_employer_bookmarks');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='employer_bookmarks'? 'active':''); ?> ">
			<a href="<?php echo get_permalink(); ?>?&profile=employer_bookmarks">
				<i class="fas fa-chalkboard-teacher"></i>
			<?php   esc_html_e('Saved Employer','jobbank');?> </a>
		</li>
		<?php
		}
	?>
	<?php
		$account_menu_check= '';
		if( get_option('epjbjobbank_job_bookmarks' ) ) {
			$account_menu_check= get_option('epjbjobbank_job_bookmarks');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='job_bookmark'? 'active':''); ?> ">
			<a href="<?php echo get_permalink(); ?>?&profile=job_bookmark">
				<i class="fas fa-chalkboard-teacher"></i>
			<?php   esc_html_e('Saved Job','jobbank');?> </a>
		</li>
		<?php
		}
	?>
	
	
	
	
	<li class="<?php echo ($active=='log-out'? 'active':''); ?> ">
		<a href="<?php echo wp_logout_url( home_url() ); ?>" >
			<i class="fas fa-sign-out-alt"></i>
			<?php  esc_html_e('Sign out','jobbank');?>
		</a>
	</li>
</ul>