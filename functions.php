<?php
/******************************** TODO ********************************/
/*
 - read the comment instructions if any before removing the comment & before uploading to the live server
 - remove any un-needed functions and filter calls
*/
/****************************** TODO END ******************************/
/*
                                    v
                                    v
                                    v
                                    v
                                    v
                                    v
                                    v
*/

//**********************************************************************************************//
// START THEME SETUP.
//**********************************************************************************************//

function fnk_theme_setup_init()
{
    //**********************************************************************************************//
    // START DEFINE CONSTANTS.
    //**********************************************************************************************//
    // define ('WPCF7_AUTOP', false ); in wp-config
    define('FNK_THEMEROOT', get_template_directory_uri());
    define('FNK_IMAGES', FNK_THEMEROOT.'/images');
    //define('WOOCOMMERCE_USE_CSS', false); for disabling woocommerce default css

    add_action('wp_enqueue_scripts', 'fnk_load_css_files');                                         /* Load CSS Files */
    add_action('wp_enqueue_scripts', 'fnk_load_js_files');                                          /* Load JS Files */
    add_action('init', 'fnk_register_my_menus');                                                    /* Add Main Menus and Other Menus. */ /*Please replace the menu name accordingly with your theme */
    // add_action( "fnk_header_breadcrumb", "fnk_template_header_breadcrumb", 10, 1);                  /* add an action for fnk header breadcrumb */
    add_action('widgets_init', 'fnk_widgets_init' );                                                /* Register our sidebars and widgetized areas. */ /*Please modify the function accordingly with your theme */

    add_action('fnk_body_upper_side', "add_fnk_body_upper_side", 10, 1);
    add_action('fnk_body_bottom_side', "add_fnk_body_bottom_side", 10, 1);
    add_action('fnk_left_container_start', "add_fnk_left_container_start", 10, 1);
    add_action('fnk_left_container_end', "add_fnk_left_container_end", 10, 1);
    add_action('fnk_right_container_start', "add_fnk_right_container_start", 10, 1);
    add_action('fnk_right_container_end', "add_fnk_right_container_end", 10, 1);

    add_action('fnk_post', "add_fnk_post", 10, 1); // not using at the momment
    add_action('fnk_welcome', "add_fnk_welcome", 10, 1);
    add_action('fnk_loop_recent_news', "add_fnk_loop_recent_news", 10, 1);
    add_action('fnk_loop_page', "add_fnk_loop_page", 10, 1);
    add_action('fnk_loop_blog', "add_fnk_loop_category", 10, 1);

    add_filter('language_attributes','fnk_language_attributes');                                    /* better ie10 or less browser detection via language_attributes filter; http://simplemediacode.info/snippets/better-brower-detection-with-language_attributes-filter-in-wordpress/ */
    add_filter('body_class','fnk_homepage_add_class');                                              /* Add "homepage" class to body when viewing home page. */
    add_filter('admin_footer_text', 'fnk_footer_admin');                                            /* Customise the footer in admin area */
    add_filter('show_admin_bar', '__return_false' );                                                /* Remove the admin bar from the front end */
    add_filter('excerpt_length', 'fnk_excerpt_length');
    remove_action('wp_head', 'wp_generator');                                                       /* Remove the version number of WP. Warning - this info is also available in the readme.html file in your root directory - delete this file! */

    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-background' );
    add_image_size( 'featured-recent-news', 304, 194, true );
    add_image_size( 'sidebar-thumb', 220, 110, true );
    add_image_size( 'sidebar-tiny-thumb', 42, 42, true );
    add_image_size( 'event-gallery-thumb', 68, 49, true );
    add_image_size( 'event-gallery-photo', 800, 600, true );

    require_once("includes/template-tags.php");
    require_once("includes/widget/fnk_facebook_link.php");
    require_once("includes/widget/fnk_donate_widget.php");
    require_once("includes/widget/fnk_latest_cause.php");
    require_once("includes/widget/fnk_recent_post_by_category.php");
    require_once("includes/widget/fnk_sidebar_menu.php");
    require_once("includes/shortcode/shortcode.php");
    require_once("includes/custom-metabox/functions.php");
    require_once("includes/taxonomy-metabox/functions.php");

}
add_action( 'after_setup_theme', 'fnk_theme_setup_init' );

