<?php
$getQuery = $this->request->getQuery();
?>
<div>
    <?= $this->Form->create('',['class'=>'form-inline','type'=>'GET']) ?>
    <div class="form-group">
        <label for="name"> Name </label>
        <input name="_name" class="form-control" type="text" value="<?= (isset($getQuery['_name'])) ? $getQuery['_name'] : '' ?>">
    </div>
    <div class="form-group">
        <button class="btn btn-primary" > Search </button>
    </div>
    <?= $this->Form->end() ?>
</div>