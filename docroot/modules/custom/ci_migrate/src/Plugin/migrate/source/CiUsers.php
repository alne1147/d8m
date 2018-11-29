<?php

/**
 * @file
 * Contains \Drupal\ci_migrate\Plugin\migrate\source\CiUsers.
 */

namespace Drupal\ci_migrate\Plugin\migrate\source;

use Drupal\migrate\Row;
use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\Core\Database\Database;
use Drupal\file\Entity\File;
use Drupal\migrate\Plugin\MigrationInterface;

/**
 * @MigrateSource(
 *   id = "ci_users",
 *   source_module = "ci_migrate"
 * )
 */
class CiUsers extends SqlBase {

  /**
   * @inheritdoc
   */
  public function query() {
    $keys = ['uid', 'name', 'mail', 'status', 'init', 'created', 'first_name', 'last_name'];
    $query = $this->select('user', 'u');
    $query->fields('u', $keys);
	// $config = \Drupal::config('system.site');
	// $query->condition('u.minisite_nids', '%' . db_like($config->get('minisite_nid')) . '%', 'LIKE');
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
    $uid = $row->getSourceProperty('uid');
    return parent::prepareRow($row);
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'uid' => [
        'type' => 'integer',
        'alias' => 'u',
      ],
    ];
  }

}
