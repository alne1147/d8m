#!/bin/sh
#
# This sample Cloud Hook script just echos "Hello, Cloud!" to standard
# output. It will work in any hook directory.
#
# This sample Cloud Hook script just echos "Hello, Cloud!" to standard
# output. It will work in any hook directory.


echo "Backing Up"

d=$(date +%Y-%m-%d)

drush @ag sql-dump --gzip --result-file=files/agGov-deploy-backup-$d.sql
drush @ag sql-dump --gzip --result-file=files/ag-deploy-backup-$d.sql
drush @cdle sql-dump --gzip --result-file=files/cdle-deploy-backup-$d.sql
drush @cdphe sql-dump --gzip --result-file=files/cdphe-deploy-backup-$d.sql
drush @cdps sql-dump --gzip --result-file=files/cdps-deploy-backup-$d.sql
drush @ci sql-dump --gzip --result-file=files/ci-deploy-backup-$d.sql
drush @dhsem sql-dump --gzip --result-file=files/dhsem-deploy-backup-$d.sql
drush @dola sql-dump --gzip --result-file=files/dola-deploy-backup-$d.sql
drush @dora sql-dump --gzip --result-file=files/dora-deploy-backup-$d.sql
drush @dpa sql-dump --gzip --result-file=files/dpa-deploy-backup-$d.sql
drush @estes sql-dump --gzip --result-file=files/estes-deploy-backup-$d.sql
drush @hcpf sql-dump --gzip --result-file=files/hcpf-deploy-backup-$d.sql
drush @revenue sql-dump --gzip --result-file=files/revenue-deploy-backup-$d.sql
drush @sipa sql-dump --gzip --result-file=files/sipa-deploy-backup-$d.sql
drush @slb sql-dump --gzip --result-file=files/slb-deploy-backup-$d.sql