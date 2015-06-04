<?php get_header(); ?>

<?php if (strlen(get_field('header_image')) > 0): ?>
  <!--=== Breadcrumbs ===-->
  <div class="breadcrumbs-v3 text-center" style="background:url('<?php the_field('header_image'); ?>');background-size:cover;background-position:center center;">
    <div class="container">
      <h1><?php the_field('title_text'); ?></h1>
    </div>
  </div>
<?php endif; ?>

<?php if (have_posts()): ?>
  <div class="container content-sm">
    <?php while (have_posts()): the_post(); ?>
      <div class="headline"><h2><?php the_title(); ?></h2></div>
      <div class="row">
        <div class="col-mid-12 md-margin-bottom-50">
          <?php the_content(); ?>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
<?php endif; ?>

<?php get_footer();
