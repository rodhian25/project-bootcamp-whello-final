<?php
/**
 * Enqueue scripts and styles.
 */

function finalproject_script_and_css()
{
  wp_enqueue_style('finalproject-slick-style', get_template_directory_uri() . ('./assets/slick-1.8.1/slick/slick.css'), array(), _S_VERSION);
  wp_enqueue_style('finalproject-slick-theme-style', get_template_directory_uri() . ('./assets/slick-1.8.1/slick/slick-theme.css'), array(), _S_VERSION);
  wp_enqueue_style('finalproject-style', get_stylesheet_uri(), array(), _S_VERSION);
  wp_enqueue_style('finalproject-app-style', get_template_directory_uri() . '/css/app.css', array(), _S_VERSION);
  wp_enqueue_style('finalproject-responsive-style', get_template_directory_uri() . '/css/responsive.css', array(), _S_VERSION);
  wp_style_add_data('finalproject-style', 'rtl', 'replace');
  //jquery
  wp_enqueue_script('jquery');

  wp_enqueue_script('finalproject-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
  wp_enqueue_script('finalproject-slick', get_template_directory_uri() . './assets/slick-1.8.1/slick/slick.min.js', array(), _S_VERSION, true);
  wp_enqueue_script('finalproject-scripts', get_template_directory_uri() . '/js/scripts.js', array(), _S_VERSION, true);
  
  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
}
add_action('wp_enqueue_scripts', 'finalproject_script_and_css');



?>