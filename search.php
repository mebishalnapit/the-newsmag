<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package The NewsMag
 */
get_header();
?>

<?php do_action('the_newsmag_before_body_content'); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php if (have_posts()) : ?>

			<header class="page-header">
				<h1 class="page-title"><span><?php printf(esc_html__('Search Results for: %s', 'the-newsmag'), get_search_query()); ?></span></h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while (have_posts()) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part('template-parts/content', get_post_format());

			endwhile;

			the_posts_pagination();

		else :

			get_template_part('template-parts/content', 'none');

		endif;
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php the_newsmag_sidebar_select(); ?>

<?php do_action('the_newsmag_after_body_content'); ?>

<?php get_footer(); ?>
