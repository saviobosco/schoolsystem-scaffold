<?php
/**
 * file name check_result.ctp .
 */
$this->layout = 'custom';
$this->assign('title','Check Termly Result');

$edittemplates = [
    'input' => '<div class="col-sm-8"> <input class="form-control input-sm" type="{{type}}" name="{{name}}"{{attrs}}/> </div>',
    'select' => '<div class="col-sm-8"> <select name="{{name}}"{{attrs}}>{{content}}</select> </div> ',
];
$this->Form->templates($edittemplates)
?>
<div class="row  ">
    <div class="col-sm-3 pull-right">
        <marquee> Notice will be displayed here </marquee>
    </div>
    <div class="col-sm-9">
        <?= $this->Html->image('Homepagesas.jpg',['width'=>'100%' , 'height' => '150px']) ?>
        <h3> Welcome to SASCO Result Checking Portal </h3>
        <hr>
        <p> Sasco Family welcomes you to our result checking portal.
            Here is the part of our school website responsible for students' results
            processing and checking.
            Here our students can check their results, print it and even download transcript after
            graduation .</p>
        <p> Feel free to call, text or email us in case of any difficulty for swift support. </p>
        <p>For Support Call us on <i class="fa fa-phone"></i> 07012572570 or email us our webmaster at: <a href="#" data-toggle="modal" data-target="#myModal" ><i class="fa fa-envelope-o"></i> webmaster@staugustineseminary.org</a></p>

    </div>
</div>

<div class="row m-b-90">
    <div class="col-sm-6 pull-right">
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

        <?= $this->Flash->render('result') ?>

        <?= $this->Form->create(null,['url'=>[''],'class' => 'form-horizontal']) ?>
        <fieldset>
            <?php
            echo $this->Form->input('reg_number',['class'=>'input-sm form-control','required'=>true,'label' => ['class'=> 'control-label col-sm-4', 'text'=>['Admission No.']]]);
            echo $this->Form->input('pin',['class'=>'form-control input-sm','required'=>true,'label' => ['class'=> 'control-label col-sm-4', 'text'=>['Pin Number']]]);
            echo $this->Form->input('class_id', ['class' => 'form-control','required'=>true,'empty'=>true,'options' => $classes,'label'=>['class'=> 'control-label col-sm-4','text'=>'Select Class']]);
            echo $this->Form->input('session_id', ['class' => 'form-control','required'=>true,'empty'=>true,'options' => $sessions,'label'=>['class'=> 'control-label col-sm-4','text'=>'Session']]);
            echo $this->Form->input('term_id', ['class' => 'form-control','required'=>true,'empty'=>true,'options' => $terms,'label' => ['class'=> 'control-label col-sm-4','text' => 'Term']]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Check Result'),['class'=>'btn btn-primary btn-sm']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

<!--Email Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> <i class="fa fa-envelope fa-2x"></i> Email : webmaster@staugustineseminary.org .</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="contactForm" novalidate>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-sm" id="name" placeholder="Enter Name" required data-validation-required-message="Please enter your name.">
                            <p class="help-block text-danger"></p>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="phone-number">Phone:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-sm" id="phone-number" placeholder="Enter Phone Number" required data-validation-required-message="Please enter your phone number.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" control-label col-sm-2" for="message"> Message </label>
                        <div class=" col-sm-10">
                            <textarea  class="form-control input-lg" id="message" rows="7" required data-validation-required-message="Please enter a message."></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-sm btn-primary"> Send </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p> Modal powered by Crack Reactor </p>
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>
