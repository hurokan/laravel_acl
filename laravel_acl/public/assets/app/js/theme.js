// -----------------------------

//   JS INDEX
/* =================== */
/*

    ## Animation Js
    ## Preloder
    ## Stiky menu
    ## Scrool Menu
    ## Scrool Up
    ## smart menu
    ## smoothscroll
    ## Owl Carousel
    ## Timer Js
    ## Googel Map
    ## Ajax
    ## Recaptcha

*/


(function($) {
  "use strict";


/*Animation js*/
AOS.init({

  offset:     120,

  delay:      0,

  easing:     'ease',

  duration:   5000,

  disable:    false, // Condition when AOS should be disabled. e.g. 'mobile'

  once:       false,

  mirror:     false, // whether elements should animate out while scrolling past them

  startEvent: 'DOMContentLoaded'

});



$(".down-arrow").click(function(){
  $(".custom-faq").toggleClass("hide",500);
});


//**================== Preloder========================*//
$(window).on('load', function() {
  $('#preloader').fadeOut('slow', function() { $(this).remove(); });
});

//**================= End of Preloder =====================**//






//**===================Scroll UP ===================**//

$(".card-optio1").on("click", function(){

  $('.a-card').toggleClass("viewCard");

});

$(".card-optio2").on("click", function(){

  $('.a-card2').toggleClass("viewCard");

});
$(".card-optio3").on("click", function(){

  $('.a-card3').toggleClass("viewCard");

});


$(".col-ver").on("click", function(){

  $('.color-version').toggleClass("viewCard");

});


//**===================Scroll UP ===================**//


//**================= Smart Menu =====================**//

// SmartMenus init
$(function() {
  $('#main-menu').smartmenus({
    subMenusSubOffsetX: 6,
    subMenusSubOffsetY: -8
  });
});

// SmartMenus mobile menu toggle button
$(function() {
  var $mainMenuState = $('#main-menu-state');
  if ($mainMenuState.length) {
    // animate mobile menu
    $mainMenuState.change(function(e) {
      var $menu = $('#main-menu');
      if (this.checked) {
        $menu.hide().slideDown(250, function() { $menu.css('display', ''); });
      } else {
        $menu.show().slideUp(250, function() { $menu.css('display', ''); });
      }
    });
    // hide mobile menu beforeunload
    $(window).bind('beforeunload unload', function() {
      if ($mainMenuState[0].checked) {
        $mainMenuState[0].click();
      }
    });
  }
});

//**================= End Smart Menu =====================**//


    /*---------------------
    smooth scroll
    --------------------- */
    $('.smoothscroll').on('click', function(e) {
      e.preventDefault();
      var target = this.hash;

      $('html, body').stop().animate({
          'scrollTop': $(target).offset().top - 150
      }, 3000);
  });


  /*---------------------


    /*================================

    Magnific Popup

    ==================================*/



if ($('.p-slider').length > 0) {

  $('.p-slider').owlCarousel({
    loop:true,
    margin:30,
    dots:false,
    nav:true,
    autoplay:false,
    navText:["<i class='flaticon-left-arrow-circular-button'></i>","<i class='flaticon-chevron-arrow-to-right'></i>"],
    autoplayTimeout:5000,
    smartSpeed:2000,
    responsive:{
        0:{
            items:1
        },
        450:{
            items:1
            },
        600:{
            items:2
            },
        1000:{
            items:4
        }
    }
  })
  }


if ($('.blog-slider').length > 0) {

  $('.blog-slider').owlCarousel({
    loop:true,
    margin:30,
    dots:false,
    nav:false,
    autoplay:true,
    autoplayTimeout:5000,
    smartSpeed:2000,
    responsive:{
        0:{
            items:1
        },
        450:{
            items:1
            },
        600:{
            items:2
            },
        1000:{
            items:3
        }
    }
  })
  }


/*================3D Slider===================*/

// Params
var sliderSelector = '.swiper-container',
    options = {
      init: false,
      loop: true,
      speed:800,
      slidesPerView: 2, // or 'auto'
      // spaceBetween: 10,
      centeredSlides : true,
      effect: 'coverflow', // 'cube', 'fade', 'coverflow',
      coverflowEffect: {
        rotate: 50, // Slide rotate in degrees
        stretch: 0, // Stretch space between slides (in px)
        depth: 100, // Depth offset in px (slides translate in Z axis)
        modifier: 1, // Effect multipler
        slideShadows : true, // Enables slides shadows
      },
      grabCursor: true,
      parallax: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        1023: {
          slidesPerView: 1,
          spaceBetween: 0
        }
      },
      // Events
      on: {
        imagesReady: function(){
          this.el.classList.remove('loading');
        }
      }
    };
var mySwiper = new Swiper(sliderSelector, options);

// Initialize slider
mySwiper.init();







}(jQuery));


