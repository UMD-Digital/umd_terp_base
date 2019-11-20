<?php

namespace Drupal\ut_sidebar_menu\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\NestedArray;

/**
 * UMD Terp Sidebar Menu Block.
 *
 * @Block(
 *   id = "umd_terp_sidebar_menu",
 *   admin_label = @Translation("UMD Terp Sidebar Menu Block")
 * )
 */
class UmdTerpSidebarMenu extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = NestedArray::mergeDeep($this->defaultConfiguration(), $this->configuration);

    $form = parent::blockForm($form, $form_state);

    $form['menu_name'] = [
      '#type' => 'select',
      '#title' => t('Menu'),
      '#default_value' => $config['menu_name'],
      '#options' => menu_ui_get_menus(),
      '#description' => t('The menus available to place links in for this content type.'),
    ];

    $form['show_parent'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('<strong>Show parent item.</strong>'),
      '#default_value' => $config['show_parent'],
      '#description' => $this->t('All menu links that have children will "Show as expanded".'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['menu_name'] = $form_state->getValue('menu_name');
    $this->configuration['show_parent'] = $form_state->getValue('show_parent');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Enable url-wise caching.
    $build = [
      '#cache' => [
        'contexts' => ['url'],
      ],
    ];

    $menu_name = $this->configuration['menu_name'];
    $show_parent = $this->configuration['show_parent'];

    $menu_tree = \Drupal::menuTree();
    $menu_link_manager = \Drupal::service('plugin.manager.menu.link');

    // This one will give us the active trail in *reverse order*.
    // Our current active link always will be the first array element.
    $parameters   = $menu_tree->getCurrentRouteMenuTreeParameters($menu_name);
    $active_trail = array_keys($parameters->activeTrail);

    // But actually we need its parent.
    // Except for <front>. Which has no parent.
    $parent_link_id = isset($active_trail[1]) ? $active_trail[1] : $active_trail[0];

    // Having the parent now we set it as starting point to build our custom tree.
    $parameters->setRoot($parent_link_id);
    $parameters->setMaxDepth(2);
    $parameters->excludeRoot();
    $tree = $menu_tree->load($menu_name, $parameters);

    // Optional: Native sort and access checks.
    $manipulators = [
      ['callable' => 'menu.default_tree_manipulators:checkNodeAccess'],
      ['callable' => 'menu.default_tree_manipulators:checkAccess'],
      ['callable' => 'menu.default_tree_manipulators:generateIndexAndSort'],
    ];
    $tree = $menu_tree->transform($tree, $manipulators);

    // Finally, build a renderable array.
    $menu = $menu_tree->build($tree);

    // Set custom theme in order to template.
    $menu['#theme'] = 'umd_terp_sidebar_menu__main';

    // Pass template, parent, and rendered menu.
    $build['#markup'] = \Drupal::service('renderer')->render($menu);

    if ($show_parent) {
      // Get parent link title and URL to display as "back link". Manually set Home for first level pages.
      $parent = [];
      if (isset($parent_link_id) && $parent_link_id !== NULL && $parent_link_id !== '') {
        $parent['#title'] = $menu_link_manager->createInstance($parent_link_id)->getTitle();
        $url_obj = $menu_link_manager->createInstance($parent_link_id)->getUrlObject();
        $parent['#link'] = $url_obj->toString();
      }
      else {
        $parent['#title'] = 'Home';
        $parent['#link'] = '/';
      }
      $build['#parent'] = $parent;
    }

    return $build;

  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'menu_name' => 'main',
      'show_parent' => 1,
    ];
  }

}
