<?php

/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package The NewsMag
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function the_newsmag_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support('infinite-scroll', array(
		'container' => 'main',
		'render' => 'the_newsmag_infinite_scroll_render',
		'footer' => 'page',
		'wrapper' => false,
		'type' => 'click',
	));

	// Add theme support for Responsive Videos.
	add_theme_support('jetpack-responsive-videos');
}

// end function the_newsmag_jetpack_setup
add_action('after_setup_theme', 'the_newsmag_jetpack_setup');

/**
 * Custom render function for Infinite Scroll.
 */
function the_newsmag_infinite_scroll_render() {
	while (have_posts()) {
		the_post();
		get_template_part('template-parts/content', get_post_format());
	}
}

// end function the_newsmag_infinite_scroll_render

/**
 * Enables Jetpack's Infinite Scroll in search pages, archive pages and blog pages and disables it in WooCommerce product as well as WooCommerce archive pages
 *
 * @return bool
 */
function the_newsmag_jetpack_infinite_scroll_supported() {
	return current_theme_supports('infinite-scroll') && (is_home() || is_archive() || is_search()) && !(is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag'));
}

add_filter('infinite_scroll_archive_supported', 'the_newsmag_jetpack_infinite_scroll_supported');
