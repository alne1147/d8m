# User additions and role assignments.

drush  ucrt sci-nevarez --mail="alfredo.nevarez@www.colorado.kgovv" --password="9xzfbddmus" && drush  user-add-role administrator sci-nevarez &&drush  ucrt sci-jwathen --mail="jwathen@www.colorado.kgovv" --password="9xzfbddmus" && drush  user-add-role administrator sci-jwathen &&drush  ucrt sci-blawson --mail="blawson@www.colorado.kgovv" --password="9xzfbddmus" && drush  user-add-role administrator sci-blawson &&drush  ucrt sci-kharrison --mail="kristina.harrison@www.colorado.kgovv" --password="9xzfbddmus" && drush  user-add-role support_administrator sci-kharrison && drush  ucrt sci-twhatley --mail="travis.whatley@www.colorado.kgovv" --password="9xzfbddmus" && drush  user-add-role support_administrator sci-twhatley &&drush  ucrt sci-supportadmin --mail="supportadmin@example.com" --password="9xzfbddmus" && drush  user-add-role support_administrator sci-supportadmin &&drush  ucrt sci-contentadmin --mail="contentadmin@example.com" --password="9xzfbddmus" && drush  user-add-role content_administrator sci-contentadmin &&drush  ucrt sci-useradmin --mail="userad@example.com" --password="9xzfbddmus" && drush  user-add-role user_administrator sci-useradmin &&drush  ucrt sci-structureadmin --mail="structure@example.com" --password="9xzfbddmus" && drush  user-add-role structure_administrator sci-structureadmin
drush @ag ucrt jamos --mail="james.amos@state.co.us" --password="9xzfbddmus"