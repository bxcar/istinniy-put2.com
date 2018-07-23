<?php 

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * 
 * Data access layer for WC Fields Factory
 * 
 * @author Saravana Kumar K
 * @copyright Sarkware Pvt Ltd
 *
 */
class Wcff_Dao {
	
	/* Namespace for WCFF related post meta
     * "wccpf_" for Custom product page Fields ( Front end product page )
     * "wccaf_" for Custom admin page fields ( for Admin Products )
     * "wccsf_" for Custom admin page fields ( for Sub group Fields )
     * "wccrf_" for Custom admin page fields ( for Repeater Fields )
     * "wcccf_" for Custom admin page fields ( for Checkout Fields )
     *  */
	private $wcff_key_prefix = "wccpf_";
	
	/* Holds all the supported field's specific configuration meta */
	private $fields_meta = array();
	
	/* Holds all the configuration meta that are common to all fields ( both Product as well as Admin ) */
	private $common_meta = array();
	
	/* Holds all the configuration meta that are common to Admin Fields */
	private $wccaf_common_meta = array();
	
	public function __construct() {
	    /* Wordpress's Save Post action hook
	     * This is where we would save all the rules for the Fields Group ( post ) that is being saved */
	    add_action( 'save_post', array( $this, 'on_save_post' ), 1, 3 );
	}
	
	/**
	 * 
	 * Set the current post type properties,<br/>
	 * based on this only all the subsequent fields related operation will happen<br/>
	 * this option could be either 'wccpf' for product fields or 'wccaf' for admin fields. 
	 * 
	 * @param string $_type
	 * 
	 */
	public function set_current_post_type( $_type = "wccpf" ) {		
		$this->wcff_key_prefix = $_type . "_";		
	}
	
	/**
	 * 
	 * Return the Fields config meta for Factory View<br/>
	 * Contains entire (specific to each fields) config meta list for each field type.
	 * 
	 * @return array
	 * 
	 */
	public function get_fields_meta() {
		/* Make sure the meta is loaded */
		$this->load_core_meta();
		return $this->fields_meta;
	}
	
	/**
	 * 
	 * Return the Fields config common meta for Factory View<br/>
	 * Contains entire (common for all fields) config meta list for each field type.
	 * 
	 * @return array
	 * 
	 */
	public function get_fields_common_meta() {
		/* Make sure the meta is loaded */
		$this->load_core_meta();
		return $this->common_meta;
	}
	
	/**
	 *
	 * Return the Admin Fields config common meta for Factory View<br/>
	 * Contains entire (common for all admin fields) config meta list for each field type.
	 *
	 * @return array
	 *
	 */
	public function get_admin_fields_comman_meta() {
		/* Make sure the meta is loaded */
		$this->load_core_meta();
		return $this->wccaf_common_meta;
	}
	
	/**
	 *
	 * Loads Fields configuration meta from the file system<br>
	 * Fields specific configuration meta from 'meta/wcff-meta.php'<br>
	 * Common configuration meta from 'meta/wcff-common-meta.php'<br>
	 * Common admin configuration meta from 'meta/wcff-common-wccaf-meta.php'
	 *
	 */
	private function load_core_meta() {
		/* Load core fields config meta */
		if ( ! is_array( $this->fields_meta ) || empty( $this->fields_meta ) ) {
			$this->fields_meta = include( 'meta/wcff-meta.php' );
		}
		/* Load common config meta for all fields */
		if ( ! is_array( $this->common_meta ) || empty( $this->common_meta ) ) {
			$this->common_meta = include( 'meta/wcff-common-meta.php' );
		}
		/* Load common config meta for admin fields */
		if ( ! is_array( $this->wccaf_common_meta ) || empty( $this->wccaf_common_meta ) ) {
			$this->wccaf_common_meta = include( 'meta/wcff-common-wccaf-meta.php' );
		}
	}
	
	/**
	 *
	 * Called whenever user 'Update' or 'Save' post from wp-admin single post view<br/>
	 * This is where the various (Product, Cat, Location ... ) rules for the fields group will be stored in their respective post meta.
	 *
	 * @param integer $_pid
	 * @param WP_Post $_post
	 * @param boolean $_update
	 * @return void|boolean
	 *
	 */
	public function on_save_post( $_pid = 0, $_post, $_update ) {			
		/* Maje sure the post types are valid */
		if ( ! $_pid || ! $_post || ( $_post->post_type != "wccpf" && $_post->post_type != "wccaf" ) ) {
			return false;
		}
		
		$_pid = absint( $_pid );
		
		/* Prepare the post type prefix for meta key */
		$this->wcff_key_prefix = $_post->post_type . "_";
		
		/* Conditional rules - determine which fields group belongs to which products */
		if ( isset( $_REQUEST[ "wcff_condition_rules" ] ) ) {
			delete_post_meta( $_pid, $this->wcff_key_prefix.'condition_rules' );
			add_post_meta( $_pid, $this->wcff_key_prefix.'condition_rules', $_REQUEST[ "wcff_condition_rules" ] );
		}
		
		/* Location rules - specific to Admin Fields */
		if ( isset( $_REQUEST[ "wcff_location_rules" ] ) ) {
			delete_post_meta( $_pid, $this->wcff_key_prefix.'location_rules' );
			add_post_meta( $_pid, $this->wcff_key_prefix.'location_rules', $_REQUEST[ "wcff_location_rules" ] );
		}
		
		/* Update the fields order */
		$this->update_fields_order( $_pid );
		
		return true;		
	}
	
