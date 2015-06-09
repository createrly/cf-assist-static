<?php get_header(); ?>

<?php if (is_front_page()): ?>
  <?php /* Slider */ ?>
  <?php if (have_rows('image_sliders')): ?>
    <div class="slider-inner">
      <div id="da-slider" class="da-slider">
        <?php while (have_rows('image_sliders')): the_row(); ?>
          <div class="da-slide" style="background:transparent url('<?php the_sub_field('image'); ?>');">
            <h2>
              <?php $lines = explode("\n", get_sub_field('heading'));
              for ($i = 0; $i < count($lines); $i++) if ($lines[$i] === '') unset($lines[$i]);
              for ($i = 0; $i < count($lines); $i++): ?>
                <i><?php echo trim(htmlentities($lines[$i])); ?></i><?php if ($i < count($lines)-1): ?><br><?php endif; ?>
              <?php endfor; ?>
            </h2>
            <?php if (strlen(get_sub_field('subheading')) > 0): ?>
              <p>
                <?php $lines = explode("\n", get_sub_field('subheading'));
                for ($i = 0; $i < count($lines); $i++) if ($lines[$i] === '') unset($lines[$i]);
                for ($i = 0; $i < count($lines); $i++): ?>
                  <i><?php echo trim(htmlentities($lines[$i])); ?></i><?php if ($i < count($lines)-1): ?><br><?php endif; ?>
                <?php endfor; ?>
              </p>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
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

<?php if (!is_front_page() && have_posts()): ?>
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
