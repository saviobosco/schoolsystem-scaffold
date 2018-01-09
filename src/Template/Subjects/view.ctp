<div class="row">
    <div class="col-sm-12">
        <h3><?= h($subject->name) ?></h3>
        <table class="vertical-table">
            <tr>
                <th><?= __('Name') ?></th>
                <td><?= h($subject->name) ?></td>
            </tr>
            <tr>
                <th><?= __('Category ') ?></th>
                <td><?= h($subject->block->name)  ?></td>
            </tr>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($subject->id) ?></td>
            </tr>
        </table>
    </div>
</div>