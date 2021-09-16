<?php

namespace Drupal\umd_terp_base\Utility;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * {@inheritdoc}
 */
class UmdTerpBaseConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'umd_terp_base_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $config = $this->config('umd_terp_base.settings');
    $form['help_text'] = [
      '#markup' => '<p>This page holds any needed configuration for UMD Terp modules.</p>',
    ];

    // General settings.
    $form['umd_terp_base_api_settings'] = [
      '#type' => 'details',
      '#title' => 'API Keys and settings',
      '#open' => TRUE,
    ];

    // Bearer token for UMD Today API.
    $form['umd_terp_base_api_settings']['news_api_token'] = [
      '#type' => 'textfield',
      '#title' => t('UMD Today News API Bearer token'),
      '#default_value' => $config->get('umd_terp_base.news_api_token'),
      '#description' => t('Please contact digital-admin@umd.edu to get a bearer token for your site.'),
    ];

    return $form;

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('umd_terp_base.settings');
    $config->set('umd_terp_base.news_api_token', $form_state->getValue('news_api_token'));
    $config->save();
    return parent::submitForm($form, $form_state);

  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'umd_terp_base.settings',
    ];
  }

}
