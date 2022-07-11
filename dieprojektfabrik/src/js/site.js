import $ from 'jquery';
import 'bootstrap';
import './../scss/style.scss';

$(document).ready(function ($) {
  /* cssonly carousel for portfolio items */

  $.fn.portfolioCarousel();
});

$.fn.portfolioCarousel = function () {
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
};
