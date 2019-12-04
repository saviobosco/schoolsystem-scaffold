<?php
$getQuery = $this->request->getQuery();
?>
<div>
    <?= $this->Form->create('',['type'=>'GET']) ?>
    <input type="hidden" name="page" value="">
    <fieldset>
        <legend> Search Criteria </legend>
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <?= $this->Form->input('Include.first_name', ['type' => 'checkbox',  'checked' => (isset($getQuery['Include']['first_name']) && !empty($getQuery['Include']['first_name'])) ? true : false ]) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $this->Form->input('first_name', ['value' => (isset($getQuery['first_name'])) ? $getQuery['first_name'] : '']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <?= $this->Form->input('Include.last_name', ['type' => 'checkbox',  'checked' => (isset($getQuery['Include']['last_name']) && !empty($getQuery['Include']['last_name'])) ? true : false]) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $this->Form->input('last_name', ['value' => (isset($getQuery['last_name'])) ? $getQuery['last_name'] : '']); ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">

                        <?= $this->Form->input('Include.admission_number', ['type' => 'checkbox', 'checked' => (isset($getQuery['Include']['admission_number']) && !empty($getQuery['Include']['admission_number'])) ? true : false ]) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $this->Form->input('admission_number', ['value' => (isset($getQuery['admission_number'])) ? $getQuery['admission_number'] : '']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <?= $this->Form->input('Include.class_id', ['type' => 'checkbox',  'checked' => (isset($getQuery['Include']['class_id']) && !empty($getQuery['Include']['class_id'])) ? true : false ]) ?>
                    </div>
                    <div class="col-sm-6">
                        <?php if (!isset($classes)) $classes = []; ?>
                        <?= $this->Form->input('class_id', ['options' => $classes, 'empty' => '--Select Class --', 'default' => (isset($getQuery['class_id'])) ? $getQuery['class_id'] : '']); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right" > Search </button>
                </div>
            </div>
        </div>
    </fieldset>
    <?= $this->Form->end() ?>
</div>