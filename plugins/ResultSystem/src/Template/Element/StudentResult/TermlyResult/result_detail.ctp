<table class="table result-details-table ">

    <?php if (!empty( $studentPosition )): ?>
        <tr>
            <th> <?= __('Position') ?> </th>
            <td><?= $this->Position->formatPositionOutput($studentPosition['position'])?> </td>
            <th><?= __('Out of') ?></th>
            <td><?= h(@$studentsCount->student_count) ?></td>
        </tr>
        <tr>
            <th> <?= __('Total') ?></th>
            <td> <?= $studentPosition['total'] ?></td>
            <th><?= __('Average') ?></th>
            <td><?= h($studentPosition['average']) ?></td>
        </tr>

        <tr>
            <th> <?= __('Grade') ?></th>
            <td> <?= @$studentPosition['grade'] ?></td>
            <th><?= __('Next term begins') ?></th>
            <td><?= $this->Result->nextTermDate(@$nextTerm->start_date) ?></td>
        </tr>
    <?php endif; ?>

</table>