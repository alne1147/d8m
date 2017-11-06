(function ($) {
    'use strict';

    Drupal.behaviors.dodatsss = {
        attach: function(context, settings) {
            $('div.layout-container').click(function() {
                alert("Your book is overdue.");
            });

        }
    };

}(jQuery));