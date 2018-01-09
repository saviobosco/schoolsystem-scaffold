<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Upload Result </h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6 col-xs-6">
                        <?= $this->Form->create(null,['id'=>'result-form-upload', 'url' => '', 'enctype' => 'multipart/form-data']) ?>
                        <fieldset>
                            <legend><?= __('Upload Result') ?></legend>
                            <?php

                            echo $this->Form->input('type', ['options' => $gradeInputs,'empty'=>'Select the Upload Type']);
                            echo $this->Form->input('class_id', ['options' => $classes,'empty'=>'Select the class']);
                            echo $this->Form->input('term_id', ['options' => $terms,'empty'=>'Select the term']);
                            echo $this->Form->input('session_id', ['options' => $sessions,'empty'=>'Select the session']);
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
            </div>
        </div>
    </div>
</div>
