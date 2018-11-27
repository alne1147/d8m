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
    return ['nid', 'type', 'dest_type', 'title', 'body', 'teaser', 'alias', 'uid', 'status', 'language', 'field_upload', 'field_image', 'field_video', 'field_subhead', 'field_short_title', 'field_related_content', 'field_feature_banner', 'field_issues', 'field_region', 'field_work', 'field_state', 'field_status', 'field_owner', 'field_link', 'field_thumb', 'field_cases', 'field_job_title', 'field_roles', 'field_expertise', 'field_profile_title'];
  }

  /**
   * @inheritdoc
   */
  public function query() {
    $keys = $this->getFields();
    $query = $this->select('node', 'n');
    $query->fields('n', $keys);
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
    $row->setDestinationProperty('bundle', $row->getSourceProperty('dest_type'));
    $row->setDestinationProperty('default_bundle', $row->getSourceProperty('dest_type'));
    $row->setDestinationProperty('type', $row->getSourceProperty('dest_type'));

    // Related, Cases Content.
    $relation_fields = ['field_related_content', 'field_cases', 'field_upload'];
    foreach ($relation_fields as $field) {
      $table = ($field == 'field_upload') ? 'file' : 'nodes';
      $source = $row->getSourceProperty($field);
      $source_ids = [];
      if (strlen($source)) {
        foreach (explode(',', $source) as $sourceid1) {
          $database_info = $this->sourceDb('default');
          $target_id = $database_info->query('SELECT destid1 FROM migrate_map_ci_' . $table . ' WHERE sourceid1 = :sourceid1', array(':sourceid1' => $sourceid1))->fetchCol()[0];
          $source_ids[] = ['target_id' => $target_id];
        }
        if (strlen($source_ids[0]['target_id'])) {
          $row->setSourceProperty($field, $source_ids);
        }
      }
    }

    // Taxonomy
    $vocs = [1 => 'field_publication_document_type', 2 => 'field_issue', 3 => 'field_region', 4 => 'field_new_ty', 5 => 'field_work', 6 => 'field_profile_title'];
    $maps = [1 => 'migrate_map_publication_document', 2 => 'migrate_map_issues', 3 => 'migrate_map_regions', 4 => 'migrate_map_news_types', 5 => 'migrate_map_work_types', 6 => 'migrate_map_profile_types'];
    foreach ($vocs as $vid => $field) {
      $tids = [];
      $database_info = $this->sourceDb('migrate');
      $result = $database_info->query('SELECT distinct tn.tid FROM term_node tn LEFT JOIN term_data td ON tn.tid = td.tid WHERE td.vid = :vid AND tn.nid = :nid', array(':vid' => $vid, ':nid' => $nid));
      foreach ($result as $record) {
        if (!is_null($record->tid)) {
          $database_info = $this->sourceDb('default');
          $default_db = $database_info->getConnectionOptions()['database'];
          $tid_lookup = $database_info->query('SELECT distinct destid1 FROM ' . $default_db . '.' . $maps[$vid] . ' WHERE sourceid1 = :tid', array(':tid' => $record->tid));
          foreach ($tid_lookup as $t) {
            $tids[] = ['target_id' => $t->destid1];
          }
        }
      }
      $row->setSourceProperty($field . '_tids', $tids);
    }

    // Case fields
    $field_state = $row->getSourceProperty('field_state');
    if (strlen($field_state)) {
      // Get state, status, owner values from content_type_case by nid.
      $database_info = $this->sourceDb('migrate');
      $case_details = $database_info->query('
        SELECT field_status_value, field_owner_value, field_state_value
        FROM content_type_case
        WHERE nid = :nid', array(':nid' => $nid))->fetchAll();

      if ($case_details[0]->field_owner_value) {
        $database_info = $this->sourceDb('default');
        $default_db = $database_info->getConnectionOptions()['database'];
        $owner_nid = $database_info->query('
        SELECT nid FROM ' . $default_db . '.node_field_data WHERE type = :type AND title = :title', array(':type' => 'owner', ':title' => $case_details[0]->field_owner_value))->fetchAll();
        $row->setSourceProperty('field_owner_nid', [$owner_nid[0]->nid]);
      }

      if ($case_details[0]->field_state_value) {
        $properties = ['name' => $case_details[0]->field_state_value];
        $state_term = \Drupal::entityManager()->getStorage('taxonomy_term')->loadByProperties($properties);
        $row->setSourceProperty('field_state_tid', array_keys($state_term));
      }

      if ($case_details[0]->field_status_value) {
        $properties = ['name' => $case_details[0]->field_status_value];
        $status_term = \Drupal::entityManager()->getStorage('taxonomy_term')->loadByProperties($properties);
        $row->setSourceProperty('field_status_tid', array_keys($status_term));
      }
    }

    // Media image fields
    foreach (['field_thumb', 'field_feature_banner', 'field_image'] as $field) {
      $value = $row->getSourceProperty($field);
      if (strlen($value)) {
        $row->setSourceProperty($field, ['fid' => $value]);
      }
    }

    // Roles field
    if (strlen($row->getSourceProperty('field_roles'))) {
      $roles = $row->getSourceProperty('field_roles');
      if (strpos($roles, ',') === FALSE) {
        return $roles;
      } else {
        $roles_arr = explode(',', $roles);
        foreach ($roles_arr as $role) {
          $roles_values[] = ['value' => $role];
        }
      }
      $row->setSourceProperty('field_roles_vals', $roles_values);
    }

    // Link field
    if ($row->getSourceProperty('field_link')) {
      $field_links = $row->getSourceProperty('field_link');
      $links_arr = explode('~', $field_links);
      foreach ($links_arr as $key => $value) {
        $links_exp = explode('|', $value);
        $field_link_arr[$key] = ['url' => $links_exp[0], 'title' => $links_exp[1]];
      }
      $row->setSourceProperty('field_link_arr', $field_link_arr);
    }
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
