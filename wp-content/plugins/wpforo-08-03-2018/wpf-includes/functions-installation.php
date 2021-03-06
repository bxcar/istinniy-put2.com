<?php
	// Exit if accessed directly
	if( !defined( 'ABSPATH' ) ) exit;
 
function do_wpforo_activation($network_wide){
	if ( is_multisite() && $network_wide ) { 
        global $wpdb;
		
        $old_blogid = $wpdb->blogid;
        $blogids = $wpdb->get_col("SELECT blog_id FROM {$wpdb->blogs}");
        foreach ($blogids as $blogid){
            switch_to_blog($blogid);
            wpforo_activation();
        }
        switch_to_blog($old_blogid);
    }else{
        wpforo_activation();
    }
}

function do_wpforo_deactivation($network_wide){
	if ( is_multisite() && $network_wide ) { 
        global $wpdb;
		
        $old_blogid = $wpdb->blogid;
        $blogids = $wpdb->get_col("SELECT blog_id FROM {$wpdb->blogs}");
        foreach ($blogids as $blogid){
            switch_to_blog($blogid);
            wpforo_deactivation();
        }
        switch_to_blog($old_blogid);
    }else{
        wpforo_deactivation();
    }
}

function wpforo_activation(){
	global $wpforo, $wpdb;
	if( ! wpforo_is_admin() ) return;
	if( ! current_user_can( 'activate_plugins' ) ) return;

	add_option('wpforo_default_groupid', $wpforo->usergroup->default->default_groupid);

	require( WPFORO_DIR . '/wpf-includes/install-sql.php' );
	foreach( $wpforo_sql as $sql ) if( FALSE === @$wpforo->db->query($sql) ) @$wpforo->db->query( preg_replace('#)[\r\n\t\s]*ENGINE.*$#isu', ')', $sql) );

	$users = $wpforo->db->get_var("SELECT COUNT(*) FROM `" . $wpforo->db->base_prefix . "users`");
	if( $users <= 100 ) $wpforo->member->synchronize_users();
	$wpforo->member->init_current_user();

	add_option( 'wpforo_count_per_page', 10 );
	
	###################################################################
	// General Options ////////////////////////////////////////////////
	wpforo_update_options( 'wpforo_general_options', $wpforo->default->general_options );
	
	###################################################################
	// Forums /////////////////////////////////////////////////////////
	wpforo_update_options( 'wpforo_forum_options', $wpforo->forum->default->options );
	
	##################################################################
	// Topics & Posts ////////////////////////////////////////////////
	wpforo_update_options( 'wpforo_post_options', $wpforo->post->default->options );
	
	#################################################################
	// Features /////////////////////////////////////////////////////
	wpforo_update_options( 'wpforo_features', $wpforo->default->features );
	
	#################################################################
	// Theme & Style ////////////////////////////////////////////////
	wpforo_update_options( 'wpforo_style_options', $wpforo->tpl->default->style );
	wpforo_update_options( 'wpforo_theme_options', $wpforo->tpl->default->options );
	
	#################################################################
	// Members //////////////////////////////////////////////////////
	$exlude = array('rating_title_ug', 'rating_badge_ug');
	wpforo_update_options( 'wpforo_member_options', $wpforo->member->default->options, $exlude);
	
	#################################################################
	// Subscribe Options ////////////////////////////////////////////
    wpforo_update_options( 'wpforo_subscribe_options', $wpforo->sbscrb->default->options );
	
	#################################################################
	// Tool Options - Antispam ///////////////////////////////////////
	wpforo_update_options( 'wpforo_tools_antispam', $wpforo->default->tools_antispam);
	
	#################################################################
	// Tool Options - Cleanup ///////////////////////////////////////
	wpforo_update_options( 'wpforo_tools_cleanup', $wpforo->default->tools_cleanup);
	
	#################################################################
	// Forum Navigation and Menu ////////////////////////////////////
	$menu_name = wpforo_phrase('wpForo Navigation', false, 'orig');
	$menu_location = 'wpforo-menu';
	$menu_exists = wp_get_nav_menu_object( $menu_name );
	if(!$menu_exists){
		$id = array();
		$menu_id = wp_create_nav_menu($menu_name);
		$id['wpforo-home'] = wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' =>  wpforo_phrase('Forums', false),
			'menu-item-classes' => 'wpforo-home',
			'menu-item-url' => '/%wpforo-home%/', 
			'menu-item-status' => 'publish',
			'menu-item-parent-id' => 0,
			'menu-item-position' => 0));
	
		 $id['wpforo-members'] = wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' =>  wpforo_phrase('Members', false),
			'menu-item-classes' => 'wpforo-members',
			'menu-item-url' => '/%wpforo-members%/', 
			'menu-item-status' => 'publish',
			'menu-item-parent-id' => 0,
			'menu-item-position' => 0));
			
		$id['wpforo-recent'] = wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' =>  wpforo_phrase('Recent Posts', false),
			'menu-item-classes' => 'wpforo-recent',
			'menu-item-url' => '/%wpforo-recent%/', 
			'menu-item-status' => 'publish',
			'menu-item-parent-id' => 0,
			'menu-item-position' => 0));
			
		 $id['wpforo-profile'] =  wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' =>  wpforo_phrase('My Profile', false),
			'menu-item-classes' => 'wpforo-profile',
			'menu-item-url' => '/%wpforo-profile-home%/', 
			'menu-item-status' => 'publish',
			'menu-item-parent-id' => 0,
			'menu-item-position' => 0));
		
		if(isset($id['wpforo-profile']) && $id['wpforo-profile']){
			$id['wpforo-profile-account'] =  wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' =>  wpforo_phrase('Account', false),
				'menu-item-classes' => 'wpforo-profile-account',
				'menu-item-url' => '/%wpforo-profile-account%/', 
				'menu-item-status' => 'publish',
				'menu-item-parent-id' => $id['wpforo-profile'],
				'menu-item-position' => 1)
			);
			$id['wpforo-profile-activity'] =  wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' =>  wpforo_phrase('Activity', false),
				'menu-item-classes' => 'wpforo-profile-activity',
				'menu-item-url' => '/%wpforo-profile-activity%/', 
				'menu-item-status' => 'publish',
				'menu-item-parent-id' => $id['wpforo-profile'],
				'menu-item-position' => 1)
			);
			$id['wpforo-profile-subscriptions'] =  wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' =>  wpforo_phrase('Subscriptions', false),
				'menu-item-classes' => 'wpforo-profile-subscriptions',
				'menu-item-url' => '/%wpforo-profile-subscriptions%/', 
				'menu-item-status' => 'publish',
				'menu-item-parent-id' => $id['wpforo-profile'],
				'menu-item-position' => 2)
			);
		}
		
		$id['wpforo-register'] =  wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' =>  wpforo_phrase('Register', false),
			'menu-item-classes' => 'wpforo-register',
			'menu-item-url' => '/%wpforo-register%/', 
			'menu-item-status' => 'publish',
			'menu-item-parent-id' => 0,
			'menu-item-position' => 0));
		
		$id['wpforo-login'] =  wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' =>  wpforo_phrase('Login', false),
			'menu-item-classes' => 'wpforo-login',
			'menu-item-url' => '/%wpforo-login%/', 
			'menu-item-status' => 'publish',
			'menu-item-parent-id' => 0,
			'menu-item-position' => 0));
		
		$id['wpforo-logout'] =  wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' =>  wpforo_phrase('Logout', false),
			'menu-item-classes' => 'wpforo-logout',
			'menu-item-url' => '/%wpforo-logout%/', 
			'menu-item-status' => 'publish',
			'menu-item-parent-id' => 0,
			'menu-item-position' => 0));
			
		if( !has_nav_menu( $menu_location ) ){
			$locations = get_theme_mod('nav_menu_locations');
			if(empty($locations)) $locations = array();
			$locations[$menu_location] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}
	
	#################################################################
	// Access Sets //////////////////////////////////////////////////
	$cans_n = array('vf'  => 0, 'ct'  => 0, 'vt'  => 0, 'et'  => 0, 'dt' => 0,
					'cr'  => 0, 'vr'  => 0, 'er'  => 0, 'dr'  => 0,
					'eot' => 0, 'eor' => 0, 'dot' => 0,	'dor' => 0,	
					'l'   => 0, 'r'   => 0, 's'   => 0, 'au'  => 0, 'p'   => 0, 'op' => 0, 'vp' => 0, 'sv'  => 0, 'osv'  => 0, 'v'  => 0, 'a' => 0, 'va' => 0, 
					'at'  => 0, 'oat' => 0, 'cot' => 0, 'mt' => 0);
	$cans_r = array('vf'  => 1, 'ct'  => 0, 'vt'  => 1, 'et'  => 0, 'dt' => 0,
					'cr'  => 0, 'vr'  => 1, 'er'  => 0, 'dr' => 0,
					'eot' => 0, 'eor' => 0, 'dot' => 0,	'dor' => 0,	
					'l'   => 0, 'r'   => 0, 's'   => 0, 'au'  => 0, 'p'   => 0, 'op' => 0, 'vp' => 0, 'sv'  => 0, 'osv' => 0, 'v' => 0, 'a' => 0, 'va' => 1,
					'at'  => 0, 'oat' => 0, 'cot' => 0, 'mt' => 0);
	$cans_s = array('vf'  => 1, 'ct'  => 1, 'vt'  => 1, 'et'  => 0, 'dt' => 0,
					'cr'  => 1, 'vr'  => 1, 'er'  => 0, 'dr' => 0,
					'eot' => 1, 'eor' => 1, 'dot' => 1,	'dor' => 1,	
					'l'   => 1, 'r'   => 1, 's'   => 0, 'au'  => 0, 'p'   => 0, 'op' => 1, 'vp' => 0, 'sv'  => 0, 'osv' => 1, 'v' => 1, 'a' => 1, 'va' => 1,
					'at'  => 0, 'oat' => 1, 'cot' => 0, 'mt' => 0);
	$cans_m =  array('vf'  => 1, 'ct'  => 1, 'vt'  => 1, 'et'  => 1, 'dt' => 1,
					'cr'  => 1, 'vr'  => 1, 'er'  => 1, 'dr' => 1,
					'eot' => 1, 'eor' => 1, 'dot' => 1,	'dor' => 1,	
					'l'   => 1, 'r'   => 1, 's'   => 1, 'au'  => 1, 'p'   => 1, 'op' => 1, 'vp' => 1, 'sv'  => 1, 'osv'  => 1, 'v' => 1, 'a' => 1, 'va' => 1,
					'at'  => 1, 'oat' => 1, 'cot' => 1, 'mt' => 1);
	$cans_a =  array('vf'  => 1, 'ct'  => 1, 'vt'  => 1, 'et'  => 1, 'dt' => 1,
					'cr'   => 1, 'vr'  => 1, 'er'  => 1, 'dr'  => 1,
					'eot'  => 1, 'eor' => 1, 'dot' => 1, 'dor' => 1,	
					'l'    => 1, 'r'   => 1, 's'   => 1, 'au'  => 1, 'p'   => 1, 'op' => 1, 'vp' => 1, 'sv'  => 1, 'osv' => 1, 'v'   => 1, 'a' => 1, 'va' => 1,
					'at'   => 1, 'oat' => 1, 'cot' => 1, 'mt'  => 1);
	
	$sql = "SELECT * FROM `".$wpforo->db->prefix."wpforo_accesses`";
	$accesses = $wpforo->db->get_results($sql, ARRAY_A);
	if( empty($accesses) ){
		
		$cans_n = serialize($cans_n);
		$cans_r = serialize($cans_r);
		$cans_s = serialize($cans_s);
		$cans_m = serialize($cans_m);
		$cans_a = serialize($cans_a);
		
		$sql = "INSERT IGNORE INTO `".$wpforo->db->prefix."wpforo_accesses` 
			(`access`, `title`, cans) VALUES	
			('no_access', 'No access', '". $cans_n ."'),
			('read_only', 'Read only access', '". $cans_r ."'),
			('standard', 'Standard access', '". $cans_s ."'),
			('moderator', 'Moderator access', '".$cans_m."'),
			('full', 'Full access', '".$cans_a."')";
		
		$wpforo->db->query( $sql );
	}else{
		foreach($accesses as $access){
			$default = array();
			$current = unserialize($access['cans']);
			if( strtolower($access['access']) == 'no_access' ) $default = $cans_n;
			elseif( strtolower($access['access']) == 'read_only' ) $default = $cans_r;
			elseif( strtolower($access['access']) == 'standard' ) $default = $cans_s;
			elseif( strtolower($access['access']) == 'moderator' ) $default = $cans_m;
			elseif( strtolower($access['access']) == 'full' ) $default = $cans_a;
			if( !empty($default) ){
				$data_update = array_merge($default, $current);
				if( !empty($data_update) ){
					$data_update = serialize($data_update);
					$wpforo->db->query("UPDATE `".$wpforo->db->prefix."wpforo_accesses` SET `cans` = '" . $wpforo->db->_real_escape($data_update) . "' WHERE `accessid` = " . intval($access['accessid']) );
				}
			}
		}
	}
	
	
	#################################################################
	// Usergroup ////////////////////////////////////////////////////
	$cans_admin = array('cf'    => '1', 'ef'   => '1', 'df'   => '1', 'vm'   => '1', 'aum'   => '1', 'em' => '1', 'vmg' => '1', 'aup' => '1', 'vmem' => '1',  'vprf' => '1',
						'bm'    => '1', 'dm'    => '1', 'upa'  => '1', 'ups'  => '1', 'va'   => '1',
						'vmu'   => '1', 'vmm'  => '1', 'vmt'  => '1', 'vmct' => '1',
						'vmr'   => '1', 'vmw'  => '1', 'vmsn' => '1', 'vmrd' => '1',
						'vmlad' => '1',	'vip'  => '1', 'vml'  => '1', 'vmo'  => '1', 
						'vms'   => '1', 'vmam' => '1', 'vmpn' => '1', 'vwpm' => '1');
	$cans_moder = array('cf'    => '0', 'ef'   => '0', 'df'   => '0', 'vm'   => '0', 'aum'   => '1', 'em' => '0', 'vmg' => '0', 'aup' => '1', 'vmem' => '1',  'vprf' => '1',
						'bm'    => '1', 'dm'    => '1', 'upa'  => '1', 'ups'  => '1', 'va'   => '1',
						'vmu'   => '0', 'vmm'  => '1', 'vmt'  => '1', 'vmct' => '1',
						'vmr'   => '1', 'vmw'  => '1', 'vmsn' => '1', 'vmrd' => '1',
						'vmlad' => '1',	'vip'  => '1', 'vml'  => '1', 'vmo'  => '1', 
						'vms'   => '1', 'vmam' => '1', 'vmpn' => '1', 'vwpm' => '1');
	$cans_reg = array(  'cf'    => '0', 'ef'   => '0', 'df'   => '0', 'vm'   => '0', 'aum'   => '0', 'em' => '0', 'vmg' => '0', 'aup' => '1', 'vmem' => '1',  'vprf' => '1',
						'bm'    => '0', 'dm'    => '0', 'upa'  => '1', 'ups'  => '1', 'va'   => '1',
						'vmu'   => '0', 'vmm'  => '0', 'vmt'  => '1', 'vmct' => '1',
						'vmr'   => '1', 'vmw'  => '1', 'vmsn' => '1', 'vmrd' => '1',
						'vmlad' => '1',	'vip'  => '0', 'vml'  => '1', 'vmo'  => '1', 
						'vms'   => '1', 'vmam' => '1', 'vmpn' => '0', 'vwpm' => '1');
	$cans_guest = array('cf' 	=> '0', 'ef'	=> '0', 'df'	=> '0', 'vm'	=> '0', 'aum'   => '0', 'em' 	=> '0', 'bm'    => '0', 'dm'	=> '0', 'vmg'	=> '0', 'aup'	=> '0', 'vmem'	=> '1',  
						'vprf'	=> '1', 'upa'	=> '0', 'ups'	=> '0', 'va'	=> '1',
						'vmu'	=> '0', 'vmm'	=> '0', 'vmt'	=> '1', 'vmct'	=> '1',
						'vmr'	=> '1', 'vmw'	=> '0', 'vmsn'	=> '1', 'vmrd'	=> '1',
						'vmlad'	=> '1', 'vip'	=> '0', 'vml'	=> '1', 'vmo'	=> '1', 
						'vms'   => '1', 'vmam'	=> '1', 'vmpn'	=> '0', 'vwpm'	=> '0');
	$cans_customer = array('cf'    => '0', 'ef'   => '0', 'df'   => '0', 'vm'   => '0', 'aum'   => '0', 'em' => '0', 'vmg' => '0', 'aup' => '0', 'vmem' => '1',  'vprf' => '1', 'bm'    => '0', 
						'dm'    => '0', 'upa'  => '1', 'ups'  => '1', 'va'   => '1',
						'vmu'   => '0', 'vmm'  => '0', 'vmt'  => '1', 'vmct' => '1',
						'vmr'   => '1', 'vmw'  => '1', 'vmsn' => '1', 'vmrd' => '1',
						'vmlad' => '1',	'vip'  => '0', 'vml'  => '1', 'vmo'  => '1', 
						'vms'   => '1', 'vmam' => '1', 'vmpn' => '0', 'vwpm' => '1');
	
	
	$sql = "SELECT * FROM `".$wpforo->db->prefix."wpforo_usergroups`";
	$usergroups = $wpforo->db->get_results($sql, ARRAY_A);
	if( empty($usergroups) ){
		$cans_admin = serialize( $cans_admin );
		$cans_moder = serialize( $cans_moder );
		$cans_reg = serialize( $cans_reg );
		$cans_guest = serialize( $cans_guest );
		$cans_customer = serialize( $cans_customer );
		$sql = "INSERT IGNORE INTO `".$wpforo->db->prefix."wpforo_usergroups` 
			(`name`, `cans`) VALUES	('Admin', '$cans_admin'),('Moderator', '$cans_moder'),('Registered', '$cans_reg'),('Guest', '$cans_guest'),('Customer', '$cans_customer')";
		$wpforo->db->query($sql);
	}
	else{
		foreach($usergroups as $usergroup){
			$default = array();
			$data_update = array();
			$current = unserialize($usergroup['cans']);
			if( strtolower($usergroup['name']) == 'admin' ) $default = $cans_admin;
			elseif( strtolower($usergroup['name']) == 'moderator' ) $default = $cans_moder;
			elseif( strtolower($usergroup['name']) == 'registered' ) $default = $cans_reg;
			elseif( strtolower($usergroup['name']) == 'guest' ) $default = $cans_guest;
			elseif( strtolower($usergroup['name']) == 'customer' ) $default = $cans_customer;
			if( !empty($default) ){
				$data_update = array_merge($default, $current);
				if( !empty($data_update) ){
					if( strtolower($usergroup['name']) == 'guest' && $data_update['vprf'] && WPFORO_VERSION == '1.4.2' ) $data_update['va'] = 1;
					$data_update = serialize($data_update);
					$wpforo->db->query("UPDATE `".$wpforo->db->prefix."wpforo_usergroups` SET `cans` = '" . $wpforo->db->_real_escape($data_update) . "' WHERE `groupid` = " . intval($usergroup['groupid']) );
				}
			}
		}
	}
	$sql = "SELECT COUNT(*) FROM `".$wpforo->db->prefix."wpforo_forums`";
	$count = $wpforo->db->get_var($sql);
	if(!$count){
		if( $parentid = $wpforo->forum->add( array( 'title' => 'Main Category', 'description' => 'This is a simple category / section' ), FALSE ) ){
			$wpforo->forum->add( array( 'title' => 'Main Forum', 'description' => 'This is a simple parent forum', 'parentid' => $parentid, 'icon' => 'fa-comments' ), FALSE );
		}
	}
	
	#################################################################
	// Permalink Settings ///////////////////////////////////////////
	$permalink_structure = get_option( 'permalink_structure' );
	if( !$permalink_structure ){
		global $wp_rewrite;
		$wp_rewrite->set_permalink_structure( '/%postname%/' );
	}
	
	#################################################################
	// Creating Forum Page //////////////////////////////////////////
	if( !$wpforo->pageid || 
		!$wpforo->db->get_var("SELECT `ID` FROM `{$wpforo->db->prefix}posts` WHERE `ID` = '".intval($wpforo->pageid)."' AND ( `post_content` LIKE '%[wpforo]%' OR `post_content` LIKE '%[wpforo-index]%' ) AND `post_status` LIKE 'publish' AND `post_type` IN('post', 'page')") ){
		if( !$page_id = $wpforo->db->get_var("SELECT `ID` FROM `{$wpforo->db->prefix}posts` WHERE `post_content` LIKE '%[wpforo]%' AND `post_status` LIKE 'publish' AND `post_type` IN('post', 'page')") ){
			$wpforo_page = array(
				'post_date' => current_time( 'mysql', 1 ),
				'post_date_gmt' => current_time( 'mysql', 1 ),
				'post_content' => '[wpforo]',
				'post_title' => 'Forum',
				'post_status' => 'publish',
				'comment_status' => 'close',
				'ping_status' => 'close',
				'post_name' => 'community',
				'post_modified' => current_time( 'mysql', 1 ),
				'post_modified_gmt' => current_time( 'mysql', 1 ),
				'post_parent' => 0,
				'menu_order' => 0,
				'post_type' => 'page'
			);
			$page_id = wp_insert_post( $wpforo_page );
		}
		if( $page_id && !is_wp_error($page_id) ){
			update_option( 'wpforo_pageid', $page_id );
			update_option( 'wpforo_use_home_url', '0' );
			$wpforo_url = get_wpf_option('wpforo_url');
			if( !$wpforo_url ){
				update_option( 'wpforo_permastruct', 'community' );
				update_option( 'wpforo_url', esc_url( home_url('/') ) . "community/" );
			}else{
				if( !$wpforo->permastruct ){
					update_option( 'wpforo_permastruct',  basename($wpforo_url) );
					update_option( 'wpforo_url', esc_url( home_url('/') ) . basename($wpforo_url) . "/" );
				}else{
					update_option( 'wpforo_url', esc_url( home_url('/') ) . $wpforo->permastruct . "/" );
				}
			}
		}
	}else{
		if( !$wpforo->use_home_url ) update_option( 'wpforo_use_home_url', '0' );
		if( !$wpforo->permastruct ) update_option( 'wpforo_permastruct', basename( get_wpf_option('wpforo_url') ) );
		$wpforo->db->query("UPDATE `{$wpforo->db->prefix}posts` SET `post_content` = REPLACE(`post_content`, '[wpforo-index]', '[wpforo]') WHERE `ID` = '{$wpforo->pageid}'");
	}

	$wpforo->pageid = get_wpf_option( 'wpforo_pageid');
	$wpforo->permastruct = trim( get_wpf_option('wpforo_permastruct'), '/' );
	flush_rewrite_rules(FALSE);
	nocache_headers();
	
	
	#################################################################
	// Importing Language Packs and Phrases /////////////////////////
	$wpforo->phrase->xml_import('english.xml', 'install');
	
	#################################################################
	// Creating wpforo folders //////////////////////////////////////
	$upload_array = wp_upload_dir();
	$wpforo_upload_dir = $upload_array['basedir'].'/wpforo/';
	if (!is_dir($wpforo_upload_dir)) {
		wp_mkdir_p($wpforo_upload_dir);
	}
	$avatars_upload_dir=$upload_array['basedir'].'/wpforo/avatars/';
	if (!is_dir($avatars_upload_dir)) {
		wp_mkdir_p($avatars_upload_dir);
	}
	
	#################################################################
	// RESET USER CACHE /////////////////////////////////////////////
	$wpforo->member->clear_db_cache();
	
	#################################################################
	// RESET FUNCTIONS //////////////////////////////////////////////
	$sql = "SHOW COLUMNS FROM `".$wpdb->prefix."wpforo_phrases` WHERE `Field` LIKE 'package'";
	if( !$wpdb->get_row($sql, ARRAY_A) ){
		@$wpdb->query( "ALTER TABLE `".$wpdb->prefix."wpforo_phrases` ADD COLUMN `package` VARCHAR(255) NOT NULL DEFAULT 'wpforo'" );
	}
	$wpforo->phrase->clear_cache();
	
	#################################################################
	// ADD `private` field in TOPIC TABLE  ///////////////////////////
	$args = array( 'table' => $wpdb->prefix . 'wpforo_topics', 'col' => 'private', 'check' => 'col_exists' );
	if( !wpforo_db_check( $args ) ){
		@$wpdb->query( "ALTER TABLE `".$wpdb->prefix."wpforo_topics` ADD `private` TINYINT(1) NOT NULL DEFAULT '0', ADD INDEX `is_private` (`private`);" );
		@$wpdb->query( "ALTER TABLE `".$wpdb->prefix."wpforo_topics` ADD INDEX `own_private` ( `userid`, `private`);" );
	}
	// ADD INDEXES in wpforo_views TABLE///////////////////////////
	$args = array( 'table' => $wpdb->prefix . 'wpforo_views', 'col' => 'topicid', 'check' => 'key_exists' );
	if( !wpforo_db_check( $args ) ){
		@$wpdb->query( "ALTER TABLE `".$wpdb->prefix."wpforo_views` ADD INDEX(`userid`);" );
		@$wpdb->query( "ALTER TABLE `".$wpdb->prefix."wpforo_views` ADD INDEX(`topicid`);" );
		@$wpdb->query( "ALTER TABLE `".$wpdb->prefix."wpforo_views` ADD UNIQUE( `userid`, `topicid`);" );
		@$wpdb->query( "ALTER TABLE `".$wpdb->prefix."wpforo_likes` ADD UNIQUE( `userid`, `postid`);" );
	}
	$args = array( 'table' => $wpdb->prefix . 'wpforo_views', 'col' => 'created', 'check' => 'col_type' );
	$col_type = wpforo_db_check( $args );
	if( $col_type != 'int(11)' ){
		@$wpdb->query( "ALTER TABLE `".$wpdb->prefix."wpforo_views` CHANGE `created` `created` INT(11) NOT NULL;" );
	}
	// ADD `status` field in TOPICS & POSTS TABLE  ///////////////////////////
	$args = array( 'table' => $wpdb->prefix . 'wpforo_topics', 'col' => 'status', 'check' => 'col_exists' );
	if( !wpforo_db_check( $args ) ){
		@$wpdb->query( "ALTER TABLE `".$wpdb->prefix."wpforo_topics` ADD `status` TINYINT(1) NOT NULL DEFAULT '0', ADD INDEX `status` (`status`);" );
		@$wpdb->query( "ALTER TABLE `".$wpdb->prefix."wpforo_topics` ADD INDEX `forumid_status` ( `forumid`, `status`);" );
		@$wpdb->query( "ALTER TABLE `".$wpdb->prefix."wpforo_posts` ADD `status` TINYINT(1) NOT NULL DEFAULT '0', ADD INDEX `status` (`status`);" );
		@$wpdb->query( "ALTER TABLE `".$wpdb->prefix."wpforo_posts` ADD INDEX `topicid_status` ( `topicid`, `status`);" );
	}
	// ADD `name` and `email` field in TOPIC TABLE  ///////////////////////////
	$args = array( 'table' => $wpdb->prefix . 'wpforo_topics', 'col' => 'name', 'check' => 'col_exists' );
	if( !wpforo_db_check( $args ) ){
		@$wpdb->query( "ALTER TABLE `" . $wpdb->prefix . "wpforo_topics` ADD `name` VARCHAR(50) NOT NULL  AFTER `status`,  ADD `email` VARCHAR(50) NOT NULL  AFTER `name`" );
		@$wpdb->query( "ALTER TABLE `" . $wpdb->prefix . "wpforo_posts` ADD `name` VARCHAR(50) NOT NULL  AFTER `status`,  ADD `email` VARCHAR(50) NOT NULL  AFTER `name`" );
		@$wpdb->query( "ALTER TABLE `" . $wpdb->prefix . "wpforo_topics` ADD KEY `email` (`email`)" );
		@$wpdb->query( "ALTER TABLE `" . $wpdb->prefix . "wpforo_posts` ADD KEY `email` (`email`)" );
	}
	// ADD `utitle`, `role` and `access` to USERGROUP TABLE  /////////
	$args = array( 'table' => $wpdb->prefix . 'wpforo_usergroups', 'col' => 'utitle', 'check' => 'col_exists' );
	if( !wpforo_db_check( $args ) ){
		@$wpdb->query( "ALTER TABLE `" . $wpdb->prefix . "wpforo_usergroups` ADD `utitle` VARCHAR(100), ADD `role` VARCHAR(50), ADD `access` VARCHAR(50)" );
		@$wpdb->query( "UPDATE `" . $wpdb->prefix . "wpforo_usergroups` SET `utitle` = 'Admin', `role` = 'administrator', `access` = 'full' WHERE `groupid` = 1");
		@$wpdb->query( "UPDATE `" . $wpdb->prefix . "wpforo_usergroups` SET `utitle` = 'Moderator', `role` = 'editor', `access` = 'moderator' WHERE `groupid` = 2");
		@$wpdb->query( "UPDATE `" . $wpdb->prefix . "wpforo_usergroups` SET `utitle` = 'Registered', `role` = 'subscriber', `access` = 'standard' WHERE `groupid` = 3");
		@$wpdb->query( "UPDATE `" . $wpdb->prefix . "wpforo_usergroups` SET `utitle` = 'Guest', `role` = '', `access` = 'read_only' WHERE `groupid` = 4");
		@$wpdb->query( "UPDATE `" . $wpdb->prefix . "wpforo_usergroups` SET `utitle` = 'Customer', `role` = 'customer', `access` = 'standard' WHERE `groupid` = 5");
		@$wpdb->query( "UPDATE `" . $wpdb->prefix . "wpforo_usergroups` SET `utitle` = 'name', `role` = 'subscriber', `access` = 'standard' WHERE `utitle` IS NULL OR `utitle` = ''");
	}
	#################################################################
	// ADD `private` field in post TABLE  ///////////////////////////
	$args = array( 'table' => $wpdb->prefix . 'wpforo_posts', 'col' => 'private', 'check' => 'col_exists' );
	if( !wpforo_db_check( $args ) ){
		@$wpdb->query( "ALTER TABLE `" . $wpdb->prefix . "wpforo_posts` ADD `private` TINYINT(1) NOT NULL DEFAULT '0' AFTER `email`, ADD INDEX `is_private` (`private`);" );
	}
	
	#################################################################
	// UPDATE VERSION - END /////////////////////////////////////////
	update_option('wpforo_version', WPFORO_VERSION);
	$wpforo->notice->clear();
	wpforo_clean_cache();
}


