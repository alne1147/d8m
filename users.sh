# Dev Users D8M
#Dept Dept. of Agriculture | ag.dev.colorado.gov
drush @ag.dev ucrt jamos --mail="james.amos@state.co.us" --password="9xzfbddmus"
drush @ag.dev user-add-role "user_administrator" "jamos"
drush @ag.dev user-add-role "content_administrator" "jamos"
drush @ag.dev user-add-role "structure_administrator" "jamos"

#Dept. of Public Safety | cdps.dev.colorado.gov
drush @cdps.dev ucrt pbillinger --mail="patricia.billinger@state.co.us" --password="9xzfbddmus"
drush @cdps.dev user-add-role "user_administrator" "pbillinger"
drush @cdps.dev user-add-role "content_administrator" "pbillinger"
drush @cdps.dev user-add-role "structure_administrator" "pbillinger"

#Dept. of Personnel and Administration | dpa.dev.colorado.gov
drush @dpa.dev ucrt aschulte --mail="adrian.schulte@state.co.us" --password="9xzfbddmus"
drush @dpa.dev user-add-role "user_administrator" "aschulte"
drush @dpa.dev user-add-role "content_administrator" "aschulte"
drush @dpa.dev user-add-role "structure_administrator" "aschulte"

# Dept. of Revenue | revenue.dev.colorado.gov
drush @revenue.dev ucrt mmartinez --mail="melissa.martinez@state.co.us" --password="9xzfbddmus"
drush @revenue.dev user-add-role "user_administrator" "mmartinez"
drush @revenue.dev user-add-role "content_administrator" "mmartinez"
drush @revenue.dev user-add-role "structure_administrator" "mmartinez"

# Dept. of Regulatory Agencies | dora.dev.colorado.gov
drush @dora.dev ucrt rlaurie --mail="rebecca.laurie@state.co.us" --password="9xzfbddmus"
drush @dora.dev ucrt cnicholson --mail="cory.nicholson@state.co.us" --password="9xzfbddmus"
drush @dora.dev ucrt lmaes --mail="lise.maes@state.co.us" --password="9xzfbddmus"

drush @dora.dev user-add-role "user_administrator" "rlaurie","cnicholson","lmaes"
drush @dora.dev user-add-role "content_administrator" "rlaurie","cnicholson","lmaes"
drush @dora.dev user-add-role "structure_administrator" "rlaurie","cnicholson","lmaes"

# Dept. of Local Affairs | dola.dev.colorado.gov
drush @dola.dev ucrt pcollins --mail="patrick.collins@state.co.us" --password="9xzfbddmus"
drush @dola.dev user-add-role "user_administrator" "pcollins"
drush @dola.dev user-add-role "content_administrator" "pcollins"
drush @dola.dev user-add-role "structure_administrator" "pcollins"

# Dept. of Healthcare Policy and Financing | hcpf.dev.colorado.gov
drush @hcpf.dev ucrt jrisberg --mail="joel.risberg@state.co.us" --password="9xzfbddmus"
drush @hcpf.dev user-add-role "user_administrator" "jrisberg"
drush @hcpf.dev user-add-role "content_administrator" "jrisberg"
drush @hcpf.dev user-add-role "structure_administrator" "jrisberg"

# Dept. of Labor | cdle.dev.colorado.gov
drush @cdle.dev ucrt lxin --mail="xin.liu@state.co.us" --password="9xzfbddmus"
drush @cdle.dev ucrt aneal --mail="amanda.neal@state.co.us" --password="9xzfbddmus"
drush @cdle.dev user-add-role "user_administrator" "lxin","aneal"
drush @cdle.dev user-add-role "content_administrator" "lxin","aneal"
drush @cdle.dev user-add-role "structure_administrator" "lxin","aneal"

# Dept. of Public Health and Environment | cdphe.dev.colorado.gov
drush @cdphe.dev ucrt rchowdhury --mail="rio.chowdhury@state.co.us" --password="9xzfbddmus"
drush @cdphe.dev user-add-role "user_administrator" "rchowdhury"
drush @cdphe.dev user-add-role "content_administrator" "rchowdhury"
drush @cdphe.dev user-add-role "structure_administrator" "rchowdhury"

# Town of Estes Park | estes.dev.colorado.gov
drush @estes.dev ucrt krusch --mail="krusch@estes.org" --password="9xzfbddmus"
drush @estes.dev user-add-role "user_administrator" "krusch"
drush @estes.dev user-add-role "content_administrator" "krusch"
drush @estes.dev user-add-role "structure_administrator" "krusch"

# State Internet Portal Authority | sipa.dev.colorado.gov
drush @sipa.dev ucrt bjustice --mail="beth@cosipa.gov" --password="9xzfbddmus"
drush @sipa.dev ucrt kbagnani --mail="kim@cosipa.gov" --password="9xzfbddmus"
drush @sipa.dev user-add-role "user_administrator" "bjustice","kbagnani"
drush @sipa.dev user-add-role "content_administrator" "bjustice","kbagnani"
drush @sipa.dev user-add-role "structure_administrator" "bjustice","kbagnani"

# State Land Board | slb.dev.colorado.gov
drush @slb.dev ucrt kkemp --mail="kristin.kemp@state.co.us" --password="9xzfbddmus"
drush @slb.dev user-add-role "user_administrator" "kkemp"
drush @slb.dev user-add-role "content_administrator" "kkemp"
drush @slb.dev user-add-role "structure_administrator" "kkemp"

# Department of Homeland Security & Emergency Management
drush @dhsem.dev ucrt mtrost --mail="micki.trost@state.co.us" --password="9xzfbddmus"
drush @dhsem.dev user-add-role "user_administrator" "mtrost"
drush @dhsem.dev user-add-role "content_administrator" "mtrost"
drush @dhsem.dev user-add-role "structure_administrator" "mtrost"