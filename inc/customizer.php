<?php
/**
 * The NewsMag Theme Customizer.
 *
 * @package The NewsMag
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function the_newsmag_customize_register($wp_customize) {
	$wp_customize->get_setting('blogname')->transport = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	// extending Customizer Class to add the theme important links
	class The_NewsMag_Important_Links extends WP_Customize_Control {

		public $type = "the-newsmag-important-links";

		public function render_content() {
			$important_links = array(
				'theme-info' => array(
					'link' => esc_url('https://napitwptech.com/themes/the-newsmag/'),
					'text' => esc_html__('View Theme Info', 'the-newsmag'),
				),
				'documentation' => array(
					'link' => esc_url('https://napitwptech.com/themes/the-newsmag/the-newsmag-wordpress-theme-documentation/'),
					'text' => esc_html__('Theme Documentation', 'the-newsmag'),
				),
				'demo' => array(
					'link' => esc_url('https://demo.napitwptech.com/the-newsmag/'),
					'text' => esc_html__('View Theme Demo', 'the-newsmag'),
				),
				'contact' => array(
					'link' => esc_url('https://napitwptech.com/contact-us/'),
					'text' => esc_html__('Contact Us', 'the-newsmag'),
				),
				'forum' => array(
					'link' => esc_url('https://support.napitwptech.com/forums/forum/the-newsmag/'),
					'text' => esc_html__('Support Forum', 'the-newsmag'),
				),
				'rating' => array(
					'link' => esc_url('https://wordpress.org/support/theme/the-newsmag/reviews/'),
					'text' => esc_html__('Rate This Theme', 'the-newsmag'),
				),
			);
			foreach ($important_links as $important_link) {
				echo '<p><a target="_blank" href="' . esc_url($important_link['link']) . '" >' . esc_attr($important_link['text']) . ' </a></p>';
			}
		}

	}

	// adding section for the theme important links
	$wp_customize->add_section('the_newsmag_important_links_section', array(
		'priority' => 1,
		'title' => esc_html__('Theme Important Links', 'the-newsmag'),
	));

	// adding setting for the theme important links
	$wp_customize->add_setting('the_newsmag_important_links', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_important_links_sanitize'
	));

	// adding control for the theme important links
	$wp_customize->add_control(new The_NewsMag_Important_Links($wp_customize, 'the_newsmag_important_links', array(
		'section' => 'the_newsmag_important_links_section',
		'setting' => 'the_newsmag_important_links'
	)));

	// Start Of Header Options
	$wp_customize->add_panel('the_newsmag_header_options', array(
		'capabitity' => 'edit_theme_options',
		'description' => esc_html__('Change the Header Settings from here as you want to best suit your need.', 'the-newsmag'),
		'priority' => 500,
		'title' => esc_html__('Header Options', 'the-newsmag')
	));

	// date display enable/disable
	$wp_customize->add_section('the_newsmag_date_display_section', array(
		'priority' => 1,
		'title' => esc_html__('Show Date', 'the-newsmag'),
		'panel' => 'the_newsmag_header_options'
	));

	$wp_customize->add_setting('the_newsmag_date_display', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_checkbox_sanitize'
	));

	$wp_customize->add_control('the_newsmag_date_display', array(
		'type' => 'checkbox',
		'label' => esc_html__('Check to show the date in header area.', 'the-newsmag'),
		'section' => 'the_newsmag_date_display_section',
		'settings' => 'the_newsmag_date_display'
	));

	// date in header display type
	$wp_customize->add_setting('the_newsmag_date_display_type', array(
		'default' => 'theme_default',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_radio_select_sanitize'
	));

	$wp_customize->add_control('the_newsmag_date_display_type', array(
		'type' => 'radio',
		'label' => esc_html__('Date in header display type:', 'the-newsmag'),
		'choices' => array(
			'theme_default' => esc_html__('Theme Default Setting', 'the-newsmag'),
			'wordpress_date_setting' => esc_html__('WordPress General Date Setting', 'the-newsmag'),
		),
		'section' => 'the_newsmag_date_display_section',
		'settings' => 'the_newsmag_date_display_type'
	));

	// small info text in header
	$wp_customize->add_section('the_newsmag_header_text_setting', array(
		'priority' => 2,
		'title' => esc_html__('Small Info Text', 'the-newsmag'),
		'panel' => 'the_newsmag_header_options'
	));

	$wp_customize->add_setting('the_newsmag_header_text', array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'wp_kses_post'
	));

	$wp_customize->add_control('the_newsmag_header_text', array(
		'type' => 'textarea',
		'label' => esc_html__('Write your custom text to display it in the header top bar. It also accepts the shortcodes too.', 'the-newsmag'),
		'section' => 'the_newsmag_header_text_setting',
		'settings' => 'the_newsmag_header_text'
	));

	// home icon display enable/disable
	$wp_customize->add_section('the_newsmag_home_icon_display_section', array(
		'priority' => 3,
		'title' => esc_html__('Home Icon', 'the-newsmag'),
		'panel' => 'the_newsmag_header_options'
	));

	$wp_customize->add_setting('the_newsmag_home_icon_display', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_checkbox_sanitize'
	));

	$wp_customize->add_control('the_newsmag_home_icon_display', array(
		'type' => 'checkbox',
		'label' => esc_html__('Check to add the home icon in the primary menu.', 'the-newsmag'),
		'section' => 'the_newsmag_home_icon_display_section',
		'settings' => 'the_newsmag_home_icon_display'
	));

	// random posts in menu enable/disable
	$wp_customize->add_section('the_newsmag_random_post_in_menu_section', array(
		'priority' => 4,
		'title' => esc_html__('Random Post', 'the-newsmag'),
		'panel' => 'the_newsmag_header_options'
	));

	$wp_customize->add_setting('the_newsmag_random_post_in_menu', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_checkbox_sanitize'
	));

	$wp_customize->add_control('the_newsmag_random_post_in_menu', array(
		'type' => 'checkbox',
		'label' => esc_html__('Check to display the random post icon in the primary menu.', 'the-newsmag'),
		'section' => 'the_newsmag_random_post_in_menu_section',
		'settings' => 'the_newsmag_random_post_in_menu'
	));

	// search icon in menu enable/disable
	$wp_customize->add_section('the_newsmag_search_icon_in_menu_section', array(
		'priority' => 5,
		'title' => esc_html__('Search Icon', 'the-newsmag'),
		'panel' => 'the_newsmag_header_options'
	));

	$wp_customize->add_setting('the_newsmag_search_icon_in_menu', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_checkbox_sanitize'
	));

	$wp_customize->add_control('the_newsmag_search_icon_in_menu', array(
		'type' => 'checkbox',
		'label' => esc_html__('Check to display the search icon in the primary menu.', 'the-newsmag'),
		'section' => 'the_newsmag_search_icon_in_menu_section',
		'settings' => 'the_newsmag_search_icon_in_menu'
	));

	// menu animation using superfish js library enable/disable
	$wp_customize->add_section('the_newsmag_superfish_menu_section', array(
		'priority' => 6,
		'title' => esc_html__('Menu Animation', 'the-newsmag'),
		'panel' => 'the_newsmag_header_options'
	));

	$wp_customize->add_setting('the_newsmag_superfish_menu', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_checkbox_sanitize'
	));

	$wp_customize->add_control('the_newsmag_superfish_menu', array(
		'type' => 'checkbox',
		'label' => esc_html__('Check to enable the animation effect on the primary menu.', 'the-newsmag'),
		'section' => 'the_newsmag_superfish_menu_section',
		'settings' => 'the_newsmag_superfish_menu'
	));

	// sticky menu section
	$wp_customize->add_section('the_newsmag_sticky_menu_section', array(
		'priority' => 7,
		'title' => esc_html__('Sticky Menu', 'the-newsmag'),
		'panel' => 'the_newsmag_header_options'
	));

	// sticky menu enable/disable
	$wp_customize->add_setting('the_newsmag_sticky_menu_option', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_checkbox_sanitize'
	));

	$wp_customize->add_control('the_newsmag_sticky_menu_option', array(
		'type' => 'checkbox',
		'label' => esc_html__('Check to make the primary menu sticky.', 'the-newsmag'),
		'section' => 'the_newsmag_sticky_menu_section',
		'settings' => 'the_newsmag_sticky_menu_option'
	));

	// sticky menu options
	$wp_customize->add_setting('the_newsmag_sticky_menu_type', array(
		'default' => 'scroll',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_radio_select_sanitize'
	));

	$wp_customize->add_control('the_newsmag_sticky_menu_type', array(
		'type' => 'radio',
		'label' => esc_html__('Choose the required option to make your menu sticky.', 'the-newsmag'),
		'choices' => array(
			'scroll' => esc_html__('Make the menu reveal on scroll up.', 'the-newsmag'),
			'sticky' => esc_html__('Make the menu sticky, ie, always stick the menu in top.', 'the-newsmag')
		),
		'section' => 'the_newsmag_sticky_menu_section',
		'settings' => 'the_newsmag_sticky_menu_type'
	));

	// breaking news option enable/disable
	$wp_customize->add_section('the_newsmag_breaking_news_section', array(
		'priority' => 8,
		'title' => esc_html__('Breaking News', 'the-newsmag'),
		'panel' => 'the_newsmag_header_options'
	));

	$wp_customize->add_setting('the_newsmag_breaking_news', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_checkbox_sanitize'
	));

	$wp_customize->add_control('the_newsmag_breaking_news', array(
		'type' => 'checkbox',
		'label' => esc_html__('Check to enable the breaking news section.', 'the-newsmag'),
		'section' => 'the_newsmag_breaking_news_section',
		'settings' => 'the_newsmag_breaking_news'
	));
	// End Of Header Options
	// Start Of Design Options
	$wp_customize->add_panel('the_newsmag_design_options', array(
		'capabitity' => 'edit_theme_options',
		'description' => esc_html__('Change the Design Settings from here as you want to best suit your need.', 'the-newsmag'),
		'priority' => 505,
		'title' => esc_html__('Design Options', 'the-newsmag')
	));

	// site layout setting
	$wp_customize->add_section('the_newsmag_site_layout_setting', array(
		'priority' => 1,
		'title' => esc_html__('Site Layout', 'the-newsmag'),
		'panel' => 'the_newsmag_design_options'
	));

	$wp_customize->add_setting('the_newsmag_site_layout', array(
		'default' => 'wide_layout',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_radio_select_sanitize'
	));

	$wp_customize->add_control('the_newsmag_site_layout', array(
		'type' => 'radio',
		'label' => esc_html__('Choose your site layout. The change is reflected in the whole site.', 'the-newsmag'),
		'choices' => array(
			'boxed_layout' => esc_html__('Boxed Layout', 'the-newsmag'),
			'wide_layout' => esc_html__('Wide Layout', 'the-newsmag')
		),
		'section' => 'the_newsmag_site_layout_setting'
	));

	// layout option
	class The_NewsMag_Image_Radio_Control extends WP_Customize_Control {

		public function render_content() {

			if (empty($this->choices))
				return;

			$name = '_customize-radio-' . $this->id;
			?>
			<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
			<ul class="controls" id='the-newsmag-img-container'>
				<?php
				foreach ($this->choices as $value => $label) :
					$class = ($this->value() == $value) ? 'the-newsmag-radio-img-selected the-newsmag-radio-img-img' : 'the-newsmag-radio-img-img';
					?>
					<li style="display: inline;">
						<label>
							<input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr($value); ?>" name="<?php echo esc_attr($name); ?>" <?php
														  $this->link();
														  checked($this->value(), $value);
														  ?> />
							<img src='<?php echo esc_url($label); ?>' class='<?php echo esc_attr($class); ?>' />
						</label>
					</li>
					<?php
				endforeach;
				?>
			</ul>
			<?php
		}

	}

	// default layout setting
	$wp_customize->add_section('the_newsmag_default_layout_setting', array(
		'priority' => 2,
		'title' => esc_html__('Default layout', 'the-newsmag'),
		'panel' => 'the_newsmag_design_options'
	));

	$wp_customize->add_setting('the_newsmag_default_layout', array(
		'default' => 'right_sidebar',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_radio_select_sanitize'
	));

	$wp_customize->add_control(new The_NewsMag_Image_Radio_Control($wp_customize, 'the_newsmag_default_layout', array(
		'type' => 'radio',
		'label' => esc_html__('Select default layout. This layout will be reflected in whole site archives, categories, search page etc. The layout for a single post and page can be controlled from the other options available in this theme.', 'the-newsmag'),
		'section' => 'the_newsmag_default_layout_setting',
		'settings' => 'the_newsmag_default_layout',
		'choices' => array(
			'right_sidebar' => get_template_directory_uri() . '/img/right-sidebar.png',
			'left_sidebar' => get_template_directory_uri() . '/img/left-sidebar.png',
			'no_sidebar_full_width' => get_template_directory_uri() . '/img/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered' => get_template_directory_uri() . '/img/no-sidebar-content-centered-layout.png'
		)
	)));

	// default layout for pages
	$wp_customize->add_section('the_newsmag_default_page_layout_setting', array(
		'priority' => 3,
		'title' => esc_html__('Default layout for pages only', 'the-newsmag'),
		'panel' => 'the_newsmag_design_options'
	));

	$wp_customize->add_setting('the_newsmag_default_page_layout', array(
		'default' => 'right_sidebar',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_radio_select_sanitize'
	));

	$wp_customize->add_control(new The_NewsMag_Image_Radio_Control($wp_customize, 'the_newsmag_default_page_layout', array(
		'type' => 'radio',
		'label' => esc_html__('Select default layout for pages. This layout will be reflected in all pages unless unique layout is set for the specific page.', 'the-newsmag'),
		'section' => 'the_newsmag_default_page_layout_setting',
		'settings' => 'the_newsmag_default_page_layout',
		'choices' => array(
			'right_sidebar' => get_template_directory_uri() . '/img/right-sidebar.png',
			'left_sidebar' => get_template_directory_uri() . '/img/left-sidebar.png',
			'no_sidebar_full_width' => get_template_directory_uri() . '/img/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered' => get_template_directory_uri() . '/img/no-sidebar-content-centered-layout.png'
		)
	)));

	// default layout for single posts
	$wp_customize->add_section('the_newsmag_default_single_posts_layout_setting', array(
		'priority' => 4,
		'title' => esc_html__('Default layout for single posts only', 'the-newsmag'),
		'panel' => 'the_newsmag_design_options'
	));

	$wp_customize->add_setting('the_newsmag_default_single_posts_layout', array(
		'default' => 'right_sidebar',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_radio_select_sanitize'
	));

	$wp_customize->add_control(new The_NewsMag_Image_Radio_Control($wp_customize, 'the_newsmag_default_single_posts_layout', array(
		'type' => 'radio',
		'label' => esc_html__('Select default layout for single posts. This layout will be reflected in all single posts unless unique layout is set for the specific post.', 'the-newsmag'),
		'section' => 'the_newsmag_default_single_posts_layout_setting',
		'settings' => 'the_newsmag_default_single_posts_layout',
		'choices' => array(
			'right_sidebar' => get_template_directory_uri() . '/img/right-sidebar.png',
			'left_sidebar' => get_template_directory_uri() . '/img/left-sidebar.png',
			'no_sidebar_full_width' => get_template_directory_uri() . '/img/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered' => get_template_directory_uri() . '/img/no-sidebar-content-centered-layout.png'
		)
	)));

	if (!function_exists('wp_update_custom_css_post')) {
		// custom CSS setting
		$wp_customize->add_section('the_newsmag_custom_css_setting', array(
			'priority' => 6,
			'title' => esc_html__('Custom CSS', 'the-newsmag'),
			'panel' => 'the_newsmag_design_options'
		));

		$wp_customize->add_setting('the_newsmag_custom_css', array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'sanitize_js_callback' => 'wp_filter_nohtml_kses'
		));

		$wp_customize->add_control('the_newsmag_custom_css', array(
			'type' => 'textarea',
			'label' => esc_html__('Write your custom css and design live.', 'the-newsmag'),
			'section' => 'the_newsmag_custom_css_setting',
			'settings' => 'the_newsmag_custom_css'
		));
	}
	// End Of Design Options
	// Start of the WordPress default sections for theme related options
	// header image link enable/disable
	$wp_customize->add_setting('the_newsmag_header_image_link', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_checkbox_sanitize'
	));

	$wp_customize->add_control('the_newsmag_header_image_link', array(
		'type' => 'checkbox',
		'label' => esc_html__('Check to enable the header image to link back to the home page.', 'the-newsmag'),
		'section' => 'header_image',
		'settings' => 'the_newsmag_header_image_link'
	));

	// primary color options
	$wp_customize->add_setting('the_newsmag_primary_color', array(
		'default' => '#4169e1',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_color_option_hex_sanitize',
		'sanitize_js_callback' => 'the_newsmag_color_escaping_option_sanitize'
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'the_newsmag_primary_color', array(
		'label' => esc_html__('Primary Color', 'the-newsmag'),
		'section' => 'colors',
		'settings' => 'the_newsmag_primary_color'
	)));

	// End of the WordPress default sections for theme related options
	// Start of Additional Options
	$wp_customize->add_panel('the_newsmag_additional_options', array(
		'capability' => 'edit_theme_options',
		'description' => esc_html__('Change the Additional Settings from here as you want to best suite your site.', 'the-newsmag'),
		'priority' => 515,
		'title' => esc_html__('Additional Options', 'the-newsmag')
	));

	// related posts
	$wp_customize->add_section('the_newsmag_related_posts_section', array(
		'priority' => 1,
		'title' => esc_html__('Related Posts', 'the-newsmag'),
		'panel' => 'the_newsmag_additional_options'
	));

	$wp_customize->add_setting('the_newsmag_related_posts_activate', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_checkbox_sanitize'
	));

	$wp_customize->add_control('the_newsmag_related_posts_activate', array(
		'type' => 'checkbox',
		'label' => esc_html__('Check to activate the related posts.', 'the-newsmag'),
		'section' => 'the_newsmag_related_posts_section',
		'settings' => 'the_newsmag_related_posts_activate'
	));

	$wp_customize->add_setting('the_newsmag_related_posts', array(
		'default' => 'categories',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_radio_select_sanitize'
	));

	$wp_customize->add_control('the_newsmag_related_posts', array(
		'type' => 'radio',
		'label' => esc_html__('Related Posts To Be Shown As:', 'the-newsmag'),
		'section' => 'the_newsmag_related_posts_section',
		'settings' => 'the_newsmag_related_posts',
		'choices' => array(
			'categories' => esc_html__('Related Posts By Categories', 'the-newsmag'),
			'tags' => esc_html__('Related Posts By Tags', 'the-newsmag')
		)
	));

	// featured image popup check
	$wp_customize->add_section('the_newsmag_featured_image_popup_setting', array(
		'priority' => 2,
		'title' => esc_html__('Image Lightbox', 'the-newsmag'),
		'panel' => 'the_newsmag_additional_options'
	));

	$wp_customize->add_setting('the_newsmag_featured_image_popup', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_checkbox_sanitize'
	));

	$wp_customize->add_control('the_newsmag_featured_image_popup', array(
		'type' => 'checkbox',
		'label' => esc_html__('Check to enable the lightbox feature for the featured images in single post page and pages.', 'the-newsmag'),
		'section' => 'the_newsmag_featured_image_popup_setting',
		'settings' => 'the_newsmag_featured_image_popup'
	));

	// author bio links
	$wp_customize->add_section('the_newsmag_author_bio_social_links_setting', array(
		'priority' => 3,
		'title' => esc_html__('Social Links In Author Bio', 'the-newsmag'),
		'panel' => 'the_newsmag_additional_options'
	));

	$wp_customize->add_setting('the_newsmag_author_bio_social_links', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_checkbox_sanitize'
	));

	$wp_customize->add_control('the_newsmag_author_bio_social_links', array(
		'type' => 'checkbox',
		'label' => esc_html__('Check to enable the social links in the Author Bio section. For this to work, you need to add the URL of your social sites in the profile section. This theme supports WordPress SEO and All In One SEO Pack plugin for this feature.', 'the-newsmag'),
		'section' => 'the_newsmag_author_bio_social_links_setting',
		'settings' => 'the_newsmag_author_bio_social_links'
	));

	// Sticky Sidebar and Content area
	$wp_customize->add_section('the_newsmag_sticky_sidebar_content_setting', array(
		'priority' => 3,
		'title' => esc_html__('Sticky Sidebar And Content Area', 'the-newsmag'),
		'panel' => 'the_newsmag_additional_options'
	));

	$wp_customize->add_setting('the_newsmag_sticky_sidebar_content', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'the_newsmag_checkbox_sanitize'
	));

	$wp_customize->add_control('the_newsmag_sticky_sidebar_content', array(
		'type' => 'checkbox',
		'label' => esc_html__('Check to enable the feature of sticky sidebar and content area.', 'the-newsmag'),
		'section' => 'the_newsmag_sticky_sidebar_content_setting',
		'settings' => 'the_newsmag_sticky_sidebar_content'
	));
	// End of Additional Options
	// Category Color Options
	$wp_customize->add_panel('the_newsmag_category_color_panel', array(
		'priority' => 700,
		'title' => esc_html__('Category Color Options', 'the-newsmag'),
		'capability' => 'edit_theme_options',
		'description' => esc_html__('Change the color of each category items as you want to best suit your site requirement.', 'the-newsmag')
	));

	$wp_customize->add_section('the_newsmag_category_color_setting', array(
		'priority' => 1,
		'title' => esc_html__('Category Color Settings', 'the-newsmag'),
		'panel' => 'the_newsmag_category_color_panel'
	));

	$i = 1;
	$args = array(
		'orderby' => 'id',
		'hide_empty' => 1
	);
	$categories = get_categories($args);
	$wp_category_list = array();

	// looping through each category colors
	foreach ($categories as $category_list) {
		$wp_category_list[$category_list->cat_ID] = $category_list->cat_name;

		$wp_customize->add_setting('the_newsmag_category_color_' . get_cat_id($wp_category_list[$category_list->cat_ID]), array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'the_newsmag_color_option_hex_sanitize',
			'sanitize_js_callback' => 'the_newsmag_color_escaping_option_sanitize'
		));

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'the_newsmag_category_color_' . get_cat_id($wp_category_list[$category_list->cat_ID]), array(
			'label' => sprintf(esc_html__('%s', 'the-newsmag'), $wp_category_list[$category_list->cat_ID]),
			'section' => 'the_newsmag_category_color_setting',
			'settings' => 'the_newsmag_category_color_' . get_cat_id($wp_category_list[$category_list->cat_ID]),
			'priority' => $i
		)));
		$i++;
	}

	// End Of Category Color Options
	// sanitization works
	// radio/select buttons sanitization
	function the_newsmag_radio_select_sanitize($input, $setting) {
		// Ensuring that the input is a slug.
		$input = sanitize_key($input);
		// Get the list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control($setting->id)->choices;
		// If the input is a valid key, return it, else, return the default.
		return ( array_key_exists($input, $choices) ? $input : $setting->default );
	}

	// checkbox sanitization
	function the_newsmag_checkbox_sanitize($input) {
		return (1 === absint($input)) ? 1 : 0;
	}

	// color sanitization
	function the_newsmag_color_option_hex_sanitize($color) {
		if ($unhashed = sanitize_hex_color_no_hash($color))
			return '#' . $unhashed;

		return $color;
	}

	function the_newsmag_color_escaping_option_sanitize($input) {
		$input = esc_attr($input);
		return $input;
	}

	// link sanitization
	function the_newsmag_important_links_sanitize() {
		return false;
	}

}

add_action('customize_register', 'the_newsmag_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function the_newsmag_customize_preview_js() {
	// adding the function to load the minified version if SCRIPT_DEFUG is disable
	$suffix = ( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script('the_newsmag_customizer', get_template_directory_uri() . '/js/customizer' . $suffix . '.js', array('customize-preview'), '20151215', true);
}

add_action('customize_preview_init', 'the_newsmag_customize_preview_js');
