<?php

namespace Drupal\umd_terp_base\Plugin\ExternalDataSource;

use Drupal\external_data_source\Plugin\ExternalDataSourceBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\umd_terp_base\UmdTerpBase;

/**
 * Provides a 'Events Tags' ExternalDataSource.
 *
 * @ExternalDataSource(
 *   id = "events_tags",
 *   name = @Translation("Events Tags"),
 *   description = @Translation("This Plugin will gather a list of UMD Calendar Event Tags terms.")
 * )
 */
class EventsTags extends ExternalDataSourceBase {

  /**
   *
   * @return string
   */
  public function getPluginId() {
    return 'events_tags';
  }

  /**
   *
   * @return string
   */
  public function getPluginDefinition() {
    return $this->t('This Plugin will gather a list of UMD Calendar Event Tags terms.');
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
    $data = UmdTerpBase::middleware_get_events_taxonomy('tags');
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
    $collection = UmdTerpBase::middleware_format_taxonomy($response);
    return $collection;
  }

}