function wpforo_update() {
	if ( get_option('wpforo_version') && WPFORO_VERSION !== get_option('wpforo_version') ) wpforo_activation();
}
add_action('wp_loaded', 'wpforo_update');


function wpforo_update_options( $option_key, $default, $exlude = array() ) {
	
	$option = get_option( $option_key, array() );
	
	if( !empty($option) ){
		if( !empty($exlude) ){
			foreach( $exlude as $key ){
				if( isset($default[$key]) ) unset($default[$key]);
			}
		}
		$option_update = array_merge($default, $option);
	}
	else{
		$option_update = $default;
	}
	
	update_option( $option_key, $option_update );
}


function wpforo_deactivation() {}


function wpforo_uninstall() {	
	
	global $wpforo, $wpdb;
	
	if( ! wpforo_is_admin() ) return;
	if( ! current_user_can( 'activate_plugins' ) ) return;
	$QUERY_STRING = trim(preg_replace('|_wpnonce=[^\&\?\=]*|is', '', $_SERVER['QUERY_STRING']), '&');
	
	if( 'action=wpforo-uninstall' == trim($QUERY_STRING) ){

		$tables = array(    $wpdb->prefix . 'wpforo_accesses',
							$wpdb->prefix . 'wpforo_forums',
							$wpdb->prefix . 'wpforo_languages',
							$wpdb->prefix . 'wpforo_likes',
							$wpdb->prefix . 'wpforo_phrases',
							$wpdb->prefix . 'wpforo_profiles',
							$wpdb->prefix . 'wpforo_posts',
							$wpdb->prefix . 'wpforo_subscribes',
							$wpdb->prefix . 'wpforo_topics',
							$wpdb->prefix . 'wpforo_usergroups',
							$wpdb->prefix . 'wpforo_views',
							$wpdb->prefix . 'wpforo_visits',
							$wpdb->prefix . 'wpforo_votes');
		
		foreach($tables as $table){
			if( strpos( $table, '_wpforo_' ) !== FALSE){
				$sql = "DROP TABLE IF EXISTS `$table`;";
				$wpdb->query( $sql );
			}
		}
		
		if( isset($wpforo->pageid) && $wpforo->pageid ){
			wp_delete_post( $wpforo->pageid, true );
		}
		
		$options = array( 'wpforo_version',
						  'wpforo_url',
						  'wpforo_stat',
						  'wpforo_general_options',
						  'wpforo_pageid',
						  'wpforo_count_per_page',
						  'wpforo_default_groupid',
						  'wpforo_forum_options',
						  'wpforo_post_options',
						  'wpforo_member_options',
						  'wpforo_subscribe_options',
						  'wpforo_theme_options',
						  'wpforo_features',
						  'wpforo_style_options',
						  'wpforo_permastruct',
						  'wpforo_use_home_url',
						  'wpforo_excld_urls',
						  'wpforo_tools_antispam',
						  'wpforo_tools_cleanup'
		);
		 
		foreach($options as $option){
			if( strpos( $option, 'wpforo_' ) !== FALSE){
				delete_option( $option );
			}
		}
		
		$wpdb->query( "DELETE FROM `" . $wpdb->base_prefix ."usermeta` WHERE `meta_key` = '_wpf_member_obj'" );
		$wpdb->query( "DELETE FROM `" . $wpdb->prefix ."options` WHERE option_name LIKE 'widget_wpforo_widget_%'" );
		
		$menu = wp_get_nav_menu_object( 'wpforo-navigation' );
		wp_delete_nav_menu( $menu->term_id );
		wp_delete_post($wpforo->pageid, TRUE);
		
		deactivate_plugins( WPFORO_BASENAME );
		
	}
	else{
		return;
	}
}

