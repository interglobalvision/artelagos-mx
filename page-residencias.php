<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">


<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();
?>
      <div class="grid-row page-section">

        <div <?php post_class('grid-item item-s-12 item-xl-8 font-size-mid'); ?> id="post-<?php the_ID(); ?>">

          <?php the_content(); ?>

        </div>

      </div>
<?php
  }
}

$now = time();

$args = array(
	'post_type'              => array( 'resident' ),
	'posts_per_page'         => '-1',
  'meta_query' => array(
    'relation' => 'AND',
    array(
      'key'     => '_igv_start_date',
      'value'   => $now,
      'compare' => '<=',
    ),
    array(
      'key'     => '_igv_end_date',
      'value'   => $now,
      'compare' => '>=',
    ),
  ),
);

$current_residents = new WP_Query( $args );

if ( $current_residents->have_posts() ) {
?>
      <div class="grid-row page-section">
        <h2 class="grid-item item-s-12 section-label">Residentes Actuales</h2>
<?php
	while ( $current_residents->have_posts() ) {
		$current_residents->the_post();

    $start_date = get_post_meta($post->ID, '_igv_start_date', true);
    $end_date = get_post_meta($post->ID, '_igv_end_date', true);
?>
      	<div class="grid-item item-s-6 item-m-4 item-l-3">
          <?php the_post_thumbnail('resident-current'); ?>
          <div class="font-uppercase font-size-small">
            <span class="item-label">Residente</span>
            <span class="u-inline-block"><?php igv_date_string($start_date, $end_date); ?></span>
          </div>
          <h3><?php the_title(); ?></h3>
        </div>
<?php
	}
?>
      </div>
<?php
}

$args = array(
	'post_type'              => array( 'resident' ),
	'posts_per_page'         => '-1',
  'meta_key' => '_igv_start_date',
  'order_by'  => 'meta_key',
  'order' => 'ASC',
  'meta_query' => array(
    array(
      'key'     => '_igv_start_date',
      'value'   => $now,
      'compare' => '>',
    ),
  ),
);

$future_residents = new WP_Query( $args );

if ( $future_residents->have_posts() ) {
?>
      <div class="grid-row page-section">
        <h2 class="grid-item item-s-12 section-label">Residentes Proximos</h2>
<?php
	while ( $future_residents->have_posts() ) {
		$future_residents->the_post();

    $start_date = get_post_meta($post->ID, '_igv_start_date', true);
    $end_date = get_post_meta($post->ID, '_igv_end_date', true);
?>
      	<div class="grid-item item-s-4 item-m-3 item-l-2">
          <?php the_post_thumbnail('resident-archive'); ?>
          <div class="font-uppercase font-size-small">
            <span class="item-label">Residente</span>
            <span class="u-inline-block"><?php igv_date_string($start_date, $end_date); ?></span>
          </div>
          <h3><?php the_title(); ?></h3>
        </div>
<?php
	}
?>
      </div>
<?php
}

$args = array(
	'post_type'              => array( 'resident' ),
	'posts_per_page'         => '-1',
  'meta_key' => '_igv_end_date',
  'order_by'  => 'meta_key',
  'order' => 'DESC',
  'meta_query' => array(
    array(
      'key'     => '_igv_end_date',
      'value'   => $now,
      'compare' => '<',
    ),
  ),
);

$past_residents = new WP_Query( $args );

if ( $past_residents->have_posts() ) {
?>
      <div class="grid-row page-section">
        <h2 class="grid-item item-s-12 section-label">Residentes Pasados</h2>
<?php
	while ( $past_residents->have_posts() ) {
		$past_residents->the_post();

    $start_date = get_post_meta($post->ID, '_igv_start_date', true);
    $end_date = get_post_meta($post->ID, '_igv_end_date', true);
?>
      	<div class="grid-item item-s-4 item-m-3 item-l-2">
          <?php the_post_thumbnail('resident-archive'); ?>
          <div class="font-uppercase font-size-small">
            <span class="item-label">Residente</span>
            <span class="u-inline-block"><?php igv_date_string($start_date, $end_date); ?></span>
          </div>
          <h3><?php the_title(); ?></h3>
        </div>
<?php
	}
?>
      </div>
<?php
}

wp_reset_postdata();
?>

      </div>
    </div>
  </section>
</main>

<?php
get_footer();
?>
