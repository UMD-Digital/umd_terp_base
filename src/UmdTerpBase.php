<?php
namespace Drupal\umd_terp_base;

use GuzzleHttp\Client;
use Drupal\Component\Serialization\Json;

/**
 * Defines a UmdTerpBase class.
 */
class UmdTerpBase
{

  /**
   *
   * Gets taxonomies/term ID's/etc from UMD Today for News.
   */
  public static function middleware_get_news($query)
  {
    $umd_terp_base_settings = \Drupal::config('umd_terp_base.settings');
    $news_api_bearer_token = $umd_terp_base_settings->get('umd_terp_base.news_api_token');
    if (!empty($news_api_bearer_token)) {
      $graphQLquery = '{"query": "query ' . $query . '"}';
      $response = (new Client)->request('post', 'https://today.umd.edu/graphql', [
        'headers' => [
          'Authorization' => 'Bearer ' . $news_api_bearer_token,
          'Content-Type' => 'application/json',
        ],
        'body' => $graphQLquery,
      ]);
      $result = Json::decode($response->getBody());
      return $result;
    } else {
      $message = 'Please set or check the UMD Today News API Bearer token on the UMD Terp modules configuration page.';
      \Drupal::logger('umd_terp_base')->alert($message);
      \Drupal::messenger()->addError($message);
      return;
    }

  }

  /**
   *
   * Gets taxonomies/term ID's/etc from UMD Calendar for Events.
   */
  public static function middleware_get_events($query)
  {
    $umd_terp_base_settings = \Drupal::config('umd_terp_base.settings');
    $calendar_api_bearer_token = $umd_terp_base_settings->get('umd_terp_base.calendar_api_token');
    if (!empty($calendar_api_bearer_token)) {
      $graphQLquery = '{"query": "query ' . $query . '"}';
      $response = (new Client)->request('post', 'https://calendar.umd.edu/graphql', [
        'headers' => [
          'Authorization' => 'Bearer ' . $calendar_api_bearer_token,
          'Content-Type' => 'application/json',
        ],
        'body' => $graphQLquery,
      ]);
      $result = Json::decode($response->getBody());
      return $result;
    } else {
      $message = 'Please set or check the UMD Today Calendar API Bearer token on the UMD Terp modules configuration page.';
      \Drupal::logger('umd_terp_base')->alert($message);
      \Drupal::messenger()->addError($message);
      return;
    }

  }

  /**
   * Taxonomy Terms, format response.
   *
   * Flatten the response and be sure all are string.
   */
  public static function middleware_format_taxonomy($response)
  {
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
   * News Taxonomy Terms, set query.
   *
   * Define the query for getting news taxonomy terms.
   */
  public static function middleware_get_news_taxonomy($taxonomy)
  {
    $query = 'getCategoriesByType { categories(group: \\"' . $taxonomy . '\\") { title id }}';
    return self::middleware_get_news($query);
  }

  /**
   * Events Taxonomy Terms, set query.
   *
   * Define the query for getting events taxonomy terms.
   */
  public static function middleware_get_events_taxonomy($taxonomy)
  {
    $query = 'getCategoriesByType { categories(group: \\"' . $taxonomy . '\\") { title id }}';
    return self::middleware_get_events($query);
  }

}