<?php
/*
Plugin Name: Music Player for WooCommerce
Plugin URI: http://wordpress.dwbooster.com/content-tools/music-player-for-woocommerce
Version: 1.0.38
Text Domain: woocommerce_music_player
Author: CodePeople
Author URI: http://wordpress.dwbooster.com/content-tools/music-player-for-woocommerce
Description: Music Player for WooCommerce includes the MediaElement.js music player in the pages of the products with audio files associated, and in the store's pages, furthermore, the plugin allows selecting between multiple skins.
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

require_once 'banner.php';
$codepeople_promote_banner_plugins[ 'codepeople-music-player-for-woocommerce' ] = array(
	'plugin_name' => 'Music Player for WooCommerce',
	'plugin_url'  => 'https://wordpress.org/support/plugin/music-player-for-woocommerce/reviews/#new-post'
);

// CONSTANTS

define( 'WCMP_PLUGIN_URL', plugins_url( '', __FILE__ ) );
define( 'WCMP_DEFAULT_PLAYER_LAYOUT', 'mejs-classic' );
define( 'WCMP_DEFAULT_PLAYER_CONTROLS', 'default' );
define( 'WCMP_DEFAULT_PlAYER_TITLE', 1 );

// Load widgets
require_once 'widgets/playlist_widget.php';

if ( !class_exists( 'WooCommerceMusicPlayer' ) ) {
	class WooCommerceMusicPlayer
	{
		//******************** ATTRIBUTES ************************

		private $_products_attrs = array();
		private $_global_attrs 	 = array();
		private $_player_layouts = array( 'mejs-classic', 'mejs-ted', 'mejs-wmp' );
		private $_player_controls= array( 'button', 'all', 'default' );
		private $_files_directory_path;
		private $_files_directory_url;
		private $_enqueued_resources = false;
		/**
		* WCMP constructor
		*
		* @access public
		* @return void
		*/
		public function __construct()
		{
			$this->_createDir();
			register_activation_hook( __FILE__, array( &$this, 'activation' ) );
			register_deactivation_hook( __FILE__, array( &$this, 'deactivation' ) );
			add_action( 'plugins_loaded', array(&$this, 'load_textdomain') );
			add_action('init', array(&$this, 'init'), 99);
			add_action('admin_init', array(&$this, 'admin_init'), 99);
		} // End __constructor

		public function activation()
		{
			$this->_deleteDir( $this->_files_directory_path );
			$this->_createDir();
		}

		public function deactivation()
		{
			$this->_deleteDir( $this->_files_directory_path );
		}

		public function load_textdomain()
		{
			load_plugin_textdomain( 'woocommerce_music_player', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
		}

		public function get_product_attr( $product_id, $attr, $default = false )
		{
			if( !isset( $this->_products_attrs[ $product_id ] ) ) $this->_products_attrs[ $product_id ] = array();
			if( !isset( $this->_products_attrs[ $product_id ][ $attr ] ) )
			{
				if( metadata_exists( 'post', $product_id, $attr ) )
				{
					$this->_products_attrs[ $product_id ][ $attr ] = get_post_meta( $product_id, $attr, true );
				}
				else
				{
					$this->_products_attrs[ $product_id ][ $attr ] = $this->get_global_attr($attr, $default);
				}
			}
			return $this->_products_attrs[ $product_id ][ $attr ];

		} // End get_product_attr

		public function get_global_attr( $attr, $default = false )
		{
			if(empty($this->_global_attrs)) $this->_global_attrs = get_option('wcmp_global_settings',array());
			if( !isset( $this->_global_attrs[ $attr ] ) ) $this->_global_attrs[ $attr ] = $default;
			return $this->_global_attrs[ $attr ];

		} // End get_global_attr

		//******************** WORDPRESS ACTIONS **************************

		public function init()
		{
			if( !is_admin() )
			{
				// Define the shortcode for the playlist_widget
				add_shortcode('wcmp-playlist', array(&$this, 'replace_playlist_shortcode' ));

				if( isset( $_REQUEST[ 'wcmp-action' ] ) && $_REQUEST[ 'wcmp-action' ] == 'play' )
				{
					if( isset( $_REQUEST[ 'wcmp-product' ] ) )
					{
						$product_id = @intval( $_REQUEST[ 'wcmp-product' ] );
						if( !empty( $product_id ) )
						{
							$product = wc_get_product( $product_id );
							if( $product !== false && isset( $_REQUEST[ 'wcmp-file' ] ) )
							{
								$files = $this->_get_product_files(
									array(
										'product' => $product,
										'file_id' => $_REQUEST[ 'wcmp-file' ]
									)
								);

								if( !empty( $files ) )
								{
									$file_url = $files[ $_REQUEST[ 'wcmp-file' ] ][ 'file' ];
									$this->_output_file( array( 'url' => $file_url ) );
								}
							}
						}
					}
					exit;
				}
				else
				{
					add_action( 'woocommerce_shop_loop_item_title', array( &$this, 'include_main_player' ), 11 );
					/* add_action( 'woocommerce_before_add_to_cart_form', array( &$this, 'include_all_players' ), 11 ); */
					add_action( 'woocommerce_single_product_summary', array( &$this, 'include_all_players' ), 11 );
				}
			}
			else
			{
				add_action('admin_menu', array(&$this, 'menu_links'), 10);
			}
		} // End init

		public function admin_init()
		{
			add_meta_box('wcmp_woocommerce_metabox', __("Music Player for WooCommerce", 'woocommerce_music_player'), array(&$this, 'woocommerce_player_settings'), 'product', 'normal');
			add_action('save_post', array(&$this, 'save_post'));
			add_action('delete_post', array(&$this, 'delete_post'));
			add_filter("plugin_action_links_".plugin_basename(__FILE__), array(&$this, 'help_link'));
		} // End admin_init

		public function help_link($links)
		{
			array_unshift(
			$links,
				'<a href="https://wordpress.org/support/plugin/music-player-for-woocommerce/#new-post" target="_blank">'.__('Help').'</a>'
			);
			return $links;
		} // End help_link

		public function menu_links()
		{
			add_options_page('Music Player for WooCommerce', 'Music Player for WooCommerce', 'manage_options', 'music-player-for-woocommerce-settings', array(&$this, 'settings_page'));
		} // End menu_links

		public function settings_page()
		{
			if (
				isset( $_POST['wcmp_nonce'] ) &&
				wp_verify_nonce( $_POST['wcmp_nonce'], 'session_id_'.session_id() )
			)
			{
				// Save the player settings
				$enable_player 	= (isset($_REQUEST['_wcmp_enable_player'])) ? 1 : 0;
				$show_in = (isset($_REQUEST['_wcmp_show_in']) && in_array($_REQUEST['_wcmp_show_in'], array('single', 'multiple'))) ? $_REQUEST['_wcmp_show_in'] : 'all';
				$player_style 	= (
						isset($_REQUEST['_wcmp_player_layout']) &&
						in_array($_REQUEST['_wcmp_player_layout'], $this->_player_layouts)
					) ? $_REQUEST['_wcmp_player_layout'] : WCMP_DEFAULT_PLAYER_LAYOUT;
				$player_controls = (
						isset( $_REQUEST[ '_wcmp_player_controls' ] ) &&
						in_array( $_REQUEST[ '_wcmp_player_controls' ], $this->_player_controls )
					) ? $_REQUEST[ '_wcmp_player_controls' ] : WCMP_DEFAULT_PLAYER_CONTROLS;

				$player_title = ( isset( $_REQUEST[ '_wcmp_player_title' ] ) ) ? 1 : 0;
				$merge_grouped = ( isset( $_REQUEST[ '_wcmp_merge_in_grouped' ] ) ) ? 1 : 0;
				$play_all = (isset($_REQUEST['_wcmp_play_all'])) ? 1 : 0;
				$preload  = (
						isset($_REQUEST['_wcmp_preload']) &&
						in_array($_REQUEST['_wcmp_preload'], array('none', 'metadata', 'auto'))
					) ? $_REQUEST['_wcmp_preload'] : 'metadata';

				$global_settings = array(
					'_wcmp_enable_player' => $enable_player,
					'_wcmp_show_in' => $show_in,
					'_wcmp_player_layout' => $player_style,
					'_wcmp_player_controls' => $player_controls,
					'_wcmp_player_title'=> $player_title,
					'_wcmp_merge_in_grouped' => $merge_grouped,
					'_wcmp_play_all' => $play_all,
					'_wcmp_preload' => $preload
				);

				$apply_to_all_players = ( isset( $_REQUEST[ '_wcmp_apply_to_all_players' ] ) ) ? 1 : 0;
				if($apply_to_all_players)
				{
					$this->_deleteDir( $this->_files_directory_path );

					$products_ids = array(
						'post_type'     => 'product',
						'numberposts'   => -1,
						'post_status'   => array('publish', 'pending', 'draft', 'future'),
						'fields'		=> 'ids',
						'cache_results' => false
					);

					$products = get_posts($products_ids);
					foreach($products as $product_id)
					{
						update_post_meta( $product_id, '_wcmp_enable_player', $enable_player);
						update_post_meta($product_id, '_wcmp_show_in', $show_in);
						update_post_meta($product_id, '_wcmp_player_layout', $player_style);
						update_post_meta($product_id, '_wcmp_player_controls', $player_controls);
						update_post_meta($product_id, '_wcmp_player_title', $player_title);
						update_post_meta($product_id, '_wcmp_merge_in_grouped', $merge_grouped);
						update_post_meta($product_id, '_wcmp_play_all', $play_all);
						update_post_meta($product_id, '_wcmp_preload', $preload);
					}
				}

				update_option('wcmp_global_settings', $global_settings);
			} // Save settings

			print '<div class="wrap">'; // Open Wrap
			include_once dirname(__FILE__).'/views/global_options.php';
			print '</div>'; // Close Wrap
		} // End settings_page

		public function save_post()
		{
			global $post;
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
			if ( empty( $_POST['wcmp_nonce'] ) || !wp_verify_nonce( $_POST['wcmp_nonce'], 'session_id_'.session_id() ) ) return;
			if ( !isset($post) || 'product' !== $post->post_type || !current_user_can( 'edit_post', $post->ID ) ) return;

			$this->delete_post();

			// Save the player options
			$enable_player 	= ( isset( $_REQUEST[ '_wcmp_enable_player' ] ) ) ? 1 : 0;
			$show_in = (isset($_REQUEST[ '_wcmp_show_in' ]) && in_array($_REQUEST[ '_wcmp_show_in' ], array('single', 'multiple'))) ? $_REQUEST[ '_wcmp_show_in' ] : 'all';
			$player_style 	= (
					isset( $_REQUEST[ '_wcmp_player_layout' ] ) &&
					in_array( $_REQUEST[ '_wcmp_player_layout' ], $this->_player_layouts )
				) ? $_REQUEST[ '_wcmp_player_layout' ] : WCMP_DEFAULT_PLAYER_LAYOUT;

			$player_controls = (
					isset( $_REQUEST[ '_wcmp_player_controls' ] ) &&
					in_array( $_REQUEST[ '_wcmp_player_controls' ], $this->_player_controls )
				) ? $_REQUEST[ '_wcmp_player_controls' ] : WCMP_DEFAULT_PLAYER_CONTROLS;

			$player_title = ( isset( $_REQUEST[ '_wcmp_player_title' ] ) ) ? 1 : 0;
			$merge_grouped = ( isset( $_REQUEST[ '_wcmp_merge_in_grouped' ] ) ) ? 1 : 0;
			$play_all = (isset($_REQUEST['_wcmp_play_all'])) ? 1 : 0;
			$preload = (
					isset($_REQUEST['_wcmp_preload']) &&
					in_array($_REQUEST['_wcmp_preload'], array('none', 'metadata', 'auto'))
				) ? $_REQUEST['_wcmp_preload'] : 'metadata';

			add_post_meta( $post->ID, '_wcmp_enable_player', $enable_player, true );
			add_post_meta( $post->ID, '_wcmp_show_in', $show_in, true );
			add_post_meta( $post->ID, '_wcmp_player_layout', $player_style, true );
			add_post_meta( $post->ID, '_wcmp_player_controls', $player_controls, true );
			add_post_meta( $post->ID, '_wcmp_player_title', $player_title, true );
			add_post_meta( $post->ID, '_wcmp_merge_in_grouped', $merge_grouped, true );
			add_post_meta( $post->ID, '_wcmp_preload', $preload, true );
			add_post_meta( $post->ID, '_wcmp_play_all', $preload, true );
		} // End save_post

		public function delete_post()
		{
			global $post;
			if ( !isset($post) || 'product' !== $post->post_type || !current_user_can( 'edit_post', $post->ID ) ) return;

			// Delete truncated version of the audio file
			$this->_delete_truncated_files( $post->ID );

			delete_post_meta( $post->ID, '_wcmp_enable_player' );
			delete_post_meta( $post->ID, '_wcmp_show_in' );
			delete_post_meta( $post->ID, '_wcmp_merge_in_grouped' );
			delete_post_meta( $post->ID, '_wcmp_player_layout' );
			delete_post_meta( $post->ID, '_wcmp_player_controls' );
			delete_post_meta( $post->ID, '_wcmp_player_title' );
			delete_post_meta( $post->ID, '_wcmp_preload' );
			delete_post_meta( $post->ID, '_wcmp_play_all' );
		} // End delete_post

		public function enqueue_resources()
		{
			if( $this->_enqueued_resources ) return;
			$this->_enqueued_resources = true;

			// Unregistering resources
			wp_deregister_style('wp-mediaelement');
			wp_deregister_script('wp-mediaelement');

			// Registering resources
			wp_register_style(
				'wp-mediaelement',
				'https://cdnjs.cloudflare.com/ajax/libs/mediaelement/2.21.2/mediaelementplayer.min.css'
			);
			wp_register_script(
				'wp-mediaelement',
				'https://cdnjs.cloudflare.com/ajax/libs/mediaelement/2.21.2/mediaelement-and-player.min.js'
			);

			wp_enqueue_style( 'wp-mediaelement' );
			wp_enqueue_style( 'wp-mediaelement-skins', 'https://cdnjs.cloudflare.com/ajax/libs/mediaelement/2.21.2/mejs-skins.min.css' );
			wp_enqueue_style( 'wcmp-style', plugin_dir_url(__FILE__).'css/style.css' );
			wp_enqueue_script('jquery');
			wp_enqueue_script('wp-mediaelement');
			wp_enqueue_script('wcmp-script', plugin_dir_url(__FILE__).'js/public.js', array('jquery', 'wp-mediaelement'));

			$play_all = $GLOBALS[ 'WooCommerceMusicPlayer' ]->get_global_attr(
					'_wcmp_play_all',
					// This option is only for compatibility with versions previous to 1.0.28
					$GLOBALS[ 'WooCommerceMusicPlayer' ]->get_global_attr( 'play_all', 0 )
				);
			wp_localize_script('wcmp-script', 'wcmp_global_settings', array('play_all'=>$play_all));
		} // End enqueue_resources

		/**
		 * Replace the shortcode to display a playlist with all songs.
		 */
		public function replace_playlist_shortcode($atts)
		{
			$output = '';
			extract(
				shortcode_atts(
					array(
						'products_ids' 				=> '*',
						'highlight_current_product' => 0,
						'continue_playing' 			=> 0,
						'player_style' 				=> WCMP_DEFAULT_PLAYER_LAYOUT,
						'file_name' 				=> 0,
						'controls'					=> 'track'
					),
					$atts
				)
			);

			// get the produts ids
			$products_ids = preg_replace( '/[^\d\,\*]/', '', $products_ids);
			$products_ids = preg_replace( '/(\,\,)+/', '', $products_ids);
			$products_ids = trim($products_ids, ',');

			if( strlen( $products_ids ) == 0 ) return $output;

			// MAIN CODE GOES HERE
			global $wpdb, $post;

			$current_post_id = ( !empty( $post ) ) ? $post->ID : -1;

			$query = 'SELECT posts.ID, posts.post_title FROM '.$wpdb->posts.' AS posts, '.$wpdb->postmeta.' as postmeta WHERE posts.post_status="publish" AND posts.post_type="product" AND posts.ID = postmeta.post_id AND postmeta.meta_key="_wcmp_enable_player" AND (postmeta.meta_value="yes" OR postmeta.meta_value="1")';

			if( strpos( '*', $products_ids ) === false )
			{
				$query .= ' AND posts.ID IN ('.$products_ids.')';
			}


			$query .= ' ORDER BY posts.post_title ASC';

			$products = $wpdb->get_results( $query );
			if( !empty( $products ) )
			{
				// Enqueue resources

				$this->enqueue_resources();
				wp_enqueue_style( 'wcmp-playlist-widget-style', plugin_dir_url(__FILE__).'widgets/playlist_widget/css/style.css' );
				wp_enqueue_script( 'wcmp-playlist-widget-script', plugin_dir_url(__FILE__).'widgets/playlist_widget/js/public.js' );

				$counter = 0;
				foreach( $products as $product )
				{
					$counter++;
					$class = 'wcmp-even-product';
					if( $counter%2 == 1) $class = 'wcmp-odd-product';

					$audio_files = $this->get_product_files( $product->ID );
					if(!is_array($audio_files)) continue;
					$output .= '<ul class="wcmp-widget-playlist controls-'.esc_attr($controls).' '.esc_attr( $class ).' '.esc_attr( ( $product->ID == $current_post_id ) ? 'wcmp-current-product' : '' ).'">';
					foreach( $audio_files as $index => $file )
					{
						$audio_url = $this->generate_audio_url( $product->ID,  $index );
						$duration = $this->_get_duration_by_url($file['file']);
						$audio_tag = apply_filters(
							'wcmp_widget_audio_tag',
							$this->get_player(
								$audio_url,
								array(
									'player_controls' => $controls,
									'player_style' => $player_style,
									'media_type' => ((gettype($file) == 'object') ? $file->media_type : $file[ 'media_type' ]),
									'id' => $index,
									'duration' => $duration
								)
							),
							$product->ID,
							$index
						);
						$file_title = esc_html(apply_filters('wcmp_widget_file_name', ( ( !empty( $file_name ) ) ? $file[ 'name' ] : $product->post_title ),$product->ID, $index));

						$output .= '<li class="wcmp-widget-playlist-item">'.$audio_tag.'<a href="'.esc_url( get_permalink( $product->ID ) ).'">'.$file_title.'</a></li>';
					}
					$output .= '</ul>';
				}
			}
			return $output;
		} // replace_playlist_shortcode

		//******************** WOOCOMMERCE ACTIONS ************************

        /**
         * Load the additional attributes to select the player layout
         */
		public function woocommerce_player_settings()
		{
			include_once 'views/player_options.php';
		} // End woocommerce_player_settings

		public function get_player(
			$audio_url,
			$args = array()
		)
		{

			$default_args = array(
				'media_type' => 'mp3',
				'player_style' => WCMP_DEFAULT_PLAYER_LAYOUT,
				'player_controls' => WCMP_DEFAULT_PLAYER_CONTROLS,
				'duration' => false
			);

			$args = array_merge( $default_args, $args );
			$id = ( !empty( $args[ 'id' ] ) ) ? 'id="'.esc_attr( $args[ 'id' ] ).'"' : '';

			$global_settings = get_option('wcmp_global_settings', array());
			$preload = $GLOBALS[ 'WooCommerceMusicPlayer' ]->get_global_attr(
					'_wcmp_preload',
					// This option is only for compatibility with versions previous to 1.0.28
					$GLOBALS[ 'WooCommerceMusicPlayer' ]->get_global_attr( 'preload', 'metadata' )
				);

			return '<audio '.$id.' preload="'.esc_attr($preload).'" class="wcmp-player '.esc_attr($args[ 'player_controls' ]).' '.esc_attr($args[ 'player_style' ]).'" '.((!empty($args['duration']))? 'data-duration="'.esc_attr($args['duration']).'"': '').'><source src="'.esc_url($audio_url).'" type="audio/'.esc_attr($args['media_type']).'" /></audio>';

		} // End get_player

		public function get_product_files( $id )
		{
			$product = wc_get_product( $id );
			if( !empty($product) )
				return $this->_get_product_files( array( 'product' => $product, 'all' => 1 ) );
			return array();
		}

		public function generate_audio_url( $product_id, $file_id )
		{
			return $this->_generate_audio_url( $product_id, $file_id );
		}

		public function include_main_player()
		{
			$product = wc_get_product();
			$files = $this->_get_product_files( array( 'product' => $product, 'first' => true ) );
			if( !empty( $files ) )
			{
				$id = $product->get_id();

				$show_in = $this->get_product_attr( $id, '_wcmp_show_in', 'all' );
				if(
					($show_in == 'single' && !is_singular()) ||
					($show_in == 'multiple' && is_singular())
				) return;

				$this->enqueue_resources();

				$player_style 	= $this->get_product_attr( $id, '_wcmp_player_layout', WCMP_DEFAULT_PLAYER_LAYOUT );
				$player_controls = ( $this->get_product_attr( $id, '_wcmp_player_controls', WCMP_DEFAULT_PLAYER_CONTROLS ) != 'all' ) ? 'track' : '';

				$file = reset($files);
				$index = key($files);
				$audio_url = $this->_generate_audio_url( $id,  $index );
				$duration = $this->_get_duration_by_url($file['file']);
				$audio_tag = apply_filters(
					'wcmp_audio_tag',
					$this->get_player(
						$audio_url,
						array(
							'player_controls' => $player_controls,
							'player_style' => $player_style,
							'media_type' => ((gettype($file) == 'object') ? $file->media_type : $file[ 'media_type' ] ),
							'duration' => $duration
						)
					),
					$id,
					$index
				);

				do_action('wcmp_before_player_shop_page',$id);
				print '<div class="wcmp-player-container product-'.((gettype($file) == 'object') ? $file->product : $file['product']).'">'.$audio_tag.'</div>';
				do_action('wcmp_after_player_shop_page',$id);
			}
		} // End include_main_player

		public function include_all_players()
		{
			$product = wc_get_product();
			$files = $this->_get_product_files( array( 'product' => $product, 'all' => true ) );
			if( !empty( $files ) )
			{
				$id = $product->get_id();

				$show_in = $this->get_product_attr( $id, '_wcmp_show_in', 'all' );
				if(
					($show_in == 'single' && !is_singular()) ||
					($show_in == 'multiple' && is_singular())
				) return;

				$this->enqueue_resources();
				$player_style 		= $this->get_product_attr( $id, '_wcmp_player_layout', WCMP_DEFAULT_PLAYER_LAYOUT );
				$player_controls 	= $this->get_product_attr( $id, '_wcmp_player_controls', WCMP_DEFAULT_PLAYER_CONTROLS );
				$player_title 		= intval( $this->get_product_attr( $id, '_wcmp_player_title', WCMP_DEFAULT_PlAYER_TITLE ) );
				$merge_grouped 		= intval( $this->get_product_attr( $id, '_wcmp_merge_in_grouped', 0 ) );
				$merge_grouped_clss = ($merge_grouped) ? 'merge_in_grouped_products' : '';

				$counter = count( $files );
				do_action('wcmp_before_players_product_page',$id);
				if( $counter == 1 )
				{
					$player_controls = ($player_controls == 'button') ? 'track' : '';
					$file = reset($files);
					$index = key($files);
					$audio_url = $this->_generate_audio_url( $id,  $index );
					$duration = $this->_get_duration_by_url($file['file']);
					$audio_tag = apply_filters(
						'wcmp_audio_tag',
						$this->get_player(
							$audio_url,
							array(
								'player_controls' => $player_controls,
								'player_style' => $player_style,
								'media_type' => ((gettype($file) == 'object') ? $file->media_type: $file[ 'media_type' ]),
								'duration' => $duration
							)
						),
						$id,
						$index
					);
					$title = esc_html(($player_title)?apply_filters('wcmp_file_name',$file['name'],$id,$index):'');
					print '<div class="wcmp-player-container '.$merge_grouped_clss.' product-'.((gettype($file) == 'object') ? $file->product : $file['product']).'">'.$audio_tag.'</div><div class="wcmp-player-title">'.$title.'</div><div style="clear:both;"></div>';
				}
				elseif( $counter > 1 )
				{
					$before = '<table class="wcmp-player-list '.$merge_grouped_clss.'">';
					$after  = '';
					foreach( $files as $index => $file )
					{
						$evenOdd = ( $counter % 2 == 1 ) ? 'wcmp-odd-row' : 'wcmp-even-row';
						$counter--;
						$audio_url = $this->_generate_audio_url( $id,  $index );
						$duration = $this->_get_duration_by_url($file['file']);
						$audio_tag = apply_filters(
							'wcmp_audio_tag',
							$this->get_player(
								$audio_url,
								array(
									'player_style' => $player_style,
									'player_controls' => ($player_controls != 'all' ) ? 'track' : '',
									'media_type' => ((gettype($file) == 'object') ? $file->media_type : $file[ 'media_type' ] ),
									'duration'	=> $duration
								)
							),
							$id,
							$index
						);
						$title = esc_html(($player_title)?apply_filters('wcmp_file_name',$file['name'],$id,$index):'');

						print $before;
						$before = '';
						$after  = '</table>';
						if($player_controls != 'all' )
						{
							print '<tr class="'.esc_attr( $evenOdd ).' product-'.((gettype($file) == 'object') ? $file->product : $file['product']).'"><td class="wcmp-player-container wcmp-column-player-'.esc_attr($player_style).'">'.$audio_tag.'</td><td class="wcmp-player-title wcmp-column-player-title">'.$title.'</td></tr>';
						}
						else
						{
							print '<tr class="'.esc_attr( $evenOdd ).' product-'.((gettype($file) == 'object') ? $file->product : $file['product']).'"><td><div class="wcmp-player-container">'.$audio_tag.'</div><div class="wcmp-player-title wcmp-column-player-title">'.$title.'</div></td></tr>';
						}
					}
					print $after;
				}
				do_action('wcmp_after_players_product_page',$id);
			}
		} // End include_all_players

		//******************** PRIVATE METHODS ************************
		private function _createDir()
		{
			// Generate upload dir
			$_files_directory = wp_upload_dir();
			$this->_files_directory_path = rtrim( $_files_directory[ 'basedir' ], '/' ).'/wcmp/';
			$this->_files_directory_url  = rtrim( $_files_directory[ 'baseurl' ], '/' ).'/wcmp/';
			$this->_files_directory_url  = preg_replace('/^http(s)?:\/\//', '//', $this->_files_directory_url);
			if( !file_exists( $this->_files_directory_path ) ) @mkdir( $this->_files_directory_path, 0755 );
		} // End _createDir

		private function _deleteDir( $dirPath )
		{
			try
			{
				if (!is_dir($dirPath)) return;
				if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') $dirPath .= '/';
				$files = glob($dirPath . '*', GLOB_MARK);
				foreach ($files as $file)
				{
					if (is_dir($file))  $this->_deleteDir($file);
					else unlink($file);
				}
				rmdir($dirPath);
			}
			catch( Exception $err )
			{
				return;
			}
		} // End _deleteDir

		private function _get_duration_by_url( $url )
		{
			global $wpdb;
			$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid=%s;", $url ));
			if(empty($attachment))
			{
				$file = basename($url);
				$attachment = $wpdb->get_col($wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_wp_attached_file' AND meta_value LIKE %s;", '%'.$wpdb->esc_like($file).'%' ));
			}
			if( !empty($attachment) )
			{
				$metadata = wp_get_attachment_metadata( $attachment[ 0 ] );
				if( $metadata !== false && !empty($metadata['length_formatted']) )
				{
					return $metadata['length_formatted'];
				}
			}
			return false;
		} // End _get_duration_by_url

		private function _generate_audio_url( $product_id, $file_index )
		{
			$url = $_SERVER['REQUEST_URI'];
			$url .= ( (strpos( $url, '?' ) === false) ? '?' : '&' ).'wcmp-action=play&wcmp-product='.$product_id.'&wcmp-file='.$file_index;
			return $url;
		} // End _generate_audio_url

		private function _delete_truncated_files( $product_id )
		{
			$files_arr = get_post_meta( $product_id, '_downloadable_files', true );
			if( !empty( $files_arr ) && is_array( $files_arr ) )
			{
				foreach( $files_arr as $file )
				{
					if( is_array( $file ) && !empty( $file[ 'file' ] ) )
					{
						$ext = pathinfo( $file[ 'file' ], PATHINFO_EXTENSION );
						$file_name = md5( $file[ 'file' ] ).( (!empty($ext) ) ? '.'.$ext : '' );
						@unlink( $this->_files_directory_path.$file_name );
					}
				}
			}

		} // End _delete_truncated_files

		/**
		 * Check if the file is an audio file and return its type or false
		 */
		private function _is_audio( $file_path )
		{
			if( preg_match( '/\.(mp3|ogg|oga|wav|wma|mp4|m4a)$/i', $file_path, $match ) )
				return $match[ 1 ];
			return false;
		} // End _is_audio

		private function _sort_list($product_a, $product_b)
		{
			$menu_order_a = $product_a->get_menu_order();
			$menu_order_b = $product_b->get_menu_order();
			if ($menu_order_a == $menu_order_b)
			{
				$name_a = $product_a->get_name();
				$name_b = $product_b->get_name();
				if($name_a == $name_b) return 0;
				return ($name_a < $name_b) ? -1 : 1;
			}
			return ($menu_order_a < $menu_order_b) ? -1 : 1;
		} // End _sort_list

		private function _edit_files_array($product_id, $files)
		{
			$p_files = array();
			foreach($files as $key => $file)
			{
				$p_key = $key.'_'.$product_id;
				if(gettype($file) == "object")
				{
					$file->product=$product_id;

				}
				else
				{
					$file['product']=$product_id;
				}
				$p_files[$p_key] = $file;
			}
			return $p_files;
		} // end _edit_files_array

		private function _get_recursive_product_files($product, $files_arr )
		{
			$id = $product->get_id();
			$product_type = $product->get_type();

			if( $product_type == 'variation' )
			{
				// $_files = $product->get_files();
				$_files = $product->get_downloads();
				$files = $this->_edit_files_array($id, $_files);
				$files_arr = array_merge( $files_arr, $_files );
			}
			else
			{

				if( !$this->get_product_attr( $id, '_wcmp_enable_player', false ) ) return $files_arr;

				switch( $product_type )
				{
					case 'simple':
						// $_files = $product->get_files();
						$_files = $product->get_downloads();
						$_files = $this->_edit_files_array($id, $_files );
						$files_arr = array_merge( $files_arr, $_files );
					break;
					case 'variable':
					case 'grouped':
						$children = $product->get_children();

						foreach( $children as $key => $child_id )
							$children[$key] = wc_get_product($child_id);

						uasort($children, array(&$this,'_sort_list'));

						foreach( $children as $child_obj )
							$files_arr = $this->_get_recursive_product_files( $child_obj, $files_arr );

					break;
				}
			}
			return $files_arr;
		}

		private function _get_product_files( $args )
		{
			if( empty( $args[ 'product' ] ) ) return false;

			$product = $args[ 'product' ];
			$files = $this->_get_recursive_product_files( $product, array() );

			if( empty( $files ) ) return false;

			$audio_files = array();
			foreach( $files as $index => $file )
			{
				if( !empty( $file[ 'file' ] ) && ($media_type = $this->_is_audio( $file[ 'file' ] )) !== false )
				{
					if(gettype($file) == 'object')
						$file->media_type = $media_type;
					else
						$file[ 'media_type' ] = $media_type;

					if( !empty( $args[ 'file_id' ] ) )
					{
						if( $args[ 'file_id' ] == $index )
						{
							$audio_files[ $index ] = $file;
							return $audio_files;
						}
					}
					elseif( !empty( $args[ 'first' ] ) )
					{
						$audio_files[ $index ] = $file;
						return $audio_files;
					}
					elseif( !empty( $args[ 'all' ] ) )
					{
						$audio_files[ $index ] = $file;
					}
				}
			}

			return $audio_files;
		} // End _get_product_files

		/**
		 * Create a temporal file and redirect to the new file
		 */
		private function _output_file( $args )
		{
			if( empty( $args[ 'url' ] ) ) return;
			$url = $args[ 'url' ];
			$file_extension = pathinfo($url, PATHINFO_EXTENSION);
			$file_name = md5( $url ).( ( !empty( $file_extension ) ) ? '.'.$file_extension : '' );
			$text = 'The requested URL was not found on this server';
			$file_path = $this->_files_directory_path.$file_name;

			if(file_exists($file_path)){
				header('location: '.$this->_files_directory_url.$file_name);
				exit;
			}else{
				try{
					$c = false;
					if( ( $path = $this->_is_local( $url ) ) !== false ){
						$c = copy( $path, $file_path);
					}else{
						$response = wp_remote_get($url, array( 'timeout' => WCMP_REMOTE_TIMEOUT, 'stream' => true, 'filename' => $file_path ) );
						if(  !is_wp_error( $response ) && $response['response']['code'] == 200 ) $c = true;
					}

					if( $c === true ){
						header('location: '.$this->_files_directory_url.$file_name);
						exit;
					}
				}
				catch(Exception $err)
				{
				}
				$text = 'Is not possible create the truncated file\'s version because the memory is not sufficient, or the permissions in the "uploads/wcmp" directory are not sufficient to create the truncated version of file.';
			}
			$this->_print_page_not_found( $text );
		} // End _output_file

		/**
		 * Print not found page if file it is not accessible
		 */
		private function _print_page_not_found( $text = 'The requested URL was not found on this server' ){
			header("Status: 404 Not Found");
			echo '<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
				  <HTML><HEAD>
				  <TITLE>404 Not Found</TITLE>
				  </HEAD><BODY>
				  <H1>Not Found</H1>
				  <P>'.$text.'</P>
				  </BODY></HTML>
				 ';
		} // End _print_page_not_found

		private function _is_local( $url )
		{
			$attachment_id = attachment_url_to_postid( $url );
			if( $attachment_id )
			{
				$file_path = get_attached_file( $attachment_id );
				if( file_exists( $file_path ) ) return $file_path;
			}
			return false;
		}
	} // End Class WooCommerceMusicPlayer

	$GLOBALS[ 'WooCommerceMusicPlayer' ] = new WooCommerceMusicPlayer;
}