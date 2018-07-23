<?php
/**
 * The template for displaying the footer
 * Theme Name: SomeTheme
 */
?>
<?php $post = get_post(90); ?>
<style>
    #wpforo-wrap #wpf-post-create .wpf-post-guest-email {
        display: none;
    }

    #tab-description table td a {
        text-decoration: underline;
    }

    .woocommerce-product-details__short-description hr:nth-child(3),
    /*.woocommerce-product-details__short-description .su-button.su-button-style-glass.calameo_a,*/
    #tab-description h2:first-child {
        display: none !important;
    }

    .modal-common-gl .modal-content-gl::-webkit-scrollbar {
        width: 10px;
    }

    .modal-common-gl .modal-content-gl::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
        border-radius: 10px;
    }

    .modal-common-gl .modal-content-gl::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.7);
    }

    .modal-common-gl {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        opacity: 0;
        visibility: hidden;
        transform: scale(1.1);
        transition: visibility 0s linear .25s, opacity .25s 0s, transform .25s;
        z-index: 2
    }

    .modal-common-gl .modal-content-gl {
        width: 90%;
        height: auto;
        max-width: 1000px;
        max-height: 80%;
    }

    .modal-common-gl .modal-content-gl-scroll {
        overflow-y: auto;
        overflow-x: hidden;
        position: relative;
    }

    .modal-common-gl .modal-content-gl-button {
        z-index: -1;
    }

    .modal-common-gl .modal-content-gl-button .content-wrap {
        visibility: hidden;
    }

    .modal-common-gl .modal-content-gl .content,
    .modal-common-gl .modal-content-gl .content p {
        font-size: 18px;
        margin-top: 10px;
        line-height: 1.3em;
        color: black;
    }

    .modal-common-gl .modal-content-gl {
        display: none;
    }

    .modal-common-gl .modal-content-gl .close-button {
        position: absolute;
        right: -40px;
        top: 0
    }

    .modal-common-gl .modal-content-gl {
        position: absolute;
        top: 40%;
        margin-top: 5%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 1rem 1.5rem;
        border-radius: .5rem
    }

    .modal-common-gl .modal-content-gl p {
        font-family: Open Sans, sans-serif;
        font-size: 14px
    }

    .modal-common-gl .modal-content-gl .title, .modal-common-gl .modal-content-gl h2 {
        font-weight: 400;
        display: block;
        font-family: Bebas Neue Regular, sans-serif;
        text-align: center;
        font-size: 30px;
        color: #171717;
        margin-bottom: 20px;
    }

    .modal-common-gl .close-button {
        float: right;
        width: 1.5rem;
        line-height: 1.5rem;
        text-align: center;
        cursor: pointer;
        border-radius: .25rem;
        background-color: #d3d3d3
    }

    .modal-common-gl .close-button:hover {
        background-color: #a9a9a9
    }

    .modal-common-gl.show-modal {
        opacity: 1;
        visibility: visible;
        transform: scale(1);
        transition: visibility 0s linear 0s, opacity .25s 0s, transform .25s
    }
