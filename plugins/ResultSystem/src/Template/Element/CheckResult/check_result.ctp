<?= $this->Flash->render('result') ?>
<?= $this->Form->create(null,['url'=>['plugin'=>'ResultSystem', 'controller'=>'CheckResult', 'action'=>'checkResult'],'class' => 'form-horizontal']) ?>
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