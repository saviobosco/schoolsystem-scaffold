<div class="row">
    <div class="col-sm-12">
        <h3><?= h($class->class) ?></h3>
        <table class="vertical-table">
            <tr>
                <th><?= __('Class') ?></th>
                <td><?= h($class->class) ?></td>
            </tr>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($class->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Block Id') ?></th>
                <td><?= $this->Number->format($class->block_id) ?></td>
            </tr>
            <tr>
                <th><?= __('Created') ?></th>
                <td><?= h($class->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Modified') ?></th>
                <td><?= h($class->modified) ?></td>
            </tr>
        </table>
        <div class="related">
            <h4><?= __('Related Class Demarcations') ?></h4>
            <?php if (!empty($class->class_demarcations)): ?>
                <table class="table table-responsive table-bordered">
                    <tr>
                        <th><?= __('Name') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($class->class_demarcations as $classDemarcations): ?>
                        <tr>
                            <td><?= h($classDemarcations->name) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ClassDemarcations', 'action' => 'view', $classDemarcations->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ClassDemarcations', 'action' => 'edit', $classDemarcations->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ClassDemarcations', 'action' => 'delete', $classDemarcations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $classDemarcations->id)]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>