<?php
/**
 * @package Karma by Kadar
 */
/*
Plugin Name: Karma Music Player by Kadar
Description: This is a responsive music player plugin for implementing audio players in your WordPress website with a shortcode, but it has VisualComposer support too.
Version: 1.0.6
Author: Kadar Claudiu
Author URI: http://kadarclaudiu.com/
License: GPLv2 or later
Text Domain: karma-by-kadar
Domain Path: /languages
*/

define( 'KARMA_BY_KADAR__PLUGIN_URL', trailingslashit(plugin_dir_url( __FILE__ )) );
define( 'KARMA_BY_KADAR__PLUGIN_DIR', trailingslashit(plugin_dir_path( __FILE__ )) );
define( 'KARMA_BY_KADAR__PLUGIN_DIR_NAME', dirname(plugin_basename( __FILE__ )) );

// Translation Support.
require_once( KARMA_BY_KADAR__PLUGIN_DIR . 'lib/karma_by_kadar__translation.php' );

// Load the script and styles for the player.
require_once( KARMA_BY_KADAR__PLUGIN_DIR . 'lib/karma_by_kadar__scripts-styles.php' );

// Include simple player shortcode.
require_once( KARMA_BY_KADAR__PLUGIN_DIR . 'lib/karma_by_kadar__shortcode.php' );

// Visual Composer Support.
require_once( KARMA_BY_KADAR__PLUGIN_DIR . 'lib/karma_by_kadar__vc_functions.php' );
require_once( KARMA_BY_KADAR__PLUGIN_DIR . 'lib/karma_by_kadar__visual-composer.php' );