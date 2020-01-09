<?php
use Cake\I18n\Time;
?>

<?php if (isset($student)) : ?>
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
                                            <th><?= __('Middle Name') ?></th>
                                            <td><?= h($student->middle_name) ?></td>
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
                                            <td><?= h($student->state->state) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('L.G.A') ?></th>
                                            <td><?= h($student->l_g_a) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Home Town') ?></th>
                                            <td><?= h($student->home_town) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Religion') ?></th>
                                            <td><?= h($student->religion->religion) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('More information about religion') ?></th>
                                            <td><?= h($student->more_information_about_religion) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Home Residence') ?></th>
                                            <td><?= h($student->home_residence) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Class') ?></th>
                                            <td><?= $student->class->class ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Student Type') ?></th>
                                            <td><?= $student->student_type->name ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Blood Group') ?></th>
                                            <td><?= $student->blood_group ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Genotype') ?></th>
                                            <td><?= $student->genotype ?></td>
                                        </tr>
                                    </table>

                                    <div class="m-t-40">
                                        <h2> Admission Information </h2>
                                        <table class="table table-user-information table-bordered">
                                            <tr>
                                                <th><?= __('Admission Number') ?></th>
                                                <td><?= h($student->id) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Date Admitted') ?></th>
                                                <td><?= h($student->date_admitted) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Session Admitted') ?></th>
                                                <td><?= h($student->session_admitted) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Year of Graduation') ?></th>
                                                <td><?= h($student->year_of_graduation) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Mode of Admission') ?></th>
                                                <td><?= h($student->mode_of_admission) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('State CEE Score') ?></th>
                                                <td><?= h($student->state_cee_score) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Former School') ?></th>
                                                <td><?= h($student->former_school) ?></td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="m-t-40">
                                        <h2> Sponsor Information</h2>
                                        <table class="table table-user-information table-bordered">
                                            <tr>
                                                <th><?= __('Sponsor Full name') ?></th>
                                                <td><?= h($student->sponsor_full_name) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Sponsor Phone Number') ?></th>
                                                <td><?= h($student->sponsor_phone_number) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Sponsor Email') ?></th>
                                                <td><?= h($student->sponsor_email) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Sponsor Contact Address') ?></th>
                                                <td><?= h($student->sponsor_contact_address) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Sponsor Relationship') ?></th>
                                                <td><?= h($student->sponsor_relationship) ?></td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="m-t-40">
                                        <h2> Medical Record </h2>
                                        <table class="table table-user-information table-bordered">
                                            <tr>
                                                <th><?= __('Medical Issues') ?></th>
                                                <td>
                                                    <?php foreach($medicalIssues as $id => $issue) : ?>
                                                        <?= @(in_array($id, $student->medical_issues)) ? $issue.',' : '' ?>
                                                    <?php endforeach; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><?= __('More medical information') ?></th>
                                                <td><?= h($student->more_medical_information) ?></td>
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
<?php endif; ?>