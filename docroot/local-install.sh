#!/usr/bin/env bash

# D8M Install Local

drush site-install ci_start --account-name="ci-admin" --site-name="CI Drupal 8" -y

drush config-set system.site mail "no-reply@www.colorado.gov" -y

drush role-create administrator --y;
drush role-create support_administrator --y;
drush role-create content_administrator --y;
drush role-create structure_administrator --y;
drush role-create user_administrator --y;




 # //User additions and role assignments.
drush ucrt ci-nevarez --mail="alfredo.nevarez@www.colorado.gov" --password="9xzfbddmus" --y;

drush ucrt ci-blawson --mail="blawson@www.colorado.gov" --password="9xzfbddmus" --y;

drush ucrt ci-twhatley --mail="travis.whatley@www.colorado.gov" --password="9xzfbddmus" --y;

drush ucrt ci-supportadmin --mail="supportadmin@example.com" --password="9xzfbddmus" --y;

drush ucrt ci-contentadmin --mail="contentadmin@example.com" --password="9xzfbddmus" --y;

drush ucrt ci-useradmin --mail="userad@example.com" --password="9xzfbddmus" --y;

drush ucrt ci-structureadmin --mail="structure@example.com" --password="9xzfbddmus" --y;

drush ucrt ci-amarshall --mail="amanda.marshall@www.colorado.gov" --password="9xzfbddmus" --y;

drush ucrt ci-rchung --mail="richard.chung@egov.com" --password="9xzfbddmus" --y;

drush ucrt ci-aturner --mail="ashley.turner@egov.com" --password="9xzfbddmus" --y;

drush user-add-role administrator ci-amarshall --y;
drush user-add-role administrator ci-rchung --y;
drush user-add-role administrator ci-aturner	--y;
drush user-add-role administrator ci-nevarez --y;
drush user-add-role administrator ci-blawson --y;
drush user-add-role support_administrator ci-twhatley --y;
drush user-add-role support_administrator ci-supportadmin --y;
drush user-add-role content_administrator ci-contentadmin --y;
drush user-add-role user_administrator ci-useradmin --y;
drush user-add-role structure_administrator ci-structureadmin --y;


drush -y user-unblock --name= ci-structureadmin,ci-useradmin,ci-contentadmin,ci-supportadmin,ci-twhatley,ci-blawson,ci-nevarez,ci-amarshall;

drush en ci_article_setup -y;
drush en ci_media_types -y;

drush en ci_templates -y;
drush yaml-content-import-module ci_templates;
drush en ci_admin_tweaks --y;
drush en ci_theme_options --y;
drush en ci_views_tweaks --y;
drush en redirect --y;
drush -y config-set system.performance css.preprocess 0;
drush -y config-set system.performance js.preprocess 0;
drush en google_analytics --y;
drush cim --partial sync --y;
drush cr --y;
drush dcdi --y;
drush uli;
drush cim --partial sole --y;
drush cim --partial post-sync --y;
drush en menu_reference_render --y;
drush cr --y;

echo "That's the end of the D8M install script!"