<?php
if( !defined( 'WCMP_PLUGIN_URL' ) ) { echo 'Direct access not allowed.';  exit; }

// include resources
wp_enqueue_style( 'wcmp-admin-style', plugin_dir_url(__FILE__).'../css/style.admin.css', array(), '5.0.23' );

$enable_player 	= $GLOBALS[ 'WooCommerceMusicPlayer' ]->get_global_attr( '_wcmp_enable_player', false );
$show_in 		= $GLOBALS[ 'WooCommerceMusicPlayer' ]->get_global_attr( '_wcmp_show_in', 'all' );
$player_style 	= $GLOBALS[ 'WooCommerceMusicPlayer' ]->get_global_attr( '_wcmp_player_layout', WCMP_DEFAULT_PLAYER_LAYOUT );
$player_controls= $GLOBALS[ 'WooCommerceMusicPlayer' ]->get_global_attr( '_wcmp_player_controls', WCMP_DEFAULT_PLAYER_CONTROLS );
$player_title	= intval( $GLOBALS[ 'WooCommerceMusicPlayer' ]->get_global_attr( '_wcmp_player_title',1 ) );
$merge_grouped	= intval( $GLOBALS[ 'WooCommerceMusicPlayer' ]->get_global_attr( '_wcmp_merge_in_grouped',0 ) );
$preload		= $GLOBALS[ 'WooCommerceMusicPlayer' ]->get_global_attr(
					'_wcmp_preload',
					// This option is only for compatibility with versions previous to 1.0.28
					$GLOBALS[ 'WooCommerceMusicPlayer' ]->get_global_attr( 'preload', 'metadata' )
				);
$play_all		= $GLOBALS[ 'WooCommerceMusicPlayer' ]->get_global_attr(
					'_wcmp_play_all',
					// This option is only for compatibility with versions previous to 1.0.28
					$GLOBALS[ 'WooCommerceMusicPlayer' ]->get_global_attr( 'play_all', 0 )
				);
