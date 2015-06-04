<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?> &raquo; <?php is_front_page() ? '' : wp_title(''); ?></title>
  <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>
  <link rel='stylesheet' type='text/css' href='<?php echo get_template_directory_uri(); ?>/dist/style.css'>

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <div class="wrapper">
    <!--=== Header ===-->
    <div class="header">
        <div class="container">
            <!-- Logo -->
            <a class="logo" href="<?php echo get_home_url(); ?>" style="float:left;">
                <img src="<?php echo get_template_directory_uri(); ?>/static/assets/img/cfassist/logo.jpg" alt="Logo" style="height:50px;">
            </a>
            <!-- End Logo -->

            <!-- Toggle get grouped for better mobile display -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars"></span>
            </button>
            <!-- End Toggle -->
        </div><!--/end container-->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
            <div class="container">
                <ul class="nav navbar-nav">
                  <?php $menuLocations = get_nav_menu_locations(); ?>
                  <?php if (isset($menuLocations['primary'])): ?>
                    <?php $headerMenu = wp_get_nav_menu_object($menuLocations['primary']);
                      $menuItems = wp_get_nav_menu_items($headerMenu->term_id);
                      //var_dump($menuItems);
                      $menuLinks = array();
                      foreach ($menuItems as $item)
                      {
                        if ($item->menu_item_parent == 0)
                          $menuLinks[$item->db_id] = array('title' => $item->title, 'url' => $item->url, 'children' => array(), 'page_id' => $item->object_id);
                        else
                          $menuLinks[$item->menu_item_parent]['children'][] = array('title' => $item->title, 'url' => $item->url, 'page_id' => $item->object_id);
                      }

                      foreach ($menuLinks as $link): ?>

                      <li <?php if (count($link['children']) > 0): ?> class="dropdown"<?php endif; ?>>
                        <?php if (count($link['children']) > 0): ?>
                          <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo $link['title']; ?>
                          </a>
                          <ul class="dropdown-menu">
                            <?php foreach ($link['children'] as $childLink): ?>
                              <li><a href="<?php echo $childLink['url']; ?>"><?php echo htmlentities($childLink['title']); ?></a></li>
                            <?php endforeach; ?>
                          </ul>
                        <?php else: ?>
                          <a href="<?php echo $link['url']; ?>"><?php echo htmlentities($link['title']); ?></a>
                        <?php endif; ?>
                      </li>

                    <?php endforeach; ?>
                  <?php endif; ?>
                </ul>
            </div><!--/end container-->
        </div><!--/navbar-collapse-->
    </div>
    <!--=== End Header ===-->

    <?php if (strlen(get_field('header_image')) > 0): ?>
      <!--=== Breadcrumbs ===-->
      <div class="breadcrumbs-v3 text-center" style="background:url('<?php the_field('header_image'); ?>');background-size:cover;background-position:center center;">
        <div class="container">
          <h1><?php the_field('title_text'); ?></h1>
        </div>
      </div>
    <?php endif; ?>
