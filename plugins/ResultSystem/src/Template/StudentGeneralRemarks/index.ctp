<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$this->assign('title','Students General Remarks');

?>
<div class="row">
    <div class="col-sm-3">
        <?= $this->Form->create() ?>
        <?= $this->Form->input('session_id', ['options' => $sessions, 'id' => 'session-input'])  ?>
        <?= $this->Form->input('class_id', ['options' => $classes, 'empty' => 'Select Class', 'id' => 'class-input'])  ?>
        <?= $this->Form->input('term_id', ['options' => $terms, 'id' => 'term-input'])  ?>
        <?= $this->Form->input('student_id', ['options' => [], 'id' => 'student-input', 'size' => 5, 'label' => 'Students'])  ?>
    </div>
    <div id="general-remark-content" class="col-sm-9">

    </div>
</div>
<script>
    (function(){
        function loadStudents(event)
        {
            var selectedSession = $('#session-input').val();
            var selectedClass = $('#class-input').val();
            var selectedTerm = $('#term-input').val();
            if (selectedSession !== "" && selectedClass !== "" && selectedTerm !== "") {
                if (event.target.id === "class-input") {
                    $('#student-input').load(window.location.origin + '/result-system/student-general-remarks/get-students?class_id=' + selectedClass, null, function()
                    {});
                }
            } else {

            }
        }

        $('#class-input').change(loadStudents);

        $('#student-input').change(function (event) {
            var selectedSession = $('#session-input').val();
            var selectedClass = $('#class-input').val();
            var selectedTerm = $('#term-input').val();
            var selectedStudent = $('#student-input').val();
            $('#general-remark-content').load(window.location.origin +
            '/result-system/student-general-remarks/get-general-remark-view?session_id='+
            selectedSession + '&class_id=' + selectedClass + '&term_id=' + selectedTerm +
            '&student_id=' + selectedStudent);
        })
    })();

</script>