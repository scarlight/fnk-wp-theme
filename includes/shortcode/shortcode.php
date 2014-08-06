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
* Create donator list table
* [fnk_donator_list_table]
* [fnk_donator_list date="9-Jan" receipt="CASH" name="何亚财" amount="1000.00" ref="MONTHLY(1'2014)"]
* [fnk_donator_list date="9-Jan" receipt="CASH" name="何亚财" amount="1000.00" ref="MONTHLY(1'2014)"]
* [fnk_donator_list date="9-Jan" receipt="CASH" name="何亚财" amount="1000.00" ref="MONTHLY(1'2014)"]
* [fnk_donator_list date="9-Jan" receipt="CASH" name="何亚财" amount="1000.00" ref="MONTHLY(1'2014)"]
* [fnk_donator_list date="9-Jan" receipt="CASH" name="何亚财" amount="1000.00" ref="MONTHLY(1'2014)"]
* [/fnk_donator_list_table]
*
*/
function fnk_donator_list_table_shortcode($atts, $content){
    $atts = shortcode_atts(
        array(
            'content' => !empty($content) ? $content : NULL
        ), $atts
    );

    extract($atts);

    if(!empty($content)){
        $table = '<table class="donator-list"><tbody>';
        $table.= '<tr>';
        $table.= '<th>No</th>';
        $table.= '<th>Date</th>';
        $table.= '<th>Receipt No'.'.'.'</th>';
        $table.= '<th>Name</th>';
        $table.= '<th>Amount(RM)</th>';
        $table.= '<th>References</th>';
        $table.= '</tr>';
        $table.= do_shortcode($content);
        $table.='</tbody></table>';

        return $table;
    }

    return "";
}
add_shortcode('fnk_donator_list_table', 'fnk_donator_list_table_shortcode');

/*
*
* Create donator list table - row part
* [fnk_donator_list date="9-Jan" receipt="CASH" name="何亚财" amount="1000.00" ref="MONTHLY(1'2014)"]
*
*/
function fnk_donator_list_shortcode($atts, $content){
    $atts = shortcode_atts(
        array(
            'date' => "-",
            'receipt' => "-",
            'name' => "-",
            'amount' => "-",
            'ref' => "-",
            'content' => !empty($content) ? $content : NULL
        ), $atts
    );

    extract($atts);

    $row = '<tr>';
    $row.= '<td class="donator-list-counter"></td>';
    $row.= '<td>'.$date.'</td>';
    $row.= '<td>'.$receipt.'</td>';
    $row.= '<td>'.$name.'</td>';
    $row.= '<td>'.$amount.'</td>';
    $row.= '<td>'.$ref.'</td>';
    $row.= '</tr>';

    return $row;
}
add_shortcode('fnk_donator_list', 'fnk_donator_list_shortcode');

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
* A shortcode for fnk event carousel with caroufredsel wordpress plugin combined
* [fnk_slider_easy date="" title=""]
* [caroufredsel id="1488"]
* [/fnk_slider_easy]
*
*/
function fnk_slider_shortcode_combine($atts, $content){
    $atts = shortcode_atts(
        array(
            'date' => '',
            'title' => '',
            'content' => !empty($content) ? $content : NULL
        ), $atts
    );

    extract($atts);

    if(!empty($content)){

    $slider = '<div class="fnk-photo-gallery">';
    $slider.= '<h4 style="color:#606060; font-weight:900;">'.$date.' - '.$title.'</h4>';
    $slider.= do_shortcode($content);
    $slider.= '</div>';

    return $slider;
    }

    return "";
}
add_shortcode('fnk_slider_easy', 'fnk_slider_shortcode_combine');

/*
*
* A shortcode for fnk event carousel - the slider tag
* [fnk_slider date="" title=""]
* [fnk_img id="2231" title="Event 2014" group="event2014"]
* [fnk_img id="2231" title="Event 2014" group="event2014"]
* [fnk_img id="2231" title="Event 2014" group="event2014"]
* [fnk_img id="2231" title="Event 2014" group="event2014"]
* [fnk_img id="2231" title="Event 2014" group="event2012"]
* [/fnk_slider]
*
* [fnk_slider date="" title=""]
* [fnk_img id="1310" title="Event 2012" group="event2012"]
* [fnk_img id="1309" title="Event 2012" group="event2012"]
* [fnk_img id="1308" title="Event 2012" group="event2012"]
* [fnk_img id="1307" title="Event 2012" group="event2012"]
* [fnk_img id="1310" title="Event 2012" group="event2012"]
* [/fnk_slider]
*
*/
function fnk_slider_shortcode($atts, $content){
    $atts = shortcode_atts(
        array(
            'date' => '',
            'title' => '',
            'content' => !empty($content) ? $content : NULL
        ), $atts
    );

    extract($atts);

    if(!empty($content)){

    $slider = '<div class="fnk-photo-gallery">';
    $slider.= '<h4 style="color:#606060; font-weight:900;">'.$date.' - '.$title.'</h4>';
    $slider.= '<div class="navi-prev-next">';
    $slider.= '<a class="prev" href="#"></a>';
    $slider.= '<a class="next" href="#"></a>';
    $slider.= '</div>';
    $slider.= '<ul class="event-thumbnail">';
    $slider.= do_shortcode($content);
    $slider.= '</ul><div class="clear"></div></div>';

    return $slider;
    }

    return "";
}
add_shortcode('fnk_slider', 'fnk_slider_shortcode');

