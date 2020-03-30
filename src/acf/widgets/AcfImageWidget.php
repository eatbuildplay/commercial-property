<?php

namespace CommercialProperty;

class AcfImageWidget extends \Elementor\Widget_Base {

  public function get_name() {
    return 'ACF Image Field';
  }

  public function get_title() {
    return 'ACF Image Field';
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
			'acf_key',
			[
				'label' => __( 'Field Key', 'commercial-property' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Enter ACF field key', 'commercial-property' ),
			]
		);

		$this->end_controls_section();

  }

  protected function render() {

    $settings = $this->get_settings_for_display();

    global $post;

    $fieldValue = get_field( $settings['acf_key'], $post->ID );

    $field = array(
      'value' => $fieldValue
    );

    $template = new Template();
    $template->path = 'src/acf/render/image/';
    $template->name = 'default';
    $template->data = array(
      'field' => $field
    );
    print $template->get();

  }

}
