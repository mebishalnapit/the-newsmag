<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The NewsMag
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'the_newsmag_before' ); ?>
<div id="page" class="site">
	<?php do_action( 'the_newsmag_before_header' ); ?>
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'the-newsmag' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<?php if ( ( get_theme_mod( 'the_newsmag_date_display', 0 ) == 1 ) || ( get_theme_mod( 'the_newsmag_header_text', 0 ) != '' ) || has_nav_menu( 'social' ) ) : ?>
			<div class="header-top-area clear">
				<div class="inner-wrap">
					<?php
					// date display option
					if ( get_theme_mod( 'the_newsmag_date_display', 0 ) == 1 ) :
						the_newsmag_date_display();
					endif;

					// small info text display option
					if ( get_theme_mod( 'the_newsmag_header_text' ) != '' ) :
						?>
						<div class="small-info-text">
							<?php echo do_shortcode( wp_kses_post( get_theme_mod( 'the_newsmag_header_text' ) ) ); ?>
						</div>
					<?php endif;
					?>

					<?php if ( has_nav_menu( 'social' ) ) : ?>
						<div class="social-menu">
							<?php the_newsmag_social_menu(); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'the_newsmag_breaking_news', 0 ) == 1 ) : ?>
			<div class="breaking-news">
				<div class="inner-wrap">
					<?php the_newsmag_breaking_news(); ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="site-branding clear">
			<div class="inner-wrap">
				<div class="header-left-section">
					<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) { ?>
						<div class="header-custom-logo">
							<?php the_custom_logo(); ?>
						</div>
					<?php } ?>

					<div class="site-info">
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</h1>
						<?php else : ?>
							<p class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</p>
						<?php
						endif;

						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) :
							?>
							<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php endif;
						?>
					</div>
				</div><!-- .site-details -->

				<div class="header-right-section">
					<?php
					if ( is_active_sidebar( 'the-newsmag-header-sidebar' ) ) {
						dynamic_sidebar( 'the-newsmag-header-sidebar' );
					}
					?>
				</div>
			</div>
		</div><!-- .site-branding -->

		<?php if ( get_header_image() || ( function_exists( 'the_custom_header_markup' ) ) ) : ?>
			<div class="the-newsmag-header-image">
				<?php if ( ( get_theme_mod( 'the_newsmag_header_image_link', 0 ) == 1 ) && ( ( function_exists( 'the_custom_header_markup' ) && ( ! is_header_video_active() || ! has_header_video() ) ) || ( ! function_exists( 'the_custom_header_markup' ) ) ) ) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php
					}

					// Display the header video and header image
					if ( function_exists( 'the_custom_header_markup' ) ) :
						the_custom_header_markup();
					else :
						the_header_image_tag();
					endif;

					if ( ( get_theme_mod( 'the_newsmag_header_image_link', 0 ) == 1 ) && ( ( function_exists( 'the_custom_header_markup' ) && ( ! is_header_video_active() || ! has_header_video() ) ) || ( ! function_exists( 'the_custom_header_markup' ) ) ) ) {
					?>
				</a>
			<?php } ?>
			</div>
		<?php endif; // End header image check. ?>

		<nav id="site-navigation" class="main-navigation clear" role="navigation">
			<div class="inner-wrap">
				<?php if ( get_theme_mod( 'the_newsmag_home_icon_display', 0 ) == 1 ) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="home-icon"><i class="fa fa-home"></i></a>
				<?php } ?>

				<?php if ( get_theme_mod( 'the_newsmag_search_icon_in_menu', 0 ) == 1 ) { ?>
					<a class="search-toggle">
						<i class="fa fa-search search-top"></i>
					</a>
					<div class="search-form-top">
						<?php get_search_form(); ?>
					</div>
				<?php } ?>

				<?php
				if ( get_theme_mod( 'the_newsmag_random_post_in_menu', 0 ) == 1 ) {
					echo the_newsmag_random_post();
				}
				?>

				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'the-newsmag' ); ?></button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'nav-menu',
					)
				);
				?>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<?php if ( ! is_front_page() && function_exists( 'bcn_display' ) ) : ?>
		<div class="breadcrumbs-area">
			<div class="inner-wrap">
				<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
					<?php bcn_display(); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php do_action( 'the_newsmag_after_header' ); ?>
	<?php do_action( 'the_newsmag_before_main' ); ?>

	<?php if ( is_active_sidebar( 'the-newsmag-content-top-sidebar' ) ) { ?>
		<div class="content-top-sidebar-area">
			<div class="inner-wrap">
				<?php dynamic_sidebar( 'the-newsmag-content-top-sidebar' ); ?>
			</div>
		</div>
	<?php } ?>

	<div id="content" class="site-content">
		<div class="inner-wrap">
