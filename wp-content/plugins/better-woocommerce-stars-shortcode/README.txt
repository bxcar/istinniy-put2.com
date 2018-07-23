=== Better WooCommerce Stars Shortcode ===
Contributors: clicknathan, rooteerooroo
Tags: woocommerce, shortcode, rating, ratings, stars
Requires at least: 3.0
Tested up to: 4.8
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Creates a shortcode that displays the rating, in stars, of any WooCommerce product.

== Description ==

Creates a shortcode, `[woocommerce_rating id="n"]`,  that displays the rating, in stars, of any WooCommerce product.  `[woocommerce_rating]` will show the star rating of the current product.  This plugin requires WooCommerce.  


== Installation ==
1. Log in to your WordPress dashboard, then click Plugins->add new.  
2. Search for the Woocommerce Stars Shortcode plugin in the plugin repository.
3. Click the "install now" link under the name of the plugin.
4. Activate the plugin.  

Or, if you prefer: 
1. Upload `woocommerce_stars_shortcode.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress


== Frequently Asked Questions ==

= How about some instructions? =

Instructions are here: http://clicknathan.com/web-design/better-woocommerce-star-ratings-shortcode-plugin/

= What are the short code options? =

[woocommerce_rating id="n"] is the default. Replace "n" with the ID of the product you want to show the ratings for.

[woocommerce_rating id="n" link="false"] Add this if you don't want the star rating to be a link.

[woocommerce_rating id="n" newwindow="true"] Add this if you want the link to open in a new window.

[woocommerce_rating id="n" alttext="Some alternative text"] This allows you to customize the text shown when a product has not yet been rated.

[woocommerce_rating id="n" displayaverage="true"] This will add a number, the average of all ratings for this product, after the stars, like ( 3.25 )

[woocommerce_rating id="n" displaycount="true"] This will add a number, the total number of ratings for this product, after the stars, like ( 420 )

== Changelog ==

= 1.0 =
* Updated the shortcode options to allow displaying an average count and total count after the star display
* Made the newwindow option "false" by default.
* Plugin now injects necessary CSS via wp_footer

= 0.5 =
* Release