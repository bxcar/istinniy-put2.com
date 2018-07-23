<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

function karma_by_kadar__file_picker_settings_field( $settings, $value ) {

	$output = $select_file_class = '';

	$remove_file_class 	= ' hidden';
	$attachment_url 	= wp_get_attachment_url( $value );

	if ( $attachment_url ) {
		$select_file_class = ' hidden';
		$remove_file_class = '';
	}

	$output .= '<div class="karma_by_kadar__file_picker_block">
					<div class="file_picker_display">' .
						$attachment_url .
					'</div>
					<input type="hidden" name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .
						esc_attr( $settings['param_name'] ) . ' file_picker_field" value="' . esc_attr( $value ) . '" />
					<button class="button file-picker-button' . $select_file_class . '">' . esc_html__( 'Select File' , 'karma-by-kadar' ) . '</button>
					<button class="button file-remover-button' . $remove_file_class . '">' . esc_html__( 'Remove File' , 'karma-by-kadar' ) . '</button>
				</div>';

	return $output;
}

if ( function_exists( 'vc_add_shortcode_param' ) ) {

vc_add_shortcode_param( 'karma_by_kadar__file_picker', 'karma_by_kadar__file_picker_settings_field', KARMA_BY_KADAR__PLUGIN_URL . 'js/karma_by_kadar__file_picker.js' );

}