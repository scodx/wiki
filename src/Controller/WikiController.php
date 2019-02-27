<?php

namespace Drupal\wiki\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\wiki\Services\Search;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for the wiki search.
 */
class WikiController extends ControllerBase {

  /**
   * @var \Drupal\wiki\Services\Search
   */
  protected $wikiSearch;

  /**
   * WikiController constructor.
   *
   * @param \Drupal\wiki\Services\Search $wikiSearch
   */
  public function __construct(Search $wikiSearch) {
    $this->wikiSearch = $wikiSearch;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('wiki.search')
    );
  }

  /**
   * Route content callback.
   *
   * @return array
   *   Render array.
   */
  public function search($query) {

    $form = \Drupal::formBuilder()->getForm('Drupal\wiki\Form\SearchForm');
    $form['query']['#value'] = $query;

    $result = $this->wikiSearch->doSearch($query);

    return [
      '#theme' => 'wiki',
      '#result' => $result,
      '#form' => $form,
    ];
  }

}



