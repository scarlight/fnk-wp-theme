var cs = jQuery.noConflict();

cs(document).ready(function(){

    if(cs.browser.msie){
        cs("body").addClass("ie");
    }

    function slideSwitch() {
        var active = cs('#slideshow img.active');

        if ( active.length == 0 ) active = cs('#slideshow img:last');

        // use this to pull the images in the order they appear in the markup
        var next =  active.next().length ? active.next() : cs('#slideshow img:first');

        // uncomment the 3 lines below to pull the images in random order
        // var sibs  = active.siblings();
        // var rndNum = Math.floor(Math.random() * sibs.length );
        // var next  = cs( sibs[ rndNum ] );

        active.addClass('last-active');
        next.css({opacity: 0.0})
        .addClass('active')
        .animate({opacity: 1.0}, 1000, function() {
            active.removeClass('active last-active');
        });
    }

    cs(window).load(function(){
        setInterval(slideSwitch, 5000 );
    });

    var open = false;
    cs('#puremed-footer-clickreveal').click(function() {
        if(open === false) {
            cs(this).css('backgroundPosition', 'left bottom');
            cs('#puremed-footer').animate({
                height: '250px'
            },
            {
                duration:1000,
                easing:"easeOutQuart"
            });
            open = true;
        } else {
            cs(this).css('backgroundPosition', 'left top');
            cs('#puremed-footer').animate({
                height: '0px'
            },
            {
                duration:500,
                easing:"easeOutQuad"
            });
            open = false;
        }
    });

    //banner slider
    if(cs("#banner-slider").length > 0){
        var 
            slider = cs("#banner-slider"),
            paginate = cs("#banner-slider-paginate");

        slider.carouFredSel({
            responsive: false,
            circular: true,
            infinite: true,
            direction:"left",
            align:"center",
            padding: 0,
            scroll: {
                items: 1,
                fx: "uncover-fade",
                duration: 700,
                queue : false,
                pauseOnHover: false,
                easing:"quadratic"
            },
            auto: {
                fx: "uncover-fade",
                timeoutDuration: 5000,
                easing: "quadratic",
                pauseOnResize:true
            },
            width:"100%",
            height:286,
            items: {
                visible: 1,
                minimum: 1,
                start: 0,
                width:"100%",
                height:286
            },
            pagination: {
                container: paginate
            },
            prev:{
                button:cs("#banner-slider-prevnext a.prev")
            },
            next:{
                button:cs("#banner-slider-prevnext a.next")
            }
        },{wrapper:{classname:"puremed-slider-container"}});

        cs('#banner-slider-paginate a')
            .unbind('click')
            .bind('click', function(e) {
                e.preventDefault();
                slider.trigger("finish").trigger( 'slideTo', [cs(this).index(), true, 'next'] );
            }
        );

        cs('#banner-slider-prevnext a.prev')
            .unbind('click')
            .bind('click', function(e) {
                e.preventDefault();
                slider.trigger("finish").trigger('prev');
            }
        );

        cs('#banner-slider-prevnext a.next')
            .unbind('click')
            .bind('click', function(e) {
                e.preventDefault();
                slider.trigger("finish").trigger('next');
            }
        );
    }
});