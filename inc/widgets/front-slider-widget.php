<?php
// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

class Front_Slider_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'front_slider_widget',
            __('Front Slider Widget', 'text_domain'),
            array('description' => __('A widget to display the slider. You can use it anywhere.', 'text_domain'))
        );
    }

    public function widget($args, $instance)
{
    // Accessing widget arguments directly
    $title = !empty($instance['title']) ? $instance['title'] : __(' ', 'text_domain');
    $posts_per_page = isset($instance['posts_per_page']) ? absint($instance['posts_per_page']) : 5;

    echo $args['before_widget'];

    if (!empty($title)) {
        echo $args['before_title'] . esc_html($title) . $args['after_title'];
    }

    // Query to fetch the latest posts
    $query = new WP_Query(array(
        'post_type'      => 'post',
        'posts_per_page' => $posts_per_page,
        'orderby'       => 'date',
        'order'         => 'DESC',
        'posts_per_page' => 2,
    ));

    if ($query->have_posts()) {
        ?>
        <!-- slider_area_start -->
        <div class="slider_area">
            <div class="slider_active owl-carousel">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <!-- single_carousel -->
                    <div class="single_slider d-flex align-items-center" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(null, 'full')); ?>');">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="slider_text">
                                        <h3><?php the_title(); ?></h3>
                                        <a href="<?php the_permalink(); ?>" class="boxed-btn3">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /single_carousel -->
                <?php endwhile; ?>
            </div>
        </div>
        <!-- slider_area_end -->
        <?php
    } else {
        echo '<p>' . __('No posts found', 'text_domain') . '</p>';
    }

    // Reset Post Data
    wp_reset_postdata();

    echo $args['after_widget'];
}

    

    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : __('Front Slider Widget', 'text_domain');
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
function register_front_slider_widget()
{
    register_widget('Front_Slider_Widget');
}
add_action('widgets_init', 'register_front_slider_widget');
