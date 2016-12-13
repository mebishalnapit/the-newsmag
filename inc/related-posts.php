<?php
/**
 * Template to show the related posts of the single posts
 */
?>

<?php $related_posts = the_newsmag_related_posts_function(); ?>

<?php if ($related_posts->have_posts()): ?>
	<div class="related-posts-main">

		<h4 class="related-posts-main-title"><span><?php esc_html_e('Similar Articles', 'the-newsmag'); ?></span></h4>

		<div class="related-posts-total clear">

			<?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
				<div class="related-posts columns">

					<div class="related-post-contents clear">

						<?php if (has_post_thumbnail()): ?>
							<figure class="featured-image">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail('the-newsmag-featured-related-posts-thumbnail'); ?>
								</a>

								<h3 class="entry-title">
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								</h3><!-- .entry-title -->
							</figure>
						<?php endif; ?>

						<?php if (!has_post_thumbnail()): ?>
							<h3 class="entry-title">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
							</h3><!-- .entry-title -->
						<?php endif; ?>

						<div class="entry-meta">
							<?php the_newsmag_posts_posted_on(); ?>
						</div><!-- .entry-meta -->

					</div>

				</div><!--.related-posts-->
			<?php endwhile; ?>

		</div><!-- .related-posts-total -->
	</div><!-- .related-posts-main -->

	<?php wp_reset_postdata(); ?>

<?php endif; ?>
