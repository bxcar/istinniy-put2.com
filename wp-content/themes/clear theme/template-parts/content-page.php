<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bible
 */

?>
<script type="text/javascript" src="<?= get_template_directory_uri(); ?>/js/new-player/soundmanager2.js"></script>
<script src="<?= get_template_directory_uri(); ?>/js/new-player/bar-ui.js"></script>
<link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/css/new-player/bar-ui.css" />

<!-- demo for this page only, you don't need this stuff -->
<script src="<?= get_template_directory_uri(); ?>/js/new-player/demo.js"></script>
<!--<link rel="stylesheet" href="--><?//= get_template_directory_uri(); ?><!--/css/new-player/demo.css" />-->

<article id="post-<?php the_ID(); ?>" >
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

    <?php if(get_field('audio_link')) { ?>
        <div class="audio">
            <!--<script>
                var a = audiojs;
                a.events.ready(function () {
                    var a1 = a.createAll();
                });
            </script>
            <audio src="<?/*= get_field('audio_link'); */?>"
                   preload="auto"></audio>-->
            <div class="sm2-bar-ui">
                <!--                        compact full-width-->

                <div class="bd sm2-main-controls">

                    <div class="sm2-inline-texture"></div>
                    <div class="sm2-inline-gradient"></div>

                    <div class="sm2-inline-element sm2-button-element">
                        <div class="sm2-button-bd">
                            <a href="#play" class="sm2-inline-button sm2-icon-play-pause">Play / pause</a>
                        </div>
                    </div>

                    <div class="sm2-inline-element sm2-inline-status">

                        <div class="sm2-playlist" style="display: none;">
                            <div class="sm2-playlist-target">
                                <!-- playlist <ul> + <li> markup will be injected here -->
                                <!-- if you want default / non-JS content, you can put that here. -->
                                <noscript><p>JavaScript is required.</p></noscript>
                            </div>
                        </div>

                        <div class="sm2-progress">
                            <div class="sm2-row">
                                <div class="sm2-inline-time">0:00</div>
                                <div class="sm2-progress-bd">
                                    <div class="sm2-progress-track">
                                        <div class="sm2-progress-bar"></div>
                                        <div class="sm2-progress-ball"><div class="icon-overlay"></div></div>
                                    </div>
                                </div>
                                <div class="sm2-inline-duration">0:00</div>
                            </div>
                        </div>

                    </div>

                    <div class="sm2-inline-element sm2-button-element sm2-volume">
                        <div class="sm2-button-bd">
                            <span class="sm2-inline-button sm2-volume-control volume-shade"></span>
                            <a href="#volume" class="sm2-inline-button sm2-volume-control">volume</a>
                        </div>
                    </div>

                </div>

                <div class="bd sm2-playlist-drawer sm2-element">

                    <div class="sm2-inline-texture">
                        <div class="sm2-box-shadow"></div>
                    </div>

                    <!-- playlist content is mirrored here -->

                    <div class="sm2-playlist-wrapper">
                        <ul class="sm2-playlist-bd">
                            <li><a href="<?= get_field('audio_link'); ?>"></a></li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
        <style>
            .audio {
                margin-bottom: 20px;
            }

            .audio .audiojs {
                float: none !important;
            }
        </style>
    <?php } ?>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bible' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'bible' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
