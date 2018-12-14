<?php


if (isset($_ENV['AH_SITE_ENVIRONMENT'])) {
   switch ($_ENV['AH_SITE_ENVIRONMENT']) {
     case 'dev':
       $root = '/var/www/html/coloradod8mdev/docroot/';
       break;
     case 'test':
       // do something on staging
       $root = '/var/www/html/coloradod8mstg/docroot/';
       break;
     case 'prod':
       // do something on prod
       // Acquia Cloud Site Factory may require a different value depending
       // on site configuration
       $root = '/var/www/html/coloradod8m/docroot/';
       break;
     case 'ra':
       // do something on ra - necessary if a Remote Administration environment is present
       $root = '/var/www/html/coloradod8mra/docroot/';
       break;
     }
    }
    else {
    // do something for a non-Acquia-hosted application (like a local dev install).
     $root = '/Users/alfredonevarez/Sites/nexus/docroot/';
; }



$aliases['ag'] = array(
  'root' => $root,
  'uri' => 'ag.colorado.gov',
);
$aliases['ag'] = array(
  'root' => $root,
  'uri' => 'ag',
);
$aliases['cdle'] = array(
  'root' => $root,
  'uri' => 'cdle.colorado.gov',
);
$aliases['cdphe'] = array(
  'root' => $root,
  'uri' => 'cdphe.colorado.gov',
);
$aliases['ci'] = array(
  'root' => $root,
  'uri' => 'ci.colorado.gov',
);