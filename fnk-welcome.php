<?php
    $args = array(
        'sort_order' => 'ASC',
        'sort_column' => 'post_title',
        'name' => 'welcome',
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

    $wp_query = new WP_Query($args);
?>
<div class="welcome-page">
    <?php
        if( $wp_query->have_posts() ){
            while( $wp_query->have_posts() )
            {
                $wp_query->the_post();

                $second_title = get_post_meta( get_the_ID(), '_fnk_optional_title_text', true );//the_ID() wont work
                $deco = get_post_meta( get_the_ID(), '_fnk_short_line', true );
                $deco = ($deco == "yes") ? "short" : Null;

                echo do_shortcode( '[fnk_title line="'.$deco.'" english="'.$second_title.'"]'.get_the_title().'[/fnk_title]' );//the_title() wont work
                the_content();
            }
        }
        wp_reset_postdata();
    ?>
    <div class="clear"></div>
</div>
