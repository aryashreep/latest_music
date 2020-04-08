<?php
/**
 * @file 
 * Contains \Drupal\common\Controller\HomeController
 */
namespace Drupal\latest_music\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Render\FormattableMarkup;
use Drupal\Core\Entity\EntityFieldManagerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Entity\Query\QueryFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MusicController extends ControllerBase {
  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  public function content(){
    // Select the nodes we want to show. i.e. 3 published articles.
    $nids = \Drupal::entityQuery('node')
    ->condition('type', 'music')
    ->condition('status', 1)
    ->sort('created', 'DESC')
    ->pager(5)
    ->execute();
    
    $nodes = \Drupal\node\Entity\Node::loadMultiple($nids);    
    
    foreach ($nodes as $node) {
      $output[] = \Drupal::entityTypeManager()->getViewBuilder('node')->view($node, 'teaser');
    }

    $results = array(
      '#markup' => render($output),  // Raw HTML code in  $output
    );
    $results[] = array(
      '#type' => 'pager',
    );
    
    return $results;
  }
}