<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The NewsMag
 */
?>

				</div><!-- .content -->
			</div><!-- #content -->

			<?php if (is_active_sidebar('the-newsmag-content-bottom-sidebar')) { ?>
				<div class="content-bottom-sidebar-area">
					<div class="inner-wrap">
						<?php dynamic_sidebar('the-newsmag-content-bottom-sidebar'); ?>
					</div>
				</div>
			<?php } ?>

			<?php do_action('the_newsmag_before_footer'); ?>
			<footer id="colophon" class="site-footer" role="contentinfo">
				<?php get_sidebar('footer'); ?>
				<?php if (has_nav_menu('social')) : ?>
					<div class="footer-social-menu">
						<div class="inner-wrap">
							<div class="social-menu">
								<?php the_newsmag_social_menu(); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<div class="site-info clear">
					<div class="footer-bottom-area clear">
						<div class="inner-wrap">
							<?php the_newsmag_footer_copyright(); ?>
							<div class="footer-menu">
								<?php
								if (has_nav_menu('footer')) {
									wp_nav_menu(array('theme_location' => 'footer', 'depth' => '-1', 'menu_id' => 'footer-menu'));
								}
								?>
							</div>
						</div>
					</div>
				</div><!-- .site-info -->
			</footer><!-- #colophon -->
			<a href="#masthead" id="scroll-up"><i class="fa fa-arrow-up"></i></a>
			<?php do_action('the_newsmag_after_footer'); ?>
		</div><!-- #page -->

	<?php wp_footer(); ?>

	</body>
</html>
