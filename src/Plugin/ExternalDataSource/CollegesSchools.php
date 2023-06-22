<?php

namespace Drupal\umd_terp_base\Plugin\ExternalDataSource;

use Drupal\external_data_source\Plugin\ExternalDataSourceBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\umd_terp_base\UmdTerpBase;

/**
 * Provides a 'Colleges and Schools' ExternalDataSource.
 *
 * @ExternalDataSource(
 *   id = "colleges_schools",
 *   name = @Translation("Colleges and Schools"),
 *   description = @Translation("This Plugin will gather a list of UMD Colleges and Schools.")
 * )
 */
class CollegesSchools extends ExternalDataSourceBase {

  /**
   *
   * @return string
   */
  public function getPluginId() {
    return 'colleges_schools';
  }

  /**
   *
   * @return string
   */
  public function getPluginDefinition() {
    return $this->t('This Plugin will gather a list of UMD Colleges and Schools.');
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
    $data = UmdTerpBase::middleware_get_taxonomy('campusUnits');
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
