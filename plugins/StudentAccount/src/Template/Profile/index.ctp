<?php
use Cake\I18n\Time;
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Student : <?= h($student->id) ?>  </h4>
            </div>
            <div class="panel-body">

                <div class="profile-container">


                    <!-- begin profile-section -->
                    <div class="profile-section">
                        <!-- begin profile-left -->
                        <h2 class=""> Student Information </h2>
                        <div class="profile-left">
                            <!-- begin profile-image -->
                            <div class="profile-image">
                                <?= $this->Html->image('student-pictures/'.$student->photo,[
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
                                <div class="table-responsive">
                                    <table class="table table-user-information table-bordered">
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
                                            <th><?= __('Date Of Birth') ?></th>
                                            <td><?= ($student->date_of_birth) ? (new Time($student->date_of_birth))->format('l jS \\of F, Y') : ''; ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('State Of Origin') ?></th>
                                            <td><?= h($student->state_of_origin) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Religion') ?></th>
                                            <td><?= h(@$religions[$student->religion_id]) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Home Residence') ?></th>
                                            <td><?= h($student->home_residence) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Class') ?></th>
                                            <td><?= $student->class->class ?></td>
                                        </tr>
                                    </table>

                                    <div class="m-t-40">
                                        <h2> Guardian Information</h2>
                                        <table class="table table-user-information table-bordered">
                                            <tr>
                                                <th><?= __('Guardian') ?></th>
                                                <td><?= h($student->guardian) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Relationship To Guardian') ?></th>
                                                <td><?= h($student->relationship_to_guardian) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Occupation Of Guardian') ?></th>
                                                <td><?= h($student->occupation_of_guardian) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Guardian Phone Number') ?></th>
                                                <td><?= h($student->guardian_phone_number) ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- end table -->
                            </div>
                            <!-- end profile-info -->
                        </div>
                        <!-- end profile-right -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
