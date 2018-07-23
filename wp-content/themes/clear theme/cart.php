      <?php
      /*
      Template Name: Корзина
      Template Post Type: post, page
      */
      ?>
      <?php
      get_header();

      ?>

 		<div class="cart-wrap">
		<div class="container">
			<div class="container-header">
				<h2>Оформление заказа</h2>
			</div>
			
<?php echo do_shortcode("[woocommerce_cart]"); ?>

		</div>
		</div>


      <?php

      get_footer();