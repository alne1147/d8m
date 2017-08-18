<?php

/**

 * @file

 * Contains \Drupal\ci_theme_options\Form\ci_themeConfigForm.

 */

namespace Drupal\ci_theme_options\Form;

use Drupal\Core\Form\ConfigFormBase;

use Drupal\Core\Form\FormStateInterface;

class CiThemeConfigForm extends ConfigFormBase {

    /**

     * {@inheritdoc}

     */

    public function getFormId() {

        return 'ci_theme_options_config_form';

    }

    /**

     * {@inheritdoc}

     */

    public function buildForm(array $form, FormStateInterface $form_state) {

        $form = parent::buildForm($form, $form_state);

        $config = $this->config('ci_theme_options.settings');

        $form['nav_color'] = array(
            '#type' => 'jquery_colorpicker',
            '#title' => t('Nav Color'),
            '#description' => 'Choose a Color. The default value is #5c666f',
            '#default_value' => $config->get('ci_theme_options.nav_color'),
        );

        return $form;

    }

    /**

     * {@inheritdoc}

     */

    public function submitForm(array &$form, FormStateInterface $form_state) {

        $config = $this->config('ci_theme_options.settings');

        $config->set('ci_theme_options.nav_color', $form_state->getValue('nav_color'));

        $config->save();

        return parent::submitForm($form, $form_state);

    }

    /**

     * {@inheritdoc}

     */

    protected function getEditableConfigNames() {

        return [

            'ci_theme_options.settings',

        ];

    }

}