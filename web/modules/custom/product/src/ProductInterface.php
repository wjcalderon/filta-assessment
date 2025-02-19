<?php

declare(strict_types=1);

namespace Drupal\product;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a product entity type.
 */
interface ProductInterface extends ContentEntityInterface, EntityChangedInterface {

}
