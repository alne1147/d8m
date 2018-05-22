(function ($) {
        'use strict';


    Drupal.behaviors.SearchCalendarStyles = {
        attach: function(context, settings) {
            $(document).ready(function(){

                $("#edit-created").datepicker().addClass( "col-md-1" );
                $("#edit-created-lt").datepicker().addClass( "col-md-1" );
                $("#edit-search").addClass( "input-lg" );

            });

        }

    };

    // Search form Input overrides
    Drupal.behaviors.SearchFieldProperties = {
        attach: function(context, settings) {
            $(document).ready(function(){

                $(".search-page__button--submit button").text("");

                $("input#edit-created-lt").attr({
                    "size" : 10,
                    "placeholder" : "End Date"
                });


                $("input#edit-created").attr({
                    "size" : 10,
                    "placeholder" : "Start Date"
                });

                $("input#edit-search").attr({
                    "placeholder" : "How can we help you?"
                });


            });

        }

    };

// Bootstrap class additions for adding columns in search result rows.
    Drupal.behaviors.ColumnBs = {
        attach: function(context, settings) {
            $(document).ready(function() {
                var promoted = $('.search-page__result--promoted .search-result--content');
                $('.search-page__result--omitted .search-result--content').addClass("col-sm-12");
                if (promoted) {
                    $(promoted).addClass("col-sm-9");
                    $(promoted).next().addClass("col-sm-3");
                }
            });
        }
    };

    // Drupal.behaviors.SearchColumns = {
    //     attach: function(context, settings) {
    //         $(document).ready(function(){
    //             $('.search-page__result--promote .search-result--tags').each(function(){
    //                 if($(this).hasClass('col-sm-3')) {
    //                     $(this).prev().addClass("col-sm-9");
    //
    //                 }
    //             });
    //
    //         });
    //
    //     }
    //
    // };

// Search Auto Submit functions
    Drupal.behaviors.SearchAutoSubmit = {
        attach: function(context, settings) {
            $(document).ready(function() {
                $('#edit-type').on('change', function() {
                    var $form = $(this).closest('form');
                    $form.find('button[type=submit]').click();
                });

                // $('#edit-items-per-page').on('change', function() {
                //     var $form = $(this).closest('form');
                //     $form.find('button[type=submit]').click();
                // });

                $('#edit-field-article-tags').focusout( function() {
                    var $form = $(this).closest('form');
                    $form.find('button[type=submit]').click();
                });
            });

        }

    };

}(jQuery));