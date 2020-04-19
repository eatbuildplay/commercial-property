<?php

$pro = new \CommercialProperty\Property();
$pro->setPost( $property );
$mainImage = get_field('main_image', $property->ID);

?>

<div class="property-list-item-wrap">
  <a href="<?php print get_permalink( $property->ID ); ?>">
    <div class="property-list-item">
      <?php if( $mainImage ) : ?>
        <div class="property-list-image-wrap">
          <img src="<?php print $mainImage['sizes']['large']; ?>" />
        </div>
      <?php endif; ?>
      <h2><?php print $property->post_title; ?></h2>
      <h4 class="price"><?php print $pro->getPriceString(); ?></h4>
    </div>
  </a>
</div>
