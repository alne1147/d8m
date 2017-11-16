#!/usr/bin/env bash

# D8M Install Local

drush site-install ci_start --account-name="ci-admin" --site-name="CI Drupal 8" -y

drush role-create administrator &&
drush role-create support_administrator &&
drush role-create content_administrator &&
drush role-create structure_administrator &&
drush role-create user_administrator;

drush  config-set system.site mail "no-reply@www.colorado.gov" -y

drush en -y $(cat custom_modules_list.txt)

drush en ci_blocks -y


#// User additions and role assignments.

drush ucrt ci-nevarez --mail="alfredo.nevarez@www.colorado.gov" --password="9xzfbddmus" && drush  user-add-role administrator ci-nevarez &&drush ucrt ci-jwathen --mail="jwathen@www.colorado.gov" --password="9xzfbddmus" && drush user-add-role administrator ci-jwathen &&drush    ucrt ci-blawson --mail="blawson@www.colorado.gov" --password="9xzfbddmus" && drush user-add-role administrator ci-blawson &&drush ucrt ci-kharrison --mail="kristina.harrison@www.colorado.gov" --password="9xzfbddmus" && drush user-add-role support_administrator ci-kharrison && drush ucrt ci-twhatley --mail="travis.whatley@www.colorado.gov" --password="9xzfbddmus" && drush user-add-role support_administrator ci-twhatley &&drush ucrt ci-supportadmin --mail="supportadmin@example.com" --password="9xzfbddmus" && drush user-add-role support_administrator ci-supportadmin &&drush ucrt ci-contentadmin --mail="contentadmin@example.com" --password="9xzfbddmus" && drush user-add-role content_administrator ci-contentadmin &&drush ucrt ci-useradmin --mail="userad@example.com" --password="9xzfbddmus" && drush user-add-role user_administrator ci-useradmin &&drush ucrt ci-structureadmin --mail="structure@example.com" --password="9xzfbddmus" && drush user-add-role structure_administrator;


drush user-unblock --name= ci-jwathen,ci-structureadmin,ci-useradmin,ci-contentadmin,ci-supportadmin,ci-twhatley,ci-kharrison,ci-blawson,ci-nevarez;

drush cr -y

#// Revert Features
drush features-import-all -y

drush en ci_article_setup -y


drush php-eval 'node_access_rebuild()'

#*For Bootstrap Module loading errors:* The following module is missing from the file system: webform_bootstrap_test_theme bootstrap.inc:250
drush sql-query "DELETE FROM key_value WHERE collection='system.schema' AND name='webform_bootstrap_test_theme';"

drush -y config-set system.performance css.preprocess 0
drush -y config-set system.performance js.preprocess 0

drush cim --partial -y
drush dcdiy -y
drush cr