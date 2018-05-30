<?php

/**
 * @file
 * Drupal site-specific configuration file.
 *
 * IMPORTANT NOTE:
 * This file may have been set to read-only by the Drupal installation program.
 * If you make changes to this file, be sure to protect it again after making
 * your modifications. Failure to remove write permissions to this file is a
 * security risk.
 *
 * In order to use the selection rules below the multisite aliasing file named
 * sites/sites.php must be present. Its optional settings will be loaded, and
 * the aliases in the array $sites will override the default directory rules
 * below. See sites/example.sites.php for more information about aliases.
 *
 * The configuration directory will be discovered by stripping the website's
 * hostname from left to right and pathname from right to left. The first
 * configuration file found will be used and any others will be ignored. If no
 * other configuration file is found then the default configuration file at
 * 'sites/default' will be used.
 *
 * For example, for a fictitious site installed at
 * https://www.drupal.org:8080/mysite/test/, the 'settings.php' file is searched
 * for in the following directories:
 *
 * - sites/8080.www.drupal.org.mysite.test
 * - sites/www.drupal.org.mysite.test
 * - sites/drupal.org.mysite.test
 * - sites/org.mysite.test
 *
 * - sites/8080.www.drupal.org.mysite
 * - sites/www.drupal.org.mysite
 * - sites/drupal.org.mysite
 * - sites/org.mysite
 *
 * - sites/8080.www.drupal.org
 * - sites/www.drupal.org
 * - sites/drupal.org
 * - sites/org
 *
 * - sites/default
 *
 * Note that if you are installing on a non-standard port number, prefix the
 * hostname with that number. For example,
 * https://www.drupal.org:8080/mysite/test/ could be loaded from
 * sites/8080.www.drupal.org.mysite.test/.
 *
 * @see example.sites.php
 * @see \Drupal\Core\DrupalKernel::getSitePath()
 *
 * In addition to customizing application settings through variables in
 * settings.php, you can create a services.yml file in the same directory to
 * register custom, site-specific service definitions and/or swap out default
 * implementations with custom ones.
 */

/**
 * Database settings:
 *
 * The $databases array specifies the database connection or
 * connections that Drupal may use.  Drupal is able to connect
 * to multiple databases, including multiple types of databases,
 * during the same request.
 *
 * One example of the simplest connection array is shown below. To use the
 * sample settings, copy and uncomment the code below between the @code and
 * @endcode lines and paste it after the $databases declaration. You will need
 * to replace the database username and password and possibly the host and port
 * with the appropriate credentials for your database system.
 *
 * The next section describes how to customize the $databases array for more
 * specific needs.
 *
 * @code
 * $databases['default']['default'] = array (
 *   'database' => 'databasename',
 *   'username' => 'sqlusername',
 *   'password' => 'sqlpassword',
 *   'host' => 'localhost',
 *   'port' => '3306',
 *   'driver' => 'mysql',
 *   'prefix' => '',
 *   'collation' => 'utf8mb4_general_ci',
 * );
 * @endcode
 */
 $databases = array();

/**
 * Customizing database settings.
 *
 * Many of the values of the $databases array can be customized for your
 * particular database system. Refer to the sample in the section above as a
 * starting point.
 *
 * The "driver" property indicates what Drupal database driver the
 * connection should use.  This is usually the same as the name of the
 * database type, such as mysql or sqlite, but not always.  The other
 * properties will vary depending on the driver.  For SQLite, you must
 * specify a database file name in a directory that is writable by the
 * webserver.  For most other drivers, you must specify a
 * username, password, host, and database name.
 *
 * Transaction support is enabled by default for all drivers that support it,
 * including MySQL. To explicitly disable it, set the 'transactions' key to
 * FALSE.
 * Note that some configurations of MySQL, such as the MyISAM engine, don't
 * support it and will proceed silently even if enabled. If you experience
 * transaction related crashes with such configuration, set the 'transactions'
 * key to FALSE.
 *
 * For each database, you may optionally specify multiple "target" databases.
 * A target database allows Drupal to try to send certain queries to a
 * different database if it can but fall back to the default connection if not.
 * That is useful for primary/replica replication, as Drupal may try to connect
 * to a replica server when appropriate and if one is not available will simply
 * fall back to the single primary server (The terms primary/replica are
 * traditionally referred to as master/slave in database server documentation).
 *
 * The general format for the $databases array is as follows:
 * @code
 * $databases['default']['default'] = $info_array;
 * $databases['default']['replica'][] = $info_array;
 * $databases['default']['replica'][] = $info_array;
 * $databases['extra']['default'] = $info_array;
 * @endcode
 *
 * In the above example, $info_array is an array of settings described above.
 * The first line sets a "default" database that has one primary database
 * (the second level default).  The second and third lines create an array
 * of potential replica databases.  Drupal will select one at random for a given
 * request as needed.  The fourth line creates a new database with a name of
 * "extra".
 *
 * You can optionally set prefixes for some or all database table names
 * by using the 'prefix' setting. If a prefix is specified, the table
 * name will be prepended with its value. Be sure to use valid database
 * characters only, usually alphanumeric and underscore. If no prefixes
 * are desired, leave it as an empty string ''.
 *
 * To have all database names prefixed, set 'prefix' as a string:
 * @code
 *   'prefix' => 'main_',
 * @endcode
 *
 * Per-table prefixes are deprecated as of Drupal 8.2, and will be removed in
 * Drupal 9.0. After that, only a single prefix for all tables will be
 * supported.
 *
 * To provide prefixes for specific tables, set 'prefix' as an array.
 * The array's keys are the table names and the values are the prefixes.
 * The 'default' element is mandatory and holds the prefix for any tables
 * not specified elsewhere in the array. Example:
 * @code
 *   'prefix' => array(
 *     'default'   => 'main_',
 *     'users'     => 'shared_',
 *     'sessions'  => 'shared_',
 *     'role'      => 'shared_',
 *     'authmap'   => 'shared_',
 *   ),
 * @endcode
 * You can also use a reference to a schema/database as a prefix. This may be
 * useful if your Drupal installation exists in a schema that is not the default
 * or you want to access several databases from the same code base at the same
 * time.
 * Example:
 * @code
 *   'prefix' => array(
 *     'default'   => 'main.',
 *     'users'     => 'shared.',
 *     'sessions'  => 'shared.',
 *     'role'      => 'shared.',
 *     'authmap'   => 'shared.',
 *   );
 * @endcode
 * NOTE: MySQL and SQLite's definition of a schema is a database.
 *
 * Advanced users can add or override initial commands to execute when
 * connecting to the database server, as well as PDO connection settings. For
 * example, to enable MySQL SELECT queries to exceed the max_join_size system
 * variable, and to reduce the database connection timeout to 5 seconds:
 * @code
 * $databases['default']['default'] = array(
 *   'init_commands' => array(
 *     'big_selects' => 'SET SQL_BIG_SELECTS=1',
 *   ),
 *   'pdo' => array(
 *     PDO::ATTR_TIMEOUT => 5,
 *   ),
 * );
 * @endcode
 *
 * WARNING: The above defaults are designed for database portability. Changing
 * them may cause unexpected behavior, including potential data loss. See
 * https://www.drupal.org/developing/api/database/configuration for more
 * information on these defaults and the potential issues.
 *
 * More details can be found in the constructor methods for each driver:
 * - \Drupal\Core\Database\Driver\mysql\Connection::__construct()
 * - \Drupal\Core\Database\Driver\pgsql\Connection::__construct()
 * - \Drupal\Core\Database\Driver\sqlite\Connection::__construct()
 *
 * Sample Database configuration format for PostgreSQL (pgsql):
 * @code
 *   $databases['default']['default'] = array(
 *     'driver' => 'pgsql',
 *     'database' => 'databasename',
 *     'username' => 'sqlusername',
 *     'password' => 'sqlpassword',
 *     'host' => 'localhost',
 *     'prefix' => '',
 *   );
 * @endcode
 *
 * Sample Database configuration format for SQLite (sqlite):
 * @code
 *   $databases['default']['default'] = array(
 *     'driver' => 'sqlite',
 *     'database' => '/path/to/databasefilename',
 *   );
 * @endcode
 */

