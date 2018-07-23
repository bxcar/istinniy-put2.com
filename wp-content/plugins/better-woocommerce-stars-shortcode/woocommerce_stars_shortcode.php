<?php 
/*
Plugin Name: Better WooCommerce Stars Shortcode
Plugin URI: http://clicknathan.com/web-design/better-woocommerce-star-ratings-shortcode-plugin/
Description: Creates a shortcode, [woocommerce_rating id="n"], that displays a star rating of any WooCommerce product. Includes additional options.  
Version: 1.0
Author: ClickNathan
Requires: PHP5, WooCommerce Plugin
License: GPL

Based on the original version of the plugin: https://wordpress.org/plugins/woocommerce-stars-shortcode/

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
	add_shortcode('woocommerce_rating', 'roo_stars_shortcode');
}

function better_woocommerce_stars_shortcode_css(){ ?>

<style>
i.display-rating-value, i.display-number-of-ratings {float:right; color:black; font-size:.75em; font-style:normal;}

.star-rating {float:left;}

.star-rating {float:left;}

.starwrapper:after {content:"";display:table;clear:both;}

</style>
<?php } 

function roo_stars_shortcode($atts){ 
	global $post;

    extract(shortcode_atts(array(  
        "id" => $post->ID, 
		"link" => 'true', 
		"newwindow" => 'false', 
		"alttext" => "",
		"displayaverage" => 'false',
		"displaycount" => 'true'
    ), $atts)); 

	$newwindow = !($newwindow === 'false'); // open in a new window unless newwindow is equal to false

	if($link==='true'||$link==='false'){//if it isn't true or false, we want to leave it as a string
		$link = ($link === 'true');
	}

	if(get_post_type($id)=='product'){
		ob_start();
		roo_print_stars($id, $link, $newwindow, $alttext);
		return ob_get_clean();
	}else{
		return "";
	}

}

function roo_print_stars($id="", $permalink=false, $newwindow=true, $alttext = "" ){
    global $wpdb;
    global $post;

	if(empty($id)){
		$id=$post->ID;
	}

	if(empty($alttext)){
		$alttext="Be the first to rate ". get_the_title( $id );
	}

	if(is_bool($permalink)){
		if($permalink){
			$link = get_permalink( $id );
		}		
	}else{
		$link = $permalink;
		$permalink = true;
	}

	$target = "";		 
	if($newwindow == 'true'){
		$target="target='_blank' ";
	}	

	if(get_post_type( $id )=='product'){	
		$count = $wpdb->get_var("
			SELECT COUNT(meta_value) FROM $wpdb->commentmeta
			LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
			WHERE meta_key = 'rating'
			AND comment_post_ID = $id
			AND comment_approved = '1'
			AND meta_value > 0
		");

		$rating = $wpdb->get_var("
			SELECT SUM(meta_value) FROM $wpdb->commentmeta
			LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
			WHERE meta_key = 'rating'
			AND comment_post_ID = $id
			AND comment_approved = '1'
		");

		if($permalink){
			echo "<a href='{$link}'  {$target} >";
		}

		echo '<span style="display:inline-block;float:none;" class="starwrapper" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';

		if ( $count > 0 ) {
			$average = number_format($rating / $count, 2);
			if ($displayaverage == 'true') {
				$averagedigit = '<i title="average rating" class="display-rating-value">( '.$average.' )</i>';
			}
			if ($displaycount != 'false') {
				$totalcomments = '<i title="total number of comments" class="display-number-of-ratings">( '.$count.' )</i>';
			}

			echo '<span class="star-rating" title="'.sprintf(__('Rated %s out of 5', 'woocommerce'), $average).'"><span style="width:'.($average*16).'px"><span itemprop="ratingValue" class="rating">'.$average.'</span> </span></span>';

		}else{
			echo '<span class="star-rating-alt-text">'.$alttext.'</span>';
		}

		echo $averagedigit.' '.$totalcomments.'</span>';

		if($permalink){
			echo "</a>";
		}

		add_action('wp_footer', 'better_woocommerce_stars_shortcode_css');

	}

}

?>