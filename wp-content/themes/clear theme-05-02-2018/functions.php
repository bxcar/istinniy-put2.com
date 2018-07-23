<?php
/**
 * bible functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bible
 */
 
add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more($more) {
	global $post;
	//return '...<p align="right"><a href="'. get_permalink($post->ID) . '">Читать дальше...</a></p>';
	return '...';
}

add_image_size('previewpagesmall', 400, 115, true);

if ( ! function_exists( 'bible_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bible_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on bible, use a find and replace
		 * to change 'bible' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bible', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'bible' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'bible_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'bible_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bible_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bible_content_width', 640 );
}
add_action( 'after_setup_theme', 'bible_content_width', 0 );
 // register menu - зарегистрировать область для размещения меню
  register_nav_menu( 'location', 'description' );
  register_nav_menu( 'header', 'header-menu' );
   register_nav_menu( 'footer', 'footer-menu' );
    register_nav_menu( 'footer1', 'footer-menu1' );
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bible_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bible' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'bible' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
    'name' =>'Новый сайдбар',
    'id' => 'secondary-widget-area',
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );
	register_sidebar( array(
    'name' =>'sidebar_shop',
    'id' => 'sidebar_shop',
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );
}
add_action( 'widgets_init', 'bible_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function bible_scripts() {
	wp_enqueue_style( 'bible-style', get_stylesheet_uri() );

	wp_enqueue_script( 'bible-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'bible-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bible_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
/**woocommerce**/
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
add_theme_support( 'woocommerce' );
}
add_action( 'woocommerce_before_single_product_cart', 'woocommerce_simple_add_to_cart', 30); //Добавляем корзину после цены
remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 ); //удаляем корзину в стандартном месте
function new_woocommerce_checkout_fields($fields){
    
    $fields['billing']['billing_address_1']['label']="Адрес доставки";
    $fields['billing']['billing_city']['label']="Город доставки";
    $fields['billing']['billing_postcode']['label']="Почтовый индекс";
    
    return $fields;
}


