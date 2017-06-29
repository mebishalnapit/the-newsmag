<?php

/**
 * The NewsMag functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package The NewsMag
 */
if (!function_exists('the_newsmag_setup')) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function the_newsmag_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on The NewsMag, use a find and replace
		 * to change 'the-newsmag' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('the-newsmag', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');
		add_image_size('the-newsmag-featured-small-thumbnail', 120, 90, true);
		add_image_size('the-newsmag-featured-medium-thumbnail', 600, 450, true);
		add_image_size('the-newsmag-featured-large-thumbnail', 800, 600, true);
		add_image_size('the-newsmag-featured-related-posts-thumbnail', 400, 300, true);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'primary' => esc_html__('Primary Menu', 'the-newsmag'),
			'social' => esc_html__('Social Menu', 'the-newsmag'),
			'footer' => esc_html__('Footer Menu', 'the-newsmag')
		));

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support('post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'chat',
			'audio',
			'status'
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('the_newsmag_custom_background_args', array(
			'default-color' => 'ccc',
			'default-image' => '',
		)));

		// Set up the WordPress core custom logo feature.
		add_theme_support('custom-logo', array(
			'height' => 100,
			'width' => 300,
			'flex-width' => true,
			'flex-height' => true,
		));

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Add theme support for WooCommerce plugin
		add_theme_support('woocommerce');
		add_theme_support('wc-product-gallery-zoom');
		add_theme_support('wc-product-gallery-lightbox');
		add_theme_support('wc-product-gallery-slider');
	}

endif;
add_action('after_setup_theme', 'the_newsmag_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function the_newsmag_content_width() {
	$GLOBALS['content_width'] = apply_filters('the_newsmag_content_width', 800);
}

add_action('after_setup_theme', 'the_newsmag_content_width', 0);

/**
 * $content_width global variable adjustment as per layout option.
 */
function the_newsmag_dynamic_content_width() {
	global $post;
	global $content_width;

	if ($post) {
		$the_newsmag_layout_meta = get_post_meta($post->ID, 'the_newsmag_page_layout', true);
	}

	if (is_home()) {
		$queried_id = get_option('page_for_posts');
		$the_newsmag_layout_meta = get_post_meta($queried_id, 'the_newsmag_page_layout', true);
	}

	if (empty($the_newsmag_layout_meta) || is_archive() || is_search() || is_404()) {
		$the_newsmag_layout_meta = 'default_layout';
	}

	$the_newsmag_default_layout = get_theme_mod('the_newsmag_default_layout', 'right_sidebar');
	$the_newsmag_default_page_layout = get_theme_mod('the_newsmag_default_page_layout', 'right_sidebar');
	$the_newsmag_default_post_layout = get_theme_mod('the_newsmag_default_single_posts_layout', 'right_sidebar');

	if ($the_newsmag_layout_meta == 'default_layout') {
		if (is_page()) {
			if ($the_newsmag_default_page_layout == 'no_sidebar_full_width') {
				$content_width = 1160; /* pixels */
			} else {
				$content_width = 800; /* pixels */
			}
		} elseif (is_single()) {
			if ($the_newsmag_default_post_layout == 'no_sidebar_full_width') {
				$content_width = 1160; /* pixels */
			} else {
				$content_width = 800; /* pixels */
			}
		} elseif ($the_newsmag_default_layout == 'no_sidebar_full_width') {
			$content_width = 1160; /* pixels */
		} else {
			$content_width = 800; /* pixels */
		}
	} elseif ($the_newsmag_layout_meta == 'no_sidebar_full_width') {
		$content_width = 1160; /* pixels */
	} else {
		$content_width = 800; /* pixels */
	}
}

