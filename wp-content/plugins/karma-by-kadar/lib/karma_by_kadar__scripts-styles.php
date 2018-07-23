<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

function karma_by_kadar_scripts() {

	// JS files.
	wp_enqueue_script( 'jquery-ui-slider' );
	if(is_rtl()){
		wp_enqueue_script( 'karma-by-kadar-jquery-ui-slider-rtl', KARMA_BY_KADAR__PLUGIN_URL . 'assets/js/jquery.ui.slider-rtl.js' , array('jquery'), true, true );
	}
	wp_enqueue_script( 'karma-by-kadar-jquery-ui-touch', KARMA_BY_KADAR__PLUGIN_URL . 'assets/js/jquery.ui.touch-punch.js' , array('jquery'), true, true );
	wp_enqueue_script( 'karma-by-kadar-jquery-jplayer', KARMA_BY_KADAR__PLUGIN_URL . 'assets/js/jquery.jplayer.js' , array('jquery'), true, true );
	wp_enqueue_script( 'karma-by-kadar-main', KARMA_BY_KADAR__PLUGIN_URL . 'assets/js/main.js' , array('jquery'), true, true );

	// CSS files.
	wp_enqueue_style( 'karma-by-kadar-master', KARMA_BY_KADAR__PLUGIN_URL . 'assets/css/master.css' );

	// Register Fonts.
	function karma_by_kadar_fonts_url() {
		$font_url = '';
		if ( 'off' !== _x( 'on', 'Google font: on', 'karma-by-kadar' ) ) {
			$font_url = add_query_arg(
				'family',
				urlencode( 'Material Icons' ),
				"//fonts.googleapis.com/css"
			);
		}
		return $font_url;
	}

	wp_enqueue_style( 'karma-by-kadar-google-fonts', karma_by_kadar_fonts_url(), array(), '1.0.0' );

}

add_action( 'wp_enqueue_scripts', 'karma_by_kadar_scripts' );