	/**
	 * 
	 * Update the fields sequence order properties for all fields on a given group (represented by $_pid)<br/>
	 * Called when Fields Group got saved or updated.
	 * 
	 * @param integer $_pid
	 * @return boolean
	 * 
	 */
	public function update_fields_order( $_pid = 0 ) {		
	    $fields = $this->load_fields( $_pid, false );
	    /* Update each fields order property */
		foreach ( $fields as $key => $field ) {
			if (isset($_REQUEST[ $key."_order" ])) {
				$field[ "order" ] = $_REQUEST[ $key."_order" ];
				update_post_meta( $_pid, $key, wp_slash( json_encode( $field ) ) );
			}			
		}
		
		return true;		
	}
	
	/**
	 * 
	 * Load conditional rules for given Fields Group Post
	 * 
	 * @param integer $_pid
	 * @return mixed
	 * 
	 */
	public function load_condition_rules( $_pid = 0 ) {		
		$_pid = absint( $_pid );
		/* Since we have renamed 'group_rules' meta as 'condition_rules' we need to make sure it is upto date
		 * and we remove the old 'group_rules' meta as well
		 **/
		$rules = get_post_meta( $_pid, $this->wcff_key_prefix.'group_rules', true );
		if ( $rules && $rules != "" ) {
			delete_post_meta( $_pid, $this->wcff_key_prefix.'group_rules' );
			update_post_meta( $_pid, $this->wcff_key_prefix.'condition_rules', $rules );
		}		
		$condition = get_post_meta( $_pid, $this->wcff_key_prefix.'condition_rules', true );
		
		return apply_filters( 'wcff_condition_rules', $condition, $_pid );		
	}
	
	/**
	 * 
	 * Load locational rules for given Admin Fields Group Post 
	 * 
	 * @param integer $_pid
	 * @return mixed
	 * 
	 */
	public function load_location_rules( $_pid = 0 ) {
		$_pid = absint( $_pid );
		$location = get_post_meta( $_pid, $this->wcff_key_prefix.'location_rules', true );		
		return apply_filters( 'wcff_location_rules', $location, $_pid );		
	}
	
	/**
	 * 
	 * Load locational rules for entire admin fields posts
	 * 
	 * @return mixed
	 * 
	 */
	public function load_all_location_rules() {		
		$location_rules = array();
		$wcffs = get_posts( array (
			'post_type' => "wccaf",
			'posts_per_page' => -1,
			'order' => 'ASC' )
		);
		if ( count( $wcffs ) > 0 ) {
			foreach ( $wcffs as $wcff ) {
				$temp_rules = get_post_meta( $wcff->ID, 'wccaf_location_rules', true );
				$temp_rules = json_decode( $temp_rules, true );
				$location_rules = array_merge( $location_rules, $temp_rules );
			}
		}
		
		return apply_filters( 'wcff_all_location_rules', $location_rules );		
	}
	
	/**
	 * 
	 * Used to load all woocommerce products<br/>
	 * Used in "Conditions" Widget
	 * 
	 * @return 	ARRAY of products ( ids & titles )
	 * 
	 */
	public function load_products() {		
		$productsList = array();
		$products = get_posts( array (
			'post_type' => 'product',
			'posts_per_page' => -1,
			'order' => 'ASC')
		);
		
		if ( count( $products ) > 0 ) {
			foreach ( $products as $product ) {
				$productsList[] = array( "id" => $product->ID, "title" => $product->post_title );
			}
		}
		
		return apply_filters( 'wcff_products', $productsList );		
	}
	
	/**
	 *
	 * Used to load all woocommerce products<br/>
	 * Used in "Conditions" Widget
	 *
	 * @return 	ARRAY of products ( ids & titles )
	 *
	 */
	public function load_products_with_variation() {
		$productsList = array();
		$products = get_posts( array (
				'post_type' => 'product',
				'posts_per_page' => -1,
				'order' => 'ASC')
				);
	
		if ( count( $products ) > 0 ) {
			foreach ( $products as $product ) {
				$product_ob = array();
				if ( version_compare( WC()->version, '2.2.0', '<' ) ) {
					$product_ob    = get_product( $product->ID );
				} else {
					$product_ob    = wc_get_product( $product->ID );
				}
				if( $product_ob->is_type( 'variable' ) ){
					$productsList[] = array( "id" => $product->ID, "title" => $product->post_title );
				}
			}
		}
	
		return apply_filters( 'wcff_products_with_variation', $productsList );
	}
	
