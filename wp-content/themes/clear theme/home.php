<?php /**   * Template file for home page   * Displays all HTML content   * Theme Name: SomeTheme   */ ?><?php get_header(); ?>
<div class="all_content">   <?php if (function_exists('bxslider')) bxslider('slider'); ?>   <?php comments_template('', true); // Комментарии ?>
    <!-- <div class="slider-wrap">              <div id="slider" class="slider-images">               <div>                 <li>                   <div class="slide"><img src="images/font.jpg" class="img-responsive img-height"></div>                 <div class="myt">                   <div class="patch-man">ИСТИННЫЙ ПУТЬ ЧЕЛОВЕКА</div><br>                   <div class="shop-title">Интернет портал авторских книг</div>                   <p>Все книги в интернет-магазине на период тестирования доступны только в режиме онлайн чтения!                     Наш интернет портал предлагает Вашему вниманию онлайн магазин электронных книг для духовного саморазвития человека – ресурс, включающий в себя статьи и электронные версии авторских книг по направлениям духовного развития человека и научно-публицистической литературы. Каталог портала постоянно пополняется новыми статьями и книгами авторов. На нашем интернет портале находится тематический “Форум” на котором Вы можете обсудит прочитанные книги или другую информацию по тематике сайта. Все книги нашего интерент-портала вы можете бесплатно прочитать на своем компьютере, планшете или смартфоне в режиме онлайн. Любую заинтересовавшую Вас книгу можно купить в электронном виде (в форматах .epub и .pdf) для последующего чтения на различных электронных устройствах. В ближайшее время для покупки с доставкой будут доступны книги в печатном виде. Печатные издания оформляются по отдельному запросу.</p>                  </div>                </li>              </div>              <div>               <li>  <div class="slide"><img src="images/font.jpg" class="img-responsive img-height"></div><div class="myt">                 <div class="patch-man">Истинный путь человека</div><br>                 <div class="shop-title">Интернет портал авторских книг</div>                 <p>Все книги в интернет-магазине на период тестирования доступны только в режиме онлайн чтения!                   Наш интернет портал предлагает Вашему вниманию онлайн магазин электронных книг для духовного саморазвития человека – ресурс, включающий в себя статьи и электронные версии авторских книг по направлениям духовного развития человека и научно-публицистической литературы. Каталог портала постоянно пополняется новыми статьями и книгами авторов. На нашем интернет портале находится тематический “Форум” на котором Вы можете обсудит прочитанные книги или другую информацию по тематике сайта. Все книги нашего интерент-портала вы можете бесплатно прочитать на своем компьютере, планшете или смартфоне в режиме онлайн. Любую заинтересовавшую Вас книгу можно купить в электронном виде (в форматах .epub и .pdf) для последующего чтения на различных электронных устройствах. В ближайшее время для покупки с доставкой будут доступны книги в печатном виде. Печатные издания оформляются по отдельному запросу.</p>                </div>              </li>            </div>            <div>              <li> <div class="slide"><img src="images/font.jpg" class="img-responsive img-height"></div><div class="myt">               <div class="patch-man">Истинный путь человека</div><br>               <div class="shop-title">Интернет портал авторских книг</div>               <p>Все книги в интернет-магазине на период тестирования доступны только в режиме онлайн чтения!                 Наш интернет портал предлагает Вашему вниманию онлайн магазин электронных книг для духовного саморазвития человека – ресурс, включающий в себя статьи и электронные версии авторских книг по направлениям духовного развития человека и научно-публицистической литературы. Каталог портала постоянно пополняется новыми статьями и книгами авторов. На нашем интернет портале находится тематический “Форум” на котором Вы можете обсудит прочитанные книги или другую информацию по тематике сайта. Все книги нашего интерент-портала вы можете бесплатно прочитать на своем компьютере, планшете или смартфоне в режиме онлайн. Любую заинтересовавшую Вас книгу можно купить в электронном виде (в форматах .epub и .pdf) для последующего чтения на различных электронных устройствах. В ближайшее время для покупки с доставкой будут доступны книги в печатном виде. Печатные издания оформляются по отдельному запросу.</p>              </div>            </li>          </div>        </div>      </div> --> <?php $post = get_post(53); ?>
    <style>
        .all_content .bx-wrapper:first-child {
            margin-bottom: 30px;
        }

        .brands-book .about-line.row {
            display: flex;
            align-items: center;
        }

        .brands-book ul.bxslider li {
            padding-top: 10px;
        }

        .brands-book .container > .bx-wrapper > .bx-controls-direction,
        .brands-book .container > .bx-wrapper > .bx-has-pager {
            display: none;
        }

        #brands-book.brands-book .container .bx-wrapper {
            height: 600px;
            margin-bottom: 0;
        }

        .brands-book .bx-wrapper .bx-controls-direction a {
            top: 43%;
        }

        .brands-book .price-near-button {
            font-size: 24px;
            margin-left: 20px;
        }

        .brands-book .bx-controls-direction .bx-prev {
            left: -6%;
        }

        .brands-book .bx-controls-direction .bx-next {
            right: -6%;
        }

        .brands-book .bx-wrapper .bx-pager.bx-default-pager a {
            border: 2px solid #288965;
        }

        .brands-book .bx-wrapper .bx-pager.bx-default-pager a:hover,
        .brands-book .bx-wrapper .bx-pager.bx-default-pager a.active {
            background: #288965;
        }

        .brands-book .contentsp {
            color: #288965;
            /*float: center;*/
            text-align: center;
            font-weight: 700;
            margin: 0 0 34px;
            display: block;
            text-transform: uppercase;
            font: 28px 'Roboto-Bold';
        }

        .brands-book .bx-wrapper > .bx-viewport > .bx-wrapper > .bx-viewport > .bx-wrapper > .bx-controls {
            display: none;
        }

        .bxslider-book li {
            padding-left: 10px;
        }

        .mediafiles-gallery .bx-pager.bx-default-pager {
            margin-top: 20px;
        }

        .mediafiles-gallery {
            margin-top: 50px;
        }
    </style>
    <section id="brands-book" class="popular brands-book">
        <div class="brendcobtent">
            <div class="container">
                <h2 class="contentsp">Новинки</h2>
                <div class="bx-wrapper" style="max-width: 100%;">
                    <div class="bx-viewport"
                         style="width: 100%; overflow: visible; position: relative; height: 600px;">
                        <ul class="bxslider bxslider-book" data-bxslider-mode="horizontal" data-bxslider-speed="500"
                            data-bxslider-slide-margin="0" data-bxslider-start-slide="0"
                            data-bxslider-random-start="false" data-bxslider-slide-selector=""
                            data-bxslider-infinite-loop="true" data-bxslider-hide-control-on-end="false"
                            data-bxslider-captions="true" data-bxslider-ticker="false"
                            data-bxslider-ticker-hover="false" data-bxslider-adaptive-height="false"
                            data-bxslider-adaptive-height-speed="500" data-bxslider-video="false"
                            data-bxslider-responsive="true" data-bxslider-use-css="true" data-bxslider-easing="null"
                            data-bxslider-preload-images="visible" data-bxslider-touch-enabled="true"
                            data-bxslider-swipe-threshold="50" data-bxslider-one-to-one-touch="true"
                            data-bxslider-prevent-default-swipe-x="true"
                            data-bxslider-prevent-default-swipe-y="false"
                            data-bxslider-pager="false" data-bxslider-pager-type="full"
                            data-bxslider-pager-short-separator=" / " data-bxslider-pager-selector=""
                            data-bxslider-controls="false" data-bxslider-next-text="Next"
                            data-bxslider-prev-text="Prev"
                            data-bxslider-next-selector="null" data-bxslider-prev-selector="null"
                            data-bxslider-auto-controls="false" data-bxslider-start-text="Start"
                            data-bxslider-stop-text="Stop" data-bxslider-auto-controls-combine="false"
                            data-bxslider-auto-controls-selector="null" data-bxslider-auto="true"
                            data-bxslider-pause="4000" data-bxslider-auto-start="true"
                            data-bxslider-auto-direction="next" data-bxslider-auto-hover="false"
                            data-bxslider-auto-delay="0" data-bxslider-min-slides="1" data-bxslider-max-slides="1"
                            data-bxslider-move-slides="0" data-bxslider-slide-width="0"
                            style="width: 715%; position: relative; transition-duration: 0s; transform: translate3d(-6745px, 0px, 0px);">
                            <li style="float: left; list-style: none; position: relative; width: 1349px;"
                                class="bx-clone">
                                <div class="slide">
                                    <?php echo do_shortcode("[xyz-ihs snippet='topkniga1']"); ?>
                                </div>
                            </li>
                            <li style="float: left; list-style: none; position: relative; width: 1349px;">
                                <div class="slide">
                                    <?php echo do_shortcode("[xyz-ihs snippet='topkniga2']"); ?>
                                </div>
                            </li>
                            <li style="float: left; list-style: none; position: relative; width: 1349px;">
                                <div class="slide">
                                    <?php echo do_shortcode("[xyz-ihs snippet='topkniga3']"); ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--<div class="bx-controls bx-has-pager bx-has-controls-direction">
                        <div class="bx-pager bx-default-pager">
                            <div class="bx-pager-item">
                                <a href="" data-slide-index="0" class="bx-pager-link">1</a>
                            </div>
                            <div class="bx-pager-item">
                                <a href="" data-slide-index="1" class="bx-pager-link">2</a>
                            </div>
                            <div class="bx-pager-item">
                                <a href="" data-slide-index="2" class="bx-pager-link">3</a>
                            </div>
                        </div>
                    </div>-->
                    <div class="bx-controls-direction">
                        <a class="bx-prev" href="">Prev</a>
                        <a class="bx-next" href="">Next</a>
                    </div>
                </div>
                <script>
                    var slider = jQuery('.bxslider-book').bxSlider({
                        auto: true,
//                            autoControls: true,
                        stopAutoOnClick: false,
//                            pager: true,
                        onSlideAfter: function () {
                            slider.stopAuto();
                            slider.startAuto();
                        }
//                            slideWidth: 600
                    });
                </script>
                <?php //if (function_exists('bxslider')) bxslider('books'); ?>
                <?php //echo do_shortcode("[xyz-ihs snippet='topkniga1']"); ?>
                <?php //echo do_shortcode("[xyz-ihs snippet='topkniga2']"); ?>
                <?php //echo do_shortcode("[xyz-ihs snippet='topkniga3']"); ?>
            </div>
        </div>
    </section><? /*<div class="block">        <div class="container">            <div class="contents products-area"><a href="http://demo.pinofran.com/demo/booksbog/news/" class="contentsp title">Новости</a></div>                 <div class="row">   <?php $price = query_posts('post_type=post&cat=27');  $count =1;  foreach ($price as $post):    the_post();?>            <div class="post col-lg-12">              <div class="post-header">                <h6><a href="http://demo.pinofran.com/demo/booksbog/news" class="post-title-news"><?= $post->post_title; ?></a></h6>              </div>              <div class="about col-lg-2 col-md-2">                <?php the_post_thumbnail('full',array('class' => 'img-responsive')); ?>              </div>              <div class="info col-lg-10 col-md-10">                <p class="font"><?php the_content(); ?></p>                                              <div class="post-footer to-left">                  <div class="button-love to-left top">                    <p class="love-text">Нравится ли вам это?<?php if(function_exists('wp_ulike')) wp_ulike('get'); ?><!-- <span class="love-icon"> 8 </span> --></p>                  </div>                  <div class="post-links to-right">                     <span class="comments">                   <!--   <i class="fa fa-comment-o" aria-hidden="true"></i><a href="http://demo.pinofran.com/demo/booksbog/lechenie/" class="hover-link number-comment">0</a>   -->                   </span>                   <span class="more"> <a href="http://demo.pinofran.com/demo/booksbog/lechenie/" class="link hover-link">Подробнее</a></span>                 </div>               </div>             </div>           </div>           <?php if ($count % 2 === 0 ) {    echo '<div class="clearfix visible-sm"></div>';  }  $count++;  ?>  <?php  endforeach;  wp_reset_query();?>         </div>       </div>       </div> */ ?><?php $post = get_post(58); ?>
    <section id="line" class="catalog">
        <div class="contents products-area"><span class="contentp"><p><img class="img-responsive" src="images/bask.png"
                                                                           alt=""></p></span> <span
                    class="contentsp title"><?php echo $post->post_title; ?></span>
            <!--<p><?php /*echo $post->post_content; */ ?></p>  -->
            <!--<span class="shop"><p>Книги магазина</p></span>-->
            <section class="center slider">
                <div class="container">  <?php echo do_shortcode("[wpcs id='256']"); ?>        </div>
                <!--  <div>           <div> <img src="images/covenant.png">           </div>           <span class="names"><strong>Новейший завет</strong></span>            <div class="price">300 руб  <button class="button-buy"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button></div></div>             <div>           <div> <img src="images/covenant.png">           </div>           <span class="names"><strong>Новейший завет</strong></span>            <div class="price">300 руб  <button class="button-buy"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button></div></div>             <div>           <div> <img src="images/covenant.png">           </div>           <span class="names"><strong>Новейший завет</strong></span>            <div class="price">300 руб  <button class="button-buy"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button></div></div>             <div>           <div> <img src="images/covenant.png">           </div>           <span class="names"><strong>Новейший завет</strong></span>            <div class="price">300 руб  <button class="button-buy"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button></div></div>             <div>           <div> <img src="images/covenant.png">           </div>           <span class="names"><strong>Новейший завет</strong></span>            <div class="price">300 руб  <button class="button-buy"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button></div></div>          <div>           <div> <img src="images/covenant.png">           </div>           <span class="names"><strong>Новейший завет</strong></span>            <div class="price">300 руб  <button class="button-buy"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button></div></div>           <div>             <div> <img src="images/covenant.png">             </div>             <span class="names"><strong>Новейший завет</strong></span>             <div class="price">300 руб  <button class="button-buy"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button></div></div>             <div>               <div> <img src="images/covenant.png">               </div>               <span class="names"><strong>Новейший завет</strong></span>                <div class="price">300 руб  <button class="button-buy"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button></div></div>               <div>                 <div> <img src="images/covenant.png">                 </div>                 <span class="names"><strong>Новейший завет</strong></span>                 <div class="price">300 руб  <button class="button-buy"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button></div></div> -->
            </section>
            <style>
                #line {
                    margin-top: 170px;
                }

                #line .wpcs_product_carousel_slider .product_image_container .product_thumb_link img {
                    max-height: 300px;
                    max-width: 300px;
                }

                #line .wpcs_product_carousel_slider .product_image_container #id-1175.product_thumb_link img,
                #line .wpcs_product_carousel_slider .product_image_container #id-772.product_thumb_link img {
                    max-height: 250px;
                    max-width: 250px;
                    margin-top: 25px;
                    margin-bottom: 25px;
                }

                #line .wpcs_product_carousel_slider .another_carousel_header i.fa-angle-left {
                    left: -75px;
                    top: 50%
                }

                #line .wpcs_product_carousel_slider .another_carousel_header i.fa-angle-right {
                    right: -75px;
                    top: 50%;
                }

                #line .wpcs_product_carousel_slider .another_carousel_header i.fa-angle-left,
                #line .wpcs_product_carousel_slider .another_carousel_header i.fa-angle-right {
                    background-color: #8c8c8b;
                    color: #cfcfcf;
                    border-radius: 50px;
                    font-size: 27px;
                    font-weight: bold;
                }

                #line .wpcs_product_carousel_slider .another_carousel_header .fa-angle-left:before {
                    margin-left: -3px;
                }

                #line .wpcs_product_carousel_slider .another_carousel_header .fa-angle-right:before {
                    margin-right: -3px;
                }
            </style>
        </div>
    </section> <?php $post = get_post(68); ?><? /*           <section id="brands" class="popular">            <div class="bookcontent">              <div class="container margin-bottom">               <div class="contents products-area">                 <span class="contentp"><p><img class="img-responsive" src="images/book.png" alt="bible"></p></span>                 <span class="contentsp title"></span>                 <p><?php echo $post ->post_content; ?></p>                 <span class="shop"><p>Книги магазина</p></span>                 <div class="content-images">                  <div class="row">   				<?php	$post = get_post(102);	?>                   <div class="col-md-6 col-sm-6 centered">                    <div class="product-box">                      <a href="/product/free_account1/"><?php the_post_thumbnail('full',array('class' => 'img-responsive')); ?></a>                     <div class="items">                      <span class="name-book"><strong><?=$post->post_title; ?></strong></span>                     <div class="price"><?php echo $post ->post_content; ?><a href="/product/free_account1/" class="button-buy"> <i class="fa fa-shopping-basket" aria-hidden="true"></i></a>                     </div>                     </div>                    </div>                  </div>                  <?php	$post = get_post(97);	?>                  <div class="col-md-6 col-sm-6 centered">                    <div class="product-box">                      <a href="/product/free-account2/"><?php the_post_thumbnail('full',array('class' => 'img-responsive')); ?></a>                     <div class="items">                      <span class="name-book"><strong><?=$post->post_title; ?></strong></span>                     <div class="price"><?php echo $post ->post_content; ?><a href="/product/free-account2/" class="button-buy"> <i class="fa fa-shopping-basket" aria-hidden="true"></i></a>                     </div>                     </div>                    </div>                  </div>                                  <!--  <div class="col-md-3">                    <div class="product-box">                      <img class="img-responsive" src="images/litle-book.png" alt="">                       <div class="items">                       <span class="name-book"><strong>Новейший завет</strong></span>                     <div class="price">Бесплатно! <button class="button-buy"> <i class="fa fa-shopping-basket" aria-hidden="true"></i></button>                    </div>                                      </div>                 </div>              </div> -->            </div>          </div>        </div>      </section>*/ ?>
    <!--                    <a class="reference-recipe" href="http://demo.pinofran.com/demo/booksbog/lechenie/">            <div class="box">             <section class="headline col-sm-12">              <div class="container box-container">                <span>Рецепты лечения народными средствами</span>              </div>             </section>            </div>          </a> -->


    <section id="mediafiles-gallery" class="popular brands-book mediafiles-gallery">
        <div class="brendcobtent">
            <div class="container">
                <h2 class="contentsp">Медиафайлы</h2>
                <div class="bx-wrapper" style="max-width: 100%;">
                    <div class="bx-viewport"
                         style="width: 100%; overflow: visible; position: relative; height: auto;">
                        <ul class="bxslider bxslider-book bxslider-mediafiles" data-bxslider-mode="horizontal"
                            data-bxslider-speed="500"
                            data-bxslider-slide-margin="0" data-bxslider-start-slide="0"
                            data-bxslider-random-start="false" data-bxslider-slide-selector=""
                            data-bxslider-infinite-loop="true" data-bxslider-hide-control-on-end="false"
                            data-bxslider-captions="true" data-bxslider-ticker="false"
                            data-bxslider-ticker-hover="false" data-bxslider-adaptive-height="false"
                            data-bxslider-adaptive-height-speed="500" data-bxslider-video="false"
                            data-bxslider-responsive="true" data-bxslider-use-css="true" data-bxslider-easing="null"
                            data-bxslider-preload-images="visible" data-bxslider-touch-enabled="true"
                            data-bxslider-swipe-threshold="50" data-bxslider-one-to-one-touch="true"
                            data-bxslider-prevent-default-swipe-x="true"
                            data-bxslider-prevent-default-swipe-y="false"
                            data-bxslider-pager="false" data-bxslider-pager-type="full"
                            data-bxslider-pager-short-separator=" / " data-bxslider-pager-selector=""
                            data-bxslider-controls="false" data-bxslider-next-text="Next"
                            data-bxslider-prev-text="Prev"
                            data-bxslider-next-selector="null" data-bxslider-prev-selector="null"
                            data-bxslider-auto-controls="false" data-bxslider-start-text="Start"
                            data-bxslider-stop-text="Stop" data-bxslider-auto-controls-combine="false"
                            data-bxslider-auto-controls-selector="null" data-bxslider-auto="true"
                            data-bxslider-pause="4000" data-bxslider-auto-start="true"
                            data-bxslider-auto-direction="next" data-bxslider-auto-hover="false"
                            data-bxslider-auto-delay="0" data-bxslider-min-slides="3" data-bxslider-max-slides="100"
                            data-bxslider-move-slides="0" data-bxslider-slide-width="0"
                            style="display: flex; align-items: center; width: 715%; position: relative; transition-duration: 0s; transform: translate3d(-6745px, 0px, 0px);">
                            <?php
                            if (get_field('gallery', 1475)) {
                            foreach (get_field('gallery', 1475) as $item) { ?>
                                <li style="float: left; list-style: none; position: relative;">
                                    <div class="slide">
                                        <a target="_blank" href="<?= $item['link'];?>">
                                            <img src="<?= $item['image'];?>"
                                                 class="img-responsive wp-post-image" alt="">
                                        </a>
                                    </div>
                                </li>
                            <?php }
                            } ?>
                        </ul>
                    </div>
                    <div class="bx-controls-direction">
                        <a class="bx-prev" href="">Prev</a>
                        <a class="bx-next" href="">Next</a>
                    </div>
                </div>
                <script>
                    var slider2 = jQuery('.bxslider-mediafiles').bxSlider({
                        auto: true,
                        minSlides: 3,
                        maxSlides: 3,
                        moveSlides: 1,
                        slideWidth: 400,
                        stopAutoOnClick: false,
                        onSlideAfter: function () {
                            slider2.stopAuto();
                            slider2.startAuto();
                        }
                    });
                </script>
            </div>
        </div>
    </section>


    <div class="container">
        <div class="thin"></div>
        <div class="row">
            <div class="user col-lg-1 col-md-1"></div>
            <div class="usercomment col-lg-9 col-md-9"></div>
            <!--  <div class="col-lg-2 col-md-2"><button class="button button-hover text-color" type="submit">Ответить</button></div> -->
        </div>
    </div>
    <div class="wrap-form">
        <div class="container">
            <div class="row">
                <div class="form-header"><h6>Подписка на новости и бесплатные книги!</h6></div>
                <p class="paragraph margin-left">Ваш e-mail не будет опубликован. Обязательные поля помечены*</p>
                <!-- <form action="#" method="get" class="form">                      <p class="pr margin-left">Комментарий</p> --> <?php echo do_shortcode('[contact-form-7 id="400" title="Contact form 1"]'); ?>
                <!-- <div class="row row-respons">              <textarea name="comments" class="comm col-md-12 col-xs-12"></textarea>            </div>            <div class="row">              <div class="username col-md-4 col-xs-4 margin-top">                <p class="pr left">Имя*</p>                <p><input type="text" class="margin-top input-text" required></p>              </div>              <div class="e-mail col-md-4 col-xs-4 margin-top">                <p class="pr left">E-mail*</p>                <p><input type="text" class=" margin-top input-text" required></p>              </div>              <div class="web col-md-4 col-xs-4 margin-top">                <p class="pr left">Сайт</p>                <p><input type="text" class="margin-top input-text"></p>              </div>            </div>            <div class="row">              <div class="col-md-12 col-xs-12 margin-top"> -->
                <!-- <input type="submit1" value="Отправить комментарий" class="to-right submit button-hover sm-center"> -->
                <!--   </div>            </div>          </form> -->        </div>
        </div>
    </div>
