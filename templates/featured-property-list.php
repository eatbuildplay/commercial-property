<?php

if( !empty( $properties )) :

?>

<div class="featured-property-list-wrap">
<h2 class="section-header"><span class="section-title">Featured Properties</span></h2>

<div class="featured-property-list">

<?php
  foreach( $properties as $property ) :

    $pro = new \CommercialProperty\Property();
    $pro->setPost( $property );
    $mainImage = get_field('main_image', $property->ID);

  ?>

    <div class="property-list-item-wrap">
      <a href="<?php print get_permalink( $property->ID ); ?>">
        <div class="property-list-item">
          <?php if( $mainImage ) : ?>
            <div class="featured-image-wrap">
              <img src="<?php print $mainImage['sizes']['large']; ?>" />
            </div>
          <?php endif; ?>
          <h2><?php print $property->post_title; ?></h2>
          <h4 class="price"><?php print $pro->getPriceString(); ?></h4>
        </div>
      </a>
    </div>

  <?php endforeach; ?>

  </div>

  <a class="view-all-properties" href="<?php print site_url('/properties/'); ?>">View All Properties</a>

</div>

<?php endif; ?>
