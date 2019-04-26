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
        <?php /* $this->Html->image('image-banner.png',['width'=>'100%' , 'height' => '150px'])*/ ?>
        <hr>
<!--        <div>-->
<!--            School Write up here.-->
<!--        </div>-->

        <p> Feel free to call or text us in case of any difficulty for swift support. For Support Call us on <i class="fa fa-phone"></i> 07012572570 or chat with our live customer support. </p>
    </div>
</div>

<div class="row ">
    <div class="col-sm-7">
        <div class="well">
            <h2>
                GUIDELINES
            </h2>
            <h5> To check your result, follow the simple steps listed below. After checking your result, you can save it or print immediately.
            </h5>
            <ol>
                <li> Enter your Admission Number. This will be provided to you by your school as your "Admission Number", "Registration Number" or any other similar name.</li>
                <li> Select the session in which you want to check your result. </li>
                <li> Select the term. </li>
                <li> Scratch the hidden area at the back of the scratch card and enter the revealed pin as your card pin number </li>
                <li> Click the Check Result button.</li>
            </ol>
        </div>
    </div>
    <div class="col-sm-5 m-b-20">
        <?= $this->CheckResult->showCheckResultForm() ?>
    </div>
</div>
