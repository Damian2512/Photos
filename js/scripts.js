//jQuery code
jQuery(function($) {
	"use strict";

    if($(".menu-icon").length){
        $('.menu-icon').on('click', function(){
            $('.nav').slideToggle(300);
            return false;
        });
    }

    if($(".close-filter").length){
        $('.close-filter').on('click', function(){
            $('.gallery-filters').slideToggle(300);
            $('.show-filter').show(300).on('click' , function(){
                $('.gallery-filters').show(300);
                $(this).hide(300);
            })
            return false;
        });
    }
    if($(".video-box").length){
        $('.video-box').on('click', function(){
            $('.popup').fadeIn(300);
        });
        $('.exit').on('click', function(){
            $('.popup').fadeOut(300);
            return false;
        });
    }


	$(".gallery-item, .gallery-item-second, .gallery-item-three").each( function() { $(this).hoverdir(); } );
	/* end gallery hover effect */

    if($(".accrodion__container").length){
        $(".accrodion__container").accordion({
            collapsible: true
        });
    }
    /* end accordion */

    if($(".tabs").length){
        $(".tabs").tabs({
            collapsible: true
        });
    }
    /* end tabs */

    if($('.wrap-slider').length){
        $('.wrap-slider').flexslider({
            mode: 'fade',
            controlNav: false,
            directionNav: true,
            auto: true
        });
    }

    if($('.people-slider').length){
        $('.people-slider').flexslider({
            mode: 'fade',
            controlNav: false,
            directionNav: true
        });
    }

    if($('.bx-wrapper').length){
        $('.bx-wrapper').flexslider({
            mode: 'fade',
            controlNav: "thumbnails",
            directionNav: true
        });
    }

    if($('.gallery-i').length){
        $('.gallery-i').flexslider({
            mode: 'fade',
            controlNav: false,
            directionNav: true
        });
    }

    if($('.gallery-slider').length){
        $('.gallery-slider').flexslider({
            mode: 'fade',
            directionNav: true,
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            pausePlay: true,
            pauseText: 'Pause',
            playText: 'Play',
            sync: "carousel",
            start: function(){
                $('.home-slider .gallery-slider').fadeIn(1500);
                $('.home-slider .gallery-slider .text').removeClass('slideUp');
                $('.home-slider .gallery-slider li:first .text').addClass('slideUp');

                if($(window).innerWidth() > 1007){
                    var top_height = ($('.home-slider').height() - 120 - $('.home-slider .gallery-slider').height())/2;
                    $('.home-slider .gallery-slider').css('margin-top',top_height);
                } else {
                    $('.home-slider .gallery-slider').css('margin-top','0');
                }

                $(window).resize(function(){
                    if($(window).innerWidth() > 1007){
                        var top_height = ($('.home-slider').height() - 120 - $('.home-slider .gallery-slider').height())/2;
                        $('.home-slider .gallery-slider').css('margin-top',top_height);
                    } else {
                        $('.home-slider .gallery-slider').css('margin-top','0');
                    }
                });
            },
            after: function(){
                $('.home-slider .gallery-slider .text').removeClass('slideUp');
                $('.home-slider .gallery-slider .flex-active-slide .text').addClass('slideUp');
            }
        });
    }

    if($('.carousel').length){
        $('.carousel').flexslider({
            animation: "slide",
            controlNav: false,
            directionNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 192,
            asNavFor: '.gallery-slider'
        });
    }
    /* end slider */

    if($("input:radio").length || $("input:checkbox").length){
        $("input").iCheck({
            checkboxClass: 'checkbox-btn',
            radioClass: 'radio-btn'
        });
    }
    /* end checkbox / redio */

});


$(window).load(function(){
    if($('.gallery-items').length){
        var $container = $('.gallery-items').isotope({
            singleMode: true,
            columnWidth: ".grid-sizer,.grid-sizer-second,.grid-sizer-three",
            itemSelector: ".gallery-item, .gallery-item-second, .gallery-item-three"
        });

        $('.gallery-filters').on( 'click', 'a', function() {
            var filterValue = $(this).attr('data-filter');
            $container.isotope({ filter: filterValue });

            $('.gallery-filters a').removeClass('gallery-filter_active');
            $(this).addClass('gallery-filter_active');
        });
    }

})