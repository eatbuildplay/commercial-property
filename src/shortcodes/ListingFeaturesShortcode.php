<?php

namespace CommercialProperty;

class ListingFeaturesShortcode {

  public $tag = 'cp-listing-features';

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

    if( !isset( $fields['common_features'] )) {
      $common_features = false;
    } else {
      $common_features = $fields['common_features'];
    }

    $atts = shortcode_atts( array(), $atts, $this->tag );

    $template = new Template();
    $template->path = 'templates/';
    $template->name = 'listing-features';
    $template->data = array(
      'common_features' => $common_features
    );
    return $template->get();

  }

}
