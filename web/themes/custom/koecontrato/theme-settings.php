<?php

use Drupal\Component\Utility\Html;
use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\ThemeSettingsForm;
use Drupal\file\Entity\File;
use Drupal\Core\Url;

function koecontrato_form_system_theme_settings_alter(&$form, \Drupal\Core\Form\FormStateInterface $form_state) {
  $form['#attached']['library'][] = 'koecontrato/koecontrato-admin';

  $form['core'] = [
    '#type' => 'vertical_tabs',
    '#attributes' => ['class' => ['entity-meta']],
    '#weight' => -899,
  ];

  $form['theme_settings']['#group'] = 'core';
  $form['logo']['#group'] = 'core';
  $form['favicon']['#group'] = 'core';

  $form['theme_settings']['#open'] = FALSE;
  $form['logo']['#open'] = FALSE;
  $form['favicon']['#open'] = FALSE;

  $form['options'] = [
    '#type' => 'vertical_tabs',
    '#attributes' => ['class' => ['entity-meta']],
    '#weight' => -999,
    '#default_tab' => 'edit-variables',
    '#states' => [
      'invisible' => [
        ':input[name="force_subtheme_creation"]' => ['checked' => TRUE],
      ],
    ],
  ];
  if (isset($form_id)) {
    return;
  }
   $form['#submit'][] = 'koecontrato_form_system_theme_settings_submit';
}