	/**
	 * 
	 * Used to load all woocommerce product category<br/>
	 * Used in "Conditions" Widget
	 * 
	 * @return 	ARRAY of product categories ( ids & titles )
	 * 
	 */
	public function load_product_cats() {		
		$product_cats = array();
		$pcat_terms = get_terms( 'product_cat', 'orderby=count&hide_empty=0' );
		
		foreach( $pcat_terms as $pterm ) {
			$product_cats[] = array( "id" => $pterm->slug, "title" => $pterm->name );
		}
		
		return apply_filters( 'wcff_product_categories', $product_cats );		
	}
	
	/**
	 * 
	 * Used to load all woocommerce product tags<br/>
	 * Used in "Conditions" Widget
	 * 
	 * @return 	ARRAY of product tags ( ids & titles )
	 * 
	 */
	public function load_product_tags() {		
		$product_tags = array();
		$ptag_terms = get_terms( 'product_tag', 'orderby=count&hide_empty=0' );
		
		foreach( $ptag_terms as $pterm ) {
			$product_tags[] = array( "id" => $pterm->slug, "title" => $pterm->name );
		}
		
		return apply_filters( 'wcff_product_tags', $product_tags );		
	}
	
	/**
	 * 
	 * Used to load all woocommerce product types<br/>
	 * Used in "Conditions" Widget
	 * 
	 * @return 	ARRAY of product types ( slugs & titles )
	 * 
	 */
	public function load_product_types() {		
		$product_types = array();
		$all_types = array (
			'simple'   => __( 'Simple product', 'woocommerce' ),
			'grouped'  => __( 'Grouped product', 'woocommerce' ),
			'external' => __( 'External/Affiliate product', 'woocommerce' ),
			'variable' => __( 'Variable product', 'woocommerce' )
		);
		
		foreach ( $all_types as $key => $value ) {
			$product_types[] = array( "id" => $key, "title" => $value );
		}
		
		return apply_filters( 'wcff_product_types', $product_types );		
	}
	
	/**
	 *
	 * Used to load all woocommerce product types<br/>
	 * Used in "Conditions" Widget
	 *
	 * @return 	ARRAY of product types ( slugs & titles )
	 *
	 */
	public function load_product_variations( $parent = 0 ) {
		$products_variation_list = array();
		$variations = array();
		$arg = array (
				'post_type' => 'product_variation',
				'posts_per_page' => -1,
				'order' => 'ASC' );
		if( $parent != 0 ){
			$arg['post_parent']  = $parent;
		}
		$variations = get_posts( $arg); 
		foreach ( $variations as $product ) {
			$products_variation_list[] = array( "id" => $product->ID, "title" => $product->post_title );
		}
		return apply_filters( 'wcff_product_variation', $products_variation_list );		
	}
	
	/**
	 * 
	 * Used to load all woocommerce product tabs<br/>
	 * Used in "Location" Widget
	 * 
	 * @return 	ARRAY of product tabs ( titles & tab slugs )
	 * 
	 */
	public function load_product_tabs() {		
		$tabs = array (
			"General Tab" => "woocommerce_product_options_general_product_data",
			"Inventory Tab" => "woocommerce_product_options_inventory_product_data",
			"Shipping Tab" => "woocommerce_product_options_shipping",
			"Attributes Tab" => "woocommerce_product_options_attributes",
			"Related Tab" => "woocommerce_product_options_related",
			"Advanced Tab" => "woocommerce_product_options_advanced",
			"Variable Tab" => "woocommerce_product_after_variable_attributes"
		);
		
		return apply_filters( 'wcff_product_tabs', $tabs );		
	}
	
	/**
	 * 
	 * Used to load all wp context used for meta box<br/>
	 * Used for laying Admin Fields
	 * 
	 * @return 	ARRAY of meta contexts ( slugs & titles )
	 * 	
	 */
	public function load_metabox_contexts() {		
		$contexts = array (
			"normal" => "Normal",
			"advanced" => "Advanced",
			"side" => "Side"
		);
		
		return apply_filters( 'wcff_metabox_contexts', $contexts );		
	}
	
	/**
	 * 
	 * Used to load all wp priorities used for meta box<br/>
	 * Used for laying Admin Fields
	 * 
	 * @return 	ARRAY of meta priorities ( slugs & titles )
	 * 
	 */
	public function load_metabox_priorities() {		
		$priorities = array (
			"low" => "Low",
			"high" => "High",
			"core" => "Core",
			"default" => "Default"
		);
		
		return apply_filters( 'wcff_metabox_priorities', $priorities );		
	}
	
	/**
	 * 
	 * Used to load all woocommerce form fields validation types, to built Checkout Fields
	 * 
	 * @return ARRAY of validation types
	 * 
	 */
	public function load_wcccf_validation_types() {
		return apply_filters( 'wcccf_validation_types', array (
			"required" => "Required",
			"phone" => "Phone",
			"email" => "Email",
			"postcode" => "Post Code"
		) );
	}
	
