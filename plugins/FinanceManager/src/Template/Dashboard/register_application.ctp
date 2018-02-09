<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Software Registration</h4>
            </div>
            <div class="panel-body">
                <?php if ($message) : ?>
                    <div class="alert alert-danger">
                        <i class="fa fa-warning"></i> <?= $message ?>
                    </div>
                <?php endif; ?>
                <?= $this->Form->create() ?>
                <?= $this->Form->input('serial_code',['label'=>'Enter the Serial Code']) ?>
                <?= $this->Form->submit('Renew',['class'=>'btn btn-primary']) ?>
                <?= $this->Form->end()?>
            </div>
        </div>
    </div>
</div>