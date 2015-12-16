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
              <div class="thumbnails thumbnail-style">
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
<?php if (is_home() || is_category()): ?>
  <div class="container content-md">
    <div class="row">
      <div class="col-md-3"><?php /* Start Sidebar */ ?>
        <?php dynamic_sidebar('blog-sidebar'); ?>
      </div><?php /* End Sidebar */ ?>

      <div class="col-md-9">

        <?php while (have_posts()): the_post(); ?>
          <div class="row margin-bottom-20 <?php echo implode(' ', get_post_class()); ?>">
            <div class="col-sm-5 sm-margin-bottom-20">
              <?php if (get_post_format() === 'gallery'): ?>
                <div class="carousel slide" data-ride="carousel" id="blog-carousel-<?php the_ID(); ?>">
                  <div class="carousel-inner" role="listbox">
                    <ol class="carousel-indicators">
                      <?php $i = 0; foreach (get_post_gallery_images() as $image): ?>
                        <li data-target="#blog-carousel-<?php the_ID(); ?>" data-slide-to="<?php echo $i; ?>" class="<?php if ($i++ === 0): ?>active<?php endif; ?> rounded-x"></li>
                      <?php endforeach; ?>
                    </ol>
                    <?php $i = 0; foreach (get_post_gallery_images() as $image): ?>
                      <div class="item<?php if ($i++ === 0): ?> active<?php endif; ?>">
                        <img src="<?php echo $image; ?>">
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              <?php else: ?>
                <?php if (has_post_thumbnail()): ?>
                    <?php the_post_thumbnail(null, array('class' => 'img-responsive')); ?>
                <?php endif; ?>
              <?php endif; ?>
            </div>
            <div class="col-sm-7 news-v3">
              <div class="news-v3-in-sm no-padding">
                <ul class="list-inline posted-info">
                  <li>In <?php $categories = array(); foreach (get_the_category() as $category) $categories[] = "<span style='color:#ea7d2b;'>".$category->name."</span>"; echo implode(', ', $categories); ?></li>
                </ul>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_excerpt(); ?>
              </div>
            </div>
            <div class="clearfix margin-bottom-20"><hr></div>
          </div>

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

