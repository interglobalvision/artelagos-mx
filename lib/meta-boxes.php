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

  /**
	 * Home
	 */

  $home_page = get_page_by_path('home');

  $home_metabox = new_cmb2_box( array(
    'id'            => $prefix . 'home_metabox',
    'title'         => esc_html__( 'Fields', 'cmb2' ),
    'object_types'  => array( 'page' ), // Post type
    'show_on'      => array(
      'key' => 'id',
      'value' => array($home_page->ID)
    ),
  ) );

  $sponsor_group = $home_metabox->add_field( array(
		'id'          => $prefix . 'footer_sponsor_group',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Footer Sponsor {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Sponsor', 'cmb2' ),
			'remove_button' => esc_html__( 'Remove Sponsor', 'cmb2' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

  $home_metabox->add_group_field( $sponsor_group, array(
		'name'       => esc_html__( 'Logo', 'cmb2' ),
		'id'         => 'logo',
		'type'       => 'file',
	) );

  $home_metabox->add_group_field( $sponsor_group, array(
		'name'       => esc_html__( 'Website', 'cmb2' ),
		'id'         => 'website',
		'type'       => 'text_url',
	) );

  /**
	 * Nosotros
	 */

  $nosotros_page = get_page_by_path('nosotros');

  $nosotros_metabox = new_cmb2_box( array(
    'id'            => $prefix . 'nosotros_metabox',
    'title'         => esc_html__( 'Fields', 'cmb2' ),
    'object_types'  => array( 'page' ), // Post type
    'show_on'      => array(
      'key' => 'id',
      'value' => array($nosotros_page->ID)
    ),
  ) );

  $team_group = $nosotros_metabox->add_field( array(
		'id'          => $prefix . 'team_group',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Team Member {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Team Member', 'cmb2' ),
			'remove_button' => esc_html__( 'Remove Team Member', 'cmb2' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

  $nosotros_metabox->add_group_field( $team_group, array(
		'name'       => esc_html__( 'Name', 'cmb2' ),
		'id'         => 'name',
		'type'       => 'text',
	) );

  $nosotros_metabox->add_group_field( $team_group, array(
		'name'       => esc_html__( 'Title', 'cmb2' ),
		'id'         => 'title',
		'type'       => 'text',
	) );

  $nosotros_metabox->add_group_field( $team_group, array(
		'name'       => esc_html__( 'Email', 'cmb2' ),
		'id'         => 'email',
		'type'       => 'text',
	) );

  $nosotros_metabox->add_field( array(
		'name'       => esc_html__( 'Partners', 'cmb2' ),
		'id'         => $prefix . 'partners',
		'type'       => 'text',
		'repeatable'      => true,
	) );

  $collaborator_group = $nosotros_metabox->add_field( array(
		'id'          => $prefix . 'collaborator_group',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Collaborator {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Collaborator', 'cmb2' ),
			'remove_button' => esc_html__( 'Remove Collaborator', 'cmb2' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

  $nosotros_metabox->add_group_field( $collaborator_group, array(
		'name'       => esc_html__( 'Name', 'cmb2' ),
		'id'         => 'name',
		'type'       => 'text',
	) );

  $nosotros_metabox->add_group_field( $collaborator_group, array(
		'name'       => esc_html__( 'Organization', 'cmb2' ),
		'id'         => 'org',
		'type'       => 'text',
	) );

  $nosotros_metabox->add_group_field( $collaborator_group, array(
		'name'       => esc_html__( 'Email', 'cmb2' ),
		'id'         => 'email',
		'type'       => 'text',
	) );

  $sponsor_group = $nosotros_metabox->add_field( array(
		'id'          => $prefix . 'sponsor_group',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Sponsor {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Sponsor', 'cmb2' ),
			'remove_button' => esc_html__( 'Remove Sponsor', 'cmb2' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

  $nosotros_metabox->add_group_field( $sponsor_group, array(
		'name'       => esc_html__( 'Name', 'cmb2' ),
		'id'         => 'name',
		'type'       => 'text',
	) );

  $nosotros_metabox->add_group_field( $sponsor_group, array(
		'name'       => esc_html__( 'Website', 'cmb2' ),
		'id'         => 'website',
		'type'       => 'text_url',
	) );

  /**
	 * Visitar
	 */

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
