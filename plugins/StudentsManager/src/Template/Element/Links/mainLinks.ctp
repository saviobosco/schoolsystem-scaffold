<?php
/**
 *  This file contains the main student header link
 *  like : index, graduated_students ...... etc
 */
?>

<div class="pull-right m-b-10">
    <?= $this->Html->link('All Students',['controller'=>'Students','action'=>'index'],['escape'=>false,'class'=>'p-r-10']) ?>
    <?= $this->Html->link('Add Student',['_name' => 'students:create'],['escape'=>false,'class'=>'p-r-10']) ?>
    <?= $this->Html->link('Generate Class List',['controller'=>'ClassLists','action'=>'index'],['escape'=>false,'class'=>'p-r-10']) ?>
</div>
