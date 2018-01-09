<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= h($feeCategory->id) ?> </h4>
            </div>
            <div class="panel-body">
                <?= $this->element('category_links',['id'=>$feeCategory->id]) ?>
                <table class="table table-responsive">
                    <tr>
                        <th scope="row"><?= __('Type') ?></th>
                        <td><?= h($feeCategory->type) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Id') ?></th>
                        <td><?= $this->Number->format($feeCategory->id) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Created') ?></th>
                        <td><?= h($feeCategory->created) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Modified') ?></th>
                        <td><?= h($feeCategory->modified) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Description') ?></th>
                        <td><?= h($feeCategory->description) ?></td>
                    </tr>
                </table>
                <div class="related">
                    <h4><?= __('Related Fees') ?></h4>
                    <?php if (!empty($feeCategory->fees)): ?>
                        <table class="table table-responsive" >
                            <tr>
                                <th scope="col"><?= __('Id') ?></th>
                                <th scope="col"><?= __('Amount') ?></th>
                                <th scope="col"><?= __('Expected Income') ?></th>
                                <th scope="col"><?= __('Amount Received') ?></th>
                                <th scope="col"><?= __('Term') ?></th>
                                <th scope="col"><?= __('Class') ?></th>
                                <th scope="col"><?= __('Session') ?></th>
                            </tr>
                            <?php foreach ($feeCategory->fees as $fees): ?>
                                <tr>
                                    <td><?= h($fees->id) ?></td>
                                    <td><?= $this->Currency->displayCurrency($fees->amount) ?></td>
                                    <td><?= $this->Currency->displayCurrency($fees->income_amount_expected) ?></td>
                                    <td><?= $this->Currency->displayCurrency($fees->amount_earned) ?></td>
                                    <td><?= h($fees->term->term) ?></td>
                                    <td><?= h($fees->class->class) ?></td>
                                    <td><?= h($fees->session->session) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
