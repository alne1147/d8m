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

        $form['#attached']['library'][] = 'ci_theme_options/ci_theme_options';

        $config = $this->config('ci_theme_options.settings');

        $form['nav_color'] = array(
            '#type' => 'jquery_colorpicker',
            '#title' => t('Nav Color'),
            '#description' => 'Choose a Color. The default value is #5c666f',
            '#default_value' => $config->get('ci_theme_options.nav_color'),
        );
        $form['footer_color'] = array(
            '#type' => 'jquery_colorpicker',
            '#title' => t('Footer Color'),
            '#description' => 'Choose a Color for the Footer. The default value is #5c666f',
            '#default_value' => $config->get('ci_theme_options.footer_color'),
        );

        $form['global_bg_color'] = array(
            '#type' => 'jquery_colorpicker',
            '#title' => t('Global Background Color'),
            '#description' => t('Set the site-wide default background color'),
            '#default_value' => $config->get('ci_theme_options.global_bg_color'),
        );

        $form['global_bg_image'] = array(
            '#type' => 'managed_file',
            '#title' => t('Global Background Image'),
            '#description' => t('Set the site-wide default background image'),
            '#upload_location' => 'public://files',
             '#default_value' => $config->get('ci_theme_options.global_bg_image'),
        );

        $form['bg_image_url'] = [
            '#type' => 'url',
            '#title' => $this->t('Image URL'),
            '#default_value' => $config->get('ci_theme_options.bg_image_url'),
        ];

        return $form;
        
        

    }

    /**

     * {@inheritdoc}

     */

    public function submitForm(array &$form, FormStateInterface $form_state) {

        $config = $this->config('ci_theme_options.settings');

        $config->set('ci_theme_options.nav_color', $form_state->getValue('nav_color'));
        $config->set('ci_theme_options.footer_color', $form_state->getValue('footer_color'));
        $config->set('ci_theme_options.global_bg_image', $form_state->getValue('global_bg_image'));
        $config->set('ci_theme_options.global_bg_color', $form_state->getValue('global_bg_color'));
        $config->set('ci_theme_options.bg_image_url', $form_state->getValue('bg_image_url'));

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