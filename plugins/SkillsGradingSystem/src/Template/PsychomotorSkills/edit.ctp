<?php
$this->extend('/Common/view');
$this->assign('title','Edit Psychomotor Skill');
?>
<div class="row">
    <div class="col-sm-12">
        <?= $this->Form->create($psychomotorSkill) ?>
        <fieldset>
            <?php
            echo $this->Form->input('name');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>