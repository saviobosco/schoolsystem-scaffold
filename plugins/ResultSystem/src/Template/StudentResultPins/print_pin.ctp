<?= $this->Plugins->css('bootstrap-datepicker/css/bootstrap-datepicker.css',['block'=>true]) ?>
<?= $this->Plugins->css('bootstrap-datepicker/css/bootstrap-datepicker3.css',['block'=>true]) ?>
<?php $this->assign('title',$title); ?>

<div class="row m-t-20">
    <div class="col-sm-12">

        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= __('Student Result Pins') ?> </h4>
            </div>
            <div class="panel-body">

                <?php if($pins): ?>
                    <h3></h3>
                    <a class="pull-right" data-toggle="modal" data-target="#myModal"  title="Generate an Excel Sheet">Generate excel record <i class="fa fa-info-circle text-primary" data-toggle="tooltip" title="Generate The students Excel Sheet"></i></a>
                    <table id="data-table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th> Serial Number</th>
                            <th> Pin</th>
                            <th> Student</th>
                            <th> Session</th>
                            <th> Class</th>
                            <th> Term</th>
                            <th> Created</th>
                            <th> Modified</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($pins as $pin): ?>
                            <tr>
                                <td><?= $pin->serial_number ?></td>
                                <td><?= $pin->pin ?></td>
                                <td><?= $pin->student_id ?></td>
                                <td><?= @$pin->session->session ?></td>
                                <td><?= @$pin->class->class ?></td>
                                <td><?= @$pin->term->name ?></td>
                                <td><?= (new \Cake\I18n\Time($pin->created))->format('Y-m-d')  ?></td>
                                <td><?= (new \Cake\I18n\Time($pin->modified))->format('Y-m-d') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> <i class="fa fa-file-excel-o fa-2x"></i> Generate Pin Excel Sheet</h4>
            </div>
            <div class="modal-body">
                <?= $this->Form->create(null,['url'=>['controller'=>'StudentResultPins','action'=>'excel_format','_ext' => 'xlsx'],'class'=>'form-inline','type'=>'POST','role'=>'form']) ?>
                <?= $this->Form->input('created',['id' => 'datepicker-autoClose',
                    'class'=>'form-control','label'=>['text'=>'Select Created Date'],'required'=>true]); ?>
                <i class="fa fa-info-circle text-primary" data-toggle="tooltip" title="Select the session or batch of students"></i>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?= $this->Form->button('<i class="fa fa-download"></i> '.__('Download'),['type'=>'submit','class'=>'btn btn-primary','escape'=>false]) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?= $this->Plugins->script('bootstrap-datepicker/js/bootstrap-datepicker.js',['block' => true]) ?>
