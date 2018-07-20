<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">
      <div class="grid-row">

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();
?>

        <div <?php post_class('grid-item item-s-12'); ?> id="post-<?php the_ID(); ?>">

          <?php the_content(); ?>

        </div>

<?php
  }
}
?>

      </div>
    </div>
  </section>
</main>

<?php
get_footer();
?>
