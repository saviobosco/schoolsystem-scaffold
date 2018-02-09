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
                <h4 class="panel-title">System Configurations</h4>
            </div>
            <div class="panel-body">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#application-settings" data-toggle="tab">Application Settings</a></li>
                    <li class=""><a href="#payment-settings" data-toggle="tab"> Payment Settings </a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="application-settings">

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
                        ?>
                        <p class="text-right m-b-0">
                            <?= $this->Form->button(__('Update Settings'),['class'=>'btn btn-primary']); ?>
                        </p>
                        <?php
                        echo $this->Form->end();
                        ?>

                    </div>
                    <div class="tab-pane fade" id="payment-settings">

                        <?php if(!empty($file)) : ?>
                            <div>
                                <?= $this->Html->image($file[0],['class'=>'img-responsive']) ?>
                            </div>
                        <?php endif; ?>


                        <p> Upload the school Image Banner</p>
                        <?= $this->Form->create(null, [
                            'url'=>[
                                'action'=>'uploadBannerImage'
                            ],
                            'enctype' => 'multipart/form-data'
                        ]); ?>

                        <?= $this->form->input('banner',['type'=>'file']) ?>
                        <?= $this->Form->submit(__('Upload'),['class'=>'btn btn-primary btn-sm m-b-10']) ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>