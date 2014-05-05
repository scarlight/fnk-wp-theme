<div>
    <?php if ( have_posts()) : ?>
        <?php while ( have_posts() ) :  the_post(); ?>

            <?php

            $second_title = get_post_meta( get_the_ID(), '_fnk_optional_title_text', true );//the_ID() wont work
            $deco = get_post_meta( get_the_ID(), '_fnk_short_line', true );
            $deco = ($deco == "yes") ? "short" : Null;

            echo do_shortcode( '[fnk_title line="'.$deco.'" english="'.$second_title.'"]'.get_the_title().'[/fnk_title]' );//the_title() wont work
            the_content();

            ?>

        <?php endwhile; ?>
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
</div>
