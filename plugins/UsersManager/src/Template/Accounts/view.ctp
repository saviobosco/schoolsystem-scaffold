<?php $this->assign('title','Viewing '. $user->full_name . ' profile'); ?>
<div>
    <div class="col-sm-12">
        <div class="well">
            <table class="table table-bordered">
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($user->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($user->full_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= h($user->role) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Superuser') ?></th>
                    <td><?php if ($user->is_superuser) {echo '<i class="text-success">Yes</i>';}else{ echo '<span class="text-danger">No</span>';} ?></td>
                </tr>
                <tr>
                    <th><?= __('Is active') ?></th>
                    <td><?php if ($user->active) {echo '<i class="text-success">Yes</i>';}else{ echo '<span class="text-danger">No</span>';} ?></td>
                </tr>
            </table>
        </div>

        <?php if ($user->role === 'teacher') : ?>

            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title"> Assigned Subjects  </h4>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-responsive">
                                <thead>
                                <tr>
                                    <th> Subjects Id</th>
                                    <th> Subject Name </th>
                                    <th> Block </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (isset($assignedSubjects) && !empty($assignedSubjects)): ?>
                                    <?php foreach($assignedSubjects as $subject): ?>
                                        <tr>
                                            <td> <?= $subject['id'] ?> </td>
                                            <td> <?= $subject['name'] ?> </td>
                                            <td> <?= $subject['block']['name'] ?> </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title"> Assigned Classes </h4>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-responsive">
                                <thead>
                                <tr>
                                    <th> Class Id</th>
                                    <th> Class </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (isset($assignedClasses) && !empty($assignedClasses)): ?>
                                    <?php foreach($assignedClasses as $class): ?>
                                        <tr>
                                            <td> <?= $class['id'] ?> </td>
                                            <td> <?= $class['class'] ?> </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title"> Assigned Class Permissions </h4>
                        </div>
                        <div class="panel-body">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th> Class</th>
                                    <th> Subjects </th>
                                    <th> Terms </th>
                                    <th> Sessions </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (isset($permissions) && !empty($permissions)): ?>
                                    <?php foreach($permissions as $permission): ?>
                                        <tr>
                                            <td>
                                                <?= $assignedClasses[$permission['class_id']]['class'] ?>
                                            </td>
                                            <td>
                                                <?php foreach($permission['subjects'] as $subject_id): ?>
                                                    <?php if (0 === (int) $subject_id): ?>
                                                        <p> All </p>
                                                    <?php else: ?>
                                                        <?= $subjects[$subject_id] . ',' ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                            <td>
                                                <?php foreach($permission['terms'] as $term_id): ?>
                                                    <?php if (0 === (int) $term_id): ?>
                                                        <p> Current Term </p>
                                                    <?php else: ?>
                                                        <?= $terms[$term_id] . ',' ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                            <td>
                                                <?php foreach($permission['sessions'] as $session_id): ?>
                                                    <?php if (0 === (int) $session_id): ?>
                                                        <p> Current Session </p>
                                                    <?php else: ?>
                                                        <?= $sessions[$session_id] . ',' ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>

    </div>
</div>


