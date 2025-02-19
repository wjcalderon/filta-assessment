<?php

namespace Drupal\menu_links\Plugin\Block;

use Drupal\Core\Block\Attribute\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Provides a Banner Block.
 */

#[Block(
  id: "banner_block",
  admin_label: new TranslatableMarkup("Banner block"),
  category: new TranslatableMarkup("Menu links module")
)]

class BannerBlock extends BlockBase
{

  /**
   * {@inheritdoc}
   */
  public function build()
  {
    return [
      '#markup' => '<div class="banner"></div>',
    ];
  }
}
