<?php
$user =${$tableAlias};
$this->assign('title','Edit Account');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Edit Account </h4>
            </div>
            <div class="panel-body">

                <?= $this->Form->create($user) ?>
                <fieldset>
                    <?php
                    echo $this->Form->input('username',['class'=>'form-control','readonly']);
                    //echo $this->Form->input('password',['class'=>'form-control']);
                    echo $this->Form->input('email',['class'=>'form-control']);
                    echo $this->Form->input('first_name',['class'=>'form-control']);
                    echo $this->Form->input('last_name',['class'=>'form-control']);
                    echo $this->Form->input('role', [
                        'options' => \Cake\Core\Configure::read('UserRoles'),
                        'class'=>'form-control','escape'=>false,
                    ]);
                    echo $this->Form->input('is_superuser',['data-render'=>'switchery']);
                    echo $this->Form->input('active',['type'=>'checkbox','data-render'=>'switchery']);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary']) ?>
                <?= $this->Form->end() ?>

                <hr>
                <?php if ($user['role'] === 'teacher') : ?>
                    <h5> Assign Teachers to Subjects </h5>
                    <?= $this->Form->create(null, ['url' => $this->Url->build(['_name' => 'users:teacher:assign_subjects:post', $user['id']])]) ?>
                    <fieldset>
                        <?php $subjectsArray = $subjects->combine('id', 'subject_name')->toArray() ?>
                        <?php foreach($subjectsArray as $id => $name ) :?>
                            <label><input type="checkbox" name="subjects[_ids][]" value="<?= $id ?>" <?= (in_array($id, $teacherSubjects)) ? 'checked':'' ?> > <?= $name ?></label>
                        <?php endforeach; ?>
                    </fieldset>
                    <?= $this->Form->button(__('Assign Subjects'),['class'=>'btn btn-primary']) ?>
                    <?= $this->Form->end() ?>

                    <h5> Assign Teachers to Classes </h5>
                    <?= $this->Form->create(null, ['url' => $this->Url->build(['_name' => 'users:teacher:assign_classes:post', $user['id']])]) ?>
                    <fieldset>
                        <?php $classesArray = $classes->combine('id', 'class')->toArray() ?>
                        <?php foreach($classesArray as $id => $name ) :?>
                            <label><input type="checkbox" name="classes[_ids][]" value="<?= $id ?>" <?= (in_array($id, $teacherClasses)) ? 'checked':'' ?> > <?= $name ?></label>
                        <?php endforeach; ?>
                    </fieldset>
                    <?= $this->Form->button(__('Assign Classes'),['class'=>'btn btn-primary']) ?>
                    <?= $this->Form->end() ?>
                    <h5> Assign Teachers Subject Permissions </h5>
                    <?= $this->Form->create(null, ['url' => $this->Url->build(['_name' => 'users:teacher:assign_permissions:post', $user['id']])]) ?>
                    <table class="table table-responsive table-bordered">
                        <thead>
                        <tr>
                            <th> Class </th>
                            <th> Subjects</th>
                            <th> Terms </th>
                            <th> Sessions </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $subjects = $subjects->combine('id', 'subject_name', 'block_id')->toArray(); ?>
                        <?php foreach($classes as $class) : ?>
                            <?php if (in_array($class->id, $teacherClasses)): ?>
                                <tr>
                                    <td>
                                        <label><input type="checkbox" name="classes[]" value="<?= $class['id'] ?>" <?= (isset($teacherPermissions[$class['id']])) ? 'checked' : ''  ?>  > <?= $class['class'] ?></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="permissions[<?= $class['id'] ?>][subjects][]" value="0" <?= (isset($teacherPermissions[$class['id']]) && (in_array(0, $teacherPermissions[$class['id']]['subjects'])) ) ? 'checked' : '' ?> > All </label>
                                        <?php foreach($subjects[$class['block_id']] as $id => $name) : ?>
                                            <label><input type="checkbox" name="permissions[<?= $class['id'] ?>][subjects][]" <?= (isset($teacherPermissions[$class['id']]) && (in_array($id, $teacherPermissions[$class['id']]['subjects'])) ) ? 'checked' : '' ?>  value="<?= $id ?>" > <?= $name ?></label>
                                        <?php endforeach; ?>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="permissions[<?= $class['id'] ?>][terms][]" <?= (isset($teacherPermissions[$class['id']]) && (in_array(0, $teacherPermissions[$class['id']]['terms'])) ) ? 'checked' : '' ?> value="0" > All </label>
                                        <?php foreach($terms as $term_id => $term) : ?>
                                            <label><input type="checkbox" name="permissions[<?= $class['id'] ?>][terms][]" <?= (isset($teacherPermissions[$class['id']]) && (in_array($term_id, $teacherPermissions[$class['id']]['terms'])) ) ? 'checked' : '' ?>  value="<?= $term_id ?>" > <?= $term ?></label>
                                        <?php endforeach; ?>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="permissions[<?= $class['id'] ?>][sessions][]" <?= (isset($teacherPermissions[$class['id']]) && (in_array(0, $teacherPermissions[$class['id']]['sessions'])) ) ? 'checked' : '' ?> value="0" > All </label>
                                        <?php foreach($sessions as $session_id => $session) : ?>
                                            <label><input type="checkbox" name="permissions[<?= $class['id'] ?>][sessions][]" <?= (isset($teacherPermissions[$class['id']]) && (in_array($session_id, $teacherPermissions[$class['id']]['sessions'])) ) ? 'checked' : '' ?> value="<?= $session_id ?>" > <?= $session ?></label>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $this->Form->button(__('Assign Permissions'),['class'=>'btn btn-primary']) ?>
                    <?= $this->Form->end() ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>