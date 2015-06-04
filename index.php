<?php get_header(); ?>

<?php if (have_posts()): ?>
  <div class="container content-sm">
    <?php while (have_posts()): the_post(); ?>
      <div class="headline"><h2><?php the_title(); ?></h2></div>
      <div class="row">
        <div class="col-md-12 md-margin-bottom-50">
          <?php the_content(); ?>
        </div>
      </div>
    <?php endwhile; ?>

    <?php /* Courses */ ?>
    <?php if (have_rows('courses')): ?>
      <div class="headline"></div>
      <div class="row margin-bottom-20">
        <?php while (have_rows('courses')): the_row(); ?>
          <div class="col-md-4 col-sm-6">
            <div class="thumbnails thumbnail-style thumbnail-kenburn">
              <div class="thumbnail-img">
                <div class="overflow-hidden">
                  <img class="img-responsive" src="<?php the_sub_field('course_image'); ?>">
                </div>
                <a class="btn-more hover-effect" href="<?php the_sub_field('course_url'); ?>">read more +</a>
              </div>
              <div class="caption">
                <h3><a class="hover-effect" href="<?php the_sub_field('course_url'); ?>"><?php the_sub_field('course_title'); ?></a></h3>
                <small style="color:grey;"><em><?php the_sub_field('course_date'); ?></em></small>
                <p><?php the_sub_field('course_summary'); ?></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

  </div>
<?php endif; ?>

<?php get_footer();
