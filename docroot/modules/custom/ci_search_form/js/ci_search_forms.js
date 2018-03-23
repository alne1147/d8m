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
                $("#edit-search").addClass( "col-md-10" );
                $(".form-item-search js-form-item-search form-group").addClass( "row" );



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
                    // "size" : 10,
                    "placeholder" : "Search The Government"
                });

            });

        }

    };

}(jQuery));

