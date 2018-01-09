<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= __('Result Grading Systems') ?> </h4>
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-bordered">
                    <tr>
                        <th><?= __('Grade') ?></th>
                        <td><?= h($resultGradingSystem->grade) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Remark') ?></th>
                        <td><?= h($resultGradingSystem->remark) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Score') ?></th>
                        <td><?= $this->Number->format($resultGradingSystem->score) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Created') ?></th>
                        <td><?= h($resultGradingSystem->created) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Modified') ?></th>
                        <td><?= h($resultGradingSystem->modified) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>