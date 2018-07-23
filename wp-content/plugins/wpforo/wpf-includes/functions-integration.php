<?php
	// Exit if accessed directly
	if( !defined( 'ABSPATH' ) ) exit;
 

function wpforo_has_shop_plugin( $userid = 0 ){
	$profile_url = false;
	if (is_user_logged_in()){ 
		// WooCommerce | Account Page URL
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			$profile_url = get_permalink(get_option('woocommerce_myaccount_page_id'));
		}
	}
	return $profile_url;
}

function wpforo_has_profile_plugin( $userid = 0 ){
	$profile_url = false;
	if($userid){
		// Ultimate Member | Profile Page URL
		if(class_exists('UM_API')){
			um_fetch_user($userid); $profile_url =  um_user_profile_url(); um_reset_user();
		}
		// BuddyPress | Profile Page URL
		elseif(class_exists('BuddyPress')) {
			$profile_url = bp_core_get_user_domain($userid);
		}
		// Users Ultra | Profile Page URL
		elseif(class_exists('XooUserUltra')) {
			global $xoouserultra; $profile_url = $xoouserultra->userpanel->get_user_profile_permalink($userid);
		}
		// User Pro | Profile Page URL
		if (class_exists('userpro_api')) {
			global $userpro; $profile_url = $userpro->permalink($userid);        
		}
	}
	return $profile_url;
}

function wpforo_seo_clear(){
	
	if(!wpforo_feature('seo-meta')) return;
	
	if (is_wpforo_page()) {
		remove_action('wp_head','jetpack_og_tags'); // JetPack}
		if (defined('WPSEO_VERSION')) { // Yoast SEO
			remove_action('wp_head','wpseo_head', 20);
			remove_action('wp_head','wpseo_opengraph', 20);
			add_filter( 'wpseo_canonical', '__return_false' );
			add_filter( 'wpseo_title', '__return_false' );
			add_filter( 'wpseo_metadesc', '__return_false' );
			add_filter( 'wpseo_author_link', '__return_false' );
			add_filter( 'wpseo_metakey', '__return_false' );
			add_filter( 'wpseo_locale', '__return_false' );
			add_filter( 'wpseo_opengraph_type', '__return_false' );
			add_filter( 'wpseo_opengraph_image', '__return_false' );
			add_filter( 'wpseo_opengraph_image_size', '__return_false' );
			add_filter( 'wpseo_opengraph_site_name', '__return_false' );
			add_filter( 'wp_seo_get_bc_title', '__return_false' );
			add_filter( 'wp_seo_get_bc_ancestors', '__return_false' );
			add_filter( 'wpseo_whitelist_permalink_vars', '__return_false' );
			add_filter( 'wpseo_prev_rel_link', '__return_false' );
			add_filter( 'wpseo_next_rel_link', '__return_false' );
			add_filter( 'wpseo_xml_sitemap_img_src', '__return_false' );
		}
		if (defined('AIOSEOP_VERSION')) { // All-In-One SEO
			global $aiosp;
			remove_action('wp_head',array($aiosp,'wp_head'));
		}
		remove_action('wp_head','rel_canonical');
		remove_action('wp_head','index_rel_link');
		remove_action('wp_head','start_post_rel_link');
		remove_action('wp_head','adjacent_posts_rel_link_wp_head');
	}
}
add_action( 'parse_query', 'wpforo_seo_clear' );


//Insert BuddyPress Activity
function wpforo_bp_activity( $args = array() ){
	
	if( !function_exists('bp_activity_add') || !is_user_logged_in() ) return false;
	
	$default = array(   'action'            => '',   
					 	'title'           	=> '',  
						'content'           => '',                     
						'component'         => 'WPForo',             
						'type'              => false,                  
						'primary_link'      => '',                     
						'user_id'           => '',  
					 	'item_id'           => false,
						'hide_sitewide'     => false,                 
						'is_spam'           => false);
	
	$args = wpforo_parse_args( $args, $default );
	
	if( function_exists('bp_activity_add') ){
		if( function_exists('bp_loggedin_user_domain')){
			$user_url = bp_loggedin_user_domain($args['user_id']);
			if(function_exists('bp_core_get_user_displayname')){
				$user_name = bp_core_get_user_displayname( $args['user_id']);
				if( $user_url && $user_name ){
					$user_link = '<a href="' . esc_url($user_url) . '">'. esc_html($user_name) .'</a>';
					$content_link = ( $args['primary_link'] && $args['title']) ? '<a href="' . esc_url($args['primary_link']) . '">'. esc_html($args['title']) .'</a> - ' : $args['title'] . ' - ';
					if( $args['type'] == 'wpforo_topic' ){
						$args['action'] = sprintf( wpforo_phrase('%s posted a new topic %s', false), $user_link, $content_link);
					}
					elseif( $args['type'] == 'wpforo_post' ){
						$args['action'] = sprintf( wpforo_phrase('%s posted in topic %s', false), $user_link, $content_link);
					}
					elseif( $args['type'] == 'wpforo_like' ){
						$args['action'] = sprintf( wpforo_phrase('%s liked forum post %s', false), $user_link, $content_link);
					}
				}
			}
		}
		return $activity_id = bp_activity_add( $args );
	}
}

//Delete BuddyPress Activity
function wpforo_bp_activity_delete( $args = array() ){
	
	if( !function_exists('bp_activity_delete') || !is_user_logged_in() ) return false;
	
	$default = array(   'action'            => '',   
					 	'title'           	=> '',  
						'content'           => '',                     
						'component'         => 'WPForo',             
						'type'              => false,                  
						'primary_link'      => '',                     
						'user_id'           => '',  
					 	'item_id'           => false,
						'hide_sitewide'     => false,                 
						'is_spam'           => false);
	
	$args = wpforo_parse_args( $args, $default );
	if( function_exists('bp_activity_delete') ){
		bp_activity_delete( $args );
	}
}

//Disable comment button for wpForo activity
function wpforo_bp_activity_disable_comment( $can_comment = true ){
	if ( false === $can_comment ) return $can_comment;
	if( function_exists('bp_get_activity_action_name') ){
		$action_name = bp_get_activity_action_name();
		$disabled_actions = array( 'wpforo_topic', 'wpforo_post', 'wpforo_like' );
		$disabled_actions = apply_filters( 'wpforo_bp_activity_disable_comment', $disabled_actions );
		if ( in_array( $action_name, $disabled_actions ) ) {
			$can_comment = false;
		}
	}
	return $can_comment;
}

//Register BuddyPress Activities
function wpforo_bp_register_activity_actions() {
    bp_activity_set_action( 'WPForo', 'wpforo_topic', wpforo_phrase( 'Forum topic', false ), '', wpforo_phrase( 'Forum topic', false ), array( 'member' ));
	bp_activity_set_action( 'WPForo', 'wpforo_post', wpforo_phrase( 'Forum post', false ), '', wpforo_phrase( 'Forum post', false ), array( 'member' ));
	bp_activity_set_action( 'WPForo', 'wpforo_like', wpforo_phrase( 'Forum post like', false ), '', wpforo_phrase( 'Forum post like', false ), array( 'member' ));
}
add_action( 'bp_register_activity_actions', 'wpforo_bp_register_activity_actions' );
add_filter( 'bp_activity_can_comment', 'wpforo_bp_activity_disable_comment');
