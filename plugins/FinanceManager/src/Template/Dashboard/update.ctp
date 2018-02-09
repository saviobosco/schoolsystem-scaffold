<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Update Application </h4>
            </div>
            <div class="panel-body">

                <p class="text-center">update application </p>

                <?= $this->Form->create(null, [
                    'enctype' => 'multipart/form-data'
                ]); ?>

                <?= $this->form->input('file',['type'=>'file','label'=>'Application Update File']) ?>
                <?= $this->Form->submit(__('Upload'),['class'=>'btn btn-primary btn-sm m-b-10']) ?>

            </div>
        </div>
    </div>
</div>