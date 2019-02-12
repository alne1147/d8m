#!/usr/bin/env bash

# D8M Install Local

drush @sites site-install ci_start --account-name="ci-admin" --site-name="CI Drupal 8" -y
drush @sites cset system.site uuid c7d57e0e-5172-4247-acff-130f37b56d47 -y;


drush @sites role-create administrator  --y;
drush @sites role-create support_administrator --y;
drush @sites role-create content_administrator --y;
drush @sites role-create structure_administrator --y;
drush @sites role-create user_administrator --y;

drush @sites   config-set system.site mail "no-reply@www.colorado.gov" -y

#// User additions and role assignments.

drush @sites -y user-unblock --name= structureadmin,useradmin,contentadmin,supportadmin,blawson,anevarez,amarshall;

drush @sites  en ci_article_setup -y;
drush @sites  en ci_media_types -y;
drush @sites  en ci_admin_tweaks -y;
drush @sites  en ci_theme_options -y;
drush @sites  en ci_views_tweaks -y;
drush @sites  en redirect -y;
drush @sites  -y config-set system.performance css.preprocess 0;
drush @sites  -y config-set system.performance js.preprocess 0;
drush @sites  en google_analytics -y;
drush @sites  cim --partial sync -y;
drush @sites  en default_content -y;
drush @sites  cr -y;
drush @sites  dcdi -y;
drush @sites  en yaml_content -y;
drush @sites yaml-content-import-module ci_yaml_content -y;
drush @sites  cim --partial sole -y;
drush @sites  cim --partial post-sync -y;
drush @sites  en ci_layouts -y;
drush @sites  cr -y;
drush @sites uli;

echo "That's the end of the D8M install script!"