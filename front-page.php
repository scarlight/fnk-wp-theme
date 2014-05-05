<?php
/**
 * Custom front-page.php template file
 *
 * Used to display the homepage of your
 * WordPress site.
 *
 */
?>
<?php get_header(); ?>

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