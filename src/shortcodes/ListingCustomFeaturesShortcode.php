<?php

namespace CommercialProperty;

class ListingCustomFeaturesShortcode {

  public $tag = 'cp-custom-features';

  public function __construct() {
    add_action('init', array( $this, 'init'));
  }

  public function init() {
    add_shortcode($this->tag, array($this, 'doShortcode'));
  }

  public function doShortcode( $atts ) {

    global $post;
    $propertyId = $post->ID;
    $fields = get_fields( $propertyId );

    if( !isset( $fields['custom_features'] )) {
      $custom_features = false;
    } else {
      $custom_features = $fields['custom_features'];
    }

    if( empty( $custom_features )) {
      return '';
    }

    $template = new Template();
    $template->path = 'templates/';
    $template->name = 'listing-custom-features';
    $template->data = array(
      'custom_features' => $custom_features
    );
    return $template->get();

  }

}
