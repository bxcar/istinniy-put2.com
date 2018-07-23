<?php
if( !defined( 'WCMP_PLUGIN_URL' ) ) { echo 'Direct access not allowed.';  exit; }

// include resources
wp_enqueue_style( 'wcmp-admin-style', plugin_dir_url(__FILE__).'../css/style.admin.css', array(), '1.0.24' );

global $post;
$enable_player 	= $GLOBALS[ 'WooCommerceMusicPlayer' ]->get_product_attr( $post->ID, '_wcmp_enable_player', false );
$show_in 		= $GLOBALS[ 'WooCommerceMusicPlayer' ]->get_product_attr( $post->ID, '_wcmp_show_in', 'all' );
$player_style 	= $GLOBALS[ 'WooCommerceMusicPlayer' ]->get_product_attr( $post->ID, '_wcmp_player_layout', WCMP_DEFAULT_PLAYER_LAYOUT );
$player_controls= $GLOBALS[ 'WooCommerceMusicPlayer' ]->get_product_attr( $post->ID, '_wcmp_player_controls', WCMP_DEFAULT_PLAYER_CONTROLS );
$player_title= intval( $GLOBALS[ 'WooCommerceMusicPlayer' ]->get_product_attr( $post->ID, '_wcmp_player_title', 1 ) );
$merge_grouped	= intval( $GLOBALS[ 'WooCommerceMusicPlayer' ]->get_product_attr( $post->ID, '_wcmp_merge_in_grouped',0 ) );
$play_all		= intval( $GLOBALS[ 'WooCommerceMusicPlayer' ]->get_product_attr(
						$post->ID,
						'_wcmp_play_all',
						// This option is only for compatibility with versions previous to 1.0.28
						$GLOBALS[ 'WooCommerceMusicPlayer' ]->get_product_attr(
							$post->ID,
							'play_all',
							0
						)
					)
				);
$preload		= intval( $GLOBALS[ 'WooCommerceMusicPlayer' ]->get_product_attr(
						$post->ID,
						'_wcmp_preload',
						$GLOBALS[ 'WooCommerceMusicPlayer' ]->get_product_attr(
							$post->ID,
							'preload',
							'metadata'
						)
					)
				);