	/**
	 *
	 * This function is used to load all wcff fields (actualy post meta) for a single WCFF post<br/>
	 * Mostly used in editing wccpf fields in admin screen
	 *
	 * @param 	integer	$pid	- WCFF Post Id
	 * @param   boolean	$sort   - Whether returning fields should be sorted
	 * @param   string $type   - Type of fields ( wccpf, wccaf ... )
	 * @return 	array
	 *
	 */
	public function load_fields( $_pid = 0, $_sort = true ) {		
		$fields = array();
		$_pid = absint( $_pid );
		$meta = get_post_meta( $_pid);
		foreach ( $meta as $key => $val ) {
			if ( preg_match( '/'. $this->wcff_key_prefix . '/', $key ) ) {
				if ( $key != $this->wcff_key_prefix . 'condition_rules' &&
					$key != $this->wcff_key_prefix . 'location_rules' &&
					$key != $this->wcff_key_prefix . 'group_rules' &&
					$key != $this->wcff_key_prefix . 'pricing_rules' &&
					$key != $this->wcff_key_prefix . 'fee_rules' &&
					$key != $this->wcff_key_prefix . 'field_rules' &&
					$key != $this->wcff_key_prefix . 'sub_fields_group_rules' ) {
					$fields[ $key ] = json_decode( $val[0], true );
				}
			}
		}
		
		if ( $_sort ) {
			$this->usort_by_column( $fields, "order" );
		}
		
		return apply_filters( 'wcff_fields', $fields, $_pid, $_sort );		
	}
	
	/**
	 * 
	 * Loads all fields of the given Fields Group Post
	 * 
	 * @param number $_pid
	 * @param string $_mkey
	 * @return mixed
	 * 
	 */
	public function load_field( $_pid = 0, $_mkey = "" ) {	
		$_pid = absint( $_pid );
		$field = get_post_meta( $_pid, $_mkey, true );
		return apply_filters( 'wcff_field', $field, $_pid, $_mkey );		
	}
	
	/**
	 * 
	 * Save the given field's config meta as the post meta on a given Fields Group Post.  
	 * 
	 * @param number $_pid
	 * @param object $_payload
	 * @return number|false
	 * 
	 */
	public function save_field( $_pid = 0, $_payload ) {	
		$_pid = absint( $_pid );
		$_payload= apply_filters( 'wcff_before_save_field', $_payload, $_pid );		
		if ( ! isset( $_payload[ "name" ] ) || $_payload[ "name" ] == "_" || $_payload[ "name" ] == "" ) {
			$_payload[ "name" ] = $this->url_slug( $_payload[ "label" ], array( 'delimiter' => '_' ) );
		}
		
		return add_post_meta( $_pid, $this->wcff_key_prefix . $_payload[ "name" ], wp_slash( json_encode( $_payload ) ) );		
	}
	
	/**
	 * 
	 * Update the given field's config meta as the post meta on a given Fields Group Post.
	 * 
	 * @param number $_pid
	 * @param object $_payload
	 * @return number|boolean
	 * 
	 */
	public function update_field($_pid = 0, $_payload) {	
		$_pid = absint( $_pid );
		$_payload = apply_filters( 'wcff_before_update_field', $_payload, $_pid );		
		if ( ! isset( $_payload[ "key" ] ) || $_payload[ "name" ] == "_" || $_payload[ "key" ] == "" ) {
			$_payload[ "key" ] = $this->url_slug( $_payload[ "label" ], array( 'delimiter' => '_' ) );
		}
		
		return update_post_meta( $_pid, $_payload[ "key" ], wp_slash( json_encode( $_payload ) ) );		
	}
	
	/**
	 * 
	 * Remove the given field from Fields Group Post
	 * 
	 * @param number $_pid
	 * @param string $_mkey
	 * @return boolean
	 * 
	 */
	public function remove_field( $_pid = 0, $_mkey ) {
		$_pid = absint( $_pid );
		$mkey = apply_filters( 'wcff_before_remove_field', $_mkey, $_pid );
		return delete_post_meta( $_pid, $_mkey );		
	}
	