function wpforo_profile_notice(){
	global $wpdb;
	$button = '';
	$users = $wpdb->get_var("SELECT COUNT(*) FROM `".$wpdb->base_prefix."usermeta` WHERE `meta_key` LIKE '".$wpdb->prefix."capabilities'");
	$profiles = $wpdb->get_var("SELECT COUNT(*) FROM `" . $wpdb->prefix . "wpforo_profiles`");
	$delta = $users - $profiles; 
	$status = ( $delta > 2 ) ? round((( $profiles * 100 ) / $users ), 1) . '% (' . $profiles . ' / ' . $users . ') ' : '100%';
	$btext = ( $profiles == 0 ) ? __( 'Start Profile Synchronization', 'wpforo') : __( 'Continue Synchronization', 'wpforo');
	$url = admin_url('admin.php?page=wpforo-community&action=synch');
	$class = 'wpforo-mnote notice notice-warning is-dismissible';
	$note = __( 'This process may take a few seconds or dozens of minutes, please be patient and don\'t close this page.', 'wpforo');
	$info = __( 'You can permanently disable this message in Dashboard > Forums > Features admin page.', 'wpforo');
	$button = '<a href="' . $url . '" class="button button-primary button-large" style="font-size:14px;">' . $btext . ' &gt;&gt;</a>';
	$header = __( 'wpForo Forum Installation | ', 'wpforo' );
	$message = __( 'Forum users\' profile data are not synchronized yet, this step is required! Please click the button below to complete installation.', 'wpforo' );
	echo '<div class="' . $class . '" style="padding:15px 20px;"><h2 style="margin:0px;">' . esc_html($header) . $status . ' </h2><p style="font-size:15px;margin:5px 0px;">' . $message . '</p><p style="margin:0px 0px 10px 0px;">' . $button . '</p><hr /><p style="margin:0px;color:#dd0000;">' . $note . '</p><p style="margin:0px;color:#999; font-size:12px;">' . $info . '</p></div>'; 	
}

