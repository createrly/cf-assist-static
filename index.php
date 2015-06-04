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
    <?php $courses = get_posts(array('posts_per_page' => -1, 'post_type' => 'page', 'post_parent' => get_the_ID()));
      if (count($courses) > 0): ?>
      <div class="headline"></div>
      <div class="row margin-bottom-20">
        <?php foreach ($courses as $course): ?>
          <div class="col-md-4 col-sm-6">
            <div class="thumbnails thumbnail-style thumbnail-kenburn">
              <div class="thumbnail-img">
                <div class="overflow-hidden">
                  <img class="img-responsive" src="<?php the_field('course_image', $course->ID); ?>">
                </div>
                <a class="btn-more hover-effect" href="<?php echo get_permalink($course->ID); ?>">read more +</a>
              </div>
              <div class="caption">
                <h3><a class="hover-effect" href="<?php echo get_permalink($course->ID); ?>"><?php echo $course->post_title; ?></a></h3>
                <small style="color:grey;"><em><?php echo $course->post_date; ?></em></small>
                <p><?php the_field('course_summary', $course->ID); ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    
  </div>
<?php endif; ?>

<?php get_footer();
