(function ($) {
    'use strict';

    // Search bar and Refine Results
    Drupal.behaviors.SearchFieldProperties = {
        attach: function (context, settings) {
            $(".search-page__button--submit button").text("");
            $(".search__form input#edit-search").attr("placeholder","How can we help you?");
            $("#edit-search").addClass("input-lg");
            $("#edit-created").attr("placeholder","Start Date");
            $("#edit-created-lt").attr("placeholder","End Date");
            $("#edit-created, #edit-created-lt").datepicker().attr({"autocomplete": "off", "size": "11"});
        }
    };
    // Bootstrap class additions for adding columns in search result rows.
    Drupal.behaviors.ColumnBs = {
        attach: function (context, settings) {
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
            $refineresults.off('click').click(function () {
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

}(jQuery));