<?php

if( !empty( $properties )) :

?>

<div class="featured-property-list-wrap">
<h2>Featured Properties</h2>

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
            <img src="<?php print $mainImage['sizes']['medium']; ?>" style="max-width: 100%" />
          <?php endif; ?>
          <h2><?php print $property->post_title; ?></h2>
          <h5><?php print $pro->getPriceString(); ?></h5>
        </div>
      </a>
    </div>

<?php endforeach; ?>

</div>

<button>View All Properties</button>
</div>

<?php endif; ?>