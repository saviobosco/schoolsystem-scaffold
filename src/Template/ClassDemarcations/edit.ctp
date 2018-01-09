<div class="col-sm-12">
    <?= $this->Form->create($classDemarcation) ?>
    <fieldset>
        <legend><?= __('Edit Class Demacation') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('class_id', ['options' => $classes]);
        echo $this->Form->input('capacity',['label' => ['text' => 'Class In-take Capacity']]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
