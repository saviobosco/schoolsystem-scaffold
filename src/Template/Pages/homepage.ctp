<?php
/**
 * file name check_result.ctp .
 */
use Cake\Core\Configure;
use Settings\Core\Setting;
$this->assign('title','Homepage');
$app_name = Setting::read('Application.school_name');
$edittemplates = [
    'input' => '<div class="col-sm-8"> <input class="form-control input-sm" type="{{type}}" name="{{name}}"{{attrs}}/> </div>',
    'select' => '<div class="col-sm-8"> <select name="{{name}}"{{attrs}}>{{content}}</select> </div> ',
];
$this->Form->templates($edittemplates)
?>
<div class="row">
    <div class="col-sm-12">
        <hr>

        <?= $this->Html->image('image-banner.png',['width'=>'100%' , 'height' => '150px']) ?>
        <hr>
<!--        <div>-->
<!--            School Write up here.-->
<!--        </div>-->

        <p> Feel free to call or text us in case of any difficulty for swift support. For Support Call us on <i class="fa fa-phone"></i> 07012572570 or chat with our live customer support. </p>
    </div>
</div>

<div class="row ">
    <div class="col-sm-6">
        <div class="well">
            <h5> Steps on how to check your result</h5>
            <ul>
                <li> Enter your Admission Number</li>
                <li> Enter the scratch card pin number</li>
                <li> Select the class, session and term respectively </li>
                <li class="text-danger">Please cross check your details well before proceeding </li>
                <li> click the <kbd class="bg-primary">Check Result</kbd> button</li>
            </ul>
        </div>
    </div>
    <div class="col-sm-6 m-b-20">
        <?= $this->CheckResult->showCheckResultForm() ?>
    </div>
</div>
