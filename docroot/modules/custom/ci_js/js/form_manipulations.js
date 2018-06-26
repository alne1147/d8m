// This is made first to limit entity references for menus. Permissions only allow menu link item control and menu block control. So we remove them.

(function ($) {
    'use strict';

    Drupal.behaviors.menuFieldRestrictions = {
        attach: function(context, settings) {

            $(".form-select option[value='account']").remove();
            $(".form-select option[value='admin']").remove();
            $(".form-select option[value='custom-menu']").remove();
            $(".form-select option[value='main']").remove();
            $(".form-select option[value='footer']").remove();
            $(".form-select option[value='tools']").remove();
            

        }
    };

}(jQuery));