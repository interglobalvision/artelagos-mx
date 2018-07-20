<?php

if( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
}

if( function_exists( 'add_image_size' ) ) {
  add_image_size( 'admin-thumb', 150, 150, false );
  add_image_size( 'opengraph', 1200, 630, true );

  add_image_size( 'gallery', 1200, 9999, false );

  add_image_size( 'resident-archive', 273, 381, true );
  add_image_size( 'resident-current', 430, 600, true );

  add_image_size( 'exhibition-current', 1840, 750, true );
  add_image_size( 'exhibition-archive', 430, 300, true );

  add_image_size( 'event-current', 900, 628, true );
}
