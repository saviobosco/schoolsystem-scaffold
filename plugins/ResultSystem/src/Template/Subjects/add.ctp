<?php
// including the search parameter element
echo $this->element('searchParametersSessionClassTerm');
?>
<?php
$editTemplates = [
    'label' => '',
    'submitContainer' => '{{content}}'
];
$this->Form->templates($editTemplates);
// get QueryData
$queryData = $this->request->getQuery();
if ( isset($subjectContainsResult) AND !empty($subjectContainsResult)) {
    foreach( $subjectContainsResult as $student_id ) {
        unset($students[$student_id]);
    }
}
?>
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

                <?php if ( isset($subjectContainsResult) AND $subjectContainsResult === true) : ?>
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation fa-2x"></i> This subject contains some results for the select values!. Please Consider using the edit result link or adding a particular student result.
                    </div>
                <?php endif; ?>

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