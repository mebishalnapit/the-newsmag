<?php
/**
 * Template Name: Contact Page
 *
 * @package The NewsMag
 */
get_header();
?>

<?php do_action('the_newsmag_before_body_content'); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php
		while (have_posts()) : the_post();

			get_template_part('template-parts/content', 'page');

			do_action('the_newsmag_before_comments_template');
			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php the_newsmag_sidebar_select(); ?>

<?php do_action('the_newsmag_after_body_content'); ?>

<?php get_footer(); ?>
