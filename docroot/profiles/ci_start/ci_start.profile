<?php

/**
 * Implements hook_form_FORM_ID_alter() for install_configure_form().
 *
 * Allows the profile to alter the site configuration form.
 */
function ci_start_form_install_configure_form_alter(&$form, FormStateInterface $form_state) {

  // Account information defaults
  $form['admin_account']['account']['name']['#default_value'] = 'd8m_admin';
  $form['admin_account']['account']['mail']['#default_value'] = 'admin@example.com';

  // Date/time settings
  $form['regional_settings']['site_default_country']['#default_value'] = 'CO';
  $form['regional_settings']['date_default_timezone']['#default_value'] = 'America/Vancouver';

}