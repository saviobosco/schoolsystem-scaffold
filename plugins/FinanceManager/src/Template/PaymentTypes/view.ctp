<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $paymentType
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> View Payment Type </h4>
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-bordered">
                    <tr>
                        <th scope="row"><?= __('Type') ?></th>
                        <td><?= h($paymentType->type) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Created') ?></th>
                        <td><?= h($paymentType->created) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Modified') ?></th>
                        <td><?= h($paymentType->modified) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>