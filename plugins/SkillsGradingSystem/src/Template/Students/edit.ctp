<?php
$edittemplates = [
    'label' => '',
    'submitContainer' => '{{content}}'
];
$this->Form->templates($edittemplates);

?>

<?php
// including the search parameter element
echo $this->element('searchParametersSessionClassTerm');
?>
<div class="row m-t-30">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= __('Edit Student Skills') ?> </h4>
            </div>
            <div class="panel-body">
                <?php if ( isset($selectParameter) AND $selectParameter === true ) : ?>
                    <div class="alert alert-danger">
                        <p> Select select the session,class and term </p>
                    </div>
                <?php endif; ?>
                <?php if (isset($student)) : ?>
                <?= $this->element('ResultSystem.Student/header_links') ?>

                <div class="row">
                    <div class="col-sm-2">
                        <div class="profile-picture">
                            <?= $this->Html->image('student-pictures/students/photo/'.$student->photo_dir.'/'.$student->photo,['alt' => $student->id,'width' => '150px']) ?>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <table class="table table-bordered">
                            <tr>
                                <th><?= __('Name') ?></th>
                                <td><?= h($student->full_name) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Admission No.') ?></th>
                                <td><?= h($student->id) ?></td>
                            </tr>
                        </table>

                    </div>
                    <!-- begin of second col-sm-5 -->
                    <div class="col-sm-5">
                        <table class="table table-bordered">
                            <tr>
                                <th><?= __('Term') ?></th>
                                <td><?= h(@$terms[$this->request->query['term_id']]) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Session') ?></th>
                                <td><?= h($sessions[$this->request->query['session_id']]) ?></td>
                            </tr>
                        </table>
                    </div>
                    <!-- end of second col-sm-5 -->
                </div>
                <?= $this->Form->create($student) ?>
                <fieldset>
                    <div class="row">

                        <div class="col-sm-6">
                            <?php if (!empty($affectiveSkills)): ?>

                                <table class="table table-bordered">
                                    <tr>
                                        <th><?= __('Affective Skills') ?></th>
                                        <th><?= __('Scores') ?></th>
                                    </tr>
                                    <?php for ($num = 0; $num < count($affectiveSkills); $num++ ): ?>
                                        <tr>
                                            <td><?= h($affectiveSkills[$num]['name']) ?></td>
                                            <td><?= $this->Form->input('students_affective_disposition_scores.'.$num.'.score') ?></td>
                                            <td class="hidden"><?= $this->Form->hidden('students_affective_disposition_scores.'.$num.'.affective_id',['value'=>$affectiveSkills[$num]['id']]) ?></td>
                                            <td class="hidden"><?= $this->Form->hidden('students_affective_disposition_scores.'.$num.'.student_id',['value' => $student->id]) ?></td>
                                            <td class="hidden"><?= $this->Form->hidden('students_affective_disposition_scores.'.$num.'.class_id',['value' => @$this->SearchParameter->getDefaultValue($this->request->query['class_id'],1)]) ?></td>
                                            <td class="hidden"><?= $this->Form->hidden('students_affective_disposition_scores.'.$num.'.term_id',['value' => @$this->SearchParameter->getDefaultValue($this->request->query['term_id'],1)]) ?></td>
                                            <td class="hidden"><?= $this->Form->hidden('students_affective_disposition_scores.'.$num.'.session_id',['value' => @$this->SearchParameter->getDefaultValue($this->request->query['session_id'],1)]) ?></td>


                                        </tr>
                                    <?php endfor; ?>
                                </table>
                            <?php endif; ?>
                        </div>

                        <div class="col-sm-6">
                            <?php if (!empty($psychomotorSkills)): ?>

                                <table class="table table-bordered">
                                    <tr>
                                        <th><?= __('Psychomotor Skills') ?></th>
                                        <th><?= __('Scores') ?></th>
                                    </tr>
                                    <?php for ($num = 0; $num < count($psychomotorSkills); $num++ ): ?>
                                        <tr>
                                            <td><?= h($psychomotorSkills[$num]['name']) ?></td>
                                            <td><?= $this->Form->input('students_psychomotor_skill_scores.'.$num.'.score') ?></td>
                                            <td class="hidden"><?= $this->Form->hidden('students_psychomotor_skill_scores.'.$num.'.psychomotor_id',['value' =>$psychomotorSkills[$num]['id'] ]) ?></td>
                                            <td class="hidden"><?= $this->Form->hidden('students_psychomotor_skill_scores.'.$num.'.student_id',['value' => $student->id]) ?></td>
                                            <td class="hidden"><?= $this->Form->hidden('students_psychomotor_skill_scores.'.$num.'.class_id',['value' =>  @$this->SearchParameter->getDefaultValue($this->request->query['class_id'],1)]) ?></td>
                                            <td class="hidden"><?= $this->Form->hidden('students_psychomotor_skill_scores.'.$num.'.term_id',['value' =>  @$this->SearchParameter->getDefaultValue($this->request->query['term_id'],1)]) ?></td>
                                            <td class="hidden"><?= $this->Form->hidden('students_psychomotor_skill_scores.'.$num.'.session_id',['value' =>  @$this->SearchParameter->getDefaultValue($this->request->query['session_id'],1)]) ?></td>


                                        </tr>
                                    <?php endfor; ?>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>