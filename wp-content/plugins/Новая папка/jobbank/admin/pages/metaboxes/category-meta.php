<?php
global 	$jobbank_directory_url;
$jobbank_directory_url=get_option('ep_jobbank_url');					
if($jobbank_directory_url==""){$jobbank_directory_url='job';}	

wp_enqueue_script("jquery");	
wp_enqueue_style('fontawesome-browser', ep_jobbank_URLPATH . 'admin/files/css/fontawesome-browser.css');	
wp_enqueue_style('all-font-awesome', 			ep_jobbank_URLPATH . 'admin/files/css/fontawesome.css');


function jobbank_taxonomy_add_category_custom_field() {
    ?>	
	<div class="form-field ">
		<label for="cat-image"><?php esc_html_e('Select Icon','jobbank');?></label>
		<p>
		<input type="text" name="cat-icon"  id="caticoninput"  class="form-control" placeholder="<?php esc_html_e('Select Icon','jobbank');?>"  />
		 <a href="javascript:void(0);" onclick="jobbank_icon_uploader('caticoninput');"  class="button button-secondary"><?php esc_html_e('Upload Icon','jobbank');?></a>
		</p>
	</div>
	 <div class="form-field term-image-wrap">
        <label for="cat-marker"><?php esc_html_e('Map Marker','jobbank');?></label>
        <p><a href="#" class="aw_upload_image_button button button-secondary" id="upload_marker_btn"><?php esc_html_e('Upload Marker','jobbank');?></a></p>
        <input type="text" name="category_marker_url" id="category_marker_url"  value="" size="40" />
    </div>	
    <div class="form-field term-image-wrap">
        <label for="cat-image"><?php esc_html_e('Image[Best: 300 X 200px]','jobbank');?></label>		
        <p><a href="#" class="aw_upload_image_button button button-secondary" id="upload_image_btn"><?php esc_html_e('Upload Image','jobbank');?></a></p>
        <input type="text" name="category_image_url" id="category_image_url"  value="" size="40" />
    </div>	
 <?php
}
add_action( $jobbank_directory_url.'-category_add_form_fields', 'jobbank_taxonomy_add_category_custom_field', 10, 2 );
 
function jobbank_taxonomy_edit_category_custom_field($term) {
    $image = get_term_meta($term->term_id, 'jobbank_term_image', true);
	$caticon= get_term_meta($term->term_id, 'jobbank_term_icon', true);
	$map_marker= get_term_meta($term->term_id, 'jobbank_term_mapmarker', true);
    ?>
	 <tr class="form-field ">
        <th scope="row"><label ><?php esc_html_e('Select Icon','jobbank');?></label></th>
        <td>
		<p>
          <input type="text" name="cat-icon" id="caticoninputedit" value="<?php echo esc_attr($caticon); ?>"  class="form-control" placeholder="<?php esc_html_e('Select Icon','jobbank');?>"  />
		  <a href="javascript:void(0);" onclick="jobbank_icon_uploader('caticoninputedit');"  class="button button-secondary"><?php esc_html_e('Upload Icon Edit','jobbank');?></a></p>
          
        </td>
    </tr>
	 <tr class="form-field term-image-wrap">
        <th scope="row"><label for="category_marker_url"><?php esc_html_e('Map Marker','jobbank');?></label></th>
        <td>
            <p><a href="#" class="aw_upload_image_button button button-secondary" id="upload_marker_btn"><?php esc_html_e('Upload Map Marker','jobbank');?> </a>				
				<img src="<?php echo esc_url($map_marker); ?>" id="jobbank_term_marker_dis" width="100px">
			</p>			
			<br/>
            <input type="text" name="category_marker_url"  id="category_marker_url" value="<?php echo esc_url($map_marker); ?>" size="40" />
        </td>
    </tr>
	
	 <tr class="form-field term-image-wrap">
        <th scope="row"><label for="category_image_url"><?php esc_html_e('Image [Best: 300px X 200px]','jobbank');?></label></th>
        <td>
            <p><a href="#" class="aw_upload_image_button button button-secondary" id="upload_image_btn"><?php esc_html_e('Upload Image','jobbank');?> </a>				
				<img src="<?php echo esc_url($image); ?>" id="jobbank_term_image_dis" width="100px">
			</p>			
			<br/>
            <input type="text" name="category_image_url"  id="category_image_url" value="<?php echo esc_url($image); ?>" size="40" />
        </td>
    </tr>
	
   
    <?php
}
add_action( $jobbank_directory_url.'-category_edit_form_fields', 'jobbank_taxonomy_edit_category_custom_field', 10, 2 );

// Save data
add_action('created_'.$jobbank_directory_url.'-category', 'jobbank_save_term_category_image', 10, 2);
function jobbank_save_term_category_image($term_id, $tt_id) {
    if (isset($_POST['category_image_url']) && '' !== $_POST['category_image_url']){
        $group = sanitize_url($_POST['category_image_url']);
        add_term_meta($term_id, 'jobbank_term_image', $group, true);
    }
	if (isset($_POST['category_marker_url']) && '' !== $_POST['category_marker_url']){
        $group = sanitize_url($_POST['category_marker_url']);
        add_term_meta($term_id, 'jobbank_term_mapmarker', $group, true);
    }
	
	if (isset($_POST['cat-icon']) && '' !== $_POST['cat-icon']){
        $caticon = sanitize_text_field($_POST['cat-icon']);
        add_term_meta($term_id, 'jobbank_term_icon', $caticon, true);
    }
	
}

///Now save the edited value
add_action('edited_'.$jobbank_directory_url.'-category', 'jobbank_update_image_upload_category', 10, 2);
function jobbank_update_image_upload_category($term_id, $tt_id) {
    if (isset($_POST['category_image_url']) && '' !== $_POST['category_image_url']){
        $group = sanitize_url($_POST['category_image_url']);
        update_term_meta($term_id, 'jobbank_term_image', $group);
    }
	if (isset($_POST['category_marker_url']) && '' !== $_POST['category_marker_url']){
		 $group = sanitize_url($_POST['category_marker_url']);
        update_term_meta($term_id, 'jobbank_term_mapmarker', $group);
    }
	
	if (isset($_POST['cat-icon']) && '' !== $_POST['cat-icon']){	
         $caticon = sanitize_text_field($_POST['cat-icon']);
         update_term_meta($term_id, 'jobbank_term_icon', $caticon);
    }
}

// Js add
function jobbank_image_uploader_enqueue_category() {
    global $typenow,$jobbank_directory_url;	
    if( ($typenow == $jobbank_directory_url) ) { 
		wp_enqueue_media();
        wp_register_script( 'jobbank_meta-image', ep_jobbank_URLPATH . 'admin/files/js/meta-media-uploader.js', array( 'jquery' ) );
        wp_localize_script( 'jobbank_meta-image', 'meta_image',
            array(
                'title' => 'Upload an Image',
                'button' => 'Use this Image',
            )
        );
        wp_enqueue_script( 'jobbank_meta-image' );
    }
}
add_action( 'admin_enqueue_scripts', 'jobbank_image_uploader_enqueue_category' );