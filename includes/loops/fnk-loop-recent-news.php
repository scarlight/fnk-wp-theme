<?php
    $cs_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $cs_args = array(
        'post_type' => 'post',
        'posts_per_page' => 20, // retrieve latest 20 enough dont need -1
        'post_status' => 'publish', //important
        'paged' => $cs_paged,
        'order' => 'DESC',
        'orderby' => 'date',
        'category_name' => 'recent-news',
        'ignore_sticky_posts' => true,
        'offset' => 0
    ); // use category slug to find posts. Also using posts_per_page=-1 cause pajination.js will do the real pagination.

    $cs_query = new WP_Query($cs_args);

    // WP_Query Pagination fix. Not using but no harm done to have this around at the momment.
    $temp_query = $wp_query;
    $wp_query   = NULL;
    $wp_query   = $cs_query;

    // Get the category
    $category = get_category_by_slug('recent-news');
    // Get Category Name
    $category_name = $category->name;
    // Get Category Meta
    $fnk_additional_language = get_tax_meta($category->term_id,'fnk_tax_text_field_id');
    $fnk_short_line = get_tax_meta($category->term_id,'fnk_tax_radio_field_id');
    $fnk_short_line = ($fnk_short_line == "yes") ? "short" : Null;

?>

<div class="recent-news">
<?php echo do_shortcode( '[fnk_title line="'.$fnk_short_line.'" english="'.$category_name.'"]'.$fnk_additional_language.'[/fnk_title]' ); ?>
    <div class="blog-item">
    <?php if ($wp_query->have_posts()) : ?>
        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
            <div class="blog-layout">

                <a href="<?php echo the_permalink(); ?>" class="" title="<?php the_title_attribute(); ?>">
                    <?php if ( has_post_thumbnail() ) :
                        $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured-recent-news');
                    ?>
                        <img class="left" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>" src="<?php echo $image_url[0]; ?>" alt="">
                    <?php else : ?>
                        <img class="left" style="width:304px; height:194px; background : #FFFFFF url(<?php echo FNK_IMAGES; ?>/fnk-logo-no-photo.jpg) no-repeat center center scroll; border:solid 1px #e7e4dd;" src="<?php echo FNK_IMAGES ?>/space.gif" alt="">
                    <?php endif; ?>
                </a>

                <h3 style="margin-top:0;"><?php the_title(); ?></h3>
                <span style="position:relative; display:inline-block;margin-top:-10px;">Posted on <?php the_time('F jS, Y'); ?> by <?php the_author(); ?></span>

                <?php //echo get_post_meta($post->ID, 'PostThumb', true); ?>

                <p>
                    <?php the_excerpt(); ?>
                </p>

                <p>
                    <?php //the_tags('Tags: ', ', ', '<br />'); ?>
                    <!-- Posted in --> <?php //the_category(', '); ?>
                    <?php //comments_popup_link('No Comments;', '1 Comment', '% Comments'); ?>
                </p>

                <a href="<?php echo the_permalink(); ?>" class="readmore floatr" title="<?php the_title_attribute(); ?>">点击详情...</a>
            </div>

        <?php endwhile; ?>
    </div>
    <?php else : ?>
        <?php //show the same 404.php, this html fragment can be placed in a different way too ?>
        <div>
            <?php
                // http://wordpress.org/support/topic/add-a-back-link-to-a-post
                // improved via http://stackoverflow.com/questions/12369615/serverhttp-referer-missing
                $back = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
                if( (isset($back) && $back !='' ) ) {
                    $back = '<a style="color:red;" href="'.$back.'">previous page</a>';
                }
                else
                {
                    $back = "previous page";
                }
            ?>
            <img class="right" src="<?php echo FNK_IMAGES; ?>/are-you-lost.png" alt="Fatt Neng Kong">
            <div style="display:inline-block; width:690px; text-align:center; margin-top:90px;">
                <img src="<?php echo FNK_IMAGES; ?>/404.png" alt="Fatt Neng Kong">
                <h3 style="font-weight:600;">Page doesn't exist or some other error occured. Go to our <a style="color:red;" href="<?php bloginfo('url'); ?>">home page</a> or go back to <?php echo $back; ?>.</h3>
            </div>
            <div class="clear"></div>
        </div>
    <?php endif; ?>
        <br>
        <div class="floatl result-info" style="margin-left:120px;"></div>
        <div class="floatl page-navigation pagination-a"></div>
    <div class="clear"></div>
</div>
<?php

    wp_reset_postdata();
    $wp_query = NULL;
    $wp_query = $temp_query;

?>
