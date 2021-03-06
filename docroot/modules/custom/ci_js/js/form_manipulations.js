// This is made first to limit entity references for menus. Permissions only allow menu link item control and menu block control. So we remove them.

(function ($) {
    'use strict';

    Drupal.behaviors.menuFieldRestrictions = {
        attach: function(context, settings) {





            $("#group-menus .form-select option[value='account']").remove();
            $("#group-menus .form-select option[value='admin']").remove();
            $("#group-menus .form-select option[value='custom-menu']").remove();
            $("#group-menus .form-select option[value='footer']").remove();
            $("#group-menus .form-select option[value='tools']").remove();
            $('select#edit-field-menu-reference-left').find('option[value=\'menu-10\']').appendTo('select#edit-field-menu-reference-left');
            $('select#edit-field-menu-reference-right').find('option[value=\'menu-10\']').appendTo('select#edit-field-menu-reference-right');

        }
    };

}(jQuery));