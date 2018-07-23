<?php
/**
 * Variable product add to cart
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 *
 * Modified to use radio buttons instead of dropdowns
 * @author 8manos
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>
	 
		<table class="variations" cellspacing="0">
			<tbody>
				<?php foreach ( $attributes as $name => $options ) : ?>
					<tr class="attribute-<?php echo sanitize_title($name); ?>">
						<td class="label">
							<label for="<?php echo sanitize_title( $name ); ?>"><?php echo wc_attribute_label( $name ); ?></label></td>
						<?php
						$sanitized_name = sanitize_title( $name );
						if ( isset( $_REQUEST[ 'attribute_' . $sanitized_name ] ) ) {
							$checked_value = $_REQUEST[ 'attribute_' . $sanitized_name ];
						} elseif ( isset( $selected_attributes[ $sanitized_name ] ) ) {
							$checked_value = $selected_attributes[ $sanitized_name ];
						} else {
							$checked_value = '';
						}
						?>
						<td class="value">
							<div class="books">
							<?php
							if ( ! empty( $options ) ) {
								if ( taxonomy_exists( $name ) ) {
									
									// Get terms if this is a taxonomy - ordered. We need the names too.
									$terms = wc_get_product_terms( $product->get_id(), $name, array( 'fields' => 'all' ) );

									foreach ( $terms as $term ) {
										if ( ! in_array( $term->slug, $options ) ) {
											continue;
										}
										echo '<div class="hard book boks-cat '.$term->slug.'">
					                  <div class="book-img">
					                    
					                  </div>';
					                  // print_r($term);die();
										print_attribute_radio( $checked_value, $term->slug, $term->name, $sanitized_name );
									echo "</div>";
									}
								} else {
									foreach ( $options as $option ) {
										print_attribute_radio( $checked_value, $option, $option, $sanitized_name );
									}
								}
							}

							echo end( $attribute_keys ) === $name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . __( 'Clear', 'woocommerce' ) . '</a>' ) : '';
							?>
</div>

						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
<div class="right-block">
<div class="sidebar2">
<div class="single_variation_wrap sale-block">
<div class="sale-block-text">
<div class="old-price"><?php do_action( 'woocommerce_before_single_variation' ); ?></div>
<div class="new-price"><?php do_action( 'woocommerce_after_single_variation' ); ?></div>
<div class="text-sale">
  <span>В наличии</span>
<br>Курьер доставит завтра
</div>
</div>
<div class="add-to-cart"><?php do_action( 'woocommerce_single_variation' ); ?></div>
</div>
</div>
<?php $audio = get_field('drivelink');

if(!empty($audio)) : 
 ?>

  <div class="player-music">
<?php echo do_shortcode('[karma_by_kadar__simple_player title="'.get_the_title().'" volume="0.5" src="'.$audio.'"]'); ?>
<a href="<?=$audio ?>" target="_blank">Скачать</a>
</div>
<?php endif; ?>
  </div>
  <script>
        var drivelink = jQuery('.drivelink')[0].outerHTML;
        jQuery(".drivelinkwrap").append(drivelink);
        jQuery(".modal-common-gl .drivelink").remove();
        jQuery(".drivelink").css("display", "inline");
    </script>
<!-- <div class="right-block">
</div> -->
<!-- 		<div class="single_variation_wrap sale-block">
			<?php
				do_action( 'woocommerce_before_single_variation' );
				do_action( 'woocommerce_single_variation' );
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div> -->

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

</div>
<div class="left-block xarakteristika">    
 <div class="characters">
                  <?php $i=0; if( have_rows('характеристика') ): ?>
                <div class="characters-item" >
    <?php 
    while ( have_rows('характеристика') ) : the_row();
?>  
  <div class="line">
                  <div class="name">
                    <div class="items-1"><?php  the_sub_field('text_1'); ?></div>
                  </div>
                
                  <div class="text">
                    <span class="items-2"><?php  the_sub_field('text_2'); ?></span>
                
                  </div>
                </div>
<?php 
$i++;    endwhile;?> 
</div>
<?php if($i > 3){ echo '<div class="toggler">развернуть</div>';} ?>
                  
    <?php 
endif; ?>
              
            
          </div>
 

      <!-- <div class="book-desc">
        <h4>О книге</h4>
        <?php 
$excerpt = get_the_content();
$excerpt = substr( $excerpt , 0, 300); 

?>
        <p class="desc-block"><?php echo $excerpt; ?> <a href="#content-block" > Читать далее</a></p>
      </div> -->
</div>

<script type="text/javascript">
$(function(){
    var button = $('.characters .toggler'),
        animateTime = 130;

    $(button).click(function () {
        reset(animateTime);
        $('.characters .toggler').text("развернуть");

        var text = $(this).parent().find('div.characters-item');
        if (text.height() === 130) {
            autoHeightAnimate(text, animateTime);
            $(this).text("свернуть");
        $('.characters .toggler').addClass("open");

        } else {
        $('.characters .toggler').removeClass("open");

            text.stop().animate({ height: '130px' }, animateTime);
            $('.characters .toggler').text("развернуть");
        }
    });
});

 /* Function to animate height: auto */
    function autoHeightAnimate(element, time) {

        var curHeight = element.height(), // Get Default Height
            autoHeight = element.css('height', 'auto').height(); // Get Auto Height
        element.height(curHeight); // Reset to Default Height
        element.stop().animate({ height: autoHeight }, time); // Animate to Auto Height
    }
    function reset(time){
        $('.characters .toggler').addClass("open");
        $('.characters-item').animate({'height':'550'}, time);
    }
</script>