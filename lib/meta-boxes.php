<?php

/* Get post objects for select field options */
function get_post_objects( $query_args ) {
  $args = wp_parse_args( $query_args, array(
    'post_type' => 'post',
  ) );
  $posts = get_posts( $args );
  $post_options = array();
  if ( $posts ) {
    foreach ( $posts as $post ) {
      $post_options [ $post->ID ] = $post->post_title;
    }
  }
  return $post_options;
}


/**
  * Include and setup custom metaboxes and fields.
  *
  * @category YourThemeOrPlugin
  * @package  Metaboxes
  * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
  * @link     https://github.com/WebDevStudios/CMB2
  */

/**
  * Hook in and add metaboxes. Can only happen on the 'cmb2_init' hook.
  */

add_action( 'cmb2_init', 'igv_cmb_metaboxes' );
function igv_cmb_metaboxes() {

  // Start with an underscore to hide fields from custom fields list
  $prefix = '_igv_';

  $common_metabox = new_cmb2_box( array(
		'id'            => $prefix . 'common_metabox',
		'title'         => esc_html__( 'Fields', 'cmb2' ),
		'object_types'  => array( 'exhibition', 'event', 'resident' ), // Post type
	) );

  $common_metabox->add_field( array(
		'name' => esc_html__( 'Start Date', 'cmb2' ),
		'id'   => $prefix . 'start_date',
		'type' => 'text_date_timestamp',
	) );

  $common_metabox->add_field( array(
		'name' => esc_html__( 'End Date', 'cmb2' ),
		'id'   => $prefix . 'end_date',
		'type' => 'text_date_timestamp',
	) );

  $common_metabox->add_field( array(
		'name'         => esc_html__( 'Documentation', 'cmb2' ),
		'id'           => $prefix . 'documentation',
		'type'         => 'file_list',
		'preview_size' => array( 150, 150 ), // Default: array( 50, 50 )
	) );

  $options_metabox = new_cmb2_box( array(
		'id'            => $prefix . 'options_metabox',
		'title'         => esc_html__( 'Fields', 'cmb2' ),
		'object_types'  => array( 'exhibition', 'event' ), // Post type
	) );

  $options_metabox->add_field( array(
		'name' => esc_html__( 'Opening times', 'cmb2' ),
		'id'   => $prefix . 'opening_times',
		'type' => 'text',
	) );

  $options_metabox->add_field( array(
    'name'      	=> __( 'Residents', 'cmb2' ),
    'id'        	=> 'related_residents',
    'type'      	=> 'post_search_ajax',
    'desc'			=> __( '(Start typing resident name)', 'cmb2' ),
    // Optional :
    'limit' => 100,
    'sortable' 	 	=> true, 	// Allow selected items to be sortable (default false)
    'query_args'	=> array(
      'post_type'			=> array( 'resident' ),
      'post_status'		=> array( 'publish' ),
      'posts_per_page'	=> -1
    )
  ) );

  $visitar_page = get_page_by_path('visitar');

  $visitar_metabox = new_cmb2_box( array(
    'id'            => $prefix . 'visitar_metabox',
    'title'         => esc_html__( 'Fields', 'cmb2' ),
    'object_types'  => array( 'page' ), // Post type
    'show_on'      => array(
      'key' => 'id',
      'value' => array($visitar_page->ID)
    ),
  ) );

  $visitar_metabox->add_field( array(
		'name' => esc_html__( 'Address', 'cmb2' ),
		'id'   => $prefix . 'address',
		'type' => 'textarea_small',
	) );

  $visitar_metabox->add_field( array(
		'name' => esc_html__( 'Email', 'cmb2' ),
		'id'   => $prefix . 'email',
		'type' => 'text',
	) );

  $visitar_metabox->add_field( array(
		'name' => esc_html__( 'Phone', 'cmb2' ),
		'id'   => $prefix . 'phone',
		'type' => 'text',
	) );

  $visitar_metabox->add_field( array(
		'name' => esc_html__( 'Opening times', 'cmb2' ),
		'id'   => $prefix . 'space_opening_times',
		'type' => 'textarea_small',
	) );

  $visitar_metabox->add_field( array(
		'name' => esc_html__( 'Public transportation', 'cmb2' ),
		'id'   => $prefix . 'public_transportation',
		'type' => 'textarea_small',
	) );

  $visitar_metabox->add_field( array(
		'name' => esc_html__( 'Exterior photo', 'cmb2' ),
		'id'   => $prefix . 'exterior_photo',
		'type' => 'file',
	) );

}
?>
