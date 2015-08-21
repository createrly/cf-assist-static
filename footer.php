    <!--=== Footer Version 1 ===-->
    <div class="footer-v1">
      <div class="footer">
          <div class="container">
              <div class="row">
                  <div class="copyright">
          <div class="container">
              <div class="row">
                  <div class="col-md-6">
                      <p>
                          <?php echo date('Y'); ?> &copy; All Rights Reserved.
                          <?php $menuLocations = get_nav_menu_locations(); ?>
                          <?php if (isset($menuLocations['footer'])): ?>
                            <?php $footerMenu = wp_get_nav_menu_object($menuLocations['footer']);
                              $menuItems = wp_get_nav_menu_items($footerMenu->term_id);
                              $menuLinks = array();
                              foreach ($menuItems as $item)
                                $menuLinks[] = "<a href='{$item->url}'>{$item->title}</a>";
                            ?>
                            <?php echo implode(' | ', $menuLinks); ?>
                          <?php endif; ?>
                      </p>
                      <p>Website by <a href="http://www.createrly.com">Createrly</a></p>
                  </div>

                  <!-- Social Links -->
                  <div class="col-md-6">
                      <ul class="footer-socials list-inline">
                          <li>
                              <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook">
                                  <i class="fa fa-facebook"></i>
                              </a>
                          </li>
                          <li>
                              <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Linkedin">
                                  <i class="fa fa-linkedin"></i>
                              </a>
                          </li>
                          <li>
                              <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter">
                                  <i class="fa fa-twitter"></i>
                              </a>
                          </li>

                      </ul>
                  </div>
                  <!-- End Social Links -->
              </div>
          </div>
      </div>
              </div>
          </div>
      </div><!--/footer-->

      <!--/copyright-->
    </div>
  <!--=== End Footer Version 1 ===-->
  </div><!--/wrapper-->

  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/dist/CF-Assist.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/dist/flexslider/jquery.flexslider-min.js"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      	App.init();
        OwlCarousel.initOwlCarousel();
        ParallaxSlider.initParallaxSlider();
        $('.flexslider').flexslider({
          animation: "slide"
        });
    });
  </script>
  <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/static/assets/plugins/respond.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/static/assets/plugins/html5shiv.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/static/assets/plugins/placeholder-IE-fixes.js"></script>
  <![endif]-->
  <?php wp_footer(); ?>
</body>
</html>
