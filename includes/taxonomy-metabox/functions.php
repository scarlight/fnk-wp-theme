<?php
/*
Plugin Name: Category Meta
Plugin URI: http://www.richcodesign.com
Description: Add meta for the category taxonomy
Version: 0.1
Author: Rich Codesign
Author URI: http://www.richcodesign.com
*/

//include the main class file
require_once("Tax-meta-class/Tax-meta-class.php");
if (is_admin()){
/*
 * prefix of meta keys, optional
 */
$prefix = 'fnk_';
/*
 * configure your meta box
 */
$config = array(
  'id' => 'language_meta_box',           // meta box id, unique per meta box
  'title' => 'Additional Options',       // meta box title
  'pages' => array('category'),          // taxonomy name, accept categories, post_tag and custom taxonomies
  'context' => 'normal',                 // where the meta box appear: normal (default), advanced, side; optional
  'fields' => array(),                   // list of meta fields (can be added by field arrays)
  'local_images' => false,               // Use local or hosted images (meta box images for add/remove)
  'use_with_theme' => true               // change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);

   /*
    * Initiate your meta box
    */
    $my_meta =  new Tax_Meta_Class($config); // only one meta box for now

   /*
    * Add fields to your meta box
    */

    //text field
    $my_meta->addText($prefix.'tax_text_field_id',
        array(
            'name'=> __('Additional Translation ','tax-meta'),
            'desc'=> __('<span class="description">Add a chinese equivalent translation of the this category.</span>','tax-meta')
        )
    );

    //radio field
    $my_meta->addRadio($prefix.'tax_radio_field_id',
        array(
            'yes'=>'Yes',
            'no'=>'No'
        ),
        array(
            'name'=> __('Short Line','tax-meta'),
            'desc'=> __('<span class="description">Should the title have a long or short line css decoration.</span>','tax-meta'),
            'style'=>__('width:auto; margin-left:10px;'),
            'std'=> array('no')
        )
    );
   /*
    * Don't Forget to Close up the meta box declaration
    */

    //Finish Meta Box Decleration
    $my_meta->Finish();
}
