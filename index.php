<?php get_header(); ?>

<?php if (is_front_page()): ?>
  <?php /* Slider */ ?>
  <?php if (have_rows('image_sliders')): ?>
    <?php get_template_part('slider'); ?>
  <?php endif; ?>

  <?php /* Call to Action */ ?>
  <div class="purchase">
    <div class="container">
      <div class="row">
        <div class="col-md-9 animated fadeInLeft">
          <span><?php the_field('cta_heading'); ?></span>
          <p><?php the_field('cta_text'); ?></p>
        </div>
        <div class="col-md-3 btn-buy animated fadeInRight">
          <a href="<?php the_field('cta_link'); ?>" class="btn-u btn-u-lg"><?php the_field('cta_button_text'); ?></a>
        </div>
      </div>
    </div>
  </div>

  <?php /* Our Work */ ?>
  <div class="container container-sm">
    <div class="headline"><h2>Our Work</h2></div>
    <?php if (have_rows('our_work')): ?>
      <div class="row margin-bottom-20">
        <?php while (have_rows('our_work')): the_row(); ?>
          <div class="col-md-4 col-sm-6">
              <div class="thumbnails thumbnail-style thumbnail-kenburn">
                <div class="thumbnail-img">
                      <div class="overflow-hidden">
                          <img class="img-responsive" src="<?php the_sub_field('image'); ?>" alt="">
                      </div>
                      <a class="btn-more hover-effect" href="<?php the_sub_field('link'); ?>">Read More +</a>
                  </div>
                  <div class="caption">
                      <h3><a class="hover-effect" href="<?php the_sub_field('link'); ?>"><?php the_sub_field('heading'); ?></a></h3>
                      <p><?php the_sub_field('description'); ?></p>
                  </div>
              </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </div>
<?php endif; ?>

<?php /* Blog Page */ ?>
<?php if (is_home()): ?>
  <div class="container content-md">
    <div class="row">
      <div class="col-md-3"><?php /* Start Sidebar */ ?>
        <?php dynamic_sidebar('blog-sidebar'); ?>
      </div><?php /* End Sidebar */ ?>

      <div class="col-md-9">

        <?php while (have_posts()): the_post(); ?>
          <div class="row margin-bottom-20">
            <?php if (has_post_thumbnail()): ?>
              <div class="col-sm-5 sm-margin-bottom-20">
                <?php the_post_thumbnail(null, array('class' => 'img-responsive')); ?>
              </div>
            <?php endif; ?>
            <div class="col-sm-7 news-v3">
              <div class="news-v3-in-sm no-padding">
                <ul class="list-inline posted-info">
                  <li>By <?php the_author(); ?></li>
                  <li>In <?php the_category(', '); ?></li>
                  <li>Posted <?php the_date(); ?></li>
                </ul>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_excerpt(); ?>
              </div>
            </div>
          </div>

          <div class="clearfix margin-bottom-20"><hr></div>

        <?php endwhile; ?>

        <ul class="pager pager-v3 pager-sm no-margin-bottom">
          <li class="previous"><?php previous_posts_link(); ?></li>
          <li class="page-amount"><?php echo get_query_var('paged') ? get_query_var('paged') : 1; ?> of <?php echo $wp_query->max_num_pages; ?></li>
          <li class="next"><?php next_posts_link(); ?></li>
        </ul>

      </div>
    </div>
  </div>
<?php endif; ?>

<?php if (!is_home() && !is_front_page() && have_posts()): ?>
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
