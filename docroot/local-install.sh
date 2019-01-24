#!/usr/bin/env bash

# D8M Install Local

drush site-install ci_start --account-name="ci-admin" --site-name="CI Drupal 8" -y;

drush config-set system.site mail "no-reply@www.colorado.gov" -y;
drush cset system.site uuid c7d57e0e-5172-4247-acff-130f37b56d47 -y;

drush role-create administrator -y;
drush role-create support_administrator -y;
drush role-create content_administrator -y;
drush role-create structure_administrator -y;
drush role-create user_administrator -y;


drush en ci_article_setup -y;
drush en ci_media_types -y;
drush en ci_admin_tweaks -y;
drush en ci_theme_options -y;
drush en ci_views_tweaks -y;
drush en acquia_connector -y;
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

echo "That's the end of the D8M install script!"