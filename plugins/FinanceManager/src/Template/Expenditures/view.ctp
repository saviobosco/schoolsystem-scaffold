<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Expenditure $expenditure
  */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> View Expenditure Details </h4>
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-bordered">
                    <tr>
                        <th scope="row"><?= __('Expenditure Category') ?></th>
                        <td><?= $expenditure->expenditure_category->type ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Purpose') ?></th>
                        <td><?= h($expenditure->purpose) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Created By') ?></th>
                        <td><?= h($expenditure->created_by_user->first_name.' '.$expenditure->created_by_user->last_name) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Modified By') ?></th>
                        <td><?= h($expenditure->modified_by_user->first_name.' '.$expenditure->modified_by_user->last_name) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Id') ?></th>
                        <td><?= $this->Number->format($expenditure->id) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Amount') ?></th>
                        <td><?= $this->Currency->displayCurrency($expenditure->amount) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Date') ?></th>
                        <td><?= h($expenditure->date) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Created') ?></th>
                        <td><?= h($expenditure->created) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Modified') ?></th>
                        <td><?= h($expenditure->modified) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>