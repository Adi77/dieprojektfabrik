import $ from 'jquery';
import 'bootstrap';
import './../scss/style.scss';

$(document).ready(function ($) {
  $('.navbar-toggler').on('click', function (e) {
    if ($('.btn.btn-outline-light.navbar-metanav').css('display') == 'none') {
      if ($('.shrink').length === 0) {
        $('.btn.btn-outline-light.navbar-metanav').show();
      } else {
        $('.navbar-brand').toggleClass('light');

        /*   window.setTimeout(function () {
          $('.navbar-brand').toggleClass('light');
        }, 500); */
      }
    } else {
      $('.btn.btn-outline-light.navbar-metanav').hide();
    }
    //$('.btn.btn-outline-light.navbar-metanav').toggle();
  });
  /* make click available on whole teaser stripe */
  $('.teaser-stripe').on('click', function (e) {
    $(this).find('a')[0].click();
  });

  /* cssonly carousel for portfolio items */
  //$.fn.portfolioCarousel();
});

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

// When the user scrolls down 50px from the top of the document, resize the header's font size

$(document).on('scroll', function () {
  if ($(document).scrollTop() > window.innerHeight - 100) {
    $('header').addClass('shrink');
    $('header .navbar-brand').addClass('light');
  } else {
    $('header').removeClass('shrink');
    $('.btn.btn-outline-light.navbar-metanav').show();
  }
});
