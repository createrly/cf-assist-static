<?php get_header(); ?>

<div class="container content-md">
  <div class="row">
    <div class="col-md-3"><?php /* Start Sidebar */ ?>
      <?php dynamic_sidebar('blog-sidebar'); ?>
    </div><?php /* End Sidebar */ ?>

    <div class="col-md-9">

      <?php $pages = new WP_Query(array('post_type' => 'page', 'post_parent' => get_the_ID())); ?>
      <?php while ($pages->have_posts()): $pages->the_post(); ?>
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
                  <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(null, array('class' => 'img-responsive')); ?></a>
              <?php endif; ?>
            <?php endif; ?>
          </div>
          <div class="col-sm-7 news-v3">
            <div class="news-v3-in-sm no-padding">
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

<?php get_footer(); ?>
