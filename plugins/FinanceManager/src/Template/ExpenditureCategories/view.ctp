<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\ExpenditureCategory $expenditureCategory
  */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= h($expenditureCategory->id) ?> </h4>
            </div>
            <div class="panel-body">
                <?= $this->element('category_links',['id'=>$expenditureCategory->id]) ?>

                <table class="table table-responsive">
                    <tr>
                        <th scope="row"><?= __('Type') ?></th>
                        <td><?= h($expenditureCategory->type) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Id') ?></th>
                        <td><?= $this->Number->format($expenditureCategory->id) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Created') ?></th>
                        <td><?= h($expenditureCategory->created) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Modified') ?></th>
                        <td><?= h($expenditureCategory->modified) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>