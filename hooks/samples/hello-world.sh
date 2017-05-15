#!/bin/sh
#
# This sample Cloud Hook script just echos "Hello, Cloud!" to standard
# output. It will work in any hook directory.

echo "Hello, Cloud!"


#
# Cloud Hook: drush-cache-clear
#
# Run drush cache-clear all in the target environment. This script works as
# any Cloud hook.


# Map the script inputs to convenient names.
site=$1
target_env=$2
drush_alias=$site'.'$target_env

# Execute a standard drush command.
drush @$drush_alias st