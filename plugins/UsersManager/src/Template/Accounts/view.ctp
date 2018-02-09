<?= $this->assign('title','Viewing '. $MyUsers->id); ?>
<div>
    <div class="col-sm-12">
        <div class="well">
            <table class="vertical-table">
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($MyUsers->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($MyUsers->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($MyUsers->full_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= h($MyUsers->role) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($MyUsers->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($MyUsers->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Superuser') ?></th>
                    <td><?php if ($MyUsers->is_superuser) {echo '<i class="text-success">Yes</i>';}else{ echo '<span class="text-danger">No</span>';} ?></td>
                </tr>
                <tr>
                    <th><?= __('active') ?></th>
                    <td><?php if ($MyUsers->is_superuser) {echo '<i class="text-success">Yes</i>';}else{ echo '<span class="text-danger">No</span>';} ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>