	/**
	 *
	 * This function is used to Load all WCCPF groups. which is used by "wccpf_product_form" module<br/>
	 * to render actual wccpf fields on the Product Page.
	 *
	 * @param 	integer	$pid	- Product Id
	 * @param   string $type   - Type of fields ( wccpf, wccaf ... )
	 * @return 	array ( Two Dimentional )
	 * 
	 */
	public function load_fields_for_product( $_pid, $_type = "wccpf", $_location = "product-page" ) {		
		$fields = array();
		$all_fields = array();
		$this->wcff_key_prefix = $_type . "_";
		
		$wcffs = get_posts( array (
			'post_type' => $_type,
			'posts_per_page' => -1,
			'order' => 'ASC' )
		);
		
		$_pid = absint( $_pid );
		
		if ( count( $wcffs ) > 0 ) {
			foreach ( $wcffs as $wcff ) {
				$fields = array();
				$crules_applicable = false;
				$lrules_applicable = true;
				
				$meta = get_post_meta( $wcff->ID );
				$condition_rules = $this->load_condition_rules( $wcff->ID );
				$condition_rules = json_decode( $condition_rules, true );
				
				if ( is_array( $condition_rules ) ) {
					$crules_applicable = $this->check_for_product( $_pid, $condition_rules, $_location );
				} else {
					$crules_applicable = true;
				}
				if ( $_type == "wccaf" ) {
					$old_location = $_location == "cart-page" ? "any" :  $_location;
					$location_rules = get_post_meta( $wcff->ID, $this->wcff_key_prefix . 'location_rules', true );
					$location_rules = json_decode( $location_rules, true );
					if ( is_array( $location_rules ) && $old_location != "any" ) {
						$lrules_applicable = $this->check_for_location( $_pid, $location_rules, $old_location );
					} else {
						$lrules_applicable = true;
					}
				}
				
				if ( $crules_applicable && $lrules_applicable ) {
					foreach ( $meta as $key => $val ) {
						if ( preg_match( '/' . $this->wcff_key_prefix . '/', $key ) ) {
							if ( $key != $this->wcff_key_prefix . 'condition_rules' &&
								$key != $this->wcff_key_prefix . 'location_rules' &&
								$key != $this->wcff_key_prefix . 'group_rules' &&
								$key != $this->wcff_key_prefix . 'pricing_rules' &&
								$key != $this->wcff_key_prefix . 'fee_rules' &&
								$key != $this->wcff_key_prefix . 'field_rules' &&
								$key != $this->wcff_key_prefix . 'sub_fields_group_rules' ) {
								$fields[ $key ] = json_decode( $val[0], true );
							}
						}
					}
					$this->usort_by_column( $fields, "order" );
					$all_fields[] = $fields;
				}
			}
		}
		return apply_filters( 'wcff_fields_for_product', $all_fields, $_pid, $_type, $_location );		
	}
	
	/**
	 * 
	 * WCFF Condition Rules Engine, This is function used to determine whether or not to include<br/>
	 * a particular wccpf group fields to a particular Product
	 * 
	 * @param 	integer		$_pid	- Product Id
	 * @param 	array 		$_groups
	 * @return 	boolean
	 * 
	 */
	public function check_for_product( $_pid, $_groups, $location = "product-page" ) {
		$matches = array();
		$final_matches = array();
		foreach ( $_groups as $rules ) {
			$ands = array();
			foreach ( $rules as $rule ) {
				if(  $rule[ "context" ] != "product_variation" && ( wcff()->request["context"] == "wcff_variation_fields" || $location == "cart-page" )  ){
					return false;
				}
				if ( $rule[ "context" ] == "product" ) {
					if ( $rule[ "endpoint" ] == -1 ) {
						$ands[] = ( $rule[ "logic" ] == "==" );
					} else {
						if ( $rule[ "logic" ] == "==" ) {
							$ands[] = ( $_pid == $rule[ "endpoint" ] );
						} else {
							$ands[] = ( $_pid != $rule[ "endpoint" ] );
						}
					}
				} else if($rule[ "context" ] == "product_variation"){
					if ( $rule[ "endpoint" ] == -1 ) {
						if( get_post_type( $_pid ) == "product_variation" ){
							$ands[] = ( $rule[ "logic" ] == "==" );
						} else {
							$ands[] = false;
						}
					} else {
						if ( $rule[ "logic" ] == "==" ) {
							if( get_post_type( $_pid ) == "product_variation" ){
								$ands[] = ( $_pid == $rule[ "endpoint" ] );
							} else {
								$ands[] = false;
							}
						} else {
							if( get_post_type( $_pid ) == "product_variation" ){
								$ands[] = ( $_pid != $rule[ "endpoint" ] );
							} else {
								$ands[] = false;
							}
						}
					}
				} else if ( $rule[ "context" ] == "product_cat" ) {
					if ( $rule[ "endpoint" ] == -1 ) {
						$ands[] = ( $rule[ "logic" ] == "==" );
					} else {
						if ( $rule[ "logic" ] == "==" ) {
							$ands[] = has_term( $rule[ "endpoint" ], 'product_cat', $_pid );
						} else {
							$ands[] = !has_term( $rule[ "endpoint" ], 'product_cat', $_pid );
						}
					}
				}  else if ( $rule[ "context" ] == "product_tag" ) {
					if ( $rule[ "endpoint" ] == -1 ) {
						$ands[] = ( $rule[ "logic" ] == "==" );
					} else {
						if ( $rule[ "logic" ] == "==" ) {
							$ands[] = has_term( $rule[ "endpoint" ], 'product_tag', $_pid );
						} else {
							$ands[] = !has_term( $rule[ "endpoint" ], 'product_tag', $_pid );
						}
					}
				}  else if ( $rule[ "context" ] == "product_type" ) {
					if ( $rule[ "endpoint" ] == -1 ) {
						$ands[] = ( $rule[ "logic" ] == "==" );
					} else {
						$ptype = wp_get_object_terms( $_pid, 'product_type' );
						$ands[] = ( $ptype[0]->slug == $rule[ "endpoint" ] );
					}
				} 
			}
			$matches[] = $ands;
		}
		
		foreach ( $matches as $match ) {
			$final_matches[] = ! in_array( false, $match );
		}
		
		return in_array( true, $final_matches );
	}
	
