<?php
use Cake\Utility\Inflector;
$edittemplates = [
    'label' => '<label class="control-label col-sm-2" {{attrs}}> {{text}} <i class=" text-primary fa fa-info-circle" data-toggle="tooltip" title="{{title}}"> </i></label>',
    'submitContainer' => '{{content}}'
];
$this->Form->templates($edittemplates);

?>
<div class="row m-b-40">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="fa fa-gears"></i> Application Configuration
                </h4>
            </div>
            <div class="panel-body">
                <?php
                echo $this->Form->create('',['class' => 'form-horizontal' ]);
                foreach ($settings as $id => $setting) {
                    echo '<div class="m-b-30">';
                    echo $this->Form->input($id . '.id', [
                        'type' => 'hidden',
                        'value' => $setting->id,
                    ]);
                    $name = explode('.', $setting->name);
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
                    echo '</div>';
                }
                echo $this->Form->button(__('Update Settings'),['class'=>'btn btn-primary']);
                echo $this->Form->end();
                ?>
            </div>
        </div>
        <h3></h3>


    </div>
</div>