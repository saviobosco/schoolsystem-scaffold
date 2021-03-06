<?php
use Cake\Utility\Inflector;
$edittemplates = [
    'label' => '<label class="control-label col-sm-2" {{attrs}}> {{text}} <i class=" text-primary fa fa-info-circle" data-toggle="tooltip" title="{{title}}"> </i></label>',
    'submitContainer' => '{{content}}'
];
$this->Form->templates($edittemplates);
$this->extend('/Common/view');
$this->assign('title','Application Settings');
?>
<?php
echo $this->Form->create('',['class' => 'form-horizontal' ]);
foreach ($settings as $id => $setting) {
    echo '<div class="m-b-30">';
    echo $this->Form->input($id . '.id', [
        'type' => 'hidden',
        'value' => $setting->id,
    ]);
    $name = explode('.', $setting->name);
    /*if (end($name) === 'current_session') {
        echo $this->Form->input($id . '.value', [
            'type' => (($setting->type) ? $setting->type : 'text'),
            'label' => Inflector::humanize(ucfirst(end($name))),
            'options' => $sessions,
            'value' => $setting->value,
            'templates' => [
                'select' => '<div class="col-sm-10"> <select class="form-control" name="{{name}}"{{attrs}}>{{content}}</select> </div>',
            ],
            'templateVars' => ['title' => (($setting->description) ? $setting->description : '')]

        ]);
    } else*/ if ($setting->type === 'select') {
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