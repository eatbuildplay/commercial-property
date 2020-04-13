<?php

namespace CommercialProperty;

class PropertyListMapShortcode {

  public $tag = 'cp-property-list-map';

  public function __construct() {

    add_action('init', array( $this, 'init'));

  }

  public function init() {
    add_shortcode($this->tag, array($this, 'doShortcode'));
  }

  public function doShortcode( $atts ) {

    $atts = shortcode_atts( array(), $atts, $this->tag );

    // get properties
    $propertyPosts = $this->fetchProperties();
    $properties = [];
    foreach( $propertyPosts as $post ) {
      $property = new \stdClass;
      $property->post = $post;
      $property->fields = get_fields( $post->ID );
      $properties[] = $property;
    }
    wp_localize_script( 'commercial-property-js', 'propertyList', $properties );

    $template = new Template();
    $template->path = 'templates/';

    $template->name = 'property-list-map';
    $content = $template->get();

    return $content;

  }

  public function jxListLoad() {

    // get filter values
    $filters = $_POST['filters'];

    // setup metaquery
    $metaquery = [];
    $metaquery['relation'] = 'AND';

    $taxquery = [];
    if( $filters['propertyType'] ) {
      $taxquery = array(
        array(
          'taxonomy' => 'property_type',
          'field'    => 'term_id',
          'terms'    => $filters['propertyType'],
          'include_children' => false
        )
      );
    }

    $properties = $this->fetchPropertiesFiltered( $metaquery, $taxquery );

    // setup template
    $template = new Template();
    $template->path = 'templates/';
    $template->name = 'property-list-item';

    // load list template
    if( !empty( $properties )) :
      foreach( $properties as $property ) :
        $template->data = array(
          'property' => $property,
        );
        $content .= $template->get();
      endforeach;
    endif;

    // send response and exit
    $response = [
      'properties'  => $properties,
      'content'     => $content,
      'status'      => 'success'
    ];
    print json_encode( $response );
    wp_die();

  }

  public function fetchPropertiesFiltered( $metaquery, $taxquery ) {

    $queryArgs = [
      'numberposts' => -1,
      'post_type'   => 'property',
      'meta_query'	=> $metaquery,
      'tax_query' => $taxquery
    ];

    $posts = get_posts( $queryArgs );

    return $posts;

  }

  public function fetchProperties() {

    $queryArgs = [
      'numberposts' => -1,
      'post_type' => 'property',
    ];
    $properties = get_posts( $queryArgs );

    return $properties;

  }

}
