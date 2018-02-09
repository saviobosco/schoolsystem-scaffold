<div class="row">
    <div class="col-sm-12">
        <h3><?= h($resultGradingSystem->id) ?></h3>
        <table class="vertical-table">
            <tr>
                <th><?= __('Grade') ?></th>
                <td><?= h($resultGradingSystem->grade) ?></td>
            </tr>
            <tr>
                <th><?= __('Remark') ?></th>
                <td><?= h($resultGradingSystem->remark) ?></td>
            </tr>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($resultGradingSystem->id) ?></td>
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