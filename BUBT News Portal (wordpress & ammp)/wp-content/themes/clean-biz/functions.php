<?php
/**
 * clean-biz functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package clean-biz
 */

/**
 * require clean-biz int.
 */
require get_template_directory() . '/inc/init.php';

if ( ! function_exists( 'clean_biz_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function clean_biz_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on clean-biz, use a find and replace
	 * to change 'clean-biz' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'clean-biz', get_template_directory() . '/languages' );

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
	add_image_size( 'clean-biz-about-image', 720, 510, true );
	add_image_size( 'clean-biz-portfolio-image', 340, 340, true );
	add_image_size( 'clean-biz-medium-image', 200, 200, true );
	add_image_size( 'clean-biz-team-image', 260, 290, true );
	add_image_size( 'clean-biz-blog-image', 360, 220, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'clean-biz' ),
		'social' => esc_html__( 'Social', 'clean-biz' ),
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
	add_theme_support( 'custom-background', apply_filters( 'clean_biz_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );


	/*implimenting new feature from 4.5*/
	add_theme_support( 'custom-logo', array(
	   'header-text' => array( 'site-title', 'site-description' ),
	) );
	
	/*woocomerce supprt*/
	add_theme_support( 'woocommerce' );

}
endif;
add_action( 'after_setup_theme', 'clean_biz_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function clean_biz_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'clean_biz_content_width', 640 );
}
add_action( 'after_setup_theme', 'clean_biz_content_width', 0 );

/*Google Fonts*/
function clean_biz_google_fonts() {
    global $clean_biz_customizer_all_values;
	$fonts_url = '';
	$fonts     = array();


	$clean_biz_font_family_body = $clean_biz_customizer_all_values['clean-biz-font-family-Primary'];
	$clean_biz_font_family_title = $clean_biz_customizer_all_values['clean-biz-font-family-title'];
	$clean_biz_font_family_site_identity = $clean_biz_customizer_all_values['clean-biz-font-family-site-identity'];
    
	$clean_biz_fonts = array();
	$clean_biz_fonts[]=$clean_biz_font_family_body;
	$clean_biz_fonts[]=$clean_biz_font_family_title;
	$clean_biz_fonts[]=$clean_biz_font_family_site_identity;

	  $clean_biz_fonts_stylesheet = '//fonts.googleapis.com/css?family=';

	  $i  = 0;
	  for ($i=0; $i < count( $clean_biz_fonts ); $i++) { 

	    if ( 'off' !== sprintf( _x( 'on', '%s font: on or off', 'clean-biz' ), $clean_biz_fonts[$i] ) ) {
			$fonts[] = $clean_biz_fonts[$i];
		}

	  }

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urldecode( implode( '|', $fonts ) ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
/**
 * Enqueue scripts and styles.
 */
function clean_biz_scripts() {
    global $clean_biz_customizer_all_values;
		// *** STYLE ***//
		//slick main
	    wp_enqueue_style( 'jquery-slick-css', get_template_directory_uri() . '/assets/frameworks/slick/slick.css', array(), '3.4.0' );/*added*/
		
		//slick theme
	    wp_enqueue_style( 'jquery-slick-theme', get_template_directory_uri() . '/assets/frameworks/slick/slick-theme.css', array(), '3.4.0' );/*added*/
		
		// Main stylesheet
		wp_enqueue_style( 'clean-biz-style', get_stylesheet_uri() );

		// google font
		wp_enqueue_style( 'clean-biz-google-fonts', clean_biz_google_fonts() );

		//inline style
		wp_add_inline_style( 'clean-biz-style', clean_biz_inline_style() );

		// *** SCRIPT ***//
	    wp_enqueue_style( 'wow-animate-css', get_template_directory_uri() . '/assets/frameworks/wow/css/animate.min.css', array(), '3.4.0' );/*added*/
		
		// wow
	    wp_enqueue_script('jquery-wow', get_template_directory_uri() . '/assets/frameworks/wow/js/wow.min.js', array('jquery'), '1.1.2', 1);

		// modernizr
		wp_enqueue_script( 'jquery-modernizr', get_template_directory_uri() . '/assets/js/modernizr.min.js', array('jquery'), '2.8.3', true );
		
		// easing
		wp_enqueue_script('jquery-easing', get_template_directory_uri() . '/assets/frameworks/jquery.easing/jquery.easing.js', array('jquery'), '0.3.6', 1);

	    // slick
	    wp_enqueue_script('jquery-slick', get_template_directory_uri() . '/assets/frameworks/slick/slick.min.js', array('jquery'), '1.6.0', 1);
	    // waypoints
	    wp_enqueue_script('jquery-waypoints', get_template_directory_uri() . '/assets/frameworks/waypoints/jquery.waypoints.min.js', array('jquery'), '4.0.0', 1);

		/*cycle*/
		wp_enqueue_script( 'jquery-cycle2-script', get_template_directory_uri() . '/assets/frameworks/cycle2/jquery.cycle2.js', array( 'jquery' ), '2.1.6', true );

		// skip-link-focus-fix
		wp_enqueue_script( 'clean-biz-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'clean_biz_scripts' );

/*added admin css for meta*/
function clean_biz_wp_admin_style($hook) {
	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
        wp_register_style( 'clean-biz-admin-css', get_template_directory_uri() . '/assets/css/admin-meta.css',array(), ''  );
        wp_enqueue_style( 'clean-biz-admin-css' );
    }
}
add_action( 'admin_enqueue_scripts', 'clean_biz_wp_admin_style' );

/**
 * Enqueue custom script.
 */
function clean_biz_custom_scripts() {
	global $clean_biz_customizer_all_values;
		wp_register_script('clean-biz-custom-js', get_template_directory_uri() . '/assets/js/evision-custom.js', array('jquery'), '', true);
		wp_enqueue_script( "clean-biz-custom-js" );
	    wp_localize_script( "clean-biz-custom-js", "clean_biz_customizer_value", $clean_biz_customizer_all_values );
	}
add_action( "wp_enqueue_scripts", "clean_biz_custom_scripts" );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/*breadcrum function*/

if ( ! function_exists( 'clean_biz_simple_breadcrumb' ) ) :

	/**
	 * Simple breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function clean_biz_simple_breadcrumb() {

		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			require_once get_template_directory() . '/assets/frameworks/breadcrumbs/breadcrumbs.php';
		}

		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
		);
		breadcrumb_trail( $breadcrumb_args );

	}
endif;


/*update to pro link*/
require_once( trailingslashit( get_template_directory() ) . 'trt-customize-pro/clean-biz/class-customize.php' );