/**
 * Location of the site configuration files.
 *
 * The $config_directories array specifies the location of file system
 * directories used for configuration data. On install, the "sync" directory is
 * created. This is used for configuration imports. The "active" directory is
 * not created by default since the default storage for active configuration is
 * the database rather than the file system. (This can be changed. See "Active
 * configuration settings" below).
 *
 * The default location for the "sync" directory is inside a randomly-named
 * directory in the public files path. The setting below allows you to override
 * the "sync" location.
 *
 * If you use files for the "active" configuration, you can tell the
 * Configuration system where this directory is located by adding an entry with
 * array key CONFIG_ACTIVE_DIRECTORY.
 *
 * Example:
 * @code
 *   $config_directories = array(
 *     CONFIG_SYNC_DIRECTORY => '/directory/outside/webroot',
 *   );
 * @endcode
 */
$config_directories = array();

/**
 * Settings:
 *
 * $settings contains environment-specific configuration, such as the files
 * directory and reverse proxy address, and temporary configuration, such as
 * security overrides.
 *
 * @see \Drupal\Core\Site\Settings::get()
 */

/**
 * The active installation profile.
 *
 * Changing this after installation is not recommended as it changes which
 * directories are scanned during extension discovery. If this is set prior to
 * installation this value will be rewritten according to the profile selected
 * by the user.
 *
 * @see install_select_profile()
 *
 * @deprecated in Drupal 8.3.0 and will be removed before Drupal 9.0.0. The
 *   install profile is written to the core.extension configuration. If a
 *   service requires the install profile use the 'install_profile' container
 *   parameter. Functional code can use \Drupal::installProfile().
 */
# $settings['install_profile'] = '';

/**
 * Salt for one-time login links, cancel links, form tokens, etc.
 *
 * This variable will be set to a random value by the installer. All one-time
 * login links will be invalidated if the value is changed. Note that if your
 * site is deployed on a cluster of web servers, you must ensure that this
 * variable has the same value on each server.
 *
 * For enhanced security, you may set this variable to the contents of a file
 * outside your document root; you should also ensure that this file is not
 * stored with backups of your database.
 *
 * Example:
 * @code
 *   $settings['hash_salt'] = file_get_contents('/home/example/salt.txt');
 * @endcode
 */
$settings['hash_salt'] = 'PeLNpn3khYftaTWiuajfRln_0wYqOtkc9U9WeZQu4EafwZLy21b9t3wnzNtUAm5vHAvojVgYSQ';

/**
 * Deployment identifier.
 *
 * Drupal's dependency injection container will be automatically invalidated and
 * rebuilt when the Drupal core version changes. When updating contributed or
 * custom code that changes the container, changing this identifier will also
 * allow the container to be invalidated as soon as code is deployed.
 */
# $settings['deployment_identifier'] = \Drupal::VERSION;

/**
 * Access control for update.php script.
 *
 * If you are updating your Drupal installation using the update.php script but
 * are not logged in using either an account with the "Administer software
 * updates" permission or the site maintenance account (the account that was
 * created during installation), you will need to modify the access check
 * statement below. Change the FALSE to a TRUE to disable the access check.
 * After finishing the upgrade, be sure to open this file again and change the
 * TRUE back to a FALSE!
 */
$settings['update_free_access'] = FALSE;

