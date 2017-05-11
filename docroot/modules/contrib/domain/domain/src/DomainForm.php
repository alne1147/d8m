<?php

namespace Drupal\domain;

use Drupal\Core\Config\ConfigValueException;
use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Render\RendererInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Base form for domain edit forms.
 */
class DomainForm extends EntityForm {

  /**
   * The domain entity storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $storage;

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * The domain validator.
   *
   * @var \Drupal\domain\DomainValidatorInterface
   */
  protected $validator;

  /**
   * The domain creator.
   *
   * @var \Drupal\domain\DomainCreatorInterface
   */
  protected $creator;

  /**
   * Constructs a DomainForm object.
   *
   * @param \Drupal\Core\Entity\EntityStorageInterface $storage
   *   The entity type manager.
   * @param \Drupal\Core\Render\RendererInterface $renderer
   *   The renderer.
   * @param \Drupal\domain\DomainValidatorInterface $validator
   *   The domain validator.
   * @param \Drupal\domain\DomainCreatorInterface $creator
   *   The domain creator.
   */
  public function __construct(EntityStorageInterface $storage, RendererInterface $renderer, DomainValidatorInterface $validator,DomainCreatorInterface $creator) {
    $this->storage = $storage;
    $this->renderer = $renderer;
    $this->validator = $validator;
    $this->creator = $creator;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager')->getStorage('domain'),
      $container->get('renderer'),
      $container->get('domain.validator'),
      $container->get('domain.creator')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);
    /** @var \Drupal\domain\Entity\Domain $domain */
    $domain = $this->entity;
    $count_existing = $this->storage->getQuery()->count()->execute();
    // Create defaults if this is the first domain.
    if (!$count_existing) {
      $domain->addProperty('hostname', $this->creator->createHostname());
      $domain->addProperty('name', $this->config('system.site')->get('name'));
    }
    $form['domain_id'] = array(
      '#type' => 'value',
      '#value' => $domain->getDomainId(),
    );
    $form['hostname'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Hostname'),
      '#size' => 40,
      '#maxlength' => 80,
      '#default_value' => $domain->getCanonical(),
      '#description' => $this->t('The canonical hostname, using the full <em>subdomain.example.com</em> format. Leave off the http:// and the trailing slash and do not include any paths.<br />If this domain uses a custom http(s) port, you should specify it here, e.g.: <em>subdomain.example.com:1234</em><br />The hostname may contain only lowercase alphanumeric characters, dots, dashes, and a colon (if using alternative ports).'),
    );
    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $domain->id(),
      '#machine_name' => array(
        'source' => array('hostname'),
        'exists' => array($this->storage, 'load'),
      ),
    );
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#size' => 40,
      '#maxlength' => 80,
      '#default_value' => $domain->label(),
      '#description' => $this->t('The human-readable name is shown in domain lists and may be used as the title tag.'),
    );
    // Do not use the :// suffix when storing data.
    $add_suffix = FALSE;
    $form['scheme'] = array(
      '#type' => 'radios',
      '#title' => $this->t('Domain URL scheme'),
      '#options' => array('http' => 'http://', 'https' => 'https://'),
      '#default_value' => $domain->getScheme($add_suffix),
      '#description' => $this->t('This URL scheme will be used when writing links and redirects to this domain and its resources.'),
    );
    $form['status'] = array(
      '#type' => 'radios',
      '#title' => $this->t('Domain status'),
      '#options' => array(1 => $this->t('Active'), 0 => $this->t('Inactive')),
      '#default_value' => (int) $domain->status(),
      '#description' => $this->t('"Inactive" domains are only accessible to user roles with that assigned permission.'),
    );
    $form['weight'] = array(
      '#type' => 'weight',
      '#title' => $this->t('Weight'),
      '#delta' => $count_existing + 1,
      '#default_value' => $domain->getWeight(),
      '#description' => $this->t('The sort order for this record. Lower values display first.'),
    );
    $form['is_default'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Default domain'),
      '#default_value' => $domain->isDefault(),
      '#description' => $this->t('If a URL request fails to match a domain record, the settings for this domain will be used. Only one domain can be default.'),
    );
    $required = $this->validator->getRequiredFields();
    foreach ($form as $key => $element) {
      if (in_array($key, $required)) {
        $form[$key]['#required'] = TRUE;
      }
    }
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    /** @var \Drupal\domain\DomainInterface $entity */
    $entity = $this->entity;
    $hostname = $entity->getHostname();
    $errors = $this->validator->validate($hostname);
    if (!empty($errors)) {
      // Render errors to display as message.
      $message = [
        '#theme' => 'item_list',
        '#items' => $errors,
      ];
      $message = $this->renderer->renderPlain($message);
      $form_state->setErrorByName('hostname', $message);
    }
    // Validate if the same hostname exists.
    // Do not use domain loader because it may change hostname.
    $existing = $this->storage->loadByProperties(['hostname' => $hostname]);
    $existing = reset($existing);
    // If we have already registered a hostname, make sure we don't create a duplicate.
    // We cannot check id() here, as the machine name is editable.
    if ($existing && $existing->getDomainId() != $entity->getDomainId()) {
      $form_state->setErrorByName('hostname', $this->t('The hostname is already registered.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $status = parent::save($form, $form_state);
    if ($status == SAVED_NEW) {
      drupal_set_message($this->t('Domain record created.'));
    }
    else {
      drupal_set_message($this->t('Domain record updated.'));
    }
    $form_state->setRedirect('domain.admin');
  }

}