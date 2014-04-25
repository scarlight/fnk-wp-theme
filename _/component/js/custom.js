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

    cs(window).load(function(){

        // code goes here when window has finish loading

    });

});