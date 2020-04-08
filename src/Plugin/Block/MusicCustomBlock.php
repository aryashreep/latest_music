<?php

namespace Drupal\latest_music\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;

/**
 *
 * @Block(
 *  id = "music_custom_block",
 *  admin_label = @Translation("Music Block"),
 * )
 */
class MusicCustomBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {    
    // Getting all Music content.
    $entityQuery = \Drupal::entityQuery('node');
    $nids = $entityQuery->condition('type', 'music')
      ->condition('status', 1)
      ->range(0, 5) 
      ->execute();
    $nodes = Node::loadMultiple($nids);
    return [
      '#theme' => 'latest_music_block',
      '#nodes' => $nodes,
    ];
  }
}