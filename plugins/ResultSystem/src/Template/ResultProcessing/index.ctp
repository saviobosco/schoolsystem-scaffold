<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Result Processing</h4>
            </div>
            <div class="panel-body">
                <?= $this->Form->create(null,[ 'url' => '', 'enctype' => 'multipart/form-data']) ?>
                <fieldset>
                    <legend><?= __('Result Processing ') ?></legend>
                    <?php

                    echo $this->Form->input('session_id', ['options' => $sessions]);
                    echo $this->Form->input('class_id', ['options' => $classes,'empty'=>'select class']);
                    echo $this->Form->input('term_id', ['options' => $terms]);
                    echo $this->Form->input('no_of_subjects', ['required'=>true,'type'=>'number','data-toggle' =>'tooltip','trigger' =>'focus','title'=>'This is used to calculate the student\'s average']);
                    echo $this->Form->input('cal_student_position',['type'=>'checkbox','label'=>['text'=>'Calculate the student\'s positions ','data-toggle' =>'tooltip','trigger' =>'hover','title'=>'Calculate the student\'s positions for the selected class']]);
                    echo $this->Form->input('cal_subject_position',['type'=>'checkbox','label'=>['text'=>'Calculate the student\'s subject positions ','data-toggle' =>'tooltip','trigger' =>'hover','title'=>'Calculate the student\'s subject positions for the selected class']]);
                    echo $this->Form->input('cal_class_average',['type'=>'checkbox','label'=>['text'=>'Calculate the subjects Average ','data-toggle' =>'tooltip','trigger' =>'hover','title'=>'Calculate the subjects average for the selected class']]);

                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>

    </div>
</div>