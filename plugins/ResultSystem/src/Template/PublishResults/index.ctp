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
        <?= $this->Form->create($students) ?>
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
            $studentCounts = count($students);
            for ($num = 0; $num < $studentCounts; $num++): ?>
                <tr>
                    <td><?= h($students[$num]['id']) ?></td>
                    <td><?= h($students[$num]['full_name']) ?></td>
                    <td>
                        <?php
                        $checkboxConfig = ['type'=>'checkbox','label'=>''];
                        if ( empty($students[$num]['student_publish_results']) OR 0 === (int)$students[$num]['student_publish_results'][0]['status'] ) {
                            $checkboxConfig['checked'] = false;
                        } else {
                            $checkboxConfig['checked'] = true;
                        }
                        ?>
                        <?= $this->Form->control('student_publish_results.'.$num.'.status',$checkboxConfig) ?>
                        <?= $this->Form->hidden('student_publish_results.'.$num.'.student_id',['value' => $students[$num]['id']]) ?>
                        <?= $this->Form->hidden('student_publish_results.'.$num.'.class_id',['value' => @$queryData['class_id']]) ?>
                        <?= $this->Form->hidden('student_publish_results.'.$num.'.session_id',['value' =>@$queryData['session_id']]) ?>
                        <?= $this->Form->hidden('student_publish_results.'.$num.'.term_id',['value' => @$queryData['term_id']]) ?>
                    </td>
                </tr>
            <?php endfor; ?>
            </tbody>
        </table>
        <?= $this->Form->submit(__('Publish Results '),['class'=>'btn btn-primary']) ?>
        <?= $this->Form->end() ?>

    <?php endif; ?>
    <?= $this->element('selectParameters') ?>
</div>