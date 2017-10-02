/*
 * ---------------------------------------------------
 * 1. Slide Carousel
 * 2. Scroll to Top
 * 3. Sticky Menu
 * 4. Accordion has icon
 * 5. Hover tag a show ul page Product
 * 6. POPUP order a product - check on info Payment
 * 7. Scroll News Item Tablet & Mobile
 */

  (function($){
    "use strict";
  /* ==================================================== */

  /*
   * 1. Slide Carousel
  */
  $(document).ready(function() {
    $('.owl-carousel').each(function(index, el) {
      var config = $(this).data();
      config.navText = ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'];
      config.smartSpeed="800";
      
      if($(this).hasClass('owl-style2')){
        config.animateOut='fadeOut';
        config.animateIn='fadeIn';    
      }
      if($(this).hasClass('dotsData')){
        config.dotsData="true";
      }
      $(this).owlCarousel(config);
    });
  });

  /*
   * 2. Scroll to Top
  */
  $(window).scroll(function() {
    if ($(this).scrollTop() >= 200) {
      $('#return-to-top').addClass('td-scroll-up-visible');
    } else {
      $('#return-to-top').removeClass('td-scroll-up-visible');
    }
  });
  $('#return-to-top').click(function() {
    $('body,html').animate({
      scrollTop : 0
    }, 'slow');
  });

  /*
   * 3. Sticky Menu
  */
  $('.fixed').sticky({ topSpacing: 0 });

  /*
   * 7. Main Menu
  */
  $(".nav-toogle").on( 'click', function() {
    $(this).toggleClass('has-open');
    $(".menu").toggleClass("has-open");
    $("body").toggleClass("menu-open");
  });
  $(".btn-search-mb").on( 'click', function() {
    $(this).toggleClass('has-open');
    $(".nav-toogle").removeClass("has-open");
    $(".menu").removeClass("has-open");
    $("body").removeClass("menu-open");
    $(".block-search-mb").toggleClass("has-open");
  });

  /*
   * 7. Main Menu
  */
  $(document).ready(function(){
    $('.menu ul li.parent').append('<span class="plus"></span>');
    $('.menu ul li.parent .plus').click(function(){
      $(this).toggleClass('open').siblings('.submenu').slideToggle();
    });
  });

  //Hover Search Show Form
  // $('.search-icon').hover(function(){
  //   $('.top_search').addClass('hover');
  // });
  // $('.search-icon').click(function(){
  //   $('.top_search').removeClass('hover');
  // });
  // $('.menu').hover(function(){
  //   $('.top_search').removeClass('hover');
  // });
  // $(document).mouseup(function (e) {
  //   var container = $(".top_search");
  //   if (!container.is(e.target) // if the target of the click isn't the container...
  //     && container.has(e.target).length === 0) // ... nor a descendant of the container
  //   {
  //     $('.top_search').removeClass('hover');
  //   }
  // });


})(jQuery); // End of use strict