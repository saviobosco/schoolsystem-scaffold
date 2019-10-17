<?php if (isset($student)) : ?>
    <div class="row">
        <div class="col-sm-4">
            <div class="profile-picture">
                <?= $this->Html->image('student-pictures/students/photo/'.$student->photo_dir.'/'.$student->photo,['alt' => $student->id,'width' => '150px']) ?>
            </div>
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($student->full_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Admission No.') ?></th>
                    <td><?= h($student->id) ?></td>
                </tr>
            </table>

        </div>
    </div>
    <?= $this->Form->create($student, ['url' => ['action' => 'add', '?' => $this->request->getQuery()], 'onSubmit' =>'submitStudentSkill(this); return false;']) ?>
    <fieldset>
        <div class="row">

            <div class="col-sm-6">
                <?php if (!empty($affectiveSkills)): ?>

                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Affective Skills') ?></th>
                            <th><?= __('Scores') ?></th>
                        </tr>
                        <?php for ($num = 0; $num < count($affectiveSkills); $num++ ): ?>
                            <tr>
                                <td><?= h($affectiveSkills[$num]['name']) ?></td>
                                <td><?= $this->Form->input('students_affective_disposition_scores.'.$num.'.score') ?></td>
                                <td class="hidden"><?= $this->Form->hidden('students_affective_disposition_scores.'.$num.'.affective_id',['value'=>$affectiveSkills[$num]['id']]) ?></td>
                                <td class="hidden"><?= $this->Form->hidden('students_affective_disposition_scores.'.$num.'.student_id',['value' => $student->id]) ?></td>
                                <td class="hidden"><?= $this->Form->hidden('students_affective_disposition_scores.'.$num.'.class_id',['value' => @$this->SearchParameter->getDefaultValue($this->request->query['class_id'],1)]) ?></td>
                                <td class="hidden"><?= $this->Form->hidden('students_affective_disposition_scores.'.$num.'.term_id',['value' => @$this->SearchParameter->getDefaultValue($this->request->query['term_id'],1)]) ?></td>
                                <td class="hidden"><?= $this->Form->hidden('students_affective_disposition_scores.'.$num.'.session_id',['value' => @$this->SearchParameter->getDefaultValue($this->request->query['session_id'],1)]) ?></td>


                            </tr>
                        <?php endfor; ?>
                    </table>
                <?php endif; ?>
            </div>

            <div class="col-sm-6">
                <?php if (!empty($psychomotorSkills)): ?>

                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Psychomotor Skills') ?></th>
                            <th><?= __('Scores') ?></th>
                        </tr>
                        <?php for ($num = 0; $num < count($psychomotorSkills); $num++ ): ?>
                            <tr>
                                <td><?= h($psychomotorSkills[$num]['name']) ?></td>
                                <td><?= $this->Form->input('students_psychomotor_skill_scores.'.$num.'.score') ?></td>
                                <td class="hidden"><?= $this->Form->hidden('students_psychomotor_skill_scores.'.$num.'.psychomotor_id',['value' =>$psychomotorSkills[$num]['id'] ]) ?></td>
                                <td class="hidden"><?= $this->Form->hidden('students_psychomotor_skill_scores.'.$num.'.student_id',['value' => $student->id]) ?></td>
                                <td class="hidden"><?= $this->Form->hidden('students_psychomotor_skill_scores.'.$num.'.class_id',['value' =>  @$this->SearchParameter->getDefaultValue($this->request->query['class_id'],1)]) ?></td>
                                <td class="hidden"><?= $this->Form->hidden('students_psychomotor_skill_scores.'.$num.'.term_id',['value' =>  @$this->SearchParameter->getDefaultValue($this->request->query['term_id'],1)]) ?></td>
                                <td class="hidden"><?= $this->Form->hidden('students_psychomotor_skill_scores.'.$num.'.session_id',['value' =>  @$this->SearchParameter->getDefaultValue($this->request->query['session_id'],1)]) ?></td>


                            </tr>
                        <?php endfor; ?>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
<?php endif; ?>

<script>
    function submitStudentSkill(form)
    {
        var responseMessage = $("#ajax-request-feedback");
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
                responseMessage.html("<div class='alert alert-success'> Student skill was successfully updated!</div>");
            }
        })
    }
</script>
