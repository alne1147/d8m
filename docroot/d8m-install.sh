#!/usr/bin/env bash

# D8M Install Local

drush site-install ci_start --account-name="ci-admin" --site-name="CI Drupal 8" -y

drush role-create administrator  --y;
drush role-create support_administrator --y;
drush role-create content_administrator --y;
drush role-create structure_administrator --y;
drush role-create user_administrator --y;

drush   config-set system.site mail "no-reply@www.colorado.gov" -y

#// User additions and role assignments.

drush ucrt ci-nevarez --mail="alfredo.nevarez@www.colorado.gov" --password="9xzfbddmus" --y;  
drush urol administrator ci-nevarez --y; 
drush ucrt ci-jwathen --mail="jwathen@www.colorado.gov" --password="9xzfbddmus" --y;  
drush urol administrator ci-jwathen --y; 
drush ucrt ci-blawson --mail="blawson@www.colorado.gov" --password="9xzfbddmus" --y;  
drush urol administrator ci-blawson --y; 
drush ucrt ci-kharrison --mail="kristina.harrison@www.colorado.gov" --password="9xzfbddmus" --y;  
drush urol support_administrator ci-kharrison --y;  
drush ucrt ci-twhatley --mail="travis.whatley@www.colorado.gov" --password="9xzfbddmus" --y;  
drush urol support_administrator ci-twhatley --y; 
drush ucrt ci-supportadmin --mail="supportadmin@example.com" --password="9xzfbddmus" --y;  
drush urol support_administrator ci-supportadmin --y; 
drush ucrt ci-contentadmin --mail="contentadmin@example.com" --password="9xzfbddmus" --y;  
drush urol content_administrator ci-contentadmin --y; 
drush ucrt ci-useradmin --mail="userad@example.com" --password="9xzfbddmus" --y;  
drush urol user_administrator ci-useradmin --y; 
drush ucrt ci-structureadmin --mail="structure@example.com" --password="9xzfbddmus" --y;  
drush urol structure_administrator ci-structureadmin --y; 
drush ucrt ci-amarshall --mail="amanda.marshall@www.colorado.gov" --password="9xzfbddmus" --y;  
drush urol administrator ci-amarshall --y;


drush -y user-unblock --name= ci-jwathen,ci-structureadmin,ci-useradmin,ci-contentadmin,ci-supportadmin,ci-twhatley,ci-kharrison,ci-blawson,ci-nevarez,ci-amarshall;

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
drush cim --partial sole --y;
drush cim --partial staging --y;
drush en memcache --y;


echo "That's the end of the D8M install script!"