<?php

?>


<div class="cp-listing-features">
  <?php foreach( $common_features as $feature ): ?>
    <input type="checkbox" checked="checked" />
    <?php print $feature; ?>
  <?php endforeach; ?>
</div>
