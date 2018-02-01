<?php
$this->extend('/Common/view');
$this->assign('title','Grade Input Settings');
?>
<?= $this->Form->create(null,['type'=>'post']) ?>
    <table class="table table-bordered table-responsive">
        <thead>
        <tr>
            <th>Main Value</th>
            <th> Replacement</th>
            <th>Percentage</th>
            <th>Output Order</th>
            <th>Visibility</th>
        </tr>
        </thead>
        <tbody>
        <?php $gradeCount = count($resultGradeInputs); for($num =0; $num < $gradeCount;$num++ ) : ?>
            <tr>
                <td style="display: none"> <?= $this->Form->hidden($num.'.id',['value'=>$resultGradeInputs[$num]['id']]) ?> </td>
                <td> <?= $this->Form->input($num.'.main_value',['readonly','value'=>$resultGradeInputs[$num]['main_value']]) ?> </td>
                <td> <?= $this->Form->input($num.'.replacement',['value'=>$resultGradeInputs[$num]['replacement']]) ?> </td>
                <td> <?= $this->Form->input($num.'.percentage',['value'=>$resultGradeInputs[$num]['percentage']]) ?> </td>
                <td> <?= $this->Form->input($num.'.output_order',['value'=>$resultGradeInputs[$num]['output_order'],'type'=>'number']) ?> </td>
                <?php
                $settings = ['type'=>'checkbox','checked'=>true,'value'=>$resultGradeInputs[$num]['visibility']];
                if ( is_null($resultGradeInputs[$num]['visibility']) OR 0 === (int)$resultGradeInputs[$num]['visibility'] ) {
                    $settings = ['checked'=>false];
                }
                ?>
                <td> <?= $this->Form->input($num.'.visibility',$settings) ?> </td>
            </tr>
        <?php endfor; ?>
        </tbody>
    </table>
<?= $this->Form->submit(__('Submit'),['class'=>'btn btn-primary']) ?>
<?= $this->Form->end() ?>