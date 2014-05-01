<?php

class fnk_donate_widget extends WP_Widget {

    // constructor
    function fnk_donate_widget() {
        parent::WP_Widget(false, $name = __('Fatt Neng Kong Donate Widget', 'wp_widget_plugin') );
    }

    // widget form creation
    function form($instance) {
        // Check values
        if( $instance) {
             $cnTitle = esc_attr($instance['cn_title']);
             $enTitle = esc_attr($instance['en_title']);
             $cnDesc = esc_attr($instance['cn_desc']);
             $enDesc = esc_attr($instance['en_desc']);
             $donatePhrase = esc_attr($instance['donate_phrase']);
             $link = esc_textarea($instance['link']);
        } else {
             $cnTitle = '捐款';
             $enTitle = 'Donate Now';
             $cnDesc = '请伸出援手，帮助别人';
             $enDesc = 'GIVE YOUR DONATIONS';
             $donatePhrase = 'DONATE NOW';
             $link = 'http://#';
        }
?>
        <p>
        <label for="<?php echo $this->get_field_id('cn_title'); ?>"><?php _e('Chinese Title', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('cn_title'); ?>" name="<?php echo $this->get_field_name('cn_title'); ?>" type="text" value="<?php echo $cnTitle; ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('en_title'); ?>"><?php _e('English Title', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('en_title'); ?>" name="<?php echo $this->get_field_name('en_title'); ?>" type="text" value="<?php echo $enTitle; ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('cn_desc'); ?>"><?php _e('Chinese Description', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('cn_desc'); ?>" name="<?php echo $this->get_field_name('cn_desc'); ?>" type="text" value="<?php echo $cnDesc; ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('en_desc'); ?>"><?php _e('English Description', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('en_desc'); ?>" name="<?php echo $this->get_field_name('en_desc'); ?>" type="text" value="<?php echo $enDesc; ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('donate_phrase'); ?>"><?php _e('Donation Phrase', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('donate_phrase'); ?>" name="<?php echo $this->get_field_name('donate_phrase'); ?>" type="text" value="<?php echo $donatePhrase; ?>" />
        </p>

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
        $instance['cn_title']      = strip_tags($new_instance['cn_title']);
        $instance['en_title']      = strip_tags($new_instance['en_title']);
        $instance['cn_desc']       = strip_tags($new_instance['cn_desc']);
        $instance['en_desc']       = strip_tags($new_instance['en_desc']);
        $instance['donate_phrase'] = strip_tags($new_instance['donate_phrase']);
        $instance['link']          = strip_tags($new_instance['link']);
        return $instance;
    }

    // widget display
    function widget($args, $instance) {
        extract( $args );
    // these are the widget options
    $cn_title      = $instance['cn_title'];
    $en_title      = $instance['en_title'];
    $cn_desc       = $instance['cn_desc'];
    $en_desc       = $instance['en_desc'];
    $donate_phrase = $instance['donate_phrase'];
    $link          = $instance['link'];

    // Display the widget
    echo $before_widget;

    // Check if title is set
    if ( $cn_title || $en_title) {
        echo do_shortcode( '[fnk-title english="'.$en_title.'"]'.$cn_title.'[/fnk-title]' );
?>
        <div class="donate-box">
            <div>
                <span class="zh"><?php echo $cn_desc; ?></span><br>
                <strong><?php echo $en_desc; ?></strong><br>
                <a class="btn btn-default btn-sm" href="<?php echo $link; ?>"><?php echo $donate_phrase; ?></a>
            </div>
            <img src="images/space.gif" width="0" height="135" alt="">
        </div>
<?php
    }
    else
    {
        echo $before_title . '<span class="label label-warning">Missing title field!</span>' . $after_title;
    }

        echo $after_widget;

    }
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("fnk_donate_widget");'));