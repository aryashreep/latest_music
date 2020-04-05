<?php

namespace Drupal\latest_music\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;

/**
 *
 * @Block(
 *  id = "albums_custom_block",
 *  admin_label = @Translation("Music Block"),
 * )
 */
class MusicCustomBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {    
    // Getting all Albums content.
    $entityQuery = \Drupal::entityQuery('node');
    $nids = $entityQuery->condition('type', 'music')
      ->condition('status', 1)    
      ->execute();
    $nodes = Node::loadMultiple($nids);
    return [
      '#theme' => 'latest_music_block',
      '#nodes' => $nodes,
      //'#cache' => array('max-age' => 0),
	  //'#cache' => ['contexts' => ['url.path', 'url.query_args']]
    ];
  }
}