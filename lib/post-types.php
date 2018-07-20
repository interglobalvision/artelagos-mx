<?php
// Menu icons for Custom Post Types
// https://developer.wordpress.org/resource/dashicons/
function add_menu_icons_styles(){
?>

<style>
#menu-posts-exhibition .dashicons-admin-post:before {
  content: "\f128";
}
#menu-posts-event .dashicons-admin-post:before {
  content: "\f508";
}
#menu-posts-resident .dashicons-admin-post:before {
  content: "\f118";
}
#menu-posts-studio .dashicons-admin-post:before {
  content: "\f309";
}
</style>

<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );


//Register Custom Post Types
add_action( 'init', 'register_cpt_exhibition' );

function register_cpt_exhibition() {

  $labels = array(
    'name' => _x( 'Exhibitions', 'exhibition' ),
    'singular_name' => _x( 'Exhibition', 'exhibition' ),
    'add_new' => _x( 'Add New', 'exhibition' ),
    'add_new_item' => _x( 'Add New Exhibition', 'exhibition' ),
    'edit_item' => _x( 'Edit Exhibition', 'exhibition' ),
    'new_item' => _x( 'New Exhibition', 'exhibition' ),
    'view_item' => _x( 'View Exhibition', 'exhibition' ),
    'search_items' => _x( 'Search Exhibitions', 'exhibition' ),
    'not_found' => _x( 'No exhibitions found', 'exhibition' ),
    'not_found_in_trash' => _x( 'No exhibitions found in Trash', 'exhibition' ),
    'parent_item_colon' => _x( 'Parent Exhibition:', 'exhibition' ),
    'menu_name' => _x( 'Exhibitions', 'exhibition' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
  );

  register_post_type( 'exhibition', $args );
}

//Register Custom Post Types
add_action( 'init', 'register_cpt_event' );

function register_cpt_event() {

  $labels = array(
    'name' => _x( 'Events', 'event' ),
    'singular_name' => _x( 'Event', 'event' ),
    'add_new' => _x( 'Add New', 'event' ),
    'add_new_item' => _x( 'Add New Event', 'event' ),
    'edit_item' => _x( 'Edit Event', 'event' ),
    'new_item' => _x( 'New Event', 'event' ),
    'view_item' => _x( 'View Event', 'event' ),
    'search_items' => _x( 'Search Events', 'event' ),
    'not_found' => _x( 'No events found', 'event' ),
    'not_found_in_trash' => _x( 'No events found in Trash', 'event' ),
    'parent_item_colon' => _x( 'Parent Event:', 'event' ),
    'menu_name' => _x( 'Events', 'event' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
  );

  register_post_type( 'event', $args );
}

//Register Custom Post Types
add_action( 'init', 'register_cpt_resident' );

function register_cpt_resident() {

  $labels = array(
    'name' => _x( 'Residents', 'resident' ),
    'singular_name' => _x( 'Resident', 'resident' ),
    'add_new' => _x( 'Add New', 'resident' ),
    'add_new_item' => _x( 'Add New Resident', 'resident' ),
    'edit_item' => _x( 'Edit Resident', 'resident' ),
    'new_item' => _x( 'New Resident', 'resident' ),
    'view_item' => _x( 'View Resident', 'resident' ),
    'search_items' => _x( 'Search Residents', 'resident' ),
    'not_found' => _x( 'No residents found', 'resident' ),
    'not_found_in_trash' => _x( 'No residents found in Trash', 'resident' ),
    'parent_item_colon' => _x( 'Parent Resident:', 'resident' ),
    'menu_name' => _x( 'Residents', 'resident' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
  );

  register_post_type( 'resident', $args );
}

//Register Custom Post Types
add_action( 'init', 'register_cpt_studio' );

function register_cpt_studio() {

  $labels = array(
    'name' => _x( 'Studios', 'studio' ),
    'singular_name' => _x( 'Studio', 'studio' ),
    'add_new' => _x( 'Add New', 'studio' ),
    'add_new_item' => _x( 'Add New Studio', 'studio' ),
    'edit_item' => _x( 'Edit Studio', 'studio' ),
    'new_item' => _x( 'New Studio', 'studio' ),
    'view_item' => _x( 'View Studio', 'studio' ),
    'search_items' => _x( 'Search Studios', 'studio' ),
    'not_found' => _x( 'No studios found', 'studio' ),
    'not_found_in_trash' => _x( 'No studios found in Trash', 'studio' ),
    'parent_item_colon' => _x( 'Parent Studio:', 'studio' ),
    'menu_name' => _x( 'Studios', 'studio' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
  );

  register_post_type( 'studio', $args );
}
