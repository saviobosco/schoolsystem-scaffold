<?php
$this->extend('/Common/view');
$this->assign('title','Edit Affective Disposition');
?>
<div class="row">
    <div class="col-sm-12">
        <?= $this->Form->create($affectiveDisposition) ?>
        <fieldset>
            <?php
            echo $this->Form->input('name');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>