<?php
/**
 * Custom front-page.php template file
 *
 * Used to display the homepage of your
 * WordPress site.
 *
 */
?>
<?php echo __FILE__ ?>
<?php get_header(); ?>

<?php do_action('fnk_body_upper_side'); ?>

    <?php do_action('fnk_left_container_start') ?>

        <?php do_action('fnk_welcome'); ?>

        <?php do_action('fnk_loop_recent_news'); ?>

    <?php do_action('fnk_left_container_end') ?>

    <?php do_action('fnk_right_container_start') ?>

    <?php get_sidebar(); ?>

    <?php do_action('fnk_right_container_start') ?>

    <?php do_action('fnk_body_bottom_side'); ?>

<?php get_footer(); ?>