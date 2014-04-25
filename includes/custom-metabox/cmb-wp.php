<?php
/*
Plugin Name: Fatt Neng Kong Custom Meta Boxes
Plugin URI: http://www.richcodesign.com/
Description: Create Meta Boxes for Fatt Neng Kong.
Version: 0.1
Author: Rich Codesign
Author URI: http://www.richcodesign.com/
License: GPL v2 or higher
License URI: License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

//Initialize the metabox class

function fnk_initialize_cmb_meta_boxes() {
    if ( ! class_exists( 'cmb_Meta_Box' ) )
        require_once(plugin_dir_path( __FILE__ ) . 'init.php');
}

add_action( 'init', 'fnk_initialize_cmb_meta_boxes', 9999 );

//Add Meta Boxes

function fnk_sample_metaboxes( $meta_boxes ) {
    $prefix = '_fnk_'; // Prefix for all fields

    $meta_boxes[] = array(
        'id' => 'test_metabox',
        'title' => 'Test Metabox',
        'pages' => array('page'), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => 'Test Text',
                'desc' => 'field description (optional)',
                'id' => $prefix . 'test_text',
                'type' => 'text'
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'fnk_sample_metaboxes' );