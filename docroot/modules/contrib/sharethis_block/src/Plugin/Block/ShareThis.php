<?php

namespace Drupal\sharethis_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;

/**
 * Provides a 'ShareThis' block which just loads javascript for the widget.
 *
 * @Block(
 *  id = "sharethis",
 *  admin_label = @Translation("sharethis"),
 * )
 */
class ShareThis extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = \Drupal::config('sharethis_block.configuration');
    if ($config->get('sharethis_inline')) {
      $build['buttons'] = [
        '#markup' => '<div class="sharethis-inline-share-buttons"></div>',
      ];
    }
    $build['#attached']['library'][] = 'sharethis_block/sharethis';
    $build['#theme'] = 'sharethis';
    return $build;
  }

}
