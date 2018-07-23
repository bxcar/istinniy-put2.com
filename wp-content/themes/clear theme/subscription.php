<?php
/**
 * Template Name: subscription
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?= get_the_title('1461'); ?></h1>
                    <h2 class="entry-title entry-subtitle">После нажатия кнопки "Отправить" обязательно укажите электронную почту, которую вы использовали на сайте для
                        регистрации</h2>
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

                .yndx {
                    margin-bottom: 100px;
                }
            </style>
            <iframe class="yndx"
                    src="https://money.yandex.ru/quickpay/shop-widget?writer=seller&targets=%D0%9F%D1%80%D0%B8%D0%BE%D0%B1%D1%80%D0%B5%D1%82%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%D0%B4%D0%BF%D0%B8%D1%81%D0%BA%D0%B8&targets-hint=&default-sum=<?= get_field('subs_pay_sum', '1461'); ?>&button-text=12&payment-type-choice=on&mail=on&hint=%D0%A3%D0%BA%D0%B0%D0%B6%D0%B8%D1%82%D0%B5%20%D1%81%D0%B2%D0%BE%D0%B9%20email%2C%20%D0%BA%D0%BE%D1%82%D0%BE%D1%80%D1%8B%D0%B9%20%D0%B2%D1%8B%20%D0%B8%D1%81%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D0%BB%D0%B8%20%D0%BF%D1%80%D0%B8%20%D1%80%D0%B5%D0%B3%D0%B8%D1%81%D1%82%D1%80%D0%B0%D1%86%D0%B8%D0%B8%20%D0%BD%D0%B0%20%D1%81%D0%B0%D0%B9%D1%82%D0%B5&successURL=https%3A%2F%2Fistinniy-put.com%2Fpurchased%2F&quickpay=shop&account=<?= get_field('subs_pay_wallet', '1461'); ?>"
                    width="450" height="213" frameborder="0" allowtransparency="true" scrolling="no"></iframe>
            <!--<iframe class="yndx" src="https://money.yandex.ru/quickpay/shop-widget?writer=seller&targets=%D0%9F%D0%BE%D0%BC%D0%BE%D1%89%D1%8C%20%D0%BF%D1%80%D0%BE%D0%B5%D0%BA%D1%82%D1%83&targets-hint=&default-sum=<?/*= get_field('subs_pay_sum', '1461'); */ ?>&button-text=14&payment-type-choice=on&hint=&successURL=&quickpay=shop&account=<?/*= get_field('subs_pay_wallet', '1461'); */ ?>"
                    width="450" height="213" frameborder="0" allowtransparency="true" scrolling="no"></iframe>-->
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
