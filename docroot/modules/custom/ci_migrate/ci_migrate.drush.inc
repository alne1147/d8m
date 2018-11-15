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
 $items['etlnodes'] = [
   'arguments' => [],
   'drupal dependencies' => ['ci_migrate'],
 ];
 $items['etlterms'] = [
   'arguments' => [],
   'drupal dependencies' => ['ci_migrate'],
 ];
 return $items;
}

function drush_ci_migrate_etlnodes() {
  $import = new DbMove();
  $import->etlNodes();
  return drush_print('ETL: Nodes prepare complete!');
}

function drush_ci_migrate_etlterms() {
  $import = new DbMove();
  $import->etlTerms();
  return drush_print('ETL: Terms prepare complete!');
}

function drush_ci_migrate_etlgroups() {
  $import = new DbMove();
  $import->etlTerms();
  return drush_print('ETL: Groups prepare complete!');
}
