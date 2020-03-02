<?php
/**
 * File to Render if no argument is supplied to view-student-result
 */
?>
<div class="row">
    <div class="col-sm-12">
        <?= $this->Form->create('',['class'=>'form-inline','type'=>'GET', 'id' => 'search-result']) ?>
        <div class="form-group">
            <?= $this->Form->input('session_id',['options' => $sessions,'class'=>'form-control','data-select-id'=>'school','label'=>['text'=>'Session '],'value'=>(isset($queryData['session_id']) && !empty($queryData['session_id'])) ? $queryData['session_id'] : 1]); ?>
            <?= $this->Form->input('class_id',['options' => $classes,'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Class'],'value'=>(isset($queryData['class_id']) && !empty($queryData['class_id'])) ? $queryData['class_id'] : 1]); ?>
            <?= $this->Form->input('term_id',['options' => $terms,'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Term'],'value'=>(isset($queryData['term_id']) && !empty($queryData['term_id'])) ? $queryData['term_id'] : 1]); ?>
            <div class="form-group">
                <button class="btn btn-primary btn-sm"> Change</button>
            </div>
        </div>
        <?= $this->Form->end() ?>
        <div class="m-t-10">
            <button class="btn btn-primary" onclick=" event.preventDefault(); window.frames['result-display'].print(); "> <i class="fa fa-print"></i> Print Result</button>
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-sm-12" style="height: 100%; width: 100%;">

        <iframe name="result-display" id="result-display" style="border: none; width: 100%;" height="1300" src=""  ></iframe>
    </div>
</div>

<script>
    (function($) {
        var search_result_form = $('#search-result');

        search_result_form.submit(function(event) {
            event.preventDefault();
            // get the submitted inputs
            var formInputs = $(this).formSerialize();
            var url = event.target.action + '?'+ formInputs;
            $('#result-display').attr("src", url);

            console.log(url);
        });
    })(jQuery)
</script>