	/**
	 * 
	 * WCFF Location Rules Engine, This is function used to determine where does the  particular wccaf fields group<br/>
	 * to be placed. in the product view, product cat view or one of any product data sections ( Tabs )<br/>
	 * applicable only for wccaf post_type.
	 * 
	 * @param integer $_pid
	 * @param array	$_groups
	 * @param string $_location
	 *
	 */
	public function check_for_location( $_pid, $_groups, $_location, $product_cart_page = "product-page" ) {
		foreach ($_groups as $rules) {
			foreach ($rules as $rule) {
				
				if ($rule["context"] == "location_product_data") {
					if ($rule["endpoint"] == $_location && $rule["logic"] == "==") {
						return true;
					}
				}
				if ($rule["context"] == "location_product" && $_location == "admin_head-post.php") {
					return true;
				}
				if ($rule["context"] == "location_product_cat" && ($_location == "product_cat_add_form_fields" || $_location == "product_cat_edit_form_fields"))  {
					return true;
				}
			}
		}
		
		return false;
	}
	
	/**
	 * 
	 * Order the array for the given property.
	 * 
	 * @param array $_arr
	 * @param string $_col
	 * @param string $_dir
	 * 
	 */
	public function usort_by_column(&$_arr, $_col, $_dir = SORT_ASC) {		
		$sort_col = array();
		foreach ($_arr as $key=> $row) {
			$sort_col[$key] = $row[$_col];
		}
		array_multisort( $sort_col, $_dir, $_arr);		
	}
	