/*
*
* A shortcode for fnk event carousel - the img tag
* [fnk_img id="1310" title="KLIGP 2012" group="event2012"]
*
*/
function fnk_slider_image_shortcode($atts, $content){
    $atts = shortcode_atts(
        array(
            'id' => 0,
            'title' => "",
            'group' => "",
            'content' => !empty($content) ? $content : NULL
        ), $atts
    );

    extract($atts);

    if(isset($group) && !empty($group)){
        $group = "lightbox"."-".$group;
    }
    else{
        $group = "lightbox";
    }

    //$id = absint($id);
    if(isset($id) && !empty($id) ) {

        $img_large = wp_get_attachment_image_src($id, "event-gallery-photo");
        $img_thumb = wp_get_attachment_image_src($id, "event-gallery-thumb");

        if( !empty($img_thumb) ) {

            $concatenate  = '<li><a href="'.$img_large[0].'" title="'.$title.'" rel="'.$group.'">';
            if( empty($img_large) ){
                $concatenate  = '<li><a href="'.FNK_IMAGES.'/fnk-logo-no-photo-800-600.jpg" title="'.$title.'" rel="'.$group.'">';
            }
            $concatenate .= '<img alt="'.$title.'" src="'.$img_thumb[0].'"'.' width="'.$img_thumb[1].'" height="'.$img_thumb[2].'" />';
            $concatenate .= '</a></li>';

            return $concatenate;
        }
        else {

            $concatenate  = '<li><a href="'.FNK_IMAGES.'/fnk-logo-no-photo-800-600.jpg" title="'.$title.'" rel="'.$group.'">';
            $concatenate .= '<img alt="'.$title.'" src="'.FNK_IMAGES.'/no-photo-68.jpg"'.' width="68" height="49" />';
            $concatenate .= '</a></li>';

            return $concatenate;
        }
    }

    return "";
}
add_shortcode('fnk_img', 'fnk_slider_image_shortcode');

/*
*
* A shortcode for fnk recently donated information
* [fnk_list_info id="12" title="Important Subject"] -content- [fnk_list_info_detail name="name" telephone="012345678"][/fnk_list_info]
*
*/
function fnk_list_info_shortcode($atts, $content){
    $atts = shortcode_atts(
        array(
            'id' => 0,
            'title' => "",
            'content' => !empty($content) ? $content : NULL
        ), $atts
    );

    extract($atts);

    if( !empty($id) ) {
        $img = wp_get_attachment_image_src($id, "featured-detail");

        $image  = '<img class="left" src="'.$img[0].'"'.' width="'.$img[1].'" height="'.$img[2].'" alt="'.$title.'"/>';

        if( empty($img) ){
            $image  = '<img class="left" src="'.FNK_IMAGES.'/fnk-logo-no-photo-220-154.jpg" width="218" height="152" alt="'.$title.'"/>';
        }

        $layout = '<div class="blog-layout-single">';
        $layout.= $image;
        $layout.= '<p class="zh content-limiter">';
        $layout.= '<span class="title">'.$title.'</span><br>';
        $layout.= do_shortcode($content);
        $layout.= '</p>';
        $layout.= '<div class="clear"></div>';
        $layout.= '</div>';

        return $layout;
    }
    else
    {
        return "";
    }
}
add_shortcode('fnk_list_info', 'fnk_list_info_shortcode');

/*
*
* A shortcode for fnk recently donated info - the person detail
* [fnk_list_info_detail name="name" contact="012345678"]
*
*/
function fnk_list_info_detail_shortcode($atts, $content){
    $atts = shortcode_atts(
        array(
            'name'      => '',
            'telephone' => '',
            'content'   => !empty($content) ? $content : NULL
        ), $atts
    );

    extract($atts);

    if( !empty($name) ) {

        $telephone = !empty($telephone) ? ', Telephone: '.$telephone : "";
        $detail = '<br>';
        $detail.= '<span class="text-sm">';
        $detail.= 'Name: '.$name;
        $detail.= $telephone;
        $detail.= '</span>';

        return $detail;
    }
    else {
        return "";
    }
}
add_shortcode('fnk_list_info_detail', 'fnk_list_info_detail_shortcode');

/*
*
* Fix paragraph and break issue. Not using since this theme not using WPAUTOP
*
*/
function fnk_shortcode_empty_paragraph_fix($content) /* Fixes shortcode using wpautop that inserts additional p and br tag. */
{
    // array of custom shortcodes requiring the fix
    $block = join("|",array(
        'fnk_title',
        'fnk_donation_table',
        'fnk_donation_row',
        'fnk_donator_list_table',
        'fnk_donator_list',
        'fnk_left_box_image',
        'fnk_right_box_image',
        'fnk_left_box_text',
        'fnk_right_box_text',
        'fnk_post_image',
        'fnk_slider',
        'fnk_img',
        'fnk_list_info',
        'fnk_list_info_detail'
        )
    );

    // opening tag
    $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);

    // closing tag
    $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);

    return $rep;
}
add_filter('the_content', 'fnk_shortcode_empty_paragraph_fix'); /* Fixes shortcode using wpautop that inserts additional p and br tag. */