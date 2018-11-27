<?php

/**
 * @file
 * Contains \Drupal\ci_migrate\Plugin\migrate\source\CiNodes.
 */

namespace Drupal\ci_migrate\Plugin\migrate\source;

use Drupal\migrate\Row;
use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\Core\Database\Database;
use Drupal\file\Entity\File;

/**
 * @MigrateSource(
 *   id = "ci_nodes"
 * )
 */
class CiNodes extends SqlBase {

  /**
   * Database setup.
   *
   * @inheritdoc
   */
  protected function sourceDb(string $dbname) {
    $database_info = Database::getConnection('default', $dbname);
    return $database_info;
  }

  protected function getFields() {
    return ['nid', 'type', 'dest_type', 'title', 'body', 'teaser', 'alias', 'uid', 'status', 'language', 'created', 'changed','minisite_nids','files','images','banner_link','image_link','block_opts','optional_link','event_date','footer_link','text_area_type_tid','minisite','driving_url','driving_cat_tid','executive_office_tid','state_agency_tid','social_link','minisite_social_link'];
  }

  /**
   * @inheritdoc
   */
  public function query() {
    $keys = $this->getFields();
    $query = $this->select('node', 'n');
    $query->fields('n', $keys);
	$config = \Drupal::config('system.site');
	$query->condition('n.minisite_nids', '%' . db_like($config->get('minisite_nid')) . '%', 'LIKE');
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $keys = $this->getFields();
    foreach ($keys as $key) {
      $fields[$key] = ucfirst(str_replace(['_'], [' '], $key));
    }
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $nid = $row->getSourceProperty('nid');
    
    return $row;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'nid' => [
        'type' => 'integer',
        'alias' => 'n',
      ],
    ];
  }

}
