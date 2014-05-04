<?php
//https://github.com/paulund/wordpress-theme-customizer-custom-controls/blob/master/theme-customizer-demo.php
function fnk_customize_register( $wp_customize ) {

    $wp_customize->add_section( 'fnk_customize_setting', array(
        'title'          => 'Other Settings',
        'priority'       => 35,
    ) );

    // Shortcode
    $wp_customize->add_setting( 'fnk_customize_slider_setting', array(
        'default'        => '[metaslider id=123]',
    ) );

    $wp_customize->add_control( 'fnk_customize_slider_setting', array(
        'label'    => 'Slider Default Shortcode',
        'section'  => 'fnk_customize_setting',
        'type'     => 'text',
        'priority' => 1
    ) );

    // Footer
    require_once dirname(__FILE__).'\library\textarea-custom-control.php';
    $wp_customize->add_setting( 'fnk_customize_footer_setting', array(
        'default' => '© 2014 法能宫慈善基金 Persatuan Penganut Dewa Fatt Neng Kong',
    ) );

    $wp_customize->add_control( new Textarea_Custom_Control( $wp_customize, 'fnk_customize_footer_setting', array(
        'label'   => 'Footer Copyright',
        'section' => 'fnk_customize_setting',
        'settings'   => 'fnk_customize_footer_setting',
        'priority' => 10
    ) ) );

}
add_action( 'customize_register', 'fnk_customize_register' );

?>