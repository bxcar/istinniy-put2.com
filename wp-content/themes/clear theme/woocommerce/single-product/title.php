<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author     WooThemes
 * @package    WooCommerce/Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $product;
$id = $product->get_id();
$rating= get_field('rating');

echo '   <div class="titlecolumn">
              <p>Бестселлер</p>';
the_title( '<h1 class="product_title entry-title">', '</h1>' );
// var_dump($rating);

echo '<div class="detailpanel">
                <div class="stars-block">
                  <div class="my-rating" data-rating="'.$rating.'"></div>
                  <div class="raiting">
                   <div class="stars-container">
                  </div>
                  </div>
                  
                </div>
                '.do_shortcode("[ti_wishlists_addtowishlist loop=yes]").'
                <a class="send">                   
<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,gplus,twitter" data-limit="0"> </div>
                </a>
                <p class="code">Код товара: <span>'.$id.'</span></p>
              </div>
            </div>   <div class="charactercolumn">
';