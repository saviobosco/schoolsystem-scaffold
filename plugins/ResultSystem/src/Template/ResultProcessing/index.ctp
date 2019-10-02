<?php
if (! function_exists("array_key_last")) {
    function array_key_last($array) {
        if (!is_array($array) || empty($array)) {
            return NULL;
        }

        return array_keys($array)[count($array)-1];
    }
}
$sessions = $sessions->all()->toArray();
$defaultSession = array_key_last($sessions);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Result Processing</h4>
            </div>
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li class="active"><a href="#nav-pills-tab-1" data-toggle="tab"> Process Termly Results  </a></li>
                    <li><a href="#nav-pills-tab-2" data-toggle="tab"> Process Annual Results </a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="nav-pills-tab-1">
                        <h3 class="m-t-10"> Process Termly Results </h3>
                        <?= $this->Form->create(null,['url' => ['action' => 'processTermlyResult']]) ?>
                        <fieldset>
                            <?php
                            echo $this->Form->input('session_id', ['options' => $sessions, 'default' => $defaultSession]);
                            echo $this->Form->input('class_id', ['options' => $classes,'empty'=>'select class']);
                            echo $this->Form->input('term_id', ['options' => $terms]);
                            echo $this->Form->input('no_of_subjects', ['required'=>true,'type'=>'number','data-toggle' =>'tooltip','trigger' =>'focus','title'=>'This is used to calculate the student\'s average']);
                            echo $this->Form->input('cal_student_total',['type'=>'checkbox','label'=>['text'=>'Calculate the student\'s Total ','data-toggle' =>'tooltip','trigger' =>'hover','title'=>'Calculate the student\'s total for the selected class']]);
                            echo $this->Form->input('cal_student_position',['type'=>'checkbox','label'=>['text'=>'Calculate the student\'s positions ','data-toggle' =>'tooltip','trigger' =>'hover','title'=>'Calculate the student\'s positions for the selected class']]);
                            echo $this->Form->input('cal_subject_position',['type'=>'checkbox','label'=>['text'=>'Calculate the student\'s subject positions ','data-toggle' =>'tooltip','trigger' =>'hover','title'=>'Calculate the student\'s subject positions for the selected class']]);
                            echo $this->Form->input('cal_class_average',['type'=>'checkbox','label'=>['text'=>'Calculate the subjects Average ','data-toggle' =>'tooltip','trigger' =>'hover','title'=>'Calculate the subjects average for the selected class']]);
                            ?>
                        </fieldset>
                        <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary']) ?>
                        <?= $this->Form->end() ?>

                    </div>
                    <div class="tab-pane fade" id="nav-pills-tab-2">
                        <h3 class="m-t-10"> Process Annual Results </h3>
                        <?= $this->Form->create(null,[ 'url' => ['action' => 'processAnnualResult'] ]) ?>
                        <fieldset>
                            <?php
                            echo $this->Form->input('session_id', ['options' => $sessions, 'default' => $defaultSession, 'required' => true]);
                            echo $this->Form->input('class_id', ['options' => $classes,'empty'=>'select class', 'required' => true]);
                            echo $this->Form->hidden('term_id', ['options' => $terms, 'default' => 4]);
                            echo $this->Form->input('cal_student_total',['id' => 'cal-student-total-session', 'type'=>'checkbox','label'=>['text'=>'Calculate the student\'s Total ','data-toggle' =>'tooltip','trigger' =>'hover','title'=>'Calculate the student\'s total for the selected class']]);
                            echo $this->Form->input('cal_student_position',['id' => 'cal-student-position-session', 'type'=>'checkbox','label'=>['text'=>'Calculate the student\'s positions ','data-toggle' =>'tooltip','trigger' =>'hover','title'=>'Calculate the student\'s positions for the selected class']]);
                            echo $this->Form->input('cal_subject_position',['id' => 'cal-subject-position-session', 'type'=>'checkbox','label'=>['text'=>'Calculate the student\'s subject positions ','data-toggle' =>'tooltip','trigger' =>'hover','title'=>'Calculate the student\'s subject positions for the selected class']]);
                            echo $this->Form->input('cal_class_average',['id' => 'cal-class-average-session', 'type'=>'checkbox','label'=>['text'=>'Calculate the subjects Average ','data-toggle' =>'tooltip','trigger' =>'hover','title'=>'Calculate the subjects average for the selected class']]);
                            ?>
                        </fieldset>
                        <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary']) ?>
                        <?= $this->Form->end() ?>

                    </div>

                </div>

            </div>
        </div>

    </div>
</div>