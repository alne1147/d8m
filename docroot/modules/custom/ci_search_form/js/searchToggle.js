(function ($) {
    'use strict';
    Drupal.behaviors.SearchAdv = {
        attach: function(context, settings) {


            $( document ).ready(function() {
                $(".header__search").click(function(){
                    $("form.s").slideToggle();
                    $("input.sb").focus();
                });

                $('form.s').hover(
                    function () {
                        $(this).css({"background-color":"#EBEAEB"});
                    },
                    function () {
                        $(this).css({"background-color":"#F6F6F6"});
                    }
                );
            });



        }
    };
}(jQuery));