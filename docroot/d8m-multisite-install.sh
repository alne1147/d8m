#!/usr/bin/env bash

# D8M Install Local

drush @sites  site-install ci_start --account-name="ci-admin" --site-name="CI Drupal 8" -y

drush @sites role-create administrator &&
drush @sites role-create support_administrator &&
drush @sites role-create content_administrator &&
drush @sites role-create structure_administrator &&
drush @sites role-create user_administrator;

drush @sites   config-set system.site mail "no-reply@www.colorado.gov" -y

#// User additions and role assignments.

drush @sites ucrt ci-nevarez --mail="alfredo.nevarez@www.colorado.gov" --password="9xzfbddmus" --y;  
drush @sites user-add-role administrator ci-nevarez --y; 
drush @sites ucrt ci-jwathen --mail="jwathen@www.colorado.gov" --password="9xzfbddmus" --y;  
drush @sites user-add-role administrator ci-jwathen --y; 
drush @sites ucrt ci-blawson --mail="blawson@www.colorado.gov" --password="9xzfbddmus" --y;  
drush @sites user-add-role administrator ci-blawson --y; 
drush @sites ucrt ci-kharrison --mail="kristina.harrison@www.colorado.gov" --password="9xzfbddmus" --y;  
drush @sites user-add-role support_administrator ci-kharrison --y;  
drush @sites ucrt ci-twhatley --mail="travis.whatley@www.colorado.gov" --password="9xzfbddmus" --y;  
drush @sites user-add-role support_administrator ci-twhatley --y; 
drush @sites ucrt ci-supportadmin --mail="supportadmin@example.com" --password="9xzfbddmus" --y;  
drush @sites user-add-role support_administrator ci-supportadmin --y; 
drush @sites ucrt ci-contentadmin --mail="contentadmin@example.com" --password="9xzfbddmus" --y;  
drush @sites user-add-role content_administrator ci-contentadmin --y; 
drush @sites ucrt ci-useradmin --mail="userad@example.com" --password="9xzfbddmus" --y;  
drush @sites user-add-role user_administrator ci-useradmin --y; 
drush @sites ucrt ci-structureadmin --mail="structure@example.com" --password="9xzfbddmus" --y;  
drush @sites user-add-role structure_administrator ci-structureadmin --y; 
drush @sites ucrt ci-amarshall --mail="amanda.marshall@www.colorado.gov" --password="9xzfbddmus" --y;  
drush @sites user-add-role administrator ci-amarshall --y;


drush @sites  user-unblock --name= ci-jwathen,ci-structureadmin,ci-useradmin,ci-contentadmin,ci-supportadmin,ci-twhatley,ci-kharrison,ci-blawson,ci-nevarez,ci-amarshall;

drush @sites  en ci_article_setup --y;
drush @sites en ci_admin_tweaks --y;
rdush @sites en ci_theme_options --y;

drush @sites -y config-set system.performance css.preprocess 0;
drush @sites -y config-set system.performance js.preprocess 0;

drush @sites cim --partial sync --y;
drush @sites cr
drush @sites --y dcdi -1;
drush @sites uli;

echo "That's the end of the D8M install script!"