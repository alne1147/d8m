(function ($) {
    'use strict';

    Drupal.behaviors.dodatsss = {
        attach: function(context, settings) {
            $("#edit-submit").click(function(){
                $("#edit-bg-image-url").val($('.file--mime-image-jpeg a').attr('href'));
            });

        }
    };

}(jQuery));