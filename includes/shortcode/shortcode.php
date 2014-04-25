<?php
/*
*
* Add tittle with line decoration
*
*/
// [fnk-title line="short" english="Welcome to Our Website"]欢迎来到我们的网站[/fnk-title]
// [fnk-title line="short"]欢迎来到我们的网站[/fnk-title]
// [fnk-title]欢迎来到我们的网站[/fnk-title]
function fnk_heading($atts, $content){
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
add_shortcode('fnk-title', 'fnk_heading');
