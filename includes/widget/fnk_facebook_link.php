<?php

class fnk_facebook_link extends WP_Widget {

    // constructor
    function fnk_facebook_link() {
        parent::WP_Widget(false, $name = __('Fatt Neng Kong Facebook Link Widget', 'wp_widget_plugin') );
    }

    // widget form creation
    function form($instance) {
        // Check values
        if( $instance) {
             $link = esc_attr($instance['link']);
        } else {
             $link = 'http://www.facebook.com/';
        }
?>
        <p>
        <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" />
        </p>
<?php
    }

    // widget update
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        // Fields
        $instance['link'] = strip_tags($new_instance['link']);
        return $instance;
    }

    // widget display
    function widget($args, $instance) {
        extract( $args );
    // these are the widget option;
    // $title = apply_filters('widget_title', $instance['title']);
    $link = $instance['link'];

    // Display the widget
    echo $before_widget;

    // Check if text is set
    if( $link ) {
        echo '<a href="'.$link.'"><img src="'.FNK_IMAGES.'/like_us_on_facebook.jpg" target="_blank" width="132" height="51" alt=""></a>';
    }
        echo $after_widget;
    }
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("fnk_facebook_link");'));