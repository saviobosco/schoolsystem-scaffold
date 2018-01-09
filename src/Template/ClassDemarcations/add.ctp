<div class="row">
    <div class="col-sm-4 pull-right alert alert-info m-t-20">
        <p> Note </p>
        <ul>
            <li> Class name eg. JSS 1A , JSS 1B</li>
            <li> The class in-take capacity is the number of students a class can take.</li>
        </ul>
    </div>
    <div class="col-sm-8">
        <?= $this->Form->create($classDemarcation) ?>
        <fieldset>
            <legend><?= __('Add Class Demarcation') ?></legend>
            <?php
            echo $this->Form->input('name');
            echo $this->Form->input('class_id', ['options' => $classes]);
            echo $this->Form->input('capacity',['label' => ['text' => 'Class In-take Capacity']]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>