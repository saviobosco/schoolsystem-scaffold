<?php
use Cake\Utility\Inflector;
$formTemplates = [
    'label' => '<label class="control-label col-sm-2" {{attrs}}> {{text}} <i class=" text-primary fa fa-info-circle" data-toggle="tooltip" title="{{title}}"> </i></label>',
    'submitContainer' => '{{content}}'
];
$this->Form->templates($formTemplates);
$this->extend('/Common/view');
$this->assign('title','Application Settings');
?>
    <ul class="nav nav-pills">
        <li class="active"><a href="#general_settings" data-toggle="tab"> General Settings  </a></li>
        <li><a href="#account_type_settings" data-toggle="tab"> Account Type Activation </a></li>
        <li><a href="#result_settings" data-toggle="tab"> Result Settings </a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="general_settings">
            <?php
            echo $this->Form->create('',['class' => 'form-horizontal' ]);
            foreach ($settings as $id => $setting) {
                echo '<div class="m-b-30">';
                echo $this->Form->input($id . '.id', [
                    'type' => 'hidden',
                    'value' => $setting->id,
                ]);
                $name = explode('.', $setting->name);
                if ($setting->type === 'select') {
                    echo $this->Form->input($id . '.value', [
                        'type' => (($setting->type) ? $setting->type : 'text'),
                        'label' => Inflector::humanize(ucfirst(end($name))),
                        'options' => (isset($selectOptions[$setting->id])) ? $selectOptions[$setting->id] : [],
                        'value' => $setting->value,
                        'templates' => [
                            'select' => '<div class="col-sm-10"> <select class="form-control" name="{{name}}"{{attrs}}>{{content}}</select> </div>',
                        ],
                        'templateVars' => ['title' => (($setting->description) ? $setting->description : '')]

                    ]);
                } else if ($setting->type === 'checkbox') {
                    $name = Inflector::humanize(ucfirst(end($name)));
                    echo "<input name='{$id}[value]' type='hidden' value='0' />";
                    ?>
                    <div class='col-sm-12'> <label> <?= $name ?>  <input name='<?= $id.'[value]' ?>' type='checkbox' value='1' <?= ($setting->value) ? 'checked' : ''  ?>  /> </label></div>

                    <?php
                } else {
                    echo $this->Form->input($id . '.value', [
                        'type' => (($setting->type) ? $setting->type : 'text'),
                        'label' => Inflector::humanize(ucfirst(end($name))),
                        'options' => (($setting->options) ? $setting->options : ''),
                        'value' => $setting->value,
                        'templates' => [
                            'input' => '<div class="col-sm-10"> <input class="form-control" type="{{type}}" name="{{name}}"{{attrs}}/> </div>',
                        ],
                        'templateVars' => ['title' => (($setting->description) ? $setting->description : '')]

                    ]);
                }
                echo '</div>';
            }
            ?>
            <p class="text-right m-b-0">
                <?= $this->Form->button(__('Update Settings'),['class'=>'btn btn-primary']); ?>
            </p>
            <?php
            echo $this->Form->end();
            ?>
        </div>
        <div class="tab-pane fade" id="account_type_settings">
            <?php
            echo $this->Form->create('',['url' => ['action' => 'updateAccountTypeSettings'], 'class' => 'form-horizontal', 'target' => 'in-line' ]);
            foreach ($accountTypeSettings as $id => $setting) {
                echo '<div class="m-b-30">';
                echo $this->Form->input($id . '.id', [
                    'type' => 'hidden',
                    'value' => $setting->id,
                ]);
                $name = explode('.', $setting->name);
                if ($setting->type === 'select') {
                    echo $this->Form->input($id . '.value', [
                        'type' => (($setting->type) ? $setting->type : 'text'),
                        'label' => Inflector::humanize(ucfirst(end($name))),
                        'options' => (isset($selectOptions[$setting->id])) ? $selectOptions[$setting->id] : [],
                        'value' => $setting->value,
                        'templates' => [
                            'select' => '<div class="col-sm-10"> <select class="form-control" name="{{name}}"{{attrs}}>{{content}}</select> </div>',
                        ],
                        'templateVars' => ['title' => (($setting->description) ? $setting->description : '')]

                    ]);
                } else if ($setting->type === 'checkbox') {
                    $name = Inflector::humanize(ucfirst(end($name)));
                    echo "<input name='{$id}[value]' type='hidden' value='0' />";
                    ?>
                    <div class='col-sm-12'> <label> <?= $name ?>  <input name='<?= $id.'[value]' ?>' type='checkbox' value='1' <?= ($setting->value) ? 'checked' : ''  ?>  /> </label></div>

                    <?php
                } else {
                    echo $this->Form->input($id . '.value', [
                        'type' => (($setting->type) ? $setting->type : 'text'),
                        'label' => Inflector::humanize(ucfirst(end($name))),
                        'options' => (($setting->options) ? $setting->options : ''),
                        'value' => $setting->value,
                        'templates' => [
                            'input' => '<div class="col-sm-10"> <input class="form-control" type="{{type}}" name="{{name}}"{{attrs}}/> </div>',
                        ],
                        'templateVars' => ['title' => (($setting->description) ? $setting->description : '')]

                    ]);
                }
                echo '</div>';
            }
            ?>
            <p class="text-right m-b-0">
                <?= $this->Form->button(__('Update Settings'),['class'=>'btn btn-primary']); ?>
            </p>
            <?php
            echo $this->Form->end();
            ?>

        </div>
        <div class="tab-pane fade" id="result_settings">
            This is for setting the school result layout
        </div>
    </div>