/**
 * External access proxy settings:
 *
 * If your site must access the Internet via a web proxy then you can enter the
 * proxy settings here. Set the full URL of the proxy, including the port, in
 * variables:
 * - $settings['http_client_config']['proxy']['http']: The proxy URL for HTTP
 *   requests.
 * - $settings['http_client_config']['proxy']['https']: The proxy URL for HTTPS
 *   requests.
 * You can pass in the user name and password for basic authentication in the
 * URLs in these settings.
 *
 * You can also define an array of host names that can be accessed directly,
 * bypassing the proxy, in $settings['http_client_config']['proxy']['no'].
 */
# $settings['http_client_config']['proxy']['http'] = 'http://proxy_user:proxy_pass@example.com:8080';
# $settings['http_client_config']['proxy']['https'] = 'http://proxy_user:proxy_pass@example.com:8080';
# $settings['http_client_config']['proxy']['no'] = ['127.0.0.1', 'localhost'];

/**
 * Reverse Proxy Configuration:
 *
 * Reverse proxy servers are often used to enhance the performance
 * of heavily visited sites and may also provide other site caching,
 * security, or encryption benefits. In an environment where Drupal
 * is behind a reverse proxy, the real IP address of the client should
 * be determined such that the correct client IP address is available
 * to Drupal's logging, statistics, and access management systems. In
 * the most simple scenario, the proxy server will add an
 * X-Forwarded-For header to the request that contains the client IP
 * address. However, HTTP headers are vulnerable to spoofing, where a
 * malicious client could bypass restrictions by setting the
 * X-Forwarded-For header directly. Therefore, Drupal's proxy
 * configuration requires the IP addresses of all remote proxies to be
 * specified in $settings['reverse_proxy_addresses'] to work correctly.
 *
 * Enable this setting to get Drupal to determine the client IP from
 * the X-Forwarded-For header (or $settings['reverse_proxy_header'] if set).
 * If you are unsure about this setting, do not have a reverse proxy,
 * or Drupal operates in a shared hosting environment, this setting
 * should remain commented out.
 *
 * In order for this setting to be used you must specify every possible
 * reverse proxy IP address in $settings['reverse_proxy_addresses'].
 * If a complete list of reverse proxies is not available in your
 * environment (for example, if you use a CDN) you may set the
 * $_SERVER['REMOTE_ADDR'] variable directly in settings.php.
 * Be aware, however, that it is likely that this would allow IP
 * address spoofing unless more advanced precautions are taken.
 */
# $settings['reverse_proxy'] = TRUE;

/**
 * Specify every reverse proxy IP address in your environment.
 * This setting is required if $settings['reverse_proxy'] is TRUE.
 */
# $settings['reverse_proxy_addresses'] = array('a.b.c.d', ...);

/**
 * Set this value if your proxy server sends the client IP in a header
 * other than X-Forwarded-For.
 */
# $settings['reverse_proxy_header'] = 'X_CLUSTER_CLIENT_IP';

/**
 * Set this value if your proxy server sends the client protocol in a header
 * other than X-Forwarded-Proto.
 */
# $settings['reverse_proxy_proto_header'] = 'X_FORWARDED_PROTO';

/**
 * Set this value if your proxy server sends the client protocol in a header
 * other than X-Forwarded-Host.
 */
# $settings['reverse_proxy_host_header'] = 'X_FORWARDED_HOST';

/**
 * Set this value if your proxy server sends the client protocol in a header
 * other than X-Forwarded-Port.
 */
# $settings['reverse_proxy_port_header'] = 'X_FORWARDED_PORT';

/**
 * Set this value if your proxy server sends the client protocol in a header
 * other than Forwarded.
 */
# $settings['reverse_proxy_forwarded_header'] = 'FORWARDED';

/**
 * Page caching:
 *
 * By default, Drupal sends a "Vary: Cookie" HTTP header for anonymous page
 * views. This tells a HTTP proxy that it may return a page from its local
 * cache without contacting the web server, if the user sends the same Cookie
 * header as the user who originally requested the cached page. Without "Vary:
 * Cookie", authenticated users would also be served the anonymous page from
 * the cache. If the site has mostly anonymous users except a few known
 * editors/administrators, the Vary header can be omitted. This allows for
 * better caching in HTTP proxies (including reverse proxies), i.e. even if
 * clients send different cookies, they still get content served from the cache.
 * However, authenticated users should access the site directly (i.e. not use an
 * HTTP proxy, and bypass the reverse proxy if one is used) in order to avoid
 * getting cached pages from the proxy.
 */
# $settings['omit_vary_cookie'] = TRUE;


/**
 * Cache TTL for client error (4xx) responses.
 *
 * Items cached per-URL tend to result in a large number of cache items, and
 * this can be problematic on 404 pages which by their nature are unbounded. A
 * fixed TTL can be set for these items, defaulting to one hour, so that cache
 * backends which do not support LRU can purge older entries. To disable caching
 * of client error responses set the value to 0. Currently applies only to
 * page_cache module.
 */
# $settings['cache_ttl_4xx'] = 3600;


/**
 * Class Loader.
 *
 * If the APC extension is detected, the Symfony APC class loader is used for
 * performance reasons. Detection can be prevented by setting
 * class_loader_auto_detect to false, as in the example below.
 */
# $settings['class_loader_auto_detect'] = FALSE;

/*
 * If the APC extension is not detected, either because APC is missing or
 * because auto-detection has been disabled, auto-loading falls back to
 * Composer's ClassLoader, which is good for development as it does not break
 * when code is moved in the file system. You can also decorate the base class
 * loader with another cached solution than the Symfony APC class loader, as
 * all production sites should have a cached class loader of some sort enabled.
 *
 * To do so, you may decorate and replace the local $class_loader variable. For
 * example, to use Symfony's APC class loader without automatic detection,
 * uncomment the code below.
 */
