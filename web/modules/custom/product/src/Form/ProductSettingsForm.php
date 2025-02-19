<?php

namespace Drupal\product\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ConfigForm.
 *
 * Configuration form for a product entity type.
 */
class ProductSettingsForm extends ConfigFormBase
{

  /**
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'product.settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string
  {
    return 'product_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return [
      static::SETTINGS,
    ];
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array
  {
    $config = $this->config(static::SETTINGS);

    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title of the block'),
      '#default_value' => $config->get('title'),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Email'),
      '#default_value' => $config->get('email'),
      '#placeholder' => $this->t('Example account1@gmail.com,account2@gmail.com'),
      '#description' => $this->t('Comma separated emails to receive the Product of the Day report.'),
    ];

    $form['actions'] = [
      '#type' => 'actions',
      'submit' => [
        '#type' => 'submit',
        '#value' => $this->t('Save'),
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void
  {
    // Retrieve the configuration.
    $this->config(static::SETTINGS)
      ->set('title', $form_state->getValue('title'))
      ->set('email', $form_state->getValue('email'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}
