drush ucrt anevarez --mail="alfredo.nevarez@www.colorado.gov" --password="9xzfbddmus" --y;
drush ucrt blawson --mail="blawson@www.colorado.gov" --password="9xzfbddmus" --y;
drush ucrt supportadmin --mail="supportadmin@example.com" --password="9xzfbddmus" --y;
drush ucrt contentadmin --mail="contentadmin@example.com" --password="9xzfbddmus" --y;
drush ucrt useradmin --mail="userad@example.com" --password="9xzfbddmus" --y;
drush ucrt structureadmin --mail="structure@example.com" --password="9xzfbddmus" --y;
drush ucrt amarshall --mail="amanda.marshall@www.colorado.gov" --password="9xzfbddmus" --y;
drush ucrt rchung --mail="richard.chung@egov.com" --password="9xzfbddmus" --y;
drush ucrt aturner --mail="ashley.turner@egov.com" --password="9xzfbddmus" --y;

drush -y user-unblock --name= structureadmin,useradmin,contentadmin,supportadmin,blawson,anevarez,amarshall;