<?php

namespace Drupal\toastr\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Custom setting form.
 *
 * @package Drupal\toastr\Form
 */
class ToastrSettingsForm extends ConfigFormBase {

  /**
   * Default settings.
   *
   * @return array
   *   An array containing default values.
   */
  public static function defaultSettings() {
    return [
      'toastr_toast_position' => 'toast-top-right',
      'toastr_toast_type' => 'info',
      'toastr_close_button' => 1,
      'toastr_progress_bar' => 1,
      'toastr_show_easing' => 'swing',
      'toastr_hide_easing' => 'linear',
      'toastr_show_method' => 'fadeIn',
      'toastr_hide_method' => 'fadeOut',
      'toastr_newest' => 0,
      'toastr_prevent_duplicate' => 0,
      'toastr_timeout' => 5000,
      'toastr_extended_timeout' => 10000,
      'toastr_show_duration' => 300,
      'toastr_hide_duration' => 1000,
      'toastr_leave_errors' => 1,
      'toastr_tap_to_dismiss' => TRUE,
    ];
  }

  /**
   * Gets the configuration names that will be editable.
   *
   * @return array
   *   An array of configuration object names that are editable if called in
   *   conjunction with the trait's config() method.
   */
  protected function getEditableConfigNames() {
    return ['toastr.settings'];
  }

  /**
   * Returns a unique string identifying the form.
   *
   * The returned ID should be a unique string that can be a valid PHP function
   * name, since it's used in hook implementation names such as
   * hook_form_FORM_ID_alter().
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'toastr_settings';
  }

  /**
   * Gets the value for the config key.
   *
   * @return array|mixed|null
   *   Fallbacks to default value if no config exists.
   */
  private function getConfigValue($key) {
    /** @var \Drupal\Core\Config\ImmutableConfig $config */
    $config = $this->config('toastr.settings');
    $default_settings = $this->defaultSettings();
    return is_null($config->get($key)) ? $default_settings[$key] : $config->get($key);
  }

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['toastr_toast_position'] = [
      '#title' => $this->t('Position'),
      '#description' => $this->t('Where on the screen would you like the notification to show?'),
      '#type' => 'select',
      '#options' => [
        'toast-top-right' => $this->t('Top Right'),
        'toast-bottom-right' => $this->t('Bottom Right'),
        'toast-top-left' => $this->t('Top Left'),
        'toast-bottom-left' => $this->t('Bottom Left'),
        'toast-top-center' => $this->t('Top Center'),
        'toast-bottom-center' => $this->t('Bottom Center'),
        'toast-top-full-width' => $this->t('Top Full Width'),
        'toast-bottom-full-width' => $this->t('Bottom Full Width'),
      ],
      '#default_value' => $this->getConfigValue('toastr_toast_position'),
    ];

    $form['toastr_toast_type'] = [
      '#title' => $this->t('Default Type'),
      '#description' => $this->t('If not provided by the module, what should be the default type of toast?'),
      '#type' => 'select',
      '#options' => [
        'success' => $this->t('Success'),
        'info' => $this->t('Info'),
        'warning' => $this->t('Warning'),
        'error' => $this->t('Error'),
      ],
      '#default_value' => $this->getConfigValue('toastr_toast_type'),
    ];

    $form['toastr_close_button'] = [
      '#title' => $this->t('Close Button'),
      '#description' => $this->t('Show a close button on each toast?'),
      '#type' => 'checkbox',
      '#default_value' => $this->getConfigValue('toastr_close_button'),
      '#return_value' => 1,
    ];

    $form['toastr_progress_bar'] = [
      '#title' => $this->t('Progress Bar'),
      '#description' => $this->t('Show a progress bar on each toast?'),
      '#type' => 'checkbox',
      '#default_value' => $this->getConfigValue('toastr_progress_bar'),
      '#return_value' => 1,
    ];

    $form['toastr_show_easing'] = [
      '#title' => $this->t('Show Easing'),
      '#description' => $this->t('Enter an easing method - <a target="_blank" href="@url">@url</a>', ['@url' => 'http://jqueryui.com/easing/']),
      '#type' => 'textfield',
      '#size' => 20,
      '#default_value' => $this->getConfigValue('toastr_show_easing'),
    ];

