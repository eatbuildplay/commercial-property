<?php

namespace CommercialProperty;

class ElementorPostWidget extends \Elementor\Widget_Base {

  public function get_name() {
    return 'Property Posts';
  }

  public function get_title() {
    return 'Property Posts';
  }

  public function get_icon() {
    return 'fa fa-th';
  }

  public function get_categories() {
    return [ 'general' ];
  }

  protected function _register_controls() {

    $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'widget_title',
			[
				'label' => __( 'Title', 'commercial-property' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'commercial-property' ),
				'placeholder' => __( 'Type your title here', 'commercial-property' ),
			]
		);

    $this->add_control(
			'repeating_section',
			[
				'label' => __( 'Repeating Section', 'commercial-property' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '[elementor id="999"]', 'commercial-property' ),
				'placeholder' => __( '[elementor id="999"]', 'commercial-property' ),
			]
		);

		$this->end_controls_section();

  }

  protected function render() {

    $settings = $this->get_settings_for_display();

    $properties = get_posts(
      [
        'numberposts'	=> -1,
        'post_type' => 'property'/*,
        'meta_query'	=> array(
      		'relation'		=> 'AND',
      		array(
      			'key'	 	    => 'course',
      			'value'	  	=> array(3),
      			'compare' 	=> 'IN',
      		)
      	),*/
      ]
    );

    $template = new Template();
    $template->path = 'templates/';
    $template->name = 'property-filters';
    print $template->get();

    $template->name = 'property-list';
    $template->data = [
      'properties' => $properties,
      'settings' => $settings,
      'repeatingSection' => $settings['repeating_section']
    ];
    print $template->get();

  }

}
