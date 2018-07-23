<?php
/**
 * Template Name: subscription-done
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title">Благодарим вас за приобретение подписки!</h1>
                    <h2 class="entry-title entry-subtitle">В скором времени наш менеджер подтвердит оплату и вы получите доступ к премиум-контенту</h2>
                </header>
            </article>
            <style>
                #comments,
                #secondary {
                    display: none;
                }

                .entry-header {
                    margin-top: 100px;
                    margin-bottom: 10px;
                }

                .entry-header .entry-title.entry-subtitle {
                    font-size: 18px;
                    margin-left: 400px;
                    margin-top: 20px;
                    margin-right: 400px;
                }
            </style>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
