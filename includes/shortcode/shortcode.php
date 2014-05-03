<?php
/*
*
* Add tittle with line decoration
* [fnk_title line="short" english="Welcome to Our Website"]欢迎来到我们的网站[/fnk_title]
* [fnk_title line="short"]欢迎来到我们的网站[/fnk_title]
* [fnk_title]欢迎来到我们的网站[/fnk_title]
*
*/
function fnk_title_shortcode($atts, $content){
    $atts = shortcode_atts(
        array(
            'line' => "",
            'english' => "",
            'content' => !empty($content) ? $content : NULL
        ), $atts
    );

    extract($atts);

    $css_class = (!empty($line)) && ($line == "short") ? "title-short" : "title";
    $en_text = !empty($english) ? $english : "";

    return '<h3 class="' . $css_class . '"><span class="zh">' . $content . ' </span>' . $en_text . '<span class="divide"><span class="cube"></span></span></h3>';
}
add_shortcode('fnk_title', 'fnk_title_shortcode');

/*
*
* Create donation table
* [fnk_donation_table]
* [fnk_donation_row date="24/05/2014" name="some_name" amount="RM 10,000.00" by="cash"]
* [fnk_donation_row date="24/05/2014" name="some_name" amount="RM 10,000.00" by="cash"]
* [fnk_donation_row date="24/05/2014" name="some_name" amount="RM 10,000.00" by="cash"]
* [fnk_donation_row date="24/05/2014" name="some_name" amount="RM 10,000.00" by="cash"]
* [/fnk_donation_table]
*
*/
function fnk_donation_table_shortcode($atts, $content){
    $atts = shortcode_atts(
        array(
            'content' => !empty($content) ? $content : NULL
        ), $atts
    );

    extract($atts);

    if(!empty($content)){
        $table = '<table class="donation-table"><tbody>';
        $table.= '<tr>';
        $table.= '<th>No</th>';
        $table.= '<th>Date</th>';
        $table.= '<th>Name</th>';
        $table.= '<th>Amount</th>';
        $table.= '<th>Donation Type</th>';
        $table.= '</tr>';
        $table.= do_shortcode($content);
        $table.='</tbody></table>';

        return $table;
    }

    return "";
}
add_shortcode('fnk_donation_table', 'fnk_donation_table_shortcode');

/*
*
* Create donation table - row part
* [fnk_donation_row date="24/05/2014" name="some_name" amount="RM 10,000.00" by="cash"]
*
*/
function fnk_donation_row_shortcode($atts, $content){
    $atts = shortcode_atts(
        array(
            'date' => "-",
            'name' => "Anonymous",
            'amount' => "-",
            'by' => "-",
            'content' => !empty($content) ? $content : NULL
        ), $atts
    );

    extract($atts);

    $row = '<tr>';
    $row.= '<td class="donation-table-counter"></td>';
    $row.= '<td>'.$date.'</td>';
    $row.= '<td>'.$name.'</td>';
    $row.= '<td>'.$amount.'</td>';
    $row.= '<td>'.$by.'</td>';
    $row.= '</tr>';

    return $row;
}
add_shortcode('fnk_donation_row', 'fnk_donation_row_shortcode');

/*
*
* Content column to the left
* [fnk_left_box_image] content [/fnk_left_box_image]
*
*/
function fnk_left_box_image_shortcode($atts, $content){
    $atts = shortcode_atts(
        array(
            'content' => !empty($content) ? $content : NULL
        ), $atts
    );

    extract($atts);

    if(!empty($content)){
        return '<div class="left-box-image">'.do_shortcode($content).'</div>';
    }

    return "";
}
add_shortcode('fnk_left_box_image', 'fnk_left_box_image_shortcode');

/*
*
* Content column to the left
* [fnk_right_box_image] content [/fnk_right_box_image]
*
*/
function fnk_right_box_image_shortcode($atts, $content){
    $atts = shortcode_atts(
        array(
            'content' => !empty($content) ? $content : NULL
        ), $atts
    );

    extract($atts);

    if(!empty($content)){
        return '<div class="right-box-image">'.do_shortcode($content).'</div>';
    }

    return "";
}
add_shortcode('fnk_right_box_image', 'fnk_right_box_image_shortcode');

/*
*
* Content column to the left
* [fnk_left_box_text] content [/fnk_left_box_text]
*
*/
function fnk_left_box_text_shortcode($atts, $content){
    $atts = shortcode_atts(
        array(
            'content' => !empty($content) ? $content : NULL
        ), $atts
    );

    extract($atts);

    if(!empty($content)){
        return '<div class="left-box-text">'.do_shortcode($content).'</div>';
    }

    return "";
}
add_shortcode('fnk_left_box_text', 'fnk_left_box_text_shortcode');

/*
*
* Content column to the right
* [fnk_right_box_text] content [/fnk_right_box_text]
*
*/
function fnk_right_box_text_shortcode($atts, $content){
    $atts = shortcode_atts(
        array(
            'content' => !empty($content) ? $content : NULL
        ), $atts
    );

    extract($atts);

    if(!empty($content)){
        return '<div class="right-box-text">'.do_shortcode($content).'</div>';
    }

    return "";
}
add_shortcode('fnk_right_box_text', 'fnk_right_box_text_shortcode');

