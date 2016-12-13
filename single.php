<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

			get_template_part('template-parts/content', get_post_format());

			// function to retrieve previous post
			$prev_post = get_previous_post();
			if ($prev_post) {
				$prev_thumb_image = get_the_post_thumbnail($prev_post->ID, 'the-newsmag-featured-small-thumbnail');
			} else {
				$prev_thumb_image = '';
			}

			// function to retrieve next post
			$next_post = get_next_post();
			if ($next_post) {
				$next_thumb_image = get_the_post_thumbnail($next_post->ID, 'the-newsmag-featured-small-thumbnail');
			} else {
				$next_thumb_image = '';
			}

			the_post_navigation(array(
				'next_text' => '<span class="post-navigation-thumb">' . $next_thumb_image . '</span>' . '<span class="meta-nav next" aria-hidden="true">' . esc_html__('Next Post', 'the-newsmag') . '</span> ' . '<span class="screen-reader-text">' . esc_html__('Next post:', 'the-newsmag') . '</span> ' . '<span class="post-title clear">%title</span>',
				'prev_text' => '<span class="post-navigation-thumb">' . $prev_thumb_image . '</span>' . '<span class="meta-nav prev" aria-hidden="true">' . esc_html__('Previous Post', 'the-newsmag') . '</span> ' . '<span class="screen-reader-text">' . esc_html__('Previous post:', 'the-newsmag') . '</span> ' . '<span class="post-title clear">%title</span>',
			));
			?>

			<?php the_newsmag_author_bio(); ?>

			<?php
			if (get_theme_mod('the_newsmag_related_posts_activate', 0) == 1) {
				get_template_part('inc/related-posts');
			}
			?>

			<?php
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