    $form['toastr_hide_easing'] = [
      '#title' => $this->t('Hide Easing'),
      '#description' => $this->t('Enter an easing method - <a target="_blank" href="@url">@url</a>', ['@url' => 'http://jqueryui.com/easing/']),
      '#type' => 'textfield',
      '#size' => 20,
      '#default_value' => $this->getConfigValue('toastr_hide_easing'),
    ];

    $form['toastr_show_method'] = [
      '#title' => $this->t('Show Method'),
      '#description' => $this->t('Enter valid jQuery show/hide method'),
      '#type' => 'textfield',
      '#size' => 20,
      '#default_value' => $this->getConfigValue('toastr_show_method'),
    ];

    $form['toastr_hide_method'] = [
      '#title' => $this->t('Hide Method'),
      '#description' => $this->t('Enter valid jQuery show/hide method'),
      '#type' => 'textfield',
      '#size' => 20,
      '#default_value' => $this->getConfigValue('toastr_hide_method'),
    ];

    $form['toastr_newest'] = [
      '#title' => $this->t('Newest on top'),
      '#description' => $this->t('Should the newest toasts be placed on top?'),
      '#type' => 'checkbox',
      '#default_value' => $this->getConfigValue('toastr_newest'),
      '#return_value' => 1,
    ];

    $form['toastr_prevent_duplicate'] = [
      '#title' => $this->t('Prevent Duplicates'),
      '#description' => $this->t('Duplicates are based on the exact message content?'),
      '#type' => 'checkbox',
      '#default_value' => $this->getConfigValue('toastr_prevent_duplicate'),
      '#return_value' => 1,
    ];

    $form['toastr_timeout'] = [
      '#title' => $this->t('Timeout'),
      '#description' => $this->t('How long should the toast be shown?'),
      '#type' => 'number',
      '#field_suffix' => 'ms',
      '#size' => 5,
      '#default_value' => $this->getConfigValue('toastr_timeout'),
    ];

    $form['toastr_extended_timeout'] = [
      '#title' => $this->t('Extended Timeout'),
      '#description' => $this->t('How long the toast will display after a user hovers over it?'),
      '#type' => 'number',
      '#field_suffix' => 'ms',
      '#size' => 5,
      '#default_value' => $this->getConfigValue('toastr_extended_timeout'),
    ];

    $form['toastr_show_duration'] = [
      '#title' => $this->t('Show duration'),
      '#description' => $this->t('How long the appearing process lasts'),
      '#type' => 'textfield',
      '#field_suffix' => 'ms',
      '#size' => 5,
      '#default_value' => $this->getConfigValue('toastr_show_duration'),
    ];

    $form['toastr_hide_duration'] = [
      '#title' => $this->t('Hide duration'),
      '#description' => $this->t('How long the disappearing process lasts'),
      '#type' => 'textfield',
      '#field_suffix' => 'ms',
      '#size' => 5,
      '#default_value' => $this->getConfigValue('toastr_hide_duration'),
    ];

    $form['toastr_leave_errors'] = [
      '#title' => $this->t('Do not hide error messages'),
      '#description' => $this->t('Leave error messages displayed until they are closed'),
      '#type' => 'checkbox',
      '#default_value' => $this->getConfigValue('toastr_leave_errors'),
      '#return_value' => 1,
    ];

    $form['toastr_tap_to_dismiss'] = [
      '#title' => $this->t('Tap to dismiss'),
      '#description' => $this->t('If enabled the message will disappear on tap'),
      '#type' => 'checkbox',
      '#default_value' => $this->getConfigValue('toastr_tap_to_dismiss'),
      '#return_value' => 1,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('toastr.settings');
    $elements = array_keys($this->defaultSettings());
    foreach ($elements as $element) {
      $value = $form_state->getValue($element);
      $config->set($element, $value);
    }
    $config->save();
    parent::submitForm($form, $form_state);
  }

}
