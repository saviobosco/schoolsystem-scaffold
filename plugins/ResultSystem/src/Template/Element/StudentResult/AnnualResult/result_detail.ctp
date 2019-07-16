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
            <th><?= __('average') ?></th>
            <td><?= h($studentPosition['average']) ?></td>
        </tr>

        <tr>
            <th> <?= __('Grade') ?></th>
            <td> <?= $studentPosition['grade'] ?></td>
            <th><?= __('Next term begins') ?></th>
            <td><?= $this->cell('ResultSystem.SchoolTermTimeTable') ?></td>
        </tr>
        <tr>
            <th>
                Promoted
            </th>
            <td>
                <?= ($studentPosition['promoted'] === null OR $studentPosition['promoted'] == 0 ) ? 'No' : 'Yes' ?>
            </td>
        </tr>
    <?php endif; ?>
</table>