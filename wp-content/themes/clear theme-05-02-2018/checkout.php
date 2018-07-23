      <?php
      /*
      Template Name: Оплата и доставка
      Template Post Type: post, page
      */
      ?>
      <?php
      get_header();

      ?>

 		<div class="checkout-wrap">
		<div class="container">
			<div class="container-header">
				<h2>Доставка и оплата</h2>
			</div>
			
<?php echo do_shortcode("[woocommerce_checkout]"); ?>

		</div>
		</div>


      <?php

      get_footer();