//**********************************************************************************************//
// START OTHER FUNCTIONS, FILTERS AND SETTINGS.
//**********************************************************************************************//

function fnk_locate_template_of_some_callback() /* use this if need to load a template */
{
    locate_template('fnk_form.php', true, true);
}

function fnk_load_css_files() /* Load CSS Files */
{
    global $wp_styles, $is_IE;

    // update the version accodingly if there is a latest version
    wp_register_style( 'fnk_fonts_googleapis', 'http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700', array(), 'screen' );
    wp_register_style( 'fnk_font_awesome', FNK_THEMEROOT.'/css/font-awesome.css', array(), '4.0.3', 'screen' );
    wp_register_style( 'fnk_css_bootstrap', FNK_THEMEROOT.'/css/bootstrap.css', array(), '1.0', 'screen' );
    wp_register_style( 'fnk_css_theme', FNK_THEMEROOT.'/css/theme.css', array('fnk_css_bootstrap'), '1.0', 'screen' );
    wp_register_style( 'fnk_css_slimbox2', FNK_THEMEROOT.'/css/slimbox2.css', array(), '2.05', 'screen' );
    wp_register_style( 'fnk_css_template', FNK_THEMEROOT.'/css/template.css', array('fnk_css_bootstrap'), '1.0', 'screen' );

    wp_register_style( 'fnk_sample_for_ie', FNK_THEMEROOT.'/css/sample_for_ie.css', array('fnk_sample_dependent'), '1.0', 'screen' ); /* modify / remove this sample if no need*/

    wp_enqueue_style( 'fnk_fonts_googleapis');
    wp_enqueue_style( 'fnk_font_awesome');
    wp_enqueue_style( 'fnk_css_bootstrap');
    wp_enqueue_style( 'fnk_css_theme');
    wp_enqueue_style( 'fnk_css_slimbox2');
    wp_enqueue_style( 'fnk_css_template');

    if ( $is_IE ) { /* maybe removed soon since I have better IE detection via language_attribute filter */
        wp_enqueue_style( 'fnk_sample_for_ie');
        // Add IE conditional tags for IE VERSION_NUMBER and older
        $wp_styles->add_data( 'fnk_sample_for_ie', 'conditional', 'lte IE VERSION_NUMBER' );
    }
}

function fnk_load_js_files() /* Load JS Files */
{
    // update the version accodingly if there is a latest version
    // jquery is included by default by wordpress
    wp_register_script('fnk_js_bootstrap', FNK_THEMEROOT.'/js/bootstrap.min.js', array('jquery'), '1.0', false );
    wp_register_script('fnk_js_easing', FNK_THEMEROOT.'/js/jquery.easing.1.3.js', array(), '1.3', false );
    // wp_register_script('fnk_js_validate', FNK_THEMEROOT.'/js/jquery.validate.js', array(), '1.11.1', false );
    wp_register_script('fnk_js_caroufredsel', FNK_THEMEROOT.'/js/jquery.carouFredSel.js', array('jquery'), '6.1.0', false );
    wp_register_script('fnk_js_slimbox', FNK_THEMEROOT.'/js/slimbox2.js', array('jquery'), '2.05', false );
    wp_register_script('fnk_js_tweenmax', FNK_THEMEROOT.'/js/TweenMax.min.js', array('jquery'), '1.10.3', false );
    wp_register_script('fnk_js_pajinator', FNK_THEMEROOT.'/js/jquery.pajinate.js', array('jquery'), '0.4', false );
    // hoverIntent.js is included by default by wordpress
    wp_register_script('fnk_js_supersubs', FNK_THEMEROOT.'/js/supersubs.js', array('jquery'), 'v0.3b', false );
    wp_register_script('fnk_js_superfish', FNK_THEMEROOT.'/js/superfish.min.js', array('jquery'), 'v1.7.4', false );
    wp_register_script('fnk_js_custom', FNK_THEMEROOT.'/js/custom.min.js', array('jquery'), '1.0', false );

    wp_enqueue_script('fnk_js_bootstrap');
    wp_enqueue_script('fnk_js_easing');
    // wp_enqueue_script('fnk_js_validate');
    wp_enqueue_script('fnk_js_caroufredsel');
    wp_enqueue_script('fnk_js_slimbox');
    wp_enqueue_script('fnk_js_tweenmax');
    wp_enqueue_script('fnk_js_pajinator');
    // hoverIntent.js is included by default by wordpress
    wp_enqueue_script('fnk_js_supersubs');
    wp_enqueue_script('fnk_js_superfish');
    wp_enqueue_script('fnk_js_custom');
}