</div>                    <a class="reference" href="http://istinniy-put.com/community/">
    <div class="forum-conteiner">
        <div class="container">
            <section class="headline-forum col-sm-12"><span> ФОРУМ </span>
                <div class="row">
                    <div class="col-sm-12 pg-forum"><p>Общайтесь, делитесь своим мнением и знакомтесь на нашем
                            форуме</p></div>
                </div>
        </div>
    </div>
    </section>        </a>      <!--Пожертвование-->
<div class="container" id="pojertvovanie">
    <div class="row">
        <div class="col-md-6 col-sm-6 hidden-xs pull-left">             <?php echo do_shortcode("[xyz-ihs snippet='Pojertvovanie']"); ?>                </div>
        <div class=" col-md-6 col-sm-6 hidden-xs pull-left">
            <iframe src="https://money.yandex.ru/quickpay/shop-widget?writer=seller&targets=%D0%9F%D0%BE%D0%BC%D0%BE%D1%89%D1%8C%20%D0%BF%D1%80%D0%BE%D0%B5%D0%BA%D1%82%D1%83&targets-hint=&default-sum=500&button-text=14&payment-type-choice=on&hint=&successURL=&quickpay=shop&account=410016004427188"
                    width="450" height="213" frameborder="0" allowtransparency="true" scrolling="no"></iframe>
        </div>
    </div>
</div>      <!--Пожертвование-->                                              </div>   <?php get_footer(); ?>