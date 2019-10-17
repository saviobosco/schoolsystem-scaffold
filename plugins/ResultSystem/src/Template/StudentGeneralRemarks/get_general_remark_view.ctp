<?php
$queryData = $this->request->getQuery();
?>

<?php if ((int)$queryData['term_id'] === 4) : ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th> Subject </th>
            <th> First Term </th>
            <th> Second Term </th>
            <th> Third Term </th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($studentResults)): ?>
            <?php foreach($studentResults as $result) : ?>
                <tr>
                    <td> <?= $result['subject']['name'] ?> </td>
                    <td> <?= $result['first_term'] ?> </td>
                    <td> <?= $result['second_term'] ?> </td>
                    <td> <?= $result['third_term'] ?> </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
<?php else : ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th> Subject </th>
            <th> Total </th>
            <th> Grade </th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($studentResults)): ?>
            <?php foreach($studentResults as $result) : ?>
                <tr>
                    <td> <?= $result['subject']['name'] ?> </td>
                    <td> <?= $result['total'] ?> </td>
                    <td> <?= $result['grade'] ?> </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
<?php endif; ?>

<div id="response-message">

</div>
<?= $this->Form->create($studentGeneralRemark, ['url' => ['action' => 'add'], 'onSubmit' => ' submitStudentGeneralRemark(this); return false;']) ?>
<fieldset>
    <legend>General Remark</legend>
    <?= $this->Form->hidden('student_id',['value' => $queryData['student_id'] ]) ?>
    <?= $this->Form->hidden('class_id',['value' => $queryData['class_id'] ]) ?>
    <?= $this->Form->hidden('term_id',['value' => $queryData['term_id'] ]) ?>
    <?= $this->Form->hidden('session_id',['value' => $queryData['session_id'] ]) ?>
    <?php foreach($remarkInputs as $remarkInputKey => $remarkInputValue ) : ?>
        <div class="form-group">
            <label for="<?= $remarkInputKey ?>"> <?= h($remarkInputValue) ?> </label>
            <?= $this->Form->text("$remarkInputKey",['class' => 'form-control','label'=>['text'=> 'Result Remark']])  ?>
        </div>
    <?php endforeach; ?>
</fieldset>
<?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
<?= $this->Form->end() ?>

<script>
    function submitStudentGeneralRemark(form)
    {
        var responseMessage = $('#response-message');
        responseMessage.html('');
        var postData = Object.create(null);
        var formInputs = $(form).find(':input');
        for (input in formInputs) {
            if (formInputs.hasOwnProperty(input)) {
                if(formInputs[input] !== undefined && formInputs[input].name !== undefined && formInputs[input].value !== undefined){
                    postData[formInputs[input].name] = formInputs[input].value;
                }
            }
        }
        $.post(form.action, postData, function(response, statusText) {
            if (statusText == "success") {
                responseMessage.html("<div class='alert alert-success'> Remark was successfully updated!</div>");
            }
        })
    }
</script>