<?php
/**
 * Custom 404.php template file
 *
 * Used to display if there is a 404 error on the webpage
 * WordPress site.
 *
 */
?>
<?php //echo __FILE__ ?>

<?php get_header(); ?>

<?php do_action('fnk_body_upper_side'); ?>

    <?php if ( is_active_sidebar( 'right_sidebar' ) ) { ?>

        <?php do_action('fnk_left_container_start') ?>

            <div>
                <?php
                    // http://wordpress.org/support/topic/add-a-back-link-to-a-post
                    // improved via http://stackoverflow.com/questions/12369615/serverhttp-referer-missing
                    $back = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
                    if( (isset($back) && $back !='' ) ) {
                        $back = '<a style="color:red;" href="'.$back.'">previous page</a>';
                    }
                    else
                    {
                        $back = "previous page";
                    }
                ?>
                <img class="right" src="<?php echo FNK_IMAGES; ?>/are-you-lost.png" alt="Fatt Neng Kong">
                <div style="display:inline-block; width:690px; text-align:center; margin-top:-106px;">
                    <img src="<?php echo FNK_IMAGES; ?>/404.png" alt="Fatt Neng Kong">
                    <h3 style="font-weight:600;">Page doesn't exist or some other error occured. Go to our <a style="color:red;" href="<?php bloginfo('url'); ?>">home page</a> or go back to <?php echo $back; ?>.</h3>
                </div>
                <div class="clear"></div>
            </div>

        <?php do_action('fnk_left_container_end') ?>

        <?php do_action('fnk_right_container_start') ?>

        <?php get_sidebar(); ?>

        <?php do_action('fnk_right_container_start') ?>

    <?php } else { ?>

        <div>
            <?php
                // http://wordpress.org/support/topic/add-a-back-link-to-a-post
                // improved via http://stackoverflow.com/questions/12369615/serverhttp-referer-missing
                $back = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
                if( (isset($back) && $back !='' ) ) {
                    $back = '<a style="color:red;" href="'.$back.'">previous page</a>';
                }
                else
                {
                    $back = "previous page";
                }
            ?>
            <img class="right" src="<?php echo FNK_IMAGES; ?>/are-you-lost.png" alt="Fatt Neng Kong">
            <div style="display:inline-block; width:690px; text-align:center; margin-top:90px;">
                <img src="<?php echo FNK_IMAGES; ?>/404.png" alt="Fatt Neng Kong">
                <h3 style="font-weight:600;">Page doesn't exist or some other error occured. Go to our <a style="color:red;" href="<?php bloginfo('url'); ?>">home page</a> or go back to <?php echo $back; ?>.</h3>
            </div>
            <div class="clear"></div>
        </div>

    <?php } ?>


    <?php do_action('fnk_body_bottom_side'); ?>

<?php get_footer(); ?>