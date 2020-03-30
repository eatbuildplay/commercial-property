<?php

namespace CommercialProperty;

class PropertyListShortcode {

  public $tag = 'cp-property-list';

  public function __construct() {

    add_action('init', array( $this, 'init'));

    // loading hooks
    add_action('wp_ajax_property_list_load', [$this, 'jxListLoad']);
    add_action('wp_ajax_nopriv_property_list_load', [$this, 'jxListLoad']);

  }

  public function init() {
    add_shortcode($this->tag, array($this, 'doShortcode'));
  }

  public function doShortcode( $atts ) {

    $atts = shortcode_atts( array(), $atts, $this->tag );

    // get properties
    $projects = $this->fetchProperties();

    $template = new Template();
    $template->path = 'templates/';

    $template->name = 'property-list-filters';
    $content = $template->get();

    $template->name = 'property-list';
    $content .= $template->get();

    return $content;

  }

  public function jxListLoad() {

    // get filter values
    $filters = $_POST['filters'];

    // setup metaquery
    $metaquery = [];
    $metaquery['relation'] = 'AND';

    if( $filters['client'] ) {
      $metaquery[] = array(
        'key'	  	=> 'stakeholder',
        'value'	  => $filters['client'],
        'compare' => '=',
      );
    }

    $properties = $this->fetchPropertiesFiltered( $metaquery );

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

  public function fetchPropertiesFiltered( $metaquery ) {

    $queryArgs = [
      'numberposts' => -1,
      'post_type'   => 'property',
      'meta_query'	=> $metaquery
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
