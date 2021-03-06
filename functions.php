<?php
/**
 * components functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Rewrite
 */

if ( ! function_exists( 'rewrite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the aftercomponentsetup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function rewrite_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on components, use a find and replace
	 * to change 'rewrite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'rewrite', get_template_directory() . '/languages' );

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

	add_image_size( 'rewrite-featured-image', 640, 9999 );
	add_image_size( 'rewrite-large', 2000, 1500, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'top-menu' => esc_html__( 'Top Menu', 'rewrite' ),
	) );

	/**
	 * Add support for core custom logo.
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'rewrite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_editor_style( array( 'assets/css/editor-style.css', rewrite_fonts_url() ) );
}
endif;
add_action( 'after_setup_theme', 'rewrite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rewrite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'rewrite_content_width', 640 );
}
add_action( 'after_setup_theme', 'rewrite_content_width', 0 );

/**
 * Return early if Custom Logos are not available.
 *
 * @todo Remove after WP 4.7
 */
function rewrite_the_custom_logo() {
	if ( ! function_exists( 'the_custom_logo' ) ) {
		return;
	} else {
		the_custom_logo();
	}
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rewrite_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'rewrite' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'rewrite_widgets_init' );

/**
 * Register custom fonts.
 */
function rewrite_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'rewrite' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles.
 */
function rewrite_scripts() {
	wp_enqueue_style( 'rewrite-normalize', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/vender/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'rewrite-style', get_template_directory_uri() . '/assets/css/style.css' );
	
	wp_enqueue_script( 'rewrite-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '20120206', true );
	wp_localize_script( 'rewrite-main', 'menuToggleText', array(
		'open'   => esc_html__( 'Open Sub-menu', 'rewrite' ),
		'close'  => esc_html__( 'Close Sub-menu', 'rewrite' ),
	) );

	wp_enqueue_script( 'rewrite-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'rewrite-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array( 'jquery' ), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'rewrite_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
