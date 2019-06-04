<?php
$this->extend('/Common/view');
$this->assign('title','Class Results ');
?>
<?php
$edittemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->templates($edittemplates);
$queryData = $this->request->getQuery();
?>
<div class="row">
    <div class="col-sm-12">
        <?= $this->Form->create('',['class'=>'form-inline','type'=>'GET']) ?>
        <div class="form-group">
            <?= $this->Form->input('session_id',['options' => $sessions,'class'=>'form-control','data-select-id'=>'school','label'=>['text'=>'Session '],'value'=>(isset($queryData['session_id']) && !empty($queryData['session_id'])) ? $queryData['session_id'] : 1]); ?>
            <?= $this->Form->input('class_id',['options' => $classes,'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Class'],'value'=>(isset($queryData['class_id']) && !empty($queryData['class_id'])) ? $queryData['class_id'] : 1]); ?>
            <?= $this->Form->input('term_id',['options' => $terms,'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Term'],'value'=>(isset($queryData['term_id']) && !empty($queryData['term_id'])) ? $queryData['term_id'] : 1]); ?>

            <label for="result status"> Include Positions </label>
            <?php $options = (isset($queryData['include_positions']) && (int)$queryData['include_positions'] === 1)? ['checked'=>true] : [] ?>
            <?= $this->Form->checkbox('include_positions', $options) ?>
            <?= $this->Form->submit(__('change'),['class'=>'btn btn-primary']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-sm-12">
        <?php if (!empty($subjects)) : ?>
            <table class="table table-bordered table-responsive" id="data-table-combine">
                <thead>
                <tr>
                    <th> Students </th>

                    <?php foreach($subjects as $subject) : ?>
                        <th> <?= $subject ?> </th>
                    <?php endforeach; ?>
                    <?php if (isset($queryData['include_positions']) && (int)$queryData['include_positions'] === 1) : ?>
                    <th> TOTAL </th>
                    <th> POSITION </th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php if (isset($students)) : ?>
                    <?php foreach($students as $student_id => $student) : ?>
                        <tr>
                            <td> <?= $student['student']['first_name'].' '.$student['student']['last_name'] ?></td>
                            <?php foreach($subjects as $subject_id => $subject_name ) : ?>
                                <td><?= @$studentResults[$student_id][$subject_id]['total'] ?></td>
                            <?php endforeach; ?>
                            <?php if(isset($queryData['include_positions']) && (int)$queryData['include_positions'] === 1) : ?>
                            <td> <?= $student['total'] ?></td>
                            <td> <?= $student['position'] ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>

                <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<?php $this->start('tableCombineJs');
echo $this->Site->script('DataTables/extensions/Buttons/js/dataTables.buttons.min.js');
echo $this->Site->script('DataTables/extensions/Buttons/js/buttons.bootstrap.min.js');
echo $this->Site->script('DataTables/extensions/Buttons/js/buttons.flash.min.js');
echo $this->Site->script('DataTables/extensions/Buttons/js/jszip.min.js');
echo $this->Site->script('DataTables/extensions/Buttons/js/pdfmake.min.js');
echo $this->Site->script('DataTables/extensions/Buttons/js/vfs_fonts.min.js');
echo $this->Site->script('DataTables/extensions/Buttons/js/buttons.html5.min.js');
echo $this->Site->script('DataTables/extensions/Buttons/js/buttons.print.min.js');
 $this->end() ?>
