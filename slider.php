<div class="slider-inner">
  <div id="da-slider" class="da-slider">
    <?php while (have_rows('image_sliders')): the_row(); ?>
      <div class="da-slide" style="background:transparent url('<?php the_sub_field('image'); ?>');background-size:cover;">
        <a href="<?php the_sub_field('link'); ?>"><h2>
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
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  </div>
</div>
