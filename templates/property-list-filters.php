<div class="property-filter-section">

  <?php if( !empty( $propertyTypes )) : ?>
    <div class="property-filter property-type-filter">
      <h3>Property Type</h3>
      <select id="filter_property_type">
        <option value='0'>All Property Types</option>
        <?php foreach( $propertyTypes as $type ) : ?>
          <option value='<?php print $type->term_id; ?>'><?php print $type->name; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  <?php endif; ?>

  <div class="property-filter listing-type-filter">
    <h3>Listing Type</h3>
    <label><input type="checkbox" value="sale" /> <span>For Sale</span></label>
    <label><input type="checkbox" value="lease" /> <span>For Lease</span></label>
  </div>

</div>
