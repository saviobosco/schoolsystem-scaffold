<?php if (!empty($studentAnnualResults)): ?>
    <table class="table table-bordered table-responsive table-result ">
        <thead>
        <tr class="bigger-height" >
            <th><?= __('Subject') ?></th>
            <th><div><p style="margin-left: -5px;"><?= __('First Term') ?></p></div></th>
            <th><div><p style="margin-left: -15px;"><?= __('Second Term') ?></p></div></th>
            <th><div><p style="margin-left: -5px;"><?= __('Third Term') ?></p></div></th>
            <th><div><p><?= __('Total') ?></p></div></th>
            <th><div><p><?= __('Average') ?></p></div></th>
            <th><div><p><?= __('Grade') ?></p></div></th>
            <th><div><p><?= __('Remark') ?></p></div></th>
            <th><div><p><?= __('Position') ?></p></div></th>
        </tr>
        </thead>
        <?php foreach ($studentAnnualResults as $studentAnnualResult): ?>
            <tr>
                <td><?= h($studentAnnualResult['subject']['name']) ?></td>
                <td><?= h($studentAnnualResult['first_term']) ?></td>
                <td><?= h($studentAnnualResult['second_term']) ?></td>
                <td><?= h($studentAnnualResult['third_term']) ?></td>
                <td><?= h($studentAnnualResult['total']) ?></td>
                <td><?= h($studentAnnualResult['average']) ?></td>
                <td><?= h($studentAnnualResult['grade']) ?></td>
                <td><?= h($studentAnnualResult['remark']) ?></td>
                <td><?= @$this->Position->formatPositionOutput($studentSubjectPositions[$studentAnnualResult['subject_id']]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p class="text-center text-danger" style="font-size: 17px"> Result for this Annual Session is not ready yet, Please try again later </p>
<?php endif; ?>