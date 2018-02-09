<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $classDemarcation
 */
?>

<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= h($classDemarcation->name) ?> </h4>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <tr>
                        <th><?= __('Name') ?></th>
                        <td><?= h($classDemarcation->name) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Class') ?></th>
                        <td><?= $classDemarcation->has('class') ? $this->Html->link($classDemarcation->class->class, ['controller' => 'Classes', 'action' => 'view', $classDemarcation->class->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= $this->Number->format($classDemarcation->id) ?></td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
</div>
