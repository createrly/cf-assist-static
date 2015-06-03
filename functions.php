<?php

if (!function_exists('cfassistInit'))
{
  function cfassistInit()
  {
    register_nav_menus(array(
  		'primary'   => 'Header Menu',
      'footer'    => 'Footer Menu'
    ));
  }
}
add_action('after_setup_theme', 'cfassistInit');
