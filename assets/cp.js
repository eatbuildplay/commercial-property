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
   zoom: 13
  });

  // marker addition

  propertyList.forEach( function( property, index ) {

    console.log( property.fields );

    var fields = property.fields;

    if( fields.map_address_lat & fields.map_address_long ) {
      var title = parseFloat(fields.map_address_lat) + ', ' + parseFloat(fields.map_address_long);
      var latLng = {
        lat: parseFloat(fields.map_address_lat),
        lng: parseFloat(fields.map_address_long)
      };
    } else {
      var title = '30.633249, -97.676979';
      var latLng = {
        lat: 30.633249,
        lng: -97.676979
      };
    }

    var marker = new google.maps.Marker({
     position: latLng,
     map: map,
     title: title
    });


    var infoBoxContent = '';
    infoBoxContent += '<a href="' + property.permalink + '">';
    infoBoxContent += '<h2>' + property.post.post_title + '</h2>';
    infoBoxContent += '<img style="max-width: 100%; max-height: 150px;" src="' + property.fields.main_image.url + '" />';
    infoBoxContent += '<h3>' + property.fields.map_address + '</h3>';
    infoBoxContent += '<hr />';
    infoBoxContent += '<h4>' + property.fields.listing_type.label + '</h4>';
    infoBoxContent += '</a>';

    var infowindow = new google.maps.InfoWindow({
      content: infoBoxContent
    });

    marker.addListener('click', function() {
      infowindow.open(map, marker);
    });

    google.maps.event.addListener(map, "click", function(event) {
      infowindow.close();
    });

  });



}
