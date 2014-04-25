<?php
/**
 * Base : index.php template file
 *
 * Base file used when absents of custom template
 * WordPress site.
 *
 */
?>
<?php echo __FILE__ ?>
<?php get_header(); ?>

<?php do_action('fnk_body_upper_side'); ?>

<?php do_action('fnk_body_bottom_side'); ?>

<?php get_footer(); ?>