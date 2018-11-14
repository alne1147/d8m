<?php

use Drupal\ci_migrate\Controller\DbMove;

/**
* @file Contains the code to generate the custom drush commands.
*/
/**
* Implements hook_drush_command().
*/
function ci_migrate_drush_command() {
 $items = array();
 $items['cietl'] = [
   'arguments' => [],
   'drupal dependencies' => ['ci_migrate'],
   'aliases' => ['cietl'],
 ];
 return $items;
}

function drush_ci_migrate_cietl() {
  $import = new DbMove();
  $import->etl();
  return drush_print('ETL done!');
}