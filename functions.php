<?php
//**********************************************************************************************//
// START THEME SETUP.
//**********************************************************************************************//

function fnk_theme_setup_init()
{
    //**********************************************************************************************//
    // START DEFINE CONSTANTS.
    //**********************************************************************************************//
    define('FNK_THEMEROOT', get_template_directory_uri());
    define('FNK_IMAGES', FNK_THEMEROOT.'/images');

    //**********************************************************************************************//
    // START ACTIONS AND FILTERS.
    //**********************************************************************************************//
    add_action('wp_enqueue_scripts', 'fnk_load_css_files');
    add_action('wp_enqueue_scripts', 'fnk_load_js_files');
    add_action('init', 'fnk_register_my_menus');
    add_action('widgets_init', 'fnk_widgets_init' );

    add_action('fnk_body_upper_side', "add_fnk_body_upper_side", 10, 1);
    add_action('fnk_body_bottom_side', "add_fnk_body_bottom_side", 10, 1);
    add_action('fnk_left_container_start', "add_fnk_left_container_start", 10, 1);
    add_action('fnk_left_container_end', "add_fnk_left_container_end", 10, 1);
    add_action('fnk_right_container_start', "add_fnk_right_container_start", 10, 1);
    add_action('fnk_right_container_end', "add_fnk_right_container_end", 10, 1);

    add_action('fnk_welcome', "add_fnk_welcome", 10, 1);
    add_action('fnk_loop_recent_news', "add_fnk_loop_recent_news", 10, 1);
    add_action('fnk_loop_page', "add_fnk_loop_page", 10, 1);
    add_action('fnk_loop_blog', "add_fnk_loop_category", 10, 1);

    add_filter('language_attributes','fnk_language_attributes');
    add_filter('body_class','fnk_homepage_add_class');
    add_filter('admin_footer_text', 'fnk_footer_admin');
    add_filter('show_admin_bar', '__return_false' );
    add_filter('excerpt_length', 'fnk_excerpt_length');
    remove_action('wp_head', 'wp_generator');

    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-background' );
    add_image_size( 'featured-recent-news', 304, 194, true );
    add_image_size( 'sidebar-thumb', 220, 110, true );
    add_image_size( 'featured-detail', 220, 154, true );
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
    require_once("includes/options/theme-option.php");

    global $WordPress_carouFredSel;
    $WordPress_carouFredSel->Dev7_carouFredSel_RCD;

    remove_filter( $WordPress_carouFredSel->Dev7_carouFredSel_RCD->post_type . '_shortcode_output', array( $WordPress_carouFredSel->Dev7_carouFredSel_RCD, 'shortcode_output' ), 10, 5 );
    add_filter( $WordPress_carouFredSel->Dev7_carouFredSel_RCD->post_type . '_shortcode_output', 'caroufredsel_shortcode_new_output', 10, 5 );
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
        $classes[] = 'custom-background';
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

function caroufredsel_shortcode_new_output( $id, $output, $options, $attachments, $slider_type ) {
    $js_output     = '';
    $css_output    = '';
    $pagination    = '';
    $show_captions = false;

    // Checking for RCD setting
    $RCD_custom_layout = false;
    $custom_layout_pos = strpos($options['custom_css'], '.force-custom-setting');
    if( $custom_layout_pos !== false )
    {
        $RCD_custom_layout = true;
    }

    if ( $options['settings_mode'] == 'layout' ) {
        $layout            = $options['carousel_layout'];
        $layout_pagination = '';
        $layout_prev_next  = '';
        $layouts           = $this->get_layouts();
        $js_file           = $layouts[$layout]['layout_dir'] . '/' . $layout . '.js';
        $js_output         = file_get_contents( $js_file );
        // Nav and Pag
        $pagination = $layouts[$layout]['layout_details']['SupportsPagination'];
        $prev_next  = $layouts[$layout]['layout_details']['SupportsPrevNext'];
        $captions   = $layouts[$layout]['layout_details']['SupportsCaptions'];
        if ( $captions == 'true' ) {
            $show_captions = true;
        }

        $js_output = str_replace( '$(".dev7-carousel").', '$("#caroufredsel-' . $id . '").', $js_output );
        $js_output = str_replace( '$(\'.dev7-carousel\').', '$("#caroufredsel-' . $id . '").', $js_output );

        $js_output = str_replace( '.dev7-caroufredsel-', '#dev7-caroufredsel-wrapper-' . $id . ' .dev7-caroufredsel-', $js_output );

        if ( $layouts[$layout]['layout_css'] ) {
            $css_file   = $layouts[$layout]['layout_dir'] . '/' . $layout . '.css';
            $css_output = file_get_contents( $css_file );
        }
        if ( $options['custom_layout'] == 'on' ) {
            // Custom Nav and Pag
            if ( $options['nav'] == 'off' ) {
                $prev_next = 'false';
            }
            if ( $options['pagination'] == 'on' ) {
                $pagination = ( $options['pag_thumb'] == 'on' ) ? 'thumbs' : 'true';
            } else {
                $pagination = 'false';
            }
        }
    }
    if ( $options['settings_mode'] == 'advanced' || ( $options['custom_layout'] == 'on' && $options['settings_mode'] == 'layout' ) ) {
        // All advanced settings also used for customising layouts

        // Nav and Pag
        $pagination = 'false';
        if ( $options['pagination'] == 'on' ) {
            $pagination = ( $options['pag_thumb'] == 'on' ) ? 'thumbs' : 'true';
        }
        $prev_next = ( $options['nav'] == 'on' ) ? 'true' : 'false';


        $custom_js_output = '';
        if ( isset( $options['circular'] ) ) {
            $custom_js_output .= '          circular:   ' . ( ( $options['circular'] == 'on' ) ? 'true' : 'false' ) . ',' . "\n";
        }
        if ( isset( $options['infinite'] ) ) {
            $custom_js_output .= '          infinite:   ' . ( ( $options['infinite'] == 'on' ) ? 'true' : 'false' ) . ',' . "\n";
        }
        if ( isset( $options['responsive'] ) ) {
            $custom_js_output .= '      responsive: ' . ( ( $options['responsive'] == 'on' ) ? 'true' : 'false' ) . ',' . "\n";
        }
        if ( isset( $options['direction'] ) ) {
            $custom_js_output .= '      direction:  "' . $options['direction'] . '",' . "\n";
        }
        if ( isset( $options['align'] ) ) {
            $custom_js_output .= '          align:  "' . $options['align'] . '",' . "\n";
        }
        $width = 'null';
        if ( $options['width'] != '' ) {
            $width = $options['width'];
            if ( ! is_numeric( $width ) ) {
                $width = '"' . $width . '"';
            }
        }
        if ( isset( $options['width'] ) ) {
            $custom_js_output .= '          width:  ' . $width . ',' . "\n";
        }
        $height = 'null';
        if ( $options['height'] != '' ) {
            $height = $options['height'];
            if ( ! is_numeric( $height ) ) {
                $height = '"' . $height . '"';
            }
        }
        if ( isset( $options['height'] ) ) {
            $custom_js_output .= '          height: ' . $height . ',' . "\n";
        }
        $custom_js_output .= '                                      items: {' . "\n";
        if ( isset( $options['visible'] ) ) {
            $custom_js_output .= '          visible:    ' . ( ( $options['visible'] != '' ) ? $options['visible'] : 'null' ) . ',' . "\n";
        }
        if ( isset( $options['start_image'] ) ) {
            $custom_js_output .= '      start:      ' . ( ( $options['start_image'] != '' ) ? $options['start_image'] : '0' ) . ',' . "\n";
        }
        $custom_js_output .= '                                      },' . "\n";
        $custom_js_output .= '                                      scroll: {' . "\n";
        if ( isset( $options['images_scroll'] ) ) {
            $custom_js_output .= '  items:      ' . ( ( $options['images_scroll'] != '' ) ? $options['images_scroll'] : 'null' ) . ',' . "\n";
        }
        if ( isset( $options['scroll_effect'] ) ) {
            $custom_js_output .= '  fx:         "' . $options['scroll_effect'] . '",' . "\n";
        }
        if ( isset( $options['scroll_easing'] ) ) {
            $custom_js_output .= '  easing:     "' . $options['scroll_easing'] . '",' . "\n";
        }
        if ( isset( $options['scroll_duration'] ) ) {
            $custom_js_output .= '  duration:       ' . ( ( $options['scroll_duration'] != '' ) ? $options['scroll_duration'] : '500' ) . ',' . "\n";
        }
        if ( isset( $options['hover'] ) ) {
            $custom_js_output .= '          pauseOnHover:   ' . ( ( $options['hover'] == 'on' ) ? 'true' : 'false' ) . ',' . "\n";
        }
        $custom_js_output .= '                                      },' . "\n";
        $custom_js_output .= '                                      auto: {' . "\n";
        if ( isset( $options['autoplay'] ) ) {
            $custom_js_output .= '  play:   ' . ( ( $options['autoplay'] == 'on' ) ? 'true' : 'false' ) . ',' . "\n";
        }
        if ( isset( $options['timeout_duration'] ) && $options['timeout_duration'] != '' ) {
            $custom_js_output .= '  timeoutDuration:    ' . $options['timeout_duration'] . ',' . "\n";
        }
        $custom_js_output .= '                                      },' . "\n";
        $custom_js_output .= '                                      prev: {' . "\n";
        if ( isset( $options['nav'] ) ) {
            $custom_js_output .= '              button:     ' . ( ( $options['nav'] == 'on' ) ? '"#dev7-caroufredsel-wrapper-' . $id . ' .dev7-caroufredsel-prev"' : 'null' ) . ',' . "\n";
        }
        if ( isset( $options['key_nav'] ) ) {
            $custom_js_output .= '          key:            ' . ( ( $options['key_nav'] == 'on' ) ? '"left"' : 'null' ) . ',' . "\n";
        }
        $custom_js_output .= '                                      },' . "\n";
        $custom_js_output .= '                                      next: {' . "\n";
        if ( isset( $options['nav'] ) ) {
            $custom_js_output .= '              button:     ' . ( ( $options['nav'] == 'on' ) ? '"#dev7-caroufredsel-wrapper-' . $id . ' .dev7-caroufredsel-next"' : 'null' ) . ',' . "\n";
        }
        if ( isset( $options['key_nav'] ) ) {
            $custom_js_output .= '          key:            ' . ( ( $options['key_nav'] == 'on' ) ? '"right"' : 'null' ) . ',' . "\n";
        }
        $custom_js_output .= '                                      },' . "\n";
        if ( isset( $options['pagination'] ) ) {
            $custom_js_output .= '  pagination: { container:    ' . ( ( $options['pagination'] == 'on' ) ? '"#dev7-caroufredsel-wrapper-' . $id . ' .dev7-caroufredsel-pag"' : 'null' ) . ', anchorBuilder   : ' . ( ( isset( $options['pag_thumb'] ) && $options['pag_thumb'] == 'on' ) ? 'false' : 'null' ) . ', },' . "\n";
        }
        if ( isset( $options['swipe_nav'] ) ) {
            $custom_js_output .= '  swipe: { onTouch:   ' . ( ( $options['swipe_nav'] == 'on' ) ? 'true' : 'false' ) . ' },' . "\n";
        }

        // All advanced settings used for customising layouts
        if ( $options['settings_mode'] == 'layout' ) {
            $js_output = str_replace( '//customisations', ', '. $custom_js_output, $js_output );
        } else {
            $js_output .= $custom_js_output;
        }


    }

    // Captions
    if ( ( isset( $options['enable_captions'] ) && $options['enable_captions'] == 'on' ) && $options['settings_mode'] != 'layout' || ( $options['custom_layout'] == 'on' && $options['settings_mode'] == 'layout' ) ) {
        $show_captions = true;
    }

    // RCD interested in this mode
    if ( $options['settings_mode'] == 'super' ) {
        $js_output = $options['raw_jquery'];
        if ( strpos( $js_output, '.dev7-caroufredsel-pag' ) !== false ) {
            $pagination = ( $options['pag_thumb'] == 'on' ) ? 'thumbs' : 'true';
        }
        if ( strpos( $js_output, '.dev7-caroufredsel-thumb' ) !== false ) {
            $pagination = ( $options['pag_thumb'] == 'on' ) ? 'thumbs' : 'false';
        }
        if($RCD_custom_layout){
            // Custom Nav and Pag
            $prev_next = 'true'; // RCD: show prev & next link. Don't care if the [nav] setting is off
        }
    }

    do_action( 'caroufredsel_before_caroufredsel' );

    // RCD
    if($RCD_custom_layout)
    {
        // Next / Previous Buttons
        if ( isset( $prev_next ) && $prev_next == 'true' ) {
            $output.= '<div class="navi-prev-next">';
            $output.= '<a class="prev" href="#"></a>';
            $output.= '<a class="next" href="#"></a>';
            $output.= '</div>';
        }

        $image_link = dev7_default_val( $options, 'image_link', 'on' );
        $output .= '<div id="dev7-caroufredsel-wrapper-' . $id . '" class="dev7-caroufredsel-wrapper' . ( ( $options['enable_lightbox'] == 'on' && $image_link == 'off' ) ? ' enable-lightbox' : '' ) . '">';
        $output .= '<ul id="caroufredsel-' . $id . '">';

        $a_rel   = 'caroufredsel-' . $id;

        foreach ( $attachments as $attachment ) {
            $image_thumb = $attachment['image_src'];
            $rcd_img_large = wp_get_attachment_image_src($attachment['attachment_id'], "event-gallery-photo"); //RCD
//
//            <li style="margin-right: 5px;">
//                <a href="http://localhost/sites2/fnk/db/wp-content/themes/fnk-wp-theme/images/fnk-logo-no-photo-800-600.jpg" title="KLIGP 2012" rel="lightbox-event2014">
//                    <img alt="KLIGP 2012" src="http://localhost/sites2/fnk/db/wp-content/themes/fnk-wp-theme/images/no-photo-68.jpg" width="68" height="49">
//                </a>
//            </li>

            $alt     = ( isset( $attachment['alt_text'] ) ) ? __( $attachment['alt_text'] ) : false;
            $link    = ( isset( $attachment['post_permalink'] ) ) ? __( $attachment['post_permalink'] ) : false;
            $caption = ( isset( $attachment['post_title'] ) ) ? __( $attachment['post_title'] ) : false;

            $image = '<img ' . 'src="' . $image_thumb . '" width="68"' . 'height="49"';
            if ( $alt != '' ) {
                $image .= ' alt="' . $alt . '"';
            }
            $image .= ' />';

            $output .= '<li>';
            $output .= '<a '.'title="' . $caption . '"'.' href="'. $rcd_img_large[0] .'" rel="lightbox-'. $a_rel .'">';
            $output .=  $image;
            $output .= '</a>';
            $output .= '</li>';

        }
        $output .= '</ul>';
        $output .= '<div class="dev7-clearfix"></div>';

    }
    else
    {
        $image_link = dev7_default_val( $options, 'image_link', 'on' );
        $output .= '<div id="dev7-caroufredsel-wrapper-' . $id . '" class="dev7-caroufredsel-wrapper' . ( ( $options['enable_lightbox'] == 'on' && $image_link == 'off' ) ? ' enable-lightbox' : '' ) . '">';
        $output .= '<div id="caroufredsel-' . $id . '" class="dev7-caroufredsel-carousel">';

        $a_class = '';
        $a_rel   = 'caroufredsel-' . $id;

        $lb_options = get_option( 'caroufredsel_settings' );
        if ( ! isset( $lb_options['lightbox-config'] ) ) {
            $lb_options['lightbox-config'] = 'default';
        }
        if ( $lb_options['lightbox-config'] != 'default' ) {
            $a_class = $lb_options['custom-class'];
            $a_rel   = $lb_options['custom-rel'];
        }

        foreach ( $attachments as $attachment ) {
            $image_full = $attachment['image_src'];

            $alt     = ( isset( $attachment['alt_text'] ) ) ? __( $attachment['alt_text'] ) : false;
            $link    = ( isset( $attachment['post_permalink'] ) ) ? __( $attachment['post_permalink'] ) : false;
            $caption = ( isset( $attachment['post_title'] ) ) ? __( $attachment['post_title'] ) : false;

            if ( $show_captions ) {
                $output .= '<div class="dev7-caroufredsel-image">';
            }

            $lightbox          = '';
            $lightbox_captions = '';
            if ( isset( $options['enable_lightbox'] ) && $options['enable_lightbox'] == 'on' && $image_link == 'off' ) {
                $lightbox          = ' data-img="' . $image_full . '" rel="' . $a_rel . '" ';
                $lightbox_title    = ( $caption ) ? $caption : '';
                $lightbox_link     = ( $link ) ? $link : '';
                $lightbox_captions = ' title="' . $lightbox_title . '" data-link="' . $lightbox_link . '" ';
            }

            $image = '<img ' . $lightbox . $lightbox_captions . 'src="' . $image_full . '"';
            if ( $alt != '' ) {
                $image .= ' alt="' . $alt . '"';
            }
            $image .= ' />';

            if ( $image_link == 'on' && $link ) {
                $target_blank = dev7_default_val( $options, 'target_blank', 'on' );
                $target = ( $target_blank == 'on' ) ? ' target="_blank"' : '';
                $output .= '<a '. $target .' href="'. $link .'">';
                $output .=  $image;
                $output .= '</a>';
            } else {
                $output .= $image;
            }

            if ( ( $link || $caption ) && $show_captions ) {
                $output .= '<p class="dev7-carousel-caption">';
                $output .= ( $caption ) ? $caption : '';
                $output .= ( $link ) ? ' <a href="' . $link . '">' . $link . '</a>' : '';
                $output .= '</p>';
            }
            if ( $show_captions ) {
                $output .= '</div>';
            }
        }
        $output .= '</div>';
        $output .= '<div class="dev7-clearfix"></div>';

        if ( isset( $options['enable_lightbox'] ) && $options['enable_lightbox'] == 'on' && $image_link == 'off' ) {
            $output .= '<script type="text/javascript">                                     ' . "\n";
            $output .= '    jQuery(document).ready(function($) {                            ' . "\n";
            $output .= '            $(".dev7-caroufredsel-carousel img").colorbox({         ' . "\n";
            $output .= '                href: function() {                                  ' . "\n";
            $output .= '                    var url = $(this).attr("data-img");             ' . "\n";
            $output .= '                    return url;                                     ' . "\n";
            $output .= '                },                                                  ' . "\n";
            $output .= '                rel: "' . $a_rel . '",                              ' . "\n";
            $output .= '                title: function() {                                 ' . "\n";
            $output .= '                    var url = $(this).attr("data-link");            ' . "\n";
            $output .= '                    var title = $(this).attr("title");              ' . "\n";
            $output .= '                    return \'<a href="\' + url + \'" target="_blank">\' + title +\'</a>\';  ' . "\n";
            $output .= '                },                                                  ' . "\n";
            $output .= '            });                                                     ' . "\n";
            $output .= '    });                                                             ' . "\n";
            $output .= '</script>                                                           ' . "\n";
        }

        // Next / Previous Buttons
        if ( isset( $prev_next ) && $prev_next == 'true' ) {
            $output .= '<a class="dev7-caroufredsel-prev" href="#"><span>prev</span></a>';
            $output .= '<a class="dev7-caroufredsel-next" href="#"><span>next</span></a>';
        }
    }

    // Pagination
    if ( $pagination ) {
        if($RCD_custom_layout)
        {
            // no pagination for the custom carousel
        }
        else{
            $output .= '<div class="dev7-caroufredsel-pag">';
            if ( $pagination == 'thumbs' ) {
                foreach ( $attachments as $attachment ) {
                    $image      = $attachment['thumbnail'];
                    $image_full = $attachment['image_src'];
                    $thumb_src  = $thumb_src = 'src="' . $attachment['thumbnail'] . '"';

                    if ( isset( $options['dim_x'] ) && isset( $options['dim_y'] ) && $options['dim_x'] && $options['dim_y'] ) {
                        if ( isset( $attachment['type'] ) && $attachment['type'] == 'wp' ) {
                            $resized_image =  Dev7_Core_Images::resize_image( $attachment['attachment_id'], '', $options['dim_x'], $options['dim_y'], true );
                            if ( is_wp_error( $resized_image ) ) {
                                $output .= '<p>Error: ' . $resized_image->get_error_message() . '</p>';
                            } else {
                                $thumb_src = 'src="' . $resized_image['url'] . '" ';
                            }
                        } else {
                            $thumb_src = 'src="' . $attachment['thumbnail'] . '" width="' . $options['dim_x'] . '" height="' . $options['dim_y'] . '" ';
                        }
                    }
                    $output .= '<a class="dev7-caroufredsel-thumb" href="#"><img ' . $thumb_src . '';
                    $output .= ' /></a>';
                }
            }
            $output .= '</div>';
        }
    }

    $output .= '</div>';
    do_action( 'caroufredsel_after_caroufredsel' );

    $output .= '<script type="text/javascript">                         ' . "\n";
    $output .= '    jQuery(document).ready(function($) {                ' . "\n";
    $output .= '        function runCarousel() {                        ' . "\n";
    if ( $options['settings_mode'] != 'layout' ) {
        $output .= '        $("#caroufredsel-' . $id . '").carouFredSel({   ' . "\n";
    }
    $output .= '        ' . $js_output . "\n";
    if ( $options['settings_mode'] != 'layout' ) {
        $output .= '        });     ' . "\n";
    }
    $output .= '        }                                               ' . "\n";
    $output .= '        $("#caroufredsel-' . $id . '").imagesLoaded(runCarousel);       ' . "\n";
    $output .= '    });                                                 ' . "\n";
    $output .= '</script>                                               ' . "\n";

    if ( isset( $options['nav'] ) ) {
        $js_output .= '             button:     ' . ( ( $options['nav'] == 'on' ) ? '".dev7-caroufredsel-next"' : 'null' ) . ',' . "\n";
    }
    if ( trim( $css_output ) . trim( $options['custom_css'] ) != '' || ( isset( $options['enable_lightbox'] ) && $options['enable_lightbox'] == 'on' ) ) {
        $output .= '<style type="text/css" media="screen">                  ' . "\n";
        $output .= $css_output . "\n";
        $output .= $options['custom_css'] . "\n";
        if ( isset( $options['enable_lightbox'] ) && $options['enable_lightbox'] == 'on' && $image_link == 'off' ) {
            $output .= '.dev7-caroufredsel-carousel img {' . "\n";
            $output .= '    cursor: pointer;' . "\n";
            $output .= '}' . "\n";
        }
        $output .= '</style>                                                ' . "\n";
    }

    return $output;
}
