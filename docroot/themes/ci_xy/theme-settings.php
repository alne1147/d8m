<?php


use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Theme\ThemeSettings;
use Drupal\system\Form\ThemeSettingsForm;
use Drupal\Core\Form;

function ci_xy_form_system_theme_settings_alter(&$form, \Drupal\Core\Form\FormStateInterface &$form_state, $form_id = NULL) {
    // Work-around for a core bug affecting admin themes. See issue #943212.
    if (isset($form_id)) {
        return;
    }


    # the values for the dropdown box
    $form['type_options'] = array(
        '#type' => 'value',
        '#value' => array('APPLICATION' => t('Application'),
            'DEVELOPMENT' => t('Development'),
            'ENHANCEMENT' => t('Enhancement'))
    );
    $form['type'] = array(
        '#title' => t('Project Type'),
        '#type' => 'select',
        '#description' => "Select the project count type.",
        '#default_value' => theme_get_setting('type'),
        '#options' => $form['type_options']['#value'],
    );

    $form['element'] = array(
        '#type' => 'jquery_colorpicker',
        '#title' => t('Color'),
        '#default_value' => 'FFFFFF',
    );

}
