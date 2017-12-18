#!/usr/bin/env bash

# D8M Install Local

drush @sites site-install ci_start --account-name="ci-admin" --site-name="CI Drupal 8" -y

drush @sites role-create administrator &&
drush @sites role-create support_administrator &&
drush @sites role-create content_administrator &&
drush @sites role-create structure_administrator &&
drush @sites role-create user_administrator;

drush @sites  config-set system.site mail "no-reply@www.colorado.gov" -y

drush @sites en -y $(cat custom_modules_list.txt)

drush @sites en ci_blocks -y


#// User additions and role assignments.

drush @sites ucrt ci-nevarez --mail="alfredo.nevarez@www.colorado.gov" --password="9xzfbddmus" && drush @sites  user-add-role administrator ci-nevarez &&drush @sites ucrt ci-jwathen --mail="jwathen@www.colorado.gov" --password="9xzfbddmus" && drush @sites user-add-role administrator ci-jwathen &&drush @sites    ucrt ci-blawson --mail="blawson@www.colorado.gov" --password="9xzfbddmus" && drush @sites user-add-role administrator ci-blawson &&drush @sites ucrt ci-kharrison --mail="kristina.harrison@www.colorado.gov" --password="9xzfbddmus" && drush @sites user-add-role support_administrator ci-kharrison && drush @sites ucrt ci-twhatley --mail="travis.whatley@www.colorado.gov" --password="9xzfbddmus" && drush @sites user-add-role support_administrator ci-twhatley &&drush @sites ucrt ci-supportadmin --mail="supportadmin@example.com" --password="9xzfbddmus" && drush @sites user-add-role support_administrator ci-supportadmin &&drush @sites ucrt ci-contentadmin --mail="contentadmin@example.com" --password="9xzfbddmus" && drush @sites user-add-role content_administrator ci-contentadmin &&drush @sites ucrt ci-useradmin --mail="userad@example.com" --password="9xzfbddmus" && drush @sites user-add-role user_administrator ci-useradmin &&drush @sites ucrt ci-structureadmin --mail="structure@example.com" --password="9xzfbddmus" && drush @sites user-add-role structure_administrator ci-structureadmin;


drush @sites user-unblock --name= ci-jwathen,ci-structureadmin,ci-useradmin,ci-contentadmin,ci-supportadmin,ci-twhatley,ci-kharrison,ci-blawson,ci-nevarez;

drush @sites cr -y

#// Revert Features
drush @sites features-import-all -y

drush @sites en ci_article_setup -y


drush @sites php-eval 'node_access_rebuild()'

#*For Bootstrap Module loading errors:* The following module is missing from the file system: webform_bootstrap_test_theme bootstrap.inc:250
drush @sites sql-query "DELETE FROM key_value WHERE collection='system.schema' AND name='webform_bootstrap_test_theme';"

drush @sites -y config-set system.performance css.preprocess 0
drush @sites -y config-set system.performance js.preprocess 0

echo "

//////// FINAL STEP! ////////

MUST BE DONE FROM LOCAL - Drush Aliases must be up to date!

- Import a partial config for permission validation.

drush @ag.dev cim  --partial; drush @cdle.dev cim --partial;drush @cdps.dev cim --partial;drush @ci.dev cim --partial;drush @dola.dev cim --partial;drush @dora.dev cim --partial;drush @dpa.dev cim --partial;drush @estes.dev cim --partial;drush @hcpf.dev cim --partial;drush @revenue.dev cim --partial;drush @sipa.dev cim --partial;drush @slb.dev cim --partial;drush @cdphe.dev cim --partial;

drush @sites -y dcdi -1