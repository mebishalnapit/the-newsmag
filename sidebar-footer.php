<?php
/**
 * The sidebar containing the footer widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The NewsMag
 */
if (!is_active_sidebar('the-newsmag-large-footer-sidebar') && !is_active_sidebar('the-newsmag-small-footer-sidebar-one') && !is_active_sidebar('the-newsmag-small-footer-sidebar-two') && !is_active_sidebar('the-newsmag-masonry-footer-sidebar')) {
	return;
}
?>

<div id="footer-widgets-area" class="footer-widgets">
	<?php if (is_active_sidebar('the-newsmag-large-footer-sidebar') || is_active_sidebar('the-newsmag-small-footer-sidebar-one') || is_active_sidebar('the-newsmag-small-footer-sidebar-two')) : ?>
		<div class="footer-sidebar-top-area clear">
			<div class="inner-wrap">
				<div class="footer-wide-sidebar footer-sidebar-areas">
					<?php
					if (is_active_sidebar('the-newsmag-large-footer-sidebar')) {
						dynamic_sidebar('the-newsmag-large-footer-sidebar');
					}
					?>
				</div>
				<div class="footer-small-sidebar footer-sidebar-areas">
					<?php
					if (is_active_sidebar('the-newsmag-small-footer-sidebar-one')) {
						dynamic_sidebar('the-newsmag-small-footer-sidebar-one');
					}
					?>
				</div>
				<div class="footer-small-sidebar footer-sidebar-areas">
					<?php
					if (is_active_sidebar('the-newsmag-small-footer-sidebar-two')) {
						dynamic_sidebar('the-newsmag-small-footer-sidebar-two');
					}
					?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if (is_active_sidebar('the-newsmag-masonry-footer-sidebar')) : ?>
		<div class="footer-sidebar-masonry-area clear">
			<div class="inner-wrap">
				<div class="footer-masonry-sidebar">
					<?php
					if (is_active_sidebar('the-newsmag-masonry-footer-sidebar')) {
						dynamic_sidebar('the-newsmag-masonry-footer-sidebar');
					}
					?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>
