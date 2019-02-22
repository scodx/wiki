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

    $form = \Drupal::formBuilder()->getForm('Drupal\wiki\Form\SearchForm');
    $form['query']['#value'] = $query;

    $searchService = \Drupal::service('wiki.search');
    $result = $searchService->doSearch($query);
    return [
      '#theme' => 'wiki',
      '#result' => $result,
      '#form' => $form,
    ];
  }

}



