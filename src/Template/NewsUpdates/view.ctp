<?php
$this->layout = 'custom'
?>

<div class="row">
    <div class="col-sm-12">
        <?php if (isset($newsUpdate)) : ?>
        <h1> <?= $newsUpdate->title ?> </h1>
        <div>
            <?= $newsUpdate->post ?>
        </div>
        <?php endif ?>
    </div>
</div>
