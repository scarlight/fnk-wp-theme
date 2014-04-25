<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category Fatt Neng Kong Custom Meta Fields
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'fnk_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function fnk_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_fnk_';

	/**
	 * Title metabox text field
	 */
	$meta_boxes['page_title_metabox'] = array(
		'id'         => 'page_title_metabox',
		'title'      => __( 'Title in English', 'fnk' ),
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __( 'Title Name', 'fnk' ),
				'desc' => __( 'Optional: If page title is in chinese, you may add an english title to show beside the chinese title on the same line.', 'fnk' ),
				'id'   => $prefix . 'optional_title_text',
				'type' => 'text',
			),
			array(
			    'name'    => 'Short Line',
			    'id'      => $prefix . 'short_line',
			    'desc' => __( 'Should the title have a long or short line decoration.', 'fnk' ),
			    'type'    => 'radio_inline',
			    'options' => array(
			        'yes' => __( 'Yes', 'fnk' ),
			        'no'   => __( 'No', 'fnk' ),
			    ),
			),
		),
	);

	$meta_boxes['post_title_metabox'] = array(
		'id'         => 'post_title_metabox',
		'title'      => __( 'Title in English', 'fnk' ),
		'pages'      => array( 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __( 'Title Name', 'fnk' ),
				'desc' => __( 'Optional: If post title is in chinese, you may add an english title to show beside the chinese title on the same line.', 'fnk' ),
				'id'   => $prefix . 'optional_title_text',
				'type' => 'text',
			),
			array(
			    'name'    => 'Short Line',
			    'id'      => $prefix . 'short_line',
			    'desc' => __( 'Should the title have a long or short line decoration.', 'fnk' ),
			    'type'    => 'radio_inline',
			    'options' => array(
			        'yes' => __( 'Yes', 'fnk' ),
			        'no'   => __( 'No', 'fnk' ),
			    ),
			),
		),
	);

	$meta_boxes['category_title_metabox'] = array(
		'id'         => 'category_title_metabox',
		'title'      => __( 'Title in English', 'fnk' ),
		'pages'      => array( 'recent-news', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __( 'Title Name', 'fnk' ),
				'desc' => __( 'Optional: If category title is in chinese, you may add an english title to show beside the chinese title on the same line.', 'fnk' ),
				'id'   => $prefix . 'optional_title_text',
				'type' => 'text',
			),
			array(
			    'name'    => 'Short Line',
			    'id'      => $prefix . 'short_line',
			    'desc' => __( 'Should the title have a long or short line css decoration.', 'fnk' ),
			    'type'    => 'radio_inline',
			    'options' => array(
			        'yes' => __( 'Yes', 'fnk' ),
			        'no'   => __( 'No', 'fnk' ),
			    ),
			),
		),
	);

	/**
	 * Metabox for an options page. Will not be added automatically, but needs to be called with
	 * the `fnk_metabox_form` helper function. See wiki for more info.
	 */
	$meta_boxes['options_page'] = array(
		'id'      => 'options_page',
		'title'   => __( 'Theme Options Metabox', 'fnk' ),
		'show_on' => array( 'key' => 'options-page', 'value' => array( $prefix . 'theme_options', ), ),
		'fields'  => array(
			array(
				'name'    => __( 'Site Background Color', 'fnk' ),
				'desc'    => __( 'field description (optional)', 'fnk' ),
				'id'      => $prefix . 'bg_color',
				'type'    => 'colorpicker',
				'default' => '#ffffff'
			),
		)
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'fnk_initialize_fnk_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function fnk_initialize_fnk_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}
