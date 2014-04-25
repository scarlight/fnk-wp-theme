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

    foreach ($pages as $page) {
        if($page->post_name == 'welcome')
        {
            $title = apply_filters('the_title', $page->post_title);
            $content = apply_filters('the_content', $page->post_content);

            $second_title = get_post_meta( $page->ID, '_fnk_optional_title_text', true );
            $deco = get_post_meta( $page->ID, '_fnk_short_line', true );
        }
    }

    $deco = ($deco == "yes") ? "short" : Null;

?>
<div class="welcome-page">
    <?php echo do_shortcode( '[fnk-title line="'.$deco.'" english="'.$second_title.'"]'.$title.'[/fnk-title]' ); ?>
    <?php echo $content; ?>
</div>
