<?php get_header(); ?>

<div class="container content blog-page blog-item">
  <?php while (have_posts()): the_post(); ?>
    <?php if (has_post_thumbnail()): ?>
      <div class="blog-img">
        <?php the_post_thumbnail(null, array('class' => 'img-responsive')); ?>
      </div>
    <?php endif; ?>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php /*<div class="blog-tags">
      <ul class="list-unstyled list-inline blog-info">
        <li><i class="fa fa-tags"></i> <?php the_tags(); ?></li>
      </ul>
    </div>*/ ?>
    <?php the_content(); ?>
  <?php endwhile; ?>
</div>

<?php get_footer(); ?>
