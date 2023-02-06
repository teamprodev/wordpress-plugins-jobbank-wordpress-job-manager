<?php
global 	$jobbank_directory_url;
$jobbank_directory_url=get_option('ep_jobbank_url');					
if($jobbank_directory_url==""){$jobbank_directory_url='job';}	

	
function jobbank_taxonomy_add_custom_field() {
    ?>
    <div class="form-field term-image-wrap">
        <label for="cat-image"><?php esc_html_e('Image[Best: 250px X 380px]','jobbank');?></label>
        <p><a href="#" class="aw_upload_image_button button button-secondary" id="upload_image_btn"><?php esc_html_e('Upload Image','jobbank');?></a></p>
        <input type="text" name="category_image_url" id="category_image_url"  value="" size="40" />
    </div>
    <?php
}
add_action( $jobbank_directory_url.'-locations_add_form_fields', 'jobbank_taxonomy_add_custom_field', 10, 2 );
 
function jobbank_taxonomy_edit_custom_field($term) {
    $image = get_term_meta($term->term_id, 'jobbank_term_image', true);
    ?>
    <tr class="form-field term-image-wrap">
        <th scope="row"><label for="category_image_url"><?php esc_html_e('Image [Best: 250px X 380px]','jobbank');?></label></th>
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
add_action( $jobbank_directory_url.'-locations_edit_form_fields', 'jobbank_taxonomy_edit_custom_field', 10, 2 );

// Save data
add_action('created_'.$jobbank_directory_url.'-locations', 'jobbank_save_term_image', 10, 2);
function jobbank_save_term_image($term_id, $tt_id) {
    if (isset($_POST['category_image_url']) && '' !== $_POST['category_image_url']){
        $group = sanitize_url($_POST['category_image_url']);
        add_term_meta($term_id, 'jobbank_term_image', $group, true);
    }
}

///Now save the edited value
add_action('edited_'.$jobbank_directory_url.'-locations', 'jobbank_update_image_upload', 10, 2);
function jobbank_update_image_upload($term_id, $tt_id) {
    if (isset($_POST['category_image_url']) && '' !== $_POST['category_image_url']){
        $group = sanitize_url($_POST['category_image_url']);
        update_term_meta($term_id, 'jobbank_term_image', $group);
    }
}

// Js add
function jobbank_image_uploader_enqueue() {
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
add_action( 'admin_enqueue_scripts', 'jobbank_image_uploader_enqueue' );