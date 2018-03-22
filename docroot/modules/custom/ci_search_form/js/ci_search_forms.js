(function ($) {
    'use strict';

    Drupal.behaviors.SearchSizes = {
        attach: function(context, settings) {
            $(document).ready(function(){
                $(".advancedSearchTog").click(function(){
                    $("#advancedSearch").toggle("slow");
                });

            });

        }
    };

    Drupal.behaviors.SearchCalendar = {
        attach: function(context, settings) {
            $(document).ready(function(){

                $("#edit-created").datepicker();
                $("#edit-created-lt").datepicker();


            });

        }
    };

}(jQuery));

