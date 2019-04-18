<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$this->assign('title','Publish Students Results');
$queryData = $this->request->getQuery();
?>
<?= $this->element('searchParametersSessionClassTerm') ?>
<div class="m-t-20">
    <?php if ( isset($students)) : ?>
        <?= $this->Form->create() ?>
        <table  class="table table-bordered table-responsive ">
            <thead>
            <tr>
                <th><?= h('Admission No') ?></th>
                <th><?= $this->Paginator->sort('Full Name') ?></th>
                <th><input type="checkbox" id="selectall"> select all</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($students as $num => $student): ?>
                <tr>
                    <td><?= h($student['id']) ?></td>
                    <td><?= h($student['first_name']. ' '.$student['last_name']) ?></td>
                    <td>
                        <?php
                        $checkboxConfig = ['type'=>'checkbox','label'=>''];
                        if ( empty($student['student_publish_results']) OR 0 === (int)$student['student_publish_results'][0]['status'] ) {
                            $checkboxConfig['checked'] = false;
                        } else {
                            $checkboxConfig['checked'] = true;
                        }
                        ?>
                        <?= $this->Form->control('student_publish_results.'.$num.'.status',$checkboxConfig) ?>
                        <?= $this->Form->hidden('student_publish_results.'.$num.'.student_id',['value' => $student['id']]) ?>
                        <?= $this->Form->hidden('student_publish_results.'.$num.'.class_id',['value' => @$queryData['class_id']]) ?>
                        <?= $this->Form->hidden('student_publish_results.'.$num.'.session_id',['value' =>@$queryData['session_id']]) ?>
                        <?= $this->Form->hidden('student_publish_results.'.$num.'.term_id',['value' => @$queryData['term_id']]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="alert alert-info">
            <p> Total number of students in class : <?= $studentsCount ?>.</p>
            <p>  Total number of students with results : <?= $studentsWithResultCount ?> </p>
        </div>
        <?= $this->Form->submit(__('Publish Results '),['class'=>'btn btn-primary']) ?>
        <?= $this->Form->end() ?>

    <?php endif; ?>
    <?= $this->element('selectParameters') ?>
</div>