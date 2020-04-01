<?php

namespace CommercialProperty;

class ListingFilesShortcode {

  public $tag = 'cp-listing-files';

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

    if( !isset( $fields['file_attachments'] )) {
      $files = false;
    } else {
      $files = $fields['file_attachments'];
    }

    $atts = shortcode_atts( array(), $atts, $this->tag );

    $template = new Template();
    $template->path = 'templates/';
    $template->name = 'listing-files';
    $template->data = array(
      'files' => $files
    );
    return $template->get();

  }

}
