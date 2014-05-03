<?php //echo __FILE__; ?>
<div>
<?php echo do_shortcode( '[fnk_title line="'.$fnk_short_line.'" english="'.$category_name.'"]'.$fnk_additional_language.'[/fnk_title]' ); ?>
    <div class="blog-item">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) :  the_post(); ?>
            <div class="blog-layout">

                <a href="<?php echo the_permalink(); ?>" class="" title="<?php the_title_attribute(); ?>">
                    <?php if ( has_post_thumbnail() ) :
                        $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
                    ?>
                        <img class="left" width="<?php echo $image_url[1]; ?>" height="<?php echo ($image_url[2] > 194) ? 194 : $image_url[2] ; ?>" src="<?php echo $image_url[0]; ?>" alt="">
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

                <a href="<?php echo the_permalink(); ?>" class="readmore floatr" title="<?php the_title_attribute(); ?>">点击详情...</a>
            </div>

        <?php endwhile; ?>
    </div>
    <?php else : ?>
        <h2>Sorry, what you looking for cannot be found. :(</h2>
    <?php endif; ?>

    <?php

    $big = 999999999;
    $args_paginate =
        array(
            'base'               => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'             => '?paged=%#%',
            'current'            => max( 1, get_query_var('paged') ),
            'total'              => $wp_query->max_num_pages,
            'prev_next'          => True,
            'prev_text'          => __('« Previous'),
            'next_text'          => __('Next »'),
            'type'               => 'array'
        );
    $custom_pg = '<div class="page-navigation" style="margin-left: 304px;"><ul class="pagination">';
    foreach ( paginate_links( $args_paginate ) as $link ) {
        $custom_pg .= '<li>'.$link.'</li>';
    }
    $custom_pg .= '</ul></div>';

    echo $custom_pg;
    ?>

    <div class="clear"></div>
</div>
