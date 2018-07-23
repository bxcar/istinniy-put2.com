<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package bible
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found" style="margin-top: 100px; margin-bottom: 100px;">
				<header class="page-header" style="border-bottom: none;">
					<img src="<?= get_template_directory_uri(); ?>/images/404.png">
                    <h1 style="margin-top: 30px;">Страница не найдена</h1>
				</header><!-- .page-header -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
