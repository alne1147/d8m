#!/bin/sh
#
# This sample Cloud Hook script just echos "Hello, Cloud!" to standard
# output. It will work in any hook directory.
#
# This sample Cloud Hook script just echos "Hello, Cloud!" to standard
# output. It will work in any hook directory.


echo "Hello, Cloud!"

cd /var/www/html/coloradod8mdev/docroot
drush @sites updatedb --y
drush @sites cr --y