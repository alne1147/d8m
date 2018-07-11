// This is made first to limit entity references for menus. Permissions only allow menu link item control and menu block control. So we remove them.

(function ($) {
    'use strict';

    Drupal.behaviors.menuFieldRestrictions = {
        attach: function(context, settings) {




            $('.search-page--refine-wrapper select#edit-type').append('<option value="All">All Others</option>');
            $(".form-select option[value='account']").remove();
            $(".form-select option[value='admin']").remove();
            $(".form-select option[value='custom-menu']").remove();
            $(".form-select option[value='footer']").remove();
            $(".form-select option[value='tools']").remove();
            $('select#edit-field-menu-reference-left').find('option[value=\'menu-10\']').appendTo('select#edit-field-menu-reference-left');
            $('select#edit-field-menu-reference-right').find('option[value=\'menu-10\']').appendTo('select#edit-field-menu-reference-right');

            var usedNames = {};
            $("select[name='type'] > option").each(function () {
                if(usedNames[this.text]) {
                    $(this).remove();
                } else {
                    usedNames[this.text] = this.value;
                }
            });

        }
    };

}(jQuery));