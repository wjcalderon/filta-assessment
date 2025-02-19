<?php

namespace Drupal\product\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Define a route handler to store clicks on featured products
 */
class ProductController extends ControllerBase
{
  public function saveFeaturedProduct($product_id)
  {
    try {
      \Drupal::database()->insert('product_of_the_day')
        ->fields(array(
          'product_id' => $product_id,
          'created' => time(),
        ))
        ->execute();
      return new JsonResponse(['message' => 'Product successfully saved']);
    } catch (\Exception $e) {
      \Drupal::logger('product')->error('An error occurred while saving the product of the day', ['@message' => $e->getMessage()]);
      return new JsonResponse(['error' => 'An error occurred while saving the product of the day'], 500);
    }
  }
}
