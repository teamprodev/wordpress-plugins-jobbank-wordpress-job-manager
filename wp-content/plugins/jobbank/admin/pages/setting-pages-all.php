
	<form class="form-horizontal" role="form"  name='page_settings' id='page_settings'>
		<?php
			$price_table=get_option('epjbjobbank_price_table'); 
			$registration=get_option('epjbjobbank_registration'); 
			$profile_page=get_option('epjbjobbank_profile_page'); 
			$login_page=get_option('epjbjobbank_login_page');  										
			$thank_you=get_option('epjbjobbank_thank_you_page'); 	
			$args = array(
			'child_of'     => 0,
			'sort_order'   => 'ASC',
			'sort_column'  => 'post_title',
			'hierarchical' => 1,															
			'post_type' => 'page'
			);
		?>
		<div class="form-group row">
			<label  class="col-md-2   control-label"><?php esc_html_e( 'Price Listing', 'jobbank' );?> : </label>
			<div class="col-md-10 ">
				
					<?php
						if ( $pages = get_pages( $args ) ){
							echo "<select id='pricing_page' name='pricing_page' class='form-control '>";
							foreach ( $pages as $page ) {
								echo "<option value='{$page->ID}' ".($price_table==$page->ID ? 'selected':'').">{$page->post_title}</option>";
							}
							echo "</select>";
						}
					?>
					<?php
						$reg_page= get_permalink( $price_table); 
					?>
					<a class="btn btn-info mt-2 " href="<?php  echo esc_url($reg_page); ?>"><?php esc_html_e( 'View', 'jobbank' );?> </a>
				
				
			</div>	
		</div>
		<div class="form-group row">
			<label  class="col-md-2   control-label"><?php esc_html_e( 'User Sign Up:', 'jobbank' );?> </label>
			<div class="col-md-10 ">
				
					<?php
						if ( $pages = get_pages( $args ) ){
							echo "<select id='signup_page' name='signup_page' class='form-control'>";
							foreach ( $pages as $page ) {
								echo "<option value='{$page->ID}' ".($registration==$page->ID ? 'selected':'').">{$page->post_title}</option>";
							}
							echo "</select>";
						}
					?>
					<?php
						$reg_page= get_permalink( $registration); 
					?>
					<a class="btn btn-info mt-2 " href="<?php  echo esc_url($reg_page); ?>"> <?php esc_html_e( 'View', 'jobbank' );?></a>
				</div>
		</div>
		<div class="form-group row">
			<label  class="col-md-2   control-label"><?php esc_html_e( 'Signup Thanks', 'jobbank' );?> : </label>
			<div class="col-md-10 ">
				
					<?php
						if ( $pages = get_pages( $args ) ){
							echo "<select id='thank_you_page'  name='thank_you_page'  class='form-control'>";
							foreach ( $pages as $page ) {
								echo "<option value='{$page->ID}' ".($thank_you==$page->ID ? 'selected':'').">{$page->post_title}</option>";
							}
							echo "</select>";
						}
					?>
				
				
					<?php
						$reg_page= get_permalink( $thank_you); 
					?>
					<a class="btn btn-info mt-2 " href="<?php  echo esc_url($reg_page); ?>"> <?php esc_html_e( 'View', 'jobbank' );?></a>
				
			</div>	
		</div>
		<div class="form-group row">
			<label  class="col-md-2   control-label"><?php esc_html_e( 'Login Page:', 'jobbank' );?> </label>
			<div class="col-md-10 ">
				
					<?php
						if ( $pages = get_pages( $args ) ){
							echo "<select id='login_page'  name='login_page'  class='form-control'>";
							foreach ( $pages as $page ) {
								echo "<option value='{$page->ID}' ".($login_page==$page->ID ? 'selected':'').">{$page->post_title}</option>";
							}
							echo "</select>";
						}
					?>
				
					<?php
						$reg_page= get_permalink( $login_page); 
					?>
					<a class="btn btn-info mt-2 " href="<?php  echo esc_url($reg_page); ?>"><?php esc_html_e( 'View', 'jobbank' );?> </a>
			
			</div>	
		</div>
		<div class="form-group row">
			<label  class="col-md-2   control-label"><?php esc_html_e( 'User My Account', 'jobbank' );?> : </label>
			<div class="col-md-10 ">
				
					<?php
						if ( $pages = get_pages( $args ) ){
							echo "<select id='profile_page'  name='profile_page'  class='form-control'>";
							foreach ( $pages as $page ) {
								echo "<option value='{$page->ID}' ".($profile_page==$page->ID ? 'selected':'').">{$page->post_title}</option>";
							}
							echo "</select>";
						}
					?>
				
					<?php
						$reg_page= get_permalink( $profile_page); 
					?>
					<a class="btn btn-info mt-2 " href="<?php  echo esc_url($reg_page); ?>"> <?php esc_html_e( 'View', 'jobbank' );?></a>
				
			</div>	
		</div>
		
		<?php
		$profile_page=get_option('epjbjobbank_employer_dir_page');
		?>
		<div class="form-group row">
			<label  class="col-md-2   control-label"><?php esc_html_e( 'Employer Directory:', 'jobbank' );?> </label>
			<div class="col-md-10 ">
				
					<?php																				
						if ( $pages = get_pages( $args ) ){
							echo "<select id='employer_dir'  name='employer_dir'  class='form-control'>";
							foreach ( $pages as $page ) {
								echo "<option value='{$page->ID}' ".($profile_page==$page->ID ? 'selected':'').">{$page->post_title}</option>";
							}
							echo "</select>";
						}
					?>
				
					<?php																				
						$reg_page= get_permalink( $profile_page); 
					?>
					<a class="btn btn-info mt-2 " href="<?php  echo esc_url($reg_page); ?>"><?php esc_html_e( 'View', 'jobbank' );?> </a>
				
			</div>	
		</div>
		
		
		<?php
		$profile_page=get_option('epjbjobbank_candidate_dir_page');
		?>
		<div class="form-group row">
			<label  class="col-md-2   control-label"><?php esc_html_e( 'Candidate Directory:', 'jobbank' );?> </label>
			<div class="col-md-10 ">
				
					<?php																				
						if ( $pages = get_pages( $args ) ){
							echo "<select id='candidate_dir'  name='candidate_dir'  class='form-control'>";
							foreach ( $pages as $page ) {
								echo "<option value='{$page->ID}' ".($profile_page==$page->ID ? 'selected':'').">{$page->post_title}</option>";
							}
							echo "</select>";
						}
					?>
				
					<?php																				
						$reg_page= get_permalink( $profile_page); 
					?>
					<a class="btn btn-info mt-2 " href="<?php  echo esc_url($reg_page); ?>"><?php esc_html_e( 'View', 'jobbank' );?> </a>
				
			</div>	
		</div>
		
		
		
		
		<?php
		$profile_page=get_option('epjbjobbank_employer_public_page');
		?>
		<div class="form-group row">
			<label  class="col-md-2   control-label"><?php esc_html_e( 'Employer Public Profile:', 'jobbank' );?> </label>
			<div class="col-md-10 ">
				
					<?php																				
						if ( $pages = get_pages( $args ) ){
							echo "<select id='employer_public'  name='employer_public'  class='form-control'>";
							foreach ( $pages as $page ) {
								echo "<option value='{$page->ID}' ".($profile_page==$page->ID ? 'selected':'').">{$page->post_title}</option>";
							}
							echo "</select>";
						}
					?>
				
					<?php																				
						$reg_page= get_permalink( $profile_page); 
					?>
					<a class="btn btn-info mt-2 " href="<?php  echo esc_url($reg_page); ?>"><?php esc_html_e( 'View', 'jobbank' );?> </a>
				
			</div>	
		</div>
		<?php
		$profile_page=get_option('epjbjobbank_candidate_public_page');
		?>
		<div class="form-group row">
			<label  class="col-md-2   control-label"><?php esc_html_e( 'Candidate Public Profile:', 'jobbank' );?> </label>
			<div class="col-md-10 ">
				
					<?php																				
						if ( $pages = get_pages( $args ) ){
							echo "<select id='candidate_public'  name='candidate_public'  class='form-control'>";
							foreach ( $pages as $page ) {
								echo "<option value='{$page->ID}' ".($profile_page==$page->ID ? 'selected':'').">{$page->post_title}</option>";
							}
							echo "</select>";
						}
					?>
				
					<?php																				
						$reg_page= get_permalink( $profile_page); 
					?>
					<a class="btn btn-info mt-2 " href="<?php  echo esc_url($reg_page); ?>"><?php esc_html_e( 'View', 'jobbank' );?> </a>
				
			</div>	
		</div>
		
		
		
		
		<div class="form-group row">
			<label  class="col-md-2   control-label"> </label>
			<div class="col-md-10 ">
					<hr/>
					<button type="button" onclick="return  jobbank_update_page_settings();" class="btn btn-success"><?php esc_html_e( 'Update', 'jobbank' );?></button>
				
				<div class="checkbox col-md-1 ">
				</div>
			</div>	
		</div>	
	</form>
