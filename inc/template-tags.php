<?php

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package The NewsMag
 */
if (!function_exists('the_newsmag_posted_on')) :

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function the_newsmag_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf($time_string, esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_attr(get_the_modified_date('c')), esc_html(get_the_modified_date())
		);

		$posted_on = sprintf(
				'%s', '<span class="entry-meta-left-calendar"><a href="' . esc_url(get_permalink()) . '" rel="bookmark"><i class="fa fa-calendar"></i></a></span>' . '<span class="entry-meta-left-section">' . esc_html__('Posted on:', 'the-newsmag') . '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a></span>'
		);

		$byline = sprintf(
				'%s', '<span class="entry-meta-left-author"><a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . get_avatar(get_the_author_meta('user_email'), '60') . '</a></span>' . '<span class="entry-meta-left-section">' . esc_html__('Written by:', 'the-newsmag') . '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>';

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

		if (!has_post_thumbnail() && (is_single() && !post_password_required() && (comments_open() || get_comments_number()))) {
			echo '<span class="comments-link">';
			echo '<span class="entry-meta-left-comments">';
			comments_popup_link(wp_kses(__('<i class="fa fa-comment"></i>', 'the-newsmag'), array('i' => array('class' => array()))), wp_kses(__('<i class="fa fa-comment"></i>', 'the-newsmag'), array('i' => array('class' => array()))), wp_kses(__('<i class="fa fa-comment"></i>', 'the-newsmag'), array('i' => array('class' => array()))), '', wp_kses(__('<i class="fa fa-comment"></i>', 'the-newsmag'), array('i' => array('class' => array()))));
			echo '</span>';

			echo '<span class="entry-meta-left-section">';
			comments_popup_link(esc_html__('Leave a reply', 'the-newsmag'), esc_html__('1 Comment', 'the-newsmag'), esc_html__('% Comments', 'the-newsmag'), '', esc_html__('Comments Disabled', 'the-newsmag'));
			echo '</span>';
			echo '</span>';
		}
	}

endif;

if (!function_exists('the_newsmag_entry_footer')) :

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function the_newsmag_entry_footer() {
		// Hide category and tag text for pages.
		if ('post' === get_post_type()) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', esc_html__(', ', 'the-newsmag'));
			if ($tags_list) {
				printf('<span class="tags-links"><i class="fa fa-tags"></i>' . esc_html__('%1$s', 'the-newsmag') . '</span>', $tags_list); // WPCS: XSS OK.
			}
		}

		edit_post_link(
				wp_kses(sprintf(
								/* translators: %s: Name of current post */
								__('<i class="fa fa-edit"></i>Edit %s', 'the-newsmag'), the_title('<span class="screen-reader-text">"', '"</span>', false)
						), array('i' => array('class' => array()), 'span' => array('class' => array()))), '<span class="edit-link">', '</span>'
		);
	}

endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function the_newsmag_categorized_blog() {
	if (false === ( $all_the_cool_cats = get_transient('the_newsmag_categories') )) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(array(
			'fields' => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number' => 2,
		));

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count($all_the_cool_cats);

		set_transient('the_newsmag_categories', $all_the_cool_cats);
	}

	if ($all_the_cool_cats > 1) {
		// This blog has more than 1 category so the_newsmag_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so the_newsmag_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in the_newsmag_categorized_blog.
 */
function the_newsmag_category_transient_flusher() {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient('the_newsmag_categories');
}

add_action('edit_category', 'the_newsmag_category_transient_flusher');
add_action('save_post', 'the_newsmag_category_transient_flusher');