<?php if (!is_home() && !is_front_page() && !is_category() && have_posts()): ?>
  <div class="container content-sm">
    <?php if (wp_get_post_parent_id(get_the_ID()) === 11): ?>
      <div class="col-lg-12 col-md-3">
        <?php /*<a class="btn btn-sm rounded bsl" style="color:#fff;" href="/innovative-learning/bite-size-learning/">Bite-sized Learning</a>*/ ?>
        <a class="btn btn-sm rounded webinar" style="color:#fff;" href="/innovative-learning/webinars/">Webinars</a>
        <?php /*<a class="btn btn-sm rounded mooc" style="color:#fff;" href="/innovative-learning/moocs/">MOOCs</a> */ ?>
        <a class="btn btn-sm rounded ecourse" style="color:#fff;" href="/innovative-learning/e-courses/">eCourses</a>
      </div>
    <?php endif; ?>
    <?php while (have_posts()): the_post(); ?>
      <div class="headline"><h2><?php the_title(); ?></h2></div>
      <div class="row">
        <?php if (get_page_template_slug() === 'two-column.php'): ?>
          <div class="col-md-8">
            <?php the_content(); ?>
          </div>
          <div class="col-md-4">
            <?php $image = get_field('second_column_image'); ?>
            <img class="img-responsive" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
          </div>
        <?php else: ?>
          <div class="col-md-12 md-margin-bottom-50">
            <?php the_content(); ?>
          </div>
          <?php if (get_field('enable_course_pacing') === true): ?>
            <div class="col-lg-12 col-md-3">
              <button class="btn btn-sm facilitated active"><a href="#">Facilitated Courses</a></button>
              <button class="btn btn-sm self-paced"><a href="#">Self-Paced Courses</a></button>
              <hr class="course-button-line">
            </div>
            <div class="col-xs-12 facilitated-description" style="display:none;">
              <h4>Facilitated Courses</h4>
              <p>These courses feature the guidance of an expert facilitator to lead participants through lessons and moderate the ‘peer discussion forum’ where participants interact to share knowledge. Facilitated courses are delivered twice annually and also issue e-Certificate upon its successful completion.</p>
            </div>
            <div class="col-xs-12 self-paced-description" style="display:none;">
              <h4>Self-Paced Courses</h4>
              <p>These courses are available to participants at any given time to allow for learning at a self-paced rhythm. There is a discussion forum where participants can deliberate on topics together.</p>
            </div>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>

    <?php /* Courses */ ?>
    <?php if (have_rows('courses')): $enablePacing = get_field('enable_course_pacing'); ?>
      <div class="headline"></div>
      <div class="row margin-bottom-20 equal-height-columns">
        <?php while (have_rows('courses')): the_row(); ?>
          <div class="col-md-4 col-sm-6 course equal-height-column <?php if ($enablePacing === true): ?>pacing-<?php the_sub_field('pacing'); ?><?php endif; ?>">
            <div class="thumbnails thumbnail-style">
              <div class="thumbnail-img">
                <div class="overflow-hidden">
                  <a href="<?php the_sub_field('course_url'); ?>">
                    <img class="img-responsive" src="<?php $image = get_sub_field('course_image'); echo $image['sizes']['course-thumbnail']; ?>">
                  </a>
                </div>
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

    <?php if (have_rows('reports')): ?>
      <div class="headline">
        <h2>Annual Reports</h2>
      </div>
      <div class="row category margin-top-20 margin-bottom-20">
        <?php while (have_rows('reports')): the_row(); ?>
          <div class="col-md-4 col-sm-6">
            <div class="content-boxes-v3 margin-bottom-10 md-margin-bottom-20">
              <i class="icon-custom icon-sm rounded-x icon-bg-red fa fa-hdd-o"></i>
              <div class="content-boxes-in-v3">
                <h3 style="line-height:35px;"><a href="<?php the_sub_field('link'); ?>" target="_blank"><?php the_sub_field('title'); ?></a></h3>
                <p></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </div>

  <?php /* Partnerships */ ?>
  <?php if (have_rows('partnership_blocks')): ?>
    <div class="container content-md" style="background:#e8e8e8;">
      <ul class="row block-grid-v2">
        <?php while (have_rows('partnership_blocks')): the_row(); ?>
          <li class="col-md-3 col-sm-6 md-margin-bottom-30">
            <div class="easy-block-v1">
              <img class="img-responsive" src="<?php the_sub_field('image'); ?>" alt="">
            </div>
            <div class="block-grid-v2-info rounded-bottom">
              <h3><a href="<?php the_sub_field('link'); ?>"><?php the_sub_field('title'); ?></a></h3>
              <?php the_sub_field('description'); ?>
              <a href="<?php the_sub_field('link'); ?>" class="btn-u btn-u-sm">Learn More</a>
            </div>
          </li>
        <?php endwhile; ?>
      </ul>
    </div>
  <?php endif; ?>
<?php endif; ?>

<?php /* Knowledge Fora */ ?>
<?php if ($post->post_parent === 7): ?>
  <?php $pages = new WP_Query(array('post_type' => 'page', 'post_parent' => get_the_ID())); ?>
  <?php if ($pages->have_posts()): ?>
    <div class="container content-md" style="background:#e8e8e8;">
      <ul class="row block-grid-v2">
        <?php while ($pages->have_posts()): $pages->the_post(); ?>
          <li class="col-md-3 col-sm-6 md-margin-bottom-30">
            <div class="easy-block-v1">
              <?php the_post_thumbnail(null, array('class' => 'img-responsive')); ?>
            </div>
            <div class="block-grid-v2-info rounded-bottom">
              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <?php the_excerpt(); ?>
              <a href="<?php the_permalink(); ?>" class="btn-u btn-u-sm">Learn More</a>
            </div>
          </li>
        <?php endwhile; ?>
      </ul>
    </div>
  <?php endif; ?>
<?php endif; ?>

<?php get_footer();