</style>
<footer class="footer">
    <div class="container">
        <div class="row margin-top mg-last-cl">
            <div class="logo-footer col-sm-2 col-xs-12">

                <h3 class="foter-logo-ctr"><?php echo the_post_thumbnail('full', array('class' => 'img-responsive')); ?></h3>
                <div class="tell">
                    <ul class="contacs-numberr">
                        <li class="contacs-number-tel"><span><a href="tel:+79854455778">+7(985)445-57-78</a></span></li>

                        <li class="contacs-number-tel"><span><a href="tel:+79858188439">+7(985)818-84-39</a></span></li>
                        <li class="contacs-number-mail"><span><a href="mailto:zakaz@iztinniy-put.com">zakaz@istinniy-put.com</a></span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="about-us col-sm-3 col-xs-12">
                <?php $post = get_post(70); ?>
                <h6 class="footer-headline"><?php echo $post->post_title; ?></h6>
                <p class="pr-footer"><?php echo $post->post_content; ?></p>
            </div>
            <div class="col-sm-2 col-xs-12 min-px">

                <h6 class="footer-headline">Меню</h6>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container' => 'ul',
                    'menu_class' => 'pr-margin-top line'
                ));
                ?>
            </div>
            <div class="info-footer col-sm-2 col-xs-12 min-px">
                <h6 class="footer-headline">Информация</h6>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer1',
                    'container' => 'ul',
                    'menu_class' => 'pr-margin-top line'
                ));
                ?>
            </div>
            <div class="subscribe col-sm-2 col-xs-12 min-px">
                <h6 class="footer-headline ctr">Подпишись</h6>
                <ul class="pr-margin-top inline">
                    <li class="logo-line"><a href="https://vk.com" target="_blank"><img src="images/logo-vk.png" alt=""></a>
                    </li>
                    <li class="logo-line"><a href="https://www.instagram.com" target="_blank"><img src="images/ok.png"
                                                                                                   alt=""/></a></li>
                    <li class="logo-line"><a href="https://www.facebook.com" target="_blank"><img
                                    src="images/logo-fb.png" alt=""/></a></li>
                    <li class="logo-line"><a href="https://www.instagram.com" target="_blank"><img
                                    src="images/smile.png" alt=""/></a></li>
                    <li class="logo-line"><a href="https://www.instagram.com" target="_blank"><img
                                    src="images/logo-insta.png" alt=""/></a></li>
                </ul>
            </div>
        </div>
        <div class="footer-text col-md-12">
            <?php echo do_shortcode("[xyz-ihs snippet='footer-text']"); ?>
        </div>
    </div>
    <div class="footer-block">
        <div class="row copyright"><p class="footer-pr">&copy; <? echo date('Y'); ?> Истинный путь человека. Все права
                защищены.</p></div>
        <div class="statistic">
            <!-- Yandex.Metrika informer -->
            <a href="https://metrika.yandex.ru/stat/?id=47441545&amp;from=informer"
               target="_blank" rel="nofollow"><img
                        src="https://informer.yandex.ru/informer/47441545/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
                        style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика"
                        title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)"
                        class="ym-advanced-informer" data-cid="47441545" data-lang="ru"/></a>
            <!-- /Yandex.Metrika informer -->

            <!-- Yandex.Metrika counter -->
            <script type="text/javascript">
                (function (d, w, c) {
                    (w[c] = w[c] || []).push(function () {
                        try {
                            w.yaCounter47441545 = new Ya.Metrika2({
                                id: 47441545,
                                clickmap: true,
                                trackLinks: true,
                                accurateTrackBounce: true,
                                webvisor: true,
                                trackHash: true,
                                ecommerce: "dataLayer"
                            });
                        } catch (e) {
                        }
                    });

                    var n = d.getElementsByTagName("script")[0],
                        s = d.createElement("script"),
                        f = function () {
                            n.parentNode.insertBefore(s, n);
                        };
                    s.type = "text/javascript";
                    s.async = true;
                    s.src = "https://mc.yandex.ru/metrika/tag.js";

                    if (w.opera == "[object Opera]") {
                        d.addEventListener("DOMContentLoaded", f, false);
                    } else {
                        f();
                    }
                })(document, window, "yandex_metrika_callbacks2");
            </script>
            <noscript>
                <div><img src="https://mc.yandex.ru/watch/47441545" style="position:absolute; left:-9999px;" alt=""/>
                </div>
            </noscript>
            <!-- /Yandex.Metrika counter -->


        </div>
    </div>
</footer>
<?php wp_footer(); ?>
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
    (function () {
        var widget_id = '3e8NgtWpaA';
        var d = document;
        var w = window;

        function l() {
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = '//code.jivosite.com/script/widget/' + widget_id;
            var ss = document.getElementsByTagName('script')[0];
            ss.parentNode.insertBefore(s, ss);
        }

        if (d.readyState == 'complete') {
            l();
        } else {
            if (w.attachEvent) {
                w.attachEvent('onload', l);
            } else {
                w.addEventListener('load', l, false);
            }
        }
    })();</script>
<!-- {/literal} END JIVOSITE CODE -->
<script src="/wp-content/themes/clear theme/js/fancybox/jquery.fancybox.min.js"></script>
<link href='/wp-content/themes/clear theme/js/fancybox/jquery.fancybox.min.css' rel='stylesheet' type='text/css'>
<script>
    jQuery('#wpf_formbutton').attr('value', 'Добавить ответ');
    jQuery('#wpf_user_email').attr('value', 'default@default.com');
    jQuery('#wpforo-wrap #wpf-post-create .wpf-post-guest-name label').text('Имя');
    jQuery('#wpf_user_name').attr('placeholder', 'Ваше имя');

    jQuery(document).ready(function () {
        jQuery("#tab-description table td a").click(function (event) {
            event.preventDefault();
            var number = jQuery(this).attr('href').replace('#', '');
            console.log(number);
            jQuery(".modal-common-gl").toggleClass("show-modal");
            jQuery(".modal-content-gl." + number).css("display", "block");
            jQuery("body,html").css("overflow", "hidden");
        });

        jQuery(".close-button").click(function (event) {
            event.preventDefault();
            jQuery(".modal-content-gl").css("display", "none");
            jQuery(".modal-common-gl").toggleClass("show-modal");
            jQuery("body,html").css("overflow", "auto");
        });

        jQuery('#wpf_user_name').attr('value', '');
        jQuery('#wpf_title').attr('value', '');
    });
