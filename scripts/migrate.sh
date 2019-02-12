drush pm-uninstall ci_migrate -y;
drush cex sync -y;
rm /Users/alfredonevarez/Sites/coloradod8m/config/synchronize/sync/migrate_plus.migration.ci_*;
drush cim sync -y;
drush en ci_migrate -y;
drush cex sync -y;
drush mim ci_user;
drush mim ci_nodes;
echo "CI Migrate reset."