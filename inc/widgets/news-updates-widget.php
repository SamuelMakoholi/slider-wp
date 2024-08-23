<?php
// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

class MSU_Latest_Posts_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'msu_latest_posts_widget',
            __('MSU Latest Posts Widget', 'text_domain'),
            array('description' => __('A widget to display the latest posts and updates on the MSU website', 'text_domain'))
        );
    }
    public function widget($args, $instance)
    {
        extract($args);

        $title = !empty($instance['title']) ? $instance['title'] : __(' ', 'text_domain');
        $posts_per_page = isset($instance['posts_per_page']) ? absint($instance['posts_per_page']) : 3;

        echo $before_widget;

        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }
?>
        <section class="news-section">
            <div class="container">
                <div class="news-grid">
                    <?php
                    $news_args = [
                        'post_type' => 'post',
                        'posts_per_page' => $posts_per_page,
                    ];

                    $news_query = new WP_Query($news_args);

                    if ($news_query->have_posts()) {
                        while ($news_query->have_posts()) {
                            $news_query->the_post();
                    ?>
                            <article class="news-item">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="news-item-image">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            the_post_thumbnail();
                                        } else {
                                            echo '<img src="' . esc_url(get_stylesheet_directory_uri() . '/images/default-img.jpg') . '" alt="' . esc_attr(get_the_title()) . '">';
                                        }
                                        ?>
                                    </div>
                                </a>

                                <div class="news-item-content">
                                    <h3 class="news-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="news-item-categories">
                                        <?php echo get_the_category_list(' '); ?>
                                    </div>
                                </div>

                                <div class="news-item-footer">
                                    <span class="date"><?php the_time('F j, Y'); ?></span>
                                </div>
                            </article>
                    <?php
                        }
                    } else {
                        echo '<p>No news posts found.</p>';
                    }

                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>
    <?php

        echo $after_widget;
    }

    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : __('Latest Posts', 'text_domain');
    ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
<?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}

// Registering the widget
function register_msu_latest_posts_widget()
{
    register_widget('MSU_Latest_Posts_Widget');
}
add_action('widgets_init', 'register_msu_latest_posts_widget');
