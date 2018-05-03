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

    Drupal.behaviors.SearchFieldProperties = {
        attach: function(context, settings) {
            $(document).ready(function(){

                $("button#edit-submit-acquia-search-fields").attr({
                    "name" : "submit"

                });

                $("input#edit-created-lt").attr({
                    "size" : 10,
                    "placeholder" : "End Date"
                });


                $("input#edit-created").attr({
                    "size" : 10,
                    "placeholder" : "Start Date"
                });

                $("input#edit-search").attr({

                    "placeholder" : "Search Here"
                });


            });

        }

    };


    Drupal.behaviors.ColumnBs = {
        attach: function(context, settings) {
            $(document).ready(function() {
                var $myDiv = $('.promoted-search .related-tags');

                if ( $myDiv.length){

                    $($myDiv).addClass("col-sm-3");
                    $($myDiv).prev().addClass("col-sm-9");

                }


            });

        }

    };

    Drupal.behaviors.SearchColumns = {
        attach: function(context, settings) {
            $(document).ready(function(){
                $('.promoted-search .related-tags').each(function(){
                    if($(this).hasClass('col-sm-3')) {
                        $(this).prev().addClass("col-sm-9");

                    }
                });

            });

        }

    };

    Drupal.behaviors.SearchAutoSubmit = {
        attach: function(context, settings) {
            $(document).ready(function() {
                $('#edit-type').on('change', function() {
                    var $form = $(this).closest('form');
                    $form.find('button[type=submit]').click();
                });

                $('#edit-items-per-page').on('change', function() {
                    var $form = $(this).closest('form');
                    $form.find('button[type=submit]').click();
                });

                $('#edit-field-article-tags').focusout( function() {
                    var $form = $(this).closest('form');
                    $form.find('button[type=submit]').click();
                });
            });

        }

    };

}(jQuery));