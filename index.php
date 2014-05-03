<?php
/**
 * Base : index.php template file
 *
 * Base file used when absents of custom template
 * WordPress site.
 *
 */
?>
<?php //echo __FILE__ ?>
<?php get_header(); ?>

<?php

    echo "<pre>";
        print_r($wp_query);
    echo "</pre>";

?>

<?php do_action('fnk_body_upper_side'); ?>

    <?php if ( is_active_sidebar( 'right_sidebar' ) ) { ?>

        <?php do_action('fnk_left_container_start') ?>

            <?php do_action('fnk_welcome'); ?>

            <?php do_action('fnk_loop_recent_news'); ?>

        <?php do_action('fnk_left_container_end') ?>

        <?php do_action('fnk_right_container_start') ?>

        <?php get_sidebar(); ?>

        <?php do_action('fnk_right_container_start') ?>

    <?php } else { ?>

        <?php do_action('fnk_welcome'); ?>

        <?php do_action('fnk_loop_recent_news'); ?>

    <?php } ?>


    <?php do_action('fnk_body_bottom_side'); ?>

<?php get_footer(); ?>