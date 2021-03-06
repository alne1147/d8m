## CONTENTS OF THIS FILE ##

 * Introduction
 * Installation
 * Configuration
 * Usage
 * Extending the module
 * How Can You Contribute?
 * Maintainers

## INTRODUCTION ##

Author and maintainer: Pawel Ginalski (gbyte.co)
 * Drupal: https://www.drupal.org/u/gbyte.co
 * Personal: https://gbyte.co/

The module generates multilingual XML sitemaps which adhere to Google's new
hreflang standard. Out of the box the sitemaps index most of Drupal's
content entity types including:

 * nodes
 * taxonomy terms
 * menu links
 * users
 * ...

Contributed entity types like commerce products or media entities can be indexed
as well. On top of that custom links can be added to the sitemap.

To learn about XML sitemaps, see https://en.wikipedia.org/wiki/Sitemaps.

The module also provides an API allowing to create any type of sitemap (not
necessary an XML one) holding links to a local or remote source.

## INSTALLATION ##

See https://www.drupal.org/documentation/install/modules-themes/modules-8
for instructions on how to install or update Drupal modules.

## CONFIGURATION ##

### PERMISSIONS ###

The module permission 'administer sitemap settings' can be configured under
/admin/people/permissions.

### ENTITIES ###

Initially only the home page is indexed in the sitemap. To include content into
the sitemap, visit /admin/config/search/simplesitemap/entities to enable support
for entity types of your choosing. Entity types which feature bundles can then
be configured on a per-bundle basis, e.g.

 * /admin/structure/types/manage/[content type] for nodes
 * /admin/structure/taxonomy/manage/[taxonomy vocabulary] for taxonomy terms
 * /admin/structure/menu/manage/[menu] for menu items
 * ...

When including an entity type or bundle into the sitemap, the priority setting
can be set which will set the 'priority' parameter for all entities of that
type. Same goes for the 'changefreq' setting. All Images referenced by the
entities can be indexed as well. See https://en.wikipedia.org/wiki/Sitemaps to
learn more about these parameters.

Inclusion settings of bundles can be overridden on a per-entity
basis. Just head over to a bundle instance edit form (e.g. node/1/edit) to
override its sitemap settings.

If you wish for the sitemap to reflect the new configuration instantly, check
'Regenerate sitemaps after clicking save'. This setting only appears if a change
in the settings has been detected.

As the sitemap is accessible to anonymous users, bear in mind that only links
will be included which are accessible to anonymous users. There are no access
checks for links added through the module's hooks (see below).

### CUSTOM LINKS ###

To include custom links into the sitemap, visit
/admin/config/search/simplesitemap/custom.

### SETTINGS ###

The settings page can be found under admin/config/search/simplesitemap.
Here the module can be configured and the sitemaps can be manually regenerated.

#### VARIANTS ####

It is possible to have several sitemap instances of different sitemap types with
specific links accessible under certain URLs. These sitemap variants can be
configured under admin/config/search/simplesitemap/variants.

## USAGE ## 

The sitemaps are accessible to the whole world under [variant name]/sitemap.xml.
In addition to that, the default sitemap is accessible under /sitemap.xml.

If the cron generation is turned on, the sitemaps will be regenerated according
to the 'Sitemap generation interval' setting.

A manual generation is possible on admin/config/search/simplesitemap. This is
also the place that shows the overall and variant specific generation status.

The sitemap can be also generated via drush: Use the command
'drush simple-sitemap:generate' ('ssg'), or 'drush simple-sitemap:rebuild-queue'
('ssr').

Generation of hundreds of thousands of links can take time. Each variant gets
published as soon as all of its links have been generated. The previous version
of the sitemap variant is accessible during the generation process.

## EXTENDING THE MODULE ##

### API ###

There are API methods for altering stored inclusion settings, status queries and
programmatic sitemap generation. These include:

 * getSetting
 * saveSetting
 * setVariants
 * getSitemap
 * removeSitemap
 * generateSitemap
 * rebuildQueue
 * enableEntityType
 * disableEntityType
 * setBundleSettings
 * getBundleSettings
 * removeBundleSettings
 * supplementDefaultSettings
 * setEntityInstanceSettings
 * getEntityInstanceSettings
 * removeEntityInstanceSettings
 * bundleIsIndexed
 * entityTypeIsEnabled
 * addCustomLink
 * getCustomLinks
 * removeCustomLinks
 * getSitemapManager
    * getSitemapVariants
    * addSitemapVariant
    * removeSitemapVariants
 * getQueueWorker
    * deleteQueue
    * rebuildQueue
    * getInitialElementCount
    * getQueuedElementCount
    * getStashedResultCount
    * getProcessedElementCount
    * generationInProgress


These service methods can be chained like so:

```php
$generator = \Drupal::service('simple_sitemap.generator');

$generator
  ->getSitemapManager()
  ->addSitemapVariant('test');
  
$generator
  ->saveSetting('remove_duplicates', TRUE)
  ->enableEntityType('node')
  ->setVariants(['default', 'test'])
  ->setBundleSettings('node', 'page', ['index' => TRUE, 'priority' = 0.5])
  ->removeCustomLinks()
  ->addCustomLink('/some/view/page', ['priority' = 0.5])
  ->generateSitemap();
```

See https://gbyte.co/projects/simple-xml-sitemap and code documentation in 
Drupal\simple_sitemap\Simplesitemap for further details.

### API HOOKS ###

It is possible to hook into link generation by implementing
`hook_simple_sitemap_links_alter(&$links){}` in a custom module and altering the
link array shortly before it is transformed to XML.

Adding arbitrary links is possible through the use of
`hook_simple_sitemap_arbitrary_links_alter(&$arbitrary_links){}`. There are no
checks performed on these links (i.e. if they are internal/valid/accessible)
and parameters like priority/lastmod/changefreq have to be added manually.

Altering sitemap attributes and sitemap index attributes is possible through the
use of `hook_simple_sitemap_attributes_alter(&$attributes){}` and
`hook_simple_sitemap_index_attributes_alter(&$index_attributes){}`.

Altering URL generators is possible through
the use of `hook_simple_sitemap_url_generators_alter(&$generators){}`.

Altering sitemap generators is possible through
the use of `hook_simple_sitemap_sitemap_generators_alter(&$generators){}`.

Altering sitemap types is possible through
the use of `hook_simple_sitemap_sitemap_types_alter(&$generators){}`.

### WRITING PLUGINS ###

There are three types of plugins that allow to create any type of sitemap. See
the generator plugins included in this module and check the API docs
(https://www.drupal.org/docs/8/api/plugin-api/plugin-api-overview) to learn how
to implement plugins.

#### SITEMAP TYPE PLUGINS ####

This plugin defines a sitemap type. A sitemap type consists of a sitemap
generator and several URL generators. This plugin is very simple, as it
only requires some class annotation to define which sitemap/URL plugins to use.

#### SITEMAP GENERATOR PLUGINS ####

This plugin defines how a sitemap type is supposed to look. It handles all
aspects of the sitemap except its links/URLs.

#### URL GENERATOR PLUGINS ####

This plugin defines a way of generating URLs for one or more sitemap types.

Note:
Overwriting the default EntityUrlGenerator for a single entity type is possible
through the flag "overrides_entity_type" = "[entity_type_to_be_overwritten]" in
the settings array of the new generator plugin's annotation. See how the
EntityUrlGenerator is overwritten by the EntityMenuLinkContentUrlGenerator to
facilitate a different logic for menu links.

See https://gbyte.co/projects/simple-xml-sitemap for further details.

## HOW CAN YOU CONTRIBUTE? ##

 * Report any bugs, feature or support requests in the issue tracker; if
   possible help out by submitting patches.
   http://drupal.org/project/issues/simple_sitemap

 * Do you know a non-English language? Help translating the module.
   https://localize.drupal.org/translate/projects/simple_sitemap

 * If you would like to say thanks and support the development of this module, a
   donation will be much appreciated.
   https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5AFYRSBLGSC3W
   
 * Feel free to contact me for paid support: https://gbyte.co/contact

## MAINTAINERS ##

Current maintainers:
 * Pawel Ginalski (gbyte.co) - https://www.drupal.org/u/gbyte.co
