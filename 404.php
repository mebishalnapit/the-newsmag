<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package The NewsMag
 */
get_header();
?>

<?php do_action('the_newsmag_before_body_content'); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php if (is_active_sidebar('the-newsmag-404-sidebar')) { ?>
			<section class="error-404 not-found sidebar-404">
				<header class="page-header">
					<h1 class="page-title"><span><?php esc_html_e('404 Error!', 'the-newsmag'); ?></span></h1>
				</header><!-- .page-header -->
			</section>
		<?php } ?>

		<?php if (!dynamic_sidebar('the-newsmag-404-sidebar')) : ?>
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><span><?php esc_html_e('404 Error!', 'the-newsmag'); ?></span></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e('Oops! That page can&rsquo;t be found. It looks like nothing was found at this location. Maybe try a search instead?', 'the-newsmag'); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		<?php endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php the_newsmag_sidebar_select(); ?>

<?php do_action('the_newsmag_after_body_content'); ?>

<?php get_footer(); ?>
