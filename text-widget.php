<?php
/**
 * Plugin Name: Text Widget
 * Plugin URI:  https://example.com/text-widget
 * Description: A plugin to create a custom text widget that displays a title and message.
 * Version:     1.0
 * Author:      Jay
 * Author URI:  https://example.com
 * License:     GPLv2 or later
 */


 class Text_Widget extends WP_Widget {

    // Constructor to initialize the widget
    public function __construct() {
        parent::__construct(
            'text_widget', // Base ID of your widget
            __('Text Widget', 'text_domain'), // Name in the admin dashboard
            array('description' => __('A widget that displays custom text and a title.', 'text_domain'))
        );
    }

    // Function to display the widget output on the frontend
    public function widget($args, $instance) {
        echo $args['before_widget']; // Output before widget

        // Output the widget title
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        // Output the custom message
        if (!empty($instance['message'])) {
            echo '<p>' . esc_html($instance['message']) . '</p>';
        }

        echo $args['after_widget']; // Output after widget
    }

    // Function to handle widget settings in the admin
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Text Widget', 'text_domain');
        $message = !empty($instance['message']) ? $instance['message'] : __('This is a custom message.', 'text_domain');
        ?>

        <!-- Title Field -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'text_domain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>

        <!-- Message Field -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('message')); ?>"><?php _e('Message:', 'text_domain'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('message')); ?>" name="<?php echo esc_attr($this->get_field_name('message')); ?>"><?php echo esc_attr($message); ?></textarea>
        </p>
        <?php
    }

    // Function to save the widget settings
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['message'] = (!empty($new_instance['message'])) ? strip_tags($new_instance['message']) : '';
        return $instance;
    }
}
// Function to register the Text Widget
function register_text_widget() {
    register_widget('Text_Widget');
}

// Hook the widget registration into WordPress
add_action('widgets_init', 'register_text_widget');

