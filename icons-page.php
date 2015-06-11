<?php
/*
 * Template Name: Icons Page
 */
get_header(); ?>

<div class="container content-sm">
  <?php while (have_posts()): the_post(); ?>
    <div class="headline"><h2><?php the_title(); ?></h2></div>
    <div class="row">
      <div class="col-md-12 md-margin-bottom-50">
        <?php the_content(); ?>
      </div>
    </div>

    <div class="row category margin-bottom-20">
      <?php foreach (array('column_1','column_2','column_3') as $column): ?>
        <?php if (have_rows($column)): ?>
          <div class="col-md-4 col-sm-6">
            <?php while (have_rows($column)): the_row(); ?>
              <div class="content-boxes-v3 margin-bottom-10 md-margin-bottom-20">
                <i class="icon-custom icon-sm rounded-x icon-bg-<?php echo strtolower(get_sub_field('color')); ?> fa fa-<?php echo the_sub_field('icon'); ?>"></i>
                <div class="content-boxes-in-v3">
                  <h3>
                    <?php if (strlen(get_sub_field('link')) > 0): ?>
                      <a href="<?php the_sub_field('link'); ?>"> <?php the_sub_field('title'); ?></a>
                    <?php else: ?>
                      <?php the_sub_field('title'); ?>
                    <?php endif; ?>
                    <?php if (strlen(get_sub_field('count')) > 0): ?>
                      <small>(<?php the_sub_field('count'); ?>)</small>
                    <?php endif; ?>
                  </h3>
                  <?php the_sub_field('description'); ?>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  <?php endwhile; ?>
</div>

<?php get_footer();
