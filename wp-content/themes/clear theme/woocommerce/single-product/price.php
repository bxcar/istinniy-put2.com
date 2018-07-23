<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<div class="right-block">
<div class="sidebar2">
  <div class="sale-block">
<div class="flypage-price old-price"><?php echo $product->get_price_html(); ?></div>
<div class="sale-block-text">

<div class="text-sale">
  <span>В наличии</span>
<br>Курьер доставит завтра
</div>
</div>
<div class="flypage_add_to_cart add-to-cart">
   <?php do_action( 'woocommerce_before_single_product_cart' ); ?>
</div>

</div>

  </div>

</div>
