<?php
use Settings\Core\Setting;

$image_banner = Setting::read('Application.image_banner');
?>
<?= ($image_banner) ?  $this->Html->image($image_banner) : '' ?>