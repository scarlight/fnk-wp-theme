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
        if(cs(".event-thumbnail").length > 0){
            cs(".event-thumbnail").carouFredSel({
                circular    : true,
                infinite    : true,
                responsive  : false,
                direction   : "left",
                width       : 690,
                height      : 51,
                align       : "center",
                padding     : 0,
                items       : {
                    visible : 8,
                    minimum : "",
                    start   : 0,
                    width   : "variable", //no jumps after each scroll completes
                    height  : 51
                },
                scroll      : {
                    items   : 1,
                    fx      : "linear",
                    easing  : "easeOutCubic",
                    duration: 3000,
                    pauseOnHover: false
                },
                auto        : {
                    play    : true,
                    duration: 700
                },
                prev        : {
                    button  : function(){
                        var prev = cs(this).parents("div.fnk-photo-gallery").find("div.navi-prev-next a.prev");
                        return prev;
                    },
                    duration: 700
                },
                next        : {
                    button  : function(){
                        var next = cs(this).parents("div.fnk-photo-gallery").find("div.navi-prev-next a.next");
                        return next;
                    },
                    duration: 700
                }
            });
        }
    });

});