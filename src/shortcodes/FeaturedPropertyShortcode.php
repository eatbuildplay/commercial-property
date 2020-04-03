<?php

namespace CommercialProperty;

class FeaturedPropertyShortcode {

  public $tag = 'cp-featured-property';

  public function __construct() {

    add_action('init', array( $this, 'init'));

  }

  public function init() {
    add_shortcode($this->tag, array($this, 'doShortcode'));
  }

  public function doShortcode( $atts ) {

    $atts = shortcode_atts( array(), $atts, $this->tag );

    // get properties
    $properties = $this->fetchFeaturedProperties();

    $template = new Template();
    $template->path = 'templates/';
    $template->name = 'featured-property-list';
    $template->data = [
      'properties' => $properties
    ];
    $content = $template->get();

    return $content;

  }

  public function fetchFeaturedProperties() {

    $queryArgs = [
      'numberposts' => 10,
      'post_type'   => 'property',
      'meta_query'  => array(
        'relation' => 'AND',
        array(
          'key'	  	=> 'homepage_feature',
          'value'	  => 1,
          'compare' => '=',
        )
      )
    ];

    $posts = get_posts( $queryArgs );

    return $posts;

  }

}
