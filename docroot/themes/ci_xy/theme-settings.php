<?php

function ci_xy_form_system_theme_settings_alter(&$form, \Drupal\Core\Form\FormStateInterface &$form_state, $form_id = NULL) {
    // Work-around for a core bug affecting admin themes. See issue #943212.
    if (isset($form_id)) {
        return;
    }


    $form['nav_color'] = array(
        '#title' => t('Navigation Color'),
        '#type' => 'select',
        '#description' => 'Select the desired color of the Main Navigation.',
        '#options' => array(t('--- SELECT ---'), t('Red'), t('Blue'), t('Black')),
    );
}