</script>
<style>
    /*download page*/

    .container-download {
        display: flex;
        width: 100%;
        box-sizing: border-box;
        /*flex-wrap: wrap;*/
        flex-flow: row wrap;
        justify-content: space-between;
        padding-left: 50px;
        padding-right: 50px;
    }

    /*.container-download:after {
        content: "";
        flex: auto;
    }*/

    .container-download .row {
        margin-left: 0;
        margin-right: 0;
    }

    .row-photo {
        /*width: 430px;*/
        width: 440px;
    }

    .row-photo a {
        display: inline-block;
        margin-left: 10px;
        margin-right: 10px;
    }

    .row-photo .product-box span {
        font-size: 14px;
        text-transform: none;
        font-family: inherit;
        display: block;
        margin-top: 5px;
    }

    .row-photo .product-box img {
        width: 120px;
    }

    ul.products-menu-download li a:hover {
        /*border-bottom: none;*/
    }

    .audio-download-desc {
        /*max-width: 392px;*/
        padding-top: 10px;
        padding-bottom: 30px;
        position: relative;
    }

    .audio-download-desc-name {
        max-width: 285px;
        display: inline-block;
        font-size: 17px;
        color: black;
    }

    .audio-download-desc-link {
        background: #469549;
        /*background: #3d96d2;*/
        /*background: #288965;*/
        color: #fff;
        position: absolute;
        padding: 4px 7px;
        border-radius: 7px;
        right: 0;
        display: block;
        margin-top: -20px;
    }

    .audio-download-desc-link:hover {
        color: #fff;
    }

    .row-audio .audiojs {
        position: relative;
        z-index: 100;
    }

    .row-winrar {

    }

    .container-download .row-winrar-1 {
        margin-right: 20px;
    }

    .winrar-dwn-link {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        height: 70px;
    }

    .winrar-dwn-link img {
        width: 70px;
        margin-right: 10px;
    }

    .winrar-dwn-link span {
        font-size: 16px;
        color: black;
    }

    .dwn-title {
        font-family: 'Roboto-Bold',sans-serif;
        text-decoration: none;
        color: black;
        font-size: 20px !important;
    }

    .bx-loading {
        display: none;
    }

    .audio-preview {
        display: flex;
        align-items: center;
    }

    .view-audio {
        display: block;
        margin-top: 10px;
        margin-bottom: 15px;
    }

    .view-audio img {
        margin-left: 5px;
    }

    .view-audio:hover {
        color: #272727 !important;
    }

    .audio-preview img {
        width: 120px;
        margin-right: 20px;
    }

    .audios-list {
        display: none;
    }

    .audio-preview:hover {
        cursor: pointer;
    }

    .audio-pay-link {
        color: #288965;
        text-decoration: underline;
    }

    @media (max-width: 500px) {
        .row-audio .audiojs {
            width: 300px;
        }

        .audio-download-desc {
            /*max-width: 300px;*/
        }

        .row-photo .product-box img {
            width: 100%;
            margin-bottom: 30px;
        }

        .row-photo .product-box span {
            font-size: 18px;
        }

        .container-download .row {
            margin-left: auto;
            margin-right: auto;
        }

        .audio-download-desc-name {
            max-width: 210px;
        }

        .container-download .row-winrar-1 {
            margin-right: auto;
        }

        .container-download {
            padding-left: 20px;
            padding-right: 20px;
        }
    }
</style> 
<!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
<!-- <script src="http://verstka.hardweb.pro/html/almus/js/jquery-3.3.1.min.js"></script> -->
<script src="<?php bloginfo('template_url') ?>/js/script.js"></script>
<script src="<?php bloginfo('template_url') ?>/js/swiper.min.js"></script>
<script src="<?php bloginfo('template_url') ?>/js/rating.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>

<script>
$( ".boks-cat" ).each(function() {
    $(this).click(function(){
        $( "#pa_optsii_v_tverdyiy-pereplet204" ).trigger( "click" );
    });
});

// $(function(){                   // Start when document ready
//     $('#star-rating').rating(); // Call the rating plugin
// }); 

// $(function(){
//     $('#star-rating').rating(function(vote, event){
//         // we have vote and event variables now, lets send vote to server.
//         $.ajax({
//             url: "woocommerce/single-product/rating.php",
//             type: "GET",
//             data: {rate: vote},
//         });
//     });
// });
//  $('.container1').rating(function(vote, event){
//     // console.log(vote, event);
// })
// $('.container1').rating(function(vote, event){
//     // write your ajax code here
//     // For example;
//     // $.get(document.URL, {vote: vote});
// });

if ($(window).width() > 960) {
   $(document).ready(function () {

        $(function () {
var swiper = new Swiper('.products .swiper-container', {
      slidesPerView: 6,
      spaceBetween: 30,
      slidesPerGroup: 1,
      // loop: true,
      // loopFillGroupWithBlank: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
 })

    });
} 
if ($(window).width() < 960) {
   $(document).ready(function () {

        $(function () {
var swiper = new Swiper('.products .swiper-container', {
      slidesPerView: 3,
      spaceBetween: 30,
      slidesPerGroup: 1,
      // loop: true,
      // loopFillGroupWithBlank: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
 })

    });
} 
if ($(window).width() < 500) {
   $(document).ready(function () {

        $(function () {
var swiper = new Swiper('.products .swiper-container', {
      slidesPerView: 1,
      spaceBetween: 30,
      slidesPerGroup: 1,
      // loop: true,
      // loopFillGroupWithBlank: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
 })

    });
}

  </script>
<script>
    $('#wpf_title').remove();
</script>
</body>
</html>