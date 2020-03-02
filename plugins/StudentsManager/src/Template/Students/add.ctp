<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$this->assign('title', 'Student Registration Form');

?>

<?= $this->Plugins->css('bootstrap-datepicker/css/bootstrap-datepicker.css') ?>
<?= $this->Plugins->css('bootstrap-datepicker/css/bootstrap-datepicker3.css') ?>
<?= $this->Form->create($student,[
    'enctype' => 'multipart/form-data','novalidate'
]) ?>
<div class="row">
    <div class="col-sm-9">
        <i class="text-danger"> ( * inputs are required )</i>
        <fieldset>
            <legend>Personal Information</legend>
            <div class="row">
                <div class="col-sm-6">
                    <?= $this->Form->input('first_name', ['label' => 'First Name', 'required' => true]);  ?>
                    <?= $this->Form->input('last_name', ['label' => 'Last Name', 'required' => true]);  ?>
                    <?= $this->Form->input('middle_name', ['label' => 'Middle Name']);  ?>
                    <div class="form-group">
                        <label for="gender"> Sex </label>
                        <select class="form-control" name="gender" id="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <?= $this->Form->input('class_id', ['label' => 'Current Class', 'options' => $classes,'empty'=>'Select Class','required'=>true]) ?>

                    <div class="form-group">
                        <label for="date_of_birth">Date of birth</label>
                        <input class="form-control" type="date" name="date_of_birth">
                    </div>
                    <div class="form-group">
                        <label for="type_of_student">Type of Student</label>
                        <?= $this->Form->select('student_type_id', $studentTypes, ['default' => $default_student_type]) ?>
                    </div>
                    <div class="form-group">
                        <label for="type_of_student"> Blood Group </label>
                        <?= $this->Form->select('blood_group', $bloodGroups) ?>
                    </div>
                    <div class="form-group">
                        <label for="type_of_student"> Genotype </label>
                        <?= $this->Form->select('genotype', $genotypes) ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <?= $this->Form->input('state_id',['options'=>$states,'label'=>['text'=>'State of Origin']]) ?>
                    <?= $this->Form->input('l_g_a', ['label' => 'L.G.A']) ?>
                    <?= $this->Form->input('home_town', ['label' => 'Home Town']) ?>
                    <?= $this->Form->input('home_residence', ['label' => 'Permanent Home Address']) ?>
                    <?= $this->Form->input('nationality_id', [ 'empty' => 'select nationality', 'options' => $nationalities, 'default' => $default_nationality , 'label' => 'Nationality']) ?>
                    <?= $this->Form->input('religion',['empty' => 'select religion', 'options' => $religions, 'default' => $default_religion , 'label' => 'Religion']) ?>
                    <div class="form-group">
                        <label> More information about religion </label>
                        <?= $this->Form->textarea('more_information_about_religion', ['class' => 'form-control']) ?>
                    </div>
                    <?= $this->Form->input('status', ['label' => 'Status',   'options' =>['1' => 'Active', '0' => 'Disabled'] ]) ?>
                </div>
            </div>

        </fieldset>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden" value="" name="...">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;"></div>
                <div>
                    <span class="btn btn-default btn-file">
                        <span class="fileinput-new">Load Image</span><span class="fileinput-exists">Change</span><?= $this->Form->file('photo',['type' => 'file']) ?></span>
                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
            </div>
        </div>
    </div>
</div>
<fieldset>
    <legend>Admission Information</legend>
    <div class="row">
        <div class="col-sm-4">
            <?= $this->Form->input('id',['type' => 'text','label'=>['text'=>'Admission No'], 'required' => true]);  ?>
            <div class="form-group">
                <label for="date_admitted">Date Admitted</label>
                <input class="form-control" type="date" name="date_admitted">
            </div>
            <?= $this->Form->input('session_admitted', ['options' => $sessions,'label'=>'Session Admitted','required'=>true]) ?>
            <div class="form-group">
                <label for="year_of_graduation"> Year of Graduation</label>
                <?= $this->Form->year('year_of_graduation', ['minYear' => date('Y') - 30, 'maxYear' => date('Y') + 8, 'value' => date('Y')]) ?>
            </div>
        </div>
        <div class="col-sm-offset-2 col-sm-6">
            <p> Please specify the mode of Admission </p>
            <div class="form-group">
                <label for="mode_of_admission">
                    <input type="radio" name="mode_of_admission" value="Direct"> Direct
                </label>
                <label for="mode_of_admission">
                    <input type="radio" name="mode_of_admission" value="Transfer"> Transfer
                </label>
            </div>
            <?= $this->Form->input('state_cee_score', ['label' => 'State CEE Score']) ?>
            <?= $this->Form->input('former_school', ['label' => 'Former School']) ?>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend>Sponsor's Information</legend>
    <div class="row">
        <div class="col-sm-6">
            <?= $this->Form->input('sponsor_full_name') ?>
            <?= $this->Form->input('sponsor_contact_address') ?>
            <?= $this->Form->input('sponsor_email_address') ?>
        </div>
        <div class="col-sm-6">
            <?= $this->Form->input('sponsor_phone_number' ) ?>
            <?= $this->Form->input('sponsor_relationship', [ 'empty' => 'Select Sponsor Relationship', 'options' => $sponsorRelationships]) ?>
            <?= $this->Form->input('sponsor_occupation') ?>
        </div>
    </div>
</fieldset>
<?php
/*if (\Cake\Core\Plugin::loaded('FinanceManager')){
    echo $this->Form->input('add_student_fee',['type'=>'checkbox','label'=>'Add the student Fees Automatically','checked'=>true]);
}
*/?>
<hr>
<fieldset>
    <legend class="text-center"> Medical Records </legend>
    <div class="row text-center">
        <div class="col-sm-6">
            <?php foreach($medicalIssues as $id => $issue) : ?>
                <label for="issue-<?= $id ?>">
                    <input type="checkbox" id="issue-<?= $id ?>" name="medical_issues[]" value="<?= $id ?>" > <?= $issue ?>
                </label>
            <?php endforeach; ?>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for=""> More Medical Information</label>
                <?= $this->Form->textarea('more_medical_information', ['class' => 'form-control']) ?>
            </div>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend> Login Information </legend>
    <div class="row">
        <div class="col-sm-6">
            <?= $this->Form->input('username');  ?>
        </div>
        <div class="col-sm-6">
            <?= $this->Form->input('password'); ?>
        </div>
    </div>
</fieldset>

<div class="pull-right m-t-30">
    <button type="submit" class="btn btn-success m-r-20"> <i class="fa fa-save"></i> Save </button>

    <?= $this->Form->button(__('Cancel'),['class' => 'btn btn-danger']) ?>
</div>
<?= $this->Form->end() ?>


<?php /* $this->Plugins->script('bootstrap-datepicker/js/bootstrap-datepicker.js',['block' => true])*/ ?>
<?= $this->Site->script('custom/js/fileinput.min.js',['block' => true]) ?>
