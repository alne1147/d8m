<?php
    // Memcache settings
    $settings['cache']['bins']['bootstrap'] = 'cache.backend.memcache';
    $settings['cache']['bins']['discovery'] = 'cache.backend.memcache';
    $settings['cache']['bins']['config'] = 'cache.backend.memcache';
    // Use memcache as the default bin
    $settings['cache']['default'] = 'cache.backend.memcache';
}
$conf['acquia_purge_http'] = FALSE;
$conf['acquia_purge_https'] = TRUE;