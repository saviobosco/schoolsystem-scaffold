<?php
// including the search parameter element
echo $this->element('searchParametersSessionClassTerm');
?>


<div class="row m-t-30">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= __('Student Termly Positions') ?> </h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-bordered ">
                    <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('student_id') ?></th>
                        <th><?= $this->Paginator->sort('total') ?></th>
                        <th><?= $this->Paginator->sort('Position') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($studentPositions as $studentPosition): ?>
                        <tr>
                            <td><?= h($studentPosition->id) ?></td>
                            <td><?= h($studentPosition->total) ?></td>
                            <td><?= $this->Position->formatPositionOutput($studentPosition->position) ?></td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>