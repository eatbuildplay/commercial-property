<?php

/**
 *
 * Plugin Name: Commercial Property
 * Plugin URI: https://eatbuildplay.com/plugins/commercial-property/
 * Description: Commercial property real estate plugin for WordPress.
 * Version: 1.0.0
 * Author: Casey Milne, Eat/Build/Play
 * Author URI: https://eatbuildplay.com/
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 */

namespace CommercialProperty;

define( 'COMMERCIAL_PROPERTY_PATH', plugin_dir_path( __FILE__ ) );
define( 'COMMERCIAL_PROPERTY_URL', plugin_dir_url( __FILE__ ) );
define( 'COMMERCIAL_PROPERTY_VERSION', '1.0.0' );

class Plugin {

  public function __construct() {

    add_action('wp_enqueue_scripts', array( $this, 'scripts' ));

    require_once(COMMERCIAL_PROPERTY_PATH . 'src/Template.php');
    require_once(COMMERCIAL_PROPERTY_PATH . 'src/Property.php');
    require_once(COMMERCIAL_PROPERTY_PATH . 'src/shortcodes/ListingTableShortcode.php');
    require_once(COMMERCIAL_PROPERTY_PATH . 'src/shortcodes/ListingPriceShortcode.php');
    require_once(COMMERCIAL_PROPERTY_PATH . 'src/shortcodes/ListingFeaturesShortcode.php');
    require_once(COMMERCIAL_PROPERTY_PATH . 'src/shortcodes/ListingFilesShortcode.php');
    require_once(COMMERCIAL_PROPERTY_PATH . 'src/shortcodes/PropertyListShortcode.php');
    require_once(COMMERCIAL_PROPERTY_PATH . 'src/shortcodes/ListingCustomFeaturesShortcode.php');
    require_once(COMMERCIAL_PROPERTY_PATH . 'src/shortcodes/FeaturedPropertyShortcode.php');
    require_once(COMMERCIAL_PROPERTY_PATH . 'src/shortcodes/PropertyListMapShortcode.php');

    new ListingTableShortcode();
    new ListingPriceShortcode();
    new ListingFeaturesShortcode();
    new ListingCustomFeaturesShortcode();
    new ListingFilesShortcode();
    new PropertyListShortcode();
    new PropertyListMapShortcode();
    new FeaturedPropertyShortcode();

  }

  public function scripts() {

    wp_enqueue_style(
      'commercial-property-css',
      COMMERCIAL_PROPERTY_URL . 'assets/cp.css',
      array(),
      '1.1.0',
      'all'
    );

    wp_enqueue_script(
      'commercial-property-js',
      COMMERCIAL_PROPERTY_URL . 'assets/cp.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

    wp_enqueue_script(
      'commercial-property-google-maps-js',
      'https://maps.googleapis.com/maps/api/js?key=AIzaSyD1wJo8NuuIQVBDqCmk1n5nAzWAIg6a7HQ&callback=initMap',
      array( 'commercial-property-js' ),
      '1.0.0',
      true
    );

    wp_localize_script(
      'commercial-property-js',
      'commercialProperty',
      [
        'ajaxurl' => admin_url( 'admin-ajax.php' )
      ]
    );

  }

}

new Plugin();
