<?php

declare(strict_types=1);

namespace Drupal\product;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Provides a list controller for the product entity type.
 */
final class ProductListBuilder extends EntityListBuilder
{

  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array
  {
    $header['id'] = $this->t('ID');
    $header['label'] = $this->t('Name');
    $header['created'] = $this->t('Created');
    $header['changed'] = $this->t('Updated');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity): array
  {
    /** @var \Drupal\product\ProductInterface $entity */
    $row['id'] = $entity->id();
    $row['label'] = $entity->toLink();
    $row['created']['data'] = $entity->get('created')->view(['label' => 'hidden']);
    $row['changed']['data'] = $entity->get('changed')->view(['label' => 'hidden']);
    return $row + parent::buildRow($entity);
  }
}

//drush generate module-content-entity
