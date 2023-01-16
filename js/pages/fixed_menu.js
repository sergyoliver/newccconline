"use strict";
$(document).ready(function () {
    if($(window).width()>767){
        fixed_menu();
        $(window).on("scroll", function () {
            fixed_menu();
            if ($(this).scrollTop() > 50) {
                $('.fixedMenu_left #left').addClass('rightsidebar-without-nav');
            } else {
                $('.fixedMenu_left #left').removeClass('rightsidebar-without-nav');
            }

            if ($(this).scrollTop() > 50 && $(this).scrollTop() < 100) {
                $('.fixedMenu_left #left').addClass('rightsidebar-without-nav-small');
            } else {
                $('.fixedMenu_left #left').removeClass('rightsidebar-without-nav-small');
            }

        });
    }else{
        $(".menu_scroll").slimScroll({
            destroy: true,
            height: '100%'
        });
        $("#top,#left").removeClass("fixed");
        $("body").removeClass("fixedMenu_header");
    }
    function fixed_menu() {
        if($("#left").hasClass("rightsidebar-without-nav")){
            $(".menu_scroll").slimscroll({
                height: $(window).height(),
                size: '5px',
                opacity: 0.2
            });
        }else{
            $(".menu_scroll").slimscroll({
                height: $(window).height()-$("#top").height(),
                size: '5px',
                opacity: 0.2
            });
        }
    }
    $(window).on("resize",function () {
        fixed_menu();
    });
});
