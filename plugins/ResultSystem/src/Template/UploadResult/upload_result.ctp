<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$this->assign('title','Upload Results');
?>
<div class="row">
    <div class="col-sm-6 col-xs-6">
        <?= $this->Form->create(null,['id'=>'result-form-upload', 'url' => '', 'enctype' => 'multipart/form-data']) ?>
        <fieldset>
            <legend><?= __('Upload Result') ?></legend>
            <?php

            echo $this->Form->control('type', ['options' => $gradeInputs,'empty'=>'Select the Upload Type','required'=>true]);
            echo $this->Form->control('class_id', ['options' => $classes,'empty'=>'Select the class','required'=>true]);
            echo $this->Form->control('term_id', ['options' => $terms,'empty'=>'Select the term','required'=>true]);
            echo $this->Form->control('session_id', ['options' => $sessions,'empty'=>'Select the session','required'=>true]);
            echo $this->Form->file('result',['required'=>true]);
            ?>
        </fieldset>
        <?= $this->Form->input(__('Upload'),['class' => ' btn btn-primary m-t-20','type' => 'submit','escape' => false]) ?>
        <?= $this->Form->end() ?>
    </div>
    <div class="col-sm-6 col-xs-6">
        <div class="alert alert-info">
            <h5><i class="fa fa-info-circle"></i> Note </h5>
            <ul>
                <li>
                    Before You upload any result Please make sure the following are correct and accurate
                </li>
                <li> The type of result being uploaded </li>
                <li> The class the result belongs to</li>
                <li> The term and session .</li>
            </ul>
            <h5> If an error occurs during the upload, its likely to come from the following:</h5>
            <ol>
                <li> Bad arrangement of the excel columns. </li>
                <li> Wrong naming of the excel columns.</li>
                <li> Wrong subject name or Character case </li>
            </ol>
            This is the proper arrangement of the excel columns and rows
            <table class="table table-example table-responsive table-bordered">
                <tbody>
                <tr>
                    <td>student_id</td>
                    <td> MATHEMATICS </td>
                    <td> ENGLISH </td>
                    <td> BIOLOGY </td>
                    <td> ...</td>
                </tr>
                <tr>
                    <td>SMS/2016/001</td>
                    <td> 10</td>
                    <td> 10 </td>
                    <td> 10</td>
                    <td> ...</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    var handleResultUpload = function() {
        $('#result-form-upload').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url:'<?= $this->Url->build(['plugin'=>'ResultSystem','controller'=>'UploadResult','action'=>'processUploadResult'], true) ?>' ,
                contentType:false,
                cache:false,
                processData:false,
                data:/* $(this).serialize()*/ new FormData(this),
                beforeSend:function(){
                    $('#ajax-request-feedback').html('<div class="alert alert-info"> <i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Uploading result, Please be patient this might take a while ... </div>');
                },
                success: function(data,status){
                    //$( ".result" ).html( data );
                    //$('#ajax-request-feedback').empty();
                    $('#ajax-request-feedback').html(data);
                    //document.getElementById("result-form-upload").reset();
                },
                dataType: 'text'
            });
        })
    };
    handleResultUpload();
</script>
