d=$(date +%Y-%m-%d)
drush @ag sql-dump --gzip --result-file=files/agGov-deploy-backup-$d.sql
drush @ag.colorado.gov sql-dump --gzip --result-file=files/ag-deploy-backup-$d.sql
drush @cdle.colorado.gov sql-dump --gzip --result-file=files/cdle-deploy-backup-$d.sql
drush @cdphe.colorado.gov sql-dump --gzip --result-file=files/cdphe-deploy-backup-$d.sql
drush @cdps.colorado.gov sql-dump --gzip --result-file=files/cdps-deploy-backup-$d.sql
drush @ci.colorado.gov sql-dump --gzip --result-file=files/ci-deploy-backup-$d.sql
drush @dhsem.colorado.gov sql-dump --gzip --result-file=files/dhsem-deploy-backup-$d.sql
drush @dola.colorado.gov sql-dump --gzip --result-file=files/dola-deploy-backup-$d.sql
drush @dora.colorado.gov sql-dump --gzip --result-file=files/dora-deploy-backup-$d.sql
drush @dpa.colorado.gov sql-dump --gzip --result-file=files/dpa-deploy-backup-$d.sql
drush @estes.colorado.gov sql-dump --gzip --result-file=files/estes-deploy-backup-$d.sql
drush @hcpf.colorado.gov sql-dump --gzip --result-file=files/hcpf-deploy-backup-$d.sql
drush @revenue.colorado.gov sql-dump --gzip --result-file=files/revenue-deploy-backup-$d.sql
drush @sipa.colorado.gov sql-dump --gzip --result-file=files/sipa-deploy-backup-$d.sql
drush @slb.colorado.gov sql-dump --gzip --result-file=files/slb-deploy-backup-$d.sql