<div class="container container-sm">
  <div class="flexslider">
    <ul class="slides">
      <?php while (have_rows('image_sliders')): the_row(); ?>
        <li>
          <div class="row">
            <div class="col-md-3" style="min-height:400px;background:#fff;">
              <a href="<?php the_sub_field('link'); ?>"><h2><?php the_sub_field('heading'); ?></h2></a>
              <p><?php the_sub_field('subheading'); ?></p>
            </div>
            <div class="col-md-9" style="min-height:400px;background:transparent url('<?php the_sub_field('image'); ?>');background-size:cover;"></div>
          </div>
          <?php /*<a href="<?php the_sub_field('link'); ?>"><h2>
            <?php $lines = explode("\n", get_sub_field('heading'));
            for ($i = 0; $i < count($lines); $i++) if ($lines[$i] === '') unset($lines[$i]);
            for ($i = 0; $i < count($lines); $i++): ?>
              <i><?php echo trim(htmlentities($lines[$i])); ?></i><?php if ($i < count($lines)-1): ?><br><?php endif; ?>
            <?php endfor; ?>
          </h2></a>
          <?php if (strlen(get_sub_field('subheading')) > 0): ?>
            <p>
              <?php $lines = explode("\n", get_sub_field('subheading'));
              for ($i = 0; $i < count($lines); $i++) if ($lines[$i] === '') unset($lines[$i]);
              for ($i = 0; $i < count($lines); $i++): ?>
                <i><?php echo trim(htmlentities($lines[$i])); ?></i><?php if ($i < count($lines)-1): ?><br><?php endif; ?>
              <?php endfor; ?>
            </p>
          <?php endif; ?>*/ ?>
        </li>
      <?php endwhile; ?>
    </ul>
  </div>
</div>
