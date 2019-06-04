<?php
if ( is_null($studentResultPublishStatus) || $studentResultPublishStatus['status'] === 0 ) {

    // end the execution here and return
    echo '<h2 class="text-center"> This Result has not yet been published  </h2>';
}