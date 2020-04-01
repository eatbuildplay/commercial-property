<div class="cp-custom-features">
  <?php foreach( $custom_features as $feature ): $feature = $feature['feature']; ?>
    <div class="cp-custom-feature">
      <p><i class="far fa-check-square"></i> <?php print $feature; ?></p>
    </div>
  <?php endforeach; ?>
</div>
