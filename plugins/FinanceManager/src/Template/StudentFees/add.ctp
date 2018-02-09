<?php

$formTemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->templates($formTemplates);
$this->extend('/Common/view');
$this->assign('title','Add Student Special Fee');
?>
<div class="profile-container">
    <!-- begin profile-section -->
    <div class="profile-section">
        <!-- begin profile-left -->
        <h2 class=""> Student Information </h2>
        <div class="profile-left">
            <!-- begin profile-image -->
            <div class="profile-image">
                <?= $this->Html->image('student-pictures/students/photo/'.$student->photo_dir.'/'.$student->photo,[
                    'alt' => $student->full_name
                ]) ?>
                <i class="fa fa-user hide"></i>
            </div>
        </div>
        <!-- end profile-left -->
        <!-- begin profile-right -->
        <div class="profile-right">
            <!-- begin profile-info -->
            <div class="profile-info">
                <!-- begin table -->
                <div class="table-responsive table-bordered">
                    <table class="table table-user-information">
                        <tr>
                            <th><?= __('Admission No.') ?></th>
                            <td><?= h($student->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('First Name') ?></th>
                            <td><?= h($student->first_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Last Name') ?></th>
                            <td><?= h($student->last_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Gender') ?></th>
                            <td><?= h($student->gender) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Class') ?></th>
                            <td><?= $student->class->class ?></td>
                        </tr>
                    </table>

                </div>
                <!-- end table -->
            </div>
            <!-- end profile-info -->
        </div>
        <!-- end profile-right -->
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Add Special Fees </h4>
            </div>
            <div class="panel-body">
                <?= $this->Form->create(null) ?>
                    <?= $this->Form->control('fee_category_id',['options'=>$feeCategories]) ?>
                    <?= $this->Form->control('amount') ?>
                    <?= $this->Form->control('purpose') ?>
                <?= $this->Form->submit('Submit',['class'=>'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>

    </div>
</div>
