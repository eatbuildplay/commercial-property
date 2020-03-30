<div class="frame-property-list-item">

  <h2><?php print $property->post_title; ?></h2>
  <h5>Property ID: <?php print $property->ID; ?></h5>

</div>

<style>

  .frame-property-list-item {
    float: left;
    margin: 20px 30px;
    max-width: 33%;
    min-width: 180px;
    cursor: pointer;
  }

</style>

<script>

(function($) {

  $('.frame-property-list-item').on('click', function() {
    window.location.href = 'https://google.com'
  })

})( jQuery );

</script>
