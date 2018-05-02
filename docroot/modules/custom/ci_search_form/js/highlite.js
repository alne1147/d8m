
(function ($) {
    'use strict';

    Drupal.behaviors.AdvancedOpen = {
        attach: function(context, settings) {


            $(document).ready(function(){
                $('#edit-search').load('window', function(){
                    $('.view-content').highlight($(this).val());

                });
            });

        }
    };

}(jQuery));