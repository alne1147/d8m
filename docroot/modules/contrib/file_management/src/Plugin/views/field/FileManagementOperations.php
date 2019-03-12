<?php

namespace Drupal\file_management\Plugin\views\field;

use Drupal\views\ResultRow;
use Drupal\Core\Url;

/**
 * Renders all operations links for a file.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("file_management_operations")
 */
class FileManagementOperations extends \Drupal\views\Plugin\views\field\EntityOperations {

  /**
   * {@inheritdoc}
   */
  public function render(ResultRow $values) {
    $entity = $this->getEntityTranslation($this->getEntity($values), $values);

    $operations = [
      'edit' => [
        'title' => $this->t('Edit'),
        'url' => Url::fromRoute('file_management.edit_page', [
          'file' => $entity->id(),
        ]),
        'weight' => 1,
      ],
      'view' => [
        'title' => $this->t('View'),
        'url' => Url::fromRoute('file_management.view_page', [
          'file' => $entity->id(),
        ]),
        'weight' => 2,
      ],
    ];
    
    if ($this->options['destination']) {
      foreach ($operations as &$operation) {
        if (!isset($operation['query'])) {
          $operation['query'] = [];
        }
        $operation['query'] += $this->getDestinationArray();
      }
    }

    $build = [
      '#type' => 'operations',
      '#links' => $operations,
    ];

    return $build;
  }
}
