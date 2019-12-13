<?php
$this->layout = 'custom';
?>

<div class="row">
    <div class="col-sm-12">
        <h1> News Updates </h1>
        <ul>
            <?php foreach($newsUpdates as $newsUpdate) : ?>
                <li> <?= $this->Html->link($newsUpdate->title, ['action'=>'view', $newsUpdate->title_slug]) ?> </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>
