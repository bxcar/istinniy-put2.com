<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( function_exists( 'vc_map' ) ) {

vc_map( array(
	'name' 				=> esc_html__( 'Karma', 'karma-by-kadar' ),
	'description'		=> esc_html__( 'Music Player', 'karma-by-kadar' ),
	'category' 			=> esc_html__( 'by Kadar', 'karma-by-kadar' ),
	'base' 				=> 'karma_by_kadar__simple_player',
	'icon'				=> 'vc_icon-vc-karma',
	'admin_enqueue_css' => array(
		KARMA_BY_KADAR__PLUGIN_URL . 'css/karma_by_kadar__css.css'
	),
	'params' 			=> array(
		array(
			'type' 			=> 'karma_by_kadar__file_picker',
			'heading' 		=> esc_html__( 'Audio File Source' , 'karma-by-kadar' ),
			'param_name' 	=> 'vc_src',
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Title' , 'karma-by-kadar' ),
			'param_name' 	=> 'title',
			'value'			=> esc_html__( 'Louis Armstrong - Hello Dolly' , 'karma-by-kadar' ),
			'admin_label' 	=> true,
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Volume' , 'karma-by-kadar' ),
			'param_name' 	=> 'volume',
			'value'			=> array(
				'0' 	=> esc_html__( '0' , 'karma-by-kadar' ),
				'1' 	=> esc_html__( '0.1' , 'karma-by-kadar' ),
				'2'		=> esc_html__( '0.2' , 'karma-by-kadar' ),
				'3'		=> esc_html__( '0.3' , 'karma-by-kadar' ),
				'4'		=> esc_html__( '0.4' , 'karma-by-kadar' ),
				'5'		=> esc_html__( '0.5' , 'karma-by-kadar' ),
				'6'		=> esc_html__( '0.6' , 'karma-by-kadar' ),
				'7'		=> esc_html__( '0.7' , 'karma-by-kadar' ),
				'8'		=> esc_html__( '0.8' , 'karma-by-kadar' ),
				'9'		=> esc_html__( '0.9' , 'karma-by-kadar' ),
				'10'	=> esc_html__( '1' , 'karma-by-kadar' ),
			),
			'std'			=> '0.7',
		),
		array(
			'type' 			=> 'checkbox',
			'heading' 		=> esc_html__( 'Loop' , 'karma-by-kadar' ),
			'param_name' 	=> 'loop',
		),
		array(
			'type' 			=> 'checkbox',
			'heading' 		=> esc_html__( 'Autoplay' , 'karma-by-kadar' ),
			'param_name' 	=> 'autoplay',
			'description'	=> esc_html__( 'The Autoplay functionality will not work on Safari 11 or higher.' , 'karma-by-kadar' ),
		),
	)
) );

}