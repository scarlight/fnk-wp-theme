<?php
/**
 * Custom page.php template file
 *
 * Default template for page
 * WordPress site.
 *
 */
?>
<?php //echo __FILE__ ?>

<?php get_header(); ?>

<?php do_action('fnk_body_upper_side'); ?>

    <?php if ( is_active_sidebar( 'right_sidebar' ) ) { ?>

        <?php do_action('fnk_left_container_start') ?>

            <?php do_action('fnk_loop_page') ?>

        <?php do_action('fnk_left_container_end') ?>

        <?php do_action('fnk_right_container_start') ?>

        <?php get_sidebar(); ?>

        <?php do_action('fnk_right_container_start') ?>

    <?php } else { ?>

        <?php do_action('fnk_loop_page') ?>

    <?php } ?>


    <?php do_action('fnk_body_bottom_side'); ?>

<?php get_footer(); ?>