git checkout ../config/synchronize/sync/
git clean ../config/synchronize/sync/ -fd
git checkout ../config/synchronize/sync/acquia_connector.settings.yml
rm -rf ../config/synchronize/sync/workflows.workflow.editorial.yml
rm -rf ../config/synchronize/sync/views.view.moderated_content.yml
rm -rf ../config/synchronize/sync/workflows.workflow.editorial.yml
rm -rf ../config/synchronize/sync/views.view.moderated_content.yml
rm -rf ../config/synchronize/sync/system.site.yml
rm -rf config/synchronize/sync/acquia_connector.settings.yml

echo "Removed unwanted config."