/*
if ($settings['hash_salt']) {
  $prefix = 'drupal.' . hash('sha256', 'drupal.' . $settings['hash_salt']);
  $apc_loader = new \Symfony\Component\ClassLoader\ApcClassLoader($prefix, $class_loader);
  unset($prefix);
  $class_loader->unregister();
  $apc_loader->register();
  $class_loader = $apc_loader;
}
*/

/**
 * Authorized file system operations:
 *
 * The Update Manager module included with Drupal provides a mechanism for
 * site administrators to securely install missing updates for the site
 * directly through the web user interface. On securely-configured servers,
 * the Update manager will require the administrator to provide SSH or FTP
 * credentials before allowing the installation to proceed; this allows the
 * site to update the new files as the user who owns all the Drupal files,
 * instead of as the user the webserver is running as. On servers where the
 * webserver user is itself the owner of the Drupal files, the administrator
 * will not be prompted for SSH or FTP credentials (note that these server
 * setups are common on shared hosting, but are inherently insecure).
 *
 * Some sites might wish to disable the above functionality, and only update
 * the code directly via SSH or FTP themselves. This setting completely
 * disables all functionality related to these authorized file operations.
 *
 * @see https://www.drupal.org/node/244924
 *
 * Remove the leading hash signs to disable.
 */
# $settings['allow_authorize_operations'] = FALSE;

/**
 * Default mode for directories and files written by Drupal.
 *
 * Value should be in PHP Octal Notation, with leading zero.
 */
$settings['file_chmod_directory'] = 0775;
$settings['file_chmod_file'] = 0664;

/**
 * Public file base URL:
 *
 * An alternative base URL to be used for serving public files. This must
 * include any leading directory path.
 *
 * A different value from the domain used by Drupal to be used for accessing
 * public files. This can be used for a simple CDN integration, or to improve
 * security by serving user-uploaded files from a different domain or subdomain
 * pointing to the same server. Do not include a trailing slash.
 */
# $settings['file_public_base_url'] = 'http://downloads.example.com/files';

/**
 * Public file path:
 *
 * A local file system path where public files will be stored. This directory
 * must exist and be writable by Drupal. This directory must be relative to
 * the Drupal installation directory and be accessible over the web.
 */
# $settings['file_public_path'] = 'sites/default/files';

/**
 * Private file path:
 *
 * A local file system path where private files will be stored. This directory
 * must be absolute, outside of the Drupal installation directory and not
 * accessible over the web.
 *
 * Note: Caches need to be cleared when this value is changed to make the
 * private:// stream wrapper available to the system.
 *
 * See https://www.drupal.org/documentation/modules/file for more information
 * about securing private files.
 */
# $settings['file_private_path'] = '';

/**
 * Session write interval:
 *
 * Set the minimum interval between each session write to database.
 * For performance reasons it defaults to 180.
 */
# $settings['session_write_interval'] = 180;

/**
 * String overrides:
 *
 * To override specific strings on your site with or without enabling the Locale
 * module, add an entry to this list. This functionality allows you to change
 * a small number of your site's default English language interface strings.
 *
 * Remove the leading hash signs to enable.
 *
 * The "en" part of the variable name, is dynamic and can be any langcode of
 * any added language. (eg locale_custom_strings_de for german).
 */
# $settings['locale_custom_strings_en'][''] = array(
#   'forum'      => 'Discussion board',
#   '@count min' => '@count minutes',
# );

/**
 * A custom theme for the offline page:
 *
 * This applies when the site is explicitly set to maintenance mode through the
 * administration page or when the database is inactive due to an error.
 * The template file should also be copied into the theme. It is located inside
 * 'core/modules/system/templates/maintenance-page.html.twig'.
 *
 * Note: This setting does not apply to installation and update pages.
 */
# $settings['maintenance_theme'] = 'bartik';

/**
 * PHP settings:
 *
 * To see what PHP settings are possible, including whether they can be set at
 * runtime (by using ini_set()), read the PHP documentation:
 * http://php.net/manual/ini.list.php
 * See \Drupal\Core\DrupalKernel::bootEnvironment() for required runtime
 * settings and the .htaccess file for non-runtime settings.
 * Settings defined there should not be duplicated here so as to avoid conflict
 * issues.
 */

/**
 * If you encounter a situation where users post a large amount of text, and
 * the result is stripped out upon viewing but can still be edited, Drupal's
 * output filter may not have sufficient memory to process it.  If you
 * experience this issue, you may wish to uncomment the following two lines
 * and increase the limits of these variables.  For more information, see
 * http://php.net/manual/pcre.configuration.php.
 */
# ini_set('pcre.backtrack_limit', 200000);
# ini_set('pcre.recursion_limit', 200000);

/**
 * Active configuration settings.
 *
 * By default, the active configuration is stored in the database in the
 * {config} table. To use a different storage mechanism for the active
 * configuration, do the following prior to installing:
 * - Create an "active" directory and declare its path in $config_directories
 *   as explained under the 'Location of the site configuration files' section
 *   above in this file. To enhance security, you can declare a path that is
 *   outside your document root.
 * - Override the 'bootstrap_config_storage' setting here. It must be set to a
 *   callable that returns an object that implements
 *   \Drupal\Core\Config\StorageInterface.
 * - Override the service definition 'config.storage.active'. Put this
 *   override in a services.yml file in the same directory as settings.php
 *   (definitions in this file will override service definition defaults).
 */
# $settings['bootstrap_config_storage'] = array('Drupal\Core\Config\BootstrapConfigStorageFactory', 'getFileStorage');

