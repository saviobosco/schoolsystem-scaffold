<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Add Fees to Students  </h4>
            </div>
            <div class="panel-body">
                <?= $this->Form->create() ?>

                <div class="row">
                    <div class="col-sm-6">
                        <?= $this->Form->control('fee_id',['id'=>'select' ,'options'=>$fees,'label' => 'Select Fee','empty'=>'Select Fee','required'=>true]) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $this->Form->control('student_ids',[
                            'id'=>'multiple-select2',
                            'multiple'=>true,
                            'options'=>$students,
                            'label' => 'Select Students',
                            'required' => true
                        ]) ?>

                    </div>
                    <div>

                    </div>
                </div>
                <?= $this->Form->submit(__('Create Record'),['class'=>'btn btn-primary']) ?>
                <?= $this->Form->end()  ?>
            </div>
        </div>
    </div>
</div>