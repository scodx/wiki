<?php

namespace Drupal\wiki\Services;


class Search {

  /**
   * Performs a search query to the wikipedia API
   * @param $query
   *
   * @return mixed
   */
  public function doSearch($query) {
    $data = [];
    if ($query !== '') {
      $client = \Drupal::httpClient();
      $request = $client->get('https://en.wikipedia.org/w/api.php?action=opensearch&search='. $query);
      // Since the result is in opensearch format we must convert it for a better readability
      $data = $this->prepareOpenSearch(json_decode($request->getBody()));
    }
    return [
      'query' => $query,
      'count' => count($data),
      'data' => $data,
    ];
  }


  /**
   * Converts an array from opensearch format to a more generic one for easer
   * use
   *
   * @param $openSearch
   *
   * @return array
   */
  public function prepareOpenSearch($openSearch) {
    $results = [];
    foreach ($openSearch[1] as $i => $title) {
      $results[$i] = [
        'title' => $title,
        'extract' => $openSearch[2][$i],
        'link' => $openSearch[3][$i],
      ];
    }
    return $results;
  }


}
