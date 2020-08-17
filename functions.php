<?php
/**
 * immobilier functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package immobilier
 */

if ( ! function_exists( 'bs_immobilier_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bs_immobilier_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on immobilier, use a find and replace
		 * to change 'bs_immobilier' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bs_immobilier', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'bs_immobilier' ),
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
		add_theme_support( 'custom-background', apply_filters( 'bs_immobilier_custom_background_args', array(
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
add_action( 'after_setup_theme', 'bs_immobilier_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bs_immobilier_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'bs_immobilier_content_width', 640 );
}
add_action( 'after_setup_theme', 'bs_immobilier_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bs_immobilier_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bs_immobilier' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'bs_immobilier' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'bs_immobilier_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bs_immobilier_scripts() {
	wp_enqueue_style( 'bs_immobilier-style', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css' );
	wp_enqueue_script( 'bootstrap-js' , get_template_directory_uri() . '/bootstrap/js/bootstrap.bundle.min.js', array('jquery') );


	wp_enqueue_script( 'bs_immobilier-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'bs_immobilier-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bs_immobilier_scripts' );

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


/*****************************************************************************************
 * AJOUTE DE "POST TYPE"
 ******************************************************************************************/
add_action('init', 'bs_enregistre_post_propriete');


function bs_enregistre_post_propriete()
{
    register_post_type('bs_propriete',
                       array(
                           'labels'      => array(
                               'name'          => __('Propriétés'),
                               'singular_name' => __('Propriété	'),
                           ),
                           'public'      => true,
						   'has_archive' => true,
						   'supports' => array('editor','title')
                       )
    );
}


/*****************************************************************************************
 * INTEGRATION DE FONT AWESOME
 ****************************************************************************************/
if (! function_exists('fa_custom_setup_kit') ) {
	function fa_custom_setup_kit($kit_url = '') {
	  foreach ( [ 'wp_enqueue_scripts', 'admin_enqueue_scripts', 'login_enqueue_scripts' ] as $action ) {
		add_action(
		  $action,
		  function () use ( $kit_url ) {
			wp_enqueue_script( 'font-awesome-kit', $kit_url, [], null );
		  }
		);
	  }
	}
  }

  fa_custom_setup_kit('https://kit.fontawesome.com/0cec3451bc.js');
  

  
/***************************************************************************************
 * AJOUTE DE TAIL D'IMAGE
 ***************************************************************************************/

if ( ! function_exists( 'your_theme_activated' ) ) {
    function your_theme_activated() {
        // set thumbnail size in settings > media
        update_option( 'thumbnail_size_w', 300 );
        update_option( 'thumbnail_size_h', 200 );
    }
    add_action( 'after_switch_theme', 'your_theme_activated' );
}



/***************************************************************************************
 * INTEGRATION DE WIDGET
 ***************************************************************************************/
require get_template_directory() . '/inc/widget-recommandation.php';