/*
*
* Rounded image 304 x 194
* [fnk_page_image id="999"]
*
*/
function fnk_post_image_shortcode($atts, $content){
    $atts = shortcode_atts(
        array(
            'id' => "",
            'content' => !empty($content) ? $content : NULL
        ), $atts
    );

    extract($atts);

    $image_tag = '<img class="round-corner-image" style="width:304px; height:194px; border:solid 1px #e7e4dd; ';
    $image_tag.= 'background: #FFFFFF url('.FNK_IMAGES.'/fnk-logo-no-photo.jpg) no-repeat center center scroll;" ';
    $image_tag.= 'src="'.FNK_IMAGES.'/space.gif" alt="">';

    if( !empty($id) && is_numeric($id) )
    {
        $image = wp_get_attachment_image_src( $id, 'featured-recent-news'); // use back "featured recent news" image size

        if( $image ) {
            // change above tag to this
            $image_tag = '<img class="round-corner-image" width="'.$image[1].'" ';
            $image_tag.= 'height="'.$image[2].'" ';
            $image_tag.= 'src="'.$image[0].'" alt="">';

            return $image_tag;
        }
        else {
            // just return the initial declared image tag
            return $image_tag;
        }
    }
    else {
        // just return the initial declared image tag
        return $image_tag;
    }
}
add_shortcode('fnk_post_image', 'fnk_post_image_shortcode');

/*
*
* A shortcode for fnk event carousel - the slider tag
* [md_slider]
* [md_img item="2231" title="KLIGP 2014" group="event2014"]
* [md_img item="2231" title="KLIGP 2014" group="event2014"]
* [md_img item="2231" title="KLIGP 2014" group="event2014"]
* [md_img item="2231" title="KLIGP 2014" group="event2014"]
* [md_img item="2231" title="KLIGP 2014" group="event2012"]
* [/md_slider]
*
* [md_slider]
* [md_img item="1310" title="KLIGP 2012" group="event2012"]
* [md_img item="1309" title="KLIGP 2012" group="event2012"]
* [md_img item="1308" title="KLIGP 2012" group="event2012"]
* [md_img item="1307" title="KLIGP 2012" group="event2012"]
* [md_img item="1310" title="KLIGP 2012" group="event2012"]
* [/md_slider]
*
*/
function fnk_slider_shortcode($atts, $content){
    $atts = shortcode_atts(
        array(
            'content' => !empty($content) ? $content : NULL
        ), $atts
    );

    extract($atts);

    if(!empty($content)){
        $concatenate  = '<div class="event-buttons"><a class="prev"></a><a class="next"></a></div>';
        $concatenate .= '<ul class="event-thumbnail">'.do_shortcode($content).'</ul>';
        return $concatenate;
    }

    return "";
}

/*
*
* A shortcode for fnk event carousel - the img tag
* [md_img item="1310" title="KLIGP 2012" group="event2012"]
*
*/
function fnk_slider_image_shortcode($atts, $content){
    $atts = shortcode_atts(
        array(
            'item' => 0,
            'title' => "",
            'group' => "",
            'content' => !empty($content) ? $content : NULL
        ), $atts
    );

    extract($atts);
    require_once('include/bfi_thumb/BFI_Thumb.php');

    $item = absint($item);
    if(isset($item) && !empty($item) ){
        $img_url = wp_get_attachment_image_src($item, "full");
        $params_thumbnail = array(
            'width' => 130,
            'height' => 100,
            'crop' => true
        );

        $img_url_thumbnail = bfi_thumb($img_url[0] , $params_thumbnail);

        if(isset($group) && !empty($group)){
            $group = "lightbox"."-".$group;
        }
        else{
            $group = "lightbox";
        }

        $concatenate  = '<li><a href="'.$img_url[0].'" title="'.$title.'" rel="'.$group.'">';
        $concatenate .= '<img alt="'.$title.'" src="'.$img_url_thumbnail.'"'.' width="'.$params_thumbnail['width'].'px" height="'.$params_thumbnail['height'].'px" />';
        $concatenate .= '</a></li>';

        return $concatenate;
    }

    return "";

}

/*
*
* Fix paragraph and break issue
*
*/
function fnk_shortcode_empty_paragraph_fix($content) /* Fixes shortcode using wpautop that inserts additional p and br tag. */
{
    // array of custom shortcodes requiring the fix
    $block = join("|",array('fnk_title','fnk_donation_table','fnk_donation_row','fnk_left_box_image','fnk_right_box_image','fnk_left_box_text', 'fnk_right_box_text', 'fnk_post_image'));

    // opening tag
    $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);

    // closing tag
    $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);

    return $rep;
}
add_filter('the_content', 'fnk_shortcode_empty_paragraph_fix'); /* Fixes shortcode using wpautop that inserts additional p and br tag. */ /*Please replace with your theme shortcode in the param */