/**
 * Configuration overrides.
 *
 * To globally override specific configuration values for this site,
 * set them here. You usually don't need to use this feature. This is
 * useful in a configuration file for a vhost or directory, rather than
 * the default settings.php.
 *
 * Note that any values you provide in these variable overrides will not be
 * viewable from the Drupal administration interface. The administration
 * interface displays the values stored in configuration so that you can stage
 * changes to other environments that don't have the overrides.
 *
 * There are particular configuration values that are risky to override. For
 * example, overriding the list of installed modules in 'core.extension' is not
 * supported as module install or uninstall has not occurred. Other examples
 * include field storage configuration, because it has effects on database
 * structure, and 'core.menu.static_menu_link_overrides' since this is cached in
 * a way that is not config override aware. Also, note that changing
 * configuration values in settings.php will not fire any of the configuration
 * change events.
 */
# $config['system.site']['name'] = 'My Drupal site';
# $config['system.theme']['default'] = 'stark';
# $config['user.settings']['anonymous'] = 'Visitor';

/**
 * Fast 404 pages:
 *
 * Drupal can generate fully themed 404 pages. However, some of these responses
 * are for images or other resource files that are not displayed to the user.
 * This can waste bandwidth, and also generate server load.
 *
 * The options below return a simple, fast 404 page for URLs matching a
 * specific pattern:
 * - $config['system.performance']['fast_404']['exclude_paths']: A regular
 *   expression to match paths to exclude, such as images generated by image
 *   styles, or dynamically-resized images. The default pattern provided below
 *   also excludes the private file system. If you need to add more paths, you
 *   can add '|path' to the expression.
 * - $config['system.performance']['fast_404']['paths']: A regular expression to
 *   match paths that should return a simple 404 page, rather than the fully
 *   themed 404 page. If you don't have any aliases ending in htm or html you
 *   can add '|s?html?' to the expression.
 * - $config['system.performance']['fast_404']['html']: The html to return for
 *   simple 404 pages.
 *
 * Remove the leading hash signs if you would like to alter this functionality.
 */
# $config['system.performance']['fast_404']['exclude_paths'] = '/\/(?:styles)|(?:system\/files)\//';
# $config['system.performance']['fast_404']['paths'] = '/\.(?:txt|png|gif|jpe?g|css|js|ico|swf|flv|cgi|bat|pl|dll|exe|asp)$/i';
# $config['system.performance']['fast_404']['html'] = '<!DOCTYPE html><html><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL "@path" was not found on this server.</p></body></html>';

/**
 * Load services definition file.
 */
$settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.yml';

/**
 * Override the default service container class.
 *
 * This is useful for example to trace the service container for performance
 * tracking purposes, for testing a service container with an error condition or
 * to test a service container that throws an exception.
 */
# $settings['container_base_class'] = '\Drupal\Core\DependencyInjection\Container';

/**
 * Override the default yaml parser class.
 *
 * Provide a fully qualified class name here if you would like to provide an
 * alternate implementation YAML parser. The class must implement the
 * \Drupal\Component\Serialization\SerializationInterface interface.
 */
# $settings['yaml_parser_class'] = NULL;

/**
 * Trusted host configuration.
 *
 * Drupal core can use the Symfony trusted host mechanism to prevent HTTP Host
 * header spoofing.
 *
 * To enable the trusted host mechanism, you enable your allowable hosts
 * in $settings['trusted_host_patterns']. This should be an array of regular
 * expression patterns, without delimiters, representing the hosts you would
 * like to allow.
 *
 * For example:
 * @code
 * $settings['trusted_host_patterns'] = array(
 *   '^www\.example\.com$',
 * );
 * @endcode
 * will allow the site to only run from www.example.com.
 *
 * If you are running multisite, or if you are running your site from
 * different domain names (eg, you don't redirect http://www.example.com to
 * http://example.com), you should specify all of the host patterns that are
 * allowed by your site.
 *
 * For example:
 * @code
 * $settings['trusted_host_patterns'] = array(
 *   '^example\.com$',
 *   '^.+\.example\.com$',
 *   '^example\.org$',
 *   '^.+\.example\.org$',
 * );
 * @endcode
 * will allow the site to run off of all variants of example.com and
 * example.org, with all subdomains included.
 */

/**
 * The default list of directories that will be ignored by Drupal's file API.
 *
 * By default ignore node_modules and bower_components folders to avoid issues
 * with common frontend tools and recursive scanning of directories looking for
 * extensions.
 *
 * @see file_scan_directory()
 * @see \Drupal\Core\Extension\ExtensionDiscovery::scanDirectory()
 */
$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components',
];

/**
 * Load local development override configuration, if available.
 *
 * Use settings.local.php to override variables on secondary (staging,
 * development, etc) installations of this site. Typically used to disable
 * caching, JavaScript/CSS compression, re-routing of outgoing emails, and
 * other things that should not happen on development and testing sites.
 *
 * Keep this code block at the end of this file to take full effect.
 */
#
 if (file_exists($app_root . '/' . $site_path . '/settings.local.php')) {
  include $app_root . '/' . $site_path . '/settings.local.php';
 }

// On Acquia Cloud, this include file configures Drupal to use the correct
// database in each site environment (Dev, Stage, or Prod). To use this
// settings.php for development on your local workstation, set $db_url
// (Drupal 5 or 6) or $databases (Drupal 7 or 8) as described in comments above.
if (file_exists('/var/www/site-php')) {
  require('/var/www/site-php/coloradod8m/coloradod8m-settings.inc');
}
$config_directories['sync'] = '../../../config/sync';
$config_directories['staging'] = '../../../config/staging';
$settings['install_profile'] = 'ci_start';
$config['content_directory'] = '../content';
$conf['file_temporary_path'] = 'tmp';

#!/usr/local/bin/php

