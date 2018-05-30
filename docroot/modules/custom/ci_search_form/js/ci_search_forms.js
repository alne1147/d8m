(function ($) {
        'use strict';

    Drupal.behaviors.SearchCalendarStyles = {
        attach: function(context, settings) {
            $("#edit-search").addClass( "input-lg" );
        }
    };

    // Search form Input overrides
    Drupal.behaviors.SearchFieldProperties = {
        attach: function(context, settings) {
            $(".search-page__button--submit button").text("");

            $("input#edit-created-lt").attr({
                "size" : 10,
                "placeholder" : "End Date"
            });

            $("input#edit-created").attr({
                "size" : 10,
                "placeholder" : "Start Date"
            });

            $(".search__form input#edit-search").attr({
                "placeholder" : "How can we help you?"
            });
        }
    };

// Bootstrap class additions for adding columns in search result rows.
    Drupal.behaviors.ColumnBs = {
        attach: function(context, settings) {
            // Promoted Search Item
            var $promoted = $('.search-page__result--promoted .search-result--content');
            $('.search-page__result--omitted .search-result--content').addClass("col-sm-12");
            if ($promoted) {
                $promoted.addClass("col-sm-9");
                $promoted.next().addClass("col-sm-3");
            }
            // Refine Search Results for Smartphone view
            var $refineresults = $('.search-page--refine-wrapper p');
            var $refineresultsrow = $('.search-page--refine-wrapper .row');
            if (window.innerWidth < 767) {
                $refineresultsrow.addClass("refine-results");
            } else {
                $refineresultsrow.removeClass("refine-results");
            }
            var $refineresultstoggle = $('.refine-results');
            $refineresults.off('click').click(function(){
                $refineresultstoggle.toggleClass("refine-results--open");
                $refineresultstoggle.slideToggle(300);
                if ($($refineresultstoggle).hasClass("refine-results--open")) {
                    $refineresults.addClass('refine-results--close-icon');
                    $(".refine-results").attr("aria-hidden", false);
                } else {
                    $refineresults.removeClass('refine-results--close-icon');
                    $(".refine-results").attr("aria-hidden", true);
                }
            });
        }
    };
    // Search Auto Submit functions
    Drupal.behaviors.SearchAutoSubmit = {
        attach: function(context, settings) {
            $('#edit-type').on('change', function() {
                var $form = $(this).closest('form');
                $form.find('button[type=submit]').click();
            });

            $('#edit-field-article-tags').focusout( function() {
                var $form = $(this).closest('form');
                $form.find('button[type=submit]').click();
            });
            // Date Range Refinement
            $('#submit-date-range').click(function(){
                var startDate = $('#edit-created').val();
                var endDate = $('#edit-created-lt').val();
                $("#views-exposed-form-acquia-search-fields-search-block").submit();
            });
        }

    };
}(jQuery));