<?php
/**
 * Blog Single : single.php
 *
 * Single post view for blogs
 * WordPress site.
 *
 */
?>
<?php echo __FILE__ ?>
<?php
// ["ID"]
// ["post_author"]
// ["post_date"]
// ["post_date_gmt"]
// ["post_content"]
// ["post_title"]
// ["post_excerpt"]
// ["post_status"]
// ["comment_status"]
// ["ping_status"]
// ["post_password"]
// ["post_name"]
// ["to_ping"]
// ["pinged"]
// ["post_modified"]
// ["post_modified_gmt"]
// ["post_content_filtered"]
// ["post_parent"]
// ["guid"]
// ["menu_order"]
// ["post_type"]
// ["post_mime_type"]
// ["comment_count"]
// ["filter"]
?>
<?php get_header(); ?>

<?php do_action('fnk_body_upper_side'); ?>
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    <?php

        wp_link_pages();
        echo $post->post_content;

    ?>

    <?php endwhile; ?>
    <?php endif; ?>
<?php do_action('fnk_body_bottom_side'); ?>

<?php get_footer(); ?>