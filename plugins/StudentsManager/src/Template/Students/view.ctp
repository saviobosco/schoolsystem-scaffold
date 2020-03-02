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

                    <?= $this->element('Links/header_links') ?>


                    <!-- begin profile-section -->
                    <div class="profile-section">
                        <!-- begin profile-left -->
                        <h2 class=""> Student Information </h2>
                        <div class="profile-left">
                            <!-- begin profile-image -->
                            <div class="profile-image">
                                <img src="<?= $student->photo ?>" alt="<?= $student->id ?>">
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
                                            <td><?php echo (new Time($student->date_of_birth))->format('l jS \\of F, Y'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('State Of Origin') ?></th>
                                            <td><?= h(@$student->state->name) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Class') ?></th>
                                            <td><?= $student->class->class ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Home town') ?></th>
                                            <td><?= h($student->hometown) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Religion') ?></th>
                                            <td><?= h(@$student->religion->name) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('More Information About Religion') ?></th>
                                            <td><?= h($student->more_information_about_religion) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Nationality') ?></th>
                                            <td>
                                                <?php if ($student->nationality) : ?>
                                                <?= h($student->nationality->nationality) ?>
                                                <?php endif ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th><?= __('Session Admitted') ?></th>
                                            <td><?= $student->session_admitted ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Date Admitted') ?></th>
                                            <td><?= h($student->date_admitted) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('State Cee Score') ?></th>
                                            <td><?= h($student->state_cee_score) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Former School') ?></th>
                                            <td><?= h($student->former_school) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Year Of Graduation') ?></th>
                                            <td><?= h($student->year_of_graduation) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Blood Group') ?></th>
                                            <td><?= h($student->blood_group) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Genotype') ?></th>
                                            <td><?= h($student->genotype) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Medical Issues') ?></th>
                                            <?php if (is_array($student->medical_issues)) : ?>
                                            <td><?= $this->Text->toList($student->medical_issues) ?></td>
                                            <?php endif ?>
                                        </tr>
                                        <tr>
                                            <th><?= __('More Medical Information') ?></th>
                                            <td>
                                                <?=  ($student->more_medical_information) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Home Residence') ?></th>
                                            <td><?= h($student->home_residence) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Sponsor Full Name') ?></th>
                                            <td><?= h($student->sponsor_full_name) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Sponsor Phone Number') ?></th>
                                            <td><?= h($student->sponsor_phone_number) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Sponsor Contact Address') ?></th>
                                            <td><?= h($student->sponsor_contact_address) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Sponsor Email Address') ?></th>
                                            <td><?= h($student->sponsor_email_address) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Sponsor Relationship') ?></th>
                                            <td><?= h($student->sponsor_relationship) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Sponsor Occupation') ?></th>
                                            <td><?= h($student->sponsor_occupation) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Active') ?></th>
                                            <td><?= ($student->status) ? 'Yes' : 'No' ?></td>
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

            </div>
        </div>
    </div>
</div>
