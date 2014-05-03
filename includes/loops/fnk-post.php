<?php //echo __FILE__; ?>
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
    <?php endif; ?>
</div>