?>
<input type="hidden" name="wcmp_nonce" value="<?php echo wp_create_nonce( 'session_id_'.session_id() ); ?>" />
<table class="widefat" style="border-left:0;border-right:0;border-bottom:0;padding-bottom:0;">
	<tr>
		<td>
			<div style="border:1px solid #E6DB55;margin-bottom:10px;padding:5px;background-color: #FFFFE0;">
			<?php
			_e(
				'<p>The player uses the audio files associated to the product. If you want protecting the audio files for selling, tick the checkbox: <b>"Protect the file"</b>, in whose case the plugin will create a truncated version of the audio files for selling to be used for demo. The size of audio files for demo is based on the number entered through the attribute: <b>"Percent of audio used for protected playbacks"</b>.</p><p><b>Protecting the files prevents that malicious users can access to the original audio files without pay for them.</b></p>',
				'woocommerce_music_player'
			);
			?>
			<p><?php _e( 'The security feature and particular files for demo are only available in the PRO version of the plugin', 'woocommerce_music_player'); ?>. <a target="_blank" href="http://wordpress.dwbooster.com/content-tools/music-player-for-woocommerce"><?php _e('CLICK HERE TO GET THE PRO VERSION OF THE PLUGIN', 'woocommerce_music_player'); ?></a></p>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<table class="widefat" style="border:1px solid #e1e1e1;">
				<tr>
					<td><?php _e( 'Include music player', 'woocommerce_music_player' ); ?></td>
					<td><div class="wcmp-tooltip"><span class="wcmp-tooltiptext"><?php _e('The player is shown only if the product is "downloadable", and there is at least an audio file between the "Downloadable files"', 'woocommerce_music_player'); ?></span><input type="checkbox" name="_wcmp_enable_player" <?php echo (( $enable_player ) ? 'checked' : '' ); ?> /></div></td>
				</tr>
				<tr>
					<td><?php _e( 'Include in', 'woocommerce_music_player' ); ?></td>
					<td>
						<input type="radio" name="_wcmp_show_in" value="single" <?php echo (( $show_in == 'single' ) ? 'checked' : '' ); ?> />
						<?php _e('single-entry pages <i>(Product\'s page only)</i>', 'woocommerce_music_player'); ?><br />

						<input type="radio" name="_wcmp_show_in" value="multiple" <?php echo (( $show_in == 'multiple' ) ? 'checked' : '' ); ?> />
						<?php _e('multiple entries pages <i>(Shop pages, archive pages, but not in the product\'s page)</i>', 'woocommerce_music_player'); ?><br />

						<input type="radio" name="_wcmp_show_in" value="all" <?php echo (( $show_in == 'all' ) ? 'checked' : '' ); ?> />
						<?php _e('all pages <i>(with single or multiple-entries)</i>', 'woocommerce_music_player'); ?>
					</td>
				</tr>
				<tr>
					<td><?php _e( 'Merge in grouped products', 'woocommerce_music_player' ); ?></td>
					<td><input type="checkbox" name="_wcmp_merge_in_grouped" <?php echo (( $merge_grouped ) ? 'checked' : '' ); ?> /><br /><em><?php _e( 'In grouped products, display the "Add to cart" buttons and quantity fields in the players rows', 'woocommerce_music_player' ); ?></em></td>
				</tr>
				<tr>
					<td valign="top"><?php _e( 'Player layout', 'woocommerce_music_player' ); ?></td>
					<td>
						<table>
							<tr>
								<td><input name="_wcmp_player_layout" type="radio" value="mejs-classic" <?php echo (($player_style == 'mejs-classic') ? 'checked' : '') ;?> /></td>
								<td><img src="<?php print esc_url(WCMP_PLUGIN_URL); ?>/views/assets/skin1.png" /></td>
							</tr>

							<tr>
								<td><input name="_wcmp_player_layout" type="radio" value="mejs-ted" <?php echo (($player_style == 'mejs-ted') ? 'checked' : '') ;?> /></td>
								<td><img src="<?php print esc_url(WCMP_PLUGIN_URL); ?>/views/assets/skin2.png" /></td>
							</tr>

							<tr>
								<td><input name="_wcmp_player_layout" type="radio" value="mejs-wmp" <?php echo (($player_style == 'mejs-wmp') ? 'checked' : '') ;?> /></td>
								<td><img src="<?php print esc_url(WCMP_PLUGIN_URL); ?>/views/assets/skin3.png" /></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<?php _e( 'Preload', 'woocommerce_music_player' ); ?>
					</td>
					<td>
						<label><input type="radio" name="_wcmp_preload" value="none" <?php if($preload == 'none') echo 'CHECKED'; ?> /> None</label><br />
						<label><input type="radio" name="_wcmp_preload" value="metadata" <?php if($preload == 'metadata') echo 'CHECKED'; ?> /> Metadata</label><br />
						<label><input type="radio" name="_wcmp_preload" value="auto" <?php if($preload == 'auto') echo 'CHECKED'; ?> /> Auto</label><br />
					</td>
				</tr>
				<tr>
					<td>
						<?php _e( 'Play all', 'woocommerce_music_player' ); ?>
					</td>
					<td>
						<input type="checkbox" name="_wcmp_play_all" <?php if(!empty($play_all)) echo 'CHECKED'; ?> />
					</td>
				</tr>
				<tr>
					<td><?php _e( 'Player controls', 'woocommerce_music_player' ); ?></td>
					<td>
						<input type="radio" name="_wcmp_player_controls" value="button" <?php echo (( $player_controls == 'button' ) ? 'checked' : ''); ?> /> <?php _e( 'the play/pause button only', 'woocommerce_music_player' ); ?><br />
						<input type="radio" name="_wcmp_player_controls" value="all" <?php echo (( $player_controls == 'all' ) ? 'checked' : ''); ?> /> <?php _e( 'all controls', 'woocommerce_music_player' ); ?><br />
						<input type="radio" name="_wcmp_player_controls" value="default" <?php echo (( $player_controls == 'default' ) ? 'checked' : ''); ?> /> <?php _e( 'the play/pause button only, or all controls depending on context', 'woocommerce_music_player' ); ?><br />
					</td>
				</tr>
				<tr>
					<td><?php _e( 'Display the player\'s title', 'woocommerce_music_player' ); ?></td>
					<td>
						<input type="checkbox" name="_wcmp_player_title" <?php echo (( !empty($player_title) ) ? 'checked' : ''); ?> />
					</td>
				</tr>
				<tr>
					<td colspan="2" style="color:red;"><?php _e( 'The security feature is only available in the PRO version of the plugin', 'woocommerce_music_player'); ?>. <a target="_blank" href="http://wordpress.dwbooster.com/content-tools/music-player-for-woocommerce"><?php _e('CLICK HERE TO GET THE PRO VERSION OF THE PLUGIN', 'woocommerce_music_player'); ?></a></td>
				</tr>
				<tr>
					<td style="color:#DDDDDD;"><?php _e( 'Protect the file', 'woocommerce_music_player' ); ?></td>
					<td><input type="checkbox" DISABLED /></td>
				</tr>
				<tr valign="top">
					<td style="color:#DDDDDD;"><?php _e('Percent of audio used for protected playbacks', 'woocommerce_music_player'); ?></td>
					<td style="color:#DDDDDD;">
						<input type="number" DISABLED /> % <br /><br />
						<em><?php _e('To prevent unauthorized copying of audio files, the files will be partially accessible', 'woocommerce_music_player'); ?></em>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table class="widefat" style="border:0;padding-bottom:20px;">
	<tr valign="top">
		<td style="color:#DDDDDD;">
			<table class="widefat" style="border:1px solid #e1e1e1;">
				<tr valign="top">
					<td style="color:#DDDDDD;"><input type="checkbox" disabled /> <?php _e('Select my own demo files', 'woocommerce_music_player'); ?></td>
				</tr>
				<tr valign="top" class="wcmp-demo-files">
					<td>
						<div style="color:#DDDDDD;"><?php _e('Demo files', 'woocommerce_music_player'); ?></div>
						<table class="widefat">
							<thead>
								<tr>
									<th style="color:#DDDDDD;"><?php _e('Name', 'woocommerce_music_player'); ?></th>
									<th colspan="2" style="color:#DDDDDD;"><?php _e('File URL', 'woocommerce_music_player'); ?></th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<input type="text" class="wcmp-file-name" placeholder="<?php _e('File Name', 'woocommerce_music_player'); ?>" disabled style="color:#DDDDDD;" />
									</td>
									<td>
										<input type="text" class="wcmp-file-url" placeholder="http://" disabled style="color:#DDDDDD;" />
									</td>
									<td width="1%" style="color:#DDDDDD;">
										<a href="javascript:void(0);" class="button wcmp-select-file" style="color:#DDDDDD;"><?php _e('Choose file', 'woocommerce_music_player'); ?></a>
									</td>
									<td width="1%" style="color:#DDDDDD;">
										<a href="javascript:void(0);" class="wcmp-delete" style="color:#DDDDDD;"><?php _e('Delete', 'woocommerce_music_player');?></a>
									</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<th colspan="4" style="color:#DDDDDD;">
										<a href="javascript:void(0);" class="button wcmp-add" style="color:#DDDDDD;"><?php _e('Add File', 'woocommerce_music_player'); ?></a>
									</th>
								</tr>
							</tfoot>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>