/**
 * Acquia Search: Solr URL override depending on Acquia environment
 * -----------------------------------------------------------------
 * 
 * NOTE: This file is provided as-is. Please test!
 * 
 *  Instructions:
 *  
 *  * Read "EDIT" sections below and edit accordingly.
 *  * Place this snippet at the end of your settings.php file(s).
 *  * If using Acquia Site Factory, instead place it in a post-settings hook.
 *
 *
 */

// EDIT below to set up the mappings between your available cores and the
//   Acquia Hosting environments. Core ID must match one from 
//   $acquia_search_available_cores (below), otherwise no overriding will happen.
$acquia_search_environment_mapping = [

  // EDIT: Add all environments below
  // syntax is:   "value of $_ENV[AH_SITE_ENVIRONMENT]" => "core ID"
  "prod" => "CDIY-145117",
  "test" => "CDIY-145117.test.default",
  "dev" => "CDIY-145117.dev.defualt",
  
  // EDIT: Fallback Core ID for other environments (or local environments)
  "FALLBACK" => "CDIY-145117.dev.default",
];

// EDIT below to contain the search API server machine name(s) to override.
// (Only needed if using D7 search_api_acquia.module)
$searchapi_server_ids = [ "acquia_search" ];

// EDIT below to contain the apachesolr.module environment IDs to override.
// (Only needed if using D7 acquia_search.module)
$apachesolr_environment_ids = [ "acquia_search_server_1" ];

/**
 * DO NOT EDIT BELOW THIS LINE =================================================
 */
 
