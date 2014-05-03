<?php

class fnk_latest_cause extends WP_Widget {

    // constructor
    function fnk_latest_cause() {
        parent::WP_Widget(false, $name = __('Fatt Neng Kong Latest Cause Widget', 'wp_widget_plugin') );
    }

    // widget form creation
    function form($instance) {
        // Check values
        if( $instance) {
             $cnTitle   = esc_attr($instance['cn_title']);
             $enTitle   = esc_attr($instance['en_title']);
             $descTitle = esc_attr($instance['desc_title']);
             $desc      = esc_attr($instance['desc']);
             $page_link = esc_attr($instance['page_link']);
             $thumb     = esc_attr($instance['thumb']);
        } else {
             $cnTitle = '援助事件';
             $enTitle = 'Latest Causes';
             $descTitle = '喂养饥饿的南非小孩';
             $desc = '南非未能生产足够的粮食来养活它的人口尚未南非20％的粮食不安全。';
             $page_link = '';
             $thumb = '';
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
        <label for="<?php echo $this->get_field_id('desc_title'); ?>"><?php _e('Description Title', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('desc_title'); ?>" name="<?php echo $this->get_field_name('desc_title'); ?>" type="text" value="<?php echo $descTitle; ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('desc'); ?>"><?php _e('Description', 'wp_widget_plugin'); ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>" type="text" rows="5"><?php echo $desc; ?></textarea>
        </p>

        <p>
        <label for="<?php echo $this->get_field_id( 'page_link' ); ?>"><?php _e( 'Choose Page' ); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'page_link' ); ?>" name="<?php echo $this->get_field_name( 'page_link' ); ?>">
            <?php
                $args = array(
                'sort_order' => 'ASC',
                'sort_column' => 'post_title',
                'hierarchical' => 1,
                'exclude' => '',
                'include' => '',
                'meta_key' => '',
                'meta_value' => '',
                'authors' => '',
                'child_of' => 0,
                'parent' => -1,
                'exclude_tree' => '',
                'number' => '',
                'offset' => 0,
                'post_type' => 'page',
                'post_status' => 'publish'
                );
                $pages = get_pages($args);

                foreach ( $pages as $page ) { ?>
                    <option value="<?php echo get_page_link($page->ID); ?>" <?php !empty($page_link) ? selected(get_page_link($page->ID) , $page_link) : ''; ?>><?php echo $page->post_title; ?></option>
            <?php } ?>
        </select>
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('thumb'); ?>"><?php _e('Thumbnail ID', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('thumb'); ?>" name="<?php echo $this->get_field_name('thumb'); ?>" type="text" value="<?php echo $thumb; ?>" />
        </p>
<?php
    }

    // widget update
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        // Fields
        $instance['cn_title']   = strip_tags($new_instance['cn_title']);
        $instance['en_title']   = strip_tags($new_instance['en_title']);
        $instance['desc_title'] = strip_tags($new_instance['desc_title']);
        $instance['desc']       = strip_tags($new_instance['desc']);
        $instance['page_link']  = strip_tags($new_instance['page_link']);
        $instance['thumb']      = strip_tags($new_instance['thumb']);
        return $instance;
    }

    // widget display
    function widget($args, $instance) {
        extract( $args );
    // these are the widget options
    $cn_title   = $instance['cn_title'];
    $en_title   = $instance['en_title'];
    $desc_title = $instance['desc_title'];
    $desc       = $instance['desc'];
    $page_link  = $instance['page_link'];
    $thumb      = $instance['thumb'];

    // Display the widget
    echo $before_widget;

    // Check if title is set
    if ( $cn_title || $en_title) {
        echo do_shortcode( '[fnk_title english="'.$en_title.'"]'.$cn_title.'[/fnk_title]' );
?>

<div class="latest-cause">
    <a href="<?php echo $page_link; ?>" class="sidebar-view-all floatr">所有事件 view all</a>
    <div class="clear"></div>

    <?php if ( $thumb || wp_get_attachment_image_src( $thumb, 'sidebar_thumb') ) :
        $image_url = wp_get_attachment_image_src( $thumb, 'sidebar_thumb');
    ?>
        <img width="<?php echo $image_url[1]; ?>" height="<?php echo ($image_url[2]) ?>" src="<?php echo $image_url[0]; ?>" alt="<?php echo $cn_title." | ".$en_title; ?>">
    <?php else : ?>
        <img class="round-corner-image" src="<?php echo FNK_IMAGES; ?>/fnk-logo-no-photo-220.jpg" width="220" height="110" alt="">
    <?php endif; ?>

    <p class="zh">
        <span style="color:#ea6274;"><?php echo $desc_title; ?></span><br>
        <?php echo $desc; ?>
    </p>
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
add_action('widgets_init', create_function('', 'return register_widget("fnk_latest_cause");'));