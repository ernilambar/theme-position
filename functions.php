<?php
/**
 * Theme Position functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme_Position
 */

if ( ! function_exists( 'theme_position_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function theme_position_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Theme Position, use a find and replace
	 * to change 'theme-position' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'theme-position', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary', 'theme-position' ),
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
	add_theme_support( 'custom-background', apply_filters( 'theme_position_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'theme_position_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function theme_position_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'theme_position_content_width', 640 );
}
add_action( 'after_setup_theme', 'theme_position_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function theme_position_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'theme-position' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'theme-position' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'theme_position_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function theme_position_scripts() {
	wp_enqueue_style( 'theme-position-style', get_stylesheet_uri() );

	wp_enqueue_script( 'theme-position-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'theme-position-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0.0', true );

	wp_enqueue_script( 'theme-position-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'jquery-lazyloading', '//cdn.jsdelivr.net/jquery.lazy/1.7.4/jquery.lazy.min.js', array( 'jquery' ), '1.7.4', true );

	wp_enqueue_script( 'theme-position-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery', 'jquery-lazyloading' ), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_position_scripts' );

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

function theme_position_themelist( $dom ){
	$domxpath = new DOMXPath($dom);
	$themelist = array();
	$count = 1;

	$tr = $domxpath->query('//table[@class="listing tickets"]/tbody/tr');


	foreach ($tr as $key) {
		foreach ($key->childNodes as $k) {
			if($k->nodeName === 'td') {
				foreach($k->attributes as $v){

					// Ticket ID
					if($v->nodeValue === 'id') {
						$themelist[$count]['id'] = trim(str_replace('#', '', $k->nodeValue));
					}

					// Theme Name
					if($v->nodeValue === 'summary') {
						$themerawn = str_replace('THEME: ', '', $k->nodeValue);
						$themename = trim(substr($themerawn, 0, strpos($themerawn, " –")));
						$themeslug = strtolower( $themename );
			    		$themeslug = preg_replace( '/[^a-z0-9_\-]/', '-', $themeslug );
						$themeslug = preg_replace( '/(--)/', '-', $themeslug );
						$themevers = trim(substr( $themerawn, strpos( $themerawn, '–') + 3 ) );

						$themelist[$count]['name'] 		= $themename;
						$themelist[$count]['slug'] 		= $themeslug;
						$themelist[$count]['version'] 	= $themevers;
					}

					// Theme Author
					if($v->nodeValue === 'reporter') {
						$themelist[$count]['reporter'] = trim($k->nodeValue);
					}

					// Modified
					if($v->nodeValue === 'changetime') {
						$themelist[$count]['changetime'] = trim($k->nodeValue);
					}

					// Created
					if($v->nodeValue === 'time') {
						$themelist[$count]['time'] = trim($k->nodeValue);
					}

				}
			}
		}
		$count++;
	}

	return (array) $themelist;
}

function theme_position_get_all_themes() {

	$transient_key = 'tp_all_themes';
	$transient_period = 1 * HOUR_IN_SECONDS;

	$output = get_transient( $transient_key );
	if ( false === $output ) {

		$uri = 'https://themes.trac.wordpress.org/query?priority=new+theme&priority=previously+reviewed&owner=&status=new&status=reviewing&keywords=!~buddypress&max=1000&col=id&col=summary&col=status&col=time&col=changetime&col=reporter&report=2&order=time';
		$contents = wp_remote_fopen($uri);
		$dom = new DOMDocument();
		$dom->preserveWhiteSpace = false;
		$dom->loadHTML($contents);
		$themelist = theme_position_themelist( $dom );

		$output = $themelist;
		set_transient( $transient_key, $output, $transient_period );
	}

	return $output;

}

function theme_position_get_all_open_tickets() {

	$transient_key = 'tp_all_tickets';
	$transient_period = 1 * HOUR_IN_SECONDS;

	$output = get_transient( $transient_key );
	if ( false === $output || 1 === 2 ) {

		$uri = 'https://themes.trac.wordpress.org/query?status=approved&status=new&status=reopened&status=reviewing&col=id&col=summary&col=type&col=status&col=priority&col=time&col=reporter&col=changetime&order=priority&max=1000';
		$contents = wp_remote_fopen($uri);
		$dom = new DOMDocument();
		$dom->preserveWhiteSpace = false;
		$dom->loadHTML($contents);
		$themelist = theme_position_themelist( $dom );

		$output = $themelist;
		set_transient( $transient_key, $output, $transient_period );
	}

	return $output;

}

function theme_position_render_result( $theme_slug ) {

	if ( empty( $theme_slug ) ) {
		return;
	}

	$all_themes = theme_position_get_all_themes();
	$item = wp_list_filter( $all_themes, array( 'slug' => $theme_slug ) );
	if ( ! empty( $item ) ) {
		$keys = array_keys( $item );
		$position = array_shift( $keys );
		$theme = array_shift( $item );

		echo '<ul class="item-list">';
		echo '<li class="position"><span>Position:</span>' . esc_html( $position ) . '</li>';
		echo '<li><span>Theme Name:</span><a href="https://themes.trac.wordpress.org/ticket/' . esc_attr( $theme['id'] ) . '" target="_blank">' . esc_html( $theme['name'] ) . '</a></li>';
		echo '<li><span>Version:</span>' . esc_html( $theme['version'] ) . '</li>';
		echo '<li><span>Created:</span>' . esc_html( $theme['time'] ) . '</li>';
		echo '<li><span>Modified:</span>' . esc_html( $theme['changetime'] ) . '</li>';
		echo '<li><span>Reporter:</span><a href="https://themes.trac.wordpress.org/query?status=!closed&reporter=' . esc_attr( $theme['reporter'] ) . '" target="_blank">' . esc_html( $theme['reporter'] ) . '</a></li>';
		echo '</ul>';
	}
	else {
		echo '<p><strong>Not found!</strong></p>';
	}
}
