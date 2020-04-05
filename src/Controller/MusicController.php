<?php
/**
 * @file 
 * Contains \Drupal\common\Controller\HomeController
 */
namespace Drupal\latest_music\Controller;

use Drupal\Core\Controller\ControllerBase;

class MusicController extends ControllerBase {

  public function content(){
    return array(
      '#type' => 'markup',
      '#markup' => $this->t(''),
    );
  }

  }