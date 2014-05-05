<?php
/**
 * Blog : category.php template file
 *
 * Used to display category of posts on your WordPress site
 *
 */
?>
<?php get_header(); ?>

<?php do_action('fnk_body_upper_side'); ?>

    <?php if ( is_active_sidebar( 'right_sidebar' ) ) { ?>

        <?php do_action('fnk_left_container_start') ?>

            <?php do_action('fnk_loop_blog'); ?>

        <?php do_action('fnk_left_container_end') ?>

        <?php do_action('fnk_right_container_start') ?>

        <?php get_sidebar(); ?>

        <?php do_action('fnk_right_container_start') ?>

    <?php } else { ?>

        <?php do_action('fnk_loop_blog'); ?>

    <?php } ?>


    <?php do_action('fnk_body_bottom_side'); ?>

<?php get_footer(); ?>