<?php

class fnk_sidebar_menu extends WP_Widget {

    // constructor
    function fnk_sidebar_menu() {
        parent::WP_Widget(false, $name = __('Fatt Neng Kong Sidebar Menu Widget', 'wp_widget_plugin') );
    }

    // widget form creation
    function form($instance) {
        // Check values
        if( $instance ) {
            $cnTitle   = esc_attr($instance['cn_title']);
            $enTitle   = esc_attr($instance['en_title']);
            $menu_id   = esc_attr($instance['menu_id']);
        } else {
            $cnTitle   = '关于我们';
            $enTitle   = 'About Us';
            $menu_id   = '';
        }
?>
        <p>
            <label for="<?php echo $this->get_field_id( 'cn_title' ); ?>"><?php _e( 'Chinese Title' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'cn_title' ); ?>" name="<?php echo $this->get_field_name( 'cn_title' ); ?>" type="text" value="<?php echo $cnTitle; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'en_title' ); ?>"><?php _e( 'English Title' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'en_title' ); ?>" name="<?php echo $this->get_field_name( 'en_title' ); ?>" type="text" value="<?php echo $enTitle; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'menu_id' ); ?>"><?php _e( 'Choose Menu' ); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'menu_id' ); ?>" name="<?php echo $this->get_field_name( 'menu_id' ); ?>">
                <?php foreach ( wp_get_nav_menus() as $menu ) { ?>
                    <option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php !empty($menu_id) ? selected( $instance['menu_id'], $menu->term_id ) : ''; ?>><?php echo esc_html( $menu->name ); ?></option>
                <?php } ?>
            </select>
        </p>

<?php
    }

    // widget update
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        // Fields
        $instance['cn_title']   = strip_tags($new_instance['cn_title']);
        $instance['en_title']   = strip_tags($new_instance['en_title']);
        $instance['menu_id']    = strip_tags($new_instance['menu_id']);
        return $instance;
    }

    // widget display
    function widget($args, $instance) {
        extract( $args );
    // these are the widget options
    $cn_title   = $instance['cn_title'];
    $en_title   = $instance['en_title'];
    $menu_id    = $instance['menu_id'];

    // Display the widget
    echo $before_widget;

    // Check if title is set
    if ( $cn_title || $en_title) {
        echo do_shortcode( '[fnk_title english="'.$en_title.'"]'.$cn_title.'[/fnk_title]' );

        // from http://codex.wordpress.org/Function_Reference/wp_get_nav_menu_items
        $menu_items = wp_get_nav_menu_items($menu_id);
        $menu_list = '<ul class="checkmark">';
        foreach ( (array) $menu_items as $key => $menu_item ) {
            $title       = $menu_item->title;
            $url         = $menu_item->url;
            $description = !empty($menu_item->description) ? $menu_item->description : '&nbsp;';

            $menu_list .= '<li>';
            $menu_list .= '<a href="'.$url.'">';
            $menu_list .= '<span class="zh">'.$title.'</span>';
            $menu_list .= '<span style="line-height:1.3;">'.$description.'</span></a>';
            $menu_list .= '</li>';
        }
        $menu_list .= '</ul>';

        echo $menu_list;
    }
    else
    {
        echo $before_title . '<span class="label label-warning">Missing title field!</span>' . $after_title;
    }

        echo $after_widget;
    }
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("fnk_sidebar_menu");'));