	/**
	 * 
	 * Create a web friendly URL slug from a string.
	 *
	 * @author Sean Murphy <sean@iamseanmurphy.com>
	 * @copyright Copyright 2012 Sean Murphy. All rights reserved.
	 * @license http://creativecommons.org/publicdomain/zero/1.0/
	 *
	 * @param string $str
	 * @param array $options
	 * @return string
	 * 
	 */
	function url_slug( $_str, $_options = array() ) {
		
		// Make sure string is in UTF-8 and strip invalid UTF-8 characters
		$_str = mb_convert_encoding( ( string ) $_str, 'UTF-8', mb_list_encodings() );
		
		$defaults = array (
			'delimiter' => '-',
			'limit' => null,
			'lowercase' => true,
			'replacements' => array(),
			'transliterate' => false,
		);
		
		// Merge options
		$_options = array_merge( $defaults, $_options );
		
		$char_map = array (
			// Latin
			'Ãƒâ‚¬' => 'A', 'Ãƒï¿½' => 'A', 'Ãƒâ€š' => 'A', 'ÃƒÆ’' => 'A', 'Ãƒâ€ž' => 'A', 'Ãƒâ€¦' => 'A', 'Ãƒâ€ ' => 'AE', 'Ãƒâ€¡' => 'C',
			'ÃƒË†' => 'E', 'Ãƒâ€°' => 'E', 'ÃƒÅ ' => 'E', 'Ãƒâ€¹' => 'E', 'ÃƒÅ’' => 'I', 'Ãƒï¿½' => 'I', 'ÃƒÅ½' => 'I', 'Ãƒï¿½' => 'I',
			'Ãƒï¿½' => 'D', 'Ãƒâ€˜' => 'N', 'Ãƒâ€™' => 'O', 'Ãƒâ€œ' => 'O', 'Ãƒâ€�' => 'O', 'Ãƒâ€¢' => 'O', 'Ãƒâ€“' => 'O', 'Ã…ï¿½' => 'O',
			'ÃƒËœ' => 'O', 'Ãƒâ„¢' => 'U', 'ÃƒÅ¡' => 'U', 'Ãƒâ€º' => 'U', 'ÃƒÅ“' => 'U', 'Ã…Â°' => 'U', 'Ãƒï¿½' => 'Y', 'ÃƒÅ¾' => 'TH',
			'ÃƒÅ¸' => 'ss',
			'ÃƒÂ ' => 'a', 'ÃƒÂ¡' => 'a', 'ÃƒÂ¢' => 'a', 'ÃƒÂ£' => 'a', 'ÃƒÂ¤' => 'a', 'ÃƒÂ¥' => 'a', 'ÃƒÂ¦' => 'ae', 'ÃƒÂ§' => 'c',
			'ÃƒÂ¨' => 'e', 'ÃƒÂ©' => 'e', 'ÃƒÂª' => 'e', 'ÃƒÂ«' => 'e', 'ÃƒÂ¬' => 'i', 'ÃƒÂ­' => 'i', 'ÃƒÂ®' => 'i', 'ÃƒÂ¯' => 'i',
			'ÃƒÂ°' => 'd', 'ÃƒÂ±' => 'n', 'ÃƒÂ²' => 'o', 'ÃƒÂ³' => 'o', 'ÃƒÂ´' => 'o', 'ÃƒÂµ' => 'o', 'ÃƒÂ¶' => 'o', 'Ã…â€˜' => 'o',
			'ÃƒÂ¸' => 'o', 'ÃƒÂ¹' => 'u', 'ÃƒÂº' => 'u', 'ÃƒÂ»' => 'u', 'ÃƒÂ¼' => 'u', 'Ã…Â±' => 'u', 'ÃƒÂ½' => 'y', 'ÃƒÂ¾' => 'th',
			'ÃƒÂ¿' => 'y',
			// Latin symbols
			'Ã‚Â©' => '(c)',
			// Greek
			'ÃŽâ€˜' => 'A', 'ÃŽâ€™' => 'B', 'ÃŽâ€œ' => 'G', 'ÃŽâ€�' => 'D', 'ÃŽâ€¢' => 'E', 'ÃŽâ€“' => 'Z', 'ÃŽâ€”' => 'H', 'ÃŽËœ' => '8',
			'ÃŽâ„¢' => 'I', 'ÃŽÅ¡' => 'K', 'ÃŽâ€º' => 'L', 'ÃŽÅ“' => 'M', 'ÃŽï¿½' => 'N', 'ÃŽÅ¾' => '3', 'ÃŽÅ¸' => 'O', 'ÃŽÂ ' => 'P',
			'ÃŽÂ¡' => 'R', 'ÃŽÂ£' => 'S', 'ÃŽÂ¤' => 'T', 'ÃŽÂ¥' => 'Y', 'ÃŽÂ¦' => 'F', 'ÃŽÂ§' => 'X', 'ÃŽÂ¨' => 'PS', 'ÃŽÂ©' => 'W',
			'ÃŽâ€ ' => 'A', 'ÃŽË†' => 'E', 'ÃŽÅ ' => 'I', 'ÃŽÅ’' => 'O', 'ÃŽÅ½' => 'Y', 'ÃŽâ€°' => 'H', 'ÃŽï¿½' => 'W', 'ÃŽÂª' => 'I',
			'ÃŽÂ«' => 'Y',
			'ÃŽÂ±' => 'a', 'ÃŽÂ²' => 'b', 'ÃŽÂ³' => 'g', 'ÃŽÂ´' => 'd', 'ÃŽÂµ' => 'e', 'ÃŽÂ¶' => 'z', 'ÃŽÂ·' => 'h', 'ÃŽÂ¸' => '8',
			'ÃŽÂ¹' => 'i', 'ÃŽÂº' => 'k', 'ÃŽÂ»' => 'l', 'ÃŽÂ¼' => 'm', 'ÃŽÂ½' => 'n', 'ÃŽÂ¾' => '3', 'ÃŽÂ¿' => 'o', 'Ã�â‚¬' => 'p',
			'Ã�ï¿½' => 'r', 'Ã�Æ’' => 's', 'Ã�â€ž' => 't', 'Ã�â€¦' => 'y', 'Ã�â€ ' => 'f', 'Ã�â€¡' => 'x', 'Ã�Ë†' => 'ps', 'Ã�â€°' => 'w',
			'ÃŽÂ¬' => 'a', 'ÃŽÂ­' => 'e', 'ÃŽÂ¯' => 'i', 'Ã�Å’' => 'o', 'Ã�ï¿½' => 'y', 'ÃŽÂ®' => 'h', 'Ã�Å½' => 'w', 'Ã�â€š' => 's',
			'Ã�Å ' => 'i', 'ÃŽÂ°' => 'y', 'Ã�â€¹' => 'y', 'ÃŽï¿½' => 'i',
			// Turkish
			'Ã…Å¾' => 'S', 'Ã„Â°' => 'I', 'Ãƒâ€¡' => 'C', 'ÃƒÅ“' => 'U', 'Ãƒâ€“' => 'O', 'Ã„Å¾' => 'G',
			'Ã…Å¸' => 's', 'Ã„Â±' => 'i', 'ÃƒÂ§' => 'c', 'ÃƒÂ¼' => 'u', 'ÃƒÂ¶' => 'o', 'Ã„Å¸' => 'g',
			// Russian
			'Ã�ï¿½' => 'A', 'Ã�â€˜' => 'B', 'Ã�â€™' => 'V', 'Ã�â€œ' => 'G', 'Ã�â€�' => 'D', 'Ã�â€¢' => 'E', 'Ã�ï¿½' => 'Yo', 'Ã�â€“' => 'Zh',
			'Ã�â€”' => 'Z', 'Ã�Ëœ' => 'I', 'Ã�â„¢' => 'J', 'Ã�Å¡' => 'K', 'Ã�â€º' => 'L', 'Ã�Å“' => 'M', 'Ã�ï¿½' => 'N', 'Ã�Å¾' => 'O',
			'Ã�Å¸' => 'P', 'Ã�Â ' => 'R', 'Ã�Â¡' => 'S', 'Ã�Â¢' => 'T', 'Ã�Â£' => 'U', 'Ã�Â¤' => 'F', 'Ã�Â¥' => 'H', 'Ã�Â¦' => 'C',
			'Ã�Â§' => 'Ch', 'Ã�Â¨' => 'Sh', 'Ã�Â©' => 'Sh', 'Ã�Âª' => '', 'Ã�Â«' => 'Y', 'Ã�Â¬' => '', 'Ã�Â­' => 'E', 'Ã�Â®' => 'Yu',
			'Ã�Â¯' => 'Ya',
			'Ã�Â°' => 'a', 'Ã�Â±' => 'b', 'Ã�Â²' => 'v', 'Ã�Â³' => 'g', 'Ã�Â´' => 'd', 'Ã�Âµ' => 'e', 'Ã‘â€˜' => 'yo', 'Ã�Â¶' => 'zh',
			'Ã�Â·' => 'z', 'Ã�Â¸' => 'i', 'Ã�Â¹' => 'j', 'Ã�Âº' => 'k', 'Ã�Â»' => 'l', 'Ã�Â¼' => 'm', 'Ã�Â½' => 'n', 'Ã�Â¾' => 'o',
			'Ã�Â¿' => 'p', 'Ã‘â‚¬' => 'r', 'Ã‘ï¿½' => 's', 'Ã‘â€š' => 't', 'Ã‘Æ’' => 'u', 'Ã‘â€ž' => 'f', 'Ã‘â€¦' => 'h', 'Ã‘â€ ' => 'c',
			'Ã‘â€¡' => 'ch', 'Ã‘Ë†' => 'sh', 'Ã‘â€°' => 'sh', 'Ã‘Å ' => '', 'Ã‘â€¹' => 'y', 'Ã‘Å’' => '', 'Ã‘ï¿½' => 'e', 'Ã‘Å½' => 'yu',
			'Ã‘ï¿½' => 'ya',
			// Ukrainian
			'Ã�â€ž' => 'Ye', 'Ã�â€ ' => 'I', 'Ã�â€¡' => 'Yi', 'Ã’ï¿½' => 'G',
			'Ã‘â€�' => 'ye', 'Ã‘â€“' => 'i', 'Ã‘â€”' => 'yi', 'Ã’â€˜' => 'g',
			// Czech
			'Ã„Å’' => 'C', 'Ã„Å½' => 'D', 'Ã„Å¡' => 'E', 'Ã…â€¡' => 'N', 'Ã…Ëœ' => 'R', 'Ã…Â ' => 'S', 'Ã…Â¤' => 'T', 'Ã…Â®' => 'U',
			'Ã…Â½' => 'Z',
			'Ã„ï¿½' => 'c', 'Ã„ï¿½' => 'd', 'Ã„â€º' => 'e', 'Ã…Ë†' => 'n', 'Ã…â„¢' => 'r', 'Ã…Â¡' => 's', 'Ã…Â¥' => 't', 'Ã…Â¯' => 'u',
			'Ã…Â¾' => 'z',
			// Polish
			'Ã„â€ž' => 'A', 'Ã„â€ ' => 'C', 'Ã„Ëœ' => 'e', 'Ã…ï¿½' => 'L', 'Ã…Æ’' => 'N', 'Ãƒâ€œ' => 'o', 'Ã…Å¡' => 'S', 'Ã…Â¹' => 'Z',
			'Ã…Â»' => 'Z',
			'Ã„â€¦' => 'a', 'Ã„â€¡' => 'c', 'Ã„â„¢' => 'e', 'Ã…â€š' => 'l', 'Ã…â€ž' => 'n', 'ÃƒÂ³' => 'o', 'Ã…â€º' => 's', 'Ã…Âº' => 'z',
			'Ã…Â¼' => 'z',
			// Latvian
			'Ã„â‚¬' => 'A', 'Ã„Å’' => 'C', 'Ã„â€™' => 'E', 'Ã„Â¢' => 'G', 'Ã„Âª' => 'i', 'Ã„Â¶' => 'k', 'Ã„Â»' => 'L', 'Ã…â€¦' => 'N',
			'Ã…Â ' => 'S', 'Ã…Âª' => 'u', 'Ã…Â½' => 'Z',
			'Ã„ï¿½' => 'a', 'Ã„ï¿½' => 'c', 'Ã„â€œ' => 'e', 'Ã„Â£' => 'g', 'Ã„Â«' => 'i', 'Ã„Â·' => 'k', 'Ã„Â¼' => 'l', 'Ã…â€ ' => 'n',
			'Ã…Â¡' => 's', 'Ã…Â«' => 'u', 'Ã…Â¾' => 'z'
		);
		
		// Make custom replacements
		$_str = preg_replace( array_keys( $_options[ 'replacements' ] ), $_options[ 'replacements' ], $_str );
		
		// Transliterate characters to ASCII
		if ( $_options[ 'transliterate' ] ) {
			$_str = str_replace( array_keys( $char_map ), $char_map, $_str );
		}
		
		// Replace non-alphanumeric characters with our delimiter
		$_str = preg_replace( '/[^\p{L}\p{Nd}]+/u', $_options[ 'delimiter' ], $_str );
		
		// Remove duplicate delimiters
		$_str = preg_replace( '/(' . preg_quote( $_options[ 'delimiter' ], '/' ) . '){2,}/', '$1', $_str );
		
		// Truncate slug to max. characters
		$_str= mb_substr( $_str, 0, ( $_options[ 'limit' ] ? $_options[ 'limit' ] : mb_strlen( $_str, 'UTF-8' ) ), 'UTF-8' );
		
		// Remove delimiter from ends
		$_str = trim( $_str, $_options[ 'delimiter' ] );
		
		return $_options[ 'lowercase' ] ? mb_strtolower( $_str, 'UTF-8' ) : $_str;
		
	}
}

?>