<?php

global $post;
$propertyId = $post->ID;

$fieldValues = get_fields( $propertyId );

function rowHasValue( $field ) {
  if( $field != '' || !$field ) {
    return true;
  }
  return false;
}

function textRender( $fieldValue ) {
  print $fieldValue;
}

function numberFormatRender( $fieldValue ) {
  print number_format( $fieldValue, 0 );
}

function selectionRender( $fieldValue ) {
  print $fieldValue['label'];
}

$fieldKeys = array(
  [
    'key'     => 'listing_type',
    'label'   => 'Listing Type',
    'render'  => 'selectionRender'
  ],
  [
    'key'     => 'agent',
    'label'   => 'Agent',
    'render'  => 'selectionRender'
  ],
  [
    'key'     => 'street',
    'label'   => 'Street Address',
    'render'  => 'textRender'
  ],
  [
    'key'     => 'city',
    'label'   => 'City',
    'render'  => 'textRender'
  ],
  [
    'key'     => 'state',
    'label'   => 'State',
    'render'  => 'textRender'
  ],
  [
    'key'     => 'frontage',
    'label'   => 'Frontage',
    'render'  => 'selectionRender'
  ],
  [
    'key'     => 'year_built',
    'label'   => 'Year Build',
    'render'  => 'textRender'
  ],
  [
    'key'     => 'square_feet',
    'label'   => 'Square Feet',
    'render'  => 'numberFormatRender'
  ],
  [
    'key'     => 'acres',
    'label'   => 'Acres',
    'render'  => 'textRender'
  ]
);

?>

<pre><?php //var_dump( $fieldValues ); ?></pre>


<div class="cp-listing-table">
  <table>
    <thead>
      <tr>
        <th colspan="2">Property Key Data</th>
      </tr>
    </thead>
    <tbody>
      <?php

        $alt = false;
        foreach( $fieldKeys as $field ):

          $key = $field['key'];
          if( $fieldValues[$key] == '' ):
            continue;
          endif;

          $fieldValue = $fieldValues[$key];

          if( $alt ) {
            $rowClass = 'alt';
            $alt = false;
          } else {
            $rowClass = '';
            $alt = true;
          }
      ?>

        <tr class="<?php print $rowClass; ?>">
          <td class="label"><?php print $field['label']; ?></td>
          <td class="data"><?php $field['render']( $fieldValue ); ?></td>
        </tr>

      <?php endforeach; ?>

    </tbody>
  </table>
</div>
