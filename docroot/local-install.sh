#!/usr/bin/env bash

# D8M Install Local

drush site-install ci_start --account-name="ci-admin" --site-name="CI Drupal 8" -y

drush config-set system.site mail "no-reply@www.colorado.gov" -y

drush role-create administrator --y;
drush role-create support_administrator --y;
drush role-create content_administrator --y;
drush role-create structure_administrator --y;
drush role-create user_administrator --y;


drush en ci_article_setup -y;
drush en ci_media_types -y;


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
drush cr --y;

drush pm-uninstall ci_migrate -y;
drush cex sync -y;
rm /Users/alfredonevarez/Sites/coloradod8m/config/synchronize/sync/migrate_plus.migration.ci_*;
drush cim sync -y;
drush en ci_migrate -y;
drush cex sync -y;
drush mim ci_user;
drush mim ci_nodes;
drush sql-sync  @d8m.local @ceo.dev

echo "That's the end of the D8M install script!"