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
        <h3><?= $prefix ?>Result System Plugin Configurations</h3>

        <a class="pull-right" data-toggle="modal" data-target="#myModal"  title="School result banner image">Result banner image <i class="fa fa-info-circle text-primary" data-toggle="tooltip" title="School result banner image"></i></a>

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
        echo $this->Form->button(__d('CakeAdmin', 'Update Settings'),['class'=>'btn btn-primary']);
        echo $this->Form->end();
        ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> <i class="fa fa-file-excel-o fa-2x"></i> Upload Result Banner </h4>
            </div>
            <div class="modal-body">
                <?= $this->Form->create(null,['url' => '/result-system/dashboard/upload-banner-image','enctype' => 'multipart/form-data', 'novalidate']) ?>

                <?= $this->Form->hidden('id',['class' => 'hidden','value' => 1]) ?>
                <div class="form-group">
                    <div class="fileinput fileinput-new" data-provides="fileinput" style="width: 100%;"><input type="hidden" value="" name="...">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 100%; height: 150px; line-height: 150px;"> <?= @$this->Html->image('',[
                                'alt' =>'result banner image'
                            ]) ?> </div>
                        <div>
                            <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><?= $this->Form->file('banner_image',['type' =>'file']) ?></span>
                            <a href="" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?= $this->Form->button('<i class="fa fa-upload"></i> '.__('Upload'),['type'=>'submit','class'=>'btn btn-primary','escape'=>false]) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>