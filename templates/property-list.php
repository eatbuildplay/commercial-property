<?php

// return Plugin::elementor()->frontend->get_builder_content_for_display( $attributes['id'], $include_css );

$elFront = \ElementorPro\Plugin::elementor()->frontend;
$content = $elFront->get_builder_content_for_display( 274, true );
print $content;

?>


<div class="frame-property-list">
  <?php
    if( !empty( $properties )) :
      foreach( $properties as $property ) {
        print do_shortcode( $repeatingSection );
  ?>


  <?php } endif; ?>
</div>
