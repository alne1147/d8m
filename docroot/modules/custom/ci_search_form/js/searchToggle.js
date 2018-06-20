(function ($) {
    'use strict';
    Drupal.behaviors.SearchAdv = {
        attach: function(context, settings) {

            $(".search").attr("aria-hidden", true);
            // Toggle Expansion
            $(".header__search").off('click').click(function(){

                $(".search").toggleClass("search--open");
                $(".search").slideToggle(300);

                if ($(".search").hasClass("search--open")) {
                    $(".header__search--icon").addClass("search--open");
                    $( "input#edit-search.search__form--input.input-lg").focus();

                    $(".search").attr("aria-hidden", false);
                } else {
                    $(".header__search--icon").removeClass("search--open");
                    $(".search").attr("aria-hidden", true);
                }
            });
            // Toggle Expansion with keyboards
            $(".header__search").keydown( function (e) {
                // Enter and Space keys
                if (e.keyCode === 13 || e.keyCode === 32) {
                    $(".search").slideToggle(300);
                }
            });
        }
    };
}(jQuery));