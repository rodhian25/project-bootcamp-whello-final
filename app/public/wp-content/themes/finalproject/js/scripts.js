(function ($) {
    $(document).ready(function () {

    //event untuk button icon menu mobile
    $(".btn-toggle-state").on("click", function(){
      $('body').toggleClass('toggle-onactive');
    });



      var prevScroll = $(window).scrollTop();

      if (prevScroll === 0) {
        $('.site-header-main-navbar').css('display', 'none');
      }
      $(window).on('scroll', function() {
        var currentScroll = $(window).scrollTop();
        var topHeaderHeight = $('.site-top-header').outerHeight();
        if(prevScroll > currentScroll) {
          $('.site-header, .site-top-header').addClass('sticky-up');
          $('.site-header, .site-top-header').removeClass('sticky-down');
          $('.sticky-up .site-top-header').css('top', '0');
          $('.site-header.sticky-up').css('top', topHeaderHeight);
        } else {
          $('.site-header, .site-top-header').removeClass('sticky-up');
          $('.site-header, .site-top-header').addClass('sticky-down');
          $('.sticky-down .site-top-header').css('top', -topHeaderHeight);
          $('.site-header.sticky-down').css('top', '0');
        }
        prevScroll = currentScroll;
        if(currentScroll === 0) {
          $('.site-header-main-navbar').css('display', 'none');
        } else {
          $('.site-header-main-navbar').css('display', 'flex');
        }
      })
    });




    //slick js event to front page
    $('.listing-events').slick({
      slidesToShow: 3,
      slidesToScroll: 2,
      arrows: true,
      responsive: [
    {
      breakpoint: 1200,
      settings: {
        arrows: false,
        slidesToShow: 2,
      }
    },
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        slidesToShow: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        slidesToShow: 1
      }
    }
  ]
    });


    //slick js posts to front page
    $('.listing-posts').slick({
    slidesToShow: 4,
    slidesToScroll: 2,
    arrows: false,
      responsive: [
    {
      breakpoint: 1200,
      settings: {
        arrows: false,
        slidesToShow: 2
      }
    },
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        slidesToShow: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        slidesToShow: 1
      }
    }
  ]
  });
}) (jQuery);