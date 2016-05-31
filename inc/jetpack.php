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
