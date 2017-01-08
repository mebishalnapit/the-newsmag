<?php
/**
 * This fucntion is used to create custom meta boxes in pages/posts to render the left/right sidebar
 *
 * @package The NewsMag
 */
add_action('add_meta_boxes', 'the_newsmag_custom_meta_boxes');

/**
 * Adding the Custom Meta Box
 */
function the_newsmag_custom_meta_boxes() {
	// Adding the layout meta box for single page
	add_meta_box('page-layout', esc_html__('Select Layout', 'the-newsmag'), 'the_newsmag_page_layout', 'page', 'side', 'default');
	// Adding the layout meta box for single post page
	add_meta_box('page-layout', esc_html__('Select Layout', 'the-newsmag'), 'the_newsmag_page_layout', 'post', 'side', 'default');
}

/**
 * Adding the sidebar display of the meta option in the editor
 */
global $the_newsmag_page_layout;
$the_newsmag_page_layout = array(
	'default-layout' => array(
		'id' => 'the_newsmag_page_layout',
		'value' => 'default_layout',
		'label' => esc_html__('Default Layout', 'the-newsmag'),
	),
	'right-sidebar' => array(
		'id' => 'the_newsmag_page_layout',
		'value' => 'right_sidebar',
		'label' => esc_html__('Right Sidebar', 'the-newsmag'),
	),
	'left-sidebar' => array(
		'id' => 'the_newsmag_page_layout',
		'value' => 'left_sidebar',
		'label' => esc_html__('Left Sidebar', 'the-newsmag'),
	),
	'no-sidebar-full-width' => array(
		'id' => 'the_newsmag_page_layout',
		'value' => 'no_sidebar_full_width',
		'label' => esc_html__('No Sidebar Full Width', 'the-newsmag'),
	),
	'no-sidebar-content-centered' => array(
		'id' => 'the_newsmag_page_layout',
		'value' => 'no_sidebar_content_centered',
		'label' => esc_html__('No Sidebar Content Centered', 'the-newsmag'),
	),
);

/**
 * Displaying the metabox in the editor section for select layout option of the post/page individually
 */
function the_newsmag_page_layout() {
	global $the_newsmag_page_layout, $post;

	// Use nonce for verification
	wp_nonce_field(basename(__FILE__), 'custom_meta_box_nonce');

	foreach ($the_newsmag_page_layout as $field) {
		$the_newsmag_layout_meta = get_post_meta($post->ID, $field['id'], true);
		if (empty($the_newsmag_layout_meta)) {
			$the_newsmag_layout_meta = 'default_layout';
		}
		?>
		<input class="post-format" id="<?php echo esc_attr($field['value']); ?>" type="radio" name="<?php echo esc_attr($field['id']); ?>" value="<?php echo esc_attr($field['value']); ?>" <?php checked($field['value'], $the_newsmag_layout_meta); ?>/>
		<label for="<?php echo esc_attr($field['value']); ?>" class="post-format-icon"><?php echo esc_html($field['label']); ?></label><br/>
		<?php
	}
}

/**
 * Save the custom metabox data
 */
if (!function_exists('the_newsmag_save_custom_meta_data')) :

	function the_newsmag_save_custom_meta_data($post_id) {
		global $the_newsmag_page_layout, $post;

		// Verify the nonce before proceeding.
		$the_newsmag_metabox_nonce = '';
		if (isset($_POST['custom_meta_box_nonce'])) {
			$the_newsmag_metabox_nonce = sanitize_text_field(wp_unslash($_POST['custom_meta_box_nonce']));
		}
		if (!$the_newsmag_metabox_nonce || !wp_verify_nonce($the_newsmag_metabox_nonce, basename(__FILE__))) {
			return;
		}

		// Stop WP from clearing custom fields on autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		$the_newsmag_post_type = '';
		if (isset($_POST['post_type'])) {
			$the_newsmag_post_type = sanitize_text_field(wp_unslash($_POST['post_type']));
		}
		if ('page' == $the_newsmag_post_type) {
			if (!current_user_can('edit_page', $post_id))
				return $post_id;
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		foreach ($the_newsmag_page_layout as $field) {
			// Execute this saving function
			$the_newsmag_field_id = '';
			if (isset($_POST[$field['id']])) {
				$the_newsmag_field_id = sanitize_key(wp_unslash($_POST[$field['id']]));
			}

			$old_meta_data = get_post_meta($post_id, $field['id'], true);
			$new_meta_data = $the_newsmag_field_id;
			if ($new_meta_data && $new_meta_data != $old_meta_data) {
				update_post_meta($post_id, $field['id'], $new_meta_data);
			} elseif ('' == $new_meta_data && $old_meta_data) {
				delete_post_meta($post_id, $field['id'], $old_meta_data);
			}
		} // end foreach
	}

endif;

add_action('pre_post_update', 'the_newsmag_save_custom_meta_data');
