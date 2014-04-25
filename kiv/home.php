<?php
/**
 * Blog : home.php template file
 *
 * Used to display a blog content on your WordPress site.
 *
 *
 */
?>
<?php echo __FILE__ ?>
<?php get_header(); ?>

<?php do_action('fnk_body_upper_side'); ?>
<?php do_action('fnk_post'); ?>
<?php do_action('fnk_body_bottom_side'); ?>

<?php get_footer(); ?>