<?php

class fnk_recent_post_by_category extends WP_Widget {

    // constructor
    function fnk_recent_post_by_category() {
        parent::WP_Widget(false, $name = __('Fatt Neng Kong Category Post Widget', 'wp_widget_plugin') );
    }

    // widget form creation
    function form($instance) {
        // Check values
        if( $instance ) {
            $cnTitle   = esc_attr($instance['cn_title']);
            $enTitle   = esc_attr($instance['en_title']);
            $catID     = esc_attr($instance['cat_id']);
            $postCount = esc_attr($instance['post_count']);
        } else {
            $cnTitle   = '最新文章';
            $enTitle   = 'Recent Post';
            $catID     = $this->random_category_num();
            $postCount = 5;
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
            <label for="<?php echo $this->get_field_id( 'cat_id' ); ?>"><?php _e( 'Choose Category' ); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'cat_id' ); ?>" name="<?php echo $this->get_field_name( 'cat_id' ); ?>">
            <?php
                // retrieve category id
                $all_category = $this->get_all_category();
                foreach ($all_category as $category) {
                    $option = '<option'.selected( $catID, $category->cat_ID, 0).' value="'.$category->cat_ID.'">';
                    $option .= $category->name;
                    $option .= '</option>';
                    echo $option;
                }
            ?>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'post_count' ); ?>"><?php _e( 'Number of posts to show' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'post_count' ); ?>" name="<?php echo $this->get_field_name( 'post_count' ); ?>" type="text" value="<?php echo $postCount; ?>" size="3" />
        </p>
<?php
    }

    // widget update
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        // Fields
        $instance['cn_title']   = strip_tags($new_instance['cn_title']);
        $instance['en_title']   = strip_tags($new_instance['en_title']);
        $instance['cat_id']     = (int) strip_tags( $new_instance['cat_id'] );
        $instance['post_count'] = (int) strip_tags($new_instance['post_count']);
        return $instance;
    }

    // widget display
    function widget($args, $instance) {
        extract( $args );
    // these are the widget options
    $cn_title   = $instance['cn_title'];
    $en_title   = $instance['en_title'];
    $cat_id     = $instance['cat_id'];
    $post_count = $instance['post_count'];

    // Display the widget
    echo $before_widget;

    // Check if title is set
    if ( $cn_title || $en_title) {
        echo do_shortcode( '[fnk_title english="'.$en_title.'"]'.$cn_title.'[/fnk_title]' );

        $post_args = array(
            'post_type' => 'post',
            'posts_per_page' => $post_count,
            'post_status' => 'publish', //important
            'paged' => 1,
            'order' => 'DESC',
            'orderby' => 'date',
            'cat' => $cat_id,
            'ignore_sticky_posts' => true,
            'offset' => 0
        ); // use category slug to find posts. Also using posts_per_page=-1 cause simplepagination.js will do the real pagination.

        $cs_post = new WP_Query($post_args);
?>

        <ul class="recent-post">
            <?php
            if( $cs_post->have_posts() )
                while($cs_post->have_posts()){
                    $cs_post->the_post();

                    $image_exist = false;
                    if( has_post_thumbnail() ){
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'sidebar_tiny_thumb');
                        $image_url = $image[0];
                        $image_width = $image[1];
                        $image_height = $image[2];
                        $image_exist = true;
                    }
            ?>

            <li>
                <?php if($image_exist) : ?>
                    <img class="left" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>">
                <?php else: ?>
                    <span class="no-tiny-thumb"></span>
                <?php endif; ?>
                <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_excerpt(), 7) ?></a>
            </li>

            <?php
                }
            ?>
        </ul>

<?php
        wp_reset_postdata();
    }
    else
    {
        echo $before_title . '<span class="label label-warning">Missing title field!</span>' . $after_title;
    }

        echo $after_widget;
    }

    // returns an array of all the categories with each of its field included.
    function get_all_category(){
        $cat_args = array(
            'type'                     => 'post',
            'child_of'                 => 0,
            'parent'                   => '',
            'orderby'                  => 'name',
            'order'                    => 'ASC',
            'hide_empty'               => 1,
            'hierarchical'             => 1,
            'exclude'                  => '',
            'include'                  => '',
            'number'                   => '',
            'taxonomy'                 => 'category',
            'pad_counts'               => false

        );
        $all_category = get_categories( $cat_args );

        return $all_category;
    }

    //will return a random category number from the array's key.
    function random_category_num(){
        $cat_array = array();

        $all_category = $this->get_all_category();
        foreach ($all_category as $key => $category) {
            $cat_array[$key] = $category->cat_ID;
        }

        shuffle($cat_array);
        $rand_cat_num = $cat_array[ array_rand( $cat_array ) ];

        return $rand_cat_num;
    }
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("fnk_recent_post_by_category");'));