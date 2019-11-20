<?php

namespace Drupal\umd_terp_base\Plugin\ExternalDataSource;

use Drupal\external_data_source\Plugin\ExternalDataSourceBase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Provides a 'Event Types' ExternalDataSource.
 *
 * @ExternalDataSource(
 *   id = "event_types",
 *   name = @Translation("Event Types"),
 *   description = @Translation("This Plugin will gather a list of UMD Event Types.")
 * )
 */
class EventTypes extends ExternalDataSourceBase {

  /**
   *
   * @return string
   */
  public function getPluginId() {
    return 'event_types';
  }

  /**
   *
   * @return string
   */
  public function getPluginDefinition() {
    return $this->t('This Plugin will gather a list of UMD Event Types.');
  }

  /**
   * SetRequest
   * Setting sent request.
   *
   * @params Symfony\Component\HttpFoundation\Request $request
   */
  public function setRequest(Request $request) {
    $this->request = $request;
  }

  /**
   * GetRequest
   * getting sent request.
   *
   * @return \Symfony\Component\HttpFoundation\Request $request
   */
  public function getRequest() {
    return $this->request;
  }

  /**
   * GetResponse
   * Call WS to retrieve data.
   *
   * @return array
   */
  public function getResponse() {
    $data = _umd_terp_base_middleware_taxonomy('event_type');
    return $this->formatResponse($data);
  }

  /**
   * FormatResponse.
   *
   * @param array $response
   *   Formatting data retrieved from ws to match [{"value":"","label":""},
   *   {"value":"", "label":""}] return array $collection retrieved suggestions.
   *
   * @return array $collection
   */
  public function formatResponse(array $response) {
    $collection = [];
    foreach ($response['data']['taxonomy']['data'] as $entry) {
      // Workaround to set as a text string, as a bug prevents from setting simply a number, even as string.
      $collection[] = [
        'value' => $entry['tid'],
        'label' => $entry['name'],
      ];
    }
    return $collection;
  }

}
