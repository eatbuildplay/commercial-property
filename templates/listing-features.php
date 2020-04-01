<?php

?>


<div class="cp-listing-features">
  <?php foreach( $common_features as $feature ): ?>
    <div class="cp-common-feature">
      <input type="checkbox" checked="checked" disabled />
      <?php print $feature['label']; ?>
    </div>
  <?php endforeach; ?>
</div>
