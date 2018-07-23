<?php

/**
 * Theme Name: SomeTheme
 * Description: Функции для какой-то темы
 * Author: PinoFran
 * CMS: WordPress
 */

/* THEME OPTIONS */

if( isset( $wp ) ) {

  // discard update - отмена обновлений ядра WordPress, плагинов и темы
  remove_action( 'wp_version_check', 'wp_version_check' );
  remove_action( 'admin_init', '_maybe_update_core' );
  add_filter( 'pre_transient_update_core', create_function( '$a', "return null;" ) );
  add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );
  wp_clear_scheduled_hook( 'wp_version_check' ); 
  
  // discard update - отмена обновлений плагинов
  remove_action( 'load-plugins.php', 'wp_update_plugins' );
  remove_action( 'load-update.php', 'wp_update_plugins' );
  remove_action( 'load-update-core.php', 'wp_update_plugins' );
  remove_action( 'admin_init', '_maybe_update_plugins' );
  remove_action( 'wp_update_plugins', 'wp_update_plugins' );
  add_filter( 'pre_transient_update_plugins', create_function( '$a', "return null;" ) );
  add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );
  wp_clear_scheduled_hook( 'wp_update_plugins' );  
  
  // discard update - отмена обновлений темы
  remove_action( 'load-themes.php', 'wp_update_themes' );
  remove_action( 'load-update.php', 'wp_update_themes' );
  remove_action( 'load-update-core.php', 'wp_update_themes' );
  remove_action( 'admin_init', '_maybe_update_themes' );
  remove_action( 'wp_update_themes', 'wp_update_themes' );
  add_filter( 'pre_transient_update_themes', create_function( '$a', "return null;" ) );
  add_filter( 'pre_site_transient_update_themes', create_function( '$a', "return null;" ) );
  wp_clear_scheduled_hook( 'wp_update_themes' );

  // discard vidjets from dashboard - удаление ненужных виджетов из консоли
  add_action( 'wp_dashboard_setup', 'clear_wp_dash' );
  function clear_wp_dash() {
    $dash_side = &$GLOBALS['wp_meta_boxes']['dashboard']['side']['core'];
    $dash_normal = &$GLOBALS['wp_meta_boxes']['dashboard']['normal']['core'];
    unset( $dash_side['dashboard_primary'] );             //Блог WordPress
    unset( $dash_normal['dashboard_right_now'] );         //Прямо сейчас
  }

  // remove items ftom admin panel menu - удаление пунктов и подпунктов из меню админки
  add_action( 'admin_menu', 'remove_menus' );
  function remove_menus() {                                          
    remove_menu_page( 'tools.php' );                        //Инструменты 
    remove_submenu_page( 'index.php', 'update-core.php' );  //Обновления
  }

  // allow thumbnails for posts - включить миниатюры для записей
  if( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails', array('post') );
  }

  // replace image in the login form - замена картинки в форме входа
  add_action( 'login_head', 'my_custom_login_logo' );
  function my_custom_login_logo() {
    echo '<style type="text/css">.login h1 a { background-image:url(' . get_bloginfo( 'template_directory' ) . '/image/logo.png) !important; background-size:contain; width:100%; }</style>';
  }  
  
  // register menu - зарегистрировать область для размещения меню
  register_nav_menu( 'location', 'description' );
  register_nav_menu( 'header', 'header-menu' );
   register_nav_menu( 'footer', 'footer-menu' );
    register_nav_menu( 'footer1', 'footer-menu1' );
  // register sidebar - зарегистрировать область для размещения виджетов 
  register_sidebar( array(
   'name' => 'Какой-то сайдбар',
   'id' => 'some-sidebar',
   'description' => 'Описание какого-то сайдбара',
   'before_widget' => '<li class="widget-block">',
   'after_widget' => '</li>',
   'before_title' => '<h2 class="widget-title">',
   'after_title' => '</h2>'
  ) );
  
  // enqueue style - подключить стиль
  wp_enqueue_style( 'slick', get_bloginfo( 'template_directory' ).'/css/slick.css', null, null, 'all' ); 
  
  // enqueue script - подключить скрипт
  wp_enqueue_script( 'slick', get_bloginfo( 'template_directory' ).'/js/slick.min.js', array('jquery'), null, true ); 
 
}

/* end THEME OPTIONS */