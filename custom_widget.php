<?php
/**
 * Plugin Name: Custom Widget
 * Plugin URI:  https://example.com/custom-widget
 * Description: A plugin to create a custom widget.
 * Version:     1.0
 * Author:      Your Name
 * Author URI:  https://example.com
 * License:     GPLv2 or later
 */

 class My_Custom_Widget extends WP_Widget {

    // Constructor to initialize the widget
    public function __construct() {
        parent::__construct(
            'my_custom_widget', // Base ID of your widget
            __('My Custom Widget', 'text_domain'), // Widget name in the admin
            array('description' => __('A custom widget that displays some text.', 'text_domain'))
        );
    }

    // Function to output the widget content on the frontend
    public function widget($args, $instance) {
        echo $args['before_widget']; // Required opening tag for widgets

        // Output the widget title
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        // Output custom content
        echo '<p>' . __('Hello, this is my custom widget!', 'text_domain') . '</p>';

        echo $args['after_widget']; // Required closing tag for widgets
    }

    // Function to handle the widget settings in the admin
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('My Custom Widget', 'text_domain');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'text_domain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    // Function to save the widget settings
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}

// Function to register the custom widget
function register_my_custom_widget() {
    register_widget('My_Custom_Widget');
}

// Hook the widget registration into WordPress
add_action('widgets_init', 'register_my_custom_widget');
