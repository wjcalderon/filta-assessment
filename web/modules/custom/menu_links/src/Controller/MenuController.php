<?php

namespace Drupal\menu_links\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Defines a route controller for a form for menu link content entity creation.
 */
class MenuController extends ControllerBase
{
  public function getParentImage($menu_item_id)
  {
    $imageUrl = $this->filta_menu_item_parent_image($menu_item_id);
    if ($imageUrl) {
      return new JsonResponse(['image_url' => $imageUrl]);
    }
    return new JsonResponse(['image_url' => '']);
  }

  /**
   * Function to get the image of a parent menu item.
   */
  function filta_menu_item_parent_image($menuItemId)
  {
    $menuLinkStorage = \Drupal::entityTypeManager()->getStorage('menu_link_content');
    $parent_item = $menuLinkStorage->load($menuItemId);

    if ($parent_item) {
      // Get the image of the parent item
      $fieldImage = $parent_item->get('field_image');
      if ($fieldImage) {
        $mediaId = $fieldImage?->entity?->id();
        $media = \Drupal::entityTypeManager()
          ->getStorage('media')
          ->load($mediaId);
        return \Drupal::service('file_url_generator')->generateAbsoluteString($media?->field_media_image?->entity?->getFileUri());
      }
    }
    return NULL;
  }
}
