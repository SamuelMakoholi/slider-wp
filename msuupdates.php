<?php

class MSU_Updates_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct('msu_updates_widget', 'MSU Updates', array(
            'description' => 'Displays recent MSU posts',
        ));
    }

    public function widget($args, $instance) {
        $title = isset( $instance['title'] ) ? $instance['title'] : __( '', 'news_updates_widget_domain' );


        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $query_args = array(
            'post_type' => 'post',
            'posts_per_page' => 5,
        );

        $recent_posts = new WP_Query($query_args);

        if ($recent_posts->have_posts()) {
            echo '<ul>';
            while ($recent_posts->have_posts()) {
                $recent_posts->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
        }

        wp_reset_postdata();

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'textdomain'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = sanitize_text_field($new_instance['title']);
        return $instance;
    }
}

function register_msu_updates_widget() {
    register_widget('MSU_Updates_Widget');
}
add_action('widgets_init', 'register_msu_updates_widget');