<?php

require get_template_directory() . '/inc/theme-settings/theme-settings.php';

/**
 * Lang switcher polylang
 */
require get_template_directory() . '/inc/lang-switcher.php';

require get_template_directory() . '/inc/contact-form7-settings.php';

// register webpack compiled js and css with theme
function enqueue_webpack_scripts()
{

  $cssFilePath = glob(get_template_directory() . '/css/build/main.min.*.css');
  $cssFileURI = get_template_directory_uri() . '/css/build/' . basename($cssFilePath[0]);
  wp_enqueue_style('main_css', $cssFileURI);

  $jsFilePath = glob(get_template_directory() . '/js/build/main.min.*.js');
  $jsFileURI = get_template_directory_uri() . '/js/build/' . basename($jsFilePath[0]);
  wp_enqueue_script('main_js', $jsFileURI, null, null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_webpack_scripts');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ewc_setup()
{
  /*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on easy-connect-widget, use a find and replace
		* to change 'ewc' to the name of your theme in all the template files.
		*/
  load_theme_textdomain('ewc', get_template_directory() . '/languages');

  /*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
  add_theme_support('title-tag');

  /*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
  add_theme_support('post-thumbnails');

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus(
    array(
      'main-menu' => esc_html__('Main Menu', 'ewc'),
    )
  );

  /*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
  add_theme_support(
    'html5',
    array(
      'style',
      'script',
    )
  );

  // Add theme support for selective refresh for widgets.
  add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'ewc_setup');

// Регистрация кастомного типа записи "Часто задаваемые вопросы"
function register_faq_post_type()
{
  $labels = array(
    'name'              =>
    __('FAQ', 'ecw'),
    'singular_name'     =>
    __('FAQ', 'ecw'),
    'add_new'           =>
    __('Add', 'ecw'),
    'add_new_item'      =>
    __('Add', 'ecw'),
    'edit_item'         =>
    __('Edit', 'ecw'),
    'new_item'          =>
    __('Add New', 'ecw'),
    'view_item'         =>
    __('View', 'ecw'),
    'parent_item_colon' => '',
    'menu_name'         => __('FAQ', 'ecw'),
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => false,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array('slug' => 'faq'),
    'capability_type'    => 'post',
    'has_archive'        => false,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array('title', 'editor',),
    'show_in_rest'       => true,
    'menu_icon'          => 'dashicons-screenoptions',
  );

  register_post_type('faq', $args);
}

add_action('init', 'register_faq_post_type');