function fnk_remove_woocommerce_generator() /* Remove WooCommerce Generator */
{
    global $woocommerce;
    remove_action( 'wp_head', array( $woocommerce, 'generator' ) );
}

function fnk_register_my_menus() /* Add Main Menus and Other Menus. */
{
    register_nav_menus(array(
        'main-menu' => 'Main Menu'
    ));

    require_once ( "includes/templates-parts/fnk-menu-walker.php" );
}

function fnk_template_header_breadcrumb($args) /* add an action for fnk header breadcrumb */
{

    // add a php code with do_action('fnk_header_breadcrumb'); inside to kick this function running

    if ( function_exists( 'breadcrumb_trail' ) ){
        breadcrumb_trail(
            array(
                'show_on_front'=> false,
                'separator' => '&gt;',
                'show_browse' => false
            )
        );
    }
}

function fnk_widgets_init() /* Register our sidebars and widgetized areas. */
{
    if(function_exists("register_sidebar"))
    {
        register_sidebar( array(
            'name'          => __( 'Right Sidebar', 'fnk' ),
            'id'            => 'right_sidebar',
            'description'   => 'Widgets in this area will be shown on the right-hand side.',
            'class'         => '',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '<div class="clear"></div></div><br><br>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        ));

        register_sidebar( array(
            'name'          => __( 'Top Corner Sidebar', 'fnk' ),
            'id'            => 'top_corner_sidebar',
            'description'   => 'Widgets in this area will be shown on the top right corner. Available size is [132px x 51px] only.',
            'class'         => '',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        ));
    }
}

function fnk_language_attributes($content) /* better ie10 or less browser detection via language_attributes filter; http://simplemediacode.info/snippets/better-brower-detection-with-language_attributes-filter-in-wordpress/ */
{
    global $is_IE;
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $iev='';

    if (isset( $browser ) && (strpos( $browser , 'MSIE') !== false)) {
        preg_match('/MSIE (.*?);/', $browser, $matches);
        if (count($matches)>1){
            $iev = $matches[1];
        }
    }
    if ($is_IE) {
        return $content.' id="ie'.$iev.'" class="ie" ' ;
    }
    else {
        return $content;
    }
}

function fnk_homepage_add_class() /* Add "homepage" class to body when viewing home page. */
{
    if(is_front_page()){
        $classes[] = 'homepage custom-background';
    }
    else{
        $classes[] = '';
    }
    return $classes;
}

function fnk_footer_admin () /* Customise the footer in admin area */
{
    echo 'Theme designed and developed by <a href="http://www.richcodesign.com/" target="_blank">Rich Codesign</a> and powered by <a href="http://wordpress.org" target="_blank">WordPress</a>.';
}

function add_fnk_body_upper_side()
{
    locate_template( 'includes/templates-parts/fnk-body-upper-side.php', true, true );
}

function add_fnk_body_bottom_side()
{
    locate_template( 'includes/templates-parts/fnk-body-bottom-side.php', true, true );
}

function add_fnk_left_container_start()
{
    locate_template( 'includes/templates-parts/fnk-left-container-start.php', true, true );
}

function add_fnk_left_container_end()
{
    locate_template( 'includes/templates-parts/fnk-left-container-end.php', true, true );
}

function add_fnk_right_container_start()
{
    locate_template( 'includes/templates-parts/fnk-right-container-start.php', true, true );
}

function add_fnk_right_container_end()
{
    locate_template( 'includes/templates-parts/fnk-right-container-end.php', true, true );
}

function add_fnk_post()
{
    locate_template("includes/loops/fnk-post.php", true, true);
}

function add_fnk_welcome()
{
    locate_template( 'fnk-welcome.php', true, true );
}

function add_fnk_loop_recent_news(){
    locate_template( 'includes/loops/fnk-loop-recent-news.php', true, true );
}

function add_fnk_loop_page(){
    locate_template( 'includes/loops/fnk-post.php', true, true );
}

function add_fnk_loop_category(){
    locate_template( 'includes/loops/fnk-loop-category.php', true, true );
}

function fnk_excerpt_length($len) {
    return 25;
}