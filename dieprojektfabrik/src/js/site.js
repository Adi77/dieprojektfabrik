import $, { css } from 'jquery';
//import 'bootstrap';

// import 'bootstrap/js/dist/alert';
import 'bootstrap/js/dist/button';
//import 'bootstrap/js/dist/carousel';
import 'bootstrap/js/dist/collapse';
// import 'bootstrap/js/dist/dropdown';
import 'bootstrap/js/dist/modal';
// import 'bootstrap/js/dist/popover';
// import 'bootstrap/js/dist/scrollspy';
// import 'bootstrap/js/dist/tab';
// import 'bootstrap/js/dist/toast';
// import 'bootstrap/js/dist/tooltip';

import '../scss/style.scss';

$(document).ready(function ($) {
  $('.navbar-toggler').on('click', function (e) {
    $('body').toggleClass('navi-open');
    if ($('.btn.btn-outline-light.navbar-metanav').css('display') == 'none') {
      /* to close nav */
      $('header').removeAttr('style');
      $('.btn.btn-outline-light.navbar-metanav').show();
      $('.shrink .navbar').css('background-color', 'white');
      $('html, body').removeAttr('style');

      window.setTimeout(function () {
        $('.navbar-dark').removeClass('blackBg');
      }, 300);
    } else {
      /* to open nav */
      $('.btn.btn-outline-light.navbar-metanav').hide();
      $('.shrink .navbar').css('background-color', 'transparent');
      $('html, body').css('overflow', 'hidden');

      window.setTimeout(function () {
        $('.navbar-dark').addClass('blackBg');
      }, 300);
    }
    if ($('.shrink').length != 0) {
      window.setTimeout(function () {
        $('.navbar-brand').toggleClass('light');
      }, 100);
    }
  });
  /* make click available on whole teaser stripe */
  $(
    '.teaser-stripe, .teaser-stripe-title-text-with-hover:not(.no-links) .uagb-section__inner-wrap .wp-block-group, .wp-block-cover'
  ).on('click', function (e) {
    if ($(this).find('a').attr('href').length != 0) {
      window.location.href = $(this).find('a').attr('href');
      $(this).css('cursor', 'pointer');
    }

    return false;
  });

  $('.wp-block-cover').on('mouseenter', function (e) {
    if ($(this).find('a').length) {
      if ($(this).find('a').attr('href').length != 0) {
        $(this).css('cursor', 'pointer');
      }
    }
  });

  /* cssonly carousel for portfolio items */
  //$.fn.portfolioCarousel();

  /*
   * case or blog detail page - get intro text height
   */
  //var x = window.matchMedia('(max-width: 991px)');
  //if (x.matches) {
  /*     let introTextEl = $(
      '.header-2col-text-background-image .uagb-section__inner-wrap .wp-block-columns .wp-block-column '
    );
    let introTextElHeight = introTextEl.height();

    $('.header-2col-text-background-image').css({
      'background-position': 'center ' + 124 + '%',
      'padding-bottom': +introTextElHeight + 'px',
    }); */
  /*     let image_url = $('.header-2col-text-background-image').css(
        'background-image'
      ),
      image;

    // Remove url() or in case of Chrome url("")
    image_url = image_url.match(/^url\("?(.+?)"?\)$/);

    if (image_url[1]) {
      image_url = image_url[1];
      image = new Image();

      // just in case it is not already loaded
      image.onload = function () {
        console.log(this.width + 'x' + this.height);
      };

      image.src = image_url;
    } */
  // }
});

/* cssonly carousel for portfolio items */
/* $.fn.portfolioCarousel = function () {
  $('.cases-slider .wp-block-post-template').each(function () {
    let portfolioItems = $(this).find('.type-case');
    let portfolioItemsId = [];
    let i = 0;
    portfolioItems.each(function () {
      i++;

      portfolioItemsId[i] =
        '<a class="dotNav" href=#' + $(this).attr('id') + '>dot' + i + '</a> ';
    });
    $(this).find('.wp-block-post-template').append(portfolioItemsId);
  });
}; */

// When the user scrolls down 100vh from the top of the document, shrink the navheader

$(document).on('scroll', function () {
  if ($('.navbar-collapse.show').length === 0) {
    if ($(document).scrollTop() > window.innerHeight - 100) {
      $('header').addClass('shrink');
      $('header .navbar-brand').addClass('light');
    } else {
      $('header .navbar-brand').removeClass('light');
      $('header').removeClass('shrink');
      $('.navbar').removeAttr('style');
      $('.btn.btn-outline-light.navbar-metanav').show();
    }
  }
});
