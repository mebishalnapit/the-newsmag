<?php

/**
 * Contains all the widgets parts included in the theme
 *
 * @package The NewsMag
 */
class The_NewsMag_Random_Posts_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'the_newsmag_random_posts_widget', esc_html__('TNM: Random Posts Widget', 'the-newsmag'), // Name of the widget
                array('description' => esc_html__('Displays the random posts from your site.', 'the-newsmag'), 'classname' => 'widget-entry-meta the-newsmag-random-posts-widget') // Arguments of the widget, here it is provided with the description
        );
    }

    function form($instance) {
        $number = !empty($instance['number']) ? $instance['number'] : 4;
        $title = !empty($instance['title']) ? $instance['title'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'the-newsmag'); ?></label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_textarea($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_html_e('Number of random posts to display:', 'the-newsmag'); ?></label> 
            <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo absint($number); ?>" size="3">
        </p>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = array();
        $instance['number'] = (!empty($new_instance['number']) ) ? absint($new_instance['number']) : 4;
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

    function widget($args, $instance) {
        $number = (!empty($instance['number']) ) ? $instance['number'] : 4;
        $title = isset($instance['title']) ? $instance['title'] : '';

        echo $args['before_widget'];
        ?>
        <div class="random-posts-widget" id="random-posts">
            <?php
            global $post;
            $random_posts = new WP_Query(array(
                'posts_per_page' => $number,
                'post_type' => 'post',
                'ignore_sticky_posts' => true,
                'orderby' => 'rand',
                'no_found_rows' => true
            ));
            ?>

            <?php
            if (!empty($title)) {
                echo $args['before_title'] . esc_html($title) . $args['after_title'];
            }
            ?>

            <?php
            while ($random_posts->have_posts()) :
                $random_posts->the_post();
                ?>
                <div class="single-article-content clear">
                    <?php if (has_post_thumbnail()) { ?>
                        <figure class="featured-image">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('the-newsmag-featured-small-thumbnail'); ?></a>
                        </figure>
                    <?php } ?>
                    <h3 class="entry-title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <div class="entry-meta">
                        <?php the_newsmag_widget_posts_posted_on(); ?>
                    </div>
                </div>
                <?php
            endwhile;
            // Reset Post Data
            wp_reset_postdata();
            ?>
        </div>
        <?php
        echo $args['after_widget'];
    }

}

class The_NewsMag_Tabbed_Widget extends WP_Widget {

    /**
     * Register widget in WordPress
     */
    function __construct() {
        parent::__construct(
                'the_newsmag_tabbed_widget', esc_html__('TNM: Tabbed Widget', 'the-newsmag'), // Name of the widget
                array('description' => esc_html__('Displays the popular posts, recent posts and the recent comments in the tabs.', 'the-newsmag'), 'classname' => 'widget-entry-meta the-newsmag-tabbed-widget') // Arguments of the widget, here it is provided with the description
        );
    }

    function form($instance) {
        $number = !empty($instance['number']) ? $instance['number'] : 4;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_html_e('Number of popular posts, recent posts and comments to display:', 'the-newsmag'); ?></label> 
            <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo absint($number); ?>" size="3">
        </p>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = array();
        $instance['number'] = (!empty($new_instance['number']) ) ? absint($new_instance['number']) : 4;

        return $instance;
    }

    function widget($args, $instance) {
        // enqueue the required js files
        if (is_active_widget(false, false, $this->id_base) || is_customize_preview()) {
            wp_enqueue_script('jquery-ui-tabs');
        }

        $number = (!empty($instance['number']) ) ? $instance['number'] : 4;
        echo $args['before_widget'];
        ?>

        <div class="tab-content the-newsmag-tab-content">

            <ul class="the-newsmag-tabs" role="tablist">
                <li role="presentation" class="popular"><a href="#popular"><i class="fa fa-star"></i><?php esc_html_e('Popular', 'the-newsmag'); ?></a></li>
                <li role="presentation" class="recent"><a href="#recent"><i class="fa fa-history"></i><?php esc_html_e('Recent', 'the-newsmag'); ?></a></li>
                <li role="presentation" class="comment"><a href="#user-comments"><i class="fa fa-comment"></i><?php esc_html_e('Comment', 'the-newsmag'); ?></a></li>
            </ul>

            <!-- Popular Tab -->
            <div role="tabpanel" class="tabs-panel popular-tab" id="popular">
                <?php
                global $post;
                $get_popular_posts = new WP_Query(array(
                    'posts_per_page' => $number,
                    'post_type' => 'post',
                    'ignore_sticky_posts' => true,
                    'orderby' => 'comment_count',
                    'no_found_rows' => true
                ));
                ?>
                <?php while ($get_popular_posts->have_posts()) : $get_popular_posts->the_post(); ?>
                    <div class="single-article-content clear">
                        <?php if (has_post_thumbnail()) { ?>
                            <figure class="featured-image">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('the-newsmag-featured-small-thumbnail'); ?></a>
                            </figure>
                        <?php } ?>
                        <h3 class="entry-title">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <div class="entry-meta">
                            <?php the_newsmag_widget_posts_posted_on(); ?>
                        </div>
                    </div>
                    <?php
                endwhile;
                // Reset Post Data
                wp_reset_postdata();
                ?>
            </div>

            <!-- Recent Tab -->
            <div role="tabpanel" class="tabs-panel recent-tab" id="recent">
                <?php
                global $post;
                $get_recent_posts = new WP_Query(array(
                    'posts_per_page' => $number,
                    'post_type' => 'post',
                    'ignore_sticky_posts' => true,
                    'no_found_rows' => true
                ));
                ?>
                <?php
                while ($get_recent_posts->have_posts()) : $get_recent_posts->the_post();
                    ?>
                    <div class="single-article-content clear">
                        <?php if (has_post_thumbnail()) { ?>
                            <figure class="featured-image">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('the-newsmag-featured-small-thumbnail'); ?></a>
                            </figure>
                        <?php } ?>
                        <h3 class="entry-title">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <div class="entry-meta">
                            <?php the_newsmag_widget_posts_posted_on(); ?>
                        </div>
                    </div>
                    <?php
                endwhile;
                // Reset Post Data
                wp_reset_postdata();
                ?>
            </div>

            <!-- Comment Tab -->
            <div role="tabpanel" class="tabs-panel comment-tab" id="user-comments">
                <?php
                $comments_query = new WP_Comment_Query();
                $comments = $comments_query->query(array('number' => $number, 'status' => 'approve'));
                $commented = '';
                $commented .= '<ul class="comments-tab">';
                if ($comments) : foreach ($comments as $comment) :
                        $commented .= '<li class="comments-tab-widget"><a class="author" href="' . esc_url(get_permalink($comment->comment_post_ID)) . '#comment-' . $comment->comment_ID . '">';
                        $commented .= get_avatar($comment->comment_author_email, '60');
                        $commented .= get_comment_author($comment->comment_ID) . '</a>' . ' ' . esc_html__('says:', 'the-newsmag');
                        $commented .= '<p class="commented-post">' . strip_tags(substr(apply_filters('get_comment_text', $comment->comment_content), 0, '50')) . '&hellip;</p></li>';
                    endforeach;
                else :
                    $commented .= '<p class="no-comments-commented-post">' . esc_html__('No Comments', 'the-newsmag') . '</p>';
                endif;
                $commented .= '</ul>';
                echo $commented;
                ?>
            </div>

        </div>

        <?php
        echo $args['after_widget'];
    }

}
?>