function wpforo_update_db_notice(){
	global $wpforo, $wpdb;
	$private_topics = $wpdb->get_var("SELECT `topicid` FROM `" . $wpdb->prefix . "wpforo_topics` WHERE `private` = 1");
	if( $private_topics ){
		$private_posts = $wpdb->get_var("SELECT `postid` FROM `" . $wpdb->prefix . "wpforo_posts` WHERE `private` = 1");
		if( !$private_posts ){
			$url = admin_url('admin.php?page=wpforo-community&action=wpfdb&wpfv=142');
			$class = 'wpforo-mnote notice notice-warning is-dismissible';
			$note = __( 'This process may take a few seconds or dozens of minutes, please be patient and don\'t close this page. Database backup is not required. If you got 500 Server Error please don\'t worry, the data updating process is still working in MySQL server.', 'wpforo');
			$button = '<a href="' . $url . '" class="button button-primary button-large" style="font-size:14px;">' . __( 'Updater Database', 'wpforo') . ' &gt;&gt;</a>';
			$header = __( 'wpForo - Update Database ', 'wpforo' );
			$message = __( 'Please click the button below to complete wpForo update.', 'wpforo' );
			echo '<div class="' . $class . '" style="padding:15px 20px;"><h2 style="margin:0px;">' . esc_html($header) . ' </h2><p style="font-size:15px;margin:5px 0px;">' . $message . '</p><p style="margin:0px 0px 10px 0px;">' . $button . '</p><hr /><p style="margin:0px;color:#ed7600;">' . $note . '</p></div>'; 	

		}
	}
}

