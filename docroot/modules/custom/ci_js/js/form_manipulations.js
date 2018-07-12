// This is made first to limit entity references for menus. Permissions only allow menu link item control and menu block control. So we remove them.

(function ($) {
    'use strict';

    Drupal.behaviors.menuFieldRestrictions = {
        attach: function(context, settings) {





            $(".form-select option[value='account']").remove();
            $(".form-select option[value='admin']").remove();
            $(".form-select option[value='custom-menu']").remove();
            $(".form-select option[value='footer']").remove();
            $(".form-select option[value='tools']").remove();
            $('select#edit-field-menu-reference-left').find('option[value=\'menu-10\']').appendTo('select#edit-field-menu-reference-left');
            $('select#edit-field-menu-reference-right').find('option[value=\'menu-10\']').appendTo('select#edit-field-menu-reference-right');


// Search form manipulations
          $('.search-page--refine-wrapper select#edit-type').append('<option value="All">All Others</option>');
          $(".search-page__list--type .form-select option[value='contact']").remove();
          $(".search-page__list--type .form-select option[value='landing_page']").remove();
          $(".search-page__list--type .form-select option[value='webform']").remove();
          $(".search-page__list--type .form-select option[value='page']").remove();
          $('select option:contains("Article")').text('Articles');
          $('select option:contains("Event")').text('Events');
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