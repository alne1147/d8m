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

}(jQuery));