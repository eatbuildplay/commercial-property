(function($) {

  function loadPropertyList() {

    console.log('loadPropertyList called...')

    var filterPropertyType = $('#filter_property_type').val()

    // do ajax call to get new filtered posts
    data = {
      action: 'property_list_load',
      filters: {
        propertyType: filterPropertyType
      }
    }
    $.post( commercialProperty.ajaxurl, data, function( response ) {

      response = JSON.parse( response )

      if ( response.status == 'success' ) {

        // replace content
        $('.property-list').html( response.content )

      } else {

      }
    });

  }

  // init load
  loadPropertyList();

  $('#filter_property_type').on('change', function() {
    loadPropertyList();
  })

})( jQuery );
