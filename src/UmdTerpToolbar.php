<?php

namespace Drupal\umd_terp_base;

use Drupal\Core\Url;
use Drupal\Core\Menu\LocalTaskManagerInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Routing\ResettableStackedRouteMatchInterface;

/**
 * An edit toolbar button service.
 */
class UmdTerpToolbar {

  use StringTranslationTrait;

  /**
   * Local links array.
   *
   * @var array
   */
  private $localLinks = [];
  /**
   * Local task manager.
   *
   * @var Drupal\Core\Menu\LocalTaskManagerInterface
   */
  private $localTaskManager;
  /**
   * Local route match.
   *
   * @var Drupal\Core\Routing\ResettableStackedRouteMatchInterface
   */
  private $routeMatch;
  /**
   * Toolbar menu items.
   *
   * @var array
   */
  private $toolbarMenuItems = [];
  /**
   * Current local tasks.
   *
   * @var array
   */
  private $currentLocalTasks;
  /**
   * Current route.
   *
   * @var array
   */
  private $currentRoute;

  /**
   * Injecting some services here.
   */
  public function __construct(LocalTaskManagerInterface $localTaskManager, ResettableStackedRouteMatchInterface $routeMatch) {
    $this->localTaskManager = $localTaskManager;
    $this->routeMatch = $routeMatch;
    $this->setCurrentLocalTasks();
    $this->setCurrentRoute();
  }

  /**
   * The adding of the edit button.
   */
  public function addEdit() {

    if (!empty($this->currentLocalTasks)) {
      if (in_array(
        $this->currentRoute,
        ['entity.taxonomy_term.canonical', 'entity.node.canonical']
      )) {
        if ($this->localTaskExists('entity.node.edit_form')) {
          $this->toolbarMenuItems['toolbar_edit'] = $this->renderableButton(
            'entity.node.edit_form'
          );
        }
        if ($this->localTaskExists('entity.taxonomy_term.edit_form')) {
          $this->toolbarMenuItems['toolbar_edit'] = $this->renderableButton(
            'entity.taxonomy_term.edit_form'
          );
        }
      }
      else {
        $this->toolbarMenuItems['toolbar_edit'] = $this->renderableButtonDummy();
      }
    }
    else {
      $this->toolbarMenuItems['toolbar_edit'] = $this->renderableButtonDummy();
    }
    return $this->toolbarMenuItems;
  }

  /**
   * The renderable array for the edit button.
   */
  private function renderableButton($route) {
    $content = $this->localLinks[$route];
    return [
      '#type' => 'toolbar_item',
      'tab' => [
        '#type' => 'link',
        '#title' => $this->t('Edit'),
        '#url' => Url::fromRoute(
          $route,
          $content['url']->getRouteParameters()
        ),
        '#attributes' => [
          'title' => $this->t('Edit'),
          'class' => [
            'toolbar-icon',
            'toolbar-icon-edit',
          ],
        ],
        '#cache' => [
          'contexts' => [
            'url.path',
          ],
        ],
      ],
      '#wrapper_attributes' => [
        'class' => ['edit-toolbar-tab'],
        'id' => 'edit-tab-button',
      ],
      '#weight' => 1000,
    ];
  }

  /**
   * The dummy renderable button for caching reasons.
   */
  private function renderableButtonDummy() {
    return [
      '#type' => 'toolbar_item',
      'tab' => [
        '#type' => 'link',
        '#title' => $this->t('Edit'),
        '#url' => Url::fromRoute('<front>'),
        '#cache' => [
          'contexts' => [
            'url.path',
          ],
        ],
      ],
      '#wrapper_attributes' => [
        'class' => ['edit-toolbar-tab', 'visually-hidden'],
        'id' => 'edit-tab-button',
      ],
      '#weight' => 1000,
    ];
  }

  /**
   * Set current local task.
   */
  private function setCurrentLocalTasks() {
    $this->currentLocalTasks = $this->localTaskManager->getLocalTasks($this->routeMatch->getRouteName(), 0);

    if (!empty($this->currentLocalTasks)) {
      foreach ($this->currentLocalTasks['tabs'] as $route => $link) {
        $this->localLinks[$route] = $link['#link'];
      }
    }
  }

  /**
   * Set current route.
   */
  private function setCurrentRoute() {
    $this->currentRoute = $this->currentLocalTasks['route_name'];
  }

  /**
   * Check if local task exists.
   */
  private function localTaskExists($localTask) {
    return in_array($localTask, array_keys($this->localLinks)) ? TRUE : FALSE;
  }

}
