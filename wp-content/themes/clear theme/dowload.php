<?php
/*
Template Name: Скачать
Template Post Type: post, page
*/
?>
<?php
get_header();

?>
    <script type="text/javascript" src="<?= get_template_directory_uri(); ?>/js/new-player/soundmanager2.js"></script>
    <script src="<?= get_template_directory_uri(); ?>/js/new-player/bar-ui.js"></script>
    <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/css/new-player/bar-ui.css"/>

    <span class="contentsp title"> </span>
    <ul class="products-menu products-menu-download">
        <li><a href="#" data-block="audio-block">Аудио</a></li>
        <li><a href="#" data-block="bookdwn-block">Скачать книгу</a></li>
        <li><a href="#" data-block="photo-block">Фото</a></li>
        <li><a href="#" data-block="video-block">Видео</a></li>
    </ul>
    <div class="container-download">
        <div class="row row-audio" id="audio-block">
<!--            <h2 class="dwn-title">Аудио</h2>-->
            <!--<script>
                var a = audiojs;
                a.events.ready(function () {
                    var a1 = a.createAll();
                });
            </script>-->
            <?php
            if (get_field('audio_download', 277)) {
                foreach (get_field('audio_download', 277) as $item) { ?>
                    <!--<audio src="<?/*= $item['link']; */ ?>"
                           preload="auto"></audio>-->
                    <div class="audio-preview">
                        <img src="<?= $item['book_thumb']; ?>">
                        <span class="audio-book-title"><?= $item['book_title']; ?></span>
                    </div>
                    <a href="#" class="view-audio">Список аудио<img src="<?= get_template_directory_uri(); ?>/images/right-arrow.png"></a>
                    <div class="audios-list">
                        <?php
                        if ($item['audio_for_book']) {
                            foreach ($item['audio_for_book'] as $item_2) {
                                if($item_2['pay'] == 'no') { ?>
                                    <div class="sm2-bar-ui">
                                        <!--                        compact full-width-->

                                        <div class="bd sm2-main-controls">

                                            <div class="sm2-inline-texture"></div>
                                            <div class="sm2-inline-gradient"></div>

                                            <div class="sm2-inline-element sm2-button-element">
                                                <div class="sm2-button-bd">
                                                    <a href="#play" class="sm2-inline-button sm2-icon-play-pause">Play /
                                                        pause</a>
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
                                                                <div class="sm2-progress-ball">
                                                                    <div class="icon-overlay"></div>
                                                                </div>
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
                                                    <li><a href="<?= $item_2['link']; ?>"><?= $item_2['text']; ?></a></li>
                                                </ul>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="audio-download-desc">
                                        <span class="audio-download-desc-name"><?= $item_2['text']; ?></span>
                                        <a class="audio-download-desc-link" href="<?= $item_2['link']; ?>" download>Скачать</a>
                                    </div>
                                <?php } else { ?>
                                    <div class="sm2-bar-ui">
                                        <!--                        compact full-width-->

                                        <div class="bd sm2-main-controls">

                                            <div class="sm2-inline-texture"></div>
                                            <div class="sm2-inline-gradient"></div>

                                            <div class="sm2-inline-element sm2-button-element">
                                                <div class="sm2-button-bd">
                                                    <a target="_blank" href="/subscription-pay" class="sm2-inline-button sm2-icon-play-pause">Play /
                                                        pause</a>
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
                                                                <div class="sm2-progress-ball">
                                                                    <div class="icon-overlay"></div>
                                                                </div>
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
                                                    <li><a href="#"><?= $item_2['text']; ?></a></li>
                                                </ul>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="audio-download-desc">
                                        <span class="audio-download-desc-name"><?= $item_2['text']; ?> - <span>Для загрузки данной аудиозаписи необходимо <a target="_blank" class="audio-pay-link" href="/subscription-pay">приобрести подписку</a></span></span>
                                        <a class="audio-download-desc-link" target="_blank" href="/subscription-pay">Скачать</a>
                                    </div>
                                <?php } ?>

                            <?php }
                        } ?>
                    </div>
                <?php }
            } ?>
            <div class="sm2-bar-ui" style="visibility: hidden; height: 0;">
                <div class="bd sm2-main-controls">
                    <div class="sm2-inline-element sm2-button-element">
                        <div class="sm2-button-bd">
                            <a href="#play-1" class="sm2-inline-button sm2-icon-play-pause">Play /
                                pause</a>
                        </div>
                    </div>
                    <div class="sm2-inline-element sm2-inline-status">
                        <div class="sm2-progress">
                            <div class="sm2-row">
                                <div class="sm2-inline-time">0:00</div>
                                <div class="sm2-progress-bd">
                                    <div class="sm2-progress-track">
                                        <div class="sm2-progress-bar"></div>
                                        <div class="sm2-progress-ball">
                                            <div class="icon-overlay"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sm2-inline-duration">0:00</div>
                            </div>
                        </div>
                    </div>
                    <div class="sm2-inline-element sm2-button-element sm2-volume">
                        <div class="sm2-button-bd">
                            <span class="sm2-inline-button sm2-volume-control volume-shade"></span>
                            <a href="#volume-1" class="sm2-inline-button sm2-volume-control">volume</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-winrar row-winrar-1" id="bookdwn-block" style="display: none">
<!--            <h2 class="dwn-title">Скачать книгу</h2>-->
            <?php
            if (get_field('book_download', 277)) {
                foreach (get_field('book_download', 277) as $item) { ?>
                    <a target="_blank"
                       href="<?= $item['link']; ?>"
                       class="winrar-dwn-link" style="z-index: 1;">
                        <img src="<?= $item['img']; ?>">
                        <span><?= $item['text']; ?></span>
                    </a>
                <?php }
            } ?>
        </div>
        <div class="row row-photo" id="photo-block" style="display: none">
<!--            <h2 class="dwn-title">Фото</h2>-->
            <?php
            if (get_field('photo_download', 277)) {
                foreach (get_field('photo_download', 277) as $item) { ?>
                    <a target="_blank"
                       href="<?= $item['link']; ?>" style="z-index: 1;">
                        <div class="product-box">
                            <img src="<?= $item['img']; ?>">
                            <span><?= $item['text']; ?></span>
                        </div>
                    </a>
                <?php }
            } ?>
        </div>
        <div class="row row-winrar" id="video-block" style="display: none">
<!--            <h2 class="dwn-title">Видео</h2>-->
            <?php
            if (get_field('video_download', 277)) {
                foreach (get_field('video_download', 277) as $item) { ?>
                    <a target="_blank"
                       href="<?= $item['link']; ?>"
                       class="winrar-dwn-link" style="z-index: 1;">
                        <img src="<?= $item['img']; ?>">
                        <span><?= $item['text']; ?></span>
                    </a>
                <?php }
            } ?>
        </div>
    </div>


<?php

get_footer();