<?php

namespace Drupal\ci_migrate\Plugin\migrate\process;

use Drupal\media\Entity\Media;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\MigrateException;
use Drupal\migrate\Row;
use Drupal\migrate_plus\Plugin\migrate\process\EntityGenerate;
use Drupal\Core\Database\Database;

/**
 * Generate a media entity with specified metadata.
 *
 * This plugin is to be used by migrations which have media entity reference
 * fields.
 *
 * Available configuration keys:
 * - destinationField: the name of the file field on the media entity.
 *
 * @code
 * process:
 *   'field_files/target_id':
 *     -
 *       plugin: migration
 *       source: files
 *     -
 *       plugin: media_generate
 *       destination_field: image
 *
 * @endcode
 *
 * @MigrateProcessPlugin(
 *   id = "media_generate"
 * )
 */
class MediaGenerate extends EntityGenerate {

  /**
   * Database setup.
   *
   * @inheritdoc
   */
  protected function sourceDb(string $dbname) {
    $database_info = Database::getConnection('default', $dbname);
    return $database_info;
  }

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrateExecutable, Row $row, $destinationProperty) {
    if (!isset($this->configuration['destination_field'])) {
      throw new MigrateException('Destination field must be set.' . $value);
    }

    if (!isset($value)) {
      return;
    }

    $destination_field = $this->configuration['destination_field'];
    $bundle = $this->configuration['bundle'];
    $migration = $this->configuration['migration']; // crr_file

    $database_info = $this->sourceDb('default');
    $default_db = $database_info->getConnectionOptions()['database'];
    $query = $database_info->query("SELECT destid1 FROM migrate_map_ci_files WHERE sourceid1 = " . $value);
    $dest_value = $query->fetchCol()[0];

    // First load the target_id of the file referenced via the migration.
    /* @var /Drupal/file/entity/File $file */
    if (!$dest_value) {
      throw new MigrateException('Referenced file does not exist: ' . $dest_value);
    }

    // Create media.
    $entity_values = [
      'bundle' => $bundle,
      'uid' => '1',
      'status' => '1',
    ];
    $entity = Media::create($entity_values);
    $entity->{$this->configuration['destination_field']}->setValue($dest_value);
    $entity->save();
    $entity_id = $entity->id();
    if (!$entity_id) {
      throw new MigrateException('Referenced entity does not exist: ' . $entity_id);
    }

    return $entity_id;
  }

}