<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-body">

            </div>
            <div class="panel-body">
                <?= $this->Form->create(null,['type'=>'post']) ?>
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th>Main Value</th>
                        <th> Replacement</th>
                        <th>Output Order</th>
                        <th>Visibility</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $gradeCount = count($resultRemarkInputs); for($num =0; $num < $gradeCount;$num++ ) : ?>
                        <tr>
                            <td style="display: none"> <?= $this->Form->hidden($num.'.id',['value'=>$resultRemarkInputs[$num]['id']]) ?> </td>
                            <td> <?= $this->Form->input($num.'.main_value',['readonly','value'=>$resultRemarkInputs[$num]['main_value']]) ?> </td>
                            <td> <?= $this->Form->input($num.'.replacement',['value'=>$resultRemarkInputs[$num]['replacement']]) ?> </td>
                            <td> <?= $this->Form->input($num.'.output_order',['value'=>$resultRemarkInputs[$num]['output_order']]) ?> </td>
                            <td> <?= $this->Form->input($num.'.visibility',['value'=>$resultRemarkInputs[$num]['visibility']]) ?> </td>
                        </tr>
                    <?php endfor; ?>
                    </tbody>
                </table>
                <?= $this->Form->submit(__('Submit'),['class'=>'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>