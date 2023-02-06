<?php	
function jobbank_loadMyBlock() {
  wp_enqueue_script(
    'jobbank-block',
    ep_jobbank_URLPATH . 'admin/files/js/gutenberg-block.js',
    array('wp-blocks','wp-editor'),
    true
  );
}
   
add_action('enqueue_block_editor_assets', 'jobbank_loadMyBlock');

// Block Category
function jobbank_filter_block_categories_when_post_provided( $block_categories, $editor_context ) {
    if ( ! empty( $editor_context->post ) ) {
        array_push(
            $block_categories,
            array(
                'slug'  => 'jobbank-category',
				'icon'  => 'dashicons-before dashicons-universal-access-alt',
                'title' => esc_html__( 'Jobbank', 'jobbank' ),                
            )
        );
    }
    return $block_categories;
}
 
add_filter( 'block_categories_all', 'jobbank_filter_block_categories_when_post_provided', 10, 2 );
