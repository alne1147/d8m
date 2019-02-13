#!/usr/bin/env bash

# D8M Install Local

drush site-install ci_start --account-name="ci-admin" --site-name="CI Drupal 8" -y
drush cset system.site uuid c7d57e0e-5172-4247-acff-130f37b56d47 -y;

drush role-create administrator  --y;
drush role-create support_administrator --y;
drush role-create content_administrator --y;
drush role-create structure_administrator --y;
drush role-create user_administrator --y;

drush   config-set system.site mail "no-reply@www.colorado.gov" -y

#// User additions and role assignments.

drush ucrt anevarez --mail="alfredo.nevarez@www.colorado.gov" --password="9xzfbddmus" --y;

drush ucrt blawson --mail="blawson@www.colorado.gov" --password="9xzfbddmus" --y;

drush ucrt supportadmin --mail="supportadmin@example.com" --password="9xzfbddmus" --y;

drush ucrt contentadmin --mail="contentadmin@example.com" --password="9xzfbddmus" --y;

drush ucrt useradmin --mail="userad@example.com" --password="9xzfbddmus" --y;

drush ucrt structureadmin --mail="structure@example.com" --password="9xzfbddmus" --y;

drush ucrt rchung --mail="richard.chung@egov.com" --password="9xzfbddmus" --y;

drush ucrt aturner --mail="ashley.turner@egov.com" --password="9xzfbddmus" --y;

drush ucrt amarshall --mail="amanda.marshall@www.colorado.gov" --password="9xzfbddmus" --y;

drush user-add-role administrator amarshall --y;
drush user-add-role administrator rchung --y;
drush user-add-role administrator aturner	--y;
drush user-add-role administrator nevarez --y;
drush user-add-role administrator blawson --y;
drush user-add-role support_administrator twhatley --y;
drush user-add-role support_administrator supportadmin --y;
drush user-add-role content_administrator contentadmin --y;
drush user-add-role user_administrator useradmin --y;
drush user-add-role structure_administrator structureadmin --y;

drush -y user-unblock --name= structureadmin,useradmin,contentadmin,supportadmin,twhatley,blawson,nevarez,amarshall;

drush en ci_article_setup -y;
drush en ci_media_types -y;
drush en ci_admin_tweaks -y;
drush en ci_theme_options -y;
drush en ci_views_tweaks -y;
drush en redirect -y;
drush -y config-set system.performance css.preprocess 0;
drush -y config-set system.performance js.preprocess 0;
drush en google_analytics -y;
drush cim --partial sync -y;
drush en default_content -y;
drush cr -y;
drush dcdi -y;
drush en yaml_content -y;
drush yaml-content-import-module ci_yaml_content;
drush cim --partial sole -y;
drush cim --partial post-sync -y;
drush en ci_layouts -y;
drush cr -y;
drush uli;

echo "That's the end of the D8M-install script!"