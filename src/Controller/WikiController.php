<?php

namespace Drupal\wiki\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for the salutation message.
 */
class WikiController extends ControllerBase {

  /**
   * Route content callback.
   *
   * @return array
   *   Render array.
   */
  public function landingPage($query) {
    $result = $query;
    d($query);
    echo $query;
    die();
    return [
      '#theme' => 'wiki',
      'result' => $result,
    ];
  }

}



