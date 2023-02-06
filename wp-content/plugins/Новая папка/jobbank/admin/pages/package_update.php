<?php
	global $wpdb;
	$package_id='';
	if(isset($_REQUEST['id'])){
		$package_id=sanitize_text_field($_REQUEST['id']);
	}	
	$row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE id = '%s' ",$package_id ));
	wp_enqueue_style('font-awesome', ep_jobbank_URLPATH . 'admin/files/css/font-awesome/css/font-awesome.min.css');
?>
<?php
	 include('header.php');
?>
<div class="card col-md-12">
			<div class="card-body">
		<div class="row">
			<div class="col-md-12"><h3 class="page-header"><?php esc_html_e( 'Update Package / Membership Level', 'jobbank' );?><br /><small> &nbsp;</small> </h3>
			</div>
		</div>				
		<form id="package_form_iv" name="package_form_iv" class="form-horizontal" role="form" onsubmit="return false;">
			<input type="hidden"  name="package_id" value="<?php echo esc_attr($package_id); ?>">
			<div class="form-group row">
				<label for="text" class="col-md-2 control-label"><?php esc_html_e( 'Package Name', 'jobbank' );?></label>
				<div class="col-md-6">
					<input type="text" readonly class="form-control" name="package_name" id="package_name" value="<?php echo esc_attr($row->post_title); ?>">
				</div>
			</div>
			
			<div class="form-group row">
				<label for="text" class="col-md-2 control-label"><?php esc_html_e('Sub Title','jobbank'); ?></label>
				<div class="col-md-6">
					<input type="text" class="form-control"
					name="package_subtile" id="package_subtile" value="<?php echo esc_attr(get_post_meta($package_id, 'package_subtitle', true)); ?>" placeholder="<?php esc_html_e('Enter Package Subtitle','jobbank'); ?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="text" class="col-md-2 control-label"><?php esc_html_e('Is it Feature Package ?','jobbank'); ?></label>
				<div class="col-md-6">
					<input type="checkbox"   <?php echo (get_post_meta($package_id, '_is_it_feature', true)=='yes'?'checked': ''); ?> name="is_it_feature" id="is_it_feature"  value="yes">
				</div>
			</div>
			<div  class="row" id="pac_feature_all">
				<?php	$aw=0;
					for($i=0;$i<20;$i++){
						if(get_post_meta($row->ID,'package_feature_'.$i,true)!=''){?>
						<div class="form-group row" id="feature_<?php echo esc_html($i);?>" >
							<label for="text" class="col-md-2 control-label"><?php esc_html_e('Package Feature List','jobbank'); ?></label>
							<div class="col-md-1">
								<i class="fa <?php echo esc_attr(get_post_meta($row->ID,'feature_icon_'.$i,true));?> fa-2x" ></i>
								<input type="hidden" name="feature_icon[]"  value="<?php echo esc_attr(get_post_meta($row->ID,'feature_icon_'.$i,true)); ?>">
							</div>
							<div class="col-md-2">
								<?php echo esc_html(get_post_meta($row->ID,'package_feature_'.$i,true));?>
								<input type="hidden" name="package_feature[]" id="package_feature[]" value="<?php echo esc_attr(get_post_meta($row->ID,'package_feature_'.$i,true));?>">
							</div>
							<div class="col-md-1">
								<button type="button" onclick="jobbank_delete_feature_field(<?php echo esc_html($i);?>);"  class="btn btn-xs btn-danger"><?php esc_html_e('X','jobbank'); ?></button>
							</div>
							<div class="col-md-6">
							</div>
						</div>
						<?php
						}
					}
				?>
			</div>
			
			<div class="form-group row"  id="pac_feature">
				<label for="text" class="col-md-2 control-label"><?php esc_html_e('Package Feature List','jobbank'); ?></label>
				<div class="col-md-2">
					<select class="feature_icon form-control" id="feature_icon" name="feature_icon[]">
						<option value="fa-calendar-check-o ">&#xf274; <?php esc_html_e('fa-calendar-check-o', 'jobbank'); ?> </option>
						<option value="fa-file-video-o">&#xf1c8; <?php esc_html_e('fa-file-video-o', 'jobbank'); ?></option>
						<option value="fa-newspaper-o">&#xf1ea; <?php esc_html_e('fa-newspaper-o', 'jobbank'); ?></option>
						<option value="fa-user-o">&#xf2c0; <?php esc_html_e('fa-user-o', 'jobbank'); ?></option>
						<option value="fa-envira">&#xf299; <?php esc_html_e('fa-envira', 'jobbank'); ?></option>
						<option value="fa-align-left">&#xf036; <span class="fa fa-align-left"></span></option>
						<option value="fa-align-right">&#xf038; <?php esc_html_e('fa-align-right', 'jobbank'); ?></option>
						<option value="fa-amazon">&#xf270; <?php esc_html_e('fa-amazon', 'jobbank'); ?></option>
						<option value="fa-ambulance">&#xf0f9; <?php esc_html_e('fa-ambulance', 'jobbank'); ?></option>
						<option value="fa-anchor">&#xf13d; <?php esc_html_e('fa-anchor', 'jobbank'); ?></option>
						<option value="fa-android">&#xf17b; <?php esc_html_e('fa-android', 'jobbank'); ?></option>
						<option value="fa-angellist">&#xf209; <?php esc_html_e('fa-angellist', 'jobbank'); ?></option>
						<option value="fa-angle-double-down">&#xf103; <?php esc_html_e('fa-angle-double-down', 'jobbank'); ?></option>
						<option value="fa-angle-double-left">&#xf100; <?php esc_html_e('fa-angle-double-left', 'jobbank'); ?></option>
						<option value="fa-angle-double-right">&#xf101; <?php esc_html_e('fa-angle-double-right', 'jobbank'); ?></option>
						<option value="fa-angle-double-up">&#xf102; <?php esc_html_e('fa-angle-double-up', 'jobbank'); ?></option>
						<option value="fa-angle-left">&#xf104; <?php esc_html_e('fa-angle-left', 'jobbank'); ?></option>
						<option value="fa-angle-right">&#xf105; <?php esc_html_e('fa-angle-right', 'jobbank'); ?></option>
						<option value="fa-angle-up">&#xf106; <?php esc_html_e('fa-angle-up', 'jobbank'); ?></option>
						<option value="fa-apple">&#xf179; <?php esc_html_e('fa-apple', 'jobbank'); ?></option>
						<option value="fa-archive">&#xf187; <?php esc_html_e('fa-archive', 'jobbank'); ?></option>
						<option value="fa-area-chart">&#xf1fe; <?php esc_html_e('fa-area-chart', 'jobbank'); ?></option>
						<option value="fa-arrow-circle-down">&#xf0ab; <?php esc_html_e('fa-arrow-circle-down', 'jobbank'); ?></option>
						<option value="fa-arrow-circle-left">&#xf0a8; <?php esc_html_e('fa-arrow-circle-left', 'jobbank'); ?></option>
						<option value="fa-arrow-circle-o-down">&#xf01a;
						<?php esc_html_e('fa-arrow-circle-o-down', 'jobbank'); ?></option>
						<option value="fa-arrow-circle-o-left">&#xf190; <?php esc_html_e('fa-arrow-circle-o-left', 'jobbank'); ?></option>
						<option value="fa-arrow-circle-o-right">&#xf18e; <?php esc_html_e('fa-arrow-circle-o-right', 'jobbank'); ?></option>
						<option value="fa-arrow-circle-o-up">&#xf01b; <?php esc_html_e('fa-arrow-circle-o-up', 'jobbank'); ?></option>
						<option value="fa-arrow-circle-right">&#xf0a9; <?php esc_html_e('fa-arrow-circle-right', 'jobbank'); ?></option>
						<option value="fa-arrow-circle-up">&#xf0aa; <?php esc_html_e('fa-arrow-circle-up', 'jobbank'); ?></option>
						<option value="fa-arrow-down">&#xf063; <?php esc_html_e('fa-arrow-down', 'jobbank'); ?></option>
						<option value="fa-arrow-left">&#xf060; <?php esc_html_e('fa-arrow-left', 'jobbank'); ?></option>
						<option value="fa-arrow-right">&#xf061; <?php esc_html_e('fa-arrow-left', 'jobbank'); ?></option>
						<option value="fa-arrow-up">&#xf062; <?php esc_html_e('fa-arrow-up', 'jobbank'); ?></option>
						<option value="fa-arrows">&#xf047; <?php esc_html_e('fa-arrows', 'jobbank'); ?></option>
						<option value="fa-arrows-alt">&#xf0b2; <?php esc_html_e('fa-arrows-alt', 'jobbank'); ?></option>
						<option value="fa-arrows-h">&#xf07e; <?php esc_html_e('fa-arrows-h', 'jobbank'); ?></option>
						<option value="fa-arrows-v">&#xf07d; <?php esc_html_e(' fa-arrows-v', 'jobbank'); ?></option>
						<option value="fa-asterisk">&#xf069; <?php esc_html_e('fa-asterisk', 'jobbank'); ?></option>
						<option value="fa-at">&#xf1fa; <?php esc_html_e('fa-at', 'jobbank'); ?></option>
						<option value="fa-automobile">&#xf1b9; <?php esc_html_e('fa-automobile', 'jobbank'); ?></option>
						<option value="fa-backward">&#xf04a; <?php esc_html_e('fa-backward', 'jobbank'); ?></option>
						<option value="fa-balance-scale">&#xf24e; <?php esc_html_e('fa-balance-scale', 'jobbank'); ?></option>
						<option value="fa-ban">&#xf05e; <?php esc_html_e('fa-ban', 'jobbank'); ?></option>
						<option value="fa-bank">&#xf19c; <?php esc_html_e('fa-bank', 'jobbank'); ?></option>
						<option value="fa-bar-chart">&#xf080; <?php esc_html_e('fa-bar-chart', 'jobbank'); ?></option>
						<option value="fa-bar-chart-o">&#xf080; <?php esc_html_e('fa-bar-chart-o', 'jobbank'); ?></option>
						<option value="fa-battery-full">&#xf240; <?php esc_html_e('fa-battery-full', 'jobbank'); ?></option>
						<option  value="fa-beer">&#xf0fc; <?php esc_html_e('fa-beer', 'jobbank'); ?></option>
						<option value="fa-behance">&#xf1b4; <?php esc_html_e('fa-behance', 'jobbank'); ?></option>
						<option value="fa-behance-square">&#xf1b5; <?php esc_html_e('fa-behance-square', 'jobbank'); ?></option>
						<option value="fa-bell">&#xf0f3; <?php esc_html_e('fa-bell', 'jobbank'); ?></option>
						<option value="fa-bell-o">&#xf0a2; <?php esc_html_e('fa-bell-o', 'jobbank'); ?></option>
						<option value="fa-bell-slash">&#xf1f6; <?php esc_html_e('fa-bell-slash', 'jobbank'); ?></option>
						<option value="fa-bell-slash-o">&#xf1f7; <?php esc_html_e('fa-bell-slash-o', 'jobbank'); ?></option>
						<option value="fa-bicycle">&#xf206; <?php esc_html_e('fa-bicycle', 'jobbank'); ?></option>
						<option value="fa-binoculars">&#xf1e5; <?php esc_html_e('fa-binoculars', 'jobbank'); ?></option>
						<option value="fa-birthday-cake">&#xf1fd; <?php esc_html_e('fa-birthday-cake', 'jobbank'); ?></option>
						<option value="fa-bitbucket">&#xf171; <?php esc_html_e('fa-bitbucket', 'jobbank'); ?></option>
						<option value="fa-bitbucket-square">&#xf172; <?php esc_html_e('fa-bitbucket-square', 'jobbank'); ?></option>
						<option value="fa-bitcoin">&#xf15a; <?php esc_html_e('fa-bitcoin', 'jobbank'); ?></option>
						<option value="fa-black-tie">&#xf27e; <?php esc_html_e('fa-black-tie', 'jobbank'); ?></option>
						<option value="fa-bold">&#xf032; <?php esc_html_e('fa-bold', 'jobbank'); ?></option>
						<option value="fa-bolt">&#xf0e7; <?php esc_html_e('fa-bolt', 'jobbank'); ?></option>
						<option value="fa-bomb">&#xf1e2; <?php esc_html_e('fa-bomb', 'jobbank'); ?></option>
						<option value="fa-book">&#xf02d; <?php esc_html_e('fa-book', 'jobbank'); ?></option>
						<option value="fa-bookmark">&#xf02e; <?php esc_html_e('fa-bookmark', 'jobbank'); ?></option>
						<option value="fa-bookmark-o">&#xf097; <?php esc_html_e('fa-bookmark-o', 'jobbank'); ?></option>
						<option value="fa-briefcase">&#xf0b1; <?php esc_html_e('fa-briefcase', 'jobbank'); ?></option>
						<option value="fa-btc">&#xf15a; <?php esc_html_e('fa-btc', 'jobbank'); ?></option>
						<option value="fa-bug">&#xf188; <?php esc_html_e('fa-bug', 'jobbank'); ?></option>
						<option value="fa-building">&#xf1ad; <?php esc_html_e('fa-building', 'jobbank'); ?></option>
						<option value="fa-building-o">&#xf0f7; <?php esc_html_e('fa-building-o', 'jobbank'); ?></option>
						<option value="fa-bullhorn">&#xf0a1; fa-bullhorn</option>
						<option value="fa-bullseye">&#xf140; fa-bullseye</option>
						<option value="fa-bus">&#xf207; fa-bus</option>
						<option value="fa-cab">&#xf1ba; fa-cab</option>
						<option value="fa-calendar">&#xf073; fa-calendar</option>
						<option value="fa-camera">&#xf030; fa-camera</option>
						<option value="fa-car">&#xf1b9; fa-car</option>
						<option value="fa-caret-up">&#xf0d8; fa-caret-up</option>
						<option value="fa-cart-plus">&#xf217; fa-cart-plus</option>
						<option value="fa-cc">&#xf20a; fa-cc</option>
						<option value="fa-cc-amex">&#xf1f3; fa-cc-amex</option>
						<option value="fa-cc-jcb">&#xf24b; fa-cc-jcb</option>
						<option value="fa-cc-paypal">&#xf1f4; fa-cc-paypal</option>
						<option value="fa-cc-stripe">&#xf1f5; fa-cc-stripe</option>
						<option value="fa-cc-visa">&#xf1f0; fa-cc-visa</option>
						<option value="fa-chain">&#xf0c1; fa-chain</option>
						<option value="fa-check">&#xf00c; fa-check</option>
						<option value="fa-chevron-left">&#xf053; fa-chevron-left</option>
						<option value="fa-chevron-right">&#xf054; fa-chevron-right</option>
						<option value="fa-chevron-up">&#xf077; fa-chevron-up</option>
						<option value="fa-child">&#xf1ae; fa-child</option>
						<option value="fa-chrome">&#xf268; fa-chrome</option>
						<option value="fa-circle">&#xf111; fa-circle</option>
						<option value="fa-circle-o">&#xf10c; fa-circle-o</option>
						<option value="fa-circle-o-notch">&#xf1ce; fa-circle-o-notch</option>
						<option value="fa-circle-thin">&#xf1db; fa-circle-thin</option>
						<option value="fa-clipboard">&#xf0ea; fa-clipboard</option>
						<option value="fa-clock-o">&#xf017; fa-clock-o</option>
						<option value="fa-clone">&#xf24d; fa-clone</option>
						<option value="fa-close">&#xf00d; fa-close</option>
						<option value="fa-cloud">&#xf0c2; fa-cloud</option>
						<option value="fa-cloud-download">&#xf0ed; fa-cloud-download</option>
						<option value="fa-cloud-upload">&#xf0ee; fa-cloud-upload</option>
						<option value="fa-cny">&#xf157; fa-cny</option>
						<option value="fa-code">&#xf121; fa-code</option>
						<option value="fa-code-fork">&#xf126; fa-code-fork</option>
						<option value="fa-codepen">&#xf1cb; fa-codepen</option>
						<option value="fa-coffee">&#xf0f4; fa-coffee</option>
						<option value="fa-cog">&#xf013; fa-cog</option>
						<option value="fa-cogs">&#xf085; fa-cogs</option>
						<option value="fa-columns">&#xf0db; fa-columns</option>
						<option value="fa-comment">&#xf075; fa-comment</option>
						<option value="fa-comment-o">&#xf0e5; fa-comment-o</option>
						<option value="fa-commenting">&#xf27a; fa-commenting</option>
						<option value="fa-commenting-o">&#xf27b; fa-commenting-o</option>
						<option value="fa-comments">&#xf086; fa-comments</option>
						<option value="fa-comments-o">&#xf0e6; fa-comments-o</option>
						<option value="fa-compass">&#xf14e; fa-compass</option>
						<option value="fa-compress">&#xf066; fa-compress</option>
						<option value="fa-connectdevelop">&#xf20e; fa-connectdevelop</option>
						<option value="fa-contao">&#xf26d; fa-contao</option>
						<option value="fa-copy">&#xf0c5; fa-copy</option>
						<option value="fa-copyright">&#xf1f9; fa-copyright</option>
						<option value="fa-creative-commons">&#xf25e; fa-creative-commons</option>
						<option value="fa-credit-card">&#xf09d; fa-credit-card</option>
						<option value="fa-crop">&#xf125; fa-crop</option>
						<option value="fa-crosshairs">&#xf05b; fa-crosshairs</option>
						<option value="fa-css3">&#xf13c; fa-css3</option>
						<option value="fa-cube">&#xf1b2; fa-cube</option>
						<option value="fa-cubes">&#xf1b3; fa-cubes</option>
						<option value="fa-cut">&#xf0c4; fa-cut</option>
						<option value="fa-cutlery">&#xf0f5; fa-cutlery</option>
						<option value="fa-dashboard">&#xf0e4; fa-dashboard</option>
						<option value="fa-dashcube">&#xf210; fa-dashcube</option>
						<option value="fa-database">&#xf1c0; fa-database</option>
						<option value="fa-dedent">&#xf03b; fa-dedent</option>
						<option value="fa-delicious">&#xf1a5; fa-delicious</option>
						<option value="fa-desktop">&#xf108; fa-desktop</option>
						<option value="fa-deviantart">&#xf1bd; fa-deviantart</option>
						<option value="fa-diamond">&#xf219; fa-diamond</option>
						<option value="fa-digg">&#xf1a6; fa-digg</option>
						<option value="fa-dollar">&#xf155; fa-dollar</option>
						<option value="fa-download">&#xf019; fa-download</option>
						<option value="fa-dribbble">&#xf17d; fa-dribbble</option>
						<option value="fa-dropbox">&#xf16b; fa-dropbox</option>
						<option value="fa-drupal">&#xf1a9; fa-drupal</option>
						<option value="fa-edit">&#xf044; fa-edit</option>
						<option value="fa-eject">&#xf052; fa-eject</option>
						<option value="fa-ellipsis-h">&#xf141; fa-ellipsis-h</option>
						<option value="fa-ellipsis-v">&#xf142; fa-ellipsis-v</option>
						<option value="fa-empire">&#xf1d1; fa-empire</option>
						<option value="fa-envelope">&#xf0e0; fa-envelope</option>
						<option value="fa-envelope-o">&#xf003; fa-envelope-o</option>
						<option value="fa-eur">&#xf153; fa-eur</option>
						<option value="fa-euro">&#xf153; fa-euro</option>
						<option value="fa-exchange">&#xf0ec; fa-exchange</option>
						<option value="fa-exclamation">&#xf12a; fa-exclamation</option>
						<option value="fa-exclamation-circle">&#xf06a; fa-exclamation-circle</option>
						<option value="fa-exclamation-triangle">&#xf071; fa-exclamation-triangle</option>
						<option value="fa-expand">&#xf065; fa-expand</option>
						<option value="fa-expeditedssl">&#xf23e; fa-expeditedssl</option>
						<option value="fa-external-link">&#xf08e; fa-external-link</option>
						<option value="fa-external-link-square">&#xf14c; fa-external-link-square</option>
						<option value="fa-eye">&#xf06e; fa-eye</option>
						<option value="fa-eye-slash">&#xf070; fa-eye-slash</option>
						<option value="fa-eyedropper">&#xf1fb; fa-eyedropper</option>
						<option value="fa-facebook">&#xf09a; fa-facebook</option>
						<option value="fa-facebook-f">&#xf09a; fa-facebook-f</option>
						<option value="fa-facebook-official">&#xf230; fa-facebook-official</option>
						<option value="fa-facebook-square">&#xf082; fa-facebook-square</option>
						<option value="fa-fast-backward">&#xf049; fa-fast-backward</option>
						<option value="fa-fast-forward">&#xf050; fa-fast-forward</option>
						<option value="fa-fax">&#xf1ac; fa-fax</option>
						<option value="fa-feed">&#xf09e; fa-feed</option>
						<option value="fa-female">&#xf182; fa-female</option>
						<option value="fa-fighter-jet">&#xf0fb; fa-fighter-jet</option>
						<option value="fa-file">&#xf15b; fa-file</option>
						<option value="fa-file-archive-o">&#xf1c6; fa-file-archive-o</option>
						<option value="fa-file-audio-o">&#xf1c7; fa-file-audio-o</option>
						<option value="fa-file-code-o">&#xf1c9; fa-file-code-o</option>
						<option value="fa-file-excel-o">&#xf1c3; fa-file-excel-o</option>
						<option value="fa-file-image-o">&#xf1c5; fa-file-image-o</option>
						<option value="fa-file-movie-o">&#xf1c8; fa-file-movie-o</option>
						<option value="fa-file-o">&#xf016; fa-file-o</option>
						<option value="fa-file-pdf-o">&#xf1c1; fa-file-pdf-o</option>
						<option value="fa-file-photo-o">&#xf1c5; fa-file-photo-o</option>
						<option value="fa-file-picture-o">&#xf1c5; fa-file-picture-o</option>
						<option value="fa-file-powerpoint-o">&#xf1c4; fa-file-powerpoint-o</option>
						<option value="fa-file-sound-o">&#xf1c7; fa-file-sound-o</option>
						<option value="fa-file-text">&#xf15c; fa-file-text</option>
						<option value="fa-file-text-o">&#xf0f6; fa-file-text-o</option>
						<option value="fa-file-video-o">&#xf1c8; fa-file-video-o</option>
						<option value="fa-file-word-o">&#xf1c2; fa-file-word-o</option>
						<option value="fa-file-zip-o">&#xf1c6; fa-file-zip-o</option>
						<option value="fa-files-o">&#xf0c5; fa-files-o</option>
						<option value="fa-film">&#xf008; fa-film</option>
						<option value="fa-filter">&#xf0b0; fa-filter</option>
						<option value="fa-fire">&#xf06d; fa-fire</option>
						<option value="fa-fire-extinguisher">&#xf134; fa-fire-extinguisher</option>
						<option value="fa-firefox">&#xf269; fa-firefox</option>
						<option value="fa-flag">&#xf024; fa-flag</option>
						<option value="fa-flag-checkered">&#xf11e; fa-flag-checkered</option>
						<option value="fa-flag-o">&#xf11d; fa-flag-o</option>
						<option value="fa-flash">&#xf0e7; fa-flash</option>
						<option value="fa-flask">&#xf0c3; fa-flask</option>
						<option value="fa-flickr">&#xf16e; fa-flickr</option>
						<option value="fa-floppy-o">&#xf0c7; fa-floppy-o</option>
						<option value="fa-folder">&#xf07b; fa-folder</option>
						<option value="fa-folder-o">&#xf114; fa-folder-o</option>
						<option value="fa-folder-open">&#xf07c; fa-folder-open</option>
						<option value="fa-folder-open-o">&#xf115; fa-folder-open-o</option>
						<option value="fa-font">&#xf031; fa-font</option>
						<option value="fa-fonticons">&#xf280; fa-fonticons</option>
						<option value="fa-forumbee">&#xf211; fa-forumbee</option>
						<option value="fa-forward">&#xf04e; fa-forward</option>
						<option value="fa-foursquare">&#xf180; fa-foursquare</option>
						<option value="fa-frown-o">&#xf119; fa-frown-o</option>
						<option value="fa-futbol-o">&#xf1e3; fa-futbol-o</option>
						<option value="fa-gamepad">&#xf11b; fa-gamepad</option>
						<option value="fa-gavel">&#xf0e3; fa-gavel</option>
						<option value="fa-gbp">&#xf154; fa-gbp</option>
						<option value="fa-ge">&#xf1d1; fa-ge</option>
						<option value="fa-gear">&#xf013; fa-gear</option>
						<option value="fa-gears">&#xf085; fa-gears</option>
						<option value="fa-genderless">&#xf22d; fa-genderless</option>
						<option value="fa-get-pocket">&#xf265; fa-get-pocket</option>
						<option value="fa-gg">&#xf260; fa-gg</option>
						<option value="fa-gg-circle">&#xf261; fa-gg-circle</option>
						<option value="fa-gift">&#xf06b; fa-gift</option>
						<option value="fa-git">&#xf1d3; fa-git</option>
						<option value="fa-git-square">&#xf1d2; fa-git-square</option>
						<option value="fa-github">&#xf09b; fa-github</option>
						<option value="fa-github-alt">&#xf113; fa-github-alt</option>
						<option value="fa-github-square">&#xf092; fa-github-square</option>
						<option value="fa-gittip">&#xf184; fa-gittip</option>
						<option value="fa-glass">&#xf000; fa-glass</option>
						<option value="fa-globe">&#xf0ac; fa-globe</option>
						<option value="fa-google">&#xf1a0; fa-google</option>
						<option value="fa-google-plus">&#xf0d5; fa-google-plus</option>
						<option value="fa-google-plus-square">&#xf0d4; fa-google-plus-square</option>
						<option value="fa-google-wallet">&#xf1ee; fa-google-wallet</option>
						<option value="fa-graduation-cap">&#xf19d; fa-graduation-cap</option>
						<option value="fa-gratipay">&#xf184; fa-gratipay</option>
						<option value="fa-group">&#xf0c0; fa-group</option>
						<option value="fa-h-square">&#xf0fd; fa-h-square</option>
						<option value="fa-hacker-news">&#xf1d4; fa-hacker-news</option>
						<option value="fa-hand-grab-o">&#xf255; fa-hand-grab-o</option>
						<option value="fa-hand-lizard-o">&#xf258; fa-hand-lizard-o</option>
						<option value="fa-hand-o-down">&#xf0a7; fa-hand-o-down</option>
						<option value="fa-hand-o-left">&#xf0a5; fa-hand-o-left</option>
						<option value="fa-hand-o-right">&#xf0a4; fa-hand-o-right</option>
						<option value="fa-hand-o-up">&#xf0a6; fa-hand-o-up</option>
						<option value="fa-hand-paper-o">&#xf256; fa-hand-paper-o</option>
						<option value="fa-hand-peace-o">&#xf25b; fa-hand-peace-o</option>
						<option value="fa-hand-pointer-o">&#xf25a; fa-hand-pointer-o</option>
						<option value="fa-hand-rock-o">&#xf255; fa-hand-rock-o</option>
						<option value="fa-hand-scissors-o">&#xf257; fa-hand-scissors-o</option>
						<option value="fa-hand-spock-o">&#xf259; fa-hand-spock-o</option>
						<option value="fa-hand-stop-o">&#xf256; fa-hand-stop-o</option>
						<option value="fa-hdd-o">&#xf0a0; fa-hdd-o</option>
						<option value="fa-header">&#xf1dc; fa-header</option>
						<option value="fa-headphones">&#xf025; fa-headphones</option>
						<option value="fa-heart">&#xf004; fa-heart</option>
						<option value="fa-heart-o">&#xf08a; fa-heart-o</option>
						<option value="fa-heartbeat">&#xf21e; fa-heartbeat</option>
						<option value="fa-history">&#xf1da; fa-history</option>
						<option value="fa-home">&#xf015; fa-home</option>
						<option value="fa-hospital-o">&#xf0f8; fa-hospital-o</option>
						<option value="fa-hotel">&#xf236; fa-hotel</option>
						<option value="fa-hourglass">&#xf254; fa-hourglass</option>
						<option value="fa-hourglass-1">&#xf251; fa-hourglass-1</option>
						<option value="fa-hourglass-2">&#xf252; fa-hourglass-2</option>
						<option value="fa-hourglass-3">&#xf253; fa-hourglass-3</option>
						<option value="fa-hourglass-end">&#xf253; fa-hourglass-end</option>
						<option value="fa-hourglass-half">&#xf252; fa-hourglass-half</option>
						<option value="fa-hourglass-o">&#xf250; fa-hourglass-o</option>
						<option value="fa-hourglass-start">&#xf251; fa-hourglass-start</option>
						<option value="fa-houzz">&#xf27c; fa-houzz</option>
						<option value="fa-html5">&#xf13b; fa-html5</option>
						<option value="fa-i-cursor">&#xf246; fa-i-cursor</option>
						<option value="fa-ils">&#xf20b; fa-ils</option>
						<option value="fa-image">&#xf03e; fa-image</option>
						<option value="fa-inbox">&#xf01c; fa-inbox</option>
						<option value="fa-indent">&#xf03c; fa-indent</option>
						<option value="fa-industry">&#xf275; fa-industry</option>
						<option value="fa-info">&#xf129; fa-info</option>
						<option value="fa-info-circle">&#xf05a; fa-info-circle</option>
						<option value="fa-inr">&#xf156; fa-inr</option>
						<option value="fa-instagram">&#xf16d; fa-instagram</option>
						<option value="fa-institution">&#xf19c; fa-institution</option>
						<option value="fa-internet-explorer">&#xf26b; fa-internet-explorer</option>
						<option value="fa-intersex">&#xf224; fa-intersex</option>
						<option value="fa-ioxhost">&#xf208; fa-ioxhost</option>
						<option value="fa-italic">&#xf033; fa-italic</option>
						<option value="fa-joomla">&#xf1aa; fa-joomla</option>
						<option value="fa-jpy">&#xf157; fa-jpy</option>
						<option value="fa-jsfiddle">&#xf1cc; fa-jsfiddle</option>
						<option value="fa-key">&#xf084; fa-key</option>
						<option value="fa-keyboard-o">&#xf11c; fa-keyboard-o</option>
						<option value="fa-krw">&#xf159; fa-krw</option>
						<option value="fa-language">&#xf1ab; fa-language</option>
						<option value="fa-laptop">&#xf109; fa-laptop</option>
						<option value="fa-lastfm">&#xf202; fa-lastfm</option>
						<option value="fa-lastfm-square">&#xf203; fa-lastfm-square</option>
						<option value="fa-leaf">&#xf06c; fa-leaf</option>
						<option value="fa-leanpub">&#xf212; fa-leanpub</option>
						<option value="fa-legal">&#xf0e3; fa-legal</option>
						<option value="fa-lemon-o">&#xf094; fa-lemon-o</option>
						<option value="fa-level-down">&#xf149; fa-level-down</option>
						<option value="fa-level-up">&#xf148; fa-level-up</option>
						<option value="fa-life-bouy">&#xf1cd; fa-life-bouy</option>
						<option value="fa-life-buoy">&#xf1cd; fa-life-buoy</option>
						<option value="fa-life-ring">&#xf1cd; fa-life-ring</option>
						<option value="fa-life-saver">&#xf1cd; fa-life-saver</option>
						<option value="fa-lightbulb-o">&#xf0eb; fa-lightbulb-o</option>
						<option value="fa-line-chart">&#xf201; fa-line-chart</option>
						<option value="fa-link">&#xf0c1; fa-link</option>
						<option value="fa-linkedin">&#xf0e1; fa-linkedin</option>
						<option value="fa-linkedin-square">&#xf08c; fa-linkedin-square</option>
						<option value="fa-linux">&#xf17c; fa-linux</option>
						<option value="fa-list">&#xf03a; fa-list</option>
						<option value="fa-list-alt">&#xf022; fa-list-alt</option>
						<option value="fa-list-ol">&#xf0cb; fa-list-ol</option>
						<option value="fa-list-ul">&#xf0ca; fa-list-ul</option>
						<option value="fa-location-arrow">&#xf124; fa-location-arrow</option>
						<option value="fa-lock">&#xf023; fa-lock</option>
						<option value="fa-long-arrow-down">&#xf175; fa-long-arrow-down</option>
						<option value="fa-long-arrow-left">&#xf177; fa-long-arrow-left</option>
						<option value="fa-long-arrow-right">&#xf178; fa-long-arrow-right</option>
						<option value="fa-long-arrow-up">&#xf176; fa-long-arrow-up</option>
						<option value="fa-magic">&#xf0d0; fa-magic</option>
						<option value="fa-magnet">&#xf076; fa-magnet</option>
						<option value="fa-mars-stroke-v">&#xf22a; fa-mars-stroke-v</option>
						<option value="fa-maxcdn">&#xf136; fa-maxcdn</option>
						<option value="fa-meanpath">&#xf20c; fa-meanpath</option>
						<option value="fa-medium">&#xf23a; fa-medium</option>
						<option value="fa-medkit">&#xf0fa; fa-medkit</option>
						<option value="fa-meh-o">&#xf11a; fa-meh-o</option>
						<option value="fa-mercury">&#xf223; fa-mercury</option>
						<option value="fa-microphone">&#xf130; fa-microphone</option>
						<option value="fa-mobile">&#xf10b; fa-mobile</option>
						<option value="fa-motorcycle">&#xf21c; fa-motorcycle</option>
						<option value="fa-mouse-pointer">&#xf245; fa-mouse-pointer</option>
						<option value="fa-music">&#xf001; fa-music</option>
						<option value="fa-navicon">&#xf0c9; fa-navicon</option>
						<option value="fa-neuter">&#xf22c; fa-neuter</option>
						<option value="fa-newspaper-o">&#xf1ea; fa-newspaper-o</option>
						<option value="fa-opencart">&#xf23d; fa-opencart</option>
						<option value="fa-openid">&#xf19b; fa-openid</option>
						<option value="fa-opera">&#xf26a; fa-opera</option>
						<option value="fa-outdent">&#xf03b; fa-outdent</option>
						<option value="fa-pagelines">&#xf18c; fa-pagelines</option>
						<option value="fa-paper-plane-o">&#xf1d9; fa-paper-plane-o</option>
						<option value="fa-paperclip">&#xf0c6; fa-paperclip</option>
						<option value="fa-paragraph">&#xf1dd; fa-paragraph</option>
						<option value="fa-paste">&#xf0ea; fa-paste</option>
						<option value="fa-pause">&#xf04c; fa-pause</option>
						<option value="fa-paw">&#xf1b0; fa-paw</option>
						<option value="fa-paypal">&#xf1ed; fa-paypal</option>
						<option value="fa-pencil">&#xf040; fa-pencil</option>
						<option value="fa-pencil-square-o">&#xf044; fa-pencil-square-o</option>
						<option value="fa-phone">&#xf095; fa-phone</option>
						<option value="fa-photo">&#xf03e; fa-photo</option>
						<option value="fa-picture-o">&#xf03e; fa-picture-o</option>
						<option value="fa-pie-chart">&#xf200; fa-pie-chart</option>
						<option value="fa-pied-piper">&#xf1a7; fa-pied-piper</option>
						<option value="fa-pied-piper-alt">&#xf1a8; fa-pied-piper-alt</option>
						<option value="fa-pinterest">&#xf0d2; fa-pinterest</option>
						<option value="fa-pinterest-p">&#xf231; fa-pinterest-p</option>
						<option value="fa-pinterest-square">&#xf0d3; fa-pinterest-square</option>
						<option value="fa-plane">&#xf072; fa-plane</option>
						<option value="fa-play">&#xf04b; fa-play</option>
						<option value="fa-play-circle">&#xf144; fa-play-circle</option>
						<option value="fa-play-circle-o">&#xf01d; fa-play-circle-o</option>
						<option value="fa-plug">&#xf1e6; fa-plug</option>
						<option value="fa-plus">&#xf067; fa-plus</option>
						<option value="fa-plus-circle">&#xf055; fa-plus-circle</option>
						<option value="fa-plus-square">&#xf0fe; fa-plus-square</option>
						<option value="fa-plus-square-o">&#xf196; fa-plus-square-o</option>
						<option value="fa-power-off">&#xf011; fa-power-off</option>
						<option value="fa-print">&#xf02f; fa-print</option>
						<option value="fa-puzzle-piece">&#xf12e; fa-puzzle-piece</option>
						<option value="fa-qq">&#xf1d6; fa-qq</option>
						<option value="fa-qrcode">&#xf029; fa-qrcode</option>
						<option value="fa-question">&#xf128; fa-question</option>
						<option value="fa-question-circle">&#xf059; fa-question-circle</option>
						<option value="fa-quote-left">&#xf10d; fa-quote-left</option>
						<option value="fa-quote-right">&#xf10e; fa-quote-right</option>
						<option value="fa-ra">&#xf1d0; fa-ra</option>
						<option value="fa-random">&#xf074; fa-random</option>
						<option value="fa-rebel">&#xf1d0; fa-rebel</option>
						<option value="fa-recycle">&#xf1b8; fa-recycle</option>
						<option value="fa-reddit">&#xf1a1; fa-reddit</option>
						<option value="fa-reddit-square">&#xf1a2; fa-reddit-square</option>
						<option value="fa-refresh">&#xf021; fa-refresh</option>
						<option value="fa-registered">&#xf25d; fa-registered</option>
						<option value="fa-remove">&#xf00d; fa-remove</option>
						<option value="fa-renren">&#xf18b; fa-renren</option>
						<option value="fa-reorder">&#xf0c9; fa-reorder</option>
						<option value="fa-repeat">&#xf01e; fa-repeat</option>
						<option value="fa-reply">&#xf112; fa-reply</option>
						<option value="fa-reply-all">&#xf122; fa-reply-all</option>
						<option value="fa-retweet">&#xf079; fa-retweet</option>
						<option value="fa-rmb">&#xf157; fa-rmb</option>
						<option value="fa-road">&#xf018; fa-road</option>
						<option value="fa-rocket">&#xf135; fa-rocket</option>
						<option value="fa-rotate-left">&#xf0e2; fa-rotate-left</option>
						<option value="fa-rotate-right">&#xf01e; fa-rotate-right</option>
						<option value="fa-rouble">&#xf158; fa-rouble</option>
						<option value="fa-rss">&#xf09e; fa-rss</option>
						<option value="fa-rss-square">&#xf143; fa-rss-square</option>
						<option value="fa-rub">&#xf158; fa-rub</option>
						<option value="fa-ruble">&#xf158; fa-ruble</option>
						<option value="fa-rupee">&#xf156; fa-rupee</option>
						<option value="fa-safari">&#xf267; fa-safari</option>
						<option value="fa-sliders">&#xf1de; fa-sliders</option>
						<option value="fa-slideshare">&#xf1e7; fa-slideshare</option>
						<option value="fa-smile-o">&#xf118; fa-smile-o</option>
						<option value="fa-sort-asc">&#xf0de; fa-sort-asc</option>
						<option value="fa-sort-desc">&#xf0dd; fa-sort-desc</option>
						<option value="fa-sort-down">&#xf0dd; fa-sort-down</option>
						<option value="fa-spinner">&#xf110; fa-spinner</option>
						<option value="fa-spoon">&#xf1b1; fa-spoon</option>
						<option value="fa-spotify">&#xf1bc; fa-spotify</option>
						<option value="fa-square">&#xf0c8; fa-square</option>
						<option value="fa-square-o">&#xf096; fa-square-o</option>
						<option value="fa-star">&#xf005; fa-star</option>
						<option value="fa-star-half">&#xf089; fa-star-half</option>
						<option value="fa-stop">&#xf04d; fa-stop</option>
						<option value="fa-subscript">&#xf12c; fa-subscript</option>
						<option value="fa-tablet">&#xf10a; fa-tablet</option>
						<option value="fa-tachometer">&#xf0e4; fa-tachometer</option>
						<option value="fa-tag">&#xf02b; fa-tag</option>
						<option value="fa-tags">&#xf02c; fa-tags</option>
					</select>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" id="package_feature[]" name="package_feature[]" placeholder="<?php esc_attr_e('Enter Feature','jobbank'); ?>"></textarea>
				</div>
				<div class="col-md-4">
				</div>
			</div>
			<div class="clearfix"></div>
			<div  class="form-group row" id="pac_feature_all">
			</div>
			<div class="form-group row">
				<label for="text" class="col-md-2 control-label"></label>
				<div class="col-md-8 ">					
						<button type="button" onclick="jobbank_add_feature_field();"  class="btn btn-primary btn-sm"><?php esc_html_e('Add More Feature','jobbank'); ?></button>
					
				</div>
			</div>
			<div class="form-group row">
				<label for="text" class="col-md-2 control-label"> <?php esc_html_e('Order','jobbank'); ?> </label>
				<div class="col-md-6 ">
					<label>
						<input type="text" class="form-control" id="package_order" name="package_order"  value="<?php echo esc_attr(get_post_meta($package_id, 'jobbank_display_order', true)); ?>" placeholder="<?php esc_attr_e('Enter order number e.g. 1','jobbank'); ?>">
					</label>
				</div>
			</div>
			
			<h3 class="page-header"> <?php esc_html_e('Access Control','jobbank'); ?></h3>
				
			<div class="form-group row">
				<label for="text" class="col-md-2 control-label"> <?php esc_html_e('Listing Limit (Max job post for the package)','jobbank'); ?></label>
				<div class="col-md-6 ">
					<label>
						<input type="text" class="form-control" id="max_pst_no" value="<?php echo esc_attr(get_post_meta($package_id, 'jobbank_package_max_post_no', true)); ?>"   name="max_pst_no"  placeholder="<?php esc_html_e('Enter only number e.g. 1','jobbank'); ?>">
					</label>
				</div>
			</div>
			
			<div class="form-group row">
				<label for="text" class="col-md-2 control-label"> <?php  esc_html_e('Job post will be feature. It will appear on top ','jobbank'); ?> </label>
				<div class="col-md-6 ">
					<label>
						<input type="checkbox" name="listing_feature" id="listing_feature"  value='yes' <?php echo (get_post_meta($package_id, 'jobbank_package_feature', true)=='yes'?'checked': ''); ?>><?php  esc_html_e(' Will Add On Featured List (show on top)','jobbank'); ?>
					</label>								 										
				</div>																
			</div>
			
			
		
			<h3 class="page-header"> <?php esc_html_e( 'Billing Details', 'jobbank' );?></h3>
			<div class="form-group row">
				<label for="inputEmail3" class="col-md-2 control-label"><?php esc_html_e( 'Initial Payment', 'jobbank' );?></label>
				<div class="col-md-6">
					<input type="text" class="form-control" id="package_cost" name="package_cost" value="<?php echo esc_attr(get_post_meta($package_id, 'jobbank_package_cost', true)); ?>"  ><?php esc_html_e( 'The Initial Amount Collected at User Registration.', 'jobbank' );?>
				</div>
			</div>
			<div class="form-group row">
				<label for="text" class="col-md-2 control-label"><?php esc_html_e( 'Package Expire After', 'jobbank' );?></label>
				<div class="col-md-2">
					<select id="package_initial_expire_interval" name="package_initial_expire_interval" class="ctrl-combobox form-control">
						<?php
							$package_initial_period_interval= get_post_meta($package_id, 'jobbank_package_initial_expire_interval', true); 
							echo '<option value="">None</option>';
							for($ii=1;$ii<31;$ii++){
								echo '<option value="'.$ii.'" '.($package_initial_period_interval == $ii ? 'selected' : '').'>'.$ii.'</option>';
							}
						?>
					</select>	
				</div>	
				<div class="col-md-4">
					<?php
						$package_initial_expire_type= get_post_meta($package_id, 'jobbank_package_initial_expire_type', true); 
					?>
					<select name="package_initial_expire_type" id ="package_initial_expire_type" class=" form-control">			
						<option value=""><?php esc_html_e( 'None', 'jobbank' );?> </option>								
						<option value="day" <?php echo ($package_initial_expire_type == 'day' ? 'selected' : '') ?>><?php esc_html_e( 'Day(s)', 'jobbank' );?></option>
						<option value="week" <?php echo ($package_initial_expire_type == 'week' ? 'selected' : '') ?>><?php esc_html_e( 'Week(s)', 'jobbank' );?></option>
						<option value="month" <?php echo ($package_initial_expire_type == 'month' ? 'selected' : '') ?>><?php esc_html_e( 'Month(s)', 'jobbank' );?></option>
						<option value="year" <?php echo ($package_initial_expire_type == 'year' ? 'selected' : '') ?>><?php esc_html_e( 'Year(s)', 'jobbank' );?></option>
					</select>		
				</div>
				<div class='col-md-12'><label for="text" class="col-md-2 control-label"></label>
					<?php esc_html_e( 'If select none then user  package will expire after 19 years. Package Expire Option will not work on Recurring Subscription. "Billing Cycle Limit" will Work For Recurring Subscription.', 'jobbank' );?>
				</div>
			</div>
			<div class="form-group row">
				<label for="text" class="col-md-2 control-label"> <?php esc_html_e( 'Recurring Subscription', 'jobbank' );?></label>
				<div class="col-md-6 ">
					<label>
						<input type="checkbox"  <?php echo (get_post_meta($package_id, 'jobbank_package_recurring', true)=='on'?'checked': ''); ?> name="package_recurring" id="package_recurring" value="on" > <?php esc_html_e( 'Enable Recurring Payment', 'jobbank' );?>
					</label>
				</div>								
			</div>
			<div id="recurring_block" style="display:<?php echo (get_post_meta($package_id, 'jobbank_package_recurring', true)=='on'?'': 'none'); ?>" >		  
				<?php
					if(get_option('jobbank_payment_gateway')=='stripe5555'){
					?>	
					<div class="form-group row">
						<label for="text" class="col-md-2 control-label"><?php esc_html_e( 'Stripe Plan Name(not ID)', 'jobbank' );?></label>
						<div class="col-md-2">
							<input type="text" class="form-control" value="<?php echo esc_attr(get_post_meta($package_id, 'jobbank_stripe_plan', true)); ?>" name ="jobbank_stripe_plan" id="jobbank_stripe_plan" >
						</div>
						<div class="col-md-7"><?php
							esc_html_e('The plugin will create the Plan on Stripe account automatically. If you get any payment error then you need to create a Plan on your stripe account/dashboard and add the name here.','jobbank');
						?>
						</div>
					</div>	
					<?php							
					}
				?>
				<div class="form-group row">
					<label for="text" class="col-md-2 control-label"><?php esc_html_e( 'Billing Amount', 'jobbank' );?></label>
					<div class="col-md-2">
						<input type="text" class="form-control" value="<?php echo esc_attr(get_post_meta($package_id, 'jobbank_package_recurring_cost_initial', true)); ?>" name ="package_recurring_cost_initial" id="package_recurring_cost_initial" >
					</div>
					<label for="text" class="col-md-1 control-label"><?php esc_html_e( 'Per', 'jobbank' );?></label>
					<div class="col-md-1">									
						<input type="text" class="form-control" value="<?php echo esc_attr(get_post_meta($package_id, 'jobbank_package_recurring_cycle_count', true)); ?>" id="package_recurring_cycle_count" name="package_recurring_cycle_count" placeholder="<?php esc_html_e( 'Cycle #', 'jobbank' );?>">
					</div>
					<div class="col-md-2">
						<?php $package_recurring_cycle_type= get_post_meta($package_id, 'jobbank_package_recurring_cycle_type', true); ?>
						<select name="package_recurring_cycle_type" id ="package_recurring_cycle_type" class="form-control">											
							<option value="day" <?php echo ($package_recurring_cycle_type == 'day' ? 'selected' : '') ?>> <?php esc_html_e( 'Day(s)', 'jobbank' );?></option>
							<option value="week" <?php echo ($package_recurring_cycle_type == 'week' ? 'selected' : '') ?>><?php esc_html_e( 'Week(s)', 'jobbank' );?></option>
							<option value="month" <?php echo ($package_recurring_cycle_type == 'month' ? 'selected' : '') ?>><?php esc_html_e( 'Month(s)', 'jobbank' );?></option>
							<option value="year" <?php echo ($package_recurring_cycle_type == 'year' ? 'selected' : '') ?>><?php esc_html_e( 'Year(s)', 'jobbank' );?></option>
						</select>		
					</div>
					<div class='col-md-12'><label for="text" class="col-md-2 control-label"></label>
						<?php esc_html_e( 'The "Billing Amount" will Collect at User Registration.', 'jobbank' );?>
					</div>
				</div>
				 <?php
					 if(get_option('jobbank_payment_gateway')!='woocommerce'){
					?>
				<div class="form-group row">
					<label for="text" class="col-md-2 control-label"><?php esc_html_e( 'Billing Cycle Limit', 'jobbank' );?></label>
					<div class="col-md-2">
						<select name="package_recurring_cycle_limit" id ="package_recurring_cycle_limit" class="ctrl-combobox form-control">	
							<option value=""><?php esc_html_e( 'Never', 'jobbank' );?></option>										
							<?php
								$package_recurring_cycle_limit= get_post_meta($package_id, 'jobbank_package_recurring_cycle_limit', true); 
								for($ii=1;$ii<35;$ii++){
									echo '<option value="'.$ii.'" '.($package_recurring_cycle_limit == $ii ? 'selected' : '').'>'.$ii.'</option>';
								}
							?>
						</select>		
					</div>
				</div>
				<div class="form-group row">
					<label for="text" class="col-md-2 control-label"> <?php esc_html_e( 'Trial', 'jobbank' );?></label>
					<div class="col-md-6 ">
						<label>
							<input type="checkbox" <?php echo (get_post_meta($package_id, 'jobbank_package_enable_trial_period', true)=='yes'? 'checked': ''); ?> name="package_enable_trial_period" id="package_enable_trial_period" value='yes'> <?php esc_html_e( 'Enable Trial Period', 'jobbank' );?>
						</label>
						<br/>
						<?php esc_html_e( '"Billing Amount" will Collect After Trial Period.', 'jobbank' );?>   
					</div>								
				</div>
				<div id="trial_block" style="display:<?php echo (get_post_meta($package_id, 'jobbank_package_enable_trial_period', true)=='yes'? '': 'none'); ?>" >		  
					<div class="form-group row">
						<label for="inputEmail3" class="col-md-2 control-label"><?php esc_html_e( 'Trial Amount', 'jobbank' );?></label>
						<div class="col-md-6">
							<input type="text" class="form-control" value="<?php echo esc_attr(get_post_meta($package_id, 'jobbank_package_trial_amount', true)); ?>" id="package_trial_amount" name="package_trial_amount" >
							<?php esc_html_e( 'Amount to Bill for The Trial Period. Free is 0.[Stripe will not support this option ]', 'jobbank' );?>
						</div>
					</div>
					<div class="form-group row">
						<label for="text" class="col-md-2 control-label"><?php esc_html_e( 'Trial Period', 'jobbank' );?></label>
						<div class="col-md-2">
							<select id="package_trial_period_interval" name="package_trial_period_interval" class="ctrl-combobox form-control">
								<?php
									$package_trial_period_interval= get_post_meta($package_id, 'jobbank_package_trial_period_interval', true); 
									for($ii=1;$ii<31;$ii++){
										echo '<option value="'.$ii.'" '.($package_trial_period_interval == $ii ? 'selected' : '').'>'.$ii.'</option>';
									}
								?>
							</select>	
						</div>	
						<div class="col-md-4">
							<?php
								$package_recurring_trial_type= get_post_meta($package_id, 'jobbank_package_recurring_trial_type', true); 
							?>
							<select name="package_recurring_trial_type" id ="package_recurring_trial_type" class=" form-control">											
								<option value="day" <?php echo ($package_recurring_trial_type == 'day' ? 'selected' : '') ?>> <?php  esc_html_e('Day(s)','jobbank'); ?></option>
								<option value="week" <?php echo ($package_recurring_trial_type == 'week' ? 'selected' : '') ?>><?php  esc_html_e('Week(s)','jobbank'); ?></option>
								<option value="month" <?php echo ($package_recurring_trial_type == 'month' ? 'selected' : '') ?>><?php  esc_html_e('Month(s)','jobbank'); ?></option>
								<option value="year" <?php echo ($package_recurring_trial_type == 'year' ? 'selected' : '') ?>><?php  esc_html_e('Year(s)','jobbank'); ?></option>
							</select>		
						</div>
						<div class='col-md-12'><label for="text" class="col-md-2 control-label"></label>
							<?php esc_html_e( 'After The Trial Period "Billing Amount"	Will Be Billed.	', 'jobbank' );?>
						</div>
					</div>
				</div> <!-- Trial Block --> 
				<?php
					 }
				?>
			</div> <!-- Recurring Block -->	  
			<?php
