<div class="lesson-filters">

  <div class="lesson-filter">
    <label>Property Type</label>
    <select id="filter_course">
      <option value='1'>Office</option>
      <option value='2'>Warehouse</option>
      <option value='3'>Land</option>
    </select>
  </div>

</div>

<script>

(function($) {

  $('#filter_course').on('change', function() {
    console.log('filter selected')

    // do ajax call to get new filtered posts
    data = {
      action: 'property_list_load'
    }
    $.post( ElementorProFrontendConfig.ajaxurl, data, function( response ) {
      if ( response.status == 'success' ) {

      } else {

      }
    });

  })

})( jQuery );

</script>
