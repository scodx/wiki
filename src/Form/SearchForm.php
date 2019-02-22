<?php

namespace Drupal\wiki\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class SearchForm extends FormBase {

  public function getFormId() {
    return 'wiki_search_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['description'] = [
      '#type' => 'item',
      '#markup' => $this->t('Search wikipedia from here! No need to go to www.wikipedia.com!'),
    ];

    $form['query'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Search for:'),
      '#description' => $this->t('What do you want to search?.'),
      '#required' => TRUE,
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Search'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $query = $form_state->getValue('query');
    // Simple validation for the query
    if (strlen(trim($query)) === '') {
      $form_state->setErrorByName('query', $this->t('The query must not be empty.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // So it turns out it is a little bit complicated to change and process a
    // form tu use the GET method, or at least couldn't find a easy way to do it.
    // So what I did is jus redirect to another route with the query passed
    $query = $form_state->getValue('query');
    $form_state->setRedirect('wiki.search_results', ['query' => $query]);
    return;
  }

}
