<?php
/**
 *  This file contains the main student header link
 *  like : index, graduated_students ...... etc
 */
?>

<div class="pull-right m-b-10">
    <?= $this->Html->link('All Students',['controller'=>'Students','action'=>'index'],['escape'=>false,'class'=>'p-r-10']) ?>
    <?= $this->Html->link('Add Student',['controller'=>'Students','action'=>'add'],['escape'=>false,'class'=>'p-r-10']) ?>
    <?= $this->Html->link('View UnActive Students',['controller'=>'Students','action'=>'unActiveStudents'],['escape'=>false,'class'=>'']) ?>
</div>
