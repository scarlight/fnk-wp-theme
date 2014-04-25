<?php
/**
 * Custom page.php template file
 *
 * Default template for page
 * WordPress site.
 *
 */
?>
<?php echo __FILE__ ?>
<?php get_header("breadcrumb"); ?>

<?php do_action('fnk_body_upper_side'); ?>
<?php do_action('fnk_post'); ?>
<?php do_action('fnk_body_bottom_side'); ?>

<?php get_footer(); ?>
