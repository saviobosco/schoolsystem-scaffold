<?= $this->Site->css('switchery/switchery.min.css',['block' => true]) ?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Edit  Student : <?= h($student->id) ?>  </h4>
            </div>
            <div class="panel-body">

                <?= $this->element('Links/header_links') ?>


                <?= $this->Form->create($student,[
                    'enctype' => 'multipart/form-data','novalidate'
                ]) ?>
                <fieldset>
                    <legend><?= __('Edit Student Profile') ?></legend>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden" value="" name="...">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;"> <?= ( $student->photo ) ? $this->Html->image('student-pictures/students/photo/'.$student->photo_dir.'/'.$student->photo,[
                                            'alt' => $student->full_name
                                        ]) : 'No Image' ?> </div>
                                    <div>
                                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><?= $this->Form->file('photo',['type' => 'file']) ?></span>
                                        <a href="file:///D:/html%20templates/html%20templates/dashboard_templates/themeforest-5961888-avant-clean-and-responsive-bootstrap-31-admin/HTML/form-components.htm#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <?= $this->Form->input('id',['type' => 'text','data-toggle' =>'tooltip','trigger' =>'focus','title' =>'Please if you edit this column this student will lost all his previous results', 'label'=>['text'=>'Reg Number'],'disabled'=>true]);  ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $this->Form->input('first_name');  ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $this->Form->input('last_name'); ?>
                                </div>
                            </div>
                            <?php
                            echo $this->Form->radio('gender',[
                                ['value' => 'male', 'text' => 'Male',],
                                ['value' => 'female', 'text' => 'Female',]
                            ],['hiddenField'=>false,'label'=>true,'templates'=>['input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',]]);

                            echo $this->Form->input('date_of_birth',[
                                /*'minYear' => 1990,
                                'maxYear' => date('Y'),*/
                                'id' => 'datepicker-autoClose',
                                'type' => 'text',
                                'templates'=>[
                                    'inputContainer' => '<div class="form-group">{{content}}</div>'
                                    ,'input' => '<input class="form-control" type="{{type}}" name="{{name}}"{{attrs}}/>'
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                    <?php
                    //echo $this->Form->input('state_of_origin');
                    echo $this->Form->input('state_id',['options'=>$states]);
                    echo $this->Form->input('religion');
                    echo $this->Form->input('home_residence');
                    echo $this->Form->input('session_id', ['options' => $sessions]);
                    echo $this->Form->input('class_id', ['options' => $classes]);
                    echo $this->Form->input('class_demarcation_id', ['options' => $classDemarcations]);

                    echo '<h2>Guardian Information </h2>';

                    echo $this->Form->input('guardian');
                    echo $this->Form->input('relationship_to_guardian');
                    echo $this->Form->input('occupation_of_guardian');
                    echo $this->Form->input('guardian_phone_number');
                    ?>

                    <?php
                    echo '<label> Student Status </label>';
                    echo $this->Form->input('status',['type' => 'checkbox','data-render'=>'switchery','data-theme' => 'default']);
                    ?>

                </fieldset>
                <?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
                <?= $this->Form->end() ?>

            </div>
        </div>
    </div>
</div>


<?= $this->Plugins->script('bootstrap-datepicker/js/bootstrap-datepicker.js',['block' => true]) ?>
<?= $this->Plugins->script('custom/js/fileinput.min.js',['block' => true]) ?>
<?= $this->Site->script('switchery/switchery.min.js',['block' => true]) ?>
<?= $this->Html->script('form-slider-switcher.demo.min.js',['block' => true]) ?>
