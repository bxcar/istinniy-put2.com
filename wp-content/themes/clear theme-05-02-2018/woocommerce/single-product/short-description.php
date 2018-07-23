<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

if ( ! $post->post_excerpt ) {
	return;
}

?>
<div class="woocommerce-product-details__short-description">
    <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?><hr/>
	<?php if (get_post_meta($post->ID, "calameo1", true) != "") { ?><a href="<?php echo get_post_meta($post->ID, "calameo1", true); ?>" class="su-button su-button-style-glass calameo_a" target="_blank"><span class="calameo_span">Читать на мониторе<small class="calameo_span2">Перейти на сайт Calameo</small></span></a><?php } ?>
	<?php if (get_post_meta($post->ID, "calameo2", true) != "") { ?><a href="<?php echo get_post_meta($post->ID, "calameo1", true); ?>" class="su-button su-button-style-glass calameo_a" target="_blank"><span class="calameo_span">Читать на смартфоне<small class="calameo_span2">Перейти на сайт Calameo</small></span></a><?php } ?>
	<?php foreach(get_field("pdfdown", $post->ID) as $file) { ?><a href="<?php if ($file['file2'] != "") { $path_info = pathinfo($file['file1']); echo $file['file2']; } else { $path_info = pathinfo($file['file1']); echo $file['file1']; } ?>" class="su-button su-button-style-glass calameo_a" target="_blank"><span class="calameo_span">Скачать файл<?php if ($file['file1'] != "") { echo " *.".$path_info['extension']; } ?><small class="calameo_span2">Откроется в новом окне</small></span></a><?php echo "\n	"; } ?>
	<?php if (get_field("chapters", $post->ID)[0]['title'] != "" or get_field("chapters", $post->ID)[0]['text'] != "") { ?><a href="<?php echo get_permalink($post->ID)."?chapters=yes"; ?>" class="su-button su-button-style-glass calameo_a"><span class="calameo_span">Читать по главам<small class="calameo_span2">Остаться на сайте</small></span></a><?php } ?>
	<?php if (get_field("audiobook", $post->ID) != "") { ?>
    <script>
      var a = audiojs;
      a.events.ready(function() {
        var a1 = a.createAll();
      });
    </script>
	<br/><audio src="<?php echo get_field("audiobook", $post->ID); ?>" preload="auto"></audio><a href="<?php echo get_field("audiobook", $post->ID); ?>" class="su-button su-button-style-glass calameo_a"><span class="calameo_span">Скачать audio<small class="calameo_span2">Аудио версия книги</small></span></a><?php } ?><hr/>
</div>
