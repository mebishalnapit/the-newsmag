<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The NewsMag
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="article-container clear">
		<?php do_action('the_newsmag_before_post_content'); ?>

		<div class="post-header-wrapper clear">
			<?php if (has_post_thumbnail()) : ?>

				<?php
				$image_popup_id = get_post_thumbnail_id();
				$image_popup_url = wp_get_attachment_url($image_popup_id);
				?>

				<figure class="featured-image">
					<?php if (get_theme_mod('the_newsmag_featured_image_popup', 0) == 1) { ?>
						<a href="<?php echo $image_popup_url; ?>" class="featured-image-popup" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('the-newsmag-featured-large-thumbnail'); ?></a>
					<?php } else { ?>
						<?php the_post_thumbnail('the-newsmag-featured-large-thumbnail'); ?>
					<?php } ?>
				</figure>

			<?php endif; ?>

			<header class="entry-header clear">
				<?php
				if (is_front_page()) :
					the_title('<h2 class="entry-title">', '</h2>');
				else :
					the_title('<h1 class="entry-title">', '</h1>');
				endif;
				?>
			</header><!-- .entry-header -->
		</div>

		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages(array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'the-newsmag'),
				'after' => '</div>',
			));
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php
			edit_post_link(
					wp_kses(sprintf(
									/* translators: %s: Name of current post */
									__('<i class="fa fa-edit"></i>Edit %s', 'the-newsmag'), the_title('<span class="screen-reader-text">"', '"</span>', false)
							), array('i' => array('class' => array()), 'span' => array('class' => array()))), '<span class="edit-link">', '</span>'
			);
			?>
		</footer><!-- .entry-footer -->

		<?php do_action('the_newsmag_after_post_content'); ?>
	</div>
</article><!-- #post-## -->