add_action('template_redirect', 'the_newsmag_dynamic_content_width');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function the_newsmag_widgets_init() {
	// registering the right sidebar area
	register_sidebar(array(
		'name' => esc_html__('Right Sidebar', 'the-newsmag'),
		'id' => 'the-newsmag-right-sidebar',
		'description' => esc_html__('Display your widgets in the Right Sidebar Area.', 'the-newsmag'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));

	// registering the left sidebar area
	register_sidebar(array(
		'name' => esc_html__('Left Sidebar', 'the-newsmag'),
		'id' => 'the-newsmag-left-sidebar',
		'description' => esc_html__('Display your widgets in the Left Sidebar Area.', 'the-newsmag'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));

	// registering the header sidebar area
	register_sidebar(array(
		'name' => esc_html__('Header Sidebar', 'the-newsmag'),
		'id' => 'the-newsmag-header-sidebar',
		'description' => esc_html__('Display your widgets in the Header Sidebar Area.', 'the-newsmag'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));

	// registering the magazine slider sidebar area
	register_sidebar(array(
		'name' => esc_html__('Magazine Slider Sidebar', 'the-newsmag'),
		'id' => 'the-newsmag-magazine-slider-sidebar',
		'description' => esc_html__('Display your widgets in the Magazine Slider Sidebar Area.', 'the-newsmag'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));

	// registering the magazine beside slider sidebar area
	register_sidebar(array(
		'name' => esc_html__('Magazine Beside Slider Sidebar', 'the-newsmag'),
		'id' => 'the-newsmag-magazine-beside-slider-sidebar',
		'description' => esc_html__('Display your widgets in the Magazine Beside Slider Sidebar Area.', 'the-newsmag'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));

	// registering the magazine top content sidebar area
	register_sidebar(array(
		'name' => esc_html__('Magazine Top Content Sidebar', 'the-newsmag'),
		'id' => 'the-newsmag-magazine-top-content-sidebar',
		'description' => esc_html__('Display your widgets in the Magazine Top Content Sidebar Area.', 'the-newsmag'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));

	// registering the magazine content middle left sidebar area
	register_sidebar(array(
		'name' => esc_html__('Magazine Middle Left Sidebar', 'the-newsmag'),
		'id' => 'the-newsmag-magazine-middle-left-sidebar',
		'description' => esc_html__('Display your widgets in the Magazine Middle Left Sidebar Area.', 'the-newsmag'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));

	// registering the magazine content middle right sidebar area
	register_sidebar(array(
		'name' => esc_html__('Magazine Middle Right Sidebar', 'the-newsmag'),
		'id' => 'the-newsmag-magazine-middle-right-sidebar',
		'description' => esc_html__('Display your widgets in the Magazine Middle Right Sidebar Area.', 'the-newsmag'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));

	// registering the magazine bottom content sidebar area
	register_sidebar(array(
		'name' => esc_html__('Magazine Bottom Content Sidebar', 'the-newsmag'),
		'id' => 'the-newsmag-magazine-bottom-content-sidebar',
		'description' => esc_html__('Display your widgets in the Magazine Bottom Content Sidebar Area.', 'the-newsmag'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));

	// registering the content top sidebar area
	register_sidebar(array(
		'name' => esc_html__('Content Top Sidebar', 'the-newsmag'),
		'id' => 'the-newsmag-content-top-sidebar',
		'description' => esc_html__('Display your widgets in the Content Top Sidebar Area.', 'the-newsmag'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));

	// registering the content bottom sidebar area
	register_sidebar(array(
		'name' => esc_html__('Content Bottom Sidebar', 'the-newsmag'),
		'id' => 'the-newsmag-content-bottom-sidebar',
		'description' => esc_html__('Display your widgets in the Content Bottom Sidebar Area.', 'the-newsmag'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));

	// registering the 404 page sidebar area
	register_sidebar(array(
		'name' => esc_html__('404 Sidebar', 'the-newsmag'),
		'id' => 'the-newsmag-404-sidebar',
		'description' => esc_html__('Display your widgets in the 404 Error Page Sidebar Area.', 'the-newsmag'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));

	// registering the contact page sidebar area
	register_sidebar(array(
		'name' => esc_html__('Contact Page Sidebar', 'the-newsmag'),
		'id' => 'the-newsmag-contact-page-sidebar',
		'description' => esc_html__('Display your widgets in the Contact Page Sidebar Area.', 'the-newsmag'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));

	// registering the large footer sidebar area
	register_sidebar(array(
		'name' => esc_html__('Large Footer Sidebar', 'the-newsmag'),
		'id' => 'the-newsmag-large-footer-sidebar',
		'description' => esc_html__('Display your widgets in the Large Footer Sidebar Area.', 'the-newsmag'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));

	// registering the smaller footer sidebar area one
	register_sidebar(array(
		'name' => esc_html__('Small Footer Sidebar One', 'the-newsmag'),
		'id' => 'the-newsmag-small-footer-sidebar-one',
		'description' => esc_html__('Display your widgets in the Small Footer Sidebar Area One.', 'the-newsmag'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));

	// registering the smaller footer sidebar area one
	register_sidebar(array(
		'name' => esc_html__('Small Footer Sidebar Two', 'the-newsmag'),
		'id' => 'the-newsmag-small-footer-sidebar-two',
		'description' => esc_html__('Display your widgets in the Small Footer Sidebar Area Two.', 'the-newsmag'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));

	// registering the masonry footer sidebar area
	register_sidebar(array(
		'name' => esc_html__('Masonry Footer Sidebar', 'the-newsmag'),
		'id' => 'the-newsmag-masonry-footer-sidebar',
		'description' => esc_html__('Display your widgets in the Masonry Footer Sidebar Area.', 'the-newsmag'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));

	register_widget('The_NewsMag_Random_Posts_Widget');
	register_widget('The_NewsMag_Tabbed_Widget');
	register_widget('The_NewsMag_Posts_Slider_Widget');
	register_widget('The_NewsMag_Posts_Grid_Widget');
	register_widget('The_NewsMag_Posts_One_Column_Widget');
	register_widget('The_NewsMag_Posts_Two_Column_Widget');
	register_widget('The_NewsMag_Posts_Extended_Widget');
	register_widget('The_NewsMag_728x90_Widget');
	register_widget('The_NewsMag_300x250_Widget');
	register_widget('The_NewsMag_125x125_Widget');
}

add_action('widgets_init', 'the_newsmag_widgets_init');

/**
 * Enqueue scripts and styles.
 */
if (!function_exists('the_newsmag_fonts_url')) {

	// Using google font
	// creating the function for adding the google font url
	function the_newsmag_fonts_url() {
		$fonts_url = '';
		$fonts = array();
		$subsets = 'latin,latin-ext';
		// applying the translators for the Google Fonts used
		/* Translators: If there are characters in your language that are not
		 * supported by Noto Sans, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		if ('off' !== _x('on', 'Noto Sans font: on or off', 'the-newsmag')) {
			$fonts[] = 'Noto Sans:400,400italic,700,700italic';
		}

		/* Translators: If there are characters in your language that are not
		 * supported by Lobster Two, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		if ('off' !== _x('on', 'Lobster Two font: on or off', 'the-newsmag')) {
			$fonts[] = 'Lobster Two:400,400italic,700,700italic';
		}

		/*
		 * Translators: To add an additional character subset specific to your language,
		 * translate this to 'cyrillic'. Do not translate into your own language.
		 */
		$subset = _x('no-subset', 'Add new subset ( cyrillic, greek, vietnamese, devanagari )', 'the-newsmag');

		if ('cyrillic' == $subset) {
			$subsets .= ',cyrillic,cyrillic-ext';
		} elseif ('greek' == $subset) {
			$subsets .= ',greek-ext,greek';
		} elseif ('vietnamese' == $subset) {
			$subsets .= ',vietnamese';
		} elseif ('devanagari' == $subset) {
			$subsets .= ',devanagari';
		}

		// Ready to enqueue Google Font
		if ($fonts) {
			$fonts_url = add_query_arg(array(
				'family' => urlencode(implode('|', $fonts)),
				'subset' => urlencode($subsets),
					), '//fonts.googleapis.com/css');
		}
		return $fonts_url;
	}

}
// completion of enqueue for the google font

/**
 * Enqueue scripts and styles.
 */
function the_newsmag_scripts() {

	// adding the function to load the minified version if SCRIPT_DEFUG is disable
	$suffix = ( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ) ? '' : '.min';

	// use of enqueued google fonts
	wp_enqueue_style('the-newsmag-google-fonts', the_newsmag_fonts_url(), array(), null);

	// enqueueing the main stylesheet file
	wp_enqueue_style('the-newsmag-style', get_stylesheet_uri());

	// enqueueing the fontawesome icons
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/fontawesome/css/font-awesome' . $suffix . '.css');

	// registering the bxslider script
	wp_register_script('jquery-bxslider', get_template_directory_uri() . '/js/jquery.bxslider/jquery.bxslider' . $suffix . '.js', array('jquery'), null, true);

	// enqueueing the fitvids javascript file
	wp_enqueue_script('jquery-fitvids', get_template_directory_uri() . '/js/fitvids/jquery.fitvids' . $suffix . '.js', array('jquery'), false, true);

	if (is_active_sidebar('the-newsmag-masonry-footer-sidebar')) {
		wp_enqueue_script('jquery-masonry');
	}

	// menu animation using superfish
	if (get_theme_mod('the_newsmag_superfish_menu', 0) == 1) {
		// enqueueing the superfish script
		wp_enqueue_script('superfish', get_template_directory_uri() . '/js/superfish/superfish' . $suffix . '.js', array(), false, true);
		// enqueueing the enquire script
		wp_enqueue_script('enquire', get_template_directory_uri() . '/js/enquire/enquire' . $suffix . '.js', array(), false, true);
	}

	if (get_theme_mod('the_newsmag_sticky_menu_option', 0) == 1) {
		if (get_theme_mod('the_newsmag_sticky_menu_type', 'scroll') == 'scroll') {
			// enqueueing the headroom script
			wp_enqueue_script('headroom', get_template_directory_uri() . '/js/headroom/headroom' . $suffix . '.js', array(), false, true);
			wp_enqueue_script('jquery-headroom', get_template_directory_uri() . '/js/headroom/jQuery.headroom' . $suffix . '.js', array(), false, true);
		} elseif (get_theme_mod('the_newsmag_sticky_menu_type', 'scroll') == 'sticky') {
			// enqueueing the stickyjs script
			wp_enqueue_script('jquery-sticky', get_template_directory_uri() . '/js/sticky/jquery.sticky' . $suffix . '.js', array('jquery'), false, true);
		}
	}

	// enqueueing the bxslider for breaking news
	if (get_theme_mod('the_newsmag_breaking_news', 0) == 1 || has_post_format('gallery') || is_home() || is_search() || is_archive()) {
		wp_enqueue_script('jquery-bxslider');
	}

	// enqueueing magnific popup
	if ((get_theme_mod('the_newsmag_featured_image_popup', 0) == 1) && has_post_thumbnail() && (is_single() || is_page())) {
		wp_enqueue_script('jquery-magnific-popup', get_template_directory_uri() . '/js/magnific-popup/jquery.magnific-popup' . $suffix . '.js', array('jquery'), null, true);
		wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/js/magnific-popup/magnific-popup' . $suffix . '.css');
	}

	// enqueueing sticky content and sidebar area required js files
	if (get_theme_mod('the_newsmag_sticky_sidebar_content', 0) == 1) {
		wp_enqueue_script('ResizeSensor', get_template_directory_uri() . '/js/theia-sticky-sidebar/ResizeSensor' . $suffix . '.js', array('jquery'), false, true);
		wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar/theia-sticky-sidebar' . $suffix . '.js', array('jquery'), false, true);
	}

	// enqueueing the navigation script
	wp_enqueue_script('the-newsmag-navigation', get_template_directory_uri() . '/js/navigation' . $suffix . '.js', array(), '20151215', true);

	// enqueueing the skip link focus fix script
	wp_enqueue_script('the-newsmag-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix' . $suffix . '.js', array(), '20151215', true);

	// enqueueing the theme's main javascript file
	wp_enqueue_script('the-newsmag-main-script', get_template_directory_uri() . '/js/the-newsmag-custom' . $suffix . '.js', array('jquery'), false, true);

	// enqueueing the comment reply script
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	// loading the HTML5Shiv js for IE8 and below
	wp_enqueue_script('html5shiv', get_template_directory_uri() . '/js/html5shiv/html5shiv' . $suffix . '.js', false);
	wp_script_add_data('html5shiv', 'conditional', 'lt IE 9');
}

add_action('wp_enqueue_scripts', 'the_newsmag_scripts');

/**
 * Enqueue scripts and styles in the customizer
 */
function the_newsmag_customizer_scripts() {
	// adding the function to load the minified version if SCRIPT_DEFUG is disable
	$suffix = ( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_style('the-newsmag-customizer-layout-option-css', get_template_directory_uri() . '/css/custom-layout' . $suffix . '.css');
	wp_enqueue_script('the-newsmag-customizer-layout-option', get_template_directory_uri() . '/js/custom-layout' . $suffix . '.js', false, false, true);
}

add_action('customize_controls_enqueue_scripts', 'the_newsmag_customizer_scripts');

/**
 * Enqueue scripts for use in media upload in widgets
 */
function the_newsmag_widgets_scripts($hook) {
	// adding the function to load the minified version if SCRIPT_DEFUG is disable
	$suffix = ( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ) ? '' : '.min';
	if ($hook == 'widgets.php' || $hook == 'customize.php') {
		// image uploader enqueue
		wp_enqueue_media();
		wp_enqueue_script('the-newsmag-image-uploader', get_template_directory_uri() . '/js/image-uploader' . $suffix . '.js', false, false, true);
	}
}

add_action('admin_enqueue_scripts', 'the_newsmag_widgets_scripts');

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

/**
 * Add the custom meta box for the single post/page layout option
 */
require get_template_directory() . '/inc/meta-boxes.php';

/**
 * Add the required custom widgets
 */
require get_template_directory() . '/inc/widgets.php';