$acquia_search_available_cores = [

  // Entry for CDIY-145117. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117/admin/ping
  "CDIY-145117" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117",
    "derived_key" => "782d0f4dcb6af6237010225476baf1a7b73cf681",
  ],

  // Entry for CDIY-145117.dev.default. Test at http://useast1-c1.acquia-search.com/solr/CDIY-145117.dev.default/admin/ping
  "CDIY-145117.dev.default" => [
    "host" => "useast1-c1.acquia-search.com",
    "path" => "/solr/CDIY-145117.dev.default",
    "derived_key" => "8e4e9b45b93ad5e8ddb0f3f68e680a5b8830bad2",
  ],

  // Entry for CDIY-145117.test.default. Test at http://useast1-c1.acquia-search.com/solr/CDIY-145117.test.default/admin/ping
  "CDIY-145117.test.default" => [
    "host" => "useast1-c1.acquia-search.com",
    "path" => "/solr/CDIY-145117.test.default",
    "derived_key" => "3415143f07cc23971c8d45fb1441bb3a936c1686",
  ],

  // SHARED //
  // Entry for CDIY-145117.dev.agcoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.dev.agcoloradogov/admin/ping
  "CDIY-145117.dev.agcoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.dev.agcoloradogov",
    "derived_key" => "781ecf80727eb2417d3ae500c5d5a16c1011dddb",
  ],

  // Entry for CDIY-145117.prod.agcoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.prod.agcoloradogov/admin/ping
  "CDIY-145117.prod.agcoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.prod.agcoloradogov",
    "derived_key" => "cecacbb873529eca76c685f15faa0a1422be41a9",
  ],

  // Entry for CDIY-145117.test.agcoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.test.agcoloradogov/admin/ping
  "CDIY-145117.test.agcoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.test.agcoloradogov",
    "derived_key" => "86cd524a8c235c3b86c8077633f9a41067c1eefc",
  ],
  // SHARED //
  // Entry for CDIY-145117.dev.cdlecoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.dev.cdlecoloradogov/admin/ping
	  "CDIY-145117.dev.cdlecoloradogov" => [
	    "host" => "useast1-c26.acquia-search.com",
	    "path" => "/solr/CDIY-145117.dev.agcoloradogov",
	    "derived_key" => "781ecf80727eb2417d3ae500c5d5a16c1011dddb",
	  ],

  // Entry for CDIY-145117.prod.cdlecoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.prod.cdlecoloradogov/admin/ping
  "CDIY-145117.prod.cdlecoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.prod.cdlecoloradogov",
    "derived_key" => "77accc90f5606c4c9110e61540954614b0ba2c76",
  ],

  // Entry for CDIY-145117.test.cdlecoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.test.cdlecoloradogov/admin/ping
  "CDIY-145117.test.cdlecoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.test.cdlecoloradogov",
    "derived_key" => "99112d1176791a03b9f2143489992b1132b352e1",
  ],

  // Entry for CDIY-145117.dev.cdphecoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.dev.cdphecoloradogov/admin/ping
  "CDIY-145117.dev.cdphecoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.dev.cdphecoloradogov",
    "derived_key" => "7cd1880f0109dd49f16fab7a8b1904561a9f2258",
  ],

  // Entry for CDIY-145117.prod.cdphecoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.prod.cdphecoloradogov/admin/ping
  "CDIY-145117.prod.cdphecoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.prod.cdphecoloradogov",
    "derived_key" => "1b15859de15ee8b8eed8503495ecee6b6f931881",
  ],

  // Entry for CDIY-145117.test.cdphecoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.test.cdphecoloradogov/admin/ping
  "CDIY-145117.test.cdphecoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.test.cdphecoloradogov",
    "derived_key" => "0f925a4a6fa5e5db0c8db30951ad373f3f30d7c5",
  ],

  // Entry for CDIY-145117.dev.cdpscoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.dev.cdpscoloradogov/admin/ping
  "CDIY-145117.dev.cdpscoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.dev.cdpscoloradogov",
    "derived_key" => "fe66e937d3469d1d0d857159a75647cbaa644cdf",
  ],

  // Entry for CDIY-145117.prod.cdpscoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.prod.cdpscoloradogov/admin/ping
  "CDIY-145117.prod.cdpscoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.prod.cdpscoloradogov",
    "derived_key" => "f8bd814c06fff90e499675c7c55e60d6712939cf",
  ],

  // Entry for CDIY-145117.test.cdpscoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.test.cdpscoloradogov/admin/ping
  "CDIY-145117.test.cdpscoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.test.cdpscoloradogov",
    "derived_key" => "3349e86c433ec548b8c48c76ebc6d631334d3e4a",
  ],

  // Entry for CDIY-145117.dev.cicoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.dev.cicoloradogov/admin/ping
  "CDIY-145117.dev.cicoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.dev.cicoloradogov",
    "derived_key" => "4793e027a7f176fc49cf97c6bf7e68c6e53726cc",
  ],

  // Entry for CDIY-145117.prod.cicoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.prod.cicoloradogov/admin/ping
  "CDIY-145117.prod.cicoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.prod.cicoloradogov",
    "derived_key" => "04f78b6efa8de3bca31e4b761e3810bc7d4f7a8b",
  ],

  // Entry for CDIY-145117.test.cicoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.test.cicoloradogov/admin/ping
  "CDIY-145117.test.cicoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.test.cicoloradogov",
    "derived_key" => "6c84834e1780b79d61a51b235f5e998ae52d12f6",
  ],

  // Entry for CDIY-145117.dev.dhsemcoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.dev.dhsemcoloradogov/admin/ping
  "CDIY-145117.dev.dhsemcoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.dev.dhsemcoloradogov",
    "derived_key" => "94d0dbd6544e3854e3ec99a10c81e0140fb5fc62",
  ],

  // Entry for CDIY-145117.prod.dhsemcoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.prod.dhsemcoloradogov/admin/ping
  "CDIY-145117.prod.dhsemcoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.prod.dhsemcoloradogov",
    "derived_key" => "e8bd5dc0697bfa0596128db7d4807866bebeeddf",
  ],

  // Entry for CDIY-145117.test.dhsemcoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.test.dhsemcoloradogov/admin/ping
  "CDIY-145117.test.dhsemcoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.test.dhsemcoloradogov",
    "derived_key" => "31afbcbab79e8e2b0bdbd7feeb943e0024ee917c",
  ],

  // Entry for CDIY-145117.dev.dolacoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.dev.dolacoloradogov/admin/ping
  "CDIY-145117.dev.dolacoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.dev.dolacoloradogov",
    "derived_key" => "9519f282ce10761ff2d7ba3d11bb0169f196e7d4",
  ],

  // Entry for CDIY-145117.prod.dolacoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.prod.dolacoloradogov/admin/ping
  "CDIY-145117.prod.dolacoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.prod.dolacoloradogov",
    "derived_key" => "88d6a2c0938639be004c25497a253a33b70349c8",
  ],

  // Entry for CDIY-145117.test.dolacoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.test.dolacoloradogov/admin/ping
  "CDIY-145117.test.dolacoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.test.dolacoloradogov",
    "derived_key" => "fb6a33ec46801d7312e74a50cffde9d64be7a34e",
  ],

  // Entry for CDIY-145117.dev.doracoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.dev.doracoloradogov/admin/ping
  "CDIY-145117.dev.doracoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.dev.doracoloradogov",
    "derived_key" => "5bb50088a860f6c1edf72158d860387107edd077",
  ],

  // Entry for CDIY-145117.prod.doracoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.prod.doracoloradogov/admin/ping
  "CDIY-145117.prod.doracoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.prod.doracoloradogov",
    "derived_key" => "398770e0cdfaf26abd68b0b3a23c23ff686510fb",
  ],

  // Entry for CDIY-145117.test.doracoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.test.doracoloradogov/admin/ping
  "CDIY-145117.test.doracoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.test.doracoloradogov",
    "derived_key" => "eb5daa4c774818186016a29308c2699420f343b4",
  ],

  // Entry for CDIY-145117.dev.dpacoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.dev.dpacoloradogov/admin/ping
  "CDIY-145117.dev.dpacoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.dev.dpacoloradogov",
    "derived_key" => "270229fb834186578b5cd481c49dd957db613cda",
  ],

  // Entry for CDIY-145117.prod.dpacoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.prod.dpacoloradogov/admin/ping
  "CDIY-145117.prod.dpacoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.prod.dpacoloradogov",
    "derived_key" => "3ef8799c44ddbc50db3e5e1958cc4f21a68cd851",
  ],

  // Entry for CDIY-145117.test.dpacoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.test.dpacoloradogov/admin/ping
  "CDIY-145117.test.dpacoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.test.dpacoloradogov",
    "derived_key" => "380ca8c988b67847673ce8f827329b6ea6961611",
  ],

  // Entry for CDIY-145117.dev.estescoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.dev.estescoloradogov/admin/ping
  "CDIY-145117.dev.estescoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.dev.estescoloradogov",
    "derived_key" => "29c9e9ce284fad757b20083918d48651bf631d22",
  ],

  // Entry for CDIY-145117.prod.estescoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.prod.estescoloradogov/admin/ping
  "CDIY-145117.prod.estescoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.prod.estescoloradogov",
    "derived_key" => "af8cf556ba685b4b83198f86ba5458d0a954ac0e",
  ],

  // Entry for CDIY-145117.test.estescoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.test.estescoloradogov/admin/ping
  "CDIY-145117.test.estescoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.test.estescoloradogov",
    "derived_key" => "02a41cb99e798873131a781dfdb1254952097f16",
  ],

  // Entry for CDIY-145117.dev.hcpfcoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.dev.hcpfcoloradogov/admin/ping
  "CDIY-145117.dev.hcpfcoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.dev.hcpfcoloradogov",
    "derived_key" => "a617cc8438f6d1dd45b9346a7b89c47fbc888c66",
  ],

  // Entry for CDIY-145117.prod.hcpfcoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.prod.hcpfcoloradogov/admin/ping
  "CDIY-145117.prod.hcpfcoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.prod.hcpfcoloradogov",
    "derived_key" => "616b7dbdada45c08917e4ac3e71cde72a2f8fb35",
  ],

  // Entry for CDIY-145117.test.hcpfcoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.test.hcpfcoloradogov/admin/ping
  "CDIY-145117.test.hcpfcoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.test.hcpfcoloradogov",
    "derived_key" => "eeb46f93fe70204fa1402d03c2b8d5ad3f936b16",
  ],

  // Entry for CDIY-145117.dev.revenuecoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.dev.revenuecoloradogov/admin/ping
  "CDIY-145117.dev.revenuecoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.dev.revenuecoloradogov",
    "derived_key" => "77994ccfe72c62c931fbdbe6bfd674b761f86c06",
  ],

  // Entry for CDIY-145117.prod.revenuecoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.prod.revenuecoloradogov/admin/ping
  "CDIY-145117.prod.revenuecoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.prod.revenuecoloradogov",
    "derived_key" => "897bd82827df2159df8557fb97218fbd50b337c7",
  ],

  // Entry for CDIY-145117.test.revenuecoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.test.revenuecoloradogov/admin/ping
  "CDIY-145117.test.revenuecoloradogov" => [
	  "host" => "useast1-c26.acquia-search.com",
	  "path" => "/solr/CDIY-145117.dev.revenuecoloradogov",
    "derived_key" => "e07c78ccdb9be494b4dd59225da9cbfc8b800817",
  ],

  // Entry for CDIY-145117.dev.sipacoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.dev.sipacoloradogov/admin/ping
  "CDIY-145117.dev.sipacoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.dev.sipacoloradogov",
    "derived_key" => "acb35a52001a6866bc6416eae14cb4da6c54719f",
  ],

  // Entry for CDIY-145117.prod.sipacoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.prod.sipacoloradogov/admin/ping
  "CDIY-145117.prod.sipacoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.prod.sipacoloradogov",
    "derived_key" => "a7de9869dcca0250040592377deb72918d8c3fc8",
  ],

  // Entry for CDIY-145117.test.sipacoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.test.sipacoloradogov/admin/ping
  "CDIY-145117.test.sipacoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.test.sipacoloradogov",
    "derived_key" => "be0e13e60be9efcbd1449855c842fca077837410",
  ],

  // Entry for CDIY-145117.dev.slbcoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.dev.slbcoloradogov/admin/ping
  "CDIY-145117.dev.slbcoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.dev.slbcoloradogov",
    "derived_key" => "34ae8a31a883629f6b1ae0a69b7b918ab37a3ded",
  ],

  // Entry for CDIY-145117.prod.slbcoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.prod.slbcoloradogov/admin/ping
  "CDIY-145117.prod.slbcoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.prod.slbcoloradogov",
    "derived_key" => "b421dd90e1fca2eac5b122cf6afba24f2e51beb1",
  ],

  // Entry for CDIY-145117.test.slbcoloradogov. Test at http://useast1-c26.acquia-search.com/solr/CDIY-145117.test.slbcoloradogov/admin/ping
  "CDIY-145117.test.slbcoloradogov" => [
    "host" => "useast1-c26.acquia-search.com",
    "path" => "/solr/CDIY-145117.test.slbcoloradogov",
    "derived_key" => "19ee64af069c909ca17fa1a33ee380f69aec9225",
  ],
];

