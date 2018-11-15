<?php

/**
 * @file
 * Contains \Drupal\ci_migrate\Plugin\migrate\source\CiFiles.
 */

namespace Drupal\ci_migrate\Plugin\migrate\source;

use Drupal\migrate\Row;
use Drupal\file\Plugin\migrate\source\d7\File;

/**
 * @MigrateSource(
 *   id = "ci_files",
 *   source_module = "file"
 * )
 */
class CiFiles extends File {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $q = parent::query();
    return $q;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    return parent::fields();
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    return parent::prepareRow($row);
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return parent::getIds();
  }

}
