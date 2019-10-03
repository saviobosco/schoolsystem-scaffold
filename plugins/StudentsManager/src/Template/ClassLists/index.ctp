<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Generate Class List  </h4>
            </div>
            <div class="panel-body">
                <div class="m-b-20">
                    <div class="row">
                        <div class="col-sm-12">
                            <?= $this->Form->create(null, ['url' => 'students-manager/class-lists/create.xlsx']) ?>

                            <?= $this->Form->input('class_id',[
                                'empty' => 'Select Class',
                                'options' => $classes,
                                'class'=>'form-control',
                                'label'=>['text'=>'Select Class'
                                ],
                                'value'=>(isset($queryData['class_id']) && !empty($queryData['class_id'])) ? $queryData['class_id'] : '']);
                            ?>
                            <?= $this->Form->input(__('Generate Class List'),['class'=>'btn btn-primary','type' => 'submit']) ?>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>