<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Result Inputs </h4>
            </div>
            <div class="panel-body">
                <div>
                    <?php if(!$resultInputs->isEmpty()) : ?>
                        <table class="table">
                            <thead>
                            <tr>
                                <th> Main Value</th>
                                <th> Actual Name</th>
                                <th> Percent </th>
                                <th> Sort Order </th>
                                <th> Session </th>
                                <th> Actions </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($resultInputs as $input) : ?>
                                <tr>
                                    <td> <?= $input->main_value ?> </td>
                                    <td> <?= $input->replacement ?> </td>
                                    <td> <?= $input->percentage ?> </td>
                                    <td> <?= $input->output_order ?> </td>
                                    <td> <?= $sessions[$input->session_id] ?> </td>
                                    <td>
                                        <a id class="btn btn-primary btn-sm" href="<?= $this->Url->build(['action' => 'edit', $input->id]) ?>">Edit </a>
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $input->id], [ 'class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete {0}?', $input->replacement)]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>

                <?= $this->Form->create(null, ['url' => ['_name' => 'result-inputs:store'], 'type' => 'POST']) ?>
                <div class="row">
                    <div class="col-sm-2">
                        <?= $this->Form->label('column') ?>
                        <?= $this->Form->select('main_value', $main_values) ?>
                    </div>
                    <div class="col-sm-2">
                        <?= $this->Form->input('replacement', ['label' => 'Actual Name']) ?>
                    </div>
                    <div class="col-sm-2">
                        <?= $this->Form->input('percentage', ['type' =>'number', 'label' => 'Percent']) ?>
                    </div>
                    <div class="col-sm-2">
                        <?= $this->Form->input('output_order', ['label' => 'Sort Order']) ?>
                    </div>
                    <div class="col-sm-2">
                        <?= $this->Form->label('Session') ?>
                        <?= $this->Form->select('session_id', $sessions) ?>
                    </div>
                    <div class="col-sm-2 m-t-25" >
                        <?= $this->Form->submit('Add', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>

    </div>
</div>
<script>
    /*$(document).ready(function() {
       $('form').submit(function(event) {
           event.preventDefault();
           formData = {
               main_value: $('select[name=main_value]').val(),
               replacement: $('input[name=replacement]').val(),
               percentage: $('input[name=percentage]').val(),
               output_order: $('input[name=output_order]').val(),
               session_id: $('select[name=session_id]').val(),
           };
           var post = $.post("<?= $this->Url->build(['_name' => 'result-inputs:store']) ?>", formData);
           post.done(function(response, statusText){
             $('table').append(response);
           });
           post.fail(function(response){
               $('#ajax-request-feedback').html("<div class='alert alert-danger'>" + response.responseText +" </div>");
           });
       });




    });*/
</script>