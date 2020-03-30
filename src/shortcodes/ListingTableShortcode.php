<?php

namespace CommercialProperty;

class ListingTableShortcode {

  public $tag = 'cp-listing-table';

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
    $template->name = 'listing-table-widget';
    $template->data = array();
    return $template->get();

  }

}
