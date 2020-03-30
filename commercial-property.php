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
    require_once(COMMERCIAL_PROPERTY_PATH . 'src/shortcodes/ListingTableShortcode.php');
    require_once(COMMERCIAL_PROPERTY_PATH . 'src/shortcodes/ListingPriceShortcode.php');
    require_once(COMMERCIAL_PROPERTY_PATH . 'src/shortcodes/ListingFeaturesShortcode.php');

    new ListingTableShortcode();
    new ListingPriceShortcode();
    new ListingFeaturesShortcode();

    add_action( 'elementor/widgets/widgets_registered', [$this, 'registerWidgets'] );

  }

  public function registerWidgets() {

    require_once( COMMERCIAL_PROPERTY_PATH . 'src/ElementorPostWidget.php' );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorPostWidget() );

    require_once( COMMERCIAL_PROPERTY_PATH . 'src/acf/widgets/AcfTextWidget.php' );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new AcfTextWidget() );

    require_once( COMMERCIAL_PROPERTY_PATH . 'src/acf/widgets/AcfImageWidget.php' );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new AcfImageWidget() );

  }

  public function scripts() {

    wp_enqueue_style(
      'handle-js',
      COMMERCIAL_PROPERTY_URL . 'assets/cp.css',
      array(),
      '1.0.0',
      'all'
    );

    wp_enqueue_script(
      'handle-js',
      COMMERCIAL_PROPERTY_URL . 'assets/cp.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

  }

}

new Plugin();