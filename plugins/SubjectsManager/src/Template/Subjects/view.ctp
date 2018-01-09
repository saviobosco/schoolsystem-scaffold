<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= h($subject->name) ?> </h4>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-responsive ">
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

    </div>
</div>