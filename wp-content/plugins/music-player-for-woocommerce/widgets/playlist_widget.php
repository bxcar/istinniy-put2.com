<?php
if(!function_exists('wcmp_register_playlist_widget'))
{
	function wcmp_register_playlist_widget()
	{
		return register_widget("WCMP_PLAYLIST_WIDGET");
	}
}
add_action( 'widgets_init', 'wcmp_register_playlist_widget' );

if( !class_exists( 'WCMP_PLAYLIST_WIDGET' ) )
{
	class WCMP_PLAYLIST_WIDGET extends WP_Widget
	{
		function __construct()
		{
			$widget_ops = array('classname' => 'WCMP_PLAYLIST_WIDGET', 'description' => 'Includes a playlist with the audio files of products selected' );

			parent::__construct('WCMP_PLAYLIST_WIDGET', 'Music Player for WooCommerce - Playlist', $widget_ops);
		}

		function form($instance)
		{
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'products_ids' => '', 'highlight_current_product' => 0, 'continue_playing' => 0, 'player_style' => WCMP_DEFAULT_PLAYER_LAYOUT, 'file_name' => 0 ) );

			$title 						= $instance['title'];
			$products_ids 				= $instance['products_ids'];
			$highlight_current_product 	= $instance['highlight_current_product'];
			$continue_playing 			= $instance['continue_playing'];
			$player_style 				= $instance['player_style'];
			$file_name 					= $instance['file_name'];

			$play_all					= $GLOBALS['WooCommerceMusicPlayer']->get_global_attr(
											'_wcmp_play_all',
											// This option is only for compatibility with versions previous to 1.0.28
											$GLOBALS['WooCommerceMusicPlayer']->get_global_attr(
												'play_all',
												0
											)
										);
			$preload					= $GLOBALS['WooCommerceMusicPlayer']->get_global_attr(
											'_wcmp_preload',
											// This option is only for compatibility with versions previous to 1.0.28
											$GLOBALS['WooCommerceMusicPlayer']->get_global_attr(
												'preload',
												'metadata'
											)
										);
			?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'woocommerce_music_player' ); ?>: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('products_ids'); ?>"><?php _e( 'Products IDs', 'woocommerce_music_player' ); ?>: <input class="widefat" id="<?php echo $this->get_field_id('products_ids'); ?>" name="<?php echo $this->get_field_name('products_ids'); ?>" type="text" value="<?php echo esc_attr($products_ids); ?>" placeholder="<?php _e( 'Products IDs separated by comma, or a * for all', 'woocommerce_music_player' ); ?>" /></label>
			</p>
			<p>
				<?php
					_e( 'Enter the ID of products separated by comma, or a * symbol to includes all products in the playlist.', 'woocommerce_music_player' );
				?>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('player_style'); ?>"><?php _e( 'Player layout', 'woocommerce_music_player' ); ?>: </label>
			</p>
			<p>
				<label><input name="<?php echo $this->get_field_name('player_style'); ?>" type="radio" value="mejs-classic" <?php echo (($player_style == 'mejs-classic') ? 'checked' : '') ;?> style="float:left; margin-top:8px;" /><img src="<?php print esc_url(WCMP_PLUGIN_URL); ?>/views/assets/skin1_btn.png" /></label>
			</p>
			<p>
				<label><input name="<?php echo $this->get_field_name('player_style'); ?>" type="radio" value="mejs-ted" <?php echo (($player_style == 'mejs-ted') ? 'checked' : '') ;?> style="float:left; margin-top:8px;" /><img src="<?php print esc_url(WCMP_PLUGIN_URL); ?>/views/assets/skin2_btn.png" /></label>
			</p>
			<p>
				<label><input name="<?php echo $this->get_field_name('player_style'); ?>" type="radio" value="mejs-wmp" <?php echo (($player_style == 'mejs-wmp') ? 'checked' : '') ;?> style="float:left; margin-top:16px;" /><img src="<?php print esc_url(WCMP_PLUGIN_URL); ?>/views/assets/skin3_btn.png" /></label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('play_all'); ?>"><?php _e( 'Play all', 'woocommerce_music_player' ); ?>: <input id="<?php echo $this->get_field_id('play_all'); ?>" name="<?php echo $this->get_field_name('play_all'); ?>" type="checkbox" <?php echo ( ( $play_all ) ? 'CHECKED' : '' );
				?> /></label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('preload'); ?>"><?php _e( 'Preload', 'woocommerce_music_player' ); ?>:</label><br />
				<label><input name="<?php echo $this->get_field_name('preload'); ?>" type="radio" value="none" <?php echo ( ( $preload == 'none' ) ? 'CHECKED' : '' ); ?> /> None</label>
				<label><input name="<?php echo $this->get_field_name('preload'); ?>" type="radio" value="metadata" <?php echo ( ( $preload == 'metadata' ) ? 'CHECKED' : '' ); ?> /> Metadata</label>
				<label><input name="<?php echo $this->get_field_name('preload'); ?>" type="radio" value="auto" <?php echo ( ( $preload == 'auto' ) ? 'CHECKED' : '' ); ?> /> Auto</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('file_name'); ?>"><?php _e( 'Display file name', 'woocommerce_music_player' ); ?>: <input id="<?php echo $this->get_field_id('file_name'); ?>" name="<?php echo $this->get_field_name('file_name'); ?>" type="checkbox" <?php echo ( ( $file_name ) ? 'CHECKED' : '' ); ?> /></label>
			</p>
			<p>
				<?php
					_e( 'Display the files names if the checkbox is ticked, or the products names if not.', 'woocommerce_music_player' );
				?>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('highlight_current_product'); ?>"><?php _e( 'Highlight the current product', 'woocommerce_music_player' ); ?>: <input id="<?php echo $this->get_field_id('highlight_current_product'); ?>" name="<?php echo $this->get_field_name('highlight_current_product'); ?>" type="checkbox" <?php echo ( ( $highlight_current_product ) ? 'CHECKED' : '' ); ?> /></label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('continue_playing'); ?>"><?php _e( 'Continue playing after navigate', 'woocommerce_music_player' ); ?>: <input id="<?php echo $this->get_field_id('continue_playing'); ?>" name="<?php echo $this->get_field_name('continue_playing'); ?>" type="checkbox" <?php echo ( ( $continue_playing ) ? 'CHECKED' : '' ); ?> /></label>
			</p>
			<p>
				<?php
					_e( 'Continue playing the same song at same position after navigate. You can experiment some delay because the music player should to load the audio file again, and in some mobiles devices, where the action of the user is required, the player cannot starting playing automatically.', 'woocommerce_music_player' );
				?>
			</p>
			<?php
		}

		function update($new_instance, $old_instance)
		{
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['products_ids'] = $new_instance['products_ids'];
			$instance['highlight_current_product'] = $new_instance['highlight_current_product'];
			$instance['continue_playing'] = $new_instance['continue_playing'];
			$instance['player_style'] = $new_instance['player_style'];
			$instance['file_name'] = $new_instance['file_name'];

			$global_settings = get_option('wcmp_global_settings', array());
			$global_settings['_wcmp_play_all'] = (!empty($new_instance['play_all'])) ? 1 : 0;
			$global_settings['_wcmp_preload'] = (
					!empty($new_instance['preload']) &&
					in_array($new_instance['preload'], array('none','metadata','auto'))
				) ? $new_instance['preload'] : 'metadata';

			update_option( 'wcmp_global_settings', $global_settings );

			return $instance;
		}

		function widget($args, $instance)
		{
			extract($args, EXTR_SKIP);

			$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

			$output = $GLOBALS[ 'WooCommerceMusicPlayer' ]->replace_playlist_shortcode(
				array(
					'products_ids' 				=> $instance['products_ids'],
					'highlight_current_product' => $instance['highlight_current_product'],
					'continue_playing' 			=> $instance['continue_playing'],
					'player_style' 				=> $instance['player_style'],
					'file_name' 				=> $instance['file_name']
				)
			);

			if( strlen( $output ) == 0 ) return;

			print $before_widget;
			if (!empty($title)) print $before_title . $title . $after_title;
			print $output;
			print $after_widget;
		}
	} // End Class WCMP_PLAYLIST_WIDGET
}