site="$1" 
target_env="$2" 
source_branch="$3" 
deployed_tag="$4" 
repo_url="$5" 
repo_type="$6"

drush @$site.$target_env cr