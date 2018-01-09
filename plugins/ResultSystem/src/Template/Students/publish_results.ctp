<?= $this->element('searchParametersSessionClassTerm') ?>
<div class="row m-t-30">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= __('Publish Students Results') ?> </h4>
            </div>
            <div class="panel-body">
                <?php if ( isset($students)) : ?>

                <?= $this->Form->create($students) ?>
                <table  class="table table-bordered table-responsive ">
                    <thead>
                    <tr>
                        <th><?= h('Admission No') ?></th>
                        <th><?= $this->Paginator->sort('first_name') ?></th>
                        <th><?= $this->Paginator->sort('last_name') ?></th>
                        <th><input type="checkbox" id="selectall"> select all</th>
                        <th> Publish Status </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= h($student->id) ?></td>
                            <td><?= h($student->first_name) ?></td>
                            <td><?= h($student->last_name) ?></td>
                            <td> <input type="checkbox" class="checkbox1" name="student_ids[]" value="<?= $student->id ?>"> </td>
                            <td> <?= (@$student->student_publish_results[0]->status)? '<span> Yes </span>' : '<span> No </span>' ?> </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $this->Form->submit(__('Publish Results '),['class'=>'btn btn-primary']) ?>
                <?= $this->Form->end() ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>