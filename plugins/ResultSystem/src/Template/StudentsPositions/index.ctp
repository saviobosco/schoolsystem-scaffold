<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$queryData = $this->request->getQuery();
$this->assign('title', 'Students Position');
?>
<?= $this->element('searchParametersSessionClassTerm'); ?>
<table id="data-table" class="table table-bordered ">
    <thead>
    <tr>
        <th><?= h('Admission No.') ?></th>
        <th><?= h('Name') ?></th>
        <th><?= h('Total') ?></th>
        <th><?= h('Average') ?></th>
        <th><?= h('Grade') ?></th>
        <th><?= h('Position') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php if ( isset($studentPositions) && !empty($studentPositions) ) : ?>
        <?php foreach ($studentPositions as $studentPosition): ?>
            <tr>
                <td><?= h($studentPosition->student_id) ?></td>
                <td><?= h($studentPosition->student->first_name).' '.h($studentPosition->student->last_name) ?></td>
                <td><?= h($studentPosition->total) ?></td>
                <td><?= h($studentPosition->average) ?></td>
                <td><?= h($studentPosition->grade) ?></td>
                <td><?= $this->Position->formatPositionOutput($studentPosition->position) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
