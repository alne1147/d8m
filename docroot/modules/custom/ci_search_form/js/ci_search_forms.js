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

    Drupal.behaviors.SearchCalendarStyles = {
        attach: function(context, settings) {
            $(document).ready(function(){

                $("#edit-created").datepicker().addClass( "col-md-1" );
                $("#edit-created-lt").datepicker().addClass( "col-md-1" );
                $("#edit-search").addClass( "input-lg" );



            });

        }

    };

    Drupal.behaviors.SearchFieldProperties = {
        attach: function(context, settings) {
            $(document).ready(function(){

                $("input#edit-created-lt").attr({
                    "size" : 10,
                    "placeholder" : "End Date"
                });

                $("input#edit-created").attr({
                    "size" : 10,
                    "placeholder" : "Start Date"
                });

                $("input#edit-search").attr({

                    "placeholder" : "Search The Government"
                });

            });

        }

    };

}(jQuery));

