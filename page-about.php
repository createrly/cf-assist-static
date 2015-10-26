<?php get_header(); ?>

<div class="container content-sm">
  <?php while (have_posts()): the_post(); ?>
    <div class="row">
      <div class="col-md-8 md-margin-bottom-50">
        <div class="headline"><h2><?php the_title(); ?></h2></div>
        <?php the_content(); ?>
      </div>
      <div class="col-md-4">
        <?php if (have_rows('reports')): ?>
          <div class="headline">
            <h2>Annual Reports</h2>
          </div>
          <div class="row category margin-top-20 margin-bottom-20">
            <?php while (have_rows('reports')): the_row(); ?>
              <div class="col-sm-12">
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
    </div>
  <?php endwhile; ?>
</div>

<?php get_footer();
