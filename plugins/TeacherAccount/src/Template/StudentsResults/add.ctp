<?php
$this->assign('title', 'Teacher: Add Students Results');
//$this->extend('/Common/view');
$formTemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->templates($formTemplates);
$queryData = $this->request->getQuery();
if ( isset($subjectContainsResult) AND !empty($subjectContainsResult)) {
    foreach( $subjectContainsResult as $student_id ) {
        unset($students[$student_id]);
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <?= $this->Form->create('',['class'=>'form-inline','type'=>'GET']) ?>
        <div class="form-group">
            <?= $this->Form->input('subject_id',['options' => $subjects,'class'=>'form-control','data-select-id'=>'subject','label'=>['text'=>'Subject '],'value'=>(isset($queryData['subject_id']) && !empty($queryData['subject_id'])) ? $queryData['subject_id'] : 1]); ?>
            <?= $this->Form->input('session_id',['options' => $sessions,'class'=>'form-control','data-select-id'=>'school','label'=>['text'=>'Session '],'value'=>(isset($queryData['session_id']) && !empty($queryData['session_id'])) ? $queryData['session_id'] : 1]); ?>
            <?= $this->Form->hidden('class_id',['value'=>(isset($queryData['class_id']) && !empty($queryData['class_id'])) ? $queryData['class_id'] : '']); ?>
            <?= $this->Form->input('term_id',['options' => $terms,'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Term'],'value'=>(isset($queryData['term_id']) && !empty($queryData['term_id'])) ? $queryData['term_id'] : 1]); ?>
            <?= $this->Form->submit(__('change'),['class'=>'btn btn-primary']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<?php if (isset($subject)) : ?>
    <div class="row m-t-20">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"> <?= h($subject->name) ?> </h4>
                </div>
                <div class="panel-body">
                    <table class="table table-responsive table-bordered">
                        <tr>
                            <th><?= __('Block') ?></th>
                            <td><?= $subject->block->name ?></td>
                        </tr>
                    </table>

                    <div class="related">
                        <h4><?= __(' Student Termly Results') ?></h4>
                        <?php if (isset($students) AND !empty($students)): ?>
                            <?= $this->Form->create(null,['method'=>'post']) ?>
                            <table class="table table-bordered table-responsive">
                                <thead>
                                <tr>
                                    <th><?= __('Student Id') ?></th>
                                    <th><?= __('Name') ?></th>
                                    <?php foreach( $gradeInputs as $gradeInput ): ?>
                                        <th> <?= __($gradeInput) ?> </th>
                                    <?php endforeach; ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($students as $num => $name ): ?>
                                    <tr>
                                        <td><?= h($num) ?></td>
                                        <td><?= h($name) ?></td>
                                        <?php foreach( $gradeInputs as $key => $value ) : ?>
                                            <td><?= $this->Form->input('student_termly_results.'.$num.".$key") ?></td>
                                        <?php endforeach; ?>
                                        <td class="hidden"><?= $this->Form->hidden('student_termly_results.'.$num.'.student_id',['value'=>$num]) ?></td>
                                        <td class="hidden"><?= $this->Form->hidden('student_termly_results.'.$num.'.subject_id',['value'=>$subject->id]) ?></td>
                                        <td class="hidden"><?= $this->Form->hidden('student_termly_results.'.$num.'.class_id',['value'=>$queryData['class_id']]) ?></td>
                                        <td class="hidden"><?= $this->Form->hidden('student_termly_results.'.$num.'.term_id',['value'=>$queryData['term_id']]) ?></td>
                                        <td class="hidden"><?= $this->Form->hidden('student_termly_results.'.$num.'.session_id',['value'=>$queryData['session_id']]) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?= $this->Form->submit('Submit',['class'=>'btn btn-primary']) ?>
                            <?= $this->Form->end() ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php endif; ?>
