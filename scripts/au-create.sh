#!/usr/bin/env bash

drush ucrt ci-nevarez --mail="alfredo.nevarez@www.colorado.gov" --password="9xzfbddmus" --y;
drush ucrt ci-blawson --mail="blawson@www.colorado.gov" --password="9xzfbddmus" --y;
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
drush user-add-role administrator ci-blawson --y;
drush user-add-role administrator ci-nevarez --y;
drush user-add-role support_administrator ci-supportadmin --y;
drush user-add-role content_administrator ci-contentadmin --y;
drush user-add-role user_administrator ci-useradmin --y;
drush user-add-role structure_administrator ci-structureadmin --y;