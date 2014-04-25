<?php echo __FILE__; ?>
<?php

    // $cat_args = array(
    //     'type'                     => 'post',
    //     'child_of'                 => 0,
    //     'parent'                   => '',
    //     'orderby'                  => 'name',
    //     'order'                    => 'ASC',
    //     'hide_empty'               => 1,
    //     'hierarchical'             => 1,
    //     'exclude'                  => '',
    //     'include'                  => '',
    //     'number'                   => '',
    //     'taxonomy'                 => 'category',
    //     'pad_counts'               => false

    // );
    // $all_category = get_categories( $cat_args );

    // $cat_array = array();
    // foreach ($all_category as $key => $category) {
    //     $cat_array[$key] = $category->cat_ID;
    // }

    // $all_category = implode(", ", $cat_array);

    // not using right now
    // need to use get_categories() to find all categories of a post, WP_Query does not provide option to get all categories since it uses array option to insert the category id we are looking for. However a post may appear in more than one category, so think about what exactly you need. Do you still need all the category?
    /*------------------------------------------------------------------------*/

    $cs_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $cs_args = array(
        'post_type' => 'post',
        'posts_per_page' => 10,
        'paged' => $cs_paged,
        'order' => 'DESC',
        'orderby' => 'id',
        'cat' => 63,
        'ignore_sticky_posts' => true,
        'offset' => 0
    ); // use specified category to find posts cause a post can have more than one category. Also removed posts_per_page parameter to use the backend setting of number of post to show.

    $cs_query = new WP_Query($cs_args);

    // Pagination fix
    $temp_query = $wp_query;
    $wp_query   = NULL;
    $wp_query   = $cs_query;

?>
<?php if ($wp_query->have_posts()) : ?>
    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
        <div class="post" id="post-<?php the_ID(); ?>">
            <h1>Currently Browsing Page <?php echo $paged; ?></h1>
            <h2>ID: <?php the_ID(); ?> | <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <?php echo get_post_meta($post->ID, 'PostThumb', true); ?>
            <p class="meta">
                <span>Posted on</span> <?php the_time('F jS, Y'); ?> <span>by</span> <?php the_author(); ?>
            </p>
            <?php the_content('Read Full Article'); ?>
            <p>
                <?php the_tags('Tags: ', ', ', '<br />'); ?>
                Posted in <?php the_category(', '); ?>
                <?php comments_popup_link('No Comments;', '1 Comment', '% Comments'); ?>
            </p>
        </div>
        <pre>
            -------------------------------------------------------------------------------------------------------
        </pre>
    <?php endwhile; ?>

<?php //next_posts_link('&larr; Older Entries'); ?>
<br>
<?php //previous_posts_link('Newer Entries &rarr;'); ?>

<?php
    $big = 999999999;
    $args_paginate =
        array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages
        );
    echo paginate_links( $args_paginate );
?>

<?php else : ?>
    <h2>Sorry, cannot find what you looking for. :(</h2>
<?php endif; ?>

<?php wp_reset_postdata(); ?>

<?php

$wp_query = NULL;
$wp_query = $temp_query;

?>