if(get_option('jobbank_payment_gateway')=='woocommerce'){
	if ( class_exists( 'WooCommerce' ) ) {
		 $jobbank_woo_pro= get_post_meta($package_id, 'jobbank_package_woocommerce_product', true);
	?>  
	  <div class="form-group row">
		<label for="text" class="col-md-2 control-label"><?php esc_html_e('Woocommerce Product','jobbank'); ?></label>
		<div class="col-md-3">							
				<select  class="form-control" id="Woocommerce_product" name="Woocommerce_product">
					<?php 	
					$publish='publish';	
					$sql=$wpdb->prepare("SELECT * FROM $wpdb->posts where post_type='product'  and post_status=%s",$publish);		
					$product_rows = $wpdb->get_results($sql);	
					if(sizeof($product_rows)>0){									
						foreach ( $product_rows as $row ) 
						{	$selected='';
							if($jobbank_woo_pro==$row->ID){$selected=' selected';}												
																				
							echo '<option value="'.esc_html($row->ID).'"'.$selected.' >'.esc_html($row->post_title).' </option>';
						}
					}	
					?>											
				</select>                                     			
			</div>	
		</div>							
<?php
	}
}	
?>
			
									
		<div class="form-group row">
				<label for="text" class="col-md-2 control-label"></label>
				<div class="col-md-6 ">
					<p><hr></p>
					<div id="loading"></div>
					<button class="btn btn-info mt-2" onclick="return jobbank_update_the_package();"><?php  esc_html_e('Save Package','jobbank'); ?></button>
				<a href="<?php echo ep_jobbank_ADMINPATH; ?>admin.php?page=jobbank-settings&packages" class="btn btn-info mt-2" ><?php esc_html_e( '<< Back', 'jobbank' );?></a>
				</div>																
			</div>	
		</form>
	</div>
</div>	
	<?php
	include('footer.php');
?>	
	