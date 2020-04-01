<?php

?>


<div class="cp-listing-files">
  <?php foreach( $files as $file ): $file = $file['file_upload']; ?>
    <div class="cp-listing-file">
      <a href="<?php print $file['url']; ?>">
        <?php print $file['title']; ?>
      </a>
    </div>
  <?php endforeach; ?>
</div>