function wpforo_update_db(){
    global $wpforo, $wpdb;
	// ADD posts' private values from TOPICS table ///////////////////////////
	@$wpdb->query( "UPDATE `" . $wpdb->prefix . "wpforo_posts`, `" . $wpdb->prefix . "wpforo_topics` SET `" . $wpdb->prefix . "wpforo_posts`.`private` = `" . $wpdb->prefix . "wpforo_topics`.`private` WHERE `" . $wpdb->prefix . "wpforo_posts`.`topicid` = `" . $wpdb->prefix . "wpforo_topics`.`topicid`");
	// ADD INDEXES in wpforo_views TABLE///////////////////////////
	$args = array( 'table' => $wpdb->prefix . 'wpforo_views', 'col' => 'topicid', 'check' => 'key_exists' );
	if( !wpforo_db_check( $args ) ){
		@$wpdb->query( "ALTER TABLE `".$wpdb->prefix."wpforo_views` ADD INDEX(`userid`);" );
		@$wpdb->query( "ALTER TABLE `".$wpdb->prefix."wpforo_views` ADD INDEX(`topicid`);" );
		@$wpdb->query( "ALTER TABLE `".$wpdb->prefix."wpforo_views` ADD UNIQUE( `userid`, `topicid`);" );
		@$wpdb->query( "ALTER TABLE `".$wpdb->prefix."wpforo_likes` ADD UNIQUE( `userid`, `postid`);" );
	}
	update_option('wpforo_version_db', WPFORO_VERSION);
}
