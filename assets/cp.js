(function($) {

  function loadPropertyList() {

    console.log('loadPropertyList called...')

    // do ajax call to get new filtered posts
    data = {
      action: 'property_list_load'
    }
    $.post( commercialProperty.ajaxurl, data, function( response ) {

      response = JSON.parse( response )

      if ( response.status == 'success' ) {

        // replace content
        $('.property-list').replaceWith( response.content )

      } else {

      }
    });

  }

  // init load
  loadPropertyList();

  $('#filter_course').on('change', function() {
    loadPropertyList();
  })

})( jQuery );
