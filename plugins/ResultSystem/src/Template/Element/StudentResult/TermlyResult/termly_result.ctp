<div class="row">
    <div class="col-sm-12">
        <?php if (!empty($studentTermlyResults)): ?>
            <table class="table table-responsive table-bordered table-result">
                <thead>
                <tr class="bigger-height">
                    <th><?= __('Subject') ?></th>
                    <?php foreach( $gradeInputsForTableHead as $gradeInputForTableHead ): ?>
                        <th><div><p><?= h($gradeInputForTableHead['replacement']) ?></p><p>(<?= h($gradeInputForTableHead['percentage']) ?>)</p></div></th>
                    <?php endforeach; ?>
                    <th><div><p><?= __('Total') ?></p></div></th>
                    <th><div><p><?= __('Grade') ?></p></div></th>
                    <th><div><p><?= __('Remark') ?></p></div></th>
                    <th><div><p><?= __('Class Avg') ?></p></div></th>
                    <th><div><p><?= __('Position') ?></p></div></th>

                </tr>
                </thead>
                <tbody>
                <?php foreach ($studentTermlyResults as $studentTermlyResult): ?>
                    <tr>
                        <td><?= h($studentTermlyResult['subject']['name']) ?></td>
                        <?php foreach( $gradeInputs as $key => $value ) : ?>
                            <td><?= h($studentTermlyResult[$key]) ?></td>
                        <?php endforeach; ?>
                        <td><?= h($studentTermlyResult['total']) ?></td>
                        <td><?= h($studentTermlyResult['grade']) ?></td>
                        <td><?= h($studentTermlyResult['remark']) ?></td>
                        <td><?= h(@$subjectClassAverages[$studentTermlyResult['subject_id']])?></td>
                        <td><?= @$this->Position->formatPositionOutput($studentSubjectPositions[$studentTermlyResult['subject_id']])?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center text-danger" style="font-size: 17px"> Result for this term is not ready yet, Please try again later </p>
        <?php endif; ?>
    </div>
</div>