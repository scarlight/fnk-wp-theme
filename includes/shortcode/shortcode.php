<?php
/*
*
* Add tittle with line decoration
*
*/
// [fnk_title line="short" english="Welcome to Our Website"]欢迎来到我们的网站[/fnk_title]
// [fnk_title line="short"]欢迎来到我们的网站[/fnk_title]
// [fnk_title]欢迎来到我们的网站[/fnk_title]
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
*
*/
// [fnk_donation_table]
// [fnk_donation_row date="24/05/2014" name="some_name" amount="RM 10,000.00" type="cash"]
// [fnk_donation_row date="24/05/2014" name="some_name" amount="RM 10,000.00" type="cash"]
// [fnk_donation_row date="24/05/2014" name="some_name" amount="RM 10,000.00" type="cash"]
// [fnk_donation_row date="24/05/2014" name="some_name" amount="RM 10,000.00" type="cash"]
// [/fnk_donation_table]
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
* Fix paragraph and break issue
*
*/
function fnk_shortcode_empty_paragraph_fix($content) /* Fixes shortcode using wpautop that inserts additional p and br tag. */
{
    // array of custom shortcodes requiring the fix
    $block = join("|",array('fnk_title','fnk_donation_table','fnk_donation_row'));

    // opening tag
    $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);

    // closing tag
    $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);

    return $rep;
}
add_filter('the_content', 'fnk_shortcode_empty_paragraph_fix'); /* Fixes shortcode using wpautop that inserts additional p and br tag. */ /*Please replace with your theme shortcode in the param */