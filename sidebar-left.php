<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The NewsMag
 */
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php do_action('the_newsmag_before_sidebar'); ?>

	<?php
	if (is_page_template('page-template/contact.php')) {
		$sidebar = 'the-newsmag-contact-page-sidebar';
	} else {
		$sidebar = 'the-newsmag-left-sidebar';
	}
	?>

	<?php
	if (!dynamic_sidebar($sidebar)) :
		if ($sidebar == 'the-newsmag-contact-page-sidebar') {
			$sidebar_display_text = esc_html__('Contact Page', 'the-newsmag');
		} else {
			$sidebar_display_text = esc_html__('Left', 'the-newsmag');
		}

		// displaying the default widget text if no widget is associated with it
		the_widget('WP_Widget_Text', array(
			'title' => esc_html__('Example Widget', 'the-newsmag'),
			'text' => sprintf(esc_html__('This is an example widget to show how the %1$s Sidebar looks by default. You can add custom widgets from the %2$swidgets screen%3$s in the admin area. If the custom widget is added in this sidebar, then, this will be replaced by those widgets.', 'the-newsmag'), $sidebar_display_text, current_user_can('edit_theme_options') ? '<a href="' . esc_url(admin_url('widgets.php')) . '">' : '', current_user_can('edit_theme_options') ? '</a>' : '' ),
			'filter' => true,
				), array(
			'before_widget' => '<section class="widget widget_text">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>'
				)
		);
	endif;
	?>

	<?php do_action('the_newsmag_after_sidebar'); ?>
</aside><!-- #secondary -->
