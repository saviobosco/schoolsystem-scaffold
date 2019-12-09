<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> My Results </h4>
            </div>
            <div class="panel-body">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Session</th>
                            <th>Class</th>
                            <th>Term</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($studentResults) : ?>
                        <?php foreach($studentResults as $result) : ?>
                            <tr>
                                <td> <?= $result['session']['session'] ?> </td>
                                <td> <?= $result['class']['class'] ?> </td>
                                <td> <?= $result['term']['name'] ?> </td>
                                <td>
                                    <?= $this->Html->link('view result',[
                                        'controller' => 'StudentResults',
                                        'action' => 'view',
                                        '?' => [
                                            'session_id' => $result['session_id'],
                                            'class_id' => $result['class_id'],
                                            'term_id' => $result['term_id'],
                                        ]
                                    ]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="col-sm-6">

    </div>
</div>

<div class="row">
    <div class="col-sm-12">
    </div>
</div>