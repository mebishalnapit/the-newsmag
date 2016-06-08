<?php
/**
 * Template part for displaying aside post format.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The NewsMag
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php do_action('the_newsmag_before_post_content'); ?>

    <div class="post-header-wrapper clear">
        <?php if ('post' === get_post_type()) : ?>
            <div class="category-links">
                <?php the_newsmag_colored_category(); ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>

        <?php if (('post' === get_post_type() && !is_single() && !post_password_required()) && (comments_open() || get_comments_number())) : ?>
            <a href="<?php esc_url(comments_link()); ?>" class="entry-meta-comments">
                <?php
                printf(_nx('<i class="fa fa-comment"></i> 1', '<i class="fa fa-comment"></i> %1$s', get_comments_number(), 'comments title', 'the-newsmag'), number_format_i18n(get_comments_number()));
                ?>
            </a>
        <?php endif; ?>
    </div>

    <header class="entry-header">
        <?php
        if (is_single()) {
            the_title('<h1 class="entry-title">', '</h1>');
        }

        if ('post' === get_post_type()) :
            ?>
            <div class="entry-meta">
                <?php the_newsmag_posted_on(); ?>
            </div><!-- .entry-meta -->
        <?php endif;
        ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'the-newsmag'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

    <?php if (is_single()) : ?>
        <footer class="entry-footer">
            <?php the_newsmag_entry_footer(); ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>

    <?php do_action('the_newsmag_after_post_content'); ?>
</article><!-- #post-## -->