(function ($) {
    "use strict";
    jQuery(document).ready(function ($) {
        /*========== Responsive Menu  ==========*/
        $("#mobilemenu").slicknav({
            prependTo: '#responsive-menu1'
        });
        /*========== scroll to top  ==========*/
        $(window).on('scroll', function () {
            if ($(this).scrollTop() > 200) {
                $('.scroll-top').fadeIn(200);
            } else {
                $('.scroll-top').fadeOut(200);
            }
        });
        $('.scroll-top').on('click', function (event) {
            event.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 1000);
        });
        /*==========  menu scroll  ==========*/
        $('.menu-right li a').on('click', function (event) {
            $('.menu-right li a').parent().removeClass('active');
            var $anchor = $($(this).attr('href')).offset().top - 70;
            $(this).parent().addClass('active');
            $('body, html').animate({
                scrollTop: $anchor
            }, 800);
            event.preventDefault();
            return false;
        });
        /*==========  menu sticky  ==========*/
        $('.onepage-head').sticky({
            topSpacing: 0
        });
        /*==========  counterUp  ==========*/
        $('.counter1').counterUp({
            delay: 100,
            time: 3000
        });
        /*==========  isotop  ==========*/
        jQuery(window).on('load', function () {
            jQuery(".kedu-loader").fadeOut(500);
        });
    });
})(jQuery);