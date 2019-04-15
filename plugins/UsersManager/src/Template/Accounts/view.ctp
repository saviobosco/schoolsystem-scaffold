<?php $this->assign('title','Viewing '. $Accounts->first_name . 'profile'); ?>
<div>
    <div class="col-sm-12">
        <div class="well">
            <table class="table table-bordered">
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($Accounts->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($Accounts->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($Accounts->full_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= h($Accounts->role) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($Accounts->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($Accounts->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Superuser') ?></th>
                    <td><?php if ($Accounts->is_superuser) {echo '<i class="text-success">Yes</i>';}else{ echo '<span class="text-danger">No</span>';} ?></td>
                </tr>
                <tr>
                    <th><?= __('active') ?></th>
                    <td><?php if ($Accounts->is_superuser) {echo '<i class="text-success">Yes</i>';}else{ echo '<span class="text-danger">No</span>';} ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>


