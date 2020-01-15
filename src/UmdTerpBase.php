<?php
namespace Drupal\umd_terp_base;

use GuzzleHttp\Client;
use Drupal\Component\Serialization\Json;

/**
 * Defines a UmdTerpBase class.
 */
class UmdTerpBase {

  /**
   * Custom functions for the External Data Source Plugins, and content calls to the HUB.
   *
   * Gets taxonomies/term ID's/etc from the HUB Middleware.
   */
  public static function middleware_get($query) {
    $graphQLquery = '{"query": "query { ' . $query . ' } "}';
    $response = (new Client)->request('post', 'https://umd-hub.herokuapp.com/graphql', [
      'headers' => [
        'Content-Type' => 'application/json',
      ],
      'body' => $graphQLquery,
    ]);
    $result = Json::decode($response->getBody());
    return $result;
  }

  /**
   * Taxonomy Terms, format response.
   *
   * Flatten the response and be sure all are string.
   */
  public static function middleware_format_taxonomy($response) {
    $collection = [];
    foreach ($response['data']['taxonomy']['data'] as $entry) {
      $collection[] = [
        'value' => $entry['tid'],
        'label' => $entry['name'],
      ];
    }
    return $collection;
  }

  /**
   * Taxonomy Terms, set query.
   *
   * Define the query for getting taxonomy terms.
   */
  public static function middleware_get_taxonomy($taxonomy) {
    $query = 'taxonomy(filter: {vocabulary: \"' . $taxonomy . '\"}) { data { tid name } }';
    return self::middleware_get($query);
  }

}
