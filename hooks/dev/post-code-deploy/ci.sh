#!/bin/sh
#
# This sample Cloud Hook script just echos "Hello, Cloud!" to standard
# output. It will work in any hook directory.
#
# This sample Cloud Hook script just echos "Hello, Cloud!" to standard
# output. It will work in any hook directory.

site=$1
target_env=$2
drush_alias=$site'.'$target_env

# Execute a standard drush command.
drush @$site.$target_env -l www.pilot-stg.colorado.gov updatedb --yes


echo "Hello, Cloud!"

ls