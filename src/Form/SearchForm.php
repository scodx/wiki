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
    if (trim($query) === '') {
      $form_state->setErrorByName('query', $this->t('The query must not be empty.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // redirecting
    $query = $form_state->getValue('query');
    $form_state->setRedirect('wiki.search_results', ['query' => $query]);
    return;
  }

}
