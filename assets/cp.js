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
  var propertyListEl = $('.property-list')
  if( propertyListEl.length ) {
    loadPropertyList();
  }


  $('#filter_property_type').on('change', function() {
    loadPropertyList();
  })

})( jQuery );



/*
 * Listings map
 */
var map;
function initMap() {

  // map setup
  map = new google.maps.Map(document.getElementById('cp-property-list-map'), {
   center: {
     lat: 30.633249,
     lng: -97.676979
   },
   zoom: 14
  });

  // marker addition
  var latLng = {lat: -25.363, lng: 131.044};
  var marker = new google.maps.Marker({
   position: latLng,
   map: map,
   title: 'Hello World!'
  });



}
