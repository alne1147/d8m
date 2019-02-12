#!/usr/bin/env bash

while read ciusers; do
  drush ucrt $ciusers
done < ~/Sites/nexus/scripts/ci-users.txt