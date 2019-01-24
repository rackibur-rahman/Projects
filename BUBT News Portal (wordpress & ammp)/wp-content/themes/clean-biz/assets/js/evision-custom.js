// On Document Load
jQuery(window).load(function(){
    //site loader
    jQuery('#wraploader').hide(); 
    var enabledSlider = clean_biz_customizer_value['clean-biz-feature-slider-enable'];
    if ((jQuery('.home').length > 0) && (enabledSlider == 1) ){
        jQuery('.wrapper-site-identity').addClass('transparent-nav');
    }
    if (jQuery('.home.blog').length > 0){
        jQuery('.wrapper-site-identity').removeClass('transparent-nav');

    }

});
// On Document Ready
jQuery(document).ready(function ($) {

    // hoverdir
    jQuery(' #da-thumbs section > li ').each( function() { 
      $(this).hoverdir();
    });

    // Search
    var openBox = $('#search-bg');
    $('.search-holder .button-search').click(function(e){
      e.preventDefault();
      openBox.addClass('search-open');
      openBox.removeClass('screen-reader-text');
    });

    $('.button-search-close').click(function(e){
       e.preventDefault();
       openBox.removeClass('search-open');
       openBox.addClass('screen-reader-text');
    });

    $('#search-open-submit').click(function(){
      $('#search-target').submit();
    });

    /*wow jQuery*/
    wow = new WOW({
        boxClass: 'evision-animate'
      }
    )

    wow.init();

    // slick jQuery 
    jQuery('.carousel-group').slick({
      autoplay: true,
      autoplaySpeed: 3000,
      dots: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      lazyLoad: 'ondemand',
      responsive: [
         {
           breakpoint: 1024,
           settings: {
             slidesToShow: 3,
             slidesToScroll: 3,
             infinite: true,
             dots: true
           }
         },
         {
           breakpoint: 768,
           settings: {
             slidesToShow: 2,
             slidesToScroll: 2
           }
         },
         {
           breakpoint: 481,
           settings: {
             slidesToShow: 1,
             slidesToScroll: 1
           }
         }
         // You can unslick at a given breakpoint now by adding:
         // settings: "unslick"
         // instead of a settings object
       ]
    });

    // back to top animation

    $('#gotop').click(function(){
      $('html, body').animate({scrollTop: '0px'},1000);
    });

     jQuery('#go-bottom a').click(function(e){
       e.preventDefault();
        var target =  jQuery('#features').position().top;
        jQuery('body').animate({
          scrollTop : target - parseInt( jQuery('.wrapper-site-identity').height() ) 
        },500);

       }); 

    // header fix
       var fixedBackgroundColor       = '#2d2d2d',
          fixedBackgroundTransparent = 'transparent',
          selectedHeader             = jQuery('.wrapper-site-identity');
      
     
    jQuery(window).scroll(function() {    
        var scrollTopPosition = $(this).scrollTop();
        if ($('.home').length > 0) {
          if( scrollTopPosition > 100 ){
                selectedHeader.addClass('fixed-nav');
                selectedHeader.removeClass('transparent-nav');
          } else {
              var enabledSlider = clean_biz_customizer_value['clean-biz-feature-slider-enable'];
              if ((jQuery('.home').length > 0) && (enabledSlider == 1) ){
                  selectedHeader.addClass('transparent-nav');
              }
              if (jQuery('.home.blog').length > 0){
                  jQuery('.wrapper-site-identity').removeClass('transparent-nav');

              }
              selectedHeader.removeClass('fixed-nav');
          }
        }

        // back to top button visible on scroll
        if( scrollTopPosition > 240 ) {
          jQuery('#gotop').css({'bottom': 25});
        } else {
          jQuery('#gotop').css({'bottom': -100});
        }      

    });

   // add class for first section of body 
    $('body.home section:first').addClass('first-section');

    var hheight = selectedHeader.outerHeight(),
        bcumbheight = jQuery('#breadcrumb').outerHeight();

    function setTopPadding() {
      var hheight = selectedHeader.outerHeight(),
          bcumbheight = jQuery('#breadcrumb').outerHeight();

      jQuery('.wrap-breadcrumb').css({'top' : hheight});
       jQuery('body.logged-in .wrap-breadcrumb').css({'top' : hheight -32});
      if( jQuery(window).width() > 767) {
        if(jQuery('body').hasClass('home')){
           // if no any section are enable
          jQuery('body.home.blog #content').css({'padding-top' : hheight + bcumbheight + 30});
          // if slider section is not enable
          jQuery('body.home .first-section').css({'padding-top' : hheight});
          jQuery('body.home.logged-in .first-section').css({'padding-top' : hheight -32});
          // if slider section is enable
          jQuery('section.wrapper-slider-section.first-section').css({'padding-top' : '0'});
          //if blog page is home page 
          jQuery('body.home.blog .first-section').css({'padding-top' : '0'});
        } else{
          jQuery('#content').css({'padding-top' : hheight + bcumbheight + 30});
        }
      }
    }

    setTopPadding();

    jQuery(window).resize(setTopPadding);
});


/* mobile menu */ 
+(function($){

  $(document).ready(function(){
    mobileMenu();
    addMargin();
  });
  $(window).resize(addMargin);

  function mobileMenu(){
      console.log('function called');
     $('#sec-menu-toggle').click(function(){  
        $('body').addClass('nav-open');
        $('body').removeClass('nav-close');
        $('#sec-site-header-menu').addClass('open');
      });

      $('#mobile-menu-toggle-close').click(function(){
        if( $('body').hasClass('nav-open') ) {
          $('body').removeClass('nav-open');
          $('body').addClass('nav-close');
        }

        if( $('#sec-site-header-menu').hasClass('open') ) {
          $('#sec-site-header-menu').removeClass('open');
        }
      });
  }

  function addMargin(){
      var windowWidth = jQuery(window).width();
      if(  windowWidth > 767 && (jQuery('.page-template-front-pages').length > 0) ){ 
        var headerHight = $('.wrapper-site-identity').outerHeight(); 
        if (jQuery('#wpadminbar').length > 0) {
          var headerHight = headerHight - 33;
        } 
        var breadcrumHight = $('#breadcrumb').outerHeight(); 
          if (jQuery('#breadcrumb').length > 0){
            $('#breadcrumb').css({ 'marginTop': '0'} ); 
          }
          else{
            $('#content').css({ 'marginTop': headerHight } ); 
             $('body.home #content').css({ 'marginTop': '0' } );
          }
        }else{
           if (jQuery('#breadcrumb').length > 0){
               $('#breadcrumb').css('marginTop', '0'); 
           }
        }
      }

})(jQuery)
  