<?php

namespace CommercialProperty;

class Property {

  public $post;

  public function setPost( $post ) {
    $this->post = $post;
  }

  public function getPriceString() {

    $propertyId = $this->post->ID;
    $fields = get_fields( $propertyId );

    $listingType = $fields['listing_type']['value'];

    if( $listingType == 'sale' ) {
      $price = 'Purchase for $' . number_format( $fields['price'] );
    }

    if( $listingType == 'lease' ) {
      $priceTerm = $fields['price_term'];
      if( $price_term['value'] == 'annual' ) {
        $term = 'per year';
      } else {
        $term = 'per month';
      }
      $price = 'Lease for $' . number_format( $fields['price'] ) . ' ' . $term . '.';
    }

    return $price;

  }

}