// Default to the FALLBACK core. 
$core_id = $acquia_search_environment_mapping["FALLBACK"];
// Detect Acquia Cloud environment.
if (!empty($_ENV["AH_SITE_ENVIRONMENT"])) {
  if (!empty($acquia_search_environment_mapping[$_ENV["AH_SITE_ENVIRONMENT"]])) {
    $core_id = $acquia_search_environment_mapping[$_ENV["AH_SITE_ENVIRONMENT"]];
  }
}
if ($core_id) {
  $core_data = $acquia_search_available_cores[$core_id];
  if ($core_data) {
    // D8 acquia_search.module
    $config['acquia_search.settings']['connection_override'] = [
      'scheme' => 'https', 
      'port' => 443,
      'host' => $core_data["host"],
      'index_id' => $core_id,
      'derived_key' => $core_data["derived_key"],
    ];
    // D7 search_api_acquia.module
    foreach ($searchapi_server_ids as $id) {
      // Add a search_api_acquia.module configuration override.
      $conf["search_api_acquia_overrides"][$id] = [
        "path" => $core_data["path"],
        "host" => $core_data["host"],
        "derived_key" => $core_data["derived_key"],
      ];
    }
    // D6/D7 apachesolr.module
    foreach ($apachesolr_environment_ids as $id) {
      // Add an apachesolr.module configuration override.
      $conf["apachesolr_environments"][$id]["url"] = "http://" . $core_data["host"] . $core_data["path"];
      $conf["apachesolr_environments"][$id]["conf"]["acquia_search_key"] = $core_data["derived_key"];
    }
    
  }
}
// End Acquia Search override code.
// DO NOT EDIT ABOVE THIS LINE =================================================
// <DDSETTINGS>
// Please don't edit anything between <DDSETTINGS> tags.
// This section is autogenerated by Acquia Dev Desktop.
if (isset($_SERVER['DEVDESKTOP_DRUPAL_SETTINGS_DIR']) && file_exists($_SERVER['DEVDESKTOP_DRUPAL_SETTINGS_DIR'] . '/cld_prod_coloradod8m_dev_default.inc')) {
  require $_SERVER['DEVDESKTOP_DRUPAL_SETTINGS_DIR'] . '/cld_prod_coloradod8m_dev_default.inc';
}
// </DDSETTINGS>

$settings['memcache']['stampede_protection'] = TRUE;