?>
<form method="post">
<h1><?php _e('Music Player for WooCommerce - Global Settings', 'woocommerce_music_player'); ?></h1>
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
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<table class="widefat" style="border:1px solid #e1e1e1;margin-bottom:20px;">
				<tr>
					<td colspan="2" style="color:red;"><?php _e( 'The general settings affect only the PRO version of the plugin', 'woocommerce_music_player'); ?>. <a target="_blank" href="http://wordpress.dwbooster.com/content-tools/music-player-for-woocommerce"><?php _e('CLICK HERE TO GET THE PRO VERSION OF THE PLUGIN', 'woocommerce_music_player'); ?></a></td>
				</tr>
				<tr>
				<tr>
					<td colspan="2"><h2 style="color:#DDDDDD;"><?php _e( 'General Settings', 'woocommerce_music_player' ); ?></h2></td>
				</tr>
					<td width="30%" style="color:#DDDDDD;"><?php _e( 'Truncate the audio files for demo with ffmpeg', 'woocommerce_music_player' ); ?></td>
					<td><input type="checkbox" DISABLED /></td>
				</tr>
				<tr>
					<td width="30%" style="color:#DDDDDD;"><?php _e( 'ffmpeg path', 'woocommerce_music_player' ); ?></td>
					<td><input type="text" DISABLED /></td>
				</tr>
				<tr>
					<td colspan="2"><hr /></td>
				</tr>
				<tr>
					<td width="30%" style="color:#DDDDDD;"><?php _e( 'Delete the demo files generated previously', 'woocommerce_music_player' ); ?></td>
					<td><input type="checkbox" DISABLED /></td>
				</tr>
				<tr>
				<td colspan="2"><hr /></td>
			</tr>
			<tr>
				<td width="30%" style="color:#DDDDDD;"><?php _e( 'Store demo files on Google Drive', 'woocommerce_music_player' ); ?></td>
				<td><input type="checkbox" disabled /></td>
			</tr>
			<tr>
				<td width="30%" style="color:#DDDDDD;"><?php _e( 'Import a JSON Key file', 'woocommerce_music_player' ); ?></td>
				<td>
					<input type="file" disabled />
					<br /><br />
					<div style="border:1px solid #E6DB55;margin-bottom:10px;padding:5px;background-color: #FFFFE0;">
						<h3>Turn on the Drive API</h3>
						<p>
							<ol>
								<li>
									Use <a href="javascript:void(0);" target="_blank" class="gc-analytics-event" data-category="Quickstart" data-action="Enable" data-label="Drive API, PHP">this wizard</a> to create or select a project in the Google Developers Console and automatically turn on the API. Click <strong>Continue</strong>, then <strong>Go to credentials</strong>.
								</li>
								<li>
									On the <strong>Add credentials to your project</strong> page, click the <strong>Cancel</strong> button.
								</li>
								<li>
									At the top of the page, select the <strong>OAuth consent screen</strong> tab. Select an
									<strong>Email address</strong>, enter a <strong>Product name</strong> if not already set, and click the <strong>Save</strong> button.
								</li>
								<li>
									Select the <strong>Credentials</strong> tab, click the <strong>Create credentials</strong> button and select <strong>OAuth client ID</strong>.
								</li>
								<li>Press the <strong>Configure consent screen</strong> button, enter the name <strong>WooCommerce Music Player</strong> in the attribute: <strong>Product name shown to users</strong>, and click the <strong>Save</strong> button.</li>
								<li>
									Select the application type <strong>Web application</strong>, enter the URL below as the <strong>Authorized redirect URIs</strong>:<br><br>
									.........
									<br><br>
									and click the <strong>Create</strong> button.
								</li>
								<li>
									Click <strong>OK</strong> to dismiss the resulting dialog.
								</li>
								<li>
									Click the <span style="display:inline-block;width:14px;height:14px;"><svg viewBox="0 0 14 14"><g><rect x="1" y="11" width="12" height="2"></rect><polygon points="7 5 12 10 2 10 " transform="translate(7.000000, 7.500000) scale(1, -1) translate(-7.000000, -7.500000) "></polygon><rect x="5" y="1" width="4" height="4"></rect></g></svg></span> (Download JSON) button to the right of the client ID.
								</li>
								<li>
									Select the file through the <strong>"Import a JSON Key file"</strong> attribute.
								</li>
							</ol>
						</p>
					</div>
				</td>
			</tr>

			</table>
			<table class="widefat" style="border:1px solid #e1e1e1;">
				<tr>
					<td width="30%"><?php _e( 'Include music player in all products', 'woocommerce_music_player' ); ?></td>
					<td><div class="wcmp-tooltip"><span class="wcmp-tooltiptext"><?php _e('The player is shown only if the product is "downloadable" with at least an audio file between the "Downloadable files", or you have selected your own audio files', 'woocommerce_music_player'); ?></span><input type="checkbox" name="_wcmp_enable_player" <?php echo (( $enable_player ) ? 'checked' : '' ); ?> /></div></td>
				</tr>
				<tr>
					<td width="30%"><?php _e( 'Include in', 'woocommerce_music_player' ); ?></td>
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
					<td width="30%"><?php _e( 'Merge in grouped products', 'woocommerce_music_player' ); ?></td>
					<td><input type="checkbox" name="_wcmp_merge_in_grouped" <?php echo (( $merge_grouped ) ? 'checked' : '' ); ?> /><br /><em><?php _e( 'In grouped products, display the "Add to cart" buttons and quantity fields in the players rows', 'woocommerce_music_player' ); ?></em></td>
				</tr>
				<tr>
					<td valign="top" width="30%"><?php _e( 'Player layout', 'woocommerce_music_player' ); ?></td>
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
					<td width="30%">
						<?php _e( 'Preload', 'woocommerce_music_player' ); ?>
					</td>
					<td>
						<label><input type="radio" name="_wcmp_preload" value="none" <?php if($preload == 'none') echo 'CHECKED'; ?> /> None</label><br />
						<label><input type="radio" name="_wcmp_preload" value="metadata" <?php if($preload == 'metadata') echo 'CHECKED'; ?> /> Metadata</label><br />
						<label><input type="radio" name="_wcmp_preload" value="auto" <?php if($preload == 'auto') echo 'CHECKED'; ?> /> Auto</label><br />
					</td>
				</tr>
				<tr>
					<td width="30%">
						<?php _e( 'Play all', 'woocommerce_music_player' ); ?>
					</td>
					<td>
						<input type="checkbox" name="_wcmp_play_all" <?php if($play_all) echo 'CHECKED'; ?> />
					</td>
				</tr>
				<tr>
					<td width="30%"><?php _e( 'Player controls', 'woocommerce_music_player' ); ?></td>
					<td>
						<input type="radio" name="_wcmp_player_controls" value="button" <?php echo (( $player_controls == 'button' ) ? 'checked' : ''); ?> /> <?php _e( 'the play/pause button only', 'woocommerce_music_player' ); ?><br />
						<input type="radio" name="_wcmp_player_controls" value="all" <?php echo (( $player_controls == 'all' ) ? 'checked' : ''); ?> /> <?php _e( 'all controls', 'woocommerce_music_player' ); ?><br />
						<input type="radio" name="_wcmp_player_controls" value="default" <?php echo (( $player_controls == 'default' ) ? 'checked' : ''); ?> /> <?php _e( 'the play/pause button only, or all controls depending on context', 'woocommerce_music_player' ); ?><br />
					</td>
				</tr>
				<tr>
					<td width="30%"><?php _e( 'Display the player\'s title', 'woocommerce_music_player' ); ?></td>
					<td>
						<input type="checkbox" name="_wcmp_player_title" <?php echo (( !empty($player_title) ) ? 'checked' : ''); ?> />
					</td>
				</tr>
				<tr>
					<td colspan="2" style="color:red;"><?php _e( 'The security feature is only available in the PRO version of the plugin', 'woocommerce_music_player'); ?>. <a target="_blank" href="http://wordpress.dwbooster.com/content-tools/music-player-for-woocommerce"><?php _e('CLICK HERE TO GET THE PRO VERSION OF THE PLUGIN', 'woocommerce_music_player'); ?></a></td>
				</tr>
				<tr>
					<td style="color:#DDDDDD;" width="30%"><?php _e( 'Protect the file', 'woocommerce_music_player' ); ?></td>
					<td><input type="checkbox" DISABLED /></td>
				</tr>
				<tr valign="top">
					<td style="color:#DDDDDD;" width="30%"><?php _e('Percent of audio used for protected playbacks', 'woocommerce_music_player'); ?></td>
					<td style="color:#DDDDDD;">
						<input type="number" DISABLED /> % <br />
						<em><?php _e('To prevent unauthorized copying of audio files, the files will be partially accessible', 'woocommerce_music_player'); ?></em>
					</td>
				</tr>
				<tr valign="top">
					<td style="color:#DDDDDD;" width="30%">
						<?php _e('Text to display beside the player explaining that demos are partial versions of the original files', 'woocommerce_music_player'); ?>
					<td style="color:#DDDDDD;">
						<textarea style="width:100%;" rows="4" disabled></textarea>
					</td>
				</tr>

			</table>
		</td>
	</tr>
</table>
<table class="widefat" style="border:0;">
	<tr>
		<td>
			<table class="widefat" style="border:1px solid #e1e1e1;">
				<tr>
					<td>
						<div><?php _e('Scope', 'woocommerce_music_player'); ?></div>
						<div><div class="wcmp-tooltip"><span class="wcmp-tooltiptext"><?php _e('Ticking the checkbox the previous settings are applied to all products, even if they have a player enabled.', 'woocommerce_music_player');?></span><input type="checkbox" name="_wcmp_apply_to_all_players" /></div> <?php _e('Apply the previous settings to all products pages in the website.', 'woocommerce_music_player'); ?></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<div style="margin-top:20px;"><input type="submit" value="<?php _e('Save settings', 'woocommerce_music_player'); ?>" class="button-primary" /></div>
</form>