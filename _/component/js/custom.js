var cs = jQuery.noConflict();

cs(document).ready(function(){

    var doc = document.documentElement;
    doc.setAttribute('data-useragent', navigator.userAgent);
    // code goes here when document is ready

    cs("#fnk-nav-wrp .sf-menu").superfish({
        delay:         600,
        animation:     {height:'show'},
        speed:         'fast',
        cssArrows:     false
    }).supersubs({
        minWidth        : 12,
        maxWidth        : 25,
        extraWidth      : 1
    });

    cs('.recent-news').pajinate({
        items_per_page : 2,
        item_container_id : '.blog-item',
        nav_panel_id : '.page-navigation',
        nav_info_id: '.result-info',
        num_page_links_to_display: 2,
        nav_label_first : '&lt;&lt;',
        nav_label_prev : '&lt;',
        nav_label_next : '&gt;',
        nav_label_last : '&gt;&gt;',
    });

    if( cs("td.donation-table-counter").length > 0 )
    {
        cs("td.donation-table-counter").each(function(i,elem){
            cs(this).text(i+1);
        });
    }

    cs(window).load(function(){

    });

});