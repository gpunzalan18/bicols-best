
/**
 * =========================
 * preloader code
 * =========================
 */
jQuery(window).on('load', function () {
  jQuery('.preloader').fadeOut('slow');
});
/**
 * =========================
 * preloader codes  end
 * =========================
 */


jQuery(function ($) {

  var nav_menu = $('.main-navigation ul.nav-menu');


  /**
   * =========================
   * Accessibility codes start
   * =========================
   */
  $(document).on('mousemove', 'body', function (e) {
    $(this).removeClass('keyboard-nav-on');
  });
  $(document).on('keydown', 'body', function (e) {
    if (e.which == 9) {
      $(this).addClass('keyboard-nav-on');
      $(nav_menu).removeAttr('style');
    }

    var searchForm = document.querySelectorAll("div.nav-account-section :focus").length;

    if ( 0 == searchForm ) {
      var searchContainer = $(document).find('.search-container-wrapper');
      $(searchContainer).find('button.search-toggle').removeClass('search-active');
      $(searchContainer).find('div.search-container').removeClass('is-open').removeAttr('style');
    }
  });
  /**
   * =========================
   * Accessibility codes end
   * =========================
   */



  /**
   * =========================
   * mobile navigation codes start
   * =========================
   */

  /* button for subm-menu (work only on mobile) */


  /* submenu toggle */
  $(document).on('click ', '.btn_submenu_dropdown', function () {
    $(this).toggleClass('active');
    $(this).parent().find('.sub-menu').first().slideToggle();
  });


  /* menu toggle */
  $(document).on('click ', '.menu-toggle', function () {
    // $('.main-navigation').addClass('toggled');
    // $(this).toggleClass('menu-toggle--active');
    // nav_menu.slideToggle();

    if (!$('body').hasClass('keyboard-nav-on')) {
      $('.main-navigation').addClass('toggled');
      $(this).toggleClass('menu-toggle--active');
      nav_menu.slideToggle();
    } else {
      $('.main-navigation').removeClass('toggled');
      $(this).removeClass('menu-toggle--active');
      $(nav_menu).removeAttr('style');
    }
  });

  /**
   * =========================
   * mobile navigation codes ended
   * =========================
   */
  /**
    * ============================
    * blog post masonry
    * ============================
    */
  function masonry(grid) {

    var grid = $(grid);

    var rowGap = parseInt(grid.css("grid-row-gap"));
    var rowHeight = (rowGap = isNaN(rowGap) ? 16 : rowGap <= 0 ? 1 : rowGap);

    grid.css("grid-auto-rows", rowHeight + "px");
    grid.css("grid-row-gap", rowGap + "px");

    grid.children().each(function () {
      $(this).css(
        "grid-row-end",
        "span " +
        (1 + Math.ceil((rowGap + innerContentHeight(this)) / (rowGap + rowHeight)))
      );
    });
  }


  function innerContentHeight(item) {
    var content = $(item).html();
    $(item).html("");
    var temp = $('<div style="padding:0;margin:0">');
    temp.html(content);
    $(item).append(temp);
    var itemHeight = temp.outerHeight();
    temp.remove();
    $(item).append(content);
    return itemHeight;
  }



  ["load", "resize"].forEach(function (event) {
    $(window).on(event, function () {
      masonry(".has-grid-type");
    });
  });
  /**
    * ============================
    * blog post masonry ended
    * ============================
    */

  /**
   * Init functions.
   */
  cuisine_hub_slick_slider();

  /**
   * Init wow library.
   */
  new WOW().init();


  /* remove button value */
  $(".search-widget .search-submit").val("");
  /* ------------------ */

  /**
   * search jquery
   */
  $(document).on('click', 'div.search-container-wrapper > button.search-toggle', function () {
    var searchContainer = $(this).parent().find('div.search-container');
    searchContainer.toggle('fast');
    searchContainer.toggleClass('is-open');
    $(this).toggleClass('search-active');
  });


  /**
   * It loads all the slick slider functions for frontpage.
   */
  function cuisine_hub_slick_slider() {
    $(".lazy").slick({
      lazyLoad: 'ondemand', // ondemand progressive anticipated
      infinite: true
    });


    $('.slider-nav').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      dots: false,
      arrows: false,
      infinite: false,
      centerMode: false,
      asNavFor: '.slider-for',
      centerMode: true,
      focusOnSelect: true,
      responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,

        }
      },
      {
        breakpoint: 700,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });

    $('.testimonial-slider-nav').slick({
      slidesToShow: 2,
      slidesToScroll: 1,
      dots: false,
      arrows: false,
      centerMode: true,
      asNavFor: '.testimonial-slider-for',
      centerMode: true,
      focusOnSelect: true
    });
    $('.testimonial-slider-for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      speed: 500,
      fade: false,
      asNavFor: '.testimonial-slider-nav'

    });

    $('.banner-slider-for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      asNavFor: '.slider-nav'

    });
    $('.blog-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 3,
      centerPadding: '40px',
      slidesToScroll: 1,
      responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true,
          dots: false
        }
      },
      {
        breakpoint: 700,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
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

  }

  //scroll up btn
  var scroll = $(window).scrollTop();
  var $scroll_btn = $('#btn-scrollup');
  var $scroll_obj = $('.scrollup');
  $(window).on('scroll', function () {
    if ($(this).scrollTop() > 1) {
      $scroll_btn.css({ bottom: "25px" });
    }
    else {
      $scroll_btn.css({ bottom: "-100px" });
    }
  });
  $scroll_obj.click(function () {
    $('html, body').animate({ scrollTop: '0px' }, 800);
    return false;
  });


});

