<?php

namespace CommercialProperty;

class ListingPriceShortcode {

  public $tag = 'cp-listing-price';

  public function __construct() {
    add_action('init', array( $this, 'init'));
  }

  public function init() {
    add_shortcode($this->tag, array($this, 'doShortcode'));
  }

  public function doShortcode( $atts ) {

    $atts = shortcode_atts( array(), $atts, $this->tag );

    $template = new Template();
    $template->path = 'templates/';
    $template->name = 'listing-price';
    $template->data = array();
    return $template->get();

  }

}
