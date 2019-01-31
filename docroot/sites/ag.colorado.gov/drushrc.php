<?php

if (isset($_ENV['AH_SITE_ENVIRONMENT'])) {
  switch ($_ENV['AH_SITE_ENVIRONMENT']) {
    case 'dev':
      $options['uri'] = 'https://ag.dev.colorado.gov';
      break;
    case 'test':
      $options['uri'] = 'https://ag.stg.colorado.gov';
      break;
    case 'prod':
      $options['uri'] = 'https://ag.colorado.gov';
      break;
  }
}
else {
  $options['uri'] = 'https://ag';
  ; }