(function ($) {
    'use strict';
    Drupal.behaviors.SearchAdv = {
        attach: function(context, settings) {

            //Search Toggle
            $(".search").attr("aria-hidden", true);

            // Toggle Expansion
            $(".header__search").off('click').click(function(){
                $(".search").toggleClass("search--open");
                $(".search").slideToggle(300);
                if ($(".search").hasClass("search--open")) {
                    $(".search").attr("aria-hidden", false);
                } else {
                    $(".search").attr("aria-hidden", true);
                }
            });

            // Toggle Expansion
            $(".header__search").keydown( function (e) {
                // Enter and Space keys
                if (e.keyCode === 13 || e.keyCode === 32) {
                    $(".search").slideToggle(300);
                }
            });
            // $('form.s').hover(
            //     function () {
            //         $(this).css({"background-color":"#EBEAEB"});
            //     },
            //     function () {
            //         $(this).css({"background-color":"#F6F6F6"});
            //     }
            // );
        }
    };
}(jQuery));