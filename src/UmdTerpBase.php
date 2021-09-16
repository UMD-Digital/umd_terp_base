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
    $graphQLquery = '{"query": "query ' . $query . '"}';
    $response = (new Client)->request('post', 'https://today.umd-staging.com/graphql', [
      'headers' => [
        'Authorization' => 'Bearer IjA1JEotnCZ_HQz61Wvo5FiWGHhNC6k0',
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
    foreach ($response['data']['categories'] as $entry) {
      $collection[] = [
        'value' => $entry['id'],
        'label' => $entry['title'],
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
    $query = 'getCategoriesByType { categories(group: \\"' . $taxonomy . '\\") { title id }}';
    return self::middleware_get($query);
  }

}
