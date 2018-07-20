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

  }
}

$now = time();

$args = array(
	'post_type'              => array( 'exhibition' ),
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

$current_exhibitions = new WP_Query( $args );

if ( $current_exhibitions->have_posts() ) {
?>
      <div class="grid-row page-section">
        <h2 class="grid-item item-s-12 section-label">Exposiciones Actuales</h2>
<?php
	while ( $current_exhibitions->have_posts() ) {
		$current_exhibitions->the_post();

    $start_date = get_post_meta($post->ID, '_igv_start_date', true);
    $end_date = get_post_meta($post->ID, '_igv_end_date', true);
?>
      	<div class="grid-item item-s-12">
          <?php the_post_thumbnail('exhibition-current'); ?>
          <div class="font-uppercase font-size-small">
            <span class="item-label">Exposición</span>
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
	'post_type'              => array( 'exhibition' ),
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

$future_exhibitions = new WP_Query( $args );

if ( $future_exhibitions->have_posts() ) {
?>
      <div class="grid-row page-section">
        <h2 class="grid-item item-s-12 section-label">Exposiciones Proximos</h2>
<?php
	while ( $future_exhibitions->have_posts() ) {
		$future_exhibitions->the_post();

    $start_date = get_post_meta($post->ID, '_igv_start_date', true);
    $end_date = get_post_meta($post->ID, '_igv_end_date', true);
?>
      	<div class="grid-item item-s-4 item-m-3">
          <?php the_post_thumbnail('exhibition-archive'); ?>
          <div class="font-uppercase font-size-small">
            <span class="item-label">Exposición</span>
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

$oneMonth = 2592000;

$args = array(
	'post_type'              => array( 'exhibition' ),
	'posts_per_page'         => '-1',
  'meta_key' => '_igv_end_date',
  'order_by'  => 'meta_key',
  'order' => 'DESC',
  'meta_query' => array(
    'relation' => 'AND',
    array(
      'key'     => '_igv_end_date',
      'value'   => $now,
      'compare' => '<',
    ),
    array(
      'key'     => '_igv_end_date',
      'value'   => $now - ($oneMonth * 3),
      'compare' => '>',
    ),
  ),
);

$past_exhibitions = new WP_Query( $args );

if ( $past_exhibitions->have_posts() ) {
?>
      <div class="grid-row page-section">
        <h2 class="grid-item item-s-12 section-label">Exposiciones Pasados</h2>
<?php
	while ( $past_exhibitions->have_posts() ) {
		$past_exhibitions->the_post();

    $start_date = get_post_meta($post->ID, '_igv_start_date', true);
    $end_date = get_post_meta($post->ID, '_igv_end_date', true);
?>
      	<div class="grid-item item-s-4 item-m-3">
          <?php the_post_thumbnail('exhibition-archive'); ?>
          <div class="font-uppercase font-size-small">
            <span class="item-label">Exposición</span>
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
