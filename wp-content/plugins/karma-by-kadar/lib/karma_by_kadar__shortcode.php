<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

class karma_by_kadar__simple_player {

	protected static $instance = null;

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	private function __construct() {
		add_shortcode( 'karma_by_kadar__simple_player', array( &$this, 'shortcode' ) );
	}

	public function shortcode( $atts ) {
		$output = $vc_src = $src = $title = $volume = $loop = $autoplay = '';

		extract( shortcode_atts( array(
			'vc_src' 	=> '',
			'src' 		=> '',
			'title' 	=> esc_html__( 'Louis Armstrong - Hello Dolly' , 'karma-by-kadar' ),
			'volume' 	=> '0.7',
			'loop' 		=> false,
			'autoplay' 	=> false,
		), $atts ) );

		$vc_src = wp_get_attachment_url($vc_src);

		$output .= '<div class="karma-by-kadar__simple-player ';
			if ( is_rtl() ) {
			$output .= 'karma-by-kadar__simple-player--rtl" ';
			} else {
			$output .= '" ';
			}
			if ( $src != '' || $vc_src != '' ) { if ( $vc_src != '' ) {
			$output .= 'data-src="' . esc_url($vc_src) . '" ';
			} else if ( $src != '' ) {
			$output .= 'data-src="' . esc_url($src) . '" ';
			}}
			if ( $title != '' ) {
			$output .= 'data-title="' . esc_html($title) . '" ';
			}
			if ( $volume != '' ) {
			$output .= 'data-volume="' . esc_attr($volume) . '" ';
			}
			if ( $loop == true ) {
			$output .= 'data-loop="' . esc_attr('loop') . '" ';
			}
			if ( $autoplay == true ) {
			$output .= 'data-autoplay="' . esc_attr('autoplay') . '" ';
			}
			if ( is_rtl() ) {
			$output .= 'data-rtl="' . esc_attr('rtl') . '" ';
			}
			$output .= '>';
			$output .= '<div class="karma-by-kadar__simple-player__player"></div>';
			$output .= '<div class="karma-by-kadar__simple-player__play-pause">';
				$output .= '<div class="karma-by-kadar__simple-player__play">';
					$output .= '<i class="material-icons">play_circle_filled</i>';
				$output .= '</div>';
				$output .= '<div class="karma-by-kadar__simple-player__pause">';
					$output .= '<i class="material-icons">pause_circle_filled</i>';
				$output .= '</div>';
			$output .= '</div>';
			if ( $title != '' ) {
			$output .= '<div class="karma-by-kadar__simple-player__title">';
				$output .= '<div class="karma-by-kadar__simple-player__title__the-title">' . esc_html($title) . '</div>';
			$output .= '</div>';
			}
			$output .= '<div class="karma-by-kadar__simple-player__volume-handler-container">';
				$output .= '<div class="karma-by-kadar__simple-player__middle">';
					$output .= '<div class="karma-by-kadar__simple-player__seekbar">';
						$output .= '<div class="karma-by-kadar__simple-player__seekbar__bg"></div>';
					$output .= '</div>';
					$output .= '<div class="karma-by-kadar__simple-player__current-time"></div>';
					$output .= '<div class="karma-by-kadar__simple-player__duration"></div>';
				$output .= '</div>';
				$output .= '<div class="karma-by-kadar__simple-player__right">';
					$output .= '<div class="karma-by-kadar__simple-player__volume">';
						$output .= '<div class="karma-by-kadar__simple-player__volume__bar">';
							$output .= '<div class="karma-by-kadar__simple-player__volume__seekbar">';
								$output .= '<div class="karma-by-kadar__simple-player__volume__seekbar__bg"></div>';
							$output .= '</div>';
							$output .= '<i class="material-icons">volume_down</i>';
						$output .= '</div>';
						$output .= '<div class="karma-by-kadar__simple-player__mute">';
							$output .= '<i class="material-icons">volume_up</i>';
						$output .= '</div>';
						$output .= '<div class="karma-by-kadar__simple-player__unmute">';
							$output .= '<i class="material-icons">volume_off</i>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';

		return $output;
	}

}

karma_by_kadar__simple